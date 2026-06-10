@php $featured = $portfolio->first(); @endphp
@if($featured)
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
    {{-- Left: Before/After Image Showcase --}}
    <div class="rounded-2xl overflow-hidden bg-[#1a1a1a] relative shadow-2xl" style="aspect-ratio:4/3">
        {{-- Split before/after --}}
        <div class="absolute inset-0 flex">
            <div class="w-1/2 overflow-hidden relative">
                <img src="{{ $featured->before_image ? asset('storage/'.$featured->before_image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80' }}"
                     alt="Sebelum" class="absolute inset-0 w-full h-full object-cover" style="width:200%;max-width:none">
                <span class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-white/90 backdrop-blur-sm text-xs font-bold px-3 py-1.5 rounded-lg text-gray-700 shadow-sm">Sebelum</span>
            </div>
            <div class="w-1/2 overflow-hidden relative">
                <img src="{{ $featured->after_image ? asset('storage/'.$featured->after_image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=600&q=80' }}"
                     alt="Sesudah" class="absolute inset-0 h-full object-cover" style="width:200%;right:0;left:auto">
                <span class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-[#22AF85] text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">Sesudah</span>
            </div>
        </div>
        {{-- Center divider --}}
        <div class="absolute inset-y-0 left-1/2 -translate-x-1/2 flex flex-col items-center justify-center z-10">
            <div class="w-px h-full bg-white/40"></div>
            <div class="absolute w-9 h-9 sm:w-10 sm:h-10 bg-white rounded-full shadow-xl flex items-center justify-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/></svg>
            </div>
        </div>
    </div>

    {{-- Right: Details --}}
    <div class="lg:pl-4">
        <p class="text-xs font-bold tracking-[0.2em] text-[#22AF85] uppercase mb-3">{{ $featured->category ?? 'Restorasi' }}</p>
        <h3 class="text-2xl sm:text-3xl font-black text-gray-900 mb-4 leading-tight">{{ $featured->title }}</h3>
        @if($featured->description)
        <p class="text-gray-500 text-sm leading-relaxed mb-6">{{ $featured->description }}</p>
        @else
        <p class="text-gray-500 text-sm leading-relaxed mb-6">Transformasi luar biasa dari sepatu yang sudah rusak menjadi tampak seperti baru. Dikerjakan oleh tenaga ahli dengan material premium.</p>
        @endif
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('portfolio.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1a9970] transition-all duration-300 shadow-lg shadow-[#22AF85]/20 hover:-translate-y-0.5">
                Lihat Portfolio Lainnya
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</div>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada portfolio.</div>
@endif