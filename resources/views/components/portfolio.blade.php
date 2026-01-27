<div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-10 h-full flex flex-col hover:shadow-2xl transition-shadow duration-300">
    <div class="mb-10 flex items-center justify-between">
        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Hasil Pekerjaan Kami</h3>
        <div class="w-12 h-1 bg-[#22AF85] rounded-full"></div>
    </div>
    
    <div class="flex items-start justify-between gap-4 flex-grow mb-8 relative">
        @php $projects = $portfolio->take(3); @endphp
        
        @foreach($projects as $index => $project)
            <div class="flex-1 flex flex-col items-center relative z-10 group/card">
                <!-- Image Card -->
                <div class="w-full aspect-square rounded-2xl overflow-hidden shadow-md bg-gray-50 border border-gray-100 cursor-pointer relative">
                    <img src="{{ $project->after_image ? asset('storage/' . $project->after_image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=400&q=80' }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-black/0 group-hover/card:bg-black/10 transition-colors duration-300"></div>
                </div>
                <!-- Label Card -->
                <div class="mt-4 w-full bg-[#1F2937] py-3 px-2 rounded-xl text-center shadow-lg group-hover/card:bg-[#22AF85] transition-colors duration-300">
                    <p class="text-xs font-bold text-white uppercase tracking-wider">{{ $project->title }}</p>
                </div>
            </div>

            <!-- Connector Arrow (except for last item) -->
            @if($index < count($projects) - 1)
                <div class="flex-shrink-0 w-8 flex items-center justify-center pt-16 relative z-0">
                    <div class="w-8 h-8 rounded-full bg-[#FFC232] flex items-center justify-center shadow-md animate-bounce-horizontal">
                        <svg class="w-5 h-5 text-gray-900 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Fallback if less than 3 items --}}
        @for($i = count($projects); $i < 3; $i++)
            <div class="flex-1 flex flex-col items-center opacity-40">
                <div class="w-full aspect-square rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4v16m8-8H4" /></svg>
                </div>
                <div class="mt-4 w-full bg-gray-100 py-3 rounded-xl"></div>
            </div>
            @if($i < 2)
                <div class="flex-shrink-0 w-8"></div>
            @endif
        @endfor
    </div>

    <div class="mt-8 pt-8 border-t border-gray-50">
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-[#FFC232] text-gray-900 text-base font-bold rounded-xl shadow-lg shadow-yellow-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            Punya kasus mirip? Kirim Foto Sekarang
            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
        </a>
    </div>
</div>

<style>
@keyframes bounce-horizontal {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(3px); }
}
.animate-bounce-horizontal {
    animation: bounce-horizontal 2s infinite;
}
</style>
