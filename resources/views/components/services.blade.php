{{-- Services Grid: 4-col cards with icon + title + description --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 relative z-10">
    @foreach($services as $catIndex => $cat)
    @php
        $featuredService = $cat->services->first(fn($s) => $s->is_preview) ?? $cat->services->first();
    @endphp
    <div class="relative bg-white/80 backdrop-blur-sm p-4 sm:p-5 rounded-2xl sm:rounded-[1.25rem] border border-gray-100/80 flex flex-col gap-3 sm:gap-4 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(34,175,133,0.12)] hover:border-[#22AF85]/40 transition-all duration-500 group overflow-hidden break-words">
        {{-- Hover glowing orb effect --}}
        <div class="absolute -top-16 -right-16 w-32 h-32 bg-gradient-to-br from-[#22AF85]/30 to-[#FFC232]/30 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-32 h-32 bg-gradient-to-tr from-[#FFC232]/20 to-[#22AF85]/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none delay-75"></div>
        
        <!-- BA Slider Cover -->
        <div class="w-full aspect-square rounded-xl overflow-hidden shadow-sm relative border border-gray-100/50 group-hover:shadow-md transition-shadow shrink-0">
            @if($featuredService)
                <x-ba-slider :service="$featuredService" :catIndex="$catIndex" class="w-full h-full" />
            @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                    <span class="font-mono text-[10px]">NO IMAGE</span>
                </div>
            @endif
            <!-- Glass Overlay on Cover -->
            <div class="absolute inset-0 z-40 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
        </div>
        
        <div class="flex flex-col gap-1 sm:gap-1.5 relative z-10">
            <h3 class="font-extrabold text-[#1c1c17] text-[13px] sm:text-lg break-words leading-tight group-hover:text-[#22AF85] transition-colors duration-300">{{ $cat->name }}</h3>
            @if($cat->subtitle)
            <p class="text-gray-500 text-[11px] sm:text-[13px] leading-relaxed break-words font-medium">{{ \Illuminate\Support\Str::limit($cat->subtitle, 80) }}</p>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Link --}}
<div class="mt-12 text-center">
    <a href="{{ route('layanan.index') }}"
       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group">
        Lihat semua layanan
        <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
    </a>
</div>