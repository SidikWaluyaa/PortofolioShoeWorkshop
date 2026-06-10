@if($hero)
<section class="min-h-[500px] lg:min-h-[700px] flex flex-col lg:flex-row overflow-hidden border-b border-gray-200">
    {{-- Left: Text Content --}}
    <div class="w-full lg:w-1/2 bg-white flex items-center justify-center px-6 sm:px-10 lg:px-16 py-16 lg:py-0">
        <div class="max-w-[540px] space-y-6 sm:space-y-8">
            <div class="space-y-3">
                <p class="text-sm font-semibold tracking-[0.2em] text-gray-500 uppercase">Reparasi & Perawatan Sepatu</p>
                <h1 class="text-4xl sm:text-5xl lg:text-[56px] font-extrabold text-[#1c1c17] leading-[1.1] tracking-tight">
                    {{ $hero->title }}
                </h1>
            </div>
            <p class="text-base sm:text-lg text-gray-500 leading-relaxed">
                {{ $hero->subtitle }}
            </p>
            <div class="flex flex-wrap items-center gap-4 pt-2">
                <a href="{{ $hero->primary_cta_link }}"
                   class="inline-flex items-center gap-3 px-8 py-4 bg-[#FFC232] text-[#1c1c17] font-semibold text-base sm:text-lg rounded-lg shadow-lg shadow-[#FFC232]/20 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all">
                    <span class="material-symbols-outlined">chat</span>
                    {{ $hero->primary_cta_text }}
                </a>
                <div class="flex items-center gap-3 py-2 px-4 border border-gray-200 rounded-xl bg-white">
                    <span class="material-symbols-outlined text-[#22AF85] fill-1">verified_user</span>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-[#1c1c17]">Respons cepat</span>
                        <span class="text-xs text-gray-500">& gratis konsultasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Right: Image with Green Background --}}
    <div class="w-full lg:w-1/2 bg-[#22AF85] relative flex items-center justify-center p-8 lg:p-0 min-h-[300px] sm:min-h-[400px] lg:min-h-0">
        <div class="relative w-full h-full flex items-center justify-center hover:scale-105 transition-transform duration-700 ease-out">
            <img src="{{ $hero->image_url }}"
                 alt="{{ $hero->title }}"
                 class="w-4/5 object-contain drop-shadow-[0_35px_35px_rgba(0,0,0,0.4)]">
        </div>
        {{-- Brand Badge --}}
        <div class="absolute bottom-8 right-8 sm:bottom-12 sm:right-12 bg-[#1c1c17] text-white px-6 sm:px-8 py-3 sm:py-4 rounded-2xl flex flex-col items-center group">
            <span class="text-sm font-semibold tracking-[0.2em] opacity-80">SHOE</span>
            <span class="text-lg sm:text-2xl font-bold text-[#FFC232] group-hover:text-white transition-colors uppercase">Workshop</span>
        </div>
    </div>
</section>
@endif