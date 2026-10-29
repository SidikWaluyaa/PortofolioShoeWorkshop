<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donation;
use App\Models\DonationRequest;
use App\Models\DonationItem;
use App\Exceptions\AdoptionConflictException;
use App\Http\Controllers\Controller;
use App\Services\AdoptionService;
use Illuminate\Http\Request;
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

        $this->attachMemberHistory($items->getCollection());
        $curationMode = AdoptionService::curationMode();

        return view('admin.donation_requests.index', compact('items', 'curationMode'));
    }

    /**
     * Curation aid: how many shoes each requester has donated (received by the workshop) and adopted.
     */
    private function attachMemberHistory($items): void
    {
        $userIds = $items->flatMap->requests->pluck('user_id')->filter()->unique();
        if ($userIds->isEmpty()) {
            return;
        }

        $donated = Donation::whereIn('user_id', $userIds)
            ->whereIn('status', ['diterima', 'siap_rilis', 'masuk_katalog', 'disalurkan'])
            ->selectRaw('user_id, count(*) as total')
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        $adopted = DonationRequest::whereIn('user_id', $userIds)
            ->whereIn('status', ['diproses', 'dikirim', 'selesai'])
            ->selectRaw('user_id, count(*) as total')
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        foreach ($items as $item) {
            foreach ($item->requests as $request) {
                $request->setAttribute('member_donasi', (int) ($donated[$request->user_id] ?? 0));
                $request->setAttribute('member_adopsi', (int) ($adopted[$request->user_id] ?? 0));
            }
        }
    }

    /**
     * Update the status of a donation request.
     */
    public function update(Request $request, DonationRequest $donationRequest, AdoptionService $adoptionService)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,menunggu_pembayaran,menunggu_verifikasi,diproses,dikirim,ditolak,dibatalkan,selesai'],
            'resi_pengiriman' => ['nullable', 'string', 'max:100'],
        ]);

        $attributes = $request->status === 'dikirim' && $request->filled('resi_pengiriman')
            ? ['resi_pengiriman' => $request->resi_pengiriman]
            : [];

        try {
            $result = $adoptionService->transition($donationRequest, $request->status, $attributes);
        } catch (AdoptionConflictException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
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

        $successMsg = trim(
            ($result['changed'] ? 'Status permohonan berhasil diperbarui.' : 'Data permohonan berhasil disimpan.')
            . ' ' . implode(' ', $result['messages'])
        );

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'new_status' => $request->status,
                'item_status' => $result['item_status'],
                'request_statuses' => $result['requests'],
                'request_deadlines' => DonationRequest::where('donation_item_id', $donationRequest->donation_item_id)
                    ->pluck('batas_bayar', 'id'),
            ]);
        }

        return redirect()->route('admin.donation-requests.index')
                         ->with('success', $successMsg);
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
    public function destroy(Request $request, DonationRequest $donationRequest, AdoptionService $adoptionService)
    {
        try {
            // Releases the shoe back to the catalog if this request was holding it
            $result = $adoptionService->delete($donationRequest);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Permohonan berhasil dihapus.',
                    'item_status' => $result['item_status'],
                    'request_statuses' => $result['requests'],
                ]);
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
