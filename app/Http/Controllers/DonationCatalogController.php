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
        $query->orderByRaw("CASE WHEN status = 'tersedia' THEN 1 ELSE 2 END ASC");

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

        if ($item->isQuotaFull()) {
            return redirect()->route('katalog.show', $item)
                ->with('error', 'Kuota pengajuan untuk barang ini sudah penuh.');
        }
        
        $hasActiveRequest = false;
        if (Auth::check()) {
            $hasActiveRequest = \App\Models\DonationRequest::where('user_id', Auth::id())
                ->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi'])
                ->exists();
        }

        $selectedServiceIds = request()->input('services', []);
        $settings = Setting::pluck('value', 'key')->all();
        return view('katalog.request', compact('item', 'settings', 'selectedServiceIds', 'hasActiveRequest'));
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
        $biayaFormatted = session('biaya_formatted', 'Gratis');
        $pemohonNama    = session('pemohon_nama', 'Pemohon');
        $pemohonAlamat  = session('pemohon_alamat', '-');
        $pemohonAlasan  = session('pemohon_alasan', '-');
        $settings   = Setting::pluck('value', 'key')->all();

        return view('katalog.success', compact('item', 'waUrl', 'reqCode', 'itemNama', 'itemUrl', 'biayaFormatted', 'pemohonNama', 'pemohonAlamat', 'pemohonAlasan', 'settings'));
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

        // Check if quota is full
        if ($item->isQuotaFull()) {
            return response()->json([
                'message' => 'Kuota pengajuan untuk barang ini sudah penuh.'
            ], 422);
        }

        // Validate submission
        $request->validate([
            'nama_pemohon' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'kontak_pemohon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat_pengiriman' => ['required', 'string', 'min:10'],
            'alasan' => ['required', 'string'],
            'selected_services' => ['nullable', 'array'],
            'selected_services.*' => ['integer', 'exists:donation_item_services,id'],
        ]);

        // Check if user has an active request (limit 1 active request rule)
        $activeRequestExists = DonationRequest::where('user_id', Auth::id())
            ->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi'])
            ->exists();

        if ($activeRequestExists) {
            return redirect()->back()->withInput()->with('error', 'Anda masih memiliki permohonan aktif yang belum diselesaikan (menunggu pembayaran / verifikasi). Harap selesaikan terlebih dahulu sebelum mengambil sepatu lain.');
        }

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

                // Create request record - Langsung terbit tagihan
                $donationRequest = DonationRequest::create([
                    'donation_item_id' => $item->id,
                    'user_id' => Auth::id(),
                    'nama_pemohon' => $request->nama_pemohon,
                    'email' => $request->email,
                    'kontak_pemohon' => $cleaned,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                    'alasan' => $request->alasan,
                    'selected_services' => $request->selected_services ?? [],
                    'status' => 'menunggu_pembayaran',
                ]);

                return $donationRequest;
            });

            $admins = \App\Models\User::where('role', 'admin')->get();
            if ($admins->isNotEmpty()) {
                \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification(
                    'Pengajuan Adopsi Baru!',
                    Auth::user()->name . ' baru saja mengajukan adopsi untuk barang kode: ' . $item->kode_barang . '.',
                    route('admin.donation-requests.index'),
                    'shopping_bag',
                    'info'
                ));
            }

            // Send Invoice Email to Member
            if (!empty($request->email)) {
                try {
                    \Illuminate\Support\Facades\Mail::to($request->email)->send(
                        new \App\Mail\AdoptionApprovedInvoiceMail($donationRequest)
                    );
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send invoice email during adoption checkout: ' . $mailEx->getMessage());
                }
            }

            // Redirect to Member's Adopsi Saya page to upload receipt immediately
            return redirect()->route('member.adoption-requests.index')
                ->with('success', 'Tagihan berhasil dibuat! Silakan cek email Anda untuk detail pembayaran atau langsung upload bukti pembayaran di sini.');

        } catch (\Exception $e) {
            Log::error('Failed to submit donation request: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses permohonan. Silakan coba lagi.');
        }
    }
}
