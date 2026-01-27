<div class="bg-white rounded-[32px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] border border-gray-100 p-8 sm:p-10 h-full flex flex-col hover:shadow-2xl transition-all duration-500">
    <div class="mb-10 flex items-center justify-between">
        <h3 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">{{ $about->title ?? 'Berdiri Sejak 2017' }}</h3>
        <div class="w-12 h-1.5 bg-[#22AF85] rounded-full"></div>
    </div>
    
    <div class="flex flex-col md:flex-row gap-10 items-start flex-grow">
        <div class="flex-grow order-2 md:order-1">
            <p class="text-sm sm:text-base text-gray-400 leading-loose font-medium text-justify">
                {{ $about->description }}
            </p>
            <div class="mt-8 flex gap-5">
                <div class="flex-1 text-center px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                    <span class="block text-2xl font-black text-[#22AF85]">5+</span>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Tahun</span>
                </div>
                <div class="flex-1 text-center px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                    <span class="block text-2xl font-black text-[#FFC232]">1K+</span>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Pelanggan</span>
                </div>
            </div>
        </div>
        <div class="flex-shrink-0 w-full md:w-48 order-1 md:order-2 flex justify-center md:justify-end">
            <div class="w-40 h-40 rounded-[32px] overflow-hidden shadow-2xl border-8 border-white ring-1 ring-gray-100 rotate-6 hover:rotate-0 transition-all duration-500 transform hover:scale-110">
                <img src="{{ $about->image ? asset('storage/' . $about->image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=400&q=80' }}" alt="About Image" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</div>
