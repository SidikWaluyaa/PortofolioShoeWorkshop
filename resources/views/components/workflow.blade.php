<div class="bg-white rounded-[32px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] border border-gray-100 p-8 sm:p-10 h-full flex flex-col justify-between hover:shadow-2xl transition-all duration-500">
    <div class="mb-12 flex items-center justify-between">
        <h3 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">Cara Kerja Kami</h3>
        <div class="w-12 h-1.5 bg-[#22AF85] rounded-full"></div>
    </div>
    
    <div class="relative py-4 mb-4 group/workflow">
        <!-- Desktop Connecting Line -->
        <div class="hidden sm:block absolute top-[28px] left-0 w-full h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="absolute top-0 left-0 h-full bg-[#22AF85] w-0 group-hover/workflow:w-full transition-all duration-[2000ms] ease-out"></div>
        </div>
        
        <div class="relative flex flex-col sm:flex-row justify-between gap-10 sm:gap-2 px-2">
            @foreach($workflow as $index => $step)
            <div class="flex sm:flex-col items-center gap-6 sm:gap-5 relative group/step">
                <!-- Step Number/Icon Container -->
                <div class="flex-shrink-0 w-14 h-14 md:w-16 md:h-16 rounded-2xl bg-white text-[#22AF85] flex items-center justify-center relative z-10 border-4 border-gray-50 shadow-lg group-hover/step:border-[#FFC232] group-hover/step:bg-[#FFC232] group-hover/step:text-gray-900 transition-all duration-300 transform group-hover/step:-translate-y-1 sm:group-hover/step:-translate-y-2">
                    <span class="text-2xl">{!! $step->icon !!}</span>
                    <!-- Mobile Vertical Line Connector -->
                    @if(!$loop->last)
                    <div class="sm:hidden absolute top-14 left-1/2 -translate-x-1/2 w-1 h-10 bg-gray-100 z-0">
                        <div class="w-full h-0 group-hover/workflow:h-full bg-[#22AF85] transition-all duration-500 delay-[{{ $index * 200 }}ms]"></div>
                    </div>
                    @endif
                </div>

                <!-- Text Content -->
                <div class="text-left sm:text-center sm:absolute sm:top-20 sm:w-32 transition-all duration-300">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Step 0{{ $index + 1 }}</p>
                    <p class="text-sm font-black text-gray-900 group-hover/step:text-[#22AF85] transition-colors tracking-tight">{{ $step->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-12 sm:mt-16 text-center bg-green-50/50 py-5 rounded-2xl border border-green-100/50">
        <p class="text-xs text-gray-500 font-black uppercase tracking-widest flex items-center justify-center gap-3">
            <span class="w-2 h-2 rounded-full bg-[#22AF85] animate-pulse"></span>
            Proses Dimulai Segera
        </p>
    </div>
</div>
