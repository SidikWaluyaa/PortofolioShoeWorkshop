<section id="donasi-showcase" class="py-20 lg:py-28 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 relative z-10">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-4">
        <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Program Sosial Shoe Workshop</p>
        <h2 class="text-3xl md:text-4xl lg:text-[42px] font-black text-[#1c1c17] leading-tight">
            Sepatu yang Siap Melangkah Lagi
        </h2>
        <p class="text-gray-500 text-lg leading-relaxed max-w-2xl mx-auto">
            Inilah sebagian kecil dari dedikasi kami. Sepatu-sepatu donasi ini telah melalui proses restorasi terbaik dan siap disalurkan kepada mereka yang membutuhkan.
        </p>
    </div>

        <!-- Etalase Donasi -->
        <div class="mb-12 relative z-20">
            <style>
                .hide-scrollbar::-webkit-scrollbar {
                    display: none;
                }
                .hide-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
            <!-- Carousel Container -->
            <div class="flex overflow-x-auto gap-4 sm:gap-6 pb-6 snap-x snap-mandatory hide-scrollbar">
                @foreach($donationShowcase as $item)
                    <div class="w-[280px] sm:w-[320px] shrink-0 snap-center sm:snap-start h-auto">
                        @include('katalog.partials.item-card', ['item' => $item])
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Button -->
        <div class="mt-14 text-center">
        <a href="{{ route('katalog.index') }}" 
           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group">
            Lihat Seluruh Katalog Donasi
            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
        <p class="mt-4 text-sm text-gray-500 font-medium">Ingin sepatumu terpajang di sini? <a href="{{ route('register') }}" class="text-[#22AF85] hover:underline font-bold">Daftar donatur sekarang!</a></p>
    </div>
    </div>
</section>
