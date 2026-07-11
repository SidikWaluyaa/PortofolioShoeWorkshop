<?php

namespace App\Http\Controllers\Member;

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
        return view('member.donations.index', compact('donations'));
    }

    public function create()
    {
        return view('member.donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sepatu' => 'required|string|max:150',
            'ukuran' => 'required|string|max:10',
            'kondisi' => 'required|integer|min:0|max:100',
            'harga' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string|max:2000',
            'foto' => 'required|array',
            'foto.*' => 'image',
        ]);

        $this->donationService->create($validated, $request->file('foto'));

        $admins = \App\Models\User::where('role', 'admin')->get();
        if ($admins->isNotEmpty()) {
            \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification(
                'Donasi Baru Masuk!',
                'Ada pengajuan donasi sepatu baru dari ' . Auth::user()->name . '. Segera cek di halaman donasi.',
                route('admin.donations.index'),
                'volunteer_activism',
                'info'
            ));
        }

        return redirect()->route('member.donations.index')
            ->with('success', 'Donasi sepatu berhasil diajukan! Menunggu verifikasi admin.');
    }

    public function edit(\App\Models\Donation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        if ($donation->status !== 'pending') {
            return redirect()->route('member.donations.index')
                ->with('error', 'Donasi yang sudah diproses tidak dapat diubah.');
        }

        return view('member.donations.edit', compact('donation'));
    }

    public function update(Request $request, \App\Models\Donation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        if ($donation->status !== 'pending') {
            return redirect()->route('member.donations.index')
                ->with('error', 'Donasi yang sudah diproses tidak dapat diubah.');
        }

        $validated = $request->validate([
            'nama_sepatu' => 'required|string|max:150',
            'ukuran' => 'required|string|max:10',
            'kondisi' => 'required|integer|min:0|max:100',
            'harga' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string|max:2000',
            'foto' => 'nullable|array',
            'foto.*' => 'image',
            'existing_photos' => 'nullable|array',
            'existing_photos.*' => 'string',
        ]);

        if ($request->has('existing_photos_present')) {
            $existingPhotos = $request->input('existing_photos', []);
            if (empty($existingPhotos) && !$request->hasFile('foto')) {
                return back()->withErrors(['foto' => 'Sepatu harus memiliki setidaknya satu foto.'])->withInput();
            }
        } else {
            // Backward compatibility: if new photos are uploaded, they replace all old ones.
            // If no new photos are uploaded, we keep the existing ones.
            if ($request->hasFile('foto')) {
                $existingPhotos = [];
            } else {
                $existingPhotos = $donation->foto_path ?? [];
            }
        }

        try {
            $this->donationService->update($donation, $validated, $request->file('foto'), $existingPhotos);
            return redirect()->route('member.donations.index')
                ->with('success', 'Data donasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('member.donations.index')
                ->with('error', $e->getMessage());
        }
    }

    public function updateResi(Request $request, \App\Models\Donation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'metode_pengiriman' => 'required|in:antar_langsung,ekspedisi',
            'nama_ekspedisi' => 'required_if:metode_pengiriman,ekspedisi|nullable|string|max:100',
            'no_resi' => 'required_if:metode_pengiriman,ekspedisi|nullable|string|max:100',
        ]);

        try {
            $this->donationService->updateResi($donation, $validated['metode_pengiriman'], $validated['nama_ekspedisi'] ?? null, $validated['no_resi'] ?? null);
            return redirect()->route('member.donations.index')
                ->with('success', 'Informasi pengiriman berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('member.donations.index')
                ->with('error', $e->getMessage());
        }
    }
}
