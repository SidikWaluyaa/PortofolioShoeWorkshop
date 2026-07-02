{{-- Services Grid: 4-col cards with icon + title + description --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    @foreach($services as $service)
    <div class="bg-white p-4 sm:p-8 rounded-xl sm:rounded-2xl border border-gray-200 flex flex-col gap-3 sm:gap-4 hover:border-[#22AF85] hover:shadow-xl transition-all group overflow-hidden break-words">
        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-[#22AF85]/10 flex items-center justify-center text-base sm:text-xl shrink-0 overflow-hidden break-all text-center">
            {!! $service->icon !!}
        </div>
        <div class="flex flex-col gap-1 sm:gap-2">
            <h3 class="font-semibold text-[#1c1c17] text-sm sm:text-lg break-words leading-snug">{{ $service->name }}</h3>
            @if($service->description)
            <p class="text-gray-500 text-xs sm:text-sm leading-relaxed break-words">{{ $service->description }}</p>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Link --}}
<div class="mt-12 text-center">
    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-[#22AF85] hover:underline group">
        Lihat semua layanan
        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
    </a>
</div>