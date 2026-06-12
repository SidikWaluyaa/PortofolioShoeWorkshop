@extends('layouts.main')
@section('seo_title', 'Tracking Pesanan | Shoe Workshop')
@section('seo_description', 'Lacak status pesanan reparasi sepatu kamu di Shoe Workshop.')

@section('head')
<style>
    @keyframes bounce-x {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(4px); }
    }
    .animate-bounce-horizontal {
        display: inline-block;
        animation: bounce-x 1.2s ease-in-out infinite;
    }
</style>
@endsection

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
            <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Donasi</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Tracking</a>
            <a href="{{ route('warranty.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Garansi</a>
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
        <a href="{{ route('katalog.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Donasi</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-[#22AF85] bg-green-50 rounded-lg">Tracking</a>
        <a href="{{ route('warranty.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Garansi</a>
        <div class="pt-2">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#FFC232] text-[#1c1c17] text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined !text-[20px]">chat</span>
                Konsultasi via WhatsApp
            </a>
        </div>
    </div>
</header>

<main class="pt-24 pb-16 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
    @if(isset($query) && $query)
        @if(isset($result) && $result)
            <!-- Search & Header Section -->
            <header class="mb-6 md:mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <p class="font-label-bold text-label-bold text-primary mb-2 uppercase tracking-widest">Tracking Order</p>
                    <h1 class="text-3xl md:text-headline-xl font-bold mb-4 text-on-surface break-all sm:break-normal">{{ $result['spk_number'] ?? '-' }}</h1>
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="bg-primary-container text-on-primary-container px-3 py-1 rounded-full font-label-bold text-label-bold">{{ strtoupper($result['current_status']['label'] ?? '-') }}</span>
                        @if(isset($result['estimated_finish_date']))
                        <span class="text-on-surface-variant font-body-sm text-body-sm">Estimasi Selesai: {{ \Carbon\Carbon::parse($result['estimated_finish_date'])->format('d M Y') }}</span>
                        @endif
                    </div>
                </div>
                <div class="w-full md:w-[400px]">
                    <form method="GET" action="{{ route('tracking.index') }}">
                        <div class="relative">
                            <input class="w-full bg-white border-2 border-on-surface px-4 sm:px-6 py-3.5 sm:py-4 rounded-xl focus:ring-0 focus:border-primary transition-all font-body-md text-body-md outline-none" 
                                   placeholder="Cari SPK Number lain..." 
                                   name="q" 
                                   value="{{ $query ?? '' }}" 
                                   type="text"
                                   required/>
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-secondary-container p-2 rounded-lg text-on-surface active:scale-90 transition-transform">
                                <span class="material-symbols-outlined">search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </header>

            <!-- Status Overview Stepper -->
            <section class="mb-6 md:mb-10 bg-white p-5 sm:p-8 rounded-2xl border-2 border-on-surface custom-shadow-hard">
                {{-- Mobile scroll hint --}}
                <div class="flex justify-between items-center mb-4 md:hidden">
                    <span class="text-xs font-extrabold uppercase text-on-surface-variant tracking-wider">Status Progres</span>
                    <div class="flex items-center gap-1.5 text-xs text-primary font-bold">
                        <span>Geser untuk detail</span>
                        <span class="material-symbols-outlined !text-[16px] animate-bounce-horizontal">arrow_forward</span>
                    </div>
                </div>

                <div class="overflow-x-auto scrollbar-none scroll-smooth">
                    <div class="min-w-[680px] md:min-w-0 flex justify-between relative py-2">
                        <!-- Progress Line Background -->
                        <div class="absolute top-[22px] left-0 w-full h-[2px] bg-surface-container-highest -z-0"></div>
                        <!-- Active Progress Line -->
                        @php
                            $timelineArray = (array) $result['timeline'];
                            $totalStages = count($timelineArray);
                            $completedCount = 0;
                            foreach ($timelineArray as $stage) {
                                if ($stage['is_completed'] ?? false) {
                                    $completedCount++;
                                }
                            }
                            $percent = $totalStages > 1 ? (($completedCount - 1) / ($totalStages - 1)) * 100 : 0;
                            $percent = max(0, min(100, $percent));
                        @endphp
                        <div class="absolute top-[22px] left-0 h-[2px] bg-primary -z-0 transition-all duration-1000" style="width: {{ $percent }}%"></div>
                        <!-- Steps -->
                        @foreach($timelineArray as $stageKey => $stage)
                            @php
                                $isCompleted = $stage['is_completed'] ?? false;
                                $isCurrent = $stage['is_current'] ?? false;
                                $icon = 'circle';
                                $labelLower = strtolower($stage['label'] ?? '');
                                if (str_contains($labelLower, 'terima') || str_contains($labelLower, 'diterima')) {
                                    $icon = 'check_circle';
                                } elseif (str_contains($labelLower, 'cuci') || str_contains($labelLower, 'clean')) {
                                    $icon = 'cleaning_services';
                                } elseif (str_contains($labelLower, 'reparasi') || str_contains($labelLower, 'proses') || str_contains($labelLower, 'reglue') || str_contains($labelLower, 'repaint')) {
                                    $icon = 'construction';
                                } elseif (str_contains($labelLower, 'selesai') || str_contains($labelLower, 'ready')) {
                                    $icon = 'verified';
                                } elseif (str_contains($labelLower, 'kirim') || str_contains($labelLower, 'dikirim') || str_contains($labelLower, 'ambil')) {
                                    $icon = 'local_shipping';
                                } else {
                                    $icon = $isCompleted ? 'check_circle' : 'circle';
                                }
                            @endphp
                            <div class="flex flex-col items-center gap-3 relative z-10">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center border-4 border-white transition-all duration-300 {{ $isCompleted || $isCurrent ? 'bg-primary text-white' : 'bg-surface-container-highest text-on-surface-variant' }}">
                                    <span class="material-symbols-outlined" style="{{ $isCompleted || $isCurrent ? "font-variation-settings: 'FILL' 1;" : '' }}">{{ $icon }}</span>
                                </div>
                                <span class="font-label-bold text-label-bold {{ $isCompleted || $isCurrent ? 'text-primary' : 'text-on-surface-variant' }}">{{ strtoupper($stage['label'] ?? '') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-gutter items-start">
                <!-- Left Column: Customer & Progress Photos -->
                <div class="order-2 lg:order-1 lg:col-span-7 flex flex-col gap-6 md:gap-gutter">
                    <!-- Customer & Item Info -->
                    <div class="bg-white p-5 sm:p-8 rounded-2xl border border-on-surface tracking-card">
                        <h3 class="text-2xl sm:text-headline-lg font-bold mb-6">Detail Pesanan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">
                            <div>
                                <p class="font-label-bold text-label-bold text-on-surface-variant uppercase mb-1">Pelanggan</p>
                                <p class="text-lg sm:text-title-md font-bold text-on-surface">{{ $result['customer_name'] ?? '-' }}</p>
                                @if($result['shoe']['size'] ?? null)
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">Ukuran Sepatu: {{ $result['shoe']['size'] ?? '-' }}</p>
                                @endif
                            </div>
                            <div>
                                <p class="font-label-bold text-label-bold text-on-surface-variant uppercase mb-1">Item & Layanan</p>
                                <p class="text-lg sm:text-title-md font-bold text-on-surface">{{ ($result['shoe']['brand'] ?? '') . ' ' . ($result['shoe']['type'] ?? '-') }}</p>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @if($result['services'] ?? null)
                                        @foreach($result['services'] as $service)
                                        <span class="bg-surface-container px-2 py-1 rounded text-[10px] font-bold uppercase text-on-surface-variant">{{ $service['service_name'] ?? '-' }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documentation -->
                    @if(($result['visual_photos']['before_photo_url'] ?? null) || ($result['visual_photos']['after_photo_url'] ?? null))
                    <div class="bg-white p-5 sm:p-8 rounded-2xl border border-on-surface tracking-card">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl sm:text-headline-lg font-bold">Workshop Documentation</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if($result['visual_photos']['before_photo_url'] ?? null)
                            <div class="relative group">
                                <img class="w-full h-48 sm:h-64 object-cover rounded-xl grayscale" src="{{ $result['visual_photos']['before_photo_url'] }}" alt="Sebelum"/>
                                <span class="absolute top-4 left-4 bg-on-surface text-white px-3 py-1 rounded-full text-[10px] font-bold shadow-sm">BEFORE</span>
                            </div>
                            @endif
                            @if($result['visual_photos']['after_photo_url'] ?? null)
                            <div class="relative group">
                                <img class="w-full h-48 sm:h-64 object-cover rounded-xl" src="{{ $result['visual_photos']['after_photo_url'] }}" alt="Sesudah/Progres"/>
                                <span class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-[10px] font-bold shadow-sm">AFTER / PROGRESS</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Timeline -->
                <div class="order-1 lg:order-2 lg:col-span-5">
                    <div class="bg-white p-5 sm:p-8 rounded-2xl border border-on-surface tracking-card h-full">
                        <h3 class="text-2xl sm:text-headline-lg font-bold mb-8">Timeline Pengerjaan</h3>
                        <div class="space-y-10 relative">
                            <!-- Connecting Line -->
                            <div class="absolute top-2 left-6 bottom-4 w-1 bg-surface-container-highest -z-0"></div>
                            
                            <!-- Timeline Items -->
                            @foreach($timelineArray as $stageKey => $stage)
                                @php
                                    $isCompleted = $stage['is_completed'] ?? false;
                                    $isCurrent = $stage['is_current'] ?? false;
                                    $timestamp = $stage['waktu'] ?? null;
                                @endphp
                                <div class="flex gap-4 sm:gap-6 relative z-10 {{ $isCompleted || $isCurrent ? '' : 'opacity-70' }}">
                                    <div class="w-12 h-12 rounded-full border-4 border-white flex items-center justify-center shrink-0 {{ $isCurrent ? 'bg-primary-container text-white' : ($isCompleted ? 'bg-primary text-white' : 'bg-surface-container-highest text-on-surface-variant') }}">
                                        @if($isCurrent)
                                            <span class="material-symbols-outlined text-white text-[20px]">rebase_edit</span>
                                        @elseif($isCompleted)
                                            <span class="material-symbols-outlined text-white text-[20px]">check</span>
                                        @else
                                            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">schedule</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                                            <span class="text-base sm:text-title-md font-bold text-on-surface">{{ $stage['label'] ?? '-' }}</span>
                                            @if($isCurrent)
                                                <span class="bg-secondary-container text-on-secondary-container text-[10px] font-black px-2 py-0.5 rounded-full uppercase">Sedang Berjalan</span>
                                            @elseif($isCompleted)
                                                <span class="bg-surface-container-highest text-on-surface-variant text-[10px] font-black px-2 py-0.5 rounded-full uppercase">Selesai</span>
                                            @else
                                                <span class="bg-surface-container-highest text-on-surface-variant text-[10px] font-black px-2 py-0.5 rounded-full uppercase">Menunggu</span>
                                            @endif
                                        </div>
                                        @if($timestamp)
                                            <p class="text-on-surface-variant font-body-sm text-body-sm">{{ \Carbon\Carbon::parse($timestamp)->format('d M Y, H:i') }} WIB</p>
                                        @endif
                                        @if($isCurrent && isset($result['current_status']['description']))
                                            <p class="font-body-md text-body-md mt-2 text-on-surface">{{ $result['current_status']['description'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions / Support -->
            <section class="mt-6 md:mt-10 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-gutter">
                <a href="{{ route('warranty.index') }}?spk_number={{ $result['spk_number'] ?? '' }}" class="bg-white p-5 sm:p-8 rounded-2xl border-2 border-on-surface flex items-start gap-4 sm:gap-6 hover:translate-x-2 transition-transform cursor-pointer group text-left">
                    <div class="bg-error-container text-on-error-container w-12 h-12 sm:w-16 sm:h-16 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px] sm:text-[32px]">verified_user</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl sm:text-[24px] font-bold mb-2 group-hover:text-primary transition-colors text-on-surface">Ajukan Klaim Garansi</h4>
                        <p class="font-body-sm text-body-sm sm:text-body-md text-on-surface-variant">Layanan kami dilindungi garansi hasil pengerjaan selama 100 hari kerja.</p>
                    </div>
                    <span class="material-symbols-outlined self-center text-on-surface-variant ml-auto">arrow_forward_ios</span>
                </a>
                
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank" class="bg-secondary-container p-5 sm:p-8 rounded-2xl border-2 border-on-surface flex items-start gap-4 sm:gap-6 hover:translate-x-2 transition-transform cursor-pointer group custom-shadow-hard text-left">
                    <div class="bg-on-secondary-container text-white w-12 h-12 sm:w-16 sm:h-16 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px] sm:text-[32px]">support_agent</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl sm:text-[24px] font-bold mb-2 text-on-secondary-container">Chat Konsultan Workshop</h4>
                        <p class="font-body-sm text-body-sm sm:text-body-md text-on-secondary-fixed-variant">Ada pertanyaan tentang progres sepatu Anda? Hubungi tim ahli kami.</p>
                    </div>
                    <span class="material-symbols-outlined self-center text-on-secondary-container ml-auto">arrow_forward_ios</span>
                </a>
            </section>

        @elseif(isset($error) && $error)
            <!-- Error State: Order Not Found -->
            <div class="max-w-xl mx-auto py-16 text-center">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-error-container text-error rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-error/20">
                    <span class="material-symbols-outlined text-[36px] sm:text-[48px]">error</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface mb-3 tracking-tight">Pesanan Tidak Ditemukan</h2>
                <p class="text-on-surface-variant text-sm mb-8 max-w-md mx-auto">
                    {{ $error }}
                </p>
                <div class="bg-white p-5 sm:p-6 rounded-2xl border-2 border-on-surface custom-shadow-hard">
                    <form method="GET" action="{{ route('tracking.index') }}">
                        <div class="relative">
                            <input class="w-full bg-white border-2 border-on-surface px-4 sm:px-6 py-3.5 sm:py-4 rounded-xl focus:ring-0 focus:border-primary transition-all font-body-md text-body-md outline-none" 
                                   placeholder="Cari nomor SPK lain..." 
                                   name="q" 
                                   value="{{ $query ?? '' }}" 
                                   type="text"
                                   required/>
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-secondary-container p-2 rounded-lg text-on-surface active:scale-90 transition-transform">
                                <span class="material-symbols-outlined">search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @else
        <!-- Welcome State: Standby search -->
        <div class="max-w-xl mx-auto py-16 text-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-[#e8f8f5] text-primary rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-primary/20">
                <span class="material-symbols-outlined text-[36px] sm:text-[48px]" style="font-variation-settings: 'FILL' 1;">package_2</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-on-surface mb-3 tracking-tight">Lacak Status Pesanan Anda</h2>
            <p class="text-on-surface-variant text-sm mb-8 max-w-md mx-auto">
                Masukkan nomor SPK (Surat Perintah Kerja) Anda untuk melihat progres pengerjaan sepatu secara real-time.
            </p>
            <div class="bg-white p-5 sm:p-6 rounded-2xl border-2 border-on-surface custom-shadow-hard">
                <form method="GET" action="{{ route('tracking.index') }}">
                    <div class="relative">
                        <input class="w-full bg-white border-2 border-on-surface px-4 sm:px-6 py-3.5 sm:py-4 rounded-xl focus:ring-0 focus:border-primary transition-all font-body-md text-body-md outline-none" 
                               placeholder="Masukkan nomor SPK..." 
                               name="q" 
                               value="{{ $query ?? '' }}" 
                               type="text"
                               required/>
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-secondary-container p-2 rounded-lg text-on-surface active:scale-90 transition-transform">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</main>

@include('components.footer', ['settings' => $settings])

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Micro-interactions for tracking ID copy or search animation
        const searchInput = document.querySelector('input');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                searchInput.parentElement.classList.add('scale-[1.02]');
            });
            searchInput.addEventListener('blur', () => {
                searchInput.parentElement.classList.remove('scale-[1.02]');
            });
        }

        // Simple Fade-in effect for timeline items
        const timelineItems = document.querySelectorAll('.space-y-10 > div');
        timelineItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = `all 0.5s ease ${index * 0.1}s`;
            
            setTimeout(() => {
                const isHalfOpaque = item.classList.contains('opacity-70');
                item.style.opacity = isHalfOpaque ? '0.7' : '1';
                item.style.transform = 'translateY(0)';
            }, 100);
        });
    });
</script>

@endsection