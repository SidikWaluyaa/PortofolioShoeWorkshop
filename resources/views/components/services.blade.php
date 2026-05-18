<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($services as $i => $service)
        <div class="group">
            <div class="w-14 h-14 mb-4 bg-[#f5f0e8] rounded-2xl flex items-center justify-center text-2xl">
                {!! $service->icon !!}
            </div>
            <h3 class="font-bold text-gray-900 text-sm mb-2">{{ $service->name }}</h3>
            <p class="text-xs text-gray-500 leading-relaxed mb-3">{{ $service->description }}</p>
        </div>
        @endforeach
    </div>
    <div class="border-t border-gray-100 pt-6 text-center">
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-[#22AF85] transition-colors">
            Lihat semua layanan
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</div>