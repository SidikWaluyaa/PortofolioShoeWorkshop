@if($cta)
<section class="relative bg-[#103D31] py-24 sm:py-32 overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-[#22AF85] rounded-full blur-[100px] opacity-20 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-[#FFC232] rounded-full blur-[100px] opacity-10 translate-x-1/2 translate-y-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl md:text-6xl font-black text-[#FFC232] mb-8 leading-[1.1] tracking-tighter">
            {{ $cta->title }}
        </h2>
        <p class="text-lg sm:text-xl text-gray-300 mb-12 max-w-2xl mx-auto font-medium leading-relaxed opacity-80">
            {{ $cta->subtitle }}
        </p>
        <a href="{{ $cta->button_link }}" class="inline-flex items-center justify-center gap-4 px-10 py-5 bg-[#FFC232] text-gray-900 text-base sm:text-lg font-black rounded-2xl shadow-[0_20px_40px_-10px_rgba(255,194,50,0.3)] hover:shadow-yellow-200 hover:-translate-y-1 active:scale-95 transition-all duration-300 group">
            {{ $cta->button_text }}
            <div class="bg-black/10 rounded-xl p-1.5 transition-transform group-hover:translate-x-1">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </div>
        </a>
    </div>
</section>
@endif
