<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DonationCatalogController extends Controller
{
    /**
     * Display the donation catalog index page.
     */
    public function index(Request $request)
    {
        $categories = ['sepatu', 'tas', 'topi'];
        $conditions = ['baru', 'seperti_baru', 'sudah_diperbaiki'];
        $statuses = ['tersedia', 'disalurkan'];
        
        // Build query for initial render
        $query = DonationItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $selectedCategories = explode(',', $request->input('category'));
            $validCategories = array_intersect($selectedCategories, $categories);
            if (!empty($validCategories)) {
                $query->whereIn('kategori', $validCategories);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->filled('condition') && in_array($request->input('condition'), $conditions)) {
            $query->where((string) 'kondisi', $request->input('condition'));
        }

        if ($request->filled('status') && in_array($request->input('status'), $statuses)) {
            $query->where((string) 'status', $request->input('status'));
        }

        // Include total reparation price sum in query
        $query->withSum('reparationServices as total_reparation_price', 'jasa_harga');

        if ($request->filled('min_price')) {
            $minPrice = (int) $request->input('min_price');
            $query->where(function ($sub) use ($minPrice) {
                $sub->selectRaw('COALESCE(SUM(jasa_harga), 0)')
                    ->from('donation_item_services')
                    ->whereColumn('donation_item_id', 'donation_items.id');
            }, '>=', $minPrice);
        }

        if ($request->filled('max_price')) {
            $maxPrice = (int) $request->input('max_price');
            $query->where(function ($sub) use ($maxPrice) {
                $sub->selectRaw('COALESCE(SUM(jasa_harga), 0)')
                    ->from('donation_item_services')
                    ->whereColumn('donation_item_id', 'donation_items.id');
            }, '<=', $maxPrice);
        }

        // Prioritize status 'tersedia' first, then sort selection
        $query->orderBy((string) 'status', 'desc');

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'harga_termurah') {
                $query->orderBy((string) 'total_reparation_price', 'asc');
            } elseif ($sort === 'harga_termahal') {
                $query->orderBy((string) 'total_reparation_price', 'desc');
            } elseif ($sort === 'rate_kelayakan') {
                $query->orderBy((string) 'score_kelayakan', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $items = $query->paginate(12);

        $settings = Setting::pluck('value', 'key')->all();

        // Calculate dynamic maximum price limit for slider
        $maxPriceDb = (int) DB::table((string) 'donation_item_services')
            ->selectRaw('donation_item_id, SUM(jasa_harga) as total')
            ->groupBy('donation_item_id')
            ->pluck('total')
            ->max() ?? 500000;
        $maxPriceLimit = max($maxPriceDb, 100000);

        // Fetch active campaigns for top of catalog (rendered as carousel slider)
        $activeCampaigns = Campaign::active()->where((string) 'position', 'catalog_top')->get();
        foreach ($activeCampaigns as $campaign) {
            $campaign->increment('views_count');
        }
        $activeCampaign = $activeCampaigns->first(); // Backwards compatibility for tests

        return view('katalog.index', compact('items', 'categories', 'settings', 'activeCampaigns', 'activeCampaign', 'maxPriceLimit'));
    }

    /**
     * Display the specified donation item detail.
     */
    public function show(DonationItem $item)
    {
        $settings = Setting::pluck('value', 'key')->all();
        
        // Fetch 4 other latest donation items, excluding current item, prioritized by status 'tersedia'
        $otherItems = DonationItem::where((string) 'id', '!=', $item->id)
            ->orderBy((string) 'status', 'desc')
            ->latest()
            ->take(4)
            ->get();

        return view('katalog.show', compact('item', 'settings', 'otherItems'));
    }

    /**
     * Show the donation request form for a specific item.
     */
    public function requestForm(DonationItem $item)
    {
        if ($item->status !== 'tersedia') {
            return redirect()->route('katalog.show', $item)
                ->with('error', 'Barang ini sudah tidak tersedia atau sudah disalurkan.');
        }

        $settings = Setting::pluck('value', 'key')->all();
        return view('katalog.request', compact('item', 'settings'));
    }

    /**
     * Show the success page after a donation request.
     */
    public function requestSuccess(DonationItem $item, int $requestId)
    {
        // Retrieve session data from requestItem redirect
        $waUrl      = session('wa_url', '#');
        $reqCode    = session('req_code', '#DRQ-' . $requestId);
        $itemNama   = session('item_nama', $item->nama);
        $itemUrl    = session('item_url', route('katalog.show', $item->id));
        $settings   = Setting::pluck('value', 'key')->all();

        return view('katalog.success', compact('item', 'waUrl', 'reqCode', 'itemNama', 'itemUrl', 'settings'));
    }

    /**
     * Handle AJAX filter and search requests, returning rendered HTML.
     */
    public function filter(Request $request)
    {
        $categories = ['sepatu', 'tas', 'topi'];
        $conditions = ['baru', 'seperti_baru', 'sudah_diperbaiki'];
        $statuses = ['tersedia', 'disalurkan'];
        $query = DonationItem::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $selectedCategories = explode(',', $request->input('category'));
            $validCategories = array_intersect($selectedCategories, $categories);
            if (!empty($validCategories)) {
                $query->whereIn('kategori', $validCategories);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->filled('condition') && in_array($request->input('condition'), $conditions)) {
            $query->where((string) 'kondisi', $request->input('condition'));
        }

        if ($request->filled('status') && in_array($request->input('status'), $statuses)) {
            $query->where((string) 'status', $request->input('status'));
        }

        // Include total reparation price sum in query
        $query->withSum('reparationServices as total_reparation_price', 'jasa_harga');

        if ($request->filled('min_price')) {
            $minPrice = (int) $request->input('min_price');
            $query->where(function ($sub) use ($minPrice) {
                $sub->selectRaw('COALESCE(SUM(jasa_harga), 0)')
                    ->from('donation_item_services')
                    ->whereColumn('donation_item_id', 'donation_items.id');
            }, '>=', $minPrice);
        }

        if ($request->filled('max_price')) {
            $maxPrice = (int) $request->input('max_price');
            $query->where(function ($sub) use ($maxPrice) {
                $sub->selectRaw('COALESCE(SUM(jasa_harga), 0)')
                    ->from('donation_item_services')
                    ->whereColumn('donation_item_id', 'donation_items.id');
            }, '<=', $maxPrice);
        }

        // Prioritize status 'tersedia' first, then sort selection
        $query->orderBy((string) 'status', 'desc');

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'harga_termurah') {
                $query->orderBy((string) 'total_reparation_price', 'asc');
            } elseif ($sort === 'harga_termahal') {
                $query->orderBy((string) 'total_reparation_price', 'desc');
            } elseif ($sort === 'rate_kelayakan') {
                $query->orderBy((string) 'score_kelayakan', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $items = $query->paginate(12);

        // Return the rendered partial HTML grid
        return view('katalog.partials.item-grid', compact('items'))->render();
    }

    /**
     * Submit a request for a donation item.
     */
    public function requestItem(Request $request, DonationItem $item)
    {
        // Check if item is available
        if ($item->status !== 'tersedia') {
            return response()->json([
                'message' => 'Barang ini sudah tidak tersedia atau sudah disalurkan.'
            ], 422);
        }

        // Validate submission
        $request->validate([
            'nama_pemohon' => ['required', 'string', 'max:150'],
            'kontak_pemohon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat_pengiriman' => ['required', 'string', 'min:10'],
        ]);

        try {
            $donationRequest = DB::transaction(function () use ($request, $item) {
                // Normalize phone number prefix to starts with '62'
                $phone = $request->kontak_pemohon;
                $cleaned = preg_replace('/[^0-9]/', '', $phone);
                if (str_starts_with($cleaned, '0')) {
                    $cleaned = '62' . substr($cleaned, 1);
                } elseif (!str_starts_with($cleaned, '62')) {
                    $cleaned = '62' . $cleaned;
                }

                // Create request record
                $donationRequest = DonationRequest::create([
                    'donation_item_id' => $item->id,
                    'user_id' => Auth::id(),
                    'nama_pemohon' => $request->nama_pemohon,
                    'kontak_pemohon' => $cleaned,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                    'status' => 'pending',
                ]);

                return $donationRequest;
            });

            // Get admin WhatsApp setting
            $adminPhoneSetting = Setting::where('key', 'whatsapp_number')->first()?->value ?? '628123456789';
            $adminPhone = preg_replace('/[^0-9]/', '', $adminPhoneSetting);

            // Construct template message for WhatsApp
            $reqCode    = 'DRQ-' . str_pad($donationRequest->id, 4, '0', STR_PAD_LEFT);
            $itemUrl    = route('katalog.show', $item->id);
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

            return redirect()
                ->route('katalog.success', ['item' => $item->id, 'requestId' => $donationRequest->id])
                ->with('wa_url', $waUrl)
                ->with('req_code', '#' . $reqCode)
                ->with('item_nama', $item->nama)
                ->with('item_url', $itemUrl);

        } catch (\Exception $e) {
            Log::error('Donation request submission failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan sistem saat memproses permohonan Anda. Silakan coba kembali.']);
        }
    }
}
