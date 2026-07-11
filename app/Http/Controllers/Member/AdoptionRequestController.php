<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use Illuminate\Support\Facades\Storage;

class AdoptionRequestController extends Controller
{
    public function index()
    {
        $requests = DonationRequest::with(['donationItem.donation'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('member.adoption_requests.index', compact('requests'));
    }
    public function show(DonationRequest $adoptionRequest)
    {
        if ($adoptionRequest->user_id !== auth()->id()) {
            abort(403);
        }

        $adoptionRequest->load(['donationItem.donation']);

        return view('member.adoption_requests.show', compact('adoptionRequest'));
    }

    public function uploadPayment(Request $request, DonationRequest $adoptionRequest)
    {
        if ($adoptionRequest->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($adoptionRequest->bukti_pembayaran) {
                Storage::disk('public')->delete($adoptionRequest->bukti_pembayaran);
            }
            $path = $request->file('bukti_pembayaran')->store('payments', 'public');
            \Illuminate\Support\Facades\DB::transaction(function () use ($adoptionRequest, $request, $path) {
                // Update current request
                $adoptionRequest->update([
                    'bukti_pembayaran' => $path,
                    'status' => 'menunggu_verifikasi',
                ]);

                // Lock the item (hide from catalog)
                if ($adoptionRequest->donationItem) {
                    $adoptionRequest->donationItem->update(['status' => 'disalurkan']);
                    
                    // Automatically reject all other requests for this item
                    DonationRequest::where('donation_item_id', $adoptionRequest->donation_item_id)
                        ->where('id', '!=', $adoptionRequest->id)
                        ->update(['status' => 'ditolak']);
                }
            });
            
            $admins = \App\Models\User::where('role', 'admin')->get();
            if ($admins->isNotEmpty()) {
                \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification(
                    'Bukti Pembayaran Diunggah!',
                    auth()->user()->name . ' telah mengunggah bukti pembayaran untuk adopsi sepatu.',
                    route('admin.donation-requests.index'),
                    'receipt',
                    'success'
                ));
            }
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }

    public function complete(DonationRequest $adoptionRequest)
    {
        if ($adoptionRequest->user_id !== auth()->id()) {
            abort(403);
        }

        if ($adoptionRequest->status !== 'dikirim') {
            return redirect()->back()->with('error', 'Permohonan belum bisa diselesaikan. Status saat ini: ' . $adoptionRequest->status);
        }

        $adoptionRequest->update(['status' => 'selesai']);

        return redirect()->back()->with('success', 'Terima kasih! Pesanan telah diselesaikan. Sepatu kini resmi menjadi milik Anda.');
    }
}
