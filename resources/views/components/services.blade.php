{{-- Services Grid: 4-col cards with icon + title + description --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($services as $service)
    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-gray-200 flex flex-col gap-4 hover:border-[#22AF85] hover:shadow-xl transition-all group">
        <div class="w-12 h-12 rounded-xl bg-[#22AF85]/10 flex items-center justify-center text-xl">
            {!! $service->icon !!}
        </div>
        <h3 class="font-semibold text-[#1c1c17] text-lg">{{ $service->name }}</h3>
        @if($service->description)
        <p class="text-gray-500 text-sm leading-relaxed">{{ $service->description }}</p>
        @endif
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