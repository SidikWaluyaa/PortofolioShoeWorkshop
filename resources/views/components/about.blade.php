@if($about)
<div class="relative bg-[#188060] text-white py-20 sm:py-28 overflow-hidden z-0">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-[#22AF85]/40 to-transparent rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-[#FFC232]/20 to-transparent rounded-full blur-[80px] translate-y-1/3 -translate-x-1/3 pointer-events-none"></div>
    
    {{-- Dot Pattern Overlay --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:24px_24px] opacity-10 pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 z-10">
        
        {{-- Centered Section Header --}}
        <div class="flex flex-col items-center text-center gap-4 mb-16">
            <p class="text-sm font-semibold text-[#FFC232] tracking-widest uppercase">Tentang Kami</p>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight tracking-tight drop-shadow-sm">Mengenal Shoe Workshop</h2>
        </div>

        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            {{-- Left: Asymmetric Floating Image Grid --}}
            <div class="w-full lg:w-1/2 relative group">
                <div class="grid grid-cols-2 gap-4 sm:gap-6 relative z-10">
                    <div class="rounded-2xl sm:rounded-3xl aspect-[4/5] overflow-hidden shadow-2xl transform transition-transform duration-700 group-hover:-translate-y-2 group-hover:rotate-1">
                        <img src="{{ $about->image_url }}" 
                             alt="Workshop" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-bold text-sm">Pengrajin Berpengalaman</p>
                        </div>
                    </div>
                    <div class="rounded-2xl sm:rounded-3xl aspect-[4/5] overflow-hidden mt-12 sm:mt-16 shadow-2xl transform transition-transform duration-700 group-hover:translate-y-2 group-hover:-rotate-1 relative">
                        <img src="https://images.unsplash.com/photo-1593113630400-ea4288922497?q=80&w=2070&auto=format&fit=crop" 
                             alt="Social Program" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-bold text-sm">Program Donasi Sosial</p>
                        </div>
                    </div>
                </div>
                
                {{-- Experience Badge (Floating) --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md border border-white/20 p-6 sm:p-8 rounded-[2rem] shadow-[0_30px_60px_rgba(0,0,0,0.3)] z-20 animate-float pointer-events-none">
                    <div class="flex flex-col items-center text-center">
                        <p class="text-[3rem] sm:text-[4rem] font-black leading-none text-[#FFC232] drop-shadow-md">9+</p>
                        <p class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-white mt-2 drop-shadow-sm">Tahun<br>Dedikasi</p>
                    </div>
                </div>
            </div>

            {{-- Right: Content & Stats --}}
            <div class="w-full lg:w-1/2 space-y-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm">
                        <span class="material-symbols-outlined text-[#FFC232] !text-sm">verified</span>
                        <p class="text-xs font-bold tracking-widest text-white uppercase">{{ $about->title }}</p>
                    </div>
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.15] text-white">
                        Restorasi Sepatu &amp; <br>
                        <span class="text-[#FFC232]">Dampak Sosial.</span>
                    </h3>
                </div>
                
                <p class="text-base sm:text-lg text-white/90 leading-relaxed font-normal whitespace-pre-line">
                    {{ $about->description }}
                </p>
                
                {{-- Modern Stats Grid --}}
                <div class="grid grid-cols-3 gap-2 sm:gap-6 pt-6">
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left bg-white/5 border border-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-5 hover:bg-white/10 transition-colors">
                        <span class="material-symbols-outlined text-[#FFC232] !text-xl sm:!text-3xl mb-1 sm:mb-2">work_history</span>
                        <p class="text-lg sm:text-3xl font-black text-white">9+</p>
                        <p class="text-[8px] sm:text-[10px] font-bold text-white/70 uppercase tracking-widest sm:mt-1">Tahun<br class="block sm:hidden"> Berjalan</p>
                    </div>
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left bg-white/5 border border-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-5 hover:bg-white/10 transition-colors">
                        <span class="material-symbols-outlined text-[#FFC232] !text-xl sm:!text-3xl mb-1 sm:mb-2">group</span>
                        <p class="text-lg sm:text-3xl font-black text-white">100K+</p>
                        <p class="text-[8px] sm:text-[10px] font-bold text-white/70 uppercase tracking-widest sm:mt-1">Pelanggan<br class="block sm:hidden"> Puas</p>
                    </div>
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left bg-white/5 border border-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-5 hover:bg-white/10 transition-colors">
                        <span class="material-symbols-outlined text-[#FFC232] !text-xl sm:!text-3xl mb-1 sm:mb-2">volunteer_activism</span>
                        <p class="text-lg sm:text-3xl font-black text-white">1.5K+</p>
                        <p class="text-[8px] sm:text-[10px] font-bold text-white/70 uppercase tracking-widest sm:mt-1">Donasi<br class="block sm:hidden"> Disalurkan</p>
                    </div>
                </div>
                
                {{-- Action Button --}}
                <div class="pt-6 flex justify-center lg:justify-start">
                    <a href="https://wa.me/{{ $globalSettings['whatsapp_number'] ?? '628123456789' }}?text=Halo%20Admin%20ShoeWorkshop,%20saya%20ingin%20konsultasi%20mengenai%20sepatu%20saya." 
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 w-full sm:w-auto bg-[#FFC232] text-[#1c1c17] rounded-xl font-bold hover:scale-105 active:scale-95 transition-transform shadow-[0_10px_30px_rgba(255,194,50,0.3)]">
                        <span class="material-symbols-outlined !text-lg">forum</span>
                        Konsultasi Sepatu Anda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif