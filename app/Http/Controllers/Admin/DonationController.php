<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Services\DonationService;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function __construct(
        protected DonationService $donationService,
    ) {}

    public function index(Request $request)
    {
        $statusFilter = $request->query('status');
        $donations = $this->donationService->getAllForAdmin(15, $statusFilter);

        return view('admin.donations.index', compact('donations', 'statusFilter'));
    }

    public function show(Donation $donation)
    {
        $donation->load('user', 'verifier');
        return view('admin.donations.show', compact('donation'));
    }

    public function approve(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'foto_bukti' => 'required|image',
            'catatan_admin' => 'nullable|string|max:2000',
            'nama' => 'required|string|max:150',
            'brand' => 'nullable|string|max:100',
            'ukuran' => 'nullable|string|max:50',
            'kategori' => 'required|in:sepatu,tas,topi',
            'kondisi' => 'required|in:baru,seperti_baru,sudah_diperbaiki',
            'deskripsi' => 'nullable|string',
        ]);

        $inspectionData = [
            'nama' => $validated['nama'],
            'brand' => $validated['brand'],
            'ukuran' => $validated['ukuran'],
            'kategori' => $validated['kategori'],
            'kondisi' => $validated['kondisi'],
            'deskripsi' => $validated['deskripsi'] ?? null,
        ];

        $this->donationService->approve(
            $donation,
            $request->file('foto_bukti'),
            $inspectionData,
            $validated['catatan_admin'] ?? null
        );

        $referer = $request->header('referer');
        if ($referer && str_contains($referer, '/admin/donations') && !preg_match('/\/admin\/donations\/\d+/', $referer)) {
            return redirect()->back()->with('success', 'Donasi berhasil disetujui.');
        }

        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'Donasi berhasil disetujui.');
    }

    public function reject(Request $request, Donation $donation)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:2000',
        ]);

        $this->donationService->reject($donation, $request->input('catatan_admin'));

        $referer = $request->header('referer');
        if ($referer && str_contains($referer, '/admin/donations') && !preg_match('/\/admin\/donations\/\d+/', $referer)) {
            return redirect()->back()->with('success', 'Donasi telah ditolak.');
        }

        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'Donasi telah ditolak.');
    }

    public function distribute(Request $request, Donation $donation)
    {
        $this->donationService->markDistributed($donation, $request->input('catatan_admin'));

        $referer = $request->header('referer');
        if ($referer && str_contains($referer, '/admin/donations') && !preg_match('/\/admin\/donations\/\d+/', $referer)) {
            return redirect()->back()->with('success', 'Donasi ditandai sebagai disalurkan.');
        }

        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'Donasi ditandai sebagai disalurkan.');
    }
}
