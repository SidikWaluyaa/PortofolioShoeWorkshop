<div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-10 h-full flex flex-col justify-between hover:shadow-2xl transition-shadow duration-300">
    <div class="mb-12 flex items-center justify-between">
        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Cara Kerja Kami</h3>
        <div class="w-12 h-1 bg-[#22AF85] rounded-full"></div>
    </div>
    
    <div class="relative py-6 mb-8 group">
        <!-- Connecting Line -->
        <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-100 -translate-y-1/2 rounded-full overflow-hidden">
            <div class="w-full h-full bg-[#22AF85]/20"></div>
            <div class="absolute top-0 left-0 h-full bg-[#22AF85] w-0 group-hover:w-full transition-all duration-[2000ms] ease-out"></div>
        </div>
        
        <div class="relative flex justify-between px-2">
            @foreach($workflow as $index => $step)
            <div class="flex flex-col items-center gap-5 relative group/step">
                <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl bg-white text-[#22AF85] flex items-center justify-center relative z-10 border-4 border-gray-50 shadow-lg group-hover/step:border-[#FFC232] group-hover/step:bg-[#FFC232] group-hover/step:text-gray-900 transition-all duration-300 transform group-hover/step:-translate-y-2">
                    <span class="text-2xl transition-transform duration-300">{!! $step->icon !!}</span>
                    <div class="absolute -bottom-2 w-4 h-4 bg-white rotate-45 border-r border-b border-gray-100 opacity-0 group-hover/step:opacity-100 transition-opacity"></div>
                </div>
                <div class="text-center absolute top-20 w-32 transition-all duration-300 transform group-hover/step:translate-y-1">
                    <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-1">Step 0{{ $index + 1 }}</p>
                    <p class="text-sm font-medium text-gray-500 group-hover/step:text-[#22AF85] transition-colors line-clamp-2">{{ $step->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-16 text-center bg-green-50/50 py-4 rounded-xl border border-green-100/50">
        <p class="text-xs text-gray-500 font-medium flex items-center justify-center gap-2">
            <svg class="w-4 h-4 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Proses dimulai setelah sepatu dicek dan disetujui.
        </p>
    </div>
</div>
