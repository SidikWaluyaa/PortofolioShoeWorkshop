<div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-10 h-full flex flex-col hover:shadow-2xl transition-shadow duration-300">
    <div class="mb-10 flex items-center justify-between">
        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Layanan Kami</h3>
        <div class="w-12 h-1 bg-[#22AF85] rounded-full"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12 flex-grow">
        @foreach($services as $service)
        <div class="flex items-start gap-4 group cursor-default">
            <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center bg-green-50 rounded-2xl group-hover:bg-[#FFC232] transition-colors duration-300 shadow-sm">
                <span class="text-3xl text-[#22AF85] group-hover:text-white transition-colors duration-300">{!! $service->icon !!}</span>
            </div>
            <div class="flex-grow pt-1">
                <h4 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-[#22AF85] transition-colors">{{ $service->name }}</h4>
                <p class="text-sm text-gray-500 leading-relaxed group-hover:text-gray-600">{{ $service->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-12 pt-8 border-t border-gray-50">
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-[#FFC232] text-gray-900 text-base font-bold rounded-xl shadow-lg shadow-yellow-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            Kirim Foto untuk Cek
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
        </a>
    </div>
</div>
