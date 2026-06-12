<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DonationCatalogController extends Controller
{
    /**
     * Display the catalog index inside the donatur panel.
     */
    public function index(Request $request)
    {
        $categories = ['sepatu', 'tas', 'topi'];
        $conditions = ['baru', 'seperti_baru', 'sudah_diperbaiki'];
        
        $query = DonationItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && in_array($request->input('category'), $categories)) {
            $query->where('kategori', $request->input('category'));
        }

        if ($request->filled('condition') && in_array($request->input('condition'), $conditions)) {
            $query->where('kondisi', $request->input('condition'));
        }

        // Available or recently distributed items (available first, then latest)
        $items = $query->orderBy('status', 'desc')
                       ->latest()
                       ->paginate(9);

        $settings = Setting::pluck('value', 'key')->all();

        return view('donatur.katalog.index', compact('items', 'categories', 'settings'));
    }

    /**
     * Filter items for AJAX rendering.
     */
    public function filter(Request $request)
    {
        $categories = ['sepatu', 'tas', 'topi'];
        $conditions = ['baru', 'seperti_baru', 'sudah_diperbaiki'];
        $query = DonationItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && in_array($request->input('category'), $categories)) {
            $query->where('kategori', $request->input('category'));
        }

        if ($request->filled('condition') && in_array($request->input('condition'), $conditions)) {
            $query->where('kondisi', $request->input('condition'));
        }

        $items = $query->orderBy('status', 'desc')
                       ->latest()
                       ->paginate(9);

        return view('donatur.katalog.partials.item-grid', compact('items'))->render();
    }

    /**
     * Handle donation request submission via AJAX.
     */
    public function requestItem(Request $request, DonationItem $item)
    {
        if ($item->status !== 'tersedia') {
            return response()->json([
                'message' => 'Barang ini sudah tidak tersedia atau sudah disalurkan.'
            ], 422);
        }

        $request->validate([
            'nama_pemohon' => ['required', 'string', 'max:150'],
            'kontak_pemohon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat_pengiriman' => ['required', 'string', 'min:10'],
        ]);

        try {
            $donationRequest = DB::transaction(function () use ($request, $item) {
                $phone = $request->kontak_pemohon;
                $cleaned = preg_replace('/[^0-9]/', '', $phone);
                if (str_starts_with($cleaned, '0')) {
                    $cleaned = '62' . substr($cleaned, 1);
                } elseif (!str_starts_with($cleaned, '62')) {
                    $cleaned = '62' . $cleaned;
                }

                return DonationRequest::create([
                    'donation_item_id' => $item->id,
                    'user_id' => Auth::id(),
                    'nama_pemohon' => $request->nama_pemohon,
                    'kontak_pemohon' => $cleaned,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                    'status' => 'pending',
                ]);
            });

            $adminPhoneSetting = Setting::where('key', 'whatsapp_number')->first()?->value ?? '628123456789';
            $adminPhone = preg_replace('/[^0-9]/', '', $adminPhoneSetting);

            $reqCode = 'DRQ-' . str_pad($donationRequest->id, 4, '0', STR_PAD_LEFT);
            $itemUrl = route('katalog.show', $item->id);
            $message = "Halo Admin Shoe Workshop,\n\n"
                     . "Saya ingin mengonfirmasi pengajuan donasi saya dengan ID #{$reqCode}.\n\n"
                     . "📦 *Detail Barang:*\n"
                     . "- Nama  : " . $item->nama . "\n"
                     . "- Kategori : " . ucfirst($item->kategori) . "\n"
                     . "- Link Katalog : " . $itemUrl . "\n\n"
                     . "👤 *Data Pengaju:*\n"
                     . "- Nama     : " . $donationRequest->nama_pemohon . "\n"
                     . "- WhatsApp : +". $donationRequest->kontak_pemohon . "\n"
                     . "- Alamat   : " . $donationRequest->alamat_pengiriman . "\n\n"
                     . "Saya telah melengkapi data di platform. Mohon panduan untuk tahap selanjutnya. Terima kasih! 🙏";

            $waUrl = "https://wa.me/" . $adminPhone . "?text=" . urlencode($message);

            return response()->json([
                'success' => true,
                'redirect_url' => $waUrl,
                'message' => 'Pengajuan donasi berhasil dibuat!'
            ]);

        } catch (\Exception $e) {
            Log::error('Donation request submission failed inside donatur panel: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan sistem saat memproses permohonan Anda. Silakan coba kembali.'
            ], 500);
        }
    }
}
