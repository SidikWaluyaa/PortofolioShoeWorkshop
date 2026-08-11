@extends('layouts.main')
@section('seo_title', 'Tracking Pesanan | Shoe Workshop')
@section('seo_description', 'Lacak status pesanan reparasi sepatu kamu di Shoe Workshop.')

@section('head')
<style>
    @verbatim
    @keyframes bounce-x {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(4px); }
    }
    .animate-bounce-horizontal {
        display: inline-block;
        animation: bounce-x 1.2s ease-in-out infinite;
    }
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up {
        animation: fade-in-up 0.5s ease both;
    }
    @endverbatim
</style>
@endsection

@section('content')

@include('layouts.navigation-public')

<main class="pt-20 pb-16 min-h-screen bg-gray-50">
    {{-- Header --}}
    <div class="bg-gradient-to-br from-green-50/60 to-white py-16 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block text-xs font-bold tracking-[0.25em] text-[#22AF85] uppercase mb-3">Tracking Pesanan</span>
            <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Lacak Pesanan Anda</h1>
            <p class="text-gray-500 max-w-xl mx-auto text-base">Masukkan nomor SPK (Surat Perintah Kerja) untuk melihat progres pengerjaan sepatu secara real-time.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

    @if(isset($query) && $query)
        @if(isset($result) && $result)

            {{-- ── TOP SEARCH BAR ── --}}
            <div class="mb-8">
                <form method="GET" action="{{ route('tracking.index') }}">
                    <div class="relative max-w-md">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 !text-[20px]">search</span>
                        <input
                            class="w-full bg-white border border-gray-200 pl-10 pr-12 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] outline-none transition-all shadow-sm"
                            placeholder="Cari nomor SPK lain..."
                            name="q"
                            value="{{ $query ?? '' }}"
                            type="text"
                            required/>
                        <button type="submit" aria-label="Cari"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-[#22AF85] text-white p-1.5 rounded-lg active:scale-90 transition-transform">
                            <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── HEADER: SPK + STATUS ── --}}
            <div class="mb-6 fade-in-up">
                <p class="text-xs font-bold text-[#22AF85] tracking-widest uppercase mb-1">Tracking Order</p>
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1c1c17] tracking-tight font-mono">{{ $result['spk_number'] ?? '-' }}</h1>
                    @if(($result['is_on_hold'] ?? false))
                        <span class="bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <span class="material-symbols-outlined !text-[14px]">warning</span>
                            {{ $result['status_label'] ?? 'CX Follow Up' }}
                        </span>
                    @else
                        <span class="bg-[#22AF85] text-white text-xs font-bold px-3 py-1 rounded-full">{{ strtoupper($result['current_status']['label'] ?? '-') }}</span>
                    @endif
                    @if(isset($result['estimated_finish_date']))
                        <span class="text-gray-400 text-xs">Est. Selesai: {{ \Carbon\Carbon::parse($result['estimated_finish_date'])->format('d M Y') }}</span>
                    @endif
                </div>
            </div>

            {{-- ── PROGRESS STEPPER ── --}}
            @php
                $timelineArray = (array) $result['timeline'];
                $totalStages = count($timelineArray);
                $completedCount = 0;
                foreach ($timelineArray as $stage) {
                    if ($stage['is_completed'] ?? false) $completedCount++;
                }
                $percent = $totalStages > 1 ? (($completedCount - 1) / ($totalStages - 1)) * 100 : 0;
                $percent = max(0, min(100, $percent));
            @endphp

            <div class="mb-6 bg-white rounded-2xl border border-gray-200 shadow-sm p-4 sm:p-6 fade-in-up" style="animation-delay:.05s">
                <div class="flex items-center justify-between mb-3 md:hidden">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Progres</span>
                    <span class="flex items-center gap-1 text-xs text-[#22AF85] font-bold">
                        <span>Geser</span>
                        <span class="material-symbols-outlined !text-[14px] animate-bounce-horizontal">arrow_forward</span>
                    </span>
                </div>
                <div class="overflow-x-auto scrollbar-none">
                    <div class="min-w-[560px] md:min-w-0 flex justify-between items-start relative pt-1 pb-3">
                        {{-- Track --}}
                        <div class="absolute top-[18px] left-0 w-full h-[2px] bg-gray-100"></div>
                        <div class="absolute top-[18px] left-0 h-[2px] bg-[#22AF85] transition-all duration-1000" style="width:{{ $percent }}%"></div>

                        @foreach($timelineArray as $stageKey => $stage)
                            @php
                                $done = $stage['is_completed'] ?? false;
                                $curr = $stage['is_current'] ?? false;
                                $lbl = strtolower($stage['label'] ?? '');
                                if (str_contains($lbl,'terima') || str_contains($lbl,'diterima')) $ico='check_circle';
                                elseif (str_contains($lbl,'cuci')) $ico='cleaning_services';
                                elseif (str_contains($lbl,'reparasi')||str_contains($lbl,'repaint')||str_contains($lbl,'reglue')||str_contains($lbl,'service')) $ico='construction';
                                elseif (str_contains($lbl,'selesai')||str_contains($lbl,'ready')) $ico='verified';
                                elseif (str_contains($lbl,'kirim')||str_contains($lbl,'ambil')) $ico='local_shipping';
                                elseif (str_contains($lbl,'qc')||str_contains($lbl,'check')) $ico='fact_check';
                                else $ico = $done ? 'check_circle' : 'circle';
                            @endphp
                            <div class="flex flex-col items-center gap-2 relative z-10 min-w-[70px]">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center border-2 border-white shadow-sm text-white transition-all
                                    {{ $done || $curr ? 'bg-[#22AF85]' : 'bg-gray-200 text-gray-400' }}">
                                    <span class="material-symbols-outlined !text-[16px]" @if($done || $curr) style="font-variation-settings:'FILL' 1" @endif>{{ $ico }}</span>
                                </div>
                                <span class="text-[9px] font-bold text-center uppercase leading-tight {{ $done || $curr ? 'text-[#22AF85]' : 'text-gray-400' }}">{{ $stage['label'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── BANNER CX FOLLOW UP ── --}}
            @if(($result['is_on_hold'] ?? false))
            <div class="mb-6 fade-in-up bg-orange-50 border border-orange-200 rounded-2xl p-5 flex flex-col sm:flex-row gap-4 items-start" style="animation-delay:.07s">
                <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined !text-[22px]">report_problem</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-extrabold text-orange-700 mb-1">{{ $result['hold_title'] ?? 'Konfirmasi Diperlukan' }}</p>
                    <p class="text-xs text-orange-600 leading-relaxed">{{ $result['hold_message'] ?? '' }}</p>
                    @if(($result['report_issue_url'] ?? null))
                    <a href="{{ $result['report_issue_url'] }}" target="_blank"
                       class="inline-flex items-center gap-1.5 mt-3 text-xs font-bold text-orange-700 bg-orange-100 hover:bg-orange-200 px-3 py-1.5 rounded-lg transition-colors">
                        <span class="material-symbols-outlined !text-[14px]">open_in_new</span>
                        Lihat Laporan Kendala (CX Report)
                    </a>
                    @endif
                </div>
            </div>
            @endif

            {{-- ── MAIN GRID ── --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 sm:gap-6 items-start">

                {{-- LEFT: Detail + Dokumentasi --}}
                <div class="lg:col-span-3 flex flex-col gap-4 sm:gap-6 order-2 lg:order-1">

                    {{-- Detail Pesanan --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6 fade-in-up" style="animation-delay:.1s">
                        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Detail Pesanan</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Pelanggan</p>
                                <p class="text-base font-bold text-[#1c1c17]">{{ $result['customer_name'] ?? '-' }}</p>
                                @if($result['shoe']['size'] ?? null)
                                    <p class="text-xs text-gray-400 mt-1">Ukuran: {{ $result['shoe']['size'] }}</p>
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Sepatu</p>
                                <p class="text-base font-bold text-[#1c1c17]">{{ ($result['shoe']['brand'] ?? '') . ' ' . ($result['shoe']['type'] ?? '-') }}</p>
                                <div class="flex flex-wrap gap-1.5 mt-2">
                                    @if($result['services'] ?? null)
                                        @foreach($result['services'] as $service)
                                            <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase">{{ $service['service_name'] ?? '-' }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dokumentasi --}}
                    @if(($result['visual_photos']['before_photo_url'] ?? null) || ($result['visual_photos']['after_photo_url'] ?? null))
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6 fade-in-up" style="animation-delay:.15s">
                        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Workshop Documentation</h2>
                        <div class="grid grid-cols-2 gap-3">
                            @if($result['visual_photos']['before_photo_url'] ?? null)
                            <div class="relative">
                                <img class="w-full h-40 sm:h-48 object-cover rounded-xl" src="{{ $result['visual_photos']['before_photo_url'] }}" alt="Before" loading="lazy"/>
                                <span class="absolute top-2.5 left-2.5 bg-black/70 text-white px-2 py-0.5 rounded-full text-[9px] font-bold">BEFORE</span>
                            </div>
                            @endif
                            @if($result['visual_photos']['after_photo_url'] ?? null)
                            <div class="relative">
                                <img class="w-full h-40 sm:h-48 object-cover rounded-xl" src="{{ $result['visual_photos']['after_photo_url'] }}" alt="After/Progress" loading="lazy"/>
                                <span class="absolute top-2.5 left-2.5 bg-[#22AF85] text-white px-2 py-0.5 rounded-full text-[9px] font-bold">AFTER / PROGRESS</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Footer Actions --}}
                    <div class="flex flex-col gap-3 fade-in-up" style="animation-delay:.25s">

                        {{-- Tombol CX Report (hanya muncul jika on hold) --}}
                        @if(($result['is_on_hold'] ?? false) && ($result['report_issue_url'] ?? null))
                        <a href="{{ $result['report_issue_url'] }}" target="_blank"
                            class="bg-orange-500 rounded-xl border border-orange-500 shadow-sm p-4 flex items-center gap-3 hover:bg-orange-600 transition-all group">
                            <div class="w-10 h-10 bg-white/20 text-white rounded-lg flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined !text-[20px]">report_problem</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-white leading-snug">Lihat Laporan Kendala</p>
                                <p class="text-[11px] text-white/80 mt-0.5 leading-snug">Cek detail CX Report sepatu Anda</p>
                            </div>
                            <span class="material-symbols-outlined text-white/60 !text-[18px] shrink-0">open_in_new</span>
                        </a>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="{{ route('warranty.index') }}?spk_number={{ $result['spk_number'] ?? '' }}"
                                class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 flex items-center gap-3 hover:border-[#22AF85] hover:shadow-md transition-all group">
                                <div class="w-10 h-10 bg-red-50 text-red-500 rounded-lg flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined !text-[20px]">verified_user</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-[#1c1c17] group-hover:text-[#22AF85] transition-colors leading-snug">Ajukan Klaim Garansi</p>
                                    <p class="text-[11px] text-gray-400 mt-0.5 leading-snug">Garansi 100 hari kerja</p>
                                </div>
                                <span class="material-symbols-outlined text-gray-300 !text-[18px] shrink-0">arrow_forward_ios</span>
                            </a>
                            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank"
                                class="bg-[#22AF85] rounded-xl border border-[#22AF85] shadow-sm p-4 flex items-center gap-3 hover:bg-[#1d9974] transition-all group">
                                <div class="w-10 h-10 bg-white/20 text-white rounded-lg flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined !text-[20px]">support_agent</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-white leading-snug">Chat Konsultan</p>
                                    <p class="text-[11px] text-white/70 mt-0.5 leading-snug">Tanya soal progres sepatu</p>
                                </div>
                                <span class="material-symbols-outlined text-white/50 !text-[18px] shrink-0">arrow_forward_ios</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Timeline --}}
                <div class="lg:col-span-2 order-1 lg:order-2 fade-in-up" style="animation-delay:.2s">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6">
                        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-5">Timeline Pengerjaan</h2>
                        <div class="relative">
                            <div class="absolute top-3 left-[17px] bottom-3 w-[2px] bg-gray-100"></div>
                            <div class="space-y-5">
                                @foreach($timelineArray as $stageKey => $stage)
                                    @php
                                        $isCompleted  = $stage['is_completed'] ?? false;
                                        $isCurrent    = $stage['is_current'] ?? false;
                                        $isCxFollowup = $isCurrent && ($result['is_on_hold'] ?? false);
                                        $timestamp    = $stage['waktu'] ?? null;
                                    @endphp
                                    <div class="flex gap-3 relative z-10 {{ (!$isCompleted && !$isCurrent) ? 'opacity-50' : '' }}">
                                        <div class="w-9 h-9 rounded-full border-2 border-white flex items-center justify-center shrink-0 shadow-sm
                                            {{ $isCxFollowup ? 'bg-orange-500 text-white' : ($isCurrent ? 'bg-[#FFC232] text-white' : ($isCompleted ? 'bg-[#22AF85] text-white' : 'bg-gray-100 text-gray-400')) }}">
                                            @if($isCxFollowup)
                                                <span class="material-symbols-outlined !text-[16px]">report_problem</span>
                                            @elseif($isCurrent)
                                                <span class="material-symbols-outlined !text-[16px]">autorenew</span>
                                            @elseif($isCompleted)
                                                <span class="material-symbols-outlined !text-[16px]">check</span>
                                            @else
                                                <span class="material-symbols-outlined !text-[16px]">schedule</span>
                                            @endif
                                        </div>
                                        <div class="flex-1 pt-1.5">
                                            <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                                                <span class="text-sm font-bold text-[#1c1c17]">{{ $stage['label'] ?? '-' }}</span>
                                                @if($isCxFollowup)
                                                    <span class="bg-orange-100 text-orange-600 text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">CX Follow Up</span>
                                                @elseif($isCurrent)
                                                    <span class="bg-[#FFC232]/20 text-[#b38a00] text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Sedang Berjalan</span>
                                                @elseif($isCompleted)
                                                    <span class="bg-[#22AF85]/10 text-[#22AF85] text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Selesai</span>
                                                @else
                                                    <span class="bg-gray-100 text-gray-400 text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Menunggu</span>
                                                @endif
                                            </div>
                                            @if($timestamp)
                                                <p class="text-[11px] text-gray-400">{{ \Carbon\Carbon::parse($timestamp)->format('d M Y, H:i') }} WIB</p>
                                            @endif
                                            @if($isCxFollowup)
                                                <p class="text-xs text-orange-500 mt-1.5 leading-relaxed">{{ $result['hold_message'] ?? '' }}</p>
                                                @if($result['report_issue_url'] ?? null)
                                                <a href="{{ $result['report_issue_url'] }}" target="_blank" class="inline-flex items-center gap-1 mt-1.5 text-[10px] font-bold text-orange-600 underline underline-offset-2">
                                                    <span class="material-symbols-outlined !text-[12px]">open_in_new</span>
                                                    Lihat Laporan Kendala
                                                </a>
                                                @endif
                                            @elseif($isCurrent && isset($result['current_status']['description']))
                                                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">{{ $result['current_status']['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif(isset($error) && $error)
            {{-- ── ERROR STATE ── --}}
            <div class="max-w-md mx-auto py-16 text-center fade-in-up">
                <div class="w-16 h-16 bg-red-50 text-red-400 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <span class="material-symbols-outlined !text-[32px]">search_off</span>
                </div>
                <h2 class="text-xl font-extrabold text-[#1c1c17] mb-2">Pesanan Tidak Ditemukan</h2>
                <p class="text-sm text-gray-400 mb-8 max-w-xs mx-auto">{{ $error }}</p>
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                    <form method="GET" action="{{ route('tracking.index') }}">
                        <div class="relative">
                            <input class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] outline-none transition-all"
                                   placeholder="Coba nomor SPK lain..."
                                   name="q" value="{{ $query ?? '' }}" type="text" required/>
                            <button type="submit" aria-label="Cari"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-[#22AF85] text-white p-1.5 rounded-lg active:scale-90 transition-transform">
                                <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    @else
        {{-- ── WELCOME / EMPTY STATE ── --}}
        <div class="max-w-md mx-auto py-10 text-center fade-in-up">
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                <form method="GET" action="{{ route('tracking.index') }}">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-300 !text-[20px]">search</span>
                        <input class="w-full bg-gray-50 border border-gray-200 pl-10 pr-12 py-3 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] outline-none transition-all"
                               placeholder="Contoh: S-2603-28-0882-IK"
                               name="q" value="{{ $query ?? '' }}" type="text" required/>
                        <button type="submit" aria-label="Cari"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-[#22AF85] text-white p-1.5 rounded-lg active:scale-90 transition-transform">
                            <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>
            <p class="text-xs text-gray-300 mt-5">Nomor SPK tersedia di resi atau WhatsApp konfirmasi pesanan Anda.</p>
        </div>
    @endif

    </div>
</main>

@include('components.footer', ['settings' => $settings])

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const timelineItems = document.querySelectorAll('.space-y-5 > div');
        timelineItems.forEach((item, i) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(12px)';
            item.style.transition = `all 0.4s ease ${i * 0.08}s`;
            setTimeout(() => {
                item.style.opacity = item.classList.contains('opacity-50') ? '0.5' : '1';
                item.style.transform = 'translateY(0)';
            }, 80);
        });
    });
</script>

@endsection