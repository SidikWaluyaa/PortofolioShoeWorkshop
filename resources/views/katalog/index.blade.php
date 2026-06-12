@extends('layouts.main')
@section('seo_title', 'Katalog Donasi - Donasi Kita | Shoe Workshop')
@section('seo_description', 'Temukan barang-barang layak pakai hasil restorasi terbaik Shoe Workshop yang siap didonasikan secara gratis.')
@section('seo_keywords', 'katalog donasi, galeri donasi, sepatu gratis, cuci sepatu gratis, shoe workshop bandung')

@section('head')
<style>
    [x-cloak] { display: none !important; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .fill-1 { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
@endsection

@section('content')
<div x-data="catalogApp()" x-init="initApp()" class="bg-[#f8f9fa] text-[#191c1d] min-h-screen flex flex-col justify-between">
    
    <!-- TopNavBar Component -->
    <header x-data="{ open: false }" class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 py-4 flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="flex flex-col leading-tight">
                    <span class="text-lg font-extrabold text-[#1c1c17]">Shoe Workshop</span>
                    <div class="flex h-1 w-full">
                        <div class="w-1/2 bg-[#22AF85]"></div>
                        <div class="w-1/2 bg-[#FFC232]"></div>
                    </div>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-6 xl:gap-8">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Beranda</a>
                <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
                <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Portfolio</a>
                <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Donasi</a>
                <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Tracking</a>
                <a href="{{ route('warranty.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Garansi</a>
            </div>

            {{-- CTA & Account Buttons --}}
            <div class="hidden md:flex items-center gap-4">
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                   class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FFC232] text-[#1c1c17] text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#FFC232]/20 whitespace-nowrap">
                    <span class="material-symbols-outlined !text-[20px]">chat</span>
                    Konsultasi via WhatsApp
                </a>

                <div class="relative" x-data="{ openAccount: false }">
                    <button @click="openAccount = !openAccount" @click.outside="openAccount = false"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#22AF85]/20 whitespace-nowrap">
                        <span class="material-symbols-outlined !text-[20px]">account_circle</span>
                        @auth
                            <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                        @else
                            Akun
                        @endauth
                        <span class="material-symbols-outlined !text-[16px] transition-transform duration-200" :class="openAccount ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    
                    <div x-show="openAccount"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-1.5 overflow-hidden"
                         style="display: none;">
                        @auth
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                                <span class="material-symbols-outlined !text-[18px]">dashboard</span>
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <span class="material-symbols-outlined !text-[18px]">logout</span>
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                                <span class="material-symbols-outlined !text-[18px]">login</span>
                                Masuk (Login)
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                                    <span class="material-symbols-outlined !text-[18px]">person_add</span>
                                    Daftar (Register)
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Hamburger --}}
            <button @click="open=!open" class="lg:hidden p-2 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </nav>

        {{-- Mobile menu --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden bg-white border-t border-gray-100 px-4 py-3 space-y-1"
             style="display: none;">
            <a href="{{ route('home') }}"         @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Beranda</a>
            <a href="{{ route('home') }}#layanan" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Layanan</a>
            <a href="{{ route('portfolio.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Portfolio</a>
            <a href="{{ route('katalog.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-[#22AF85] bg-green-50 rounded-lg">Donasi</a>
            <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Tracking</a>
            <a href="{{ route('warranty.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Garansi</a>

            <div class="pt-2 space-y-2">
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#FFC232] text-[#1c1c17] text-sm font-bold rounded-lg">
                    <span class="material-symbols-outlined !text-[20px]">chat</span>
                    Konsultasi via WhatsApp
                </a>
                <div class="border-t border-gray-100 pt-2 mt-2">
                    @auth
                        <p class="px-3 py-1.5 text-xs font-semibold text-gray-400">Akun: {{ Auth::user()->name }}</p>
                        <a href="{{ route('dashboard') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                            <span class="material-symbols-outlined !text-[20px]">dashboard</span>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50 rounded-lg">
                                <span class="material-symbols-outlined !text-[20px]">logout</span>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                            <span class="material-symbols-outlined !text-[20px]">login</span>
                            Masuk (Login)
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                                <span class="material-symbols-outlined !text-[20px]">person_add</span>
                                Daftar (Register)
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <div class="pt-20 flex-grow flex flex-col">
        <!-- Main Content Cluster -->
        <main class="max-w-[1280px] w-full mx-auto px-6 lg:px-10 py-10 flex-grow flex flex-col gap-8">
            <!-- Page Header -->
            <div class="space-y-2">
                <p class="text-xs font-bold text-[#22AF85] tracking-widest uppercase">Katalog Donasi</p>
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#1c1c17]">Katalog Donasi Barang</h1>
                <p class="text-sm text-gray-500 max-w-2xl">Temukan barang berkualitas hasil perbaikan workshop kami yang siap disalurkan kepada yang membutuhkan.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Filter -->
                <aside class="lg:col-span-1 space-y-8">
                    {{-- Search Bar --}}
                    <div>
                        <h3 class="text-xl font-bold text-[#191c1d] mb-4">Cari Barang</h3>
                        <div class="flex items-center bg-white rounded-xl px-4 py-3 border border-gray-200 shadow-sm focus-within:border-[#22AF85] focus-within:ring-1 focus-within:ring-[#22AF85] transition-all">
                            <span class="material-symbols-outlined text-gray-400 mr-2 !text-[20px]">search</span>
                            <input type="text" x-model="search" @input.debounce.300ms="fetchFilter()"
                                   placeholder="Cari nama, brand..." class="bg-transparent border-none p-0 focus:ring-0 text-sm w-full text-gray-700 placeholder-gray-400"/>
                        </div>
                    </div>

                    {{-- Kategori Filter --}}
                    <div>
                        <h3 class="text-xl font-bold text-[#191c1d] mb-4">Kategori</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kategori_filter" :checked="category === ''" @change="setCategory('')"
                                       class="w-5 h-5 rounded border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Semua Kategori</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kategori_filter" :checked="category === 'sepatu'" @change="setCategory('sepatu')"
                                       class="w-5 h-5 rounded border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Sepatu</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kategori_filter" :checked="category === 'tas'" @change="setCategory('tas')"
                                       class="w-5 h-5 rounded border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Tas</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kategori_filter" :checked="category === 'topi'" @change="setCategory('topi')"
                                       class="w-5 h-5 rounded border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Topi</span>
                            </label>
                        </div>
                    </div>

                    {{-- Kondisi Filter --}}
                    <div>
                        <h3 class="text-xl font-bold text-[#191c1d] mb-4">Kondisi</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter" :checked="condition === ''" @change="setCondition('')"
                                       class="w-5 h-5 border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Semua Kondisi</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter" :checked="condition === 'baru'" @change="setCondition('baru')"
                                       class="w-5 h-5 border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Baru</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter" :checked="condition === 'seperti_baru'" @change="setCondition('seperti_baru')"
                                       class="w-5 h-5 border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Like New</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter" :checked="condition === 'sudah_diperbaiki'" @change="setCondition('sudah_diperbaiki')"
                                       class="w-5 h-5 border-[#bcc9c6] text-[#22AF85] focus:ring-[#22AF85]"/>
                                <span class="text-sm font-medium text-[#191c1d] group-hover:text-[#22AF85]">Refurbished</span>
                            </label>
                        </div>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="lg:col-span-3 relative">
                    <!-- Loading overlay -->
                    <div x-show="loading" x-transition class="absolute inset-0 bg-white/70 z-10 flex items-center justify-center rounded-2xl" style="display: none;">
                        <div class="flex flex-col items-center gap-3">
                            <svg class="animate-spin h-8 w-8 text-[#22AF85]" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="text-xs font-bold text-[#191c1d] uppercase tracking-wider">Memuat barang...</span>
                        </div>
                    </div>

                    <!-- Items container -->
                    <div id="item-grid-container">
                        @include('katalog.partials.item-grid', ['items' => $items])
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Detail Modal -->
    <div x-show="detailOpen" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;" x-cloak>
        <div class="bg-white rounded-xl max-w-4xl w-full overflow-hidden relative shadow-2xl flex flex-col md:flex-row max-h-[90vh] md:max-h-none overflow-y-auto">
            <button class="absolute top-4 right-4 z-10 p-2 bg-white/80 rounded-full hover:bg-white border border-[#bcc9c6]" @click="closeDetail()">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <div class="w-full md:w-1/2 bg-[#f3f4f5] p-6 border-b-2 md:border-b-0 md:border-r border-[#bcc9c6] flex flex-col space-y-4">
                <!-- Large image -->
                <div class="flex-grow aspect-[4/3] rounded-xl border border-[#bcc9c6] overflow-hidden bg-white relative flex items-center justify-center">
                    <img :src="activeImage" :alt="activeItem?.nama" class="w-full h-full object-cover">
                </div>
                <!-- Detail thumbs -->
                <div class="flex gap-2 overflow-x-auto py-1">
                    <button @click="activeImage = activeItem ? activeItem.foto_utama_url : ''"
                            :class="activeImage === (activeItem ? activeItem.foto_utama_url : '') ? 'border-2 border-[#22AF85]' : 'border border-[#bcc9c6]'"
                            class="w-16 h-16 rounded-lg overflow-hidden bg-white flex-shrink-0">
                        <img :src="activeItem ? activeItem.foto_utama_url : ''" class="w-full h-full object-cover">
                    </button>
                    <template x-for="(photoUrl, idx) in activeItem?.foto_detail_urls" :key="idx">
                        <button @click="activeImage = photoUrl"
                                :class="activeImage === photoUrl ? 'border-2 border-[#22AF85]' : 'border border-[#bcc9c6]'"
                                class="w-16 h-16 rounded-lg overflow-hidden bg-white flex-shrink-0">
                            <img :src="photoUrl" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-xs font-bold text-[#22AF85] uppercase tracking-wider" x-text="`Kategori: ${activeItem?.kategori}`"></span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-[#191c1d] leading-snug" x-text="activeItem?.nama"></h2>
                    <p class="text-sm text-[#22AF85] font-bold" x-text="`Brand: ${activeItem?.brand || '-'}`"></p>
                    
                    <div class="space-y-4 border-t border-[#bcc9c6] pt-4">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#22AF85]">verified</span>
                            <div>
                                <h5 class="text-xs font-bold text-[#191c1d]">Kondisi Terverifikasi</h5>
                                <p class="text-xs text-[#3d4947] mt-0.5 leading-relaxed" x-text="activeItem?.deskripsi || 'Barang telah melalui proses kurasi dan perbaikan tim kami.'"></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#22AF85]">local_shipping</span>
                            <div>
                                <h5 class="text-xs font-bold text-[#191c1d]">Pengiriman Gratis</h5>
                                <p class="text-xs text-[#3d4947] mt-0.5">Disediakan untuk penerima atau keluarga pra-sejahtera yang berhak.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-[#bcc9c6] mt-6">
                    <button class="w-full py-4 bg-[#22AF85] text-white rounded-lg text-sm font-bold hover:opacity-90 transition-all flex items-center justify-center gap-2"
                            :disabled="activeItem?.status !== 'tersedia'"
                            @click="openForm()">
                        <span class="material-symbols-outlined">send</span>
                        Ajukan Permohonan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Form Modal -->
    <div x-show="formOpen" class="fixed inset-0 z-[70] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;" x-cloak>
        <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl relative">
            <button class="absolute top-4 right-4 p-2 rounded-full hover:bg-[#f3f4f5]" @click="closeForm()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <h3 class="text-xl font-bold text-[#191c1d] mb-1">Form Pengajuan</h3>
            <p class="text-xs text-[#3d4947] mb-6">Mohon lengkapi data berikut untuk mengajukan permohonan barang.</p>
            
            <form class="space-y-4" @submit.prevent="submitRequest">
                <div x-show="generalError" x-text="generalError" class="p-3 bg-red-50 text-red-600 text-xs font-semibold rounded-lg border border-red-100" style="display: none;"></div>

                <div>
                    <label class="block text-xs font-bold text-[#191c1d] mb-1">Nama Lengkap</label>
                    <input class="w-full px-4 py-3 rounded-lg border border-[#bcc9c6] focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] bg-[#f3f4f5] text-sm"
                           type="text" x-model="form.nama_pemohon" required placeholder="Contoh: Budi Santoso"/>
                    <span x-show="errors.nama_pemohon" x-text="errors.nama_pemohon" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#191c1d] mb-1">Nomor WhatsApp</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-xs font-black text-gray-400 select-none">+62</span>
                        <input class="w-full pl-12 pr-4 py-3 rounded-lg border border-[#bcc9c6] focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] bg-[#f3f4f5] text-sm"
                               type="tel" x-model="form.kontak_pemohon" required placeholder="8123456789"/>
                    </div>
                    <p class="text-[9px] text-gray-400 mt-1 font-semibold">Tulis tanpa angka 0 atau +62 di depan</p>
                    <span x-show="errors.kontak_pemohon" x-text="errors.kontak_pemohon" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#191c1d] mb-1">Alamat Pengiriman</label>
                    <textarea class="w-full px-4 py-3 rounded-lg border border-[#bcc9c6] focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] bg-[#f3f4f5] text-sm"
                              rows="3" x-model="form.alamat_pengiriman" required placeholder="Alamat lengkap tujuan pengiriman..."></textarea>
                    <span x-show="errors.alamat_pengiriman" x-text="errors.alamat_pengiriman" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                </div>
                
                <button class="w-full py-4 bg-[#22AF85] text-white rounded-lg font-bold text-sm hover:opacity-90 active:scale-[0.99] transition-all shadow-md mt-4 flex items-center justify-center gap-2"
                        type="submit" :disabled="submitting">
                    <span x-show="!submitting">Kirim Pengajuan</span>
                    <span x-show="submitting" class="flex items-center gap-1.5" style="display: none;">
                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mengirim...
                    </span>
                </button>
            </form>
        </div>
    </div>

    <!-- Success Message Modal -->
    <div x-show="successOpen" class="fixed inset-0 z-[80] flex items-center justify-center p-4 bg-black/60 backdrop-blur-md" style="display: none;" x-cloak>
        <div class="bg-white rounded-xl max-w-sm w-full p-6 shadow-2xl text-center space-y-4">
            <div class="w-20 h-20 bg-green-50 text-green-700 rounded-full flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined" style="font-size: 48px;">check_circle</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-[#191c1d]">Pengajuan Terkirim!</h3>
                <p class="text-xs text-[#3d4947] mt-2 leading-relaxed">Data Anda telah kami simpan. Hubungi WhatsApp Admin untuk proses verifikasi alamat lebih cepat.</p>
            </div>
            <a class="block w-full py-4 bg-[#25D366] text-white rounded-lg text-sm font-bold hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-2 shadow-sm"
               :href="whatsappUrl" target="_blank" id="waLink">
                Hubungi via WhatsApp
            </a>
            <button class="text-sm text-[#3d4947] hover:underline" @click="closeAll()">Kembali ke Katalog</button>
        </div>
    </div>

    <!-- Footer Component -->
    @include('components.footer', ['settings' => $settings])

    <script>
    function catalogApp() {
        return {
            search: '',
            category: '',
            condition: '',
            loading: false,
            detailOpen: false,
            formOpen: false,
            successOpen: false,
            mobileMenuOpen: false,
            submitting: false,
            whatsappUrl: '#',
            activeItem: null,
            activeImage: '',
            
            form: {
                nama_pemohon: '',
                kontak_pemohon: '',
                alamat_pengiriman: ''
            },
            errors: {
                nama_pemohon: '',
                kontak_pemohon: '',
                alamat_pengiriman: ''
            },
            generalError: '',

            initApp() {
                const urlParams = new URLSearchParams(window.location.search);
                this.search = urlParams.get('search') || '';
                this.category = urlParams.get('category') || '';
                this.condition = urlParams.get('condition') || '';
                
                // Listen to Escape key to close modals
                window.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeDetail();
                        this.closeForm();
                    }
                });
            },

            async fetchFilter() {
                this.loading = true;
                try {
                    const url = new URL("{{ route('katalog.filter') }}", window.location.origin);
                    if (this.search) url.searchParams.set('search', this.search);
                    if (this.category) url.searchParams.set('category', this.category);
                    if (this.condition) url.searchParams.set('condition', this.condition);

                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        const html = await response.text();
                        document.getElementById('item-grid-container').innerHTML = html;
                    } else {
                        console.error('Filtering failed');
                    }
                } catch (err) {
                    console.error('Connection error:', err);
                } finally {
                    this.loading = false;
                }
            },

            setCategory(cat) {
                this.category = cat;
                this.fetchFilter();
                
                const url = new URL(window.location.href);
                if (cat) {
                    url.searchParams.set('category', cat);
                } else {
                    url.searchParams.delete('category');
                }
                window.history.pushState({}, '', url.toString());
            },

            setCondition(cond) {
                this.condition = cond;
                this.fetchFilter();
                
                const url = new URL(window.location.href);
                if (cond) {
                    url.searchParams.set('condition', cond);
                } else {
                    url.searchParams.delete('condition');
                }
                window.history.pushState({}, '', url.toString());
            },

            openDetail(item) {
                this.activeItem = item;
                this.activeImage = item.foto_utama_url;
                this.detailOpen = true;
            },

            closeDetail() {
                this.detailOpen = false;
            },

            openForm() {
                this.detailOpen = false;
                this.formOpen = true;
                this.generalError = '';
                this.errors = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };
                
                @auth
                    this.form.nama_pemohon = "{{ Auth::user()->name }}";
                    this.form.kontak_pemohon = "{{ Auth::user()->phone ? (str_starts_with(Auth::user()->phone, '62') ? substr(Auth::user()->phone, 2) : Auth::user()->phone) : '' }}";
                @endauth
            },

            closeForm() {
                this.formOpen = false;
                this.resetFormFields();
            },

            resetFormFields() {
                this.form = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };
                this.errors = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };
                this.generalError = '';
            },

            closeAll() {
                this.successOpen = false;
                this.formOpen = false;
                this.detailOpen = false;
                this.resetFormFields();
            },

            async submitRequest() {
                this.submitting = true;
                this.generalError = '';
                this.errors = { nama_pemohon: '', kontak_pemohon: '', alamat_pengiriman: '' };

                try {
                    const url = `/donasi-katalog/${this.activeItem.id}/request`;
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.form)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.formOpen = false;
                        this.successOpen = true;
                        this.whatsappUrl = data.redirect_url;
                        
                        // Mark item as distributed locally
                        this.activeItem.status = 'disalurkan';
                        this.fetchFilter();

                        // Open WhatsApp automatically
                        setTimeout(() => {
                            window.open(data.redirect_url, '_blank');
                        }, 800);
                    } else if (response.status === 422) {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(key => {
                                this.errors[key] = data.errors[key][0];
                            });
                        } else {
                            this.generalError = data.message || 'Validasi gagal. Harap periksa form Anda.';
                        }
                    } else {
                        this.generalError = data.message || 'Gagal memproses pengajuan. Silakan coba lagi.';
                    }
                } catch (err) {
                    console.error('Submission error:', err);
                    this.generalError = 'Terjadi gangguan jaringan. Pastikan Anda terhubung ke internet.';
                } finally {
                    this.submitting = false;
                }
            }
        }
    }
    </script>
</div>
@endsection
