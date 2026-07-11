<x-app-layout>
    <x-slot name="header">Kelola Permohonan Barang Donasi</x-slot>

    {{-- Flatpickr Stylesheet --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Custom calendar emerald selection styling */
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.prevMonthDay.selected, .flatpickr-day.nextMonthDay.selected, .flatpickr-day.prevMonthDay.startRange, .flatpickr-day.nextMonthDay.startRange, .flatpickr-day.prevMonthDay.endRange, .flatpickr-day.nextMonthDay.endRange {
            background: #22AF85 !important;
            border-color: #22AF85 !important;
            color: #fff !important;
        }
        .flatpickr-day.inRange {
            background: #e6f7f2 !important;
            box-shadow: -5px 0 0 #e6f7f2, 5px 0 0 #e6f7f2 !important;
        }
        .flatpickr-day.today {
            border-color: #22AF85 !important;
        }
        .flatpickr-day.today:hover {
            background: #22AF85 !important;
            color: #fff !important;
        }
    </style>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <p class="text-sm text-gray-500">Tinjau, setujui, atau tolak permohonan barang donasi dari pengunjung.</p>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6 shadow-sm">
        <form action="{{ route('admin.donation-requests.index') }}" method="GET" class="space-y-4" id="filterForm">
            @php
                $hasFilters = request()->anyFilled(['search', 'status', 'kategori', 'tipe_pengaju', 'date_range']) || request('sort') === 'oldest' || request('sort') === 'name_asc' || request('sort') === 'name_desc';
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                {{-- Search --}}
                <div class="lg:col-span-2">
                    <label for="search" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Cari Pengajuan</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama / email / WA / barang..." class="w-full pl-9 pr-4 py-2.5 text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Status</label>
                    <select name="status" id="status" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                        <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>✅ Disetujui / Diproses</option>
                        <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                        <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>🚫 Dibatalkan</option>
                    </select>
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Kategori Barang</label>
                    <select name="kategori" id="kategori" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="">Semua Kategori</option>
                        <option value="sepatu" {{ request('kategori') === 'sepatu' ? 'selected' : '' }}>👞 Sepatu</option>
                        <option value="tas" {{ request('kategori') === 'tas' ? 'selected' : '' }}>🎒 Tas</option>
                        <option value="topi" {{ request('kategori') === 'topi' ? 'selected' : '' }}>🧢 Topi</option>
                    </select>
                </div>

                {{-- Tipe Pengaju --}}
                <div>
                    <label for="tipe_pengaju" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Tipe Pengaju</label>
                    <select name="tipe_pengaju" id="tipe_pengaju" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="">Semua Pengaju</option>
                        <option value="registered" {{ request('tipe_pengaju') === 'registered' ? 'selected' : '' }}>👤 Terdaftar</option>
                        <option value="guest" {{ request('tipe_pengaju') === 'guest' ? 'selected' : '' }}>👥 Tamu/Guest</option>
                    </select>
                </div>

                {{-- Urutan --}}
                <div>
                    <label for="sort" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Urutan</label>
                    <select name="sort" id="sort" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="latest" {{ request('sort') === 'latest' || !request()->has('sort') ? 'selected' : '' }}>⬇️ Terbaru</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>⬆️ Terlama</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>🔤 Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>🔤 Nama Z-A</option>
                    </select>
                </div>
            </div>

            {{-- Datepicker Row & Preset Shortcuts --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end pt-2 border-t border-gray-50">
                <div>
                    <label for="date_range" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Rentang Tanggal Pengajuan</label>
                    <div class="relative">
                        <input type="text" name="date_range" id="date_range" value="{{ request('date_range') }}" placeholder="Pilih rentang tanggal pengajuan..." class="w-full pl-9 pr-4 py-2.5 text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-white cursor-pointer">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Presets & Action buttons --}}
                <div class="flex flex-wrap items-center gap-2 justify-start md:justify-end">
                    <span class="text-xs font-bold text-gray-400 mr-1">Shortcut:</span>
                    <button type="button" onclick="setPreset('today')" class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-xl text-xs font-bold border border-gray-200 transition">
                        Hari Ini
                    </button>
                    <button type="button" onclick="setPreset('last_7_days')" class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-xl text-xs font-bold border border-gray-200 transition">
                        7 Hari Terakhir
                    </button>
                    <button type="button" onclick="setPreset('this_month')" class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 rounded-xl text-xs font-bold border border-gray-200 transition">
                        Bulan Ini
                    </button>
                    @if($hasFilters)
                        <a href="{{ route('admin.donation-requests.index') }}" class="px-4 py-2.5 border border-gray-200 text-gray-500 rounded-xl text-xs font-bold hover:bg-gray-50 hover:text-gray-700 transition">
                            Reset Filter
                        </a>
                    @endif
                    <button type="submit" class="px-4 py-2.5 bg-[#22AF85] hover:bg-[#1a936f] text-white rounded-xl text-xs font-bold transition shadow-sm">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            {{-- Active Badges & Global Reset --}}
            @if($hasFilters)
                <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-gray-50">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-wider mr-1">Filter Aktif:</span>
                    
                    @if(request()->filled('search'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-gray-100 text-xs font-bold text-gray-700">
                            Cari: "{{ request('search') }}"
                            <button type="button" onclick="removeFilter('search')" class="text-gray-400 hover:text-gray-600">&times;</button>
                        </span>
                    @endif

                    @if(request()->filled('status'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-gray-100 text-xs font-bold text-gray-700">
                            Status: {{ request('status') === 'pending' ? 'Menunggu' : (request('status') === 'disetujui' ? 'Disetujui/Diproses' : (request('status') === 'dibatalkan' ? 'Dibatalkan' : 'Ditolak')) }}
                            <button type="button" onclick="removeFilter('status')" class="text-gray-400 hover:text-gray-600">&times;</button>
                        </span>
                    @endif

                    @if(request()->filled('kategori'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-gray-100 text-xs font-bold text-gray-700">
                            Kategori: {{ ucfirst(request('kategori')) }}
                            <button type="button" onclick="removeFilter('kategori')" class="text-gray-400 hover:text-gray-600">&times;</button>
                        </span>
                    @endif

                    @if(request()->filled('tipe_pengaju'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-gray-100 text-xs font-bold text-gray-700">
                            Pengaju: {{ request('tipe_pengaju') === 'registered' ? 'Terdaftar' : 'Tamu/Guest' }}
                            <button type="button" onclick="removeFilter('tipe_pengaju')" class="text-gray-400 hover:text-gray-600">&times;</button>
                        </span>
                    @endif

                    @if(request()->filled('date_range'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-gray-100 text-xs font-bold text-gray-700">
                            Tanggal: {{ request('date_range') }}
                            <button type="button" onclick="removeFilter('date_range')" class="text-gray-400 hover:text-gray-600">&times;</button>
                        </span>
                    @endif

                    @if(request('sort') && request('sort') !== 'latest')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-gray-100 text-xs font-bold text-gray-700">
                            Urutan: {{ request('sort') === 'oldest' ? 'Terlama' : (request('sort') === 'name_asc' ? 'A-Z' : (request('sort') === 'name_desc' ? 'Z-A' : '')) }}
                            <button type="button" onclick="removeFilter('sort')" class="text-gray-400 hover:text-gray-600">&times;</button>
                        </span>
                    @endif

                    <a href="{{ route('admin.donation-requests.index') }}" class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline underline-offset-4 ml-1">
                        Hapus Semua Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-medium">{{ session('error') }}</div>
    @endif

    <!-- Main List (Donation Items) -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                        <th class="px-6 py-4">Barang Donasi</th>
                        <th class="px-6 py-4">Kode Barang</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4 text-center">Ringkasan Pengaju</th>
                        <th class="px-6 py-4 text-center">Status Barang</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($items as $index => $item)
                    <tr class="hover:bg-slate-50/70 transition cursor-pointer" onclick="openDrawer({{ $index }})" id="item-row-{{ $item->id }}">
                        {{-- Info Barang --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-xl object-cover border border-gray-100 bg-gray-50 flex-shrink-0">
                                <div>
                                    <p class="font-bold text-gray-950 leading-tight">{{ $item->nama }}</p>
                                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">Brand: {{ $item->brand ?? '-' }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Kode --}}
                        <td class="px-6 py-4 font-mono text-xs font-bold text-gray-700">
                            {{ $item->kode_barang }}
                        </td>

                        {{-- Kategori --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                {{ ucfirst($item->kategori) }}
                            </span>
                        </td>

                        {{-- Summary Badges --}}
                        <td class="px-6 py-4 text-center">
                            @php
                                $pendingCount = $item->requests->where('status', 'pending')->count();
                                $approvedCount = $item->requests->where('status', 'disetujui')->count();
                                $rejectedCount = $item->requests->where('status', 'ditolak')->count();
                            @endphp
                            <div class="flex items-center justify-center gap-1.5 flex-wrap" id="summary-badges-{{ $item->id }}">
                                <span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $item->requests->count() }} Pengaju
                                </span>
                                @if($pendingCount > 0)
                                    <span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                        {{ $pendingCount }} Menunggu
                                    </span>
                                @endif
                                @if($item->requests->whereIn('status', ['menunggu_pembayaran', 'menunggu_verifikasi'])->count() > 0)
                                    <span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-purple-50 text-purple-700 border border-purple-100">
                                        Menunggu Bayar/Validasi
                                    </span>
                                @elseif($item->requests->whereIn('status', ['diproses', 'dikirim', 'selesai'])->count() > 0)
                                    <span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Lunas & Diproses
                                    </span>
                                @endif
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 text-center" id="item-status-{{ $item->id }}">
                            @if($item->status === 'disalurkan')
                                <span class="px-2 py-0.5 rounded-lg bg-gray-100 text-gray-500 text-xs font-bold border border-gray-200">Disalurkan</span>
                            @else
                                <span class="px-2 py-0.5 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200">Tersedia</span>
                            @endif
                        </td>

                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#22AF85] hover:bg-[#1a936f] text-white text-xs font-bold rounded-xl transition shadow-sm" onclick="event.stopPropagation(); openDrawer({{ $index }})">
                                Tinjau Pengaju
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <span class="material-symbols-outlined !text-[48px] text-gray-200 block mb-2">inbox</span>
                            Belum ada permohonan barang donasi masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $items->links() }}
        </div>
        @endif
    </div>

    <!-- Sliding Side Drawer Panel -->
    <div id="drawer-backdrop" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[80] hidden opacity-0 transition-opacity duration-300 ease-out" onclick="closeDrawer()"></div>
    
    <div id="detail-drawer" class="fixed top-0 right-0 h-full w-full max-w-xl bg-white shadow-2xl z-[90] transform translate-x-full transition-transform duration-300 ease-out flex flex-col">
        <!-- Drawer Header -->
        <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <div class="flex items-center gap-3">
                <img id="drawer-item-img" src="" alt="" class="w-12 h-12 rounded-xl object-cover border border-gray-150 bg-white flex-shrink-0">
                <div>
                    <h3 id="drawer-item-name" class="font-black text-gray-950 text-base leading-snug">Nama Barang</h3>
                    <p id="drawer-item-meta" class="text-xs text-gray-500 mt-0.5 font-medium"></p>
                </div>
            </div>
            <button onclick="closeDrawer()" class="p-2 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Drawer Body -->
        <div id="drawer-body" class="p-6 overflow-y-auto flex-1 flex flex-col gap-5 bg-slate-50/50">
            <!-- Populated via Javascript -->
        </div>
    </div>

    {{-- Toast Notification Container --}}
    <div id="toast-container" class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none" style="max-width: 420px;"></div>

    {{-- Material Icons Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL,GRAD,opsz,wght@0,0,24,400" />

    {{-- Flatpickr Library & Script initialization --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const csrfToken = '{{ csrf_token() }}';
        let pickerInstance;
        
        // Pass complete blade database collection to JavaScript safely
        const itemsData = @json($items->items());
        let currentItemIndex = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr range selector
            pickerInstance = flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "j F Y",
                conjunction: " to ",
                locale: {
                    rangeSeparator: " to "
                }
            });

            // Automatically submit when dropdowns change
            const selects = ['status', 'kategori', 'tipe_pengaju', 'sort'];
            selects.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('change', () => {
                        document.getElementById('filterForm').submit();
                    });
                }
            });
        });

        // ─── Drawer Management ───────────────────────────────────────
        function openDrawer(index) {
            currentItemIndex = index;
            const item = itemsData[index];
            if (!item) return;

            // Populate header
            document.getElementById('drawer-item-img').src = item.foto_utama_url;
            document.getElementById('drawer-item-name').textContent = item.nama;
            document.getElementById('drawer-item-meta').innerHTML = `
                Brand: <strong class="text-gray-700">${item.brand || '-'}</strong> | 
                Kategori: <strong class="text-gray-700">${item.kategori.toUpperCase()}</strong> | 
                Kode: <strong class="text-gray-700 font-mono">${item.kode_barang}</strong>
            `;

            renderDrawerRequests(item.requests, item);

            // Open Backdrop & Drawer Panel
            const backdrop = document.getElementById('drawer-backdrop');
            const drawer = document.getElementById('detail-drawer');
            
            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
            }, 10);
        }

        function closeDrawer() {
            const backdrop = document.getElementById('drawer-backdrop');
            const drawer = document.getElementById('detail-drawer');

            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');

            setTimeout(() => {
                backdrop.classList.add('hidden');
                currentItemIndex = null;
            }, 300);
        }

        // Render applicant list in drawer body dynamically
        function renderDrawerRequests(requests, item) {
            const itemName = item.nama;
            const body = document.getElementById('drawer-body');
            body.innerHTML = '';

            if (!requests || requests.length === 0) {
                body.innerHTML = `
                    <div class="text-center py-12 text-gray-400">
                        <span class="material-symbols-outlined text-4xl mb-2">drafts</span>
                        <p class="text-xs">Tidak ada pengajuan untuk barang ini.</p>
                    </div>
                `;
                return;
            }

            requests.forEach(req => {
                // Color mapping for request statuses
                const colors = {
                    pending: 'bg-gray-100 text-gray-700 border-gray-200',
                    menunggu_pembayaran: 'bg-amber-100 text-amber-700 border-amber-200',
                    menunggu_verifikasi: 'bg-purple-100 text-purple-700 border-purple-200',
                    diproses: 'bg-blue-100 text-blue-700 border-blue-200',
                    dikirim: 'bg-emerald-100 text-emerald-700 border-emerald-200',
                    ditolak: 'bg-red-50 text-red-500 border-red-100',
                    dibatalkan: 'bg-red-100 text-red-700 border-red-200',
                    selesai: 'bg-blue-100 text-blue-700 border-blue-200'
                };
                const labels = { 
                    pending: 'Menunggu', 
                    menunggu_pembayaran: 'Tagihan Dikirim', 
                    menunggu_verifikasi: 'Cek Pembayaran',
                    diproses: 'Diproses',
                    dikirim: 'Dikirim',
                    ditolak: 'Ditolak',
                    dibatalkan: 'Dibatalkan',
                    selesai: 'Selesai'
                };
                const badgeColor = colors[req.status] || 'bg-gray-50 text-gray-500';
                const labelText = labels[req.status] || req.status;

                // Format timestamp
                const dateOpts = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                const timeStr = new Date(req.created_at).toLocaleDateString('id-ID', dateOpts) + ' WIB';

                // WhatsApp template prefilled messages
                const approveMsg = `Halo ${req.nama_pemohon},\n\nPengajuan Anda untuk mendapatkan barang donasi *${itemName}* telah kami *SETUJUI*. Barang akan segera disiapkan untuk pengiriman ke alamat:\n\n${req.alamat_pengiriman}\n\nKami akan menginfokan resi pengiriman segera setelah paket diserahkan ke ekspedisi. Terima kasih!`;
                const rejectMsg = `Halo ${req.nama_pemohon},\n\nTerima kasih telah mengajukan permohonan untuk barang donasi *${itemName}*.\n\nMohon maaf, setelah melakukan verifikasi data, permohonan Anda belum dapat kami setujui saat ini. Anda dapat mencoba mengajukan permohonan untuk barang lain yang tersedia di katalog kami.\n\nTerima kasih atas pengertiannya.`;
                
                const waApproveUrl = `https://wa.me/${req.kontak_pemohon}?text=${encodeURIComponent(approveMsg)}`;
                const waRejectUrl = `https://wa.me/${req.kontak_pemohon}?text=${encodeURIComponent(rejectMsg)}`;

                // Generate Jasa & Biaya HTML
                let servicesHtml = '';
                let totalBiaya = 0;
                if (req.selected_services && req.selected_services.length > 0) {
                    let rowsHtml = '';
                    req.selected_services.forEach(srvId => {
                        const srv = item.reparation_services.find(s => s.id == srvId);
                        if (srv) {
                            totalBiaya += parseInt(srv.jasa_harga || 0);
                            const priceFormatted = 'Rp ' + parseInt(srv.jasa_harga || 0).toLocaleString('id-ID');
                            rowsHtml += `
                                <div class="flex justify-between items-center py-1.5 border-b border-gray-100 last:border-0">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] text-gray-500">•</span>
                                        <span class="text-xs text-gray-700 font-bold">${srv.jasa_nama_manual || (srv.service ? srv.service.name : 'Layanan')}</span>
                                        ${srv.is_mandatory ? '<span class="px-1.5 py-0.5 bg-red-50 text-red-600 rounded text-[9px] font-bold uppercase">Wajib</span>' : ''}
                                    </div>
                                    <span class="text-xs font-bold text-[#22AF85]">${priceFormatted}</span>
                                </div>
                            `;
                        }
                    });
                    
                    if (rowsHtml !== '') {
                        const grandTotalFmt = 'Rp ' + totalBiaya.toLocaleString('id-ID');
                        servicesHtml = `
                            <div class="text-xs text-gray-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                                <p class="font-bold text-gray-400 text-[10px] uppercase tracking-wider mb-2">Ringkasan Jasa & Biaya</p>
                                <div class="bg-white rounded-lg border border-gray-100 p-2.5 mb-2">
                                    ${rowsHtml}
                                </div>
                                <div class="flex justify-between items-center mt-1 px-1">
                                    <span class="text-xs font-black text-gray-800">Grand Total</span>
                                    <span class="text-sm font-black text-[#22AF85]">${grandTotalFmt}</span>
                                </div>
                            </div>
                        `;
                    }
                } else {
                    servicesHtml = `
                        <div class="text-xs text-gray-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                            <p class="font-bold text-gray-400 text-[10px] uppercase tracking-wider mb-1">Ringkasan Jasa & Biaya</p>
                            <p class="italic text-gray-500 font-medium text-xs">Tidak ada jasa tambahan yang dipilih.</p>
                        </div>
                    `;
                }

                const reqCard = document.createElement('div');
                reqCard.id = `req-card-${req.id}`;
                reqCard.className = `p-5 rounded-2xl bg-white border border-gray-100 shadow-sm transition hover:shadow-md flex flex-col gap-4`;
                
                reqCard.innerHTML = `
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">${timeStr}</span>
                            <h4 class="font-bold text-gray-900 text-sm mt-0.5">${req.nama_pemohon}</h4>
                            <div class="flex flex-col gap-0.5 mt-1 text-[11px] text-gray-500">
                                <span>Hub: <strong>+${req.kontak_pemohon}</strong></span>
                                <span>Email: <strong>${req.email || '-'}</strong></span>
                            </div>
                            ${req.user_id ? `
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 mt-1.5 rounded bg-gray-50 text-[9px] text-gray-500 font-semibold border border-gray-200">
                                    👤 Terdaftar (ID: ${req.user_id})
                                </span>
                            ` : ''}
                        </div>
                        <span id="badge-${req.id}" class="px-2.5 py-1 rounded-lg text-[10px] font-black border ${badgeColor}">
                            ${labelText}
                        </span>
                    </div>

                    <div class="text-xs text-gray-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                        <p class="font-bold text-gray-400 text-[10px] uppercase tracking-wider mb-1">Alasan Pengajuan</p>
                        <p class="italic text-gray-800 leading-relaxed font-medium">"${req.alasan || '-'}"</p>
                    </div>

                    ${servicesHtml}

                    <div class="text-xs text-gray-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                        <p class="font-bold text-gray-400 text-[10px] uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                        <p class="text-gray-800 leading-relaxed font-medium">${req.alamat_pengiriman}</p>
                    </div>

                    {{-- Actions and Links --}}
                    <div class="pt-3 border-t border-gray-100 flex flex-col gap-2.5">
                        
                        ${req.bukti_pembayaran ? `
                            <div class="flex items-center gap-2 bg-purple-50 p-2.5 rounded-xl border border-purple-100 mb-1">
                                <a href="/storage/${req.bukti_pembayaran}" target="_blank" class="text-xs font-bold text-purple-700 hover:underline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">receipt_long</span> Lihat Bukti Transfer Member
                                </a>
                            </div>
                        ` : ''}
                        
                        ${req.resi_pengiriman ? `
                            <div class="flex items-center gap-2 bg-emerald-50 p-2.5 rounded-xl border border-emerald-100 mb-1">
                                <span class="text-xs font-bold text-emerald-700 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">local_shipping</span> Resi: <span class="font-mono bg-white px-2 py-0.5 rounded border border-emerald-200 ml-1">${req.resi_pengiriman}</span>
                                </span>
                            </div>
                        ` : ''}

                        <div class="flex flex-wrap items-center gap-2" id="controls-${req.id}">
                            ${req.status === 'menunggu_verifikasi' ? `
                                <button onclick="ajaxUpdateStatus(${req.id}, 'diproses', this)" class="px-2.5 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-bold transition shadow-sm shadow-purple-200">Validasi Struk (Valid)</button>
                                <button onclick="if(confirm('Tolak struk ini? Sepatu akan dikembalikan ke Katalog.')) ajaxUpdateStatus(${req.id}, 'ditolak', this)" class="px-2.5 py-1.5 bg-white border border-purple-200 hover:bg-purple-50 text-purple-700 rounded-lg text-xs font-bold transition">Tolak Struk (Palsu)</button>
                            ` : ''}

                            ${['menunggu_pembayaran', 'menunggu_verifikasi'].includes(req.status) ? `
                                <button onclick="if(confirm('Apakah Anda yakin membatalkan permohonan ini? Sepatu akan kembali ke Katalog.')) ajaxUpdateStatus(${req.id}, 'dibatalkan', this)" class="px-2.5 py-1 bg-red-50 hover:bg-red-100 text-red-600 border border-red-100 rounded-lg text-xs font-bold transition ml-auto">Batalkan Pesanan</button>
                            ` : ''}

                            ${['diproses', 'dikirim', 'selesai'].includes(req.status) ? `
                                <div class="w-full bg-blue-50 text-blue-700 px-3 py-2 rounded-lg text-[11px] font-bold border border-blue-100 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[14px]">info</span>
                                    Kelola pesanan ini (input resi & penyelesaian) di menu <strong>Pesanan & Pengiriman</strong>.
                                </div>
                            ` : ''}
                        </div>

                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 pt-1.5">
                            <div class="flex items-center gap-1.5">
                                <a href="https://wa.me/${req.kontak_pemohon}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-bold text-gray-500 hover:text-[#22AF85] transition">
                                    <svg class="w-3.5 h-3.5 text-[#22AF85]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.004 2C6.51 2 2.014 6.5 2.014 12c0 2.14.675 4.15 1.875 5.8l-1.378 4.63a1 1 0 0 0 1.22 1.23l4.735-1.39A9.97 9.97 0 0 0 12.004 22c5.495 0 9.991-4.5 9.991-10S17.499 2 12.004 2zm5.728 14.1c-.247.7-1.42 1.28-1.95 1.34c-.48.06-1.1.08-3.19-.78c-2.67-1.1-4.39-3.8-4.52-3.98c-.13-.18-1.09-1.45-1.09-2.77c0-1.32.69-1.97.94-2.23c.25-.26.54-.33.72-.33c.18 0 .36.01.52.02c.17.01.39-.06.61.47c.23.55.78 1.91.85 2.05c.07.14.12.31.02.51c-.1.2-.15.33-.3.5c-.15.17-.32.39-.46.52c-.15.15-.31.31-.13.62c.18.3.79 1.3 1.7 2.11c1.17 1.04 2.16 1.37 2.47 1.52c.31.15.49.13.67-.08c.18-.21.78-.91.99-1.22c.21-.31.42-.26.7-.15c.28.11 1.77.83 2.08.99c.3.16.51.24.59.37c.07.13.07.76-.17 1.46z"/></svg>
                                    Chat WA
                                </a>
                                ${req.status === 'disetujui' ? `
                                    <span class="text-gray-300">|</span>
                                    <a href="${waApproveUrl}" target="_blank" class="text-[11px] font-extrabold text-emerald-600 hover:underline">Template Setuju</a>
                                ` : ''}
                                ${req.status === 'ditolak' ? `
                                    <span class="text-gray-300">|</span>
                                    <a href="${waRejectUrl}" target="_blank" class="text-[11px] font-extrabold text-red-500 hover:underline">Template Tolak</a>
                                ` : ''}
                            </div>

                            ${req.email ? `
                                <div class="flex items-center gap-1.5" id="email-btns-${req.id}">
                                    <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    ${req.status === 'disetujui' ? `
                                        <button onclick="if(confirm('Kirim email notifikasi persetujuan ke ${req.email}?')) ajaxSendEmail(${req.id}, 'approval', this)" class="text-[11px] font-extrabold text-emerald-600 hover:underline hover:text-emerald-800 transition">Kirim Email Setuju</button>
                                    ` : ''}
                                    ${req.status === 'ditolak' ? `
                                        <button onclick="if(confirm('Kirim email notifikasi penolakan ke ${req.email}?')) ajaxSendEmail(${req.id}, 'rejection', this)" class="text-[11px] font-extrabold text-red-500 hover:underline hover:text-red-700 transition">Kirim Email Tolak</button>
                                    ` : ''}
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
                body.appendChild(reqCard);
            });
        }

        // ─── Toast Notification ───────────────────────────────────────
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const colors = {
                success: 'bg-emerald-600',
                error: 'bg-red-600',
                warning: 'bg-amber-500',
                info: 'bg-slate-700'
            };

            const icons = {
                success: '✅',
                error: '❌',
                warning: '⚠️',
                info: 'ℹ️'
            };

            toast.className = `pointer-events-auto flex items-start gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white text-sm font-medium ${colors[type] || colors.info} transform translate-x-full opacity-0 transition-all duration-300 ease-out`;
            toast.innerHTML = `
                <span class="text-lg flex-shrink-0 mt-0.5">${icons[type] || icons.info}</span>
                <span class="leading-relaxed flex-1">${message}</span>
                <button onclick="this.parentElement.remove()" class="text-white/70 hover:text-white text-lg font-bold flex-shrink-0 ml-2">&times;</button>
            `;
            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            });

            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 6000);
        }

        // ─── Sync changes from JS Memory back to Main Table UI ─────────
        function syncItemRow(index) {
            const item = itemsData[index];
            if (!item) return;

            // Update status badge
            const statusCell = document.getElementById(`item-status-${item.id}`);
            if (statusCell) {
                if (item.status === 'disalurkan') {
                    statusCell.innerHTML = `<span class="px-2 py-0.5 rounded-lg bg-gray-100 text-gray-500 text-xs font-bold border border-gray-200">Disalurkan</span>`;
                } else {
                    statusCell.innerHTML = `<span class="px-2 py-0.5 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200">Tersedia</span>`;
                }
            }

            // Update summary badges
            const summaryCell = document.getElementById(`summary-badges-${item.id}`);
            if (summaryCell) {
                const total = item.requests.length;
                const pending = item.requests.filter(r => r.status === 'pending').length;
                const active = item.requests.filter(r => ['menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'dikirim'].includes(r.status)).length;

                let badgesHtml = `<span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">${total} Pengaju</span>`;
                if (pending > 0) {
                    badgesHtml += ` <span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">${pending} Menunggu</span>`;
                }
                if (active > 0) {
                    badgesHtml += ` <span class="px-2 py-0.5 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Ada Terpilih</span>`;
                }
                summaryCell.innerHTML = badgesHtml;
            }
        }

        // ─── AJAX: Update Status ──────────────────────────────────────
        async function ajaxUpdateStatus(id, newStatus, btn) {
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = '⏳';

            try {
                const payload = { status: newStatus };
                if (newStatus === 'dikirim' && window.tempResiValue) {
                    payload.resi_pengiriman = window.tempResiValue;
                    window.tempResiValue = null;
                }

                const res = await fetch(`/admin/donation-requests/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (data.success) {
                    showToast(data.message, 'success');
                    
                    // Update state in JS memory
                    if (currentItemIndex !== null) {
                        const item = itemsData[currentItemIndex];
                        
                        // Update status of targeted request
                        const req = item.requests.find(r => r.id === id);
                        if (req) req.status = newStatus;

                        // If approved, update item status to disalurkan
                        if (newStatus === 'menunggu_pembayaran') {
                            item.status = 'disalurkan';
                        } else if (newStatus === 'dibatalkan') {
                            // Revert item status to tersedia if no approved requests exist
                            const hasActive = item.requests.some(r => ['menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'dikirim'].includes(r.status));
                            if (!hasActive) item.status = 'tersedia';
                        }

                        // Auto-rejections implementation: If current was approved, update other pending requests to 'ditolak'
                        if (newStatus === 'menunggu_pembayaran' && data.auto_rejected_ids && data.auto_rejected_ids.length > 0) {
                            item.requests.forEach(r => {
                                if (data.auto_rejected_ids.includes(r.id)) {
                                    r.status = 'ditolak';
                                }
                            });
                        }

                        // Re-render drawer and sync main list row
                        renderDrawerRequests(item.requests, item);
                        syncItemRow(currentItemIndex);
                    }
                } else {
                    showToast(data.message || 'Terjadi kesalahan.', 'error');
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            } catch (err) {
                showToast('Koneksi gagal. Silakan coba lagi.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        async function promptInputResi(id) {
            const resi = prompt('Masukkan Nomor Resi Ekspedisi (JNE/JNT/dll):');
            if (!resi) return;
            
            // Cari element tombol yang di-click
            const btn = event.currentTarget;
            window.tempResiValue = resi;
            await ajaxUpdateStatus(id, 'dikirim', btn);
        }

        // ─── AJAX: Send Email ─────────────────────────────────────────
        async function ajaxSendEmail(id, type, btn) {
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = '⏳ Mengirim...';

            const url = type === 'approval'
                ? `/admin/donation-requests/${id}/send-approval-email`
                : `/admin/donation-requests/${id}/send-rejection-email`;

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await res.json();

                if (data.success) {
                    showToast(data.message, 'success');
                    btn.textContent = '✅ Terkirim';
                    btn.classList.remove('text-emerald-600', 'text-red-500');
                    btn.classList.add('text-gray-400');
                    setTimeout(() => {
                        btn.textContent = originalText;
                        btn.disabled = false;
                        btn.classList.remove('text-gray-400');
                        if (type === 'approval') btn.classList.add('text-emerald-600');
                        else btn.classList.add('text-red-500');
                    }, 3000);
                } else {
                    showToast(data.message || 'Gagal mengirim email.', 'error');
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            } catch (err) {
                showToast('Koneksi gagal. Silakan coba lagi.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // ─── AJAX: Delete Request ─────────────────────────────────────
        async function ajaxDelete(id, btn) {
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = '⏳';

            try {
                const res = await fetch(`/admin/donation-requests/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await res.json();

                if (data.success) {
                    showToast(data.message, 'success');
                    
                    // Remove from JS memory
                    if (currentItemIndex !== null) {
                        const item = itemsData[currentItemIndex];
                        item.requests = item.requests.filter(r => r.id !== id);

                        // If no approved requests left, make sure item status is updated
                        const hasApproved = item.requests.some(r => r.status === 'disetujui');
                        if (!hasApproved) item.status = 'tersedia';

                        // If all requests are deleted for this item, remove the row entirely and close drawer
                        if (item.requests.length === 0) {
                            closeDrawer();
                            const row = document.getElementById(`item-row-${item.id}`);
                            if (row) {
                                row.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                                row.style.opacity = '0';
                                row.style.transform = 'translateX(30px)';
                                setTimeout(() => row.remove(), 400);
                            }
                        } else {
                            renderDrawerRequests(item.requests, item.nama);
                            syncItemRow(currentItemIndex);
                        }
                    }
                } else {
                    showToast(data.message || 'Gagal menghapus.', 'error');
                    btn.disabled = false;
                    btn.textContent = originalText;
                }
            } catch (err) {
                showToast('Koneksi gagal. Silakan coba lagi.', 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // Set preset dates for shortcut buttons
        function setPreset(preset) {
            const today = new Date();
            let startDate, endDate;

            switch (preset) {
                case 'today':
                    startDate = today;
                    endDate = today;
                    break;
                case 'last_7_days':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 6);
                    endDate = today;
                    break;
                case 'this_month':
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                    break;
            }

            const formatDate = (date) => {
                const yyyy = date.getFullYear();
                const mm = String(date.getMonth() + 1).padStart(2, '0');
                const dd = String(date.getDate()).padStart(2, '0');
                return `${yyyy}-${mm}-${dd}`;
            };

            const formattedRange = `${formatDate(startDate)} to ${formatDate(endDate)}`;
            
            if (pickerInstance) {
                pickerInstance.setDate([startDate, endDate]);
            }
            
            document.getElementById('date_range').value = formattedRange;
            document.getElementById('filterForm').submit();
        }

        // Helper to remove a single filter and auto-submit
        function removeFilter(paramName) {
            const form = document.getElementById('filterForm');
            const existing = document.getElementById(paramName);
            
            if (existing) {
                if (existing.tagName === 'SELECT') {
                    existing.value = paramName === 'sort' ? 'latest' : '';
                } else {
                    existing.value = '';
                }
            } else if (paramName === 'date_range') {
                document.getElementById('date_range').value = '';
                if (pickerInstance) {
                    pickerInstance.clear();
                }
            }
            
            form.submit();
        }
    </script>
</x-app-layout>
