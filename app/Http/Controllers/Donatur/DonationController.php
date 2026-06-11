<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Services\DonationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function __construct(
        protected DonationService $donationService,
    ) {}

    public function index()
    {
        $donations = $this->donationService->getByUser(Auth::id());
        return view('donatur.donations.index', compact('donations'));
    }

    public function create()
    {
        return view('donatur.donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sepatu' => 'required|string|max:150',
            'ukuran' => 'required|string|max:10',
            'kondisi' => 'required|integer|min:0|max:100',
            'harga' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string|max:2000',
            'foto' => 'required|image',
            'metode_pengiriman' => 'required|in:antar_langsung,ekspedisi',
            'nama_ekspedisi' => 'nullable|string|max:100',
            'no_resi' => 'nullable|string|max:100',
        ]);

        $this->donationService->create($validated, $request->file('foto'));

        return redirect()->route('donatur.donations.index')
            ->with('success', 'Donasi sepatu berhasil diajukan! Menunggu verifikasi admin.');
    }

    public function updateResi(Request $request, \App\Models\Donation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_ekspedisi' => 'required|string|max:100',
            'no_resi' => 'required|string|max:100',
        ]);

        try {
            $this->donationService->updateResi($donation, $validated['nama_ekspedisi'], $validated['no_resi']);
            return redirect()->route('donatur.donations.index')
                ->with('success', 'Resi pengiriman berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('donatur.donations.index')
                ->with('error', $e->getMessage());
        }
    }
}
