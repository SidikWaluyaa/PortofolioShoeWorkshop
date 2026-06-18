<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonationItem;
use App\Http\Controllers\Controller;
use App\Helpers\ImageCompressionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = DonationItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $brandCol = 'donation_items.brand';
        $kategoriCol = 'donation_items.kategori';
        $statusCol = 'donation_items.status';

        if ($request->filled('brand')) {
            $query->where($brandCol, '=', $request->input('brand'));
        }

        if ($request->filled('kategori')) {
            $query->where($kategoriCol, '=', $request->input('kategori'));
        }

        if ($request->filled('status')) {
            $query->where($statusCol, '=', $request->input('status'));
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        $brands = DonationItem::whereNotNull($brandCol)
            ->where($brandCol, '!=', '')
            ->distinct()
            ->orderBy($brandCol)
            ->pluck($brandCol);

        return view('admin.donation_items.index', compact('items', 'brands'));
    }

    /**
     * Show the form for creating a new donation item.
     */
    public function create()
    {
        $orderCol = 'services.order';
        $services = \App\Models\Service::orderBy($orderCol)->get();
        return view('admin.donation_items.create', compact('services'));
    }

    /**
     * Store a newly created donation item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'brand' => ['nullable', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'in:sepatu,tas,topi'],
            'kondisi' => ['required', 'string', 'in:baru,seperti_baru,sudah_diperbaiki'],
            'ukuran' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'in:tersedia,disalurkan'],
            'deskripsi' => ['nullable', 'string'],
            'foto_utama' => ['required', 'image', 'max:20480'], // Max 20MB
            'foto_detail' => ['nullable', 'array'],
            'foto_detail.*' => ['image', 'max:20480'],
            'berat' => ['nullable', 'integer', 'min:0'],
            'score_kelayakan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'services' => ['nullable', 'array'],
            'services.*.service_id' => ['nullable', 'exists:services,id'],
            'services.*.jasa_nama_manual' => ['nullable', 'string', 'max:150'],
            'services.*.jasa_harga' => ['nullable', 'integer', 'min:0'],
            'services.*.jasa_estimasi_waktu' => ['nullable', 'integer', 'min:0'],
        ]);

        // Store primary photo with compression
        $fotoUtamaPath = '';
        if ($request->hasFile('foto_utama')) {
            $fotoUtamaPath = ImageCompressionHelper::compressAndStore($request->file('foto_utama'), 'katalog');
        }

        // Store detailed photos
        $fotoDetailPaths = [];
        if ($request->hasFile('foto_detail')) {
            foreach ($request->file('foto_detail') as $file) {
                $fotoDetailPaths[] = ImageCompressionHelper::compressAndStore($file, 'katalog');
            }
        }

        $donationItem = DonationItem::create([
            'nama' => $request->nama,
            'brand' => $request->brand,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'ukuran' => $request->ukuran,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'foto_utama_path' => $fotoUtamaPath,
            'foto_detail' => $fotoDetailPaths,
            'berat' => $request->berat,
            'score_kelayakan' => $request->score_kelayakan,
        ]);

        // Save multiple services
        if ($request->filled('services')) {
            foreach ($request->services as $srv) {
                if (!empty($srv['service_id']) || !empty($srv['jasa_nama_manual'])) {
                    $donationItem->reparationServices()->create([
                        'service_id' => $srv['service_id'] ?: null,
                        'jasa_nama_manual' => $srv['jasa_nama_manual'] ?: null,
                        'jasa_harga' => $srv['jasa_harga'] ?? 0,
                        'jasa_estimasi_waktu' => $srv['jasa_estimasi_waktu'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.donation-items.index')
                         ->with('success', 'Barang katalog berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified donation item.
     */
    public function edit(DonationItem $donationItem)
    {
        $orderCol = 'services.order';
        $services = \App\Models\Service::orderBy($orderCol)->get();
        // Load relationships
        $donationItem->load('reparationServices');
        return view('admin.donation_items.edit', compact('donationItem', 'services'));
    }

    /**
     * Update the specified donation item in storage.
     */
    public function update(Request $request, DonationItem $donationItem)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'brand' => ['nullable', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'in:sepatu,tas,topi'],
            'kondisi' => ['required', 'string', 'in:baru,seperti_baru,sudah_diperbaiki'],
            'ukuran' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'in:tersedia,disalurkan'],
            'deskripsi' => ['nullable', 'string'],
            'foto_utama' => ['nullable', 'image', 'max:20480'],
            'foto_detail' => ['nullable', 'array'],
            'foto_detail.*' => ['image', 'max:20480'],
            'berat' => ['nullable', 'integer', 'min:0'],
            'score_kelayakan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'services' => ['nullable', 'array'],
            'services.*.service_id' => ['nullable', 'exists:services,id'],
            'services.*.jasa_nama_manual' => ['nullable', 'string', 'max:150'],
            'services.*.jasa_harga' => ['nullable', 'integer', 'min:0'],
            'services.*.jasa_estimasi_waktu' => ['nullable', 'integer', 'min:0'],
        ]);

        $data = [
            'nama' => $request->nama,
            'brand' => $request->brand,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'ukuran' => $request->ukuran,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'berat' => $request->berat,
            'score_kelayakan' => $request->score_kelayakan,
        ];

        // Replace primary photo if new one uploaded
        if ($request->hasFile('foto_utama')) {
            if ($donationItem->foto_utama_path && Storage::disk('public')->exists($donationItem->foto_utama_path)) {
                Storage::disk('public')->delete($donationItem->foto_utama_path);
            }
            $data['foto_utama_path'] = ImageCompressionHelper::compressAndStore($request->file('foto_utama'), 'katalog');
        }

        // Selectively delete individual detail photos by index
        $currentPaths = $donationItem->foto_detail ?? [];
        if ($request->filled('delete_detail')) {
            $toDelete = array_map('intval', $request->input('delete_detail'));
            foreach ($toDelete as $idx) {
                if (isset($currentPaths[$idx])) {
                    if (Storage::disk('public')->exists($currentPaths[$idx])) {
                        Storage::disk('public')->delete($currentPaths[$idx]);
                    }
                    unset($currentPaths[$idx]);
                }
            }
            // Re-index remaining paths
            $currentPaths = array_values($currentPaths);
        }

        // APPEND new uploaded photos to remaining existing ones (not replace)
        if ($request->hasFile('foto_detail')) {
            $newPaths = [];
            foreach ($request->file('foto_detail') as $file) {
                $newPaths[] = ImageCompressionHelper::compressAndStore($file, 'katalog');
            }
            $currentPaths = array_merge($currentPaths, $newPaths);
        }

        // Always save the final merged list (even if only deletions happened)
        $data['foto_detail'] = $currentPaths;

        $donationItem->update($data);

        // Sync services: delete existing and insert updated list
        $donationItem->reparationServices()->delete();
        if ($request->filled('services')) {
            foreach ($request->services as $srv) {
                if (!empty($srv['service_id']) || !empty($srv['jasa_nama_manual'])) {
                    $donationItem->reparationServices()->create([
                        'service_id' => $srv['service_id'] ?: null,
                        'jasa_nama_manual' => $srv['jasa_nama_manual'] ?: null,
                        'jasa_harga' => $srv['jasa_harga'] ?? 0,
                        'jasa_estimasi_waktu' => $srv['jasa_estimasi_waktu'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.donation-items.index')
                         ->with('success', 'Barang katalog berhasil diperbarui.');
    }

    /**
     * Remove the specified donation item from storage.
     */
    public function destroy(DonationItem $donationItem)
    {
        // Delete primary photo
        if ($donationItem->foto_utama_path && Storage::disk('public')->exists($donationItem->foto_utama_path)) {
            Storage::disk('public')->delete($donationItem->foto_utama_path);
        }

        // Delete detailed photos
        if ($donationItem->foto_detail) {
            foreach ($donationItem->foto_detail as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $donationItem->delete();

        return redirect()->route('admin.donation-items.index')
                         ->with('success', 'Barang katalog berhasil dihapus.');
    }
}
