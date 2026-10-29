<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\Campaign;
use App\Services\AdoptionService;
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
        $query = DonationItem::visibleInCatalog();

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

        $this->applySizeFilter($query, $request);

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

        if ($request->filled('min_kelayakan')) {
            $minKelayakan = (int) $request->input('min_kelayakan');
            $query->where('score_kelayakan', '>=', $minKelayakan);
        }

        if ($request->filled('max_kelayakan')) {
            $maxKelayakan = (int) $request->input('max_kelayakan');
            $query->where('score_kelayakan', '<=', $maxKelayakan);
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

        $sizeOptions = $this->sizeOptions();

        return view('katalog.index', compact('items', 'categories', 'settings', 'activeCampaigns', 'activeCampaign', 'maxPriceLimit', 'sizeOptions'));
    }

    /**
     * Display the specified donation item detail.
     */
    public function show(DonationItem $item)
    {
        abort_if($item->status === 'arsip', 404);

        $settings = Setting::pluck('value', 'key')->all();
        
        // Fetch 4 other latest donation items, excluding current item, prioritized by status 'tersedia'
        $otherItems = DonationItem::visibleInCatalog()
            ->where((string) 'id', '!=', $item->id)
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

        $curationMode = AdoptionService::curationMode();
        $blockReason = Auth::check() ? $this->newRequestBlockReason($item) : null;
        $hasActiveRequest = $blockReason !== null;

        // Prefill the address from the member's last request that used the structured form
        $lastAddress = Auth::check()
            ? DonationRequest::where('user_id', Auth::id())->whereNotNull('kecamatan')->latest()->first()?->only(DonationRequest::ADDRESS_FIELDS)
            : null;

        $selectedServiceIds = request()->input('services', []);
        $settings = Setting::pluck('value', 'key')->all();
        return view('katalog.request', compact('item', 'settings', 'selectedServiceIds', 'hasActiveRequest', 'blockReason', 'curationMode', 'lastAddress'));
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
        $query = DonationItem::visibleInCatalog();

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

        $this->applySizeFilter($query, $request);

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

        if ($request->filled('min_kelayakan')) {
            $minKelayakan = (int) $request->input('min_kelayakan');
            $query->where('score_kelayakan', '>=', $minKelayakan);
        }

        if ($request->filled('max_kelayakan')) {
            $maxKelayakan = (int) $request->input('max_kelayakan');
            $query->where('score_kelayakan', '<=', $maxKelayakan);
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
            'email' => ['required', 'email', 'max:150'],
            'kontak_pemohon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'alamat_jalan' => ['required', 'string', 'min:5', 'max:255'],
            'alamat_rt_rw' => ['nullable', 'string', 'max:20'],
            'alamat_patokan' => ['nullable', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:100'],
            'kota' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100', function ($attribute, $value, $fail) use ($request) {
                if (!\App\Support\Wilayah::isValid($request->provinsi, $request->kota, $value)) {
                    $fail('Pilih provinsi, kota/kabupaten, dan kecamatan dari daftar.');
                }
            }],
            'kelurahan' => ['required', 'string', 'max:100'],
            'kode_pos' => ['required', 'digits:5'],
            'alasan' => ['required', 'string', 'min:20', 'max:1000'],
            'selected_services' => ['nullable', 'array'],
            'selected_services.*' => ['integer', 'exists:donation_item_services,id'],
        ], [
            'alasan.min' => 'Ceritakan alasan Anda minimal 20 karakter, misalnya sepatu ini untuk siapa dan untuk dipakai apa.',
            'alasan.max' => 'Alasan maksimal 1000 karakter.',
            'alamat_jalan.required' => 'Isi nama jalan dan nomor rumah.',
            'alamat_jalan.min' => 'Nama jalan dan nomor rumah terlalu pendek.',
            'provinsi.required' => 'Pilih provinsi.',
            'kota.required' => 'Pilih kota/kabupaten.',
            'kecamatan.required' => 'Pilih kecamatan.',
            'kelurahan.required' => 'Isi kelurahan/desa.',
            'kode_pos.required' => 'Isi kode pos.',
            'kode_pos.digits' => 'Kode pos terdiri dari 5 angka.',
        ]);

        if ($blockReason = $this->newRequestBlockReason($item)) {
            return redirect()->back()->withInput()->with('error', $blockReason);
        }

        $curationMode = AdoptionService::curationMode();

        try {
            $donationRequest = DB::transaction(function () use ($request, $item, $curationMode) {
                // Normalize phone number prefix to starts with '62'
                $phone = $request->kontak_pemohon;
                $cleaned = preg_replace('/[^0-9]/', '', $phone);
                if (str_starts_with($cleaned, '0')) {
                    $cleaned = '62' . substr($cleaned, 1);
                } elseif (!str_starts_with($cleaned, '62')) {
                    $cleaned = '62' . $cleaned;
                }

                // Curation mode waits for the admin's choice; "siapa cepat" mode issues the invoice right away
                $donationRequest = DonationRequest::create([
                    'donation_item_id' => $item->id,
                    'user_id' => Auth::id(),
                    'nama_pemohon' => $request->nama_pemohon,
                    'email' => $request->email,
                    'kontak_pemohon' => $cleaned,
                    'alamat_pengiriman' => DonationRequest::composeAddress($request->only(DonationRequest::ADDRESS_FIELDS)),
                    ...$request->only(DonationRequest::ADDRESS_FIELDS),
                    'alasan' => $request->alasan,
                    'selected_services' => $request->selected_services ?? [],
                    'status' => $curationMode ? 'pending' : 'menunggu_pembayaran',
                ]);

                return $donationRequest;
            });

            $admins = \App\Models\User::whereIn('role', ['admin', 'super_admin'])->get();
            if ($admins->isNotEmpty()) {
                \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification(
                    'Pengajuan Adopsi Baru!',
                    Auth::user()->name . ' baru saja mengajukan adopsi untuk barang kode: ' . $item->kode_barang . ($curationMode ? '. Menunggu kurasi.' : '.'),
                    route('admin.donation-requests.index'),
                    'shopping_bag',
                    'info'
                ));
            }

            Auth::user()->notify(new \App\Notifications\SystemNotification(
                $curationMode ? 'Pengajuan Adopsi Terkirim' : 'Tagihan Adopsi Terbit',
                $curationMode
                    ? "Pengajuanmu untuk {$item->nama} sedang dikurasi tim kami. Mohon jangan transfer apa pun sebelum terpilih."
                    : "Tagihan adopsi untuk {$item->nama} sudah terbit. Siapa cepat dia dapat, segera selesaikan pembayaran.",
                route('member.adoption-requests.show', $donationRequest->id),
                $curationMode ? 'manage_search' : 'receipt_long',
                'info'
            ));

            // Curation mode: "we received it" email; otherwise the invoice
            if (!empty($request->email)) {
                try {
                    \Illuminate\Support\Facades\Mail::to($request->email)->send(
                        $curationMode
                            ? new \App\Mail\AdoptionSubmittedMail($donationRequest)
                            : new \App\Mail\AdoptionApprovedInvoiceMail($donationRequest)
                    );
                } catch (\Exception $mailEx) {
                    Log::error('Failed to send email after adoption request: ' . $mailEx->getMessage());
                }
            }

            return redirect()->route('member.adoption-requests.index')
                ->with('success', $curationMode
                    ? 'Pengajuan terkirim! Tim kami akan mengkurasi semua pengajuan untuk sepatu ini. Jika Anda terpilih, tagihan dikirim lewat email. Mohon jangan transfer apa pun sebelum terpilih.'
                    : 'Tagihan berhasil dibuat! Silakan cek email Anda untuk detail pembayaran atau langsung upload bukti pembayaran di sini.');

        } catch (\Exception $e) {
            Log::error('Failed to submit donation request: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses permohonan. Silakan coba lagi.');
        }
    }

    /**
     * Why the logged-in member may not request this shoe right now, or null when they may.
     */
    private function newRequestBlockReason(DonationItem $item): ?string
    {
        $mine = DonationRequest::where('user_id', Auth::id());

        if ((clone $mine)->where('donation_item_id', $item->id)->whereIn('status', DonationRequest::ACTIVE_STATUSES)->exists()) {
            return 'Anda sudah mengajukan sepatu ini. Pantau statusnya di halaman Adopsi Saya.';
        }

        if (AdoptionService::curationMode()) {
            $limit = DonationRequest::CURATION_LIMIT;

            return (clone $mine)->where('status', 'pending')->count() >= $limit
                ? "Anda sudah memiliki {$limit} pengajuan yang sedang dikurasi. Tunggu hasil kurasinya dulu sebelum mengajukan sepatu lain."
                : null;
        }

        return (clone $mine)->blockingNewRequests()->exists()
            ? 'Anda masih memiliki permohonan aktif yang belum diselesaikan (menunggu pembayaran / verifikasi). Harap selesaikan terlebih dahulu sebelum mengambil sepatu lain.'
            : null;
    }

    /**
     * Sizes are picked as chips and sent joined by "|", since a size can contain a comma ("36,5").
     */
    private function applySizeFilter($query, Request $request): void
    {
        if (! $request->filled('size')) {
            return;
        }

        $sizes = array_filter(array_map('trim', explode('|', $request->input('size'))), 'strlen');
        if (! empty($sizes)) {
            $query->whereIn('ukuran', $sizes);
        }
    }

    /**
     * Every shoe size currently in the catalog, smallest first. Values outside a
     * realistic shoe range (typos such as "85") are left out of the chips.
     */
    private function sizeOptions(): array
    {
        return DonationItem::visibleInCatalog()
            ->whereNotNull('ukuran')
            ->where('ukuran', '!=', '')
            ->distinct()
            ->pluck('ukuran')
            ->map(fn ($size) => trim($size))
            ->filter(function ($size) {
                $number = (float) str_replace(',', '.', $size);

                return $number >= 15 && $number <= 50;
            })
            ->unique()
            ->sortBy(fn ($size) => (float) str_replace(',', '.', $size))
            ->values()
            ->all();
    }
}
