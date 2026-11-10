@extends('layouts.main')
@section('seo_title', 'Tracking Pesanan | Shoe Workshop')
@section('seo_description', 'Lacak status pesanan reparasi sepatu kamu di Shoe Workshop secara real-time.')

@section('head')
<style>
    @verbatim
    @keyframes bounce-x {
        0%, 100% { transform: translateX(0); }
        50%       { transform: translateX(4px); }
    }
    .animate-bounce-x { display:inline-block; animation: bounce-x 1.2s ease-in-out infinite; }

    @keyframes fade-up {
        from { opacity:0; transform:translateY(14px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .fade-up { animation: fade-up 0.45s ease both; }

    @keyframes spin-slow { to { transform: rotate(360deg); } }
    .spin-slow { animation: spin-slow 2s linear infinite; }

    @keyframes pulse-ring {
        0%   { box-shadow: 0 0 0 0 rgba(34,175,133,.35); }
        70%  { box-shadow: 0 0 0 10px rgba(34,175,133,0); }
        100% { box-shadow: 0 0 0 0 rgba(34,175,133,0); }
    }
    .pulse-ring { animation: pulse-ring 2s ease-in-out infinite; }
    @endverbatim
</style>
@endsection

@section('content')
@include('layouts.navigation-public')

<main class="pt-20 pb-20 min-h-screen bg-gray-50">

    {{-- ───── PAGE HEADER ───── --}}
    <div class="bg-gradient-to-br from-[#22AF85]/8 to-white py-14 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block text-xs font-black tracking-[0.25em] text-[#22AF85] uppercase mb-3">Tracking Pesanan</span>
            <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-3">Lacak Pesanan Anda</h1>
            <p class="text-gray-500 max-w-lg mx-auto text-sm sm:text-base">
                Masukkan nomor SPK untuk melihat progres pengerjaan sepatu secara real-time.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

    @if(isset($query) && $query)
        @if(isset($result) && $result)
        @php
            /* ── Shorthand variables ── */
            $spk        = $result['spk_number'] ?? '-';
            $priority   = $result['priority']   ?? null;
            $status     = $result['current_status'] ?? [];
            $statusCode = $status['code']  ?? '';
            $statusLbl  = $status['label'] ?? '-';
            $statusDesc = $status['description'] ?? '';

            /* ── Special-state flags ── */
            $isOnHold    = $result['is_on_hold']    ?? false;
            $isOto       = $result['is_oto']        ?? false;
            $hasOtoOffer = $result['has_oto_offer'] ?? false;
            $isWarranty  = $result['is_warranty']   ?? false;
            $isRevising  = $result['is_revising']   ?? false;

            /* ── Timeline ── */
            $timelineArray = (array)($result['timeline'] ?? []);

            // For CX_FOLLOWUP hold: re-derive current step from last timestamp
            if ($isOnHold) {
                $keys = array_keys($timelineArray);
                $lastWithTime = -1;
                foreach ($keys as $pos => $k) {
                    if (!empty($timelineArray[$k]['waktu'])) $lastWithTime = $pos;
                }
                foreach ($keys as $pos => $k) {
                    if ($lastWithTime >= 0 && $pos < $lastWithTime) {
                        $timelineArray[$k]['is_completed'] = true;
                        $timelineArray[$k]['is_current']   = false;
                    } elseif ($pos === $lastWithTime) {
                        $timelineArray[$k]['is_completed'] = false;
                        $timelineArray[$k]['is_current']   = true;
                    } else {
                        $timelineArray[$k]['is_completed'] = false;
                        $timelineArray[$k]['is_current']   = false;
                    }
                }
            }

            $totalStages = count($timelineArray);
            $completedCount = 0;
            foreach ($timelineArray as $s) { if ($s['is_completed'] ?? false) $completedCount++; }
            $percent = $totalStages > 1 ? min(100, ($completedCount / ($totalStages - 1)) * 100) : 0;

            /* ── Active banner (priority order from API doc) ── */
            $banner = null;
            if ($isOnHold) {
                $banner = [
                    'type'      => 'HOLD_CX',
                    'theme'     => 'rose',
                    'icon'      => 'report_problem',
                    'title'     => $result['hold_title']   ?? 'Konfirmasi Kendala Diperlukan',
                    'message'   => $result['hold_message'] ?? '',
                    'actionUrl' => $result['report_issue_url'] ?? null,
                    'actionLbl' => 'Lihat Laporan Kendala (CX Report)',
                ];
            } elseif ($isWarranty) {
                $banner = [
                    'type'    => 'WARRANTY',
                    'theme'   => 'indigo',
                    'icon'    => 'shield_with_heart',
                    'badge'   => $result['warranty_spk_number'] ?? null,
                    'title'   => $result['warranty_title']   ?? 'Pengerjaan Klaim Garansi',
                    'message' => $result['warranty_message'] ?? '',
                ];
            } elseif ($isOto) {
                $banner = [
                    'type'    => 'OTO_ACTIVE',
                    'theme'   => 'orange',
                    'icon'    => 'bolt',
                    'badge'   => 'Fast Track OTO',
                    'title'   => $result['oto_title']   ?? 'Pengerjaan Layanan Tambahan (OTO)',
                    'message' => $result['oto_message'] ?? '',
                ];
            } elseif ($isRevising) {
                $banner = [
                    'type'    => 'REVISION',
                    'theme'   => 'amber',
                    'icon'    => 'construction',
                    'title'   => $result['revision_title']   ?? 'Pengerjaan Ulang & Penyesuaian Kualitas',
                    'message' => $result['revision_message'] ?? '',
                ];
            } elseif ($hasOtoOffer) {
                $banner = [
                    'type'    => 'OTO_OFFER',
                    'theme'   => 'teal',
                    'icon'    => 'star',
                    'title'   => 'Penawaran Layanan Tambahan (One Time Offer) Tersedia',
                    'message' => $result['oto_offer_message'] ?? '',
                ];
            }

            /* ── Banner theme map ── */
            $themeMap = [
                'rose'   => ['bg'=>'bg-rose-50',   'border'=>'border-rose-200',   'icon_bg'=>'bg-rose-100',   'icon_text'=>'text-rose-500',   'title'=>'text-rose-700',   'msg'=>'text-rose-600',   'btn_bg'=>'bg-rose-100',   'btn_text'=>'text-rose-700',   'btn_hover'=>'hover:bg-rose-200'],
                'indigo' => ['bg'=>'bg-indigo-50',  'border'=>'border-indigo-200', 'icon_bg'=>'bg-indigo-100', 'icon_text'=>'text-indigo-500', 'title'=>'text-indigo-700', 'msg'=>'text-indigo-600', 'btn_bg'=>'bg-indigo-100', 'btn_text'=>'text-indigo-700', 'btn_hover'=>'hover:bg-indigo-200'],
                'orange' => ['bg'=>'bg-orange-50',  'border'=>'border-orange-200', 'icon_bg'=>'bg-orange-100', 'icon_text'=>'text-orange-500', 'title'=>'text-orange-700', 'msg'=>'text-orange-600', 'btn_bg'=>'bg-orange-100', 'btn_text'=>'text-orange-700', 'btn_hover'=>'hover:bg-orange-200'],
                'amber'  => ['bg'=>'bg-amber-50',   'border'=>'border-amber-200',  'icon_bg'=>'bg-amber-100',  'icon_text'=>'text-amber-500',  'title'=>'text-amber-700',  'msg'=>'text-amber-600',  'btn_bg'=>'bg-amber-100',  'btn_text'=>'text-amber-700',  'btn_hover'=>'hover:bg-amber-200'],
                'teal'   => ['bg'=>'bg-teal-50',    'border'=>'border-teal-200',   'icon_bg'=>'bg-teal-100',   'icon_text'=>'text-teal-600',   'title'=>'text-teal-700',   'msg'=>'text-teal-600',   'btn_bg'=>'bg-teal-100',   'btn_text'=>'text-teal-700',   'btn_hover'=>'hover:bg-teal-200'],
            ];
        @endphp

        {{-- ── TOP SEARCH BAR ── --}}
        <div class="mb-8 fade-up">
            <form method="GET" action="{{ route('tracking.index') }}">
                <div class="relative max-w-sm">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400 !text-[20px]">search</span>
                    <input class="w-full bg-white border border-gray-200 pl-10 pr-12 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] outline-none transition-all shadow-sm"
                           placeholder="Cari nomor SPK lain..." name="q" value="{{ $query }}" type="text" required/>
                    <button type="submit" aria-label="Cari"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-[#22AF85] text-white p-1.5 rounded-lg active:scale-90 transition-transform">
                        <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- ── SPK HEADER ── --}}
        <div class="mb-5 fade-up" style="animation-delay:.03s">
            <p class="text-xs font-bold text-[#22AF85] tracking-widest uppercase mb-1">Tracking Order</p>
            <div class="flex flex-wrap items-center gap-2.5">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1c1c17] tracking-tight font-mono">{{ $spk }}</h1>

                {{-- Status badge ──  colour by code --}}
                @php
                    $badgeCls = match(true) {
                        $isOnHold    => 'bg-rose-100 text-rose-700',
                        $isWarranty  => 'bg-indigo-100 text-indigo-700',
                        $isOto       => 'bg-orange-100 text-orange-700',
                        $isRevising  => 'bg-amber-100 text-amber-700',
                        $hasOtoOffer => 'bg-teal-100 text-teal-700',
                        $statusCode === 'SELESAI' => 'bg-[#22AF85] text-white',
                        default      => 'bg-gray-100 text-gray-600',
                    };
                @endphp
                <span class="text-[11px] font-black px-3 py-1 rounded-full {{ $badgeCls }}">
                    {{ strtoupper($statusLbl) }}
                </span>

                @if($priority)
                    @php
                        $pCls = match($priority) {
                            'Prioritas' => 'bg-orange-50 text-orange-600 border border-orange-200',
                            'Urgent'    => 'bg-red-50 text-red-600 border border-red-200',
                            'Express'   => 'bg-purple-50 text-purple-600 border border-purple-200',
                            default     => 'bg-gray-50 text-gray-500 border border-gray-200',
                        };
                    @endphp
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full {{ $pCls }}">{{ $priority }}</span>
                @endif

                @if($result['warranty_spk_number'] ?? null)
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-600 border border-indigo-200 font-mono">
                        {{ $result['warranty_spk_number'] }}
                    </span>
                @endif
            </div>
        </div>

        {{-- ── HORIZONTAL PROGRESS STEPPER ── --}}
        <div class="mb-5 bg-white rounded-2xl border border-gray-200 shadow-sm p-4 sm:p-6 fade-up" style="animation-delay:.05s">
            <div class="flex items-center justify-between mb-3 md:hidden">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Progres</span>
                <span class="flex items-center gap-1 text-xs text-[#22AF85] font-bold">
                    <span>Geser</span>
                    <span class="material-symbols-outlined !text-[14px] animate-bounce-x">arrow_forward</span>
                </span>
            </div>
            <div class="overflow-x-auto scrollbar-none">
                <div class="min-w-[560px] md:min-w-0 flex justify-between items-start relative pt-1 pb-3">
                    {{-- Rail --}}
                    <div class="absolute top-[18px] left-0 w-full h-[2px] bg-gray-100"></div>
                    <div class="absolute top-[18px] left-0 h-[2px] bg-[#22AF85] transition-all duration-1000" style="width:{{ $percent }}%"></div>

                    @foreach($timelineArray as $stageKey => $stage)
                        @php
                            $done    = $stage['is_completed'] ?? false;
                            $curr    = $stage['is_current']   ?? false;
                            $isCxHld = $curr && $isOnHold;

                            $dotCls  = $isCxHld ? 'bg-rose-500 text-white'
                                     : ($isWarranty && $curr  ? 'bg-indigo-500 text-white'
                                     : ($isOto      && $curr  ? 'bg-orange-500 text-white'
                                     : ($isRevising && $curr  ? 'bg-amber-400 text-white'
                                     : ($done || $curr        ? 'bg-[#22AF85] text-white' : 'bg-gray-200 text-gray-400'))));

                            $lblCls  = $isCxHld ? 'text-rose-500'
                                     : ($done || $curr ? 'text-[#22AF85]' : 'text-gray-400');

                            $lbl = strtolower($stage['label'] ?? '');
                            $ico = str_contains($lbl,'terima')   ? 'check_circle'
                                 : (str_contains($lbl,'cuci')    ? 'cleaning_services'
                                 : (str_contains($lbl,'service') ? 'construction'
                                 : (str_contains($lbl,'selesai') ? 'verified'
                                 : (str_contains($lbl,'qc')      ? 'fact_check' : 'circle'))));
                            if ($isCxHld) $ico = 'report_problem';
                        @endphp
                        <div class="flex flex-col items-center gap-2 relative z-10 min-w-[72px]">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center border-2 border-white shadow-sm transition-all {{ $dotCls }} {{ $curr && !$isCxHld && !$isOnHold ? 'pulse-ring' : '' }}">
                                <span class="material-symbols-outlined !text-[16px]"
                                      @if($done || $curr) style="font-variation-settings:'FILL' 1" @endif>{{ $ico }}</span>
                            </div>
                            <span class="text-[9px] font-bold text-center uppercase leading-tight {{ $lblCls }}">{{ $stage['label'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── SPECIAL-STATE BANNER ── --}}
        @if($banner)
        @php $t = $themeMap[$banner['theme']]; @endphp
        <div class="mb-5 fade-up {{ $t['bg'] }} border {{ $t['border'] }} rounded-2xl p-5 flex flex-col sm:flex-row gap-4 items-start" style="animation-delay:.07s">
            <div class="w-11 h-11 {{ $t['icon_bg'] }} {{ $t['icon_text'] }} rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined !text-[22px]">{{ $banner['icon'] }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    @if($banner['badge'] ?? null)
                        <span class="text-[9px] font-black px-2 py-0.5 rounded-full {{ $t['btn_bg'] }} {{ $t['btn_text'] }} uppercase tracking-widest">{{ $banner['badge'] }}</span>
                    @endif
                    <p class="text-sm font-extrabold {{ $t['title'] }}">{{ $banner['title'] }}</p>
                </div>
                <p class="text-xs {{ $t['msg'] }} leading-relaxed">{{ $banner['message'] }}</p>
                @if($banner['actionUrl'] ?? null)
                <a href="{{ $banner['actionUrl'] }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1.5 mt-3 text-xs font-bold {{ $t['btn_text'] }} {{ $t['btn_bg'] }} {{ $t['btn_hover'] }} px-3 py-1.5 rounded-lg transition-colors">
                    <span class="material-symbols-outlined !text-[14px]">open_in_new</span>
                    {{ $banner['actionLbl'] }}
                </a>
                @endif
            </div>
        </div>
        @endif

        {{-- ── MAIN GRID ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 sm:gap-6 items-start">

            {{-- LEFT: detail + foto + actions --}}
            <div class="{{ $isOnHold ? 'lg:col-span-5 max-w-3xl mx-auto w-full' : 'lg:col-span-3' }} flex flex-col gap-4 order-2 lg:order-1">

                {{-- Detail pesanan --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6 fade-up" style="animation-delay:.10s">
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Detail Pesanan</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Pelanggan</p>
                            <p class="text-base font-bold text-[#1c1c17]">{{ $result['customer_name'] ?? '-' }}</p>
                            @if($result['shoe']['size'] ?? null)
                                <p class="text-xs text-gray-400 mt-0.5">Ukuran: {{ $result['shoe']['size'] }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Sepatu</p>
                            <p class="text-base font-bold text-[#1c1c17]">{{ ($result['shoe']['brand'] ?? '') . ' ' . ($result['shoe']['type'] ?? '-') }}</p>
                            @if($result['shoe']['color'] ?? null)
                                <p class="text-xs text-gray-400 mt-0.5">{{ $result['shoe']['color'] }}</p>
                            @endif
                        </div>
                    </div>
                    @if($result['services'] ?? null)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Layanan</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($result['services'] as $svc)
                                <span class="bg-[#22AF85]/10 text-[#22AF85] text-[10px] font-bold px-2.5 py-0.5 rounded-full">{{ $svc['service_name'] ?? '-' }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Status description --}}
                    @if($statusDesc)
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-start gap-2">
                        <span class="material-symbols-outlined text-[#22AF85] !text-[18px] mt-0.5 shrink-0">info</span>
                        <p class="text-xs text-gray-500 leading-relaxed">{{ $statusDesc }}</p>
                    </div>
                    @endif
                </div>

                {{-- Before / After photos --}}
                @if(($result['visual_photos']['before_photo_url'] ?? null) || ($result['visual_photos']['after_photo_url'] ?? null))
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6 fade-up" style="animation-delay:.13s">
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Dokumentasi Workshop</h2>
                    <div class="grid grid-cols-2 gap-3">
                        @if($result['visual_photos']['before_photo_url'] ?? null)
                        <div class="relative group overflow-hidden rounded-xl">
                            <img class="w-full h-40 sm:h-48 object-cover" src="{{ $result['visual_photos']['before_photo_url'] }}" alt="Before" loading="lazy"/>
                            <span class="absolute top-2.5 left-2.5 bg-black/70 text-white px-2 py-0.5 rounded-full text-[9px] font-bold">BEFORE</span>
                        </div>
                        @endif
                        @if($result['visual_photos']['after_photo_url'] ?? null)
                        <div class="relative group overflow-hidden rounded-xl">
                            <img class="w-full h-40 sm:h-48 object-cover" src="{{ $result['visual_photos']['after_photo_url'] }}" alt="After/Progress" loading="lazy"/>
                            <span class="absolute top-2.5 left-2.5 bg-[#22AF85] text-white px-2 py-0.5 rounded-full text-[9px] font-bold">
                                {{ $statusCode === 'SELESAI' ? 'AFTER' : 'PROGRESS' }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Action buttons --}}
                <div class="flex flex-col gap-3 fade-up" style="animation-delay:.18s">
                    @if($isOnHold && ($result['report_issue_url'] ?? null))
                    <a href="{{ $result['report_issue_url'] }}" target="_blank"
                        class="bg-rose-500 rounded-xl p-4 flex items-center gap-3 hover:bg-rose-600 transition-all group">
                        <div class="w-10 h-10 bg-white/20 text-white rounded-lg flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined !text-[20px]">report_problem</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white leading-snug">Lihat Laporan Kendala</p>
                            <p class="text-[11px] text-white/80 mt-0.5">Cek detail CX Report sepatu Anda</p>
                        </div>
                        <span class="material-symbols-outlined text-white/60 !text-[18px] shrink-0">open_in_new</span>
                    </a>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('warranty.index') }}?spk_number={{ $spk }}"
                            class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 flex items-center gap-3 hover:border-[#22AF85] hover:shadow-md transition-all group">
                            <div class="w-10 h-10 bg-red-50 text-red-500 rounded-lg flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined !text-[20px]">verified_user</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-[#1c1c17] group-hover:text-[#22AF85] transition-colors leading-snug">Ajukan Klaim Garansi</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">Garansi 100 hari sejak selesai</p>
                            </div>
                            <span class="material-symbols-outlined text-gray-300 !text-[18px] shrink-0">arrow_forward_ios</span>
                        </a>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" target="_blank"
                            class="bg-[#22AF85] rounded-xl p-4 flex items-center gap-3 hover:bg-[#1d9974] transition-all group">
                            <div class="w-10 h-10 bg-white/20 text-white rounded-lg flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined !text-[20px]">support_agent</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-white leading-snug">Chat Customer Care</p>
                                <p class="text-[11px] text-white/70 mt-0.5">Tanya soal progres sepatu</p>
                            </div>
                            <span class="material-symbols-outlined text-white/50 !text-[18px] shrink-0">arrow_forward_ios</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT: vertical timeline (hidden when on hold) --}}
            @if(!$isOnHold)
            <div class="lg:col-span-2 order-1 lg:order-2 fade-up" style="animation-delay:.15s">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-6">
                    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-5">Timeline Pengerjaan</h2>
                    <div class="relative">
                        <div class="absolute top-3 left-[17px] bottom-3 w-[2px] bg-gray-100"></div>
                        <div class="space-y-5">
                            @foreach($timelineArray as $stageKey => $stage)
                                @php
                                    $isCompleted  = $stage['is_completed'] ?? false;
                                    $isCurrent    = $stage['is_current']   ?? false;
                                    $isCxFollowup = $isCurrent && $isOnHold;
                                    $timestamp    = $stage['waktu'] ?? null;

                                    $dotCls = $isCxFollowup ? 'bg-rose-500 text-white'
                                            : ($isWarranty && $isCurrent  ? 'bg-indigo-500 text-white'
                                            : ($isOto     && $isCurrent   ? 'bg-orange-500 text-white'
                                            : ($isRevising && $isCurrent  ? 'bg-amber-400 text-white'
                                            : ($isCurrent                 ? 'bg-[#FFC232] text-white'
                                            : ($isCompleted               ? 'bg-[#22AF85] text-white' : 'bg-gray-100 text-gray-400')))));

                                    $dotIco = $isCxFollowup ? 'report_problem'
                                            : ($isCurrent   ? 'autorenew'
                                            : ($isCompleted ? 'check' : 'schedule'));
                                @endphp
                                <div class="flex gap-3 relative z-10 {{ (!$isCompleted && !$isCurrent) ? 'opacity-40' : '' }}">
                                    <div class="w-9 h-9 rounded-full border-2 border-white flex items-center justify-center shrink-0 shadow-sm {{ $dotCls }} {{ $isCurrent && !$isCxFollowup ? 'pulse-ring' : '' }}">
                                        <span class="material-symbols-outlined !text-[16px]">{{ $dotIco }}</span>
                                    </div>
                                    <div class="flex-1 pt-1.5">
                                        <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                                            <span class="text-sm font-bold text-[#1c1c17]">{{ $stage['label'] ?? '-' }}</span>
                                            @if($isCxFollowup)
                                                <span class="bg-rose-100 text-rose-600 text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">CX Follow Up</span>
                                            @elseif($isWarranty && $isCurrent)
                                                <span class="bg-indigo-100 text-indigo-600 text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Garansi</span>
                                            @elseif($isOto && $isCurrent)
                                                <span class="bg-orange-100 text-orange-600 text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">OTO</span>
                                            @elseif($isRevising && $isCurrent)
                                                <span class="bg-amber-100 text-amber-700 text-[9px] font-black px-1.5 py-0.5 rounded-full uppercase">Revisi</span>
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
                                        {{-- Context note per special state at current step --}}
                                        @if($isCurrent && $statusDesc && !$isCxFollowup)
                                            <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">{{ $statusDesc }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>{{-- /grid --}}

        @elseif(isset($error) && $error)
        {{-- ── ERROR STATE ── --}}
        <div class="max-w-md mx-auto py-16 text-center fade-up">
            <div class="w-16 h-16 bg-red-50 text-red-400 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined !text-[32px]">search_off</span>
            </div>
            <h2 class="text-xl font-extrabold text-[#1c1c17] mb-2">Pesanan Tidak Ditemukan</h2>
            <p class="text-sm text-gray-400 mb-8 max-w-xs mx-auto">{{ $error }}</p>
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                <form method="GET" action="{{ route('tracking.index') }}">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-300 !text-[20px]">search</span>
                        <input class="w-full bg-gray-50 border border-gray-200 pl-10 pr-12 py-3 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] outline-none transition-all"
                               placeholder="Coba nomor SPK lain..." name="q" value="{{ $query ?? '' }}" type="text" required/>
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-[#22AF85] text-white p-1.5 rounded-lg active:scale-90 transition-transform">
                            <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    @else
        {{-- ── WELCOME / EMPTY STATE ── --}}
        <div class="max-w-md mx-auto py-10 text-center fade-up">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <div class="w-14 h-14 bg-[#22AF85]/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-[#22AF85] !text-[28px]">location_searching</span>
                </div>
                <p class="text-sm font-bold text-[#1c1c17] mb-4">Masukkan Nomor SPK</p>
                <form method="GET" action="{{ route('tracking.index') }}">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-300 !text-[20px]">search</span>
                        <input class="w-full bg-gray-50 border border-gray-200 pl-10 pr-12 py-3 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] outline-none transition-all"
                               placeholder="Contoh: S-2603-28-0882-IK"
                               name="q" value="{{ $query ?? '' }}" type="text" required/>
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 bg-[#22AF85] text-white p-1.5 rounded-lg active:scale-90 transition-transform">
                            <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </form>
                <p class="text-xs text-gray-300 mt-4 leading-relaxed">
                    Nomor SPK tersedia di resi atau WhatsApp konfirmasi pesanan Anda.<br>
                    Juga bisa menggunakan <span class="font-mono">-GR</span> untuk SPK Garansi.
                </p>
            </div>
        </div>
    @endif

    </div>
</main>

@include('components.footer', ['settings' => $settings])

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Stagger timeline rows
        document.querySelectorAll('.space-y-5 > div').forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(10px)';
            el.style.transition = `all 0.4s ease ${i * 0.07}s`;
            requestAnimationFrame(() => setTimeout(() => {
                el.style.opacity = el.classList.contains('opacity-40') ? '0.4' : '1';
                el.style.transform = 'translateY(0)';
            }, 60));
        });
    });
</script>
@endsection
