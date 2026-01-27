@if($cta)
<section class="relative bg-[#103D31] py-24 overflow-hidden">
    <!-- Subtle Pattern Overlay -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FFC232 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-extrabold text-[#FFC232] mb-6 leading-tight tracking-tight">
            {{ $cta->title }}
        </h2>
        <p class="text-xl text-gray-200 mb-12 opacity-90 max-w-2xl mx-auto font-light leading-relaxed">
            {{ $cta->subtitle }}
        </p>
        <a href="{{ $cta->button_link }}" class="inline-flex items-center gap-3 px-10 py-5 bg-[#FFC232] text-gray-900 font-bold rounded-full shadow-2xl hover:bg-[#ffcd57] hover:scale-105 transition-all duration-300 text-lg group">
            {{ $cta->button_text }}
            <div class="bg-white/20 rounded-full p-1 group-hover:translate-x-1 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </div>
        </a>
    </div>
</section>
@endif
