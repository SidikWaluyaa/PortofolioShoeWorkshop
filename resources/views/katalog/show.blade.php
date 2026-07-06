@extends('layouts.main')
@section('seo_title', 'Detail Donasi ' . $item->nama . ' - Shoe Workshop')
@section('seo_description', 'Detail barang donasi gratis berkualitas: ' . $item->nama . '. Hasil restorasi profesional tim Shoe Workshop.')
@section('seo_keywords', 'katalog donasi, detail barang donasi, gratis, shoe workshop, reparasi sepatu')

@section('head')
<style>
    [x-cloak] { display: none !important; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .fill-1 { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
@endsection

@section('content')
@php
    $isQuotaFull = $item->status === 'tersedia' && $item->isQuotaFull();
    $condLabels = [
        'baru' => '🆕 Baru',
        'seperti_baru' => '✨ Seperti Baru',
        'sudah_diperbaiki' => '🔧 Refurbished'
    ];

    // Dynamic colorway extractor
    $color = 'Warna Standar';
    $colors = [
        'white' => 'Putih', 
        'black' => 'Hitam', 
        'brown' => 'Cokelat', 
        'navy' => 'Biru Navy', 
        'red' => 'Merah', 
        'blue' => 'Biru', 
        'green' => 'Hijau', 
        'grey' => 'Abu-abu'
    ];
    foreach ($colors as $eng => $indo) {
        if (stripos($item->nama . ' ' . $item->deskripsi, $eng) !== false || stripos($item->nama . ' ' . $item->deskripsi, $indo) !== false) {
            $color = $indo;
            break;
        }
    }
    
    // Gunakan warna dari DB jika ada, jika tidak fallback ke hasil ekstraksi
    $finalColor = $item->warna ?: $color;
@endphp

<div x-data="detailApp()" x-init="initApp()" class="bg-[#f8f9fa] text-[#1c1c17] min-h-screen flex flex-col justify-between">
    
    <!-- TopNavBar Component -->
    @include('layouts.navigation-public')

    <div class="pt-24 flex-grow flex flex-col">
        <!-- Main Content -->
        <main class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-16 py-8 flex-grow flex flex-col gap-6">
            
            <!-- Breadcrumbs Navigation (Big 4 Tech Company Standard) -->
            <nav aria-label="Breadcrumb" class="w-full">
                <ol class="flex flex-wrap items-center gap-1.5 sm:gap-2 text-xs font-semibold text-gray-500" itemscope itemtype="https://schema.org/BreadcrumbList">
                    
                    {{-- 1. Beranda --}}
                    <li class="flex items-center gap-1.5 sm:gap-2" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ route('home') }}" class="hover:text-[#22AF85] transition-colors flex items-center gap-1 text-gray-400 hover:scale-105 active:scale-95" itemprop="item">
                            <span class="material-symbols-outlined !text-[16px]">home</span>
                            <span itemprop="name" class="hidden sm:inline">Beranda</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="flex items-center text-gray-300 select-none">
                        <span class="material-symbols-outlined !text-[14px]">chevron_right</span>
                    </li>
                    
                    {{-- 2. Katalog Donasi --}}
                    <li class="flex items-center gap-1.5 sm:gap-2" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ route('katalog.index') }}" class="hover:text-[#22AF85] transition-colors" itemprop="item">
                            <span itemprop="name">Donasi</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li class="flex items-center text-gray-300 select-none">
                        <span class="material-symbols-outlined !text-[14px]">chevron_right</span>
                    </li>

                    {{-- 3. Kategori Dinamis --}}
                    @php
                        $catLabels = ['sepatu' => 'Sepatu', 'tas' => 'Tas', 'topi' => 'Topi'];
                        $catLabel = $catLabels[$item->kategori] ?? ucfirst($item->kategori);
                    @endphp
                    <li class="flex items-center gap-1.5 sm:gap-2" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ route('katalog.index') }}?category={{ $item->kategori }}" class="hover:text-[#22AF85] transition-colors" itemprop="item">
                            <span itemprop="name">{{ $catLabel }}</span>
                        </a>
                        <meta itemprop="position" content="3" />
                    </li>
                    <li class="flex items-center text-gray-300 select-none">
                        <span class="material-symbols-outlined !text-[14px]">chevron_right</span>
                    </li>

                    {{-- 4. Halaman Aktif (Nama Produk) --}}
                    <li class="text-[#22AF85] font-extrabold max-w-[140px] sm:max-w-[350px] truncate" aria-current="page" title="{{ $item->nama }}">
                        {{ $item->nama }}
                    </li>
                </ol>
            </nav>

            <!-- Detail Product Container -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200 grid grid-cols-1 lg:grid-cols-12">
                <!-- Left Column: Image Gallery (5/12 cols) -->
                <div class="lg:col-span-5 bg-gray-50 p-6 flex flex-col gap-6 border-b lg:border-b-0 lg:border-r border-gray-200">
                    <!-- Large Primary View -->
                    <div class="relative group aspect-square max-h-[360px] sm:max-h-[450px] w-full rounded-xl overflow-hidden bg-white border border-gray-200 flex items-center justify-center p-4 sm:p-8 {{ $isQuotaFull ? 'filter grayscale contrast-75 brightness-95 opacity-90' : '' }}">
                        <img src="{{ $item->foto_utama_url }}" :src="activeImage" alt="{{ $item->nama }}" class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover:scale-105"/>
                        <div class="absolute top-3 left-3 bg-green-500 text-white px-2.5 py-1 rounded-full text-[10px] font-bold shadow-sm flex items-center gap-1 z-10">
                            <span class="material-symbols-outlined !text-[12px]">verified</span>
                            Kualitas Terverifikasi
                        </div>
                    </div>
                    
                    <!-- Thumbnails row -->
                    <div class="flex gap-2 sm:gap-4 overflow-x-auto pb-1">
                        <!-- Thumbnail 1 (Active) -->
                        <button @click="activeImage = '{{ $item->foto_utama_url }}'; activeIndex = 0" 
                                :class="activeIndex === 0 ? 'border-2 border-[#22AF85]' : 'border border-gray-200 hover:border-[#22AF85]'"
                                class="w-14 h-14 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl overflow-hidden bg-white p-1.5 sm:p-2 transition-all shadow-sm flex-shrink-0 flex items-center justify-center">
                            <img alt="Foto Utama" class="max-w-full max-h-full object-contain" src="{{ $item->foto_utama_url }}"/>
                        </button>
                        
                        <!-- Other photo details if present -->
                        @php
                            $detailPhotos = $item->foto_detail ?? [];
                            // Helper: resolve correct public URL based on where the file is stored
                            // foto_utama_path may be in public/images/ (use asset()) 
                            // foto_detail paths are stored via Storage::disk('public') (use asset('storage/...'))
                            $detailUrl = function (string $path): string {
                                if (str_starts_with($path, 'http') || str_starts_with($path, 'images/')) {
                                    return asset($path);
                                }
                                return asset('storage/' . $path);
                            };
                        @endphp
                        
                        @for($i = 0; $i < 3; $i++)
                            @if(isset($detailPhotos[$i]))
                                <button @click="activeImage = '{{ $detailUrl($detailPhotos[$i]) }}'; activeIndex = {{ $i + 1 }}" 
                                        :class="activeIndex === {{ $i + 1 }} ? 'border-2 border-[#22AF85]' : 'border border-gray-200 hover:border-[#22AF85]'"
                                        class="w-14 h-14 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl overflow-hidden bg-white p-1.5 sm:p-2 transition-all shadow-sm flex-shrink-0 flex items-center justify-center">
                                    <img alt="Detail {{ $i + 1 }}" class="max-w-full max-h-full object-contain" src="{{ $detailUrl($detailPhotos[$i]) }}"/>
                                </button>
                            @else
                                <!-- Placeholder thumbnails -->
                                <button class="w-14 h-14 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl border border-dashed border-gray-300 overflow-hidden bg-white p-1.5 cursor-default flex items-center justify-center text-gray-400 flex-shrink-0">
                                    @if($i == 0)
                                        <span class="material-symbols-outlined !text-[20px] sm:!text-[24px]">photo_camera</span>
                                    @elseif($i == 1)
                                        <span class="material-symbols-outlined !text-[20px] sm:!text-[24px]">zoom_in</span>
                                    @else
                                        <span class="material-symbols-outlined !text-[20px] sm:!text-[24px]">footprint</span>
                                    @endif
                                </button>
                            @endif
                        @endfor
                    </div>


                </div>

                <!-- Right Column: Product Info (7/12 cols) -->
                <div class="lg:col-span-7 p-6 md:p-8 flex flex-col justify-between h-full bg-white">
                    <!-- Brand & Title -->
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-[#22AF85] uppercase tracking-widest">{{ $item->brand ?? 'Generic' }}</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-[#1c1c17] mt-2 leading-tight">{{ $item->nama }}</h1>
                        
                        <div class="flex flex-wrap items-center gap-3 mt-3">
                            @php
                                $condBadgeClasses = [
                                    'baru' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                    'seperti_baru' => 'bg-green-50 text-green-700 border border-green-200',
                                    'sudah_diperbaiki' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                                ];
                                $condBadgeLabels = [
                                    'baru' => 'Kondisi: Baru',
                                    'seperti_baru' => 'Kondisi: Sangat Baik',
                                    'sudah_diperbaiki' => 'Kondisi: Hasil Refurbished',
                                ];
                            @endphp
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $condBadgeClasses[$item->kondisi] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $condBadgeLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                            </span>

                        </div>

                        <!-- Attributes Grid: 3-col on sm+, 2-col on mobile -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 my-5">
                            <div class="p-3 sm:p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Kondisi</p>
                                <p class="text-sm font-bold text-[#1c1c17] mt-1">
                                    {{ $item->kondisi === 'baru' ? 'Baru' : ($item->kondisi === 'seperti_baru' ? 'Seperti Baru' : 'Refurbished') }}
                                </p>
                            </div>
                            <div class="p-3 sm:p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Ukuran</p>
                                <p class="text-sm font-bold text-[#1c1c17] mt-1">{{ $item->ukuran ?? 'Semua Ukuran' }}</p>
                            </div>
                            <div class="p-3 sm:p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Warna / Colorway</p>
                                <p class="text-sm font-bold text-[#1c1c17] mt-1">{{ $finalColor }}</p>
                            </div>
                            <div class="p-3 sm:p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Berat Barang</p>
                                <p class="text-sm font-bold text-[#1c1c17] mt-1">{{ $item->berat_formatted }}</p>
                            </div>
                            <div class="p-3 sm:p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Kuota Pengajuan</p>
                                <p class="text-sm font-bold mt-1 {{ $isQuotaFull ? 'text-red-650' : 'text-emerald-600' }}">
                                    {{ $item->pending_requests_count }} / 5 Pemohon
                                </p>
                            </div>
                            @if($item->score_kelayakan)
                            <div class="p-3 sm:p-4 bg-gray-50 rounded-xl border border-gray-100 col-span-2 sm:col-span-1">
                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1.5">Skor Kelayakan Barang</p>
                                <div class="flex items-center gap-1.5 mt-1 select-none">
                                    <div class="flex items-center gap-0.5">
                                        @php
                                            $stars = round(($item->score_kelayakan / 100) * 5);
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $stars)
                                                <span class="material-symbols-outlined !text-[16px] text-amber-400 fill-1">star</span>
                                            @else
                                                <span class="material-symbols-outlined !text-[16px] text-gray-300">star</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs font-black text-gray-855">({{ $item->score_kelayakan }}%)</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Product Description -->
                        <div class="mb-6">
                            <h3 class="text-sm font-bold text-[#1c1c17] mb-2">Catatan Kurator</h3>
                            <p class="text-sm text-gray-600 leading-relaxed font-normal">
                                {{ $item->deskripsi ?? 'Barang ini telah melalui proses kurasi dan perbaikan detail oleh tim Shoe Workshop untuk menjamin kelayakan pakai bagi penerima donasi.' }}
                            </p>
                        </div>

                        <!-- Restoration/Service details if applicable -->
                        @if($item->reparationServices->isNotEmpty())
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6">
                            <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-3">🛠️ Rincian Layanan Restorasi Workshop</h3>
                            <div class="divide-y divide-slate-200">
                                @foreach($item->reparationServices as $rs)
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-3 first:pt-0">
                                        <div>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">Jasa Pengerjaan</p>
                                            <p class="text-sm font-bold text-slate-800 mt-0.5">
                                                @if($rs->service)
                                                    <span class="inline-block mr-1">{{ $rs->service->icon }}</span>
                                                @endif
                                                {{ $rs->jasa_nama }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">Estimasi Waktu</p>
                                            <p class="text-sm font-semibold text-slate-700 mt-0.5">{{ $rs->jasa_estimasi_waktu_formatted }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">Nilai/Harga Jasa</p>
                                            <p class="text-sm font-bold text-slate-850 mt-0.5">{{ $rs->jasa_harga_formatted }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Total Row -->
                            <div class="border-t border-slate-200 pt-3 mt-1 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-black uppercase">Total Estimasi Durasi (Max)</p>
                                    <p class="text-sm font-black text-[#22AF85]">{{ $item->jasa_estimasi_waktu_formatted }}</p>
                                </div>
                                <div class="sm:text-right">
                                    <p class="text-[10px] text-slate-400 font-black uppercase">Total Nilai Restorasi</p>
                                    <p class="text-base font-black text-[#22AF85]">{{ $item->jasa_harga_formatted }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Environmental Impact Indicator -->
                        @php
                            $co2Offsets = [
                                'sepatu' => '12.5 kg offset',
                                'tas' => '9.2 kg offset',
                                'topi' => '4.5 kg offset',
                            ];
                            $offsetVal = $co2Offsets[$item->kategori] ?? '8.5 kg offset';
                        @endphp
                        <div class="bg-green-50 border border-green-100 rounded-xl p-4 flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 rounded-full bg-[#22AF85]/10 flex items-center justify-center flex-shrink-0 text-[#22AF85]">
                                <span class="material-symbols-outlined !text-[24px]">eco</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#22AF85] uppercase tracking-wider">Penyelamatan Lingkungan (CO2 SAVINGS)</p>
                                <p class="text-sm font-bold text-[#22AF85] mt-0.5">{{ $offsetVal }}</p>
                                <p class="text-[11px] text-gray-500 mt-0.5">Dengan memilih barang hasil restorasi, Anda ikut mencegah limbah industri baru.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Section — sticky on mobile -->
                    <div class="border-t border-gray-100 pt-5 mt-auto">
                        <div class="mb-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Status Ketersediaan</p>
                            <div class="flex items-center gap-2 mt-1">
                                @if($item->status === 'tersedia')
                                    @if($isQuotaFull)
                                        <div class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></div>
                                        <span class="text-sm font-bold text-amber-700">Dalam Proses Pengajuan</span>
                                    @else
                                        <div class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></div>
                                        <span class="text-sm font-bold text-green-700">Tersedia untuk Pengajuan</span>
                                    @endif
                                @else
                                    <div class="w-2.5 h-2.5 rounded-full bg-gray-400"></div>
                                    <span class="text-sm font-bold text-gray-600">Sudah Disalurkan</span>
                                @endif
                            </div>
                        </div>

                        {{-- Quota Alert --}}
                        @if($isQuotaFull)
                            <div class="p-3.5 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3 mb-4">
                                <span class="material-symbols-outlined text-amber-600 shrink-0">info</span>
                                <div>
                                    <p class="text-xs font-bold text-amber-850">Proses Pengajuan Sedang Berjalan</p>
                                    <p class="text-[11px] text-amber-700 mt-0.5 font-normal">Item donasi ini dalam proses pengajuan. Saat ini kuota pengajuan baru telah ditutup sementara (maksimal 5 pengajuan).</p>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Desktop action buttons (hidden on mobile, shown via sticky bar below) --}}
                        <div class="hidden sm:flex gap-3">
                            @if($item->status === 'tersedia')
                                @if($isQuotaFull)
                                    <button class="flex-grow py-3.5 bg-[#e1e3e4] text-[#3d4947] rounded-xl font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2" disabled>
                                        <span class="material-symbols-outlined !text-[18px]">block</span>
                                        Dalam Proses Pengajuan
                                    </button>
                                @else
                                    <a href="{{ route('katalog.request.form', $item) }}" class="flex-grow py-3.5 bg-[#22AF85] hover:opacity-90 text-white rounded-xl font-bold text-sm shadow-md shadow-[#22AF85]/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined !text-[18px]">send</span>
                                        Ajukan Permohonan
                                    </a>
                                @endif
                            @else
                                <button class="flex-grow py-3.5 bg-[#e1e3e4] text-[#3d4947] rounded-xl font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2" disabled>
                                    Sudah Disalurkan
                                </button>
                            @endif
                            <button @click="shareItem()" class="p-3.5 rounded-xl border border-gray-300 hover:bg-gray-50 text-gray-700 active:scale-95 transition-all flex items-center justify-center">
                                <span class="material-symbols-outlined">share</span>
                            </button>
                        </div>
                        <p class="hidden sm:block text-center text-[11px] text-gray-400 mt-3 font-semibold">
                            @if($isQuotaFull)
                                Kuota permohonan untuk barang donasi ini sudah penuh (maksimal 5 pemohon).
                            @else
                                Klik tombol "Ajukan Permohonan" untuk melakukan pengajuan barang donasi.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
 
            {{-- ✅ Sticky bottom action bar — mobile only --}}
            <div class="fixed bottom-0 left-0 right-0 z-40 sm:hidden bg-white border-t border-gray-200 px-4 py-3 flex gap-2 shadow-lg">
                @if($item->status === 'tersedia')
                    @if($isQuotaFull)
                        <button class="flex-grow py-3.5 bg-[#e1e3e4] text-[#3d4947] rounded-xl font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2" disabled>
                            <span class="material-symbols-outlined !text-[18px]">block</span>
                            Dalam Proses Pengajuan
                        </button>
                    @else
                        <a href="{{ route('katalog.request.form', $item) }}" class="flex-grow py-3.5 bg-[#22AF85] text-white rounded-xl font-bold text-sm shadow-md shadow-[#22AF85]/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined !text-[18px]">send</span>
                            Ajukan Permohonan
                        </a>
                    @endif
                @else
                    <button class="flex-grow py-3.5 bg-[#e1e3e4] text-[#3d4947] rounded-xl font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2" disabled>
                        Sudah Disalurkan
                    </button>
                @endif
                <button @click="shareItem()" class="p-3.5 rounded-xl border border-gray-300 text-gray-700 active:scale-95 transition-all flex items-center justify-center">
                    <span class="material-symbols-outlined">share</span>
                </button>
            </div>

            <!-- Other Verified Donations Section -->
            @if(!$otherItems->isEmpty())
                <section class="mt-8 mb-20 sm:mb-0">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg sm:text-2xl font-bold text-[#1c1c17]">Barang Donasi Lainnya</h2>
                        <a href="{{ route('katalog.index') }}" class="text-[#22AF85] text-xs sm:text-sm font-bold flex items-center gap-0.5 hover:underline">
                            Lihat Semua <span class="material-symbols-outlined !text-[16px]">chevron_right</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
                        @foreach($otherItems as $other)
                            <div class="group bg-white border border-gray-200 rounded-xl p-3 sm:p-4 transition-all hover:shadow-md hover:-translate-y-1">
                                <a href="{{ route('katalog.show', $other->id) }}" class="block">
                                    <div class="aspect-[4/3] bg-gray-50 rounded-lg mb-2 overflow-hidden flex items-center justify-center p-2 sm:p-3 relative">
                                        <img alt="{{ $other->nama }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300" src="{{ $other->foto_utama_url }}"/>
                                        <span class="absolute bottom-1.5 right-1.5 px-1.5 py-0.5 bg-black/60 backdrop-blur-sm text-white text-[8px] sm:text-[9px] font-bold rounded">
                                            {{ $condLabels[$other->kondisi] ?? ucfirst($other->kondisi) }}
                                        </span>
                                    </div>
                                    <p class="text-[9px] sm:text-[10px] font-bold text-[#22AF85] uppercase tracking-wider mb-1">{{ $other->brand ?? 'Generic' }}</p>
                                    <h4 class="font-bold text-xs sm:text-sm text-[#1c1c17] line-clamp-2">
                                        {{ $other->nama }}
                                    </h4>
                                    <p class="text-[10px] text-gray-500 mt-1">
                                        @if($other->kategori === 'sepatu') 👞 Sepatu
                                        @elseif($other->kategori === 'tas') 🎒 Tas
                                        @else 🧢 Topi
                                        @endif
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </div>

    <!-- Footer Component -->
    @include('components.footer', ['settings' => $settings])

    <script>
    function detailApp() {
        return {
            activeImage: '{{ $item->foto_utama_url }}',
            activeIndex: 0,

            initApp() {},

            shareItem() {
                const shareData = {
                    title: {!! json_encode($item->nama . ' - Shoe Workshop') !!},
                    text: {!! json_encode('Temukan barang donasi gratis berkualitas: ' . $item->nama . ' di Shoe Workshop!') !!},
                    url: window.location.href
                };
                
                if (navigator.share) {
                    navigator.share(shareData)
                        .catch(() => this.copyToClipboard());
                } else {
                    this.copyToClipboard();
                }
            },

            copyToClipboard() {
                const url = window.location.href;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url)
                        .then(() => this.showToast('Tautan detail berhasil disalin!'))
                        .catch(() => this.fallbackCopy(url));
                } else {
                    this.fallbackCopy(url);
                }
            },

            fallbackCopy(text) {
                try {
                    const el = document.createElement('textarea');
                    el.value = text;
                    el.setAttribute('readonly', '');
                    el.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;';
                    document.body.appendChild(el);
                    el.select();
                    el.setSelectionRange(0, el.value.length);
                    const success = document.execCommand('copy');
                    document.body.removeChild(el);
                    if (success) this.showToast('Tautan detail berhasil disalin!');
                } catch (err) {
                    console.error('Fallback copy failed:', err);
                }
            },

            showToast(message) {
                const existing = document.getElementById('share-toast');
                if (existing) existing.remove();

                const toast = document.createElement('div');
                toast.id = 'share-toast';
                toast.className = 'fixed bottom-8 right-8 bg-gray-900 text-white px-6 py-4 rounded-xl shadow-2xl z-[100] transform transition-all translate-y-20 flex items-center gap-3 text-sm font-semibold border border-gray-800';
                toast.innerHTML = `<span class="material-symbols-outlined text-[#22AF85]">check_circle</span> ` + message;
                document.body.appendChild(toast);
                requestAnimationFrame(() => toast.classList.remove('translate-y-20'));
                setTimeout(() => {
                    toast.classList.add('translate-y-20');
                    setTimeout(() => toast.remove(), 500);
                }, 3000);
            }
        }
    }
    </script>
</div>
@endsection
