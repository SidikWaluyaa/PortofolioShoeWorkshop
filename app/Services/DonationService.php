<?php

namespace App\Services;

use App\Helpers\ImageCompressionHelper;
use App\Models\Donation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Mail\DonationSubmittedMail;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class DonationService
{
    /**
     * Create a new donation submission from the signed-in user.
     */
    public function create(array $data, mixed $foto): Donation
    {
        $fotoPaths = [];
        foreach (is_array($foto) ? $foto : [$foto] as $file) {
            $fotoPaths[] = ImageCompressionHelper::compressAndStore($file, 'donations/sepatu');
        }

        return $this->createWithPhotos(Auth::user(), $data, $fotoPaths);
    }

    /**
     * Create a donation from photos already on the public disk (a draft saved before the donor signed in).
     */
    public function createWithPhotos(User $user, array $data, array $fotoPaths): Donation
    {
        return Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => $data['nama_sepatu'],
            'brand' => $data['brand'] ?? null,
            'ukuran' => $data['ukuran'],
            'kondisi' => $data['kondisi'],
            'harga' => $data['harga'] ?? 0,
            'deskripsi' => $data['deskripsi'] ?? null,
            'foto_path' => array_values($fotoPaths),
            'metode_pengiriman' => 'ekspedisi', // Placeholder until user inputs it later
            'nama_ekspedisi' => null,
            'no_resi' => null,
            'status' => 'pending',
        ]);
    }

    /**
     * Tell the donor (in-app and by email) and the admins that a new donation came in.
     */
    public function announceSubmitted(Donation $donation): void
    {
        $donor = $donation->user;

        $donor->notify(new SystemNotification(
            'Donasi Terkirim',
            "Donasi {$donation->nama_sepatu} sedang ditinjau tim kami, biasanya 1–2 hari kerja. Terima kasih sudah berbagi!",
            route('member.donations.index'),
            'volunteer_activism',
            'info'
        ));

        try {
            Mail::to($donor->email)->send(new DonationSubmittedMail($donation));
        } catch (\Exception $e) {
            Log::error('Failed to send donation submitted email: ' . $e->getMessage());
        }

        $admins = User::where('role', 'admin')->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new SystemNotification(
                'Donasi Baru Masuk!',
                'Ada pengajuan donasi sepatu baru dari ' . $donor->name . '. Segera cek di halaman donasi.',
                route('admin.donations.index'),
                'volunteer_activism',
                'info'
            ));
        }
    }

    /**
     * Get paginated donations for a specific user.
     */
    public function getByUser(int $userId, int $perPage = 10)
    {
        return Donation::where((string) 'user_id', $userId)
            ->orderByDesc((string) 'created_at')
            ->paginate($perPage);
    }

    /**
     * Get all donations for admin moderation.
     */
    public function getAllForAdmin(int $perPage = 15, ?string $statusFilter = null)
    {
        $query = Donation::with('user', (string) 'verifier')->orderByDesc((string) 'created_at');

        if ($statusFilter) {
            $query->where((string) 'status', $statusFilter);
        }

        return $query->paginate($perPage);
    }

    /**
     * Approve a donation submission online (admin action).
     */
    public function approveSubmission(Donation $donation, ?string $catatan = null): Donation
    {
        $donation->update([
            'status' => 'disetujui',
            'catatan_admin' => $catatan,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        if ($donation->user) {
            $donation->user->notify(new \App\Notifications\SystemNotification(
                'Donasi Disetujui!',
                "Terima kasih! Pengajuan donasi sepatu {$donation->nama_sepatu} kamu telah kami setujui. Silakan cek email kamu untuk instruksi pengiriman.",
                route('member.donations.index'),
                'volunteer_activism',
                'success'
            ));
            
            // Auto-send email instructions to the user
            if ($donation->user->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($donation->user->email)->send(
                        new \App\Mail\DonationApprovedMail($donation)
                    );
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send donation instruction email: ' . $e->getMessage());
                }
            }
        }

        return $donation;
    }

    /**
     * Confirm physical receipt of a donation (admin action). Requires uploading proof photo.
     */
    public function confirmReceipt(Donation $donation, UploadedFile $fotoBukti, ?string $catatan = null): Donation
    {
        $fotoBuktiPath = ImageCompressionHelper::compressAndStore($fotoBukti, 'donations/bukti');

        $donation->update([
            'status' => 'diterima',
            'foto_bukti_path' => $fotoBuktiPath,
            'catatan_admin' => $catatan,
        ]);

        if ($donation->user) {
            $donation->user->notify(new \App\Notifications\SystemNotification(
                'Sepatu Diterima!',
                "Terima kasih! Sepatu {$donation->nama_sepatu} kamu telah kami terima di workshop dan masuk antrean restorasi.",
                route('member.donations.index'),
                'volunteer_activism',
                'success'
            ));

            if ($donation->user->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($donation->user->email)->send(
                        new \App\Mail\DonationReceivedMail($donation)
                    );
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send donation received email: ' . $e->getMessage());
                }
            }
        }

        return $donation;
    }

    /**
     * Reject a donation (admin action).
     */
    public function reject(Donation $donation, string $catatan): Donation
    {
        $donation->update([
            'status' => 'ditolak',
            'catatan_admin' => $catatan,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);
        
        if ($donation->user) {
            $donation->user->notify(new \App\Notifications\SystemNotification(
                'Donasi Ditolak',
                "Mohon maaf, donasi {$donation->nama_sepatu} kamu belum dapat kami terima. Cek catatan admin.",
                route('member.donations.index'),
                'cancel',
                'error'
            ));

            if ($donation->user->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($donation->user->email)->send(
                        new \App\Mail\DonationRejectedMail($donation)
                    );
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send donation rejected email: ' . $e->getMessage());
                }
            }
        }

        return $donation;
    }

    /**
     * Mark a donation as distributed (admin action).
     */
    public function markDistributed(Donation $donation, ?string $catatan = null): Donation
    {
        $donation->update([
            'status' => 'disalurkan',
            'catatan_admin' => $catatan ?? $donation->catatan_admin,
        ]);

        return $donation;
    }
    /**
     * Mark a donation as finished in restoration and ready for catalog.
     */
    public function markRestorationReady(Donation $donation): Donation
    {
        $donation->update([
            'status' => 'siap_rilis',
        ]);

        return $donation;
    }

    /**
     * Mark a donation as archived/entered into catalog.
     */
    public function markAsCataloged(Donation $donation): Donation
    {
        $donation->update([
            'status' => 'masuk_katalog',
        ]);
        
        if ($donation->user) {
            $donation->user->notify(new \App\Notifications\SystemNotification(
                'Sepatu Masuk Katalog!',
                "Sepatu donasi kamu {$donation->nama_sepatu} telah direstorasi dan kini terpajang di Katalog!",
                route('member.donations.index'),
                'storefront',
                'success'
            ));
        }

        return $donation;
    }

    /**
     * Update shipping receipt (resi) for a donation.
     */
    public function updateResi(Donation $donation, string $metode, ?string $namaEkspedisi, ?string $noResi): Donation
    {
        if ($donation->status !== 'disetujui') {
            throw new \Exception('Resi hanya dapat diubah ketika status donasi disetujui (menunggu pengiriman).');
        }

        $donation->update([
            'metode_pengiriman' => $metode,
            'nama_ekspedisi' => $metode === 'ekspedisi' ? $namaEkspedisi : null,
            'no_resi' => $metode === 'ekspedisi' ? $noResi : null,
        ]);

        return $donation;
    }

    /**
     * Update a pending donation submission from a user.
     */
    public function update(Donation $donation, array $data, mixed $fotos = null, array $existingPhotos = []): Donation
    {
        if ($donation->status !== 'pending') {
            throw new \Exception('Donasi hanya dapat diubah ketika status masih pending.');
        }

        $updateData = [
            'nama_sepatu' => $data['nama_sepatu'],
            'brand' => $data['brand'] ?? null,
            'ukuran' => $data['ukuran'],
            'kondisi' => $data['kondisi'],
            'harga' => $data['harga'] ?? 0,
            'deskripsi' => $data['deskripsi'] ?? null,
        ];

        // Compress and store new photos
        $newFotoPaths = [];
        if ($fotos) {
            if (is_array($fotos)) {
                foreach ($fotos as $file) {
                    $newFotoPaths[] = ImageCompressionHelper::compressAndStore($file, 'donations/sepatu');
                }
            } else {
                $newFotoPaths[] = ImageCompressionHelper::compressAndStore($fotos, 'donations/sepatu');
            }
        }

        // Combine valid remaining existing photos and new photos
        $currentPhotos = $donation->foto_path ?? [];
        $validExisting = array_values(array_intersect($existingPhotos, $currentPhotos));
        $finalFotoPaths = array_merge($validExisting, $newFotoPaths);

        if (count($finalFotoPaths) === 0) {
            throw new \Exception('Sepatu harus memiliki setidaknya satu foto.');
        }

        $updateData['foto_path'] = $finalFotoPaths;

        $donation->update($updateData);

        return $donation;
    }
}
