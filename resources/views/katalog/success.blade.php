@extends('layouts.main')
@section('seo_title', 'Pengajuan Berhasil — Shoe Workshop')
@section('seo_description', 'Pengajuan permohonan barang donasi Anda berhasil dikirim.')

@section('head')
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .fill-1 { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }

    .success-check {
        animation: pop-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }
    @keyframes pop-in {
        0%   { transform: scale(0.4); opacity: 0; }
        100% { transform: scale(1);   opacity: 1; }
    }

    .success-ring {
        animation: pulse-ring 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse-ring {
        0%   { transform: scale(1);    opacity: 0.4; }
        50%  { transform: scale(1.12); opacity: 0.2; }
        100% { transform: scale(1);    opacity: 0.4; }
    }

    .fade-up {
        animation: fade-up 0.6s ease both;
    }
    @keyframes fade-up {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
</style>
@endsection

@section('content')
{{-- Atmospheric background --}}
<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_50%_-20%,rgba(34,175,133,0.12),transparent_55%)]"></div>
    <div class="absolute bottom-0 right-0 w-full h-full bg-[radial-gradient(circle_at_80%_110%,rgba(255,194,50,0.08),transparent_45%)]"></div>
</div>

<div class="min-h-screen flex flex-col bg-[#f8f9fa] text-[#1c1c17]">

    {{-- Minimal top bar --}}
    <header class="w-full border-b border-gray-200 bg-white/95 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="flex flex-col leading-tight">
                    <span class="text-base font-extrabold text-[#1c1c17]">Shoe Workshop</span>
                    <div class="flex h-0.5 w-full">
                        <div class="w-1/2 bg-[#22AF85]"></div>
                        <div class="w-1/2 bg-[#FFC232]"></div>
                    </div>
                </div>
            </a>
            <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined !text-[18px]">arrow_back</span>
                Kembali ke Katalog
            </a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-8 sm:py-12 px-4">
        <div class="w-full max-w-lg">

            {{-- Main Success Card --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8 text-center relative overflow-hidden">

                {{-- Abstract decorative blob --}}
                <div class="absolute -top-16 -right-16 w-48 h-48 bg-[#22AF85]/8 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#FFC232]/10 rounded-full blur-2xl pointer-events-none"></div>

                {{-- Success Icon --}}
                <div class="relative mb-5 sm:mb-6 flex justify-center fade-up">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 bg-[#22AF85]/15 rounded-full success-ring"></div>
                    </div>
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#22AF85] rounded-full flex items-center justify-center text-white relative z-10 shadow-lg shadow-[#22AF85]/30 success-check">
                        <span class="material-symbols-outlined !text-[38px] sm:!text-[48px] fill-1" style="font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 48;">check_circle</span>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-700 mb-4 fade-up delay-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse"></span>
                    <span class="text-[11px] font-bold uppercase tracking-wider">Pending</span>
                </div>

                {{-- Headline --}}
                <h1 class="text-xl sm:text-2xl font-extrabold text-[#22AF85] mb-3 fade-up delay-100">
                    Pengajuan Berhasil Terkirim!
                </h1>

                {{-- Description --}}
                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed mb-5 sm:mb-7 px-0 sm:px-2 fade-up delay-200">
                    Data permohonan Anda untuk <strong class="text-[#1c1c17]">{{ $itemNama }}</strong> telah tersimpan dengan aman di sistem kami.
                    Untuk melanjutkan proses verifikasi, silakan hubungi WhatsApp Admin Shoe Workshop.
                </p>

                {{-- WhatsApp Message Preview --}}
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-7 text-left relative fade-up delay-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-[#25D366]"></span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Preview Pesan WhatsApp</span>
                        </div>
                        <button onclick="copyMessage()" class="flex items-center gap-1 text-[10px] font-bold text-[#22AF85] hover:opacity-75 transition-opacity" id="copyBtn">
                            <span class="material-symbols-outlined !text-[14px]">content_copy</span>
                            Salin
                        </button>
                    </div>
                    <div class="bg-white border border-dashed border-gray-200 rounded-lg p-3 space-y-2.5">
                        {{-- Header line --}}
                        <p class="text-xs text-gray-600 italic leading-relaxed">
                            "Halo Admin Shoe Workshop, saya ingin mengonfirmasi pengajuan donasi saya dengan ID
                            <span class="font-bold not-italic text-[#22AF85]">{{ $reqCode }}</span>."
                        </p>
                        <div class="border-t border-gray-100 pt-2.5 space-y-1.5">
                            {{-- Detail Barang --}}
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">📦 Detail Barang</p>
                            <div class="space-y-1 pl-1">
                                <div class="flex gap-2 text-xs">
                                    <span class="text-gray-400 font-semibold w-16 shrink-0">Nama</span>
                                    <span class="text-gray-700 font-semibold">{{ $itemNama }}</span>
                                </div>
                                <div class="flex gap-2 text-xs">
                                    <span class="text-gray-400 font-semibold w-16 shrink-0">Kategori</span>
                                    <span class="text-gray-700 font-semibold">{{ ucfirst($item->kategori) }}</span>
                                </div>
                                <div class="flex gap-2 text-xs items-start">
                                    <span class="text-gray-400 font-semibold w-16 shrink-0">Link</span>
                                    <a href="{{ $itemUrl }}" target="_blank"
                                       class="text-[#22AF85] font-semibold hover:underline break-all leading-snug">
                                        {{ $itemUrl }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 italic pt-1 border-t border-gray-100">
                            "Saya telah melengkapi data di platform. Mohon panduan untuk tahap selanjutnya. Terima kasih! 🙏"
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col gap-2.5 sm:gap-3 fade-up delay-300">
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer"
                       class="group flex items-center justify-center gap-2 bg-[#25D366] hover:brightness-105 active:scale-[0.98] text-white font-bold text-sm py-3.5 sm:py-4 rounded-xl shadow-md shadow-[#25D366]/20 transition-all duration-200">
                        <span class="material-symbols-outlined !text-[20px]">chat</span>
                        Buka WhatsApp Admin
                        <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('katalog.index') }}"
                       class="flex items-center justify-center gap-1.5 py-2.5 sm:py-3 text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">
                        <span class="material-symbols-outlined !text-[18px]">grid_view</span>
                        Kembali ke Katalog
                    </a>
                </div>
            </div>

            {{-- Trust Strip --}}
            <div class="mt-8 sm:mt-10 flex flex-row flex-wrap items-center justify-center gap-4 sm:gap-8 opacity-50 fade-up delay-400">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[20px] text-gray-600">verified_user</span>
                    </div>
                    <div class="text-left">
                        <p class="text-[11px] font-bold leading-none mb-0.5">Terverifikasi</p>
                        <p class="text-[8px] sm:text-[9px] uppercase font-bold tracking-widest text-gray-400">Secure System</p>
                    </div>
                </div>
                <div class="hidden md:block w-px h-8 bg-gray-200"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[20px] text-gray-600">eco</span>
                    </div>
                    <div class="text-left">
                        <p class="text-[11px] font-bold leading-none mb-0.5">Eco-Impact</p>
                        <p class="text-[8px] sm:text-[9px] uppercase font-bold tracking-widest text-gray-400">Recycling First</p>
                    </div>
                </div>
                <div class="hidden md:block w-px h-8 bg-gray-200"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-100 flex items-center justify-center">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[20px] text-gray-600">local_shipping</span>
                    </div>
                    <div class="text-left">
                        <p class="text-[11px] font-bold leading-none mb-0.5">Gratis Kirim</p>
                        <p class="text-[8px] sm:text-[9px] uppercase font-bold tracking-widest text-gray-400">Free Delivery</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
function copyMessage() {
    const text = `Halo Admin Shoe Workshop, saya ingin mengonfirmasi pengajuan donasi saya dengan ID {{ $reqCode }}.

📦 Detail Barang:
- Nama      : {{ $itemNama }}
- Kategori  : {{ ucfirst($item->kategori) }}
- Link Katalog : {{ $itemUrl }}

Saya telah melengkapi data di platform. Mohon panduan untuk tahap selanjutnya. Terima kasih! 🙏`;
    const btn = document.getElementById('copyBtn');

    const fallback = () => {
        const el = document.createElement('textarea');
        el.value = text;
        el.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).catch(fallback);
    } else {
        fallback();
    }

    btn.innerHTML = '<span class="material-symbols-outlined !text-[14px]">check</span> Tersalin!';
    setTimeout(() => {
        btn.innerHTML = '<span class="material-symbols-outlined !text-[14px]">content_copy</span> Salin';
    }, 2500);
}
</script>
@endsection
