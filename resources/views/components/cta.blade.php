@if($cta)
<section class="py-12 sm:py-16 md:py-24 px-4 sm:px-6 lg:px-16 bg-white">
    <div class="max-w-7xl mx-auto bg-[#22AF85] rounded-[40px] p-12 md:p-24 overflow-hidden relative text-white text-center shadow-xl">
        {{-- Blur blobs --}}
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 space-y-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black max-w-[800px] mx-auto leading-tight text-white">
                {{ $cta->title }}
            </h2>
            <p class="text-sm sm:text-base md:text-lg opacity-90 max-w-[600px] mx-auto leading-relaxed">
                {{ $cta->subtitle }}
            </p>
            <div class="flex flex-wrap justify-center gap-4 pt-4">
                <a href="{{ $cta->button_link }}" 
                   class="bg-[#FFC232] text-[#1c1c17] px-8 sm:px-10 py-4 sm:py-5 rounded-xl font-bold shadow-xl hover:brightness-105 active:scale-95 transition-all flex items-center gap-3">
                    <span class="material-symbols-outlined !text-[22px]">chat</span>
                    {{ $cta->button_text }}
                </a>
                <a href="#layanan" 
                   class="bg-transparent border-2 border-white/50 text-white px-8 sm:px-10 py-4 sm:py-5 rounded-xl font-bold hover:bg-white/10 transition-all">
                    Pelajari Layanan
                </a>
            </div>
        </div>
    </div>
</section>
@endif