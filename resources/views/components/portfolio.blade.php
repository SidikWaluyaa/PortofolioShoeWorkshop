<div class="bg-white rounded-[32px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] border border-gray-100 p-8 sm:p-10 h-full flex flex-col hover:shadow-2xl transition-all duration-500">
    <div class="mb-10 flex items-center justify-between">
        <h3 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">Hasil Pekerjaan Kami</h3>
        <div class="w-12 h-1.5 bg-[#FFC232] rounded-full"></div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-4 lg:gap-6 flex-grow relative">
        @php $projects = $portfolio->take(3); @endphp
        
        @foreach($projects as $index => $project)
            <div class="flex flex-col items-center relative z-10 group/card">
                <!-- Image Card -->
                <div class="w-full aspect-square rounded-2xl overflow-hidden shadow-md bg-gray-50 border border-gray-100 cursor-pointer relative">
                    <img src="{{ $project->after_image ? asset('storage/' . $project->after_image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-black/0 group-hover/card:bg-black/10 transition-colors duration-300 flex items-center justify-center">
                        <span class="opacity-0 group-hover/card:opacity-100 px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-[10px] font-black uppercase tracking-widest text-[#22AF85] transition-opacity duration-300">View Detail</span>
                    </div>
                </div>
                <!-- Label Card -->
                <div class="mt-4 w-full bg-[#1F2937] py-3.5 px-3 rounded-2xl text-center shadow-lg group-hover/card:bg-[#22AF85] transition-all duration-300 -translate-y-2 group-hover/card:-translate-y-3">
                    <p class="text-[10px] font-black text-white uppercase tracking-[0.2em] leading-none">{{ $project->title }}</p>
                </div>

                <!-- Desktop Connector Arrow -->
                @if($index < count($projects) - 1)
                    <div class="hidden sm:flex absolute top-1/2 -right-3 md:-right-4 lg:-right-5 w-6 h-6 md:w-8 md:h-8 rounded-full bg-[#FFC232] items-center justify-center shadow-lg z-20 -translate-y-12 animate-bounce-horizontal">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                @endif
            </div>
        @endforeach

        {{-- Fallback placeholders --}}
        @for($i = count($projects); $i < 3; $i++)
            <div class="hidden sm:flex flex-col items-center opacity-30">
                <div class="w-full aspect-square rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4v16m8-8H4" /></svg>
                </div>
                <div class="mt-4 w-1/2 h-6 bg-gray-100 rounded-lg"></div>
            </div>
        @endfor
    </div>

    <div class="mt-12 pt-8 border-t border-gray-50">
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="w-full flex items-center justify-center gap-3 px-6 py-5 bg-white border-2 border-[#22AF85] text-[#22AF85] text-sm font-black rounded-2xl hover:bg-green-50 transition-all duration-300 group">
            Lihat Portfolio Lainnya
            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
        </a>
    </div>
</div>

<style>
@keyframes bounce-horizontal {
    0%, 100% { transform: translate(0, -50%) translateX(0); }
    50% { transform: translate(0, -50%) translateX(4px); }
}
.animate-bounce-horizontal {
    animation: bounce-horizontal 2s infinite;
}
</style>

<style>
@keyframes bounce-horizontal {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(3px); }
}
.animate-bounce-horizontal {
    animation: bounce-horizontal 2s infinite;
}
</style>
