<div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-10 h-full flex flex-col hover:shadow-2xl transition-shadow duration-300">
    <div class="mb-10 flex items-center justify-between">
        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $about->title ?? 'Berdiri Sejak 2017' }}</h3>
        <div class="w-12 h-1 bg-[#22AF85] rounded-full"></div>
    </div>
    
    <div class="flex flex-col xl:flex-row gap-10 items-center flex-grow">
        <div class="flex-grow order-2 xl:order-1">
            <p class="text-base text-gray-600 leading-loose font-medium text-justify">
                {{ $about->description }}
            </p>
            <div class="mt-8 flex gap-4">
                <div class="text-center px-4 py-2 bg-gray-50 rounded-lg border border-gray-100">
                    <span class="block text-2xl font-bold text-[#22AF85]">5+</span>
                    <span class="text-xs text-gray-500 uppercase tracking-wide">Tahun</span>
                </div>
                <div class="text-center px-4 py-2 bg-gray-50 rounded-lg border border-gray-100">
                    <span class="block text-2xl font-bold text-[#FFC232]">1k+</span>
                    <span class="text-xs text-gray-500 uppercase tracking-wide">Pelanggan</span>
                </div>
            </div>
        </div>
        <div class="flex-shrink-0 w-full xl:w-48 order-1 xl:order-2">
            <div class="aspect-square rounded-2xl overflow-hidden shadow-lg border-4 border-white ring-1 ring-gray-100 rotate-3 hover:rotate-0 transition-all duration-500">
                <img src="{{ $about->image ? asset('storage/' . $about->image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=400&q=80' }}" alt="About Image" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</div>
