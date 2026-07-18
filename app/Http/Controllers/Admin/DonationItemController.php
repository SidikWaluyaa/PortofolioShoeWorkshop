<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonationItem;
use App\Http\Controllers\Controller;
use App\Helpers\ImageCompressionHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationItemController extends Controller
{
    protected function getFilteredQuery(Request $request)
    {
        $query = DonationItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('kode_barang', 'like', "%{$search}%")
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

        return $query;
    }

    public function index(Request $request)
    {
        $brandCol = 'donation_items.brand';
        $sortOrder = $request->input('sort', 'desc') === 'asc' ? 'asc' : 'desc';
        $items = $this->getFilteredQuery($request)
            ->orderByRaw("CASE WHEN donation_items.status = 'tersedia' THEN 1 ELSE 2 END")
            ->orderBy('donation_items.id', $sortOrder)
            ->paginate(10)
            ->withQueryString();

        $brands = DonationItem::whereNotNull($brandCol)
            ->where($brandCol, '!=', '')
            ->distinct()
            ->orderBy($brandCol)
            ->pluck($brandCol);

        return view('admin.donation_items.index', compact('items', 'brands'));
    }

    public function exportExcel(Request $request)
    {
        $sortOrder = $request->input('sort', 'desc') === 'asc' ? 'asc' : 'desc';
        $items = $this->getFilteredQuery($request)->orderBy('id', $sortOrder)->get();

        $filename = 'katalog-donasi-' . date('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($items) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Column Headers
            fputcsv($file, [
                'ID',
                'Kode Barang',
                'Nama Barang',
                'Brand',
                'Kategori',
                'Kondisi',
                'Ukuran',
                'Berat',
                'Skor Kelayakan (%)',
                'Status',
                'Jasa Pengerjaan',
                'Total Biaya Jasa',
                'Estimasi Pengerjaan',
                'Deskripsi',
                'Tanggal Ditambahkan',
            ], ',');

            foreach ($items as $item) {
                // Get services details
                $servicesList = $item->reparationServices->map(function ($rs) {
                    return $rs->jasa_nama . ' (' . $rs->jasa_harga_formatted . ')';
                })->implode(', ');

                fputcsv($file, [
                    $item->id,
                    $item->kode_barang ?? '-',
                    $item->nama,
                    $item->brand ?? '-',
                    ucfirst($item->kategori),
                    str_replace('_', ' ', ucfirst($item->kondisi)),
                    $item->ukuran ?? '-',
                    $item->berat_formatted,
                    ($item->score_kelayakan ?? '-') . ($item->score_kelayakan ? '%' : ''),
                    $item->status === 'tersedia' ? 'Tersedia' : 'Sudah Disalurkan',
                    $servicesList ?: '-',
                    $item->jasa_harga_formatted,
                    $item->jasa_estimasi_waktu_formatted,
                    $item->deskripsi ?? '-',
                    $item->created_at->format('Y-m-d H:i:s'),
                ], ',');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $sortOrder = $request->input('sort', 'desc') === 'asc' ? 'asc' : 'desc';
        $items = $this->getFilteredQuery($request)->orderBy('id', $sortOrder)->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.donation_items.pdf', [
            'items' => $items,
            'filters' => [
                'search' => $request->input('search'),
                'brand' => $request->input('brand'),
                'kategori' => $request->input('kategori'),
                'status' => $request->input('status'),
                'sort' => $request->input('sort'),
            ]
        ]);

        $pdf->setPaper('a4', 'landscape');

        $filename = 'katalog-donasi-' . date('Y-m-d-His') . '.pdf';
        return $pdf->stream($filename);
    }

    /**
     * Show the form for creating a new donation item.
     */
    public function create(Request $request)
    {
        $orderCol = 'services.order';
        $services = \App\Models\Service::orderBy($orderCol)->get();
        $donation = null;
        if ($request->has('donation_id')) {
            $donation = \App\Models\Donation::find($request->donation_id);
        }
        return view('admin.donation_items.create', compact('services', 'donation'));
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
            'warna' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'in:tersedia,disalurkan,arsip'],
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
            'services.*.is_mandatory' => ['nullable', 'boolean'],
            'donation_id' => ['nullable', 'exists:donations,id'],
        ]);

        // Store primary photo with compression
        $fotoUtamaPath = '';
        if ($request->hasFile('foto_utama')) {
            $fotoUtamaPath = ImageCompressionHelper::compressAndStore($request->file('foto_utama'), 'katalog', null, true);
        }

        // Store detailed photos
        $fotoDetailPaths = [];
        if ($request->hasFile('foto_detail')) {
            foreach ($request->file('foto_detail') as $file) {
                $fotoDetailPaths[] = ImageCompressionHelper::compressAndStore($file, 'katalog', null, true);
            }
        }

        $donationItem = DonationItem::create([
            'nama' => $request->nama,
            'brand' => $request->brand,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'foto_utama_path' => $fotoUtamaPath,
            'foto_detail' => $fotoDetailPaths,
            'berat' => $request->berat,
            'score_kelayakan' => $request->score_kelayakan,
            'donation_id' => $request->donation_id,
        ]);

        // Auto archive the donation if coming from Dapur Restorasi
        if ($request->donation_id) {
            $donation = \App\Models\Donation::find($request->donation_id);
            if ($donation && $donation->status === 'siap_rilis') {
                app(\App\Services\DonationService::class)->markAsCataloged($donation);
            }
        }

        // Save multiple services
        if ($request->filled('services')) {
            foreach ($request->services as $srv) {
                if (!empty($srv['service_id']) || !empty($srv['jasa_nama_manual'])) {
                    $donationItem->reparationServices()->create([
                        'service_id' => $srv['service_id'] ?: null,
                        'jasa_nama_manual' => $srv['jasa_nama_manual'] ?: null,
                        'jasa_harga' => $srv['jasa_harga'] ?? 0,
                        'jasa_estimasi_waktu' => $srv['jasa_estimasi_waktu'] ?? 0,
                        'is_mandatory' => isset($srv['is_mandatory']) ? filter_var($srv['is_mandatory'], FILTER_VALIDATE_BOOLEAN) : false,
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
            'warna' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'in:tersedia,disalurkan,arsip'],
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
            'services.*.is_mandatory' => ['nullable', 'boolean'],
        ]);

        $data = [
            'nama' => $request->nama,
            'brand' => $request->brand,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'ukuran' => $request->ukuran,
            'warna' => $request->warna,
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
            $data['foto_utama_path'] = ImageCompressionHelper::compressAndStore($request->file('foto_utama'), 'katalog', null, true);
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
                $newPaths[] = ImageCompressionHelper::compressAndStore($file, 'katalog', null, true);
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
                        'is_mandatory' => isset($srv['is_mandatory']) ? filter_var($srv['is_mandatory'], FILTER_VALIDATE_BOOLEAN) : false,
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
