<x-donatur-layout>
    <x-slot name="header">Riwayat Reparasi</x-slot>

    <div class="max-w-6xl mx-auto py-2">
        {{-- 1. STATE: MISSING PHONE --}}
        @if($status === 'missing_phone')
            <div class="bg-white border border-yellow-200 rounded-2xl p-8 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-5 border border-yellow-100 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">Nomor Telepon Belum Dilengkapi</h3>
                <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                    Sistem memerlukan nomor WhatsApp aktif Anda untuk melakukan sinkronisasi otomatis dengan database pengerjaan di workshop kami. Silakan isi nomor telepon Anda di halaman profil.
                </p>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/25 transition-all">
                    Lengkapi Profil Sekarang
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        {{-- 2. STATE: MISSING CONFIG --}}
        @elseif($status === 'missing_config')
            <div class="bg-white border border-red-200 rounded-2xl p-8 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5 border border-red-100 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">Integrasi Belum Aktif</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-4">
                    Koneksi API sistem workshop luar belum dikonfigurasi oleh administrator saat ini.
                </p>
                <span class="inline-block bg-gray-50 text-gray-500 border border-gray-200 text-xs font-semibold px-4 py-2 rounded-xl">
                    Silakan hubungi admin di workshop untuk mengaktifkan modul integrasi ini.
                </span>
            </div>

        {{-- 3. STATE: API CONNECTION ERROR --}}
        @elseif($status === 'error')
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-8 text-red-800 text-sm shadow-sm flex items-start gap-4">
                <div class="p-2 bg-red-100 text-red-600 rounded-xl">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-red-950">Gagal Menghubungkan Layanan API</h4>
                    <p class="text-xs text-red-700 mt-1 leading-relaxed">{{ $error }}</p>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-800 hover:underline mt-3">
                        Hubungi Dukungan CS WhatsApp →
                    </a>
                </div>
            </div>

        {{-- 4. STATE: SUCCESS / RETRIEVED --}}
        @else
            @if(empty($orders))
                <div class="bg-white border border-gray-200 rounded-2xl p-10 sm:p-14 text-center shadow-sm max-w-xl mx-auto">
                    <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-5 border border-gray-100 shadow-inner">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Belum Ada Riwayat Reparasi</h3>
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                        Kami tidak menemukan riwayat pesanan pengerjaan sepatu untuk nomor HP <strong>{{ Auth::user()->phone }}</strong> di database kami saat ini.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/25 transition-all">
                            Konsultasi via WhatsApp
                        </a>
                        <a href="{{ route('donatur.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition-all">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            @else
                @php
                    $totalCount = count($orders);
                    $activeCount = 0;
                    $completedCount = 0;
                    $totalRemaining = 0;

                    foreach($orders as $order) {
                        $statusCode = strtoupper($order['status']['code'] ?? 'PENDING');
                        $isCompleted = in_array($statusCode, ['SELESAI', 'DIKIRIM', 'DIAMBIL']);
                        $isCancelled = $statusCode === 'BATAL';
                        if (!$isCompleted && !$isCancelled) {
                            $activeCount++;
                        }
                        if ($isCompleted) {
                            $completedCount++;
                        }
                        $totalRemaining += ($order['payment']['remaining_balance'] ?? 0);
                    }
                @endphp

                <script>
                    window.reparationOrders = @json($orders);
                </script>

                {{-- Interactive Alpine.js Container --}}
                <div x-data="{
                    searchQuery: '',
                    activeTab: 'all',
                    lightboxOpen: false,
                    lightboxSrc: '',
                    lightboxCaption: '',
                    detailModalOpen: false,
                    selectedOrder: null,
                    orders: window.reparationOrders || [],
                    openLightbox(src, caption) {
                        this.lightboxSrc = src;
                        this.lightboxCaption = caption || '';
                        this.lightboxOpen = true;
                    },
                    openDetailModal(order) {
                        this.selectedOrder = order;
                        this.detailModalOpen = true;
                    },
                    isOrderVisible(order) {
                        if (!order) return false;

                        const query = this.searchQuery.toLowerCase().trim();
                        let matchesSearch = true;
                        if (query) {
                            const matchesSpk = order.spk_number && order.spk_number.toLowerCase().includes(query);
                            const matchesBrand = order.shoe_brand && order.shoe_brand.toLowerCase().includes(query);
                            const matchesType = order.shoe_type && order.shoe_type.toLowerCase().includes(query);
                            const matchesServices = order.services && order.services.some(s => s.service_name && s.service_name.toLowerCase().includes(query));
                            matchesSearch = matchesSpk || matchesBrand || matchesType || matchesServices;
                        }

                        if (!matchesSearch) return false;

                        const statusCode = order.status && order.status.code ? order.status.code.toUpperCase() : 'PENDING';
                        const isCompleted = ['SELESAI', 'DIKIRIM', 'DIAMBIL'].includes(statusCode);
                        const isCancelled = statusCode === 'BATAL';
                        const isUnpaid = order.payment && order.payment.status && order.payment.status.toLowerCase() !== 'lunas';

                        if (this.activeTab === 'active') {
                            return !isCompleted && !isCancelled;
                        } else if (this.activeTab === 'completed') {
                            return isCompleted;
                        } else if (this.activeTab === 'unpaid') {
                            return isUnpaid;
                        }
                        return true;
                    }
                }">
                    {{-- SaaS Metric Strip --}}
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-4 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total SPK</p>
                                <p class="text-xl font-extrabold text-gray-900 mt-1">{{ $totalCount }}</p>
                            </div>
                            <div class="p-2.5 bg-gray-50 text-gray-400 border border-gray-100 rounded-xl">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pengerjaan</p>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($activeCount > 0)
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                    </span>
                                    @endif
                                    <p class="text-xl font-extrabold text-gray-900">{{ $activeCount }}</p>
                                </div>
                            </div>
                            <div class="p-2.5 bg-amber-50 text-amber-600 border border-amber-100 rounded-xl">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Selesai</p>
                                <p class="text-xl font-extrabold text-gray-900 mt-1">{{ $completedCount }}</p>
                            </div>
                            <div class="p-2.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-2xl border border-gray-150 shadow-sm flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sisa Tagihan</p>
                                <p class="text-xl font-extrabold {{ $totalRemaining > 0 ? 'text-red-600' : 'text-gray-900' }} mt-1">
                                    Rp {{ number_format($totalRemaining, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="p-2.5 {{ $totalRemaining > 0 ? 'bg-red-50 text-red-600 border-red-150' : 'bg-gray-50 text-gray-400 border-gray-100' }} border rounded-xl">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Search and Tab Filter Bar --}}
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-white p-4 rounded-2xl border border-gray-150 shadow-sm mb-6">
                        {{-- Filter Tabs --}}
                        <div class="flex items-center gap-1 p-1 bg-gray-100 rounded-xl w-full md:w-auto overflow-x-auto">
                            <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-white text-gray-900 shadow-sm font-bold' : 'text-gray-500 hover:text-gray-900 font-semibold'" class="px-4 py-2 text-xs rounded-lg transition duration-200 flex-shrink-0">
                                Semua SPK
                            </button>
                            <button @click="activeTab = 'active'" :class="activeTab === 'active' ? 'bg-white text-gray-900 shadow-sm font-bold' : 'text-gray-500 hover:text-gray-900 font-semibold'" class="px-4 py-2 text-xs rounded-lg transition duration-200 flex-shrink-0">
                                Sedang Berjalan
                            </button>
                            <button @click="activeTab = 'completed'" :class="activeTab === 'completed' ? 'bg-white text-gray-900 shadow-sm font-bold' : 'text-gray-500 hover:text-gray-900 font-semibold'" class="px-4 py-2 text-xs rounded-lg transition duration-200 flex-shrink-0">
                                Selesai
                            </button>
                            <button @click="activeTab = 'unpaid'" :class="activeTab === 'unpaid' ? 'bg-white text-gray-900 shadow-sm font-bold' : 'text-gray-500 hover:text-gray-900 font-semibold'" class="px-4 py-2 text-xs rounded-lg transition duration-200 flex-shrink-0">
                                Belum Lunas
                            </button>
                        </div>

                        {{-- Search Input --}}
                        <div class="relative w-full md:w-80">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </span>
                            <input x-model="searchQuery" type="text" placeholder="Cari SPK, merek sepatu, atau layanan..." class="w-full pl-10 pr-4 py-2.5 text-xs border border-gray-200 rounded-xl outline-none focus:border-emerald-500 transition bg-gray-50/50 focus:bg-white">
                        </div>
                    </div>

                    {{-- Empty Search Results State --}}
                    <div x-show="orders.length > 0 && Array.from(document.querySelectorAll('.reparation-order-card')).every(el => el.style.display === 'none')" class="bg-white border border-gray-200 rounded-2xl p-12 text-center shadow-sm">
                        <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 shadow-inner">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 mb-1">Pesanan Tidak Ditemukan</h3>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-sm mx-auto">
                            Tidak ditemukan SPK yang cocok dengan kata kunci pencarian atau filter yang sedang aktif. Silakan ganti kriteria pencarian Anda.
                        </p>
                    </div>

                    {{-- Orders Cards Grid (Catalog Style) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($orders as $index => $order)
                            @php
                                $paymentStatus = $order['payment']['status'] ?? 'Belum Bayar';
                                $paymentColor = match(strtolower($paymentStatus)) {
                                    'lunas' => 'bg-emerald-500 text-white border-transparent',
                                    'sebagian' => 'bg-blue-500 text-white border-transparent',
                                    default => 'bg-amber-500 text-white border-transparent',
                                };

                                $statusCode = strtoupper($order['status']['code'] ?? 'PENDING');
                                $statusLabel = $order['status']['label'] ?? 'Sedang Diproses';

                                $statusTagClass = match($statusCode) {
                                    'SELESAI', 'DIKIRIM', 'DIAMBIL' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                    'BATAL' => 'bg-red-150 text-red-800 border-red-200',
                                    default => 'bg-amber-100 text-amber-800 border-amber-200',
                                };

                                $hasUnpaid = ($order['payment']['remaining_balance'] ?? 0) > 0;
                                $coverPhoto = collect($order['photos'] ?? [])->firstWhere((string) 'is_spk_cover', true) ?? collect($order['photos'] ?? [])->first();
                            @endphp

                            <div x-show="isOrderVisible(orders[{{ $index }}])" class="reparation-order-card bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 flex flex-col h-full">
                                
                                {{-- Card Media Top --}}
                                <div class="relative h-44 bg-gray-50 border-b border-gray-100 overflow-hidden flex-shrink-0 group">
                                    @if($coverPhoto)
                                        <img src="{{ $coverPhoto['photo_url'] }}" alt="Cover" class="w-full h-full object-cover transition duration-300 group-hover:scale-105 cursor-pointer" @click="openLightbox('{{ $coverPhoto['photo_url'] }}', '{{ addslashes($coverPhoto['caption'] ?? '') }}')">
                                        <div class="absolute inset-0 bg-black/5 group-hover:bg-black/0 transition duration-300"></div>
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-8 h-8 mb-1.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tidak Ada Foto</span>
                                        </div>
                                    @endif

                                    {{-- SPK Code (Floating Left) --}}
                                    <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-xs px-2.5 py-1 rounded-lg border border-white/10 shadow-sm">
                                        <span class="font-mono font-bold text-white text-[10px] tracking-wider uppercase">{{ $order['spk_number'] }}</span>
                                    </div>

                                    {{-- Floating Badges (Right Side) --}}
                                    <div class="absolute top-3 right-3 flex flex-col gap-1.5 items-end">
                                        <span class="px-2.5 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider shadow-sm border {{ $statusTagClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                        <span class="px-2.5 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider shadow-sm {{ $paymentColor }}">
                                            {{ $paymentStatus }}
                                        </span>
                                    </div>

                                    {{-- Mini Date Overlay at Bottom --}}
                                    <div class="absolute bottom-2 left-3 text-[9px] text-white/90 bg-black/40 backdrop-blur-xs px-2 py-0.5 rounded-md">
                                        Masuk: {{ isset($order['entry_date']) ? \Carbon\Carbon::parse($order['entry_date'])->format('d/m/y') : '-' }}
                                    </div>
                                </div>

                                {{-- Card Content --}}
                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        {{-- Title: Brand & Model --}}
                                        <h3 class="text-sm font-black text-gray-900 leading-snug">
                                            {{ $order['shoe_brand'] ?? 'Tanpa Merek' }}
                                            @if(isset($order['shoe_type']) && $order['shoe_type'] !== '-')
                                                <span class="text-xs text-gray-500 font-semibold block mt-0.5">({{ $order['shoe_type'] }})</span>
                                            @endif
                                        </h3>

                                        {{-- Specifications --}}
                                        <div class="grid grid-cols-2 gap-2.5 mt-3.5">
                                            <div class="bg-gray-50 border border-gray-150 rounded-xl p-2.5">
                                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Warna</span>
                                                <span class="font-extrabold text-xs text-gray-800">{{ $order['shoe_color'] ?? '-' }}</span>
                                            </div>
                                            <div class="bg-gray-50 border border-gray-150 rounded-xl p-2.5">
                                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Ukuran</span>
                                                <span class="font-extrabold text-xs text-gray-800">{{ $order['shoe_size'] ?? '-' }}</span>
                                            </div>
                                        </div>

                                        {{-- Dates & Services summary --}}
                                        <div class="mt-3.5 pt-3.5 border-t border-gray-100 space-y-2 text-xs text-gray-650">
                                            @if(isset($order['estimation_date']))
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium">📅 Estimasi Selesai:</span>
                                                    <span class="font-bold text-emerald-600">{{ \Carbon\Carbon::parse($order['estimation_date'])->format('d M Y') }}</span>
                                                </div>
                                            @endif

                                            <div class="pt-1.5">
                                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block mb-1">Layanan Utama</span>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach(array_slice($order['services'], 0, 2) as $svc)
                                                        <span class="px-2 py-0.5 bg-gray-100 border border-gray-200 text-gray-600 rounded text-[9px] font-semibold">
                                                            {{ $svc['service_name'] }}
                                                        </span>
                                                    @endforeach
                                                    @if(count($order['services']) > 2)
                                                        <span class="px-2 py-0.5 bg-gray-200 border border-gray-255 text-gray-700 rounded text-[9px] font-black">
                                                            +{{ count($order['services']) - 2 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Card Actions --}}
                                    <div class="mt-5 pt-3.5 border-t border-gray-100 flex flex-col gap-3">
                                        <div class="flex items-center justify-between text-xs">
                                            <div>
                                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-wider block leading-none mb-1">Total Biaya</span>
                                                <span class="text-sm font-black text-gray-900">Rp {{ number_format($order['payment']['total_amount'] ?? 0, 0, ',', '.') }}</span>
                                            </div>
                                            @if($hasUnpaid)
                                                <div class="text-right">
                                                    <span class="text-[8px] font-bold text-red-500 uppercase tracking-wider block leading-none mb-1">Kurang Bayar</span>
                                                    <span class="text-xs font-black text-red-650">Rp {{ number_format($order['payment']['remaining_balance'] ?? 0, 0, ',', '.') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <button @click="openDetailModal(orders[{{ $index }}])" class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 bg-emerald-500 hover:bg-emerald-600 text-white text-[11px] font-bold rounded-xl transition duration-200 shadow-sm shadow-emerald-500/10">
                                            <span>Lihat Rincian Progress</span>
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Detail Modal Dialog (Z-Index 40) --}}
                    <div x-show="detailModalOpen" class="fixed inset-0 z-40 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs" x-transition x-cloak style="display: none;">
                        <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[85vh] border border-gray-100" @click.away="detailModalOpen = false">
                            
                            {{-- Modal Header --}}
                            <div class="px-5 py-4 bg-gray-50 border-b border-gray-150 flex items-center justify-between flex-shrink-0">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shadow-xs">
                                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-mono font-bold text-gray-900 text-xs tracking-wider" x-text="selectedOrder ? selectedOrder.spk_number : ''"></span>
                                        <p class="text-[9px] text-gray-400">Rincian Progress & Layanan Pengerjaan</p>
                                    </div>
                                </div>
                                <button @click="detailModalOpen = false" class="w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            {{-- Modal Body (Scrollable) --}}
                            <div class="p-5 overflow-y-auto space-y-4 flex-1 text-xs" x-show="selectedOrder">
                                {{-- Specs Card --}}
                                <div class="grid grid-cols-2 gap-3 bg-gray-50 border border-gray-150 rounded-xl p-3.5">
                                    <div>
                                        <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Merek & Model</span>
                                        <span class="font-extrabold text-gray-900 text-xs" x-text="(selectedOrder ? selectedOrder.shoe_brand : '') + (selectedOrder && selectedOrder.shoe_type && selectedOrder.shoe_type !== '-' ? ' ('+selectedOrder.shoe_type+')' : '')"></span>
                                    </div>
                                    <div>
                                        <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Spesifikasi</span>
                                        <span class="font-bold text-gray-700 text-[11px]" x-text="selectedOrder ? 'Warna: ' + selectedOrder.shoe_color + ' • Size: ' + selectedOrder.shoe_size : ''"></span>
                                    </div>
                                </div>

                                {{-- Dates & Status --}}
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border border-gray-150 rounded-xl p-3 flex items-center justify-between">
                                        <div>
                                            <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Status</span>
                                            <span class="font-black text-gray-900 text-[11px] mt-0.5 block" x-text="selectedOrder && selectedOrder.status ? selectedOrder.status.label : ''"></span>
                                        </div>
                                        <span class="h-2 w-2 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50" x-show="selectedOrder && selectedOrder.status && ['SELESAI', 'DIKIRIM', 'DIAMBIL'].includes(selectedOrder.status.code.toUpperCase())"></span>
                                        <span class="h-2 w-2 rounded-full bg-red-500 shadow-sm shadow-red-500/50" x-show="selectedOrder && selectedOrder.status && selectedOrder.status.code.toUpperCase() === 'BATAL'"></span>
                                        <span class="relative flex h-2 w-2" x-show="selectedOrder && selectedOrder.status && !['SELESAI', 'DIKIRIM', 'DIAMBIL', 'BATAL'].includes(selectedOrder.status.code.toUpperCase())">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-450 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                        </span>
                                    </div>

                                    <div class="border border-gray-150 rounded-xl p-3 flex items-center justify-between">
                                        <div>
                                            <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest block">Est. Selesai</span>
                                            <span class="font-black text-gray-900 text-[11px] mt-0.5 block" x-text="selectedOrder && selectedOrder.estimation_date ? new Date(selectedOrder.estimation_date).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) : '-'"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Services breakdown --}}
                                <div>
                                    <h4 class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Layanan & Pembayaran</h4>
                                    <div class="bg-gray-50 border border-gray-150 rounded-xl overflow-hidden shadow-xs">
                                        <table class="w-full text-[10px] text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-100/60 border-b border-gray-150 text-gray-600 font-bold">
                                                    <th class="py-2 px-3">Layanan</th>
                                                    <th class="py-2 px-3 text-right">Biaya</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 text-gray-700 bg-white">
                                                <template x-for="svc in (selectedOrder ? selectedOrder.services : [])">
                                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                                        <td class="py-2.5 px-3 font-bold text-gray-950" x-text="svc.service_name"></td>
                                                        <td class="py-2.5 px-3 text-right font-bold text-gray-900 font-mono" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(svc.cost || 0)"></td>
                                                    </tr>
                                                </template>
                                                
                                                <tr class="bg-gray-50/50 font-bold border-t border-gray-150 text-gray-900">
                                                    <td class="py-2 px-3 text-right">Total:</td>
                                                    <td class="py-2 px-3 text-right font-black font-mono text-xs text-gray-950" x-text="selectedOrder && selectedOrder.payment ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(selectedOrder.payment.total_amount || 0) : 'Rp 0'"></td>
                                                </tr>
                                                <tr class="text-emerald-700 bg-emerald-50/10 font-bold" x-show="selectedOrder && selectedOrder.payment && selectedOrder.payment.paid_amount > 0">
                                                    <td class="py-2 px-3 text-right">Telah Dibayar:</td>
                                                    <td class="py-2 px-3 text-right font-black font-mono text-xs" x-text="selectedOrder && selectedOrder.payment ? '- ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(selectedOrder.payment.paid_amount || 0) : 'Rp 0'"></td>
                                                </tr>
                                                <tr class="text-red-700 bg-red-50/10 font-bold" x-show="selectedOrder && selectedOrder.payment && selectedOrder.payment.remaining_balance > 0">
                                                    <td class="py-2 px-3 text-right">Sisa Tagihan:</td>
                                                    <td class="py-2 px-3 text-right font-black font-mono text-xs" x-text="selectedOrder && selectedOrder.payment ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(selectedOrder.payment.remaining_balance || 0) : 'Rp 0'"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Progress Photos --}}
                                <div x-show="selectedOrder && selectedOrder.photos && selectedOrder.photos.length > 0">
                                    <h4 class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-2">Galeri Foto Progress</h4>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                        <template x-for="photo in (selectedOrder ? selectedOrder.photos : [])">
                                            <div @click="openLightbox(photo.photo_url, photo.caption)" class="block relative rounded-xl overflow-hidden border border-gray-150 h-16 bg-gray-50 group shadow-xs cursor-pointer">
                                                <img :src="photo.photo_url" :alt="photo.caption" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                                                <div class="absolute inset-0 bg-black/15 group-hover:bg-black/0 transition duration-300"></div>
                                                <span class="absolute top-1 left-1 bg-black/60 text-white text-[7px] font-black px-1 py-0.5 rounded uppercase tracking-wider" x-text="photo.step"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Footer --}}
                            <div class="px-5 py-3.5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-2.5 flex-shrink-0">
                                <button @click="detailModalOpen = false" class="px-3.5 py-2 bg-white border border-gray-200 text-gray-700 font-bold text-xs rounded-xl hover:bg-gray-100 transition shadow-xs">
                                    Tutup Rincian
                                </button>
                                <a :href="'https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin%20ShoeWorkshop,%20saya%20ingin%20tanya%20mengenai%20progress%20sepatu%20SPK%20' + (selectedOrder ? selectedOrder.spk_number : '')" target="_blank" class="px-3.5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/20 transition flex items-center gap-1.5">
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    Tanya Admin WA
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Image Lightbox Modal (Z-Index 50 - floats on top of Detail Modal) --}}
                    <div x-show="lightboxOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-xs" x-transition x-cloak style="display: none;">
                        <div class="relative max-w-4xl max-h-[85vh] overflow-hidden bg-white rounded-2xl p-2 shadow-2xl" @click.away="lightboxOpen = false">
                            <button @click="lightboxOpen = false" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-black/60 hover:bg-black/80 text-white flex items-center justify-center transition shadow-md">
                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            <img :src="lightboxSrc" class="max-w-full max-h-[78vh] rounded-xl object-contain">
                            <div class="px-4 py-3 bg-white" x-show="lightboxCaption">
                                <p class="text-xs font-bold text-gray-900" x-text="lightboxCaption"></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</x-donatur-layout>
