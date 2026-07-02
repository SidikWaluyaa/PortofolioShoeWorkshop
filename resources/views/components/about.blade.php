@if($about)
<div class="bg-[#22AF85] text-white py-20 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16">
        
        {{-- Centered Section Header --}}
        <div class="flex flex-col items-center text-center gap-4 mb-16">
            <p class="text-sm font-semibold text-[#FFC232] tracking-widest uppercase">Tentang Kami</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">Mengenal Shoe Workshop</h2>
        </div>

        <div class="flex flex-col lg:flex-row items-center gap-16">
            {{-- Left: Double Image Grid --}}
            <div class="w-full lg:w-1/2 relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-xl aspect-square overflow-hidden shadow-lg">
                        <img src="{{ $about->image_url }}" 
                             alt="Workshop" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-xl aspect-square overflow-hidden mt-8 shadow-lg">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWkXo-wjJMiHbOZyqwo4bkipp-Th4cHTwnxrIrGzlpBtwYWycQ0Bv707HTLcIsqKayFutp6de8dAyoxGi1eboaUVvs27WT7Jxzkb-MTw--3Vlj5fVKvyfI8IIg0Y78iPQpY2VVeWaz1IJ0hdDWFNWCNRYzsE_oFIU1Wj5O0dROCBjwFcynqU40MRQH4PT0nOPkfO2mfmvz8NU-SAqqVZO2spv1-SKxRVJetEB3WPvoLFRbqhXP5_iwhOP9_XR9TIWx8agTuy-yiHl0" 
                             alt="Tools" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                {{-- Experience Badge --}}
                <div class="absolute -bottom-6 -right-6 bg-[#FFC232] p-6 sm:p-8 rounded-2xl shadow-xl hidden sm:block">
                    <p class="text-[40px] sm:text-[48px] font-black leading-none text-[#1c1c17]">9+</p>
                    <p class="text-[10px] sm:text-xs font-bold uppercase tracking-widest opacity-80 text-[#1c1c17] mt-1">Tahun Berpengalaman</p>
                </div>
            </div>

            {{-- Right: Content & Stats --}}
            <div class="w-full lg:w-1/2 space-y-6">
                <p class="text-xs sm:text-sm font-semibold tracking-[0.2em] opacity-80 uppercase">
                    {{ $about->title }}
                </p>
                <h3 class="text-2xl sm:text-3xl font-extrabold leading-tight text-white">
                    Workshop Spesialis Reparasi &amp; Restorasi
                </h3>
                <p class="text-sm sm:text-base opacity-90 leading-relaxed whitespace-pre-line">
                    {{ $about->description }}
                </p>
                
                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 sm:gap-8 py-8 border-y border-white/20">
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-white">9+</p>
                        <p class="text-[10px] sm:text-xs font-bold opacity-75 uppercase tracking-wider mt-1">Tahun Berjalan</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-white">100K+</p>
                        <p class="text-[10px] sm:text-xs font-bold opacity-75 uppercase tracking-wider mt-1">Pelanggan Puas</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-white">100%</p>
                        <p class="text-[10px] sm:text-xs font-bold opacity-75 uppercase tracking-wider mt-1">Garansi Pengerjaan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif