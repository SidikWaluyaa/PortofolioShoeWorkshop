<?php

namespace App\Services;

use App\Exceptions\AdoptionConflictException;
use App\Mail\AdoptionApprovedInvoiceMail;
use App\Mail\AdoptionAvailableAgainMail;
use App\Mail\AdoptionCompletedMail;
use App\Mail\AdoptionOnHoldMail;
use App\Mail\AdoptionProcessingMail;
use App\Mail\AdoptionTakenMail;
use App\Mail\DonationRequestRejectedMail;
use App\Mail\DonationShippedMail;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Adoption ("siapa cepat dia dapat") status flow for catalog requests.
 *
 * Everyone may request a shoe and gets an invoice right away. The first requester to upload
 * payment proof reserves the shoe ('dipesan', hidden from the catalog) and the others are put
 * on hold. If the admin approves that payment the shoe is 'disalurkan' and the others are
 * rejected; if the admin rejects it the shoe is 'tersedia' again and the others may pay.
 */
class AdoptionService
{
    /** Request statuses that hold the shoe, mapped to the item status they imply ('disetujui' is legacy data). */
    private const HOLDING_STATUSES = [
        'menunggu_verifikasi' => 'dipesan',
        'disetujui'           => 'disalurkan',
        'diproses'            => 'disalurkan',
        'dikirim'             => 'disalurkan',
        'selesai'             => 'disalurkan',
    ];

    /** Request statuses of people still waiting for the shoe ('pending' is legacy). */
    private const WAITING_STATUSES = ['pending', 'menunggu_pembayaran'];

    /**
     * Member uploads payment proof: the first one to do so reserves the shoe. A member pays for one
     * shoe at a time, so this is refused while another of their orders is being verified or processed.
     *
     * @throws AdoptionConflictException when the request is not awaiting payment, the shoe is no longer available, or another order is in progress
     */
    public function submitPayment(DonationRequest $request, string $paymentProofPath): array
    {
        return $this->transition($request, 'menunggu_verifikasi', ['bukti_pembayaran' => $paymentProofPath], function (DonationRequest $locked, ?DonationItem $item) {
            if ($locked->status !== 'menunggu_pembayaran') {
                throw new AdoptionConflictException('Bukti pembayaran hanya dapat diunggah saat permohonan menunggu pembayaran.');
            }
            if (!$item || $item->status !== 'tersedia') {
                throw new AdoptionConflictException('Maaf, sepatu ini sedang dipesan atau sudah diadopsi pemohon lain. Mohon jangan melakukan transfer dulu, kami akan mengabari Anda.');
            }

            // Serialize one member's payments so two shoes can't be paid for at the same time
            if ($locked->user_id) {
                User::lockForUpdate()->find($locked->user_id);
            }
            if ($locked->otherOrderInProgress()) {
                throw new AdoptionConflictException('Selesaikan pesanan Anda yang lain dulu. Anda baru dapat membayar sepatu ini setelah pesanan sebelumnya selesai diverifikasi dan diproses.');
            }
        });
    }

    /**
     * Change a request's status (admin actions, member completion, rollback) and apply the
     * effects on the shoe, the other requesters, and the notification emails.
     *
     * Returns ['changed' => bool, 'messages' => string[], 'item_status' => ?string, 'requests' => [id => status]].
     *
     * @throws AdoptionConflictException when another request already holds the shoe
     */
    public function transition(DonationRequest $request, string $newStatus, array $attributes = [], ?callable $guard = null): array
    {
        [$request, $oldStatus, $item, $affected] = DB::transaction(function () use ($request, $newStatus, $attributes, $guard) {
            $locked = DonationRequest::lockForUpdate()->findOrFail($request->id);
            $item = $locked->donation_item_id ? DonationItem::lockForUpdate()->find($locked->donation_item_id) : null;

            if ($guard) {
                $guard($locked, $item);
            }

            $oldStatus = $locked->status;
            $oldHold = self::HOLDING_STATUSES[$oldStatus] ?? null;
            $newHold = self::HOLDING_STATUSES[$newStatus] ?? null;

            if ($newHold && !$oldHold && $item && $this->otherHolderExists($locked)) {
                throw new AdoptionConflictException('Sepatu ini sudah dipesan pemohon lain. Selesaikan atau tolak permohonan tersebut terlebih dahulu.');
            }

            $locked->update(array_merge($attributes, ['status' => $newStatus]));

            $affected = ['on_hold' => collect(), 'taken' => collect(), 'available' => collect()];
            if (!$item || $oldStatus === $newStatus) {
                return [$locked, $oldStatus, $item, $affected];
            }

            if ($newHold) {
                $item->update(['status' => $newHold]);
            } elseif ($oldHold) {
                $item->update(['status' => 'tersedia']);
            }

            if ($newHold === 'dipesan' && !$oldHold) {
                $affected['on_hold'] = $this->waitingRequests($locked, ['menunggu_pembayaran']);
            }

            if ($newHold === 'disalurkan' && $oldHold !== 'disalurkan') {
                $affected['taken'] = $this->waitingRequests($locked, self::WAITING_STATUSES);
                DonationRequest::whereIn('id', $affected['taken']->pluck('id'))->update(['status' => 'ditolak']);
            }

            if ($oldHold && !$newHold) {
                $affected['available'] = $this->waitingRequests($locked, ['menunggu_pembayaran']);
            }

            return [$locked, $oldStatus, $item, $affected];
        });

        $messages = [];
        if ($oldStatus !== $newStatus) {
            $this->notifyRequester($request);
            if ($message = $this->mailRequester($request)) {
                $messages[] = $message;
            }
            $messages = array_merge($messages, $this->notifyOthers($affected));
        }

        return [
            'changed'     => $oldStatus !== $newStatus,
            'messages'    => $messages,
            'item_status' => $item?->fresh()->status,
            'requests'    => $item
                ? DonationRequest::where('donation_item_id', $item->id)->pluck('status', 'id')->all()
                : [$request->id => $request->status],
        ];
    }

    /**
     * Delete a request, releasing the shoe if this request was holding it.
     *
     * Returns ['item_status' => ?string, 'requests' => [id => status]] for the remaining requests.
     */
    public function delete(DonationRequest $request): array
    {
        if (isset(self::HOLDING_STATUSES[$request->status])) {
            $this->transition($request, 'dibatalkan');
        }

        $request->delete();

        $item = $request->donation_item_id ? DonationItem::find($request->donation_item_id) : null;

        return [
            'item_status' => $item?->status,
            'requests'    => $item ? DonationRequest::where('donation_item_id', $item->id)->pluck('status', 'id')->all() : [],
        ];
    }

    private function otherHolderExists(DonationRequest $request): bool
    {
        return DonationRequest::where('donation_item_id', $request->donation_item_id)
            ->where('id', '!=', $request->id)
            ->whereIn('status', array_keys(self::HOLDING_STATUSES))
            ->exists();
    }

    private function waitingRequests(DonationRequest $request, array $statuses): Collection
    {
        return DonationRequest::with(['user', 'donationItem'])
            ->where('donation_item_id', $request->donation_item_id)
            ->where('id', '!=', $request->id)
            ->whereIn('status', $statuses)
            ->get();
    }

    /**
     * In-app notification for the requester whose status changed.
     */
    private function notifyRequester(DonationRequest $request): void
    {
        if (!$request->user) {
            return;
        }

        $name = $request->donationItem?->nama;
        $notification = match ($request->status) {
            'menunggu_pembayaran' => ['Tagihan Adopsi Terbit', "Tagihan adopsi untuk {$name} sudah terbit. Siapa cepat dia dapat, segera selesaikan pembayaran.", 'receipt_long', 'info'],
            'diproses'            => ['Pembayaran Divalidasi', "Pembayaran Anda untuk {$name} divalidasi. Sepatu sedang disiapkan.", 'inventory_2', 'info'],
            'dikirim'             => ['Pesanan Dikirim', "Hore! {$name} Anda telah dikirim. Lacak sekarang!", 'local_shipping', 'success'],
            'ditolak', 'dibatalkan' => ['Permohonan Dibatalkan/Ditolak', "Maaf, permohonan/tagihan Anda untuk {$name} telah dibatalkan atau ditolak.", 'cancel', 'error'],
            default               => null,
        };

        if ($notification) {
            [$title, $message, $icon, $type] = $notification;
            $request->user->notify(new SystemNotification($title, $message, route('member.adoption-requests.index'), $icon, $type));
        }
    }

    /**
     * Email for the requester whose status changed. Returns a short admin-facing result message.
     */
    private function mailRequester(DonationRequest $request): ?string
    {
        [$mail, $label] = match ($request->status) {
            'menunggu_pembayaran' => [new AdoptionApprovedInvoiceMail($request), 'tagihan'],
            'diproses'            => [new AdoptionProcessingMail($request), 'pembayaran terverifikasi'],
            'dikirim'             => [new DonationShippedMail($request), 'resi pengiriman'],
            'selesai'             => [new AdoptionCompletedMail($request), 'adopsi selesai'],
            'ditolak'             => [new DonationRequestRejectedMail($request), 'penolakan'],
            default               => [null, null],
        };

        if (!$mail || empty($request->email)) {
            return null;
        }

        return $this->send($request->email, $mail)
            ? "Email {$label} terkirim ke {$request->email}."
            : "⚠️ Gagal mengirim email {$label} ke {$request->email}.";
    }

    /**
     * Tell the other requesters of the same shoe what happened to it.
     */
    private function notifyOthers(array $affected): array
    {
        $config = [
            'on_hold'   => [AdoptionOnHoldMail::class, 'Sepatu Sedang Dipesan', 'Sepatu %s sedang dipesan pemohon lain dan menunggu verifikasi. Mohon jangan transfer dulu, kami kabari hasilnya.', 'hourglass_top', 'info', '%d pemohon lain diberi tahu bahwa sepatu sedang dipesan.'],
            'taken'     => [AdoptionTakenMail::class, 'Sepatu Sudah Diadopsi', 'Maaf, sepatu %s sudah diadopsi pemohon lain. Yuk cari sepatu lain di katalog!', 'cancel', 'error', '%d permohonan lain otomatis ditolak karena sepatu sudah diadopsi.'],
            'available' => [AdoptionAvailableAgainMail::class, 'Sepatu Tersedia Lagi!', 'Sepatu %s tersedia lagi. Siapa cepat dia dapat, segera selesaikan pembayaran!', 'notifications_active', 'success', '%d pemohon lain diberi tahu bahwa sepatu tersedia lagi.'],
        ];

        $messages = [];
        foreach ($config as $key => [$mailClass, $title, $message, $icon, $type, $summary]) {
            foreach ($affected[$key] as $other) {
                $text = $key === 'available' && $other->otherOrderInProgress()
                    ? 'Sepatu %s tersedia lagi. Selesaikan pesanan Anda yang lain dulu sebelum membayar sepatu ini.'
                    : $message;

                $other->user?->notify(new SystemNotification(
                    $title,
                    sprintf($text, $other->donationItem?->nama),
                    route('member.adoption-requests.show', $other->id),
                    $icon,
                    $type
                ));

                if (!empty($other->email)) {
                    $this->send($other->email, new $mailClass($other));
                }
            }

            if ($affected[$key]->isNotEmpty()) {
                $messages[] = sprintf($summary, $affected[$key]->count());
            }
        }

        return $messages;
    }

    private function send(string $email, Mailable $mail): bool
    {
        try {
            Mail::to($email)->send($mail);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send ' . class_basename($mail) . ' to ' . $email . ': ' . $e->getMessage());
            return false;
        }
    }
}
