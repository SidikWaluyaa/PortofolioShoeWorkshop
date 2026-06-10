<div class="bg-[#22AF85] py-16 sm:py-20 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Left: Image --}}
            <div class="flex justify-center">
                <div class="relative">
                    <div class="w-56 h-56 sm:w-72 sm:h-72 lg:w-80 lg:h-80 rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20">
                        <img src="{{ $about->image ? asset('storage/'.$about->image) : 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=600&q=80' }}"
                             alt="{{ $about->title ?? 'Tentang Kami' }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    {{-- Experience badge --}}
                    <div class="absolute -bottom-4 -right-4 bg-white text-[#22AF85] rounded-2xl px-5 py-4 shadow-xl text-center">
                        <p class="text-3xl font-black leading-none">9+</p>
                        <p class="text-xs font-bold uppercase tracking-widest mt-1 text-gray-500">Tahun</p>
                    </div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div>
                <p class="text-xs font-bold tracking-[0.2em] text-white/50 uppercase mb-3">Tentang Kami</p>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight mb-4">Workshop Spesialis Reparasi & Restorasi</h2>
                <p class="text-white/70 text-sm leading-relaxed mb-8">{{ $about->description }}</p>

                {{-- Stats Grid --}}
                <div class="grid grid-cols-3 gap-3 sm:gap-4 mb-8">
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl py-4 sm:py-5 border border-white/10 hover:bg-white/15 transition-colors">
                        <p class="text-2xl sm:text-3xl font-black text-white">9+</p>
                        <p class="text-[10px] sm:text-xs font-bold text-white/50 uppercase tracking-widest mt-1">Tahun</p>
                    </div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl py-4 sm:py-5 border border-white/10 hover:bg-white/15 transition-colors">
                        <p class="text-2xl sm:text-3xl font-black text-white">1000+</p>
                        <p class="text-[10px] sm:text-xs font-bold text-white/50 uppercase tracking-widest mt-1">Pelanggan</p>
                    </div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl py-4 sm:py-5 border border-white/10 hover:bg-white/15 transition-colors">
                        <p class="text-2xl sm:text-3xl font-black text-white">100%</p>
                        <p class="text-[10px] sm:text-xs font-bold text-white/50 uppercase tracking-widest mt-1">Garansi</p>
                    </div>
                </div>

                {{-- CTA Button --}}
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-[#22AF85] text-sm font-bold rounded-xl hover:bg-white/90 transition-all duration-300 shadow-lg hover:-translate-y-0.5 group">
                    Konsultasi Sekarang
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>