@extends('layouts.main')
@section('seo_title', 'Tracking Pesanan | Shoe Workshop')
@section('seo_description', 'Lacak status pesanan reparasi sepatu kamu di Shoe Workshop.')

@section('content')

{{-- Navbar --}}
<nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-12 w-auto" />
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-600 hover:text-[#22AF85] transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Beranda
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-lg hover:bg-[#178a67] transition-colors">
                    Konsultasi
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="min-h-screen bg-gray-50">
    {{-- Header --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h1 class="text-2xl font-bold text-gray-900">
                    <span class="text-gray-900">STATUS</span>
                    <span class="text-[#22AF85] ml-2">ORDER</span>
                </h1>
                <a href="{{ route('warranty.index') }}" class="w-full sm:w-auto justify-center inline-flex items-center gap-1.5 text-xs font-semibold text-gray-650 hover:text-[#22AF85] transition-colors border border-gray-200 rounded-lg px-3.5 py-2 hover:bg-gray-50 bg-white shadow-sm">
                    🛡️ Ajukan Klaim Garansi
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

@include('components.footer', ['settings' => $settings])

@endsection