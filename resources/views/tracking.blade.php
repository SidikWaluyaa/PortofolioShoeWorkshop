@extends('layouts.main')
@section('seo_title', 'Tracking Pesanan | Shoe Workshop')
@section('seo_description', 'Lacak status pesanan reparasi sepatu kamu di Shoe Workshop.')

@section('content')

{{-- NAVBAR --}}
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
        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Beranda</a>
            <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
            <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Portfolio</a>
            <a href="{{ route('home') }}#review" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Review</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Tracking</a>
            <a href="{{ route('warranty.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Garansi</a>
            <a href="{{ route('home') }}#kontak" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Kontak</a>
        </div>

        {{-- CTA Button --}}
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
           class="hidden md:inline-flex items-center gap-2 px-6 py-2.5 bg-[#FFC232] text-[#1c1c17] text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#FFC232]/20">
            <span class="material-symbols-outlined !text-[20px]">chat</span>
            Konsultasi via WhatsApp
        </a>

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
         class="lg:hidden bg-white border-t border-gray-100 px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"         @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Beranda</a>
        <a href="{{ route('home') }}#layanan" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Layanan</a>
        <a href="{{ route('portfolio.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Portfolio</a>
        <a href="{{ route('home') }}#review"  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Review</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-[#22AF85] bg-green-50 rounded-lg">Tracking</a>
        <a href="{{ route('warranty.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Garansi</a>
        <a href="{{ route('home') }}#kontak"  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Kontak</a>
        <div class="pt-2">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#FFC232] text-[#1c1c17] text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined !text-[20px]">chat</span>
                Konsultasi via WhatsApp
            </a>
        </div>
    </div>
</header>

<main class="pt-20">
<div class="min-h-screen bg-gray-50/50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                <span>STATUS</span>
                <span class="text-[#22AF85]">ORDER</span>
            </h1>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Lacak status pengerjaan reparasi sepatu Anda secara real-time.
            </p>
            <div class="mt-4 flex items-center justify-center">
                <a href="{{ route('warranty.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-650 hover:text-[#22AF85] transition-colors border border-gray-200 rounded-lg px-3 py-1.5 hover:bg-gray-50 bg-white shadow-sm">
                    🛡️ Ajukan Klaim Garansi
                </a>
            </div>
        </div>
        {{-- Search Section --}}
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('tracking.index') }}">
                <div class="flex gap-3">
                    <input type="text"
                           name="q"
                           value="{{ $query ?? '' }}"
                           placeholder="Masukkan kode pesanan..."
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20">
                    <button type="submit" class="px-6 py-3 bg-[#22AF85] text-white font-semibold rounded-lg hover:bg-[#178a67] transition-colors">
                        Lacak
                    </button>
                </div>
            </form>
        </div>

        @if(isset($query) && $query)
            @if(isset($result) && $result)
            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Left Column - Customer Info --}}
                <div class="lg:col-span-1">
                    {{-- SPK Info --}}
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-2">Pencarian SPK</p>
                        <p class="text-lg font-bold text-gray-900">{{ $result['spk_number'] ?? '-' }}</p>
                    </div>

                    {{-- Customer Info Box --}}
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-[#22AF85]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900">Informasi Pelanggan</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Nama</p>
                                <p class="font-semibold text-gray-900">{{ $result['customer_name'] ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Layanan</p>
                                <p class="text-sm text-gray-600">
                                    @if($result['services'] ?? null)
                                        @foreach($result['services'] as $service)
                                        <span class="inline-block bg-[#e8f8f5] text-[#22AF85] text-xs font-semibold px-3 py-1 rounded mb-2 mr-2">
                                            {{ $service['service_name'] ?? '-' }}
                                        </span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Visual Kondisi</p>
                                <div class="flex gap-2 mt-3">
                                    @if($result['visual_photos']['before_photo_url'] ?? null)
                                    <div class="flex-1">
                                        <img src="{{ $result['visual_photos']['before_photo_url'] }}" alt="Sebelum" class="w-full h-24 object-cover rounded-lg">
                                        <p class="text-xs text-center text-gray-600 mt-1 font-semibold">SEBELUM</p>
                                    </div>
                                    @endif
                                    @if($result['visual_photos']['after_photo_url'] ?? null)
                                    <div class="flex-1">
                                        <img src="{{ $result['visual_photos']['after_photo_url'] }}" alt="Sesudah" class="w-full h-24 object-cover rounded-lg">
                                        <p class="text-xs text-center text-gray-600 mt-1 font-semibold">SESUDAH</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Shoe Info --}}
                    @if($result['shoe'] ?? null)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                            <h3 class="font-bold text-gray-900">Detail Sepatu</h3>
                        </div>
                        
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Brand</p>
                                <p class="font-semibold text-gray-900">{{ $result['shoe']['brand'] ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Tipe</p>
                                <p class="font-semibold text-gray-900">{{ $result['shoe']['type'] ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Warna</p>
                                <p class="font-semibold text-gray-900">{{ $result['shoe']['color'] ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Ukuran</p>
                                <p class="font-semibold text-gray-900">{{ $result['shoe']['size'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Right Column - Timeline --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm p-8">
                        <div class="flex items-center gap-2 mb-8">
                            <svg class="w-6 h-6 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-900">Timeline Pengerjaan</h2>
                        </div>

                        @if($result['timeline'] ?? null)
                        <div class="overflow-x-auto pb-4 mb-10 -mx-6 px-6 sm:-mx-0 sm:px-0 scrollbar-none">
                            <div class="flex items-center min-w-[500px] sm:min-w-0 sm:justify-between gap-1">
                                @php
                                    $timelineArray = (array) $result['timeline'];
                                @endphp
                                @foreach($timelineArray as $stageKey => $stage)
                                    @php
                                        $isCompleted = $stage['is_completed'] ?? false;
                                        $isCurrent = $stage['is_current'] ?? false;
                                    @endphp
                                    <div class="flex items-center flex-1">
                                        <div class="flex flex-col items-center flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white {{ $isCompleted || $isCurrent ? 'bg-[#22AF85]' : 'bg-gray-300' }}">
                                                @if($isCompleted && !$isCurrent)
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @else
                                                    {{ $loop->iteration }}
                                                @endif
                                            </div>
                                            <p class="text-xs font-semibold text-center mt-2 text-gray-700 max-w-16">{{ $stage['label'] ?? '-' }}</p>
                                        </div>
                                        @if(!$loop->last)
                                        <div class="flex-1 h-1 {{ $isCompleted ? 'bg-[#22AF85]' : 'bg-gray-300' }} mx-2 min-w-[24px]"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Timeline Details --}}
                        <div class="space-y-6 border-t border-gray-200 pt-8">
                            @foreach($timelineArray as $stageKey => $stage)
                                @php
                                    $isCompleted = $stage['is_completed'] ?? false;
                                    $isCurrent = $stage['is_current'] ?? false;
                                    $timestamp = $stage['waktu'] ?? null;
                                @endphp
                                <div class="flex gap-4">
                                    <div class="flex flex-col items-center flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white {{ $isCompleted || $isCurrent ? 'bg-[#22AF85]' : 'bg-gray-300' }}">
                                            @if($isCompleted && !$isCurrent)
                                                ✓
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </div>
                                        @if(!$loop->last)
                                        <div class="w-1 h-16 {{ $isCompleted ? 'bg-[#22AF85]' : 'bg-gray-300' }} my-2"></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 pt-2">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $stage['label'] ?? '-' }}</h4>
                                                @if($isCurrent)
                                                <span class="inline-block mt-1 px-3 py-1 text-xs font-bold bg-[#e8f8f5] text-[#22AF85] rounded-full">
                                                    Sedang Berlangsung
                                                </span>
                                                @elseif($isCompleted)
                                                <span class="inline-block mt-1 px-3 py-1 text-xs font-bold bg-green-100 text-green-700 rounded-full">
                                                    Selesai
                                                </span>
                                                @else
                                                <span class="inline-block mt-1 px-3 py-1 text-xs font-bold bg-gray-100 text-gray-700 rounded-full">
                                                    Menunggu
                                                </span>
                                                @endif
                                            </div>
                                            @if($timestamp)
                                            <div class="text-right flex-shrink-0">
                                                <p class="text-xs font-bold text-gray-600">{{ \Carbon\Carbon::parse($timestamp)->format('d M Y') }}</p>
                                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($timestamp)->format('H:i') }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Status Description Box --}}
                        @if($result['current_status']['description'] ?? null)
                        <div class="mt-8 p-4 bg-[#e8f8f5] border border-[#22AF85]/30 rounded-lg">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-[#22AF85] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-bold text-[#22AF85] mb-1">Status Saat Ini: {{ $result['current_status']['label'] ?? '-' }}</p>
                                    <p class="text-sm text-gray-700">{{ $result['current_status']['description'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @elseif(isset($error) && $error)
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Pesanan Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-6">{{ $error }}</p>
                <a href="{{ route('tracking.index') }}" class="inline-block px-6 py-2 bg-[#22AF85] text-white font-semibold rounded-lg hover:bg-[#178a67] transition-colors">
                    Coba Lagi
                </a>
            </div>
            @endif
        @endif
    </div>
</div>
</main>

@include('components.footer', ['settings' => $settings])

@endsection