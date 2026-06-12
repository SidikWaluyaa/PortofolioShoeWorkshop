<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the donation requests.
     */
    public function index()
    {
        $requests = DonationRequest::with(['donationItem', 'user'])
                                   ->latest()
                                   ->paginate(10);
                                   
        return view('admin.donation_requests.index', compact('requests'));
    }

    /**
     * Update the status of a donation request.
     */
    public function update(Request $request, DonationRequest $donationRequest)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,disetujui,ditolak'],
        ]);

        try {
            DB::transaction(function () use ($request, $donationRequest) {
                $oldStatus = $donationRequest->status;
                $newStatus = $request->status;

                $donationRequest->update(['status' => $newStatus]);

                // If approved, mark the item as 'disalurkan' (distributed)
                if ($newStatus === 'disetujui') {
                    $donationRequest->donationItem->update(['status' => 'disalurkan']);
                    if ($donationRequest->donationItem->donation) {
                        $donationRequest->donationItem->donation->update(['status' => 'disalurkan']);
                    }
                }
                // If changed back from approved, restore the item to 'tersedia' (available)
                elseif ($oldStatus === 'disetujui' && $newStatus !== 'disetujui') {
                    $donationRequest->donationItem->update(['status' => 'tersedia']);
                    if ($donationRequest->donationItem->donation) {
                        $donationRequest->donationItem->donation->update(['status' => 'diterima']);
                    }
                }
            });

            return redirect()->route('admin.donation-requests.index')
                             ->with('success', 'Status permohonan berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Admin donation request status update failed: ' . $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan sistem saat memperbarui status permohonan.');
        }
    }
}
