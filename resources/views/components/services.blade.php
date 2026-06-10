{{-- Services Grid --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6 sm:gap-8">
    @foreach($services as $i => $service)
    <div class="group text-center cursor-default">
        <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto mb-3 bg-gray-50 rounded-2xl flex items-center justify-center text-2xl border border-gray-100 group-hover:bg-[#22AF85]/10 group-hover:border-[#22AF85]/20 group-hover:scale-110 transition-all duration-300">
            {!! $service->icon !!}
        </div>
        <h3 class="font-bold text-gray-800 text-xs sm:text-sm group-hover:text-[#22AF85] transition-colors duration-300">{{ $service->name }}</h3>
    </div>
    @endforeach
</div>

{{-- Link --}}
<div class="text-center mt-10 sm:mt-12">
    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-[#22AF85] hover:text-[#178a67] transition-colors group">
        Lihat semua layanan
        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
</div>