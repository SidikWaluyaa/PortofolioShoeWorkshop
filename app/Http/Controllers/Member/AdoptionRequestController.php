<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageCompressionHelper;
use App\Exceptions\AdoptionConflictException;
use App\Services\AdoptionService;

class AdoptionRequestController extends Controller
{
    public function index()
    {
        $requests = DonationRequest::with(['donationItem.donation', 'donationItem.reparationServices'])
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

    public function uploadPayment(Request $request, DonationRequest $adoptionRequest, AdoptionService $adoptionService)
    {
        if ($adoptionRequest->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $oldPath = $adoptionRequest->bukti_pembayaran;
            $path = ImageCompressionHelper::compressAndStore($request->file('bukti_pembayaran'), 'payments', null, false, 800, 800);

            // First payer reserves the shoe; the other requesters are put on hold
            try {
                $adoptionService->submitPayment($adoptionRequest, $path);
            } catch (AdoptionConflictException $e) {
                Storage::disk('public')->delete($path);
                return redirect()->back()->with('error', $e->getMessage());
            }

            if ($oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

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

    public function complete(\Illuminate\Http\Request $request, DonationRequest $adoptionRequest, AdoptionService $adoptionService)
    {
        if ($adoptionRequest->user_id !== auth()->id()) {
            abort(403);
        }

        if ($adoptionRequest->status !== 'dikirim') {
            return redirect()->back()->with('error', 'Permohonan belum bisa diselesaikan. Status saat ini: ' . $adoptionRequest->status);
        }

        $request->validate([
            'bukti_penerimaan' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('bukti_penerimaan')) {
            $path = $request->file('bukti_penerimaan')->store('receipts', 'public');
        }

        $adoptionService->transition($adoptionRequest, 'selesai', ['bukti_penerimaan' => $path]);

        // Send Notification to Member
        auth()->user()->notify(new \App\Notifications\SystemNotification(
            'Pesanan Diterima!',
            'Terima kasih telah mengonfirmasi penerimaan paket. Sepatu adopsi kini resmi menjadi milik Anda.',
            route('member.adoption-requests.show', $adoptionRequest->id),
            'check_circle',
            'success'
        ));

        // Send Notification to Admin
        $admins = \App\Models\User::whereIn('role', ['admin', 'super_admin'])->get();
        if ($admins->isNotEmpty()) {
            \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification(
                'Paket Telah Diterima Member',
                auth()->user()->name . ' telah menerima paket dan pesanan otomatis diselesaikan.',
                route('admin.orders.index'),
                'inventory_2',
                'success'
            ));
        }

        return redirect()->back()->with('success', 'Terima kasih! Pesanan telah diselesaikan. Sepatu kini resmi menjadi milik Anda.');
    }
}
