@php $featured = $portfolio->first(); @endphp
<div>
    @if($featured)
    <div class="rounded-2xl overflow-hidden bg-gray-100 relative mb-4" style="aspect-ratio:4/3; max-height:320px">
        {{-- Split before/after --}}
        <div class="absolute inset-0 flex">
            <div class="w-1/2 overflow-hidden relative">
                <img src="{{ $featured->before_image ? asset('storage/'.$featured->before_image) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80' }}"
                     alt="Sebelum" class="absolute inset-0 w-full h-full object-cover" style="width:200%;max-width:none">
                <span class="absolute top-3 left-3 bg-white/80 backdrop-blur-sm text-xs font-bold px-3 py-1 rounded text-gray-700">Sebelum</span>
            </div>
            <div class="w-1/2 overflow-hidden relative">
                <img src="{{ $featured->after_image ? asset('storage/'.$featured->after_image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=600&q=80' }}"
                     alt="Sesudah" class="absolute inset-0 h-full object-cover" style="width:200%;right:0;left:auto">
                <span class="absolute top-3 right-3 bg-white/80 backdrop-blur-sm text-xs font-bold px-3 py-1 rounded text-gray-700">Sesudah</span>
            </div>
        </div>
        {{-- Center divider --}}
        <div class="absolute inset-y-0 left-1/2 -translate-x-1/2 flex flex-col items-center justify-center z-10">
            <div class="w-px h-full bg-white/60"></div>
            <div class="absolute w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/></svg>
            </div>
        </div>
    </div>
    <div class="text-center mb-2">
        <p class="font-bold text-gray-900 text-sm">{{ $featured->title }}</p>
        @if($featured->description)
        <p class="text-xs text-gray-400 mt-0.5">{{ $featured->description }}</p>
        @endif
    </div>
    @endif

    <div class="text-center mt-5">
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
           class="inline-flex items-center gap-2 px-6 py-2.5 border border-gray-300 text-sm font-semibold text-gray-700 rounded-lg hover:border-[#22AF85] hover:text-[#22AF85] transition-all">
            Lihat Portfolio Lainnya
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</div>