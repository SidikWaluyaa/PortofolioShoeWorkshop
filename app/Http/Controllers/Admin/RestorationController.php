<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Services\DonationService;
use Illuminate\Http\Request;

class RestorationController extends Controller
{
    public function __construct(
        protected DonationService $donationService
    ) {}

    public function index()
    {
        // Ambil donasi yang sedang direstorasi (diterima)
        $inRestoration = Donation::where('status', 'diterima')->orderBy('updated_at', 'desc')->get();
        
        // Ambil donasi yang siap rilis (siap_rilis)
        $readyToPublish = Donation::where('status', 'siap_rilis')->orderBy('updated_at', 'desc')->get();

        return view('admin.restorations.index', compact('inRestoration', 'readyToPublish'));
    }

    public function markReady(Request $request, Donation $donation)
    {
        if ($donation->status !== 'diterima') {
            return back()->with('error', 'Hanya sepatu berstatus diterima yang dapat ditandai selesai restorasi.');
        }

        $this->donationService->markRestorationReady($donation);

        return back()->with('success', 'Sepatu berhasil ditandai selesai restorasi dan pindah ke antrean siap rilis.');
    }

    public function markCataloged(Request $request, Donation $donation)
    {
        if ($donation->status !== 'siap_rilis') {
            return back()->with('error', 'Hanya sepatu berstatus siap rilis yang dapat diarsipkan.');
        }

        $this->donationService->markAsCataloged($donation);

        return back()->with('success', 'Sepatu berhasil diarsipkan dari antrean dapur restorasi.');
    }
}
