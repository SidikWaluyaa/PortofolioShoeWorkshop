@if($cta)
@php
    $message = "Halo Shoe Workshop, saya ingin berkonsultasi mengenai perawatan/reparasi sepatu saya. Boleh bantu estimasi biayanya?";
    $waUrl = $cta->button_link;
    if (str_contains($waUrl, 'wa.me') && !str_contains($waUrl, 'text=')) {
        $separator = str_contains($waUrl, '?') ? '&' : '?';
        $waUrl .= $separator . 'text=' . urlencode($message);
    }
@endphp
<section class="py-12 sm:py-16 md:py-24 px-4 sm:px-6 lg:px-16 bg-transparent relative z-10">
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
            <div class="grid grid-cols-2 gap-3 max-w-[340px] mx-auto sm:flex sm:flex-wrap sm:justify-center sm:gap-4 sm:max-w-none pt-4">
                <a href="{{ $waUrl }}" 
                   class="bg-[#FFC232] text-[#1c1c17] px-4 py-3 sm:px-10 sm:py-5 rounded-xl font-bold text-xs sm:text-base shadow-xl hover:brightness-105 active:scale-95 transition-all flex items-center justify-center gap-1.5 sm:gap-3">
                    <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">chat</span>
                    <span class="truncate">{{ $cta->button_text }}</span>
                </a>
                <a href="#layanan" 
                   class="bg-transparent border-2 border-white/50 text-white px-4 py-3 sm:px-10 sm:py-5 rounded-xl font-bold text-xs sm:text-base hover:bg-white/10 active:scale-95 transition-all flex items-center justify-center">
                    Pelajari Layanan
                </a>
            </div>
        </div>
    </div>
</section>
@endif