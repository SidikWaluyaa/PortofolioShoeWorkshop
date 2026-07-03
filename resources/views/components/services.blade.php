{{-- Services Grid: 4-col cards with icon + title + description --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 relative z-10">
    @foreach($services as $service)
    <div class="relative bg-white/80 backdrop-blur-sm p-4 sm:p-8 rounded-2xl sm:rounded-[1.25rem] border border-gray-100/80 flex flex-col gap-3 sm:gap-5 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(34,175,133,0.12)] hover:border-[#22AF85]/40 transition-all duration-500 group overflow-hidden break-words">
        {{-- Hover glowing orb effect --}}
        <div class="absolute -top-16 -right-16 w-32 h-32 bg-gradient-to-br from-[#22AF85]/30 to-[#FFC232]/30 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-32 h-32 bg-gradient-to-tr from-[#FFC232]/20 to-[#22AF85]/20 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none delay-75"></div>
        
        <div class="relative flex items-center justify-center w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-[14px] bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 text-xl sm:text-3xl shrink-0 group-hover:scale-110 group-hover:bg-[#22AF85]/10 group-hover:border-[#22AF85]/30 group-hover:shadow-[0_0_20px_rgba(34,175,133,0.2)] transition-all duration-500 text-gray-700">
            {!! $service->icon !!}
        </div>
        <div class="flex flex-col gap-1.5 sm:gap-2 relative z-10">
            <h3 class="font-extrabold text-[#1c1c17] text-[13px] sm:text-lg break-words leading-tight group-hover:text-[#22AF85] transition-colors duration-300">{{ $service->name }}</h3>
            @if($service->description)
            <p class="text-gray-500 text-[11px] sm:text-sm leading-relaxed break-words font-medium">{{ $service->description }}</p>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Link --}}
<div class="mt-12 text-center">
    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group">
        Lihat semua layanan
        <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
    </a>
</div>