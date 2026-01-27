<div class="bg-white rounded-[32px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] border border-gray-100 p-8 sm:p-10 sm:h-full flex flex-col hover:shadow-2xl transition-all duration-500">
    <div class="mb-10 flex items-center justify-between">
        <h3 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">Layanan Kami</h3>
        <div class="w-12 h-1.5 bg-[#22AF85] rounded-full"></div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-10 lg:gap-x-12 lg:gap-y-12 flex-grow">
        @foreach($services as $service)
        <div class="flex items-start gap-5 group cursor-default">
            <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center bg-gray-50 rounded-2xl group-hover:bg-[#22AF85] group-hover:shadow-lg group-hover:shadow-green-100 transition-all duration-300 transform group-hover:-rotate-6">
                <span class="text-3xl text-[#22AF85] group-hover:text-white transition-colors duration-300">{!! $service->icon !!}</span>
            </div>
            <div class="flex-grow pt-1">
                <h4 class="font-black text-gray-900 text-base sm:text-lg mb-2 group-hover:text-[#22AF85] transition-colors tracking-tight">{{ $service->name }}</h4>
                <p class="text-xs sm:text-sm text-gray-400 font-medium leading-relaxed group-hover:text-gray-500 transition-colors">{{ $service->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-12 pt-8 border-t border-gray-50">
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="w-full flex items-center justify-center gap-3 px-6 py-5 bg-[#FFC232] text-gray-900 text-sm font-black rounded-2xl shadow-xl shadow-yellow-100 hover:shadow-2xl hover:-translate-y-1 active:scale-95 transition-all duration-300">
            Kirim Foto untuk Cek
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
        </a>
    </div>
</div>
