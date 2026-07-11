<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonationRequest;
use App\Models\DonationItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the donation requests.
     */
    public function index(Request $request)
    {
        $query = DonationItem::whereHas('requests');

        // Apply filters
        // 1. Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhereHas('requests', function ($rq) use ($search) {
                      $rq->where('nama_pemohon', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('kontak_pemohon', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Status filter on requests (has any request with this status)
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->whereHas('requests', function ($rq) use ($status) {
                if ($status === 'disetujui') {
                    $rq->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'dikirim', 'selesai']);
                } else {
                    $rq->where('status', '=', $status);
                }
            });
        }

        // 3. Category filter on item
        if ($request->filled('kategori')) {
            $query->where('kategori', '=', $request->input('kategori'));
        }

        // 4. Tipe Pengaju filter on requests
        if ($request->filled('tipe_pengaju')) {
            $tipe = $request->input('tipe_pengaju');
            $query->whereHas('requests', function ($rq) use ($tipe) {
                if ($tipe === 'registered') {
                    $rq->whereNotNull('user_id');
                } elseif ($tipe === 'guest') {
                    $rq->whereNull('user_id');
                }
            });
        }

        // 5. Date range filter on requests
        if ($request->filled('date_range')) {
            $range = $request->input('date_range');
            $query->whereHas('requests', function ($rq) use ($range) {
                if (str_contains($range, ' to ')) {
                    $parts = explode(' to ', $range);
                    $startDate = trim($parts[0]);
                    $endDate = trim($parts[1]);
                    $rq->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                } else {
                    $date = trim($range);
                    $rq->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59']);
                }
            });
        }

        // Sorting by request creation or items
        $sort = $request->input('sort', 'latest');
        if ($sort === 'oldest') {
            $query->orderBy(
                DonationRequest::select('created_at')
                    ->whereColumn('donation_item_id', 'donation_items.id')
                    ->oldest()
                    ->limit(1),
                'asc'
            );
        } elseif ($sort === 'name_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('nama', 'desc');
        } else {
            $query->orderBy(
                DonationRequest::select('created_at')
                    ->whereColumn('donation_item_id', 'donation_items.id')
                    ->latest()
                    ->limit(1),
                'desc'
            );
        }

        // Paginate donation items having requests
        $items = $query->with(['requests' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }, 'reparationServices.service'])->paginate(10)->withQueryString();

        return view('admin.donation_requests.index', compact('items'));
    }

    /**
     * Update the status of a donation request.
     */
    public function update(Request $request, DonationRequest $donationRequest)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,menunggu_pembayaran,menunggu_verifikasi,diproses,dikirim,ditolak,dibatalkan,selesai'],
        ]);

        try {
            $otherRequests = collect();

            DB::transaction(function () use ($request, $donationRequest, &$otherRequests) {
                $oldStatus = $donationRequest->status;
                $newStatus = $request->status;

                $donationRequest->update(['status' => $newStatus]);

                if ($newStatus === 'dikirim' && $request->has('resi_pengiriman')) {
                    $donationRequest->update(['resi_pengiriman' => $request->resi_pengiriman]);
                }
                
                // If approved (menunggu_pembayaran), lock the item and reject others
                if ($newStatus === 'menunggu_pembayaran') {
                    if ($donationRequest->donationItem) {
                        $donationRequest->donationItem->update(['status' => 'disalurkan']);
                        
                        // Find other pending requests for this item
                        $otherRequests = DonationRequest::where('donation_item_id', $donationRequest->donation_item_id)
                            ->where('id', '!=', $donationRequest->id)
                            ->where('status', 'pending')
                            ->get();
                            
                        // Reject them all
                        foreach ($otherRequests as $otherReq) {
                            $otherReq->update(['status' => 'ditolak']);
                        }
                    }
                }

                // If cancelled or rejected (dibatalkan / ditolak), restore the item to 'tersedia' (available)
                if (in_array($newStatus, ['dibatalkan', 'ditolak'])) {
                    if ($donationRequest->donationItem) {
                        $donationRequest->donationItem->update(['status' => 'tersedia']);
                        if ($donationRequest->donationItem->donation) {
                            $donationRequest->donationItem->donation->update(['status' => 'diterima']);
                        }
                    }
                }
            });

            // Dispatch System Notification to Member
            if ($donationRequest->user) {
                $notifTitle = '';
                $notifMessage = '';
                $notifIcon = 'info';
                $notifType = 'info';

                switch ($request->status) {
                    case 'menunggu_pembayaran':
                        $notifTitle = 'Permohonan Disetujui!';
                        $notifMessage = "Permohonan Anda untuk {$donationRequest->donationItem?->nama} disetujui! Silakan segera selesaikan tagihan/ongkir.";
                        $notifIcon = 'task_alt';
                        $notifType = 'success';
                        break;
                    case 'diproses':
                        $notifTitle = 'Pembayaran Divalidasi';
                        $notifMessage = "Pembayaran Anda untuk {$donationRequest->donationItem?->nama} divalidasi. Sepatu sedang disiapkan.";
                        $notifIcon = 'inventory_2';
                        $notifType = 'info';
                        break;
                    case 'dikirim':
                        $notifTitle = 'Pesanan Dikirim';
                        $notifMessage = "Hore! {$donationRequest->donationItem?->nama} Anda telah dikirim. Lacak sekarang!";
                        $notifIcon = 'local_shipping';
                        $notifType = 'success';
                        break;
                    case 'ditolak':
                    case 'dibatalkan':
                        $notifTitle = 'Permohonan Dibatalkan/Ditolak';
                        $notifMessage = "Maaf, permohonan/tagihan Anda untuk {$donationRequest->donationItem?->nama} telah dibatalkan atau ditolak.";
                        $notifIcon = 'cancel';
                        $notifType = 'error';
                        break;
                }

                if ($notifTitle) {
                    $donationRequest->user->notify(new \App\Notifications\SystemNotification(
                        $notifTitle,
                        $notifMessage,
                        route('member.adoption-requests.index'),
                        $notifIcon,
                        $notifType
                    ));
                }
            }

            $emailMsg = '';

            // Auto-send email notification on approved/invoiced (menunggu_pembayaran)
            if ($request->status === 'menunggu_pembayaran' && !empty($donationRequest->email)) {
                try {
                    Mail::to($donationRequest->email)->send(
                        new \App\Mail\AdoptionApprovedInvoiceMail($donationRequest)
                    );
                    $emailMsg = ' Email tagihan terkirim ke ' . $donationRequest->email . '.';
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send invoice email: ' . $mailEx->getMessage());
                    $emailMsg = ' ⚠️ Gagal mengirim email tagihan ke ' . $donationRequest->email . '.';
                }
            }

            // Auto-send email notification on shipped (dikirim)
            if ($request->status === 'dikirim' && !empty($donationRequest->email)) {
                try {
                    // Send shipped mail
                    Mail::to($donationRequest->email)->send(
                        new \App\Mail\DonationShippedMail($donationRequest)
                    );
                    $emailMsg = ' Email resi pengiriman terkirim ke ' . $donationRequest->email . '.';
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send shipped email: ' . $mailEx->getMessage());
                    $emailMsg = ' ⚠️ Gagal mengirim email resi ke ' . $donationRequest->email . '.';
                }
            }

            // Auto-send email notification on rejection (for the primary request)
            if ($request->status === 'ditolak' && !empty($donationRequest->email)) {
                try {
                    Mail::to($donationRequest->email)->send(
                        new \App\Mail\DonationRequestRejectedMail($donationRequest)
                    );
                    $emailMsg = ' Email notifikasi penolakan terkirim ke ' . $donationRequest->email . '.';
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send rejection email: ' . $mailEx->getMessage());
                    $emailMsg = ' ⚠️ Gagal mengirim email penolakan ke ' . $donationRequest->email . '.';
                }
            }

            // Auto-send rejection email notifications for automatically rejected requests
            $autoRejectedIds = [];
            if ($request->status === 'menunggu_pembayaran' && $otherRequests->isNotEmpty()) {
                $successMailCount = 0;
                foreach ($otherRequests as $otherReq) {
                    $autoRejectedIds[] = $otherReq->id;
                    
                    if ($otherReq->user) {
                        $otherReq->user->notify(new \App\Notifications\SystemNotification(
                            'Permohonan Ditolak',
                            "Maaf, permohonan Anda untuk {$otherReq->donationItem?->nama} tidak terpilih karena barang telah diberikan kepada pemohon lain.",
                            route('member.adoption-requests.index'),
                            'cancel',
                            'error'
                        ));
                    }

                    if (!empty($otherReq->email)) {
                        try {
                            Mail::to($otherReq->email)->send(
                                new \App\Mail\DonationRequestRejectedMail($otherReq)
                            );
                            $successMailCount++;
                        } catch (\Exception $mailEx) {
                            Log::error('Failed to send auto-rejection email to ' . $otherReq->email . ': ' . $mailEx->getMessage());
                        }
                    }
                }
                if ($successMailCount > 0) {
                    $emailMsg .= " {$otherRequests->count()} permohonan lain untuk barang ini otomatis ditolak & {$successMailCount} email penolakan terkirim.";
                } else {
                    $emailMsg .= " {$otherRequests->count()} permohonan lain untuk barang ini otomatis ditolak.";
                }
            }

            $successMsg = 'Status permohonan berhasil diperbarui.' . $emailMsg;

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMsg,
                    'new_status' => $request->status,
                    'auto_rejected_ids' => $autoRejectedIds,
                ]);
            }

            return redirect()->route('admin.donation-requests.index')
                             ->with('success', $successMsg);

        } catch (\Exception $e) {
            Log::error('Admin donation request status update failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem saat memperbarui status permohonan.',
                ], 500);
            }

            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan sistem saat memperbarui status permohonan.');
        }
    }

    /**
     * Manually send approval notification email.
     */
    public function sendApprovalEmail(Request $request, DonationRequest $donationRequest)
    {
        if (empty($donationRequest->email)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Pemohon tidak memiliki alamat email.'], 422);
            }
            return redirect()->route('admin.donation-requests.index')
                             ->with('error', 'Gagal mengirim email: Pemohon tidak memiliki alamat email.');
        }

        try {
            Mail::to($donationRequest->email)->send(
                new \App\Mail\DonationRequestApprovedMail($donationRequest)
            );

            $msg = '✅ Email notifikasi persetujuan berhasil dikirim ke ' . $donationRequest->email;

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $msg]);
            }
            return redirect()->route('admin.donation-requests.index')->with('success', $msg);

        } catch (\Exception $e) {
            Log::error('Failed to send approval email: ' . $e->getMessage());
            $msg = '❌ Gagal mengirim email persetujuan ke ' . $donationRequest->email . '. Silakan periksa konfigurasi SMTP.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 500);
            }
            return redirect()->route('admin.donation-requests.index')->with('error', $msg);
        }
    }

    /**
     * Manually send rejection notification email.
     */
    public function sendRejectionEmail(Request $request, DonationRequest $donationRequest)
    {
        if (empty($donationRequest->email)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Pemohon tidak memiliki alamat email.'], 422);
            }
            return redirect()->route('admin.donation-requests.index')
                             ->with('error', 'Gagal mengirim email: Pemohon tidak memiliki alamat email.');
        }

        try {
            Mail::to($donationRequest->email)->send(
                new \App\Mail\DonationRequestRejectedMail($donationRequest)
            );

            $msg = '✅ Email notifikasi penolakan berhasil dikirim ke ' . $donationRequest->email;

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $msg]);
            }
            return redirect()->route('admin.donation-requests.index')->with('success', $msg);

        } catch (\Exception $e) {
            Log::error('Failed to send rejection email: ' . $e->getMessage());
            $msg = '❌ Gagal mengirim email penolakan ke ' . $donationRequest->email . '. Silakan periksa konfigurasi SMTP.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 500);
            }
            return redirect()->route('admin.donation-requests.index')->with('error', $msg);
        }
    }

    /**
     * Remove the specified donation request.
     */
    public function destroy(Request $request, DonationRequest $donationRequest)
    {
        try {
            DB::transaction(function () use ($donationRequest) {
                // If it was approved, revert the item and donation status back
                if ($donationRequest->status === 'disetujui') {
                    if ($donationRequest->donationItem) {
                        $donationRequest->donationItem->update(['status' => 'tersedia']);
                        if ($donationRequest->donationItem->donation) {
                            $donationRequest->donationItem->donation->update(['status' => 'diterima']);
                        }
                    }
                }
                $donationRequest->delete();
            });

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Permohonan berhasil dihapus.']);
            }

            return redirect()->route('admin.donation-requests.index')
                             ->with('success', 'Permohonan berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Admin donation request deletion failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem saat menghapus permohonan.'], 500);
            }

            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan sistem saat menghapus permohonan.');
        }
    }
}
