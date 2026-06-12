@extends('layouts.main')
@section('seo_title', 'Ajukan Permohonan — ' . $item->nama . ' - Shoe Workshop')
@section('seo_description', 'Form pengajuan permohonan barang donasi ' . $item->nama . ' dari Shoe Workshop.')

@section('head')
<style>
    [x-cloak] { display: none !important; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .fill-1 { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .input-focus:focus {
        outline: none;
        border-color: #22AF85;
        box-shadow: 0 0 0 3px rgba(34, 175, 133, 0.12);
    }
</style>
@endsection

@section('content')
<div class="bg-[#f8f9fa] text-[#1c1c17] min-h-screen flex flex-col">

    {{-- NavBar --}}
    <header x-data="{ open: false }" class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="flex flex-col leading-tight">
                    <span class="text-lg font-extrabold text-[#1c1c17]">Shoe Workshop</span>
                    <div class="flex h-1 w-full">
                        <div class="w-1/2 bg-[#22AF85]"></div>
                        <div class="w-1/2 bg-[#FFC232]"></div>
                    </div>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-6 xl:gap-8">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Beranda</a>
                <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
                <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Portfolio</a>
                <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Donasi</a>
                <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Tracking</a>
                <a href="{{ route('warranty.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Garansi</a>
            </div>

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
                        @auth <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                        @else Akun @endauth
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
                                <span class="material-symbols-outlined !text-[18px]">dashboard</span> Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <span class="material-symbols-outlined !text-[18px]">logout</span> Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                                <span class="material-symbols-outlined !text-[18px]">login</span> Masuk (Login)
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                                    <span class="material-symbols-outlined !text-[18px]">person_add</span> Daftar (Register)
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

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
        </div>
    </header>

    <main class="pt-20 sm:pt-24 flex-grow max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-16 py-5 sm:py-8">

        {{-- Breadcrumb --}}
        <nav class="mb-4 sm:mb-6 flex items-center gap-1.5 sm:gap-2 text-gray-500 text-[10px] sm:text-xs font-semibold overflow-x-auto whitespace-nowrap">
            <a href="{{ route('katalog.index') }}" class="hover:text-[#22AF85] transition-colors shrink-0">Katalog Donasi</a>
            <span class="material-symbols-outlined !text-[14px] shrink-0">chevron_right</span>
            <a href="{{ route('katalog.show', $item) }}" class="hover:text-[#22AF85] transition-colors shrink-0 max-w-[120px] sm:max-w-none truncate">{{ $item->nama }}</a>
            <span class="material-symbols-outlined !text-[14px] shrink-0">chevron_right</span>
            <span class="text-[#22AF85] shrink-0">Ajukan Permohonan</span>
        </nav>

        {{-- Mobile: compact item summary strip --}}
        <div class="flex sm:hidden items-center gap-3 bg-white border border-gray-200 rounded-xl p-3 mb-4 shadow-sm">
            <div class="w-16 h-16 bg-gray-50 rounded-lg flex items-center justify-center p-1.5 shrink-0 border border-gray-100">
                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="max-h-full max-w-full object-contain">
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-[#22AF85] uppercase tracking-wider">{{ $item->brand ?? 'Shoe Workshop' }}</p>
                <p class="font-extrabold text-[#1c1c17] text-sm leading-tight truncate">{{ $item->nama }}</p>
                <div class="flex items-center gap-1.5 mt-1">
                    @php
                        $condBadgeClasses = [
                            'baru' => 'bg-blue-50 text-blue-700',
                            'seperti_baru' => 'bg-green-50 text-green-700',
                            'sudah_diperbaiki' => 'bg-yellow-50 text-yellow-700',
                        ];
                        $condBadgeLabels = [
                            'baru' => 'Baru',
                            'seperti_baru' => 'Sangat Baik',
                            'sudah_diperbaiki' => 'Refurbished',
                        ];
                    @endphp
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold {{ $condBadgeClasses[$item->kondisi] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $condBadgeLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                    </span>
                    @if($item->ukuran)
                        <span class="text-[9px] text-gray-400 font-semibold">Ukuran {{ $item->ukuran }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 sm:gap-6">

            {{-- Left Column: Item Preview — hidden on mobile (shown as strip above) --}}
            <div class="hidden sm:flex md:col-span-5 flex-col gap-5">

                {{-- Item Card --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="relative aspect-square w-full bg-gray-50 flex items-center justify-center p-8">
                        <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}"
                             class="max-h-full max-w-full object-contain transition-transform duration-400 hover:scale-105">
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                            <span class="bg-green-500 text-white px-2.5 py-1 rounded-full text-[10px] font-bold flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined !text-[12px]">verified</span>
                                Kualitas Terverifikasi
                            </span>
                        </div>
                    </div>
                    <div class="p-5 border-t border-gray-100">
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
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $condBadgeClasses[$item->kondisi] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $condBadgeLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                            </span>
                            @if($item->ukuran)
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-700">
                                    Ukuran: {{ $item->ukuran }}
                                </span>
                            @endif
                        </div>
                        <h2 class="font-extrabold text-[#1c1c17] text-lg leading-tight">{{ $item->nama }}</h2>
                        <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                            {{ Str::limit($item->deskripsi, 120) ?? 'Barang donasi berkualitas dari koleksi Shoe Workshop.' }}
                        </p>
                    </div>
                </div>

                {{-- Environmental Impact Card --}}
                <div class="bg-[#22AF85] text-white p-5 rounded-2xl shadow-md">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-symbols-outlined fill-1 !text-[24px]">eco</span>
                        <span class="font-bold text-base">Dampak Lingkungan</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[11px] font-bold opacity-75 uppercase mb-1">CO2 Dihemat</p>
                            <p class="font-extrabold text-xl">12.5 kg</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold opacity-75 uppercase mb-1">Air Terkonservasi</p>
                            <p class="font-extrabold text-xl">2,100 L</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Form --}}
            <div class="md:col-span-7">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-8">

                    {{-- Form Header --}}
                    <div class="mb-6">
                        <h1 class="text-2xl font-extrabold text-[#1c1c17] mb-1">Ajukan Permohonan</h1>
                        <p class="text-sm text-gray-500">Lengkapi data berikut untuk mengajukan permohonan barang donasi ini.</p>
                    </div>

                    {{-- Progress Indicator --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[11px] font-bold text-[#22AF85] uppercase tracking-wider">Data & Pengiriman</span>
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Langkah 1 dari 1</span>
                        </div>
                        <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-[#22AF85] rounded-full w-full transition-all"></div>
                        </div>
                    </div>

                    {{-- General Error --}}
                    @if ($errors->has('general'))
                        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined !text-[18px]">error</span>
                            {{ $errors->first('general') }}
                        </div>
                    @endif

                    <form action="{{ route('katalog.request', $item) }}" method="POST" class="space-y-5" id="requestForm">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="nama_pemohon" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">person</span>
                                <input type="text" id="nama_pemohon" name="nama_pemohon"
                                       value="{{ old('nama_pemohon', Auth::user()?->name ?? '') }}"
                                       placeholder="Masukkan nama lengkap Anda"
                                       required
                                       class="w-full pl-11 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all {{ $errors->has('nama_pemohon') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            </div>
                            @error('nama_pemohon')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor WhatsApp --}}
                        <div>
                            <label for="kontak_pemohon" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nomor WhatsApp</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">chat</span>
                                <span class="absolute left-10 top-1/2 -translate-y-1/2 text-xs font-black text-gray-400 select-none pl-1 border-r border-gray-200 pr-2">+62</span>
                                <input type="tel" id="kontak_pemohon" name="kontak_pemohon"
                                       value="{{ old('kontak_pemohon', Auth::user()?->phone ? (str_starts_with(Auth::user()->phone, '62') ? substr(Auth::user()->phone, 2) : Auth::user()->phone) : '') }}"
                                       placeholder="8123456789"
                                       required
                                       class="w-full pl-20 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all {{ $errors->has('kontak_pemohon') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            </div>
                            <p class="mt-1 text-[10px] text-gray-400 font-semibold">Tulis tanpa angka 0 atau +62 di depan</p>
                            @error('kontak_pemohon')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Alamat Pengiriman --}}
                        <div>
                            <label for="alamat_pengiriman" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Alamat Pengiriman</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-gray-400 !text-[20px]">location_on</span>
                                <textarea id="alamat_pengiriman" name="alamat_pengiriman"
                                          rows="3"
                                          required
                                          placeholder="Nama jalan, nomor rumah, kecamatan, dan kota..."
                                          class="w-full pl-11 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all resize-none {{ $errors->has('alamat_pengiriman') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">{{ old('alamat_pengiriman') }}</textarea>
                            </div>
                            @error('alamat_pengiriman')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-3 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <button type="submit" id="submitBtn"
                                    class="w-full py-4 bg-[#22AF85] hover:opacity-90 text-white rounded-xl font-bold text-sm shadow-md shadow-[#22AF85]/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                                <span id="btnText">Kirim Pengajuan</span>
                                <span class="material-symbols-outlined !text-[18px]" id="btnIcon">send</span>
                                <svg id="btnSpinner" class="hidden animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                            <a href="{{ route('katalog.show', $item) }}"
                               class="text-center sm:text-left text-sm text-gray-500 hover:text-[#22AF85] transition-colors font-semibold underline underline-offset-4">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Trust Bar --}}
                <div class="mt-5 sm:mt-6 flex justify-center items-center gap-5 sm:gap-8 opacity-50">
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">verified_user</span>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider">Data Aman</span>
                    </div>
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">local_shipping</span>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider">Gratis Kirim</span>
                    </div>
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">eco</span>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider">Ramah Lingkungan</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('components.footer', ['settings' => $settings])
</div>

<script>
document.getElementById('requestForm').addEventListener('submit', function () {
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnSpinner = document.getElementById('btnSpinner');

    btn.disabled = true;
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    btnText.textContent = 'Mengirim...';
    btnIcon.classList.add('hidden');
    btnSpinner.classList.remove('hidden');
});
</script>
@endsection
