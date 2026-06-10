@php $featured = $portfolio->first(); @endphp
@if($featured)
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    {{-- Left: Before/After Image --}}
    <div class="relative rounded-2xl shadow-2xl border-4 border-white overflow-hidden group">
        <div class="flex">
            <div class="relative w-1/2">
                <img src="{{ $featured->before_image_url }}"
                     alt="Sebelum" class="h-[280px] sm:h-[400px] object-cover w-full grayscale brightness-75">
                <div class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-[#1c1c17] text-white text-[10px] px-2 py-1 rounded font-bold uppercase">Sebelum</div>
            </div>
            <div class="relative w-1/2">
                <img src="{{ $featured->after_image_url }}"
                     alt="Sesudah" class="h-[280px] sm:h-[400px] object-cover w-full">
                <div class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-[#22AF85] text-white text-[10px] px-2 py-1 rounded font-bold uppercase">Sesudah</div>
            </div>
        </div>
        {{-- Center divider --}}
        <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
            <div class="w-[2px] h-full bg-white relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg border border-gray-200">
                    <span class="material-symbols-outlined text-[#22AF85]">unfold_more</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Details --}}
    <div class="space-y-5 sm:space-y-6">
        <div class="inline-block px-3 py-1 bg-[#22AF85]/10 text-[#22AF85] rounded-full text-xs font-semibold uppercase tracking-wider">Service: {{ $featured->category ?? ($featured->service->name ?? 'Restorasi') }}</div>
        <h3 class="text-2xl sm:text-[32px] font-extrabold text-[#1c1c17] leading-tight">{{ $featured->title }}</h3>
        @if($featured->description)
        <p class="text-gray-500 text-base leading-relaxed">{{ $featured->description }}</p>
        @else
        <p class="text-gray-500 text-base leading-relaxed">Transformasi luar biasa dari sepatu yang sudah rusak menjadi tampak seperti baru. Dengan proses deep cleaning organik dan repaint premium, kami mengembalikan kejayaan klasiknya.</p>
        @endif
        <a href="{{ route('portfolio.index') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-[#22AF85] hover:gap-4 transition-all duration-300">
            Lihat Portfolio Lainnya
            <span class="material-symbols-outlined">arrow_forward</span>
        </a>
    </div>
</div>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada portfolio.</div>
@endif