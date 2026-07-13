@if($heroes && $heroes->isNotEmpty())
    @php
        $heroCount = $heroes->count();
    @endphp

    @once
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-12px); }
            }
            @keyframes float-delayed {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-15px); }
            }
            .animate-float { animation: float 4s ease-in-out infinite; }
            .animate-float-delayed { animation: float-delayed 5s ease-in-out infinite 2s; }
            .animate-spin-slow { animation: spin 24s linear infinite; }
            .animate-spin-reverse-slow { animation: spin 30s linear infinite reverse; }
        </style>
    @endonce

    <section
        class="relative z-10 overflow-hidden border-b border-gray-200 bg-white/60 backdrop-blur-md"
        x-data="{
            active: 0,
            total: {{ $heroCount }},
            timer: null,
            init() {
                this.startTimer();
            },
            startTimer() {
                if (this.timer) clearInterval(this.timer);
                if (this.total > 1) {
                    this.timer = window.setInterval(() => {
                        this.active = (this.active + 1) % this.total;
                    }, 6500);
                }
            },
            goTo(index) {
                this.active = index;
                this.startTimer();
            },
            prev() {
                this.active = (this.active - 1 + this.total) % this.total;
                this.startTimer();
            },
            next() {
                this.active = (this.active + 1) % this.total;
                this.startTimer();
            }
        }"
        x-init="init()"
        x-cloak>

        <div class="relative min-h-[780px] sm:min-h-[820px] lg:min-h-[560px] xl:min-h-[640px] group">
            @foreach($heroes as $index => $hero)
                @php
                    $isDonation = Str::contains($hero->primary_cta_link, 'donations') || Str::contains($hero->title, 'Donasi');
                    $heroEyebrow = $isDonation ? 'Program Sosial Shoe Workshop' : 'Reparasi & Perawatan Sepatu';
                @endphp

                <section
                    x-show="active === {{ $loop->index }}"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500 absolute inset-0"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0 h-full w-full"
                    aria-label="Hero slide {{ $loop->index + 1 }}">

                    {{-- Desktop layout --}}
                    <div class="hidden lg:flex h-full relative bg-gradient-to-br from-[#188060] via-[#22AF85] to-[#20a37b] overflow-hidden">
                        {{-- Global Dynamic Circle Backdrop (spanning entire hero) --}}
                        <div class="pointer-events-none absolute top-1/2 left-[60%] h-[800px] w-[800px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.12),transparent_60%)]"></div>
                        <div class="pointer-events-none absolute top-1/2 left-[60%] h-[650px] w-[650px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-white/10 animate-spin-slow"></div>
                        <div class="pointer-events-none absolute top-1/2 left-[60%] h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-[#FFC232]/20 border-dashed animate-spin-reverse-slow"></div>
                        
                        <div class="pointer-events-none absolute left-8 top-20 h-24 w-24 rounded-full bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:16px_16px] opacity-20"></div>
                        <div class="pointer-events-none absolute right-10 top-10 h-24 w-24 rounded-full bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:14px_14px] opacity-20"></div>

                        {{-- Content Container --}}
                        <div class="relative z-10 w-full max-w-7xl mx-auto flex items-center justify-between px-8 xl:px-14">
                            
                            {{-- Left: Text --}}
                            <div class="w-[55%] relative z-20 space-y-5 xl:space-y-6">
                                <div class="space-y-3">
                                    <p class="text-xs sm:text-sm font-bold tracking-[0.24em] text-[#FFC232] uppercase">
                                        {{ $heroEyebrow }}
                                    </p>
                                    <h1 class="text-4xl lg:text-5xl xl:text-[54px] font-extrabold text-white leading-[1.15] tracking-tight drop-shadow-sm">
                                        {{ $hero->title }}
                                    </h1>
                                </div>

                                <p class="text-sm lg:text-base xl:text-lg text-white/90 leading-relaxed font-normal max-w-[90%]">
                                    {{ $hero->subtitle }}
                                </p>

                                <div class="flex flex-row items-center gap-4 pt-2">
                                    <a href="{{ $hero->primary_cta_link }}"
                                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#FFC232] text-[#1c1c17] font-bold text-sm xl:text-base rounded-xl shadow-md shadow-black/10 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all text-center min-w-[200px]">
                                        <span class="material-symbols-outlined !text-[20px]">{{ $isDonation ? 'volunteer_activism' : 'chat' }}</span>
                                        {{ $hero->primary_cta_text }}
                                    </a>

                                    @if($hero->secondary_cta_text && $hero->secondary_cta_link)
                                        <a href="{{ $hero->secondary_cta_link }}"
                                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border border-white/35 text-white font-bold text-sm xl:text-base rounded-xl bg-white/5 backdrop-blur-sm hover:bg-white/10 active:scale-[0.98] transition-all text-center min-w-[200px]">
                                            {{ $hero->secondary_cta_text }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Right: Image --}}
                            <div class="w-[50%] absolute right-0 top-1/2 -translate-y-1/2 flex items-center justify-center z-10 pointer-events-none">
                                {{-- Dark rounded backdrop behind shoe --}}
                                <div class="absolute right-0 xl:-right-10 top-1/2 -translate-y-1/2 w-[90%] xl:w-[105%] h-[130%] xl:h-[140%] rounded-[4rem] xl:rounded-[6rem] bg-[#09412c]/40 shadow-[inset_0_10px_40px_rgba(0,0,0,0.2)] backdrop-blur-md border border-white/5 -rotate-3 z-0 transition-transform duration-700 ease-out"></div>
                                
                                <img src="{{ $hero->image_url }}"
                                     alt="{{ $hero->title }}"
                                     {{ $loop->index === 0 ? 'fetchpriority=high loading=eager' : 'loading=lazy decoding=async' }}
                                     class="relative z-10 w-full max-w-[120%] xl:max-w-[130%] object-contain drop-shadow-[0_28px_30px_rgba(0,0,0,0.35)] transition-transform duration-700 ease-out scale-110 xl:scale-125 xl:-translate-x-12 translate-x-4">
                                
                                {{-- Floating Cards --}}
                                @if(!$isDonation)
                                    {{-- Card 1: Trust Strip --}}
                                    <div class="absolute -top-4 left-0 xl:-left-8 z-20 flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.12)] backdrop-blur-md border border-white/20 animate-float pointer-events-auto">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#FFC232] shadow-inner">
                                            <span class="material-symbols-outlined !text-xl text-[#1c1c17] fill-1">star</span>
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-xs font-black text-white xl:text-sm drop-shadow-md">4.9/5 Rating</span>
                                            <span class="text-[10px] font-semibold text-white/90 xl:text-xs drop-shadow-sm">2.000+ Pelanggan</span>
                                        </div>
                                    </div>
                                    
                                    {{-- Card 2: Tracking --}}
                                    <div class="absolute bottom-8 right-12 xl:right-16 z-20 flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.12)] backdrop-blur-md border border-white/20 animate-float-delayed pointer-events-auto">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-inner">
                                            <span class="material-symbols-outlined !text-xl text-[#22AF85] fill-1">check_circle</span>
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-xs font-black text-white xl:text-sm drop-shadow-md">Status Reparasi</span>
                                            <span class="text-[10px] font-bold text-[#FFC232] xl:text-xs drop-shadow-sm">Repaint Selesai</span>
                                        </div>
                                    </div>

                                    {{-- Card 3: Moved from under buttons --}}
                                    <div class="absolute top-10 right-4 xl:right-10 z-20 flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.12)] backdrop-blur-md border border-white/20 animate-float pointer-events-auto" style="animation-delay: 1.5s;">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-inner">
                                            <span class="material-symbols-outlined !text-xl text-[#FFC232] fill-1">verified_user</span>
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-xs font-black text-white xl:text-sm drop-shadow-md">Respons Cepat</span>
                                            <span class="text-[10px] font-bold text-white/90 xl:text-xs drop-shadow-sm">& konsultasi gratis</span>
                                        </div>
                                    </div>
                                @else
                                    {{-- Card 1: Trust Strip --}}
                                    <div class="absolute -top-4 left-0 xl:-left-8 z-20 flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.12)] backdrop-blur-md border border-white/20 animate-float pointer-events-auto">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#FFC232] shadow-inner">
                                            <span class="material-symbols-outlined !text-xl text-[#1c1c17] fill-1">inventory_2</span>
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-xs font-black text-white xl:text-sm drop-shadow-md">1.542+ Sepatu</span>
                                            <span class="text-[10px] font-semibold text-white/90 xl:text-xs drop-shadow-sm">Telah Disalurkan</span>
                                        </div>
                                    </div>
                                    
                                    {{-- Card 2: Portfolio/Impact --}}
                                    <div class="absolute bottom-8 right-12 xl:right-16 z-20 flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.12)] backdrop-blur-md border border-white/20 animate-float-delayed pointer-events-auto">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-inner">
                                            <span class="material-symbols-outlined !text-xl text-[#22AF85] fill-1">local_shipping</span>
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-xs font-black text-white xl:text-sm drop-shadow-md">Menuju Panti</span>
                                            <span class="text-[10px] font-bold text-[#FFC232] xl:text-xs drop-shadow-sm">Asuhan Bandung</span>
                                        </div>
                                    </div>

                                    {{-- Card 3: Moved from under buttons --}}
                                    <div class="absolute top-10 right-4 xl:right-10 z-20 flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.12)] backdrop-blur-md border border-white/20 animate-float pointer-events-auto" style="animation-delay: 1.5s;">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-inner">
                                            <span class="material-symbols-outlined !text-xl text-[#FFC232] fill-1">handshake</span>
                                        </div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-xs font-black text-white xl:text-sm drop-shadow-md">100% Disalurkan</span>
                                            <span class="text-[10px] font-bold text-white/90 xl:text-xs drop-shadow-sm">kepada yang berhak</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($heroCount > 1)
                            <div class="absolute bottom-8 left-1/2 z-20 -translate-x-1/2 rounded-full bg-black/10 px-4 py-2 backdrop-blur-sm pointer-events-auto">
                                <div class="flex items-center justify-center gap-2.5">
                                    @foreach($heroes as $dotIndex => $dotHero)
                                        <button
                                            @click="goTo({{ $loop->index }})"
                                            :class="active === {{ $loop->index }} ? 'w-8 bg-[#FFC232]' : 'w-2.5 bg-white/55 hover:bg-white/80'"
                                            class="h-2 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/25"
                                            aria-label="Slide {{ $loop->index + 1 }} dari {{ $heroCount }}: {{ $dotHero->title }}">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Mobile layout --}}
                    <div class="lg:hidden relative flex min-h-[780px] sm:min-h-[820px] flex-col overflow-hidden bg-gradient-to-br from-[#188060] via-[#22AF85] to-[#20a37b] text-white">
                        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.16),transparent_40%),radial-gradient(circle_at_bottom_left,rgba(0,0,0,0.08),transparent_45%)]"></div>
                        <div class="pointer-events-none absolute right-[-14%] top-[18%] h-48 w-48 rounded-full bg-black/10 blur-2xl"></div>
                        <div class="pointer-events-none absolute left-[-16%] bottom-[12%] h-52 w-52 rounded-full bg-white/10 blur-3xl"></div>
                        <div class="pointer-events-none absolute left-4 top-24 hidden h-24 w-24 rounded-full bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:12px_12px] opacity-20 sm:block"></div>
                        <div class="pointer-events-none absolute right-4 top-20 hidden h-24 w-24 rounded-full bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:12px_12px] opacity-20 sm:block"></div>

                        <div class="relative z-10 flex flex-1 flex-col px-4 pt-6 sm:px-6 sm:pt-8">
                            <div class="space-y-2.5 sm:space-y-4 max-w-[22rem]">
                                <p class="text-[10px] sm:text-xs font-bold tracking-[0.24em] text-[#FFC232] uppercase">
                                    {{ $heroEyebrow }}
                                </p>
                                <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-[1.1] tracking-tight drop-shadow-sm">
                                    {{ $hero->title }}
                                </h1>
                                <p class="max-w-[22rem] text-sm sm:text-base text-white/90 leading-relaxed font-normal">
                                    {{ $hero->subtitle }}
                                </p>
                            </div>

                            <div class="relative mt-6 flex flex-1 items-center justify-center pb-9 sm:pb-10">
                                {{-- Dynamic Circle Backdrop Mobile --}}
                                <div class="pointer-events-none absolute top-1/2 left-1/2 h-[320px] w-[320px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-white/20 animate-spin-slow"></div>
                                <div class="pointer-events-none absolute top-1/2 left-1/2 h-[260px] w-[260px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-[#FFC232]/30 border-dashed animate-spin-reverse-slow"></div>

                                <div class="absolute left-0 bottom-10 hidden h-28 w-28 rounded-full bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:14px_14px] opacity-20 sm:block"></div>
                                <div class="absolute right-0 top-10 hidden h-28 w-28 rounded-full bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:14px_14px] opacity-20 sm:block"></div>

                                <div class="relative flex items-center justify-center w-full max-w-[440px]">
                                    {{-- Dark rounded backdrop behind shoe mobile --}}
                                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[85%] h-[115%] rounded-[3rem] bg-[#09412c]/40 shadow-[inset_0_10px_40px_rgba(0,0,0,0.2)] backdrop-blur-md border border-white/5 -rotate-3 z-0 transition-transform duration-700 ease-out"></div>

                                    <img src="{{ $hero->image_url }}"
                                         alt="{{ $hero->title }}"
                                         {{ $loop->index === 0 ? 'fetchpriority=high loading=eager' : 'loading=lazy decoding=async' }}
                                         class="relative z-10 w-[92%] object-contain drop-shadow-[0_28px_30px_rgba(0,0,0,0.32)]">
                                         
                                    {{-- Floating Cards Mobile --}}
                                    @if(!$isDonation)
                                        {{-- Card 1 --}}
                                        <div class="absolute top-0 -left-2 sm:left-4 z-20 flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 shadow-lg backdrop-blur-md border border-white/20 animate-float pointer-events-none scale-90 sm:scale-100 origin-top-left">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FFC232] shadow-inner">
                                                <span class="material-symbols-outlined !text-base text-[#1c1c17] fill-1">star</span>
                                            </div>
                                            <div class="flex flex-col text-left">
                                                <span class="text-[11px] font-black text-white drop-shadow-md">4.9/5 Rating</span>
                                                <span class="text-[9px] font-semibold text-white/90 drop-shadow-sm">2.000+ Pelanggan</span>
                                            </div>
                                        </div>
                                        {{-- Card 2 --}}
                                        <div class="absolute bottom-2 -right-2 sm:right-4 z-20 flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 shadow-lg backdrop-blur-md border border-white/20 animate-float-delayed pointer-events-none scale-90 sm:scale-100 origin-bottom-right">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-inner">
                                                <span class="material-symbols-outlined !text-base text-[#22AF85] fill-1">check_circle</span>
                                            </div>
                                            <div class="flex flex-col text-left">
                                                <span class="text-[11px] font-black text-white drop-shadow-md">Status Reparasi</span>
                                                <span class="text-[9px] font-bold text-[#FFC232] drop-shadow-sm">Repaint Selesai</span>
                                            </div>
                                        </div>
                                        {{-- Card 3 --}}
                                        <div class="absolute top-12 -right-2 sm:right-4 z-20 flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 shadow-lg backdrop-blur-md border border-white/20 animate-float pointer-events-none scale-90 sm:scale-100 origin-top-right" style="animation-delay: 1.5s;">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-inner">
                                                <span class="material-symbols-outlined !text-base text-[#FFC232] fill-1">verified_user</span>
                                            </div>
                                            <div class="flex flex-col text-left">
                                                <span class="text-[11px] font-black text-white drop-shadow-md">Respons Cepat</span>
                                                <span class="text-[9px] font-bold text-white/90 drop-shadow-sm">& konsultasi gratis</span>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Card 1 --}}
                                        <div class="absolute top-0 -left-2 sm:left-4 z-20 flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 shadow-lg backdrop-blur-md border border-white/20 animate-float pointer-events-none scale-90 sm:scale-100 origin-top-left">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FFC232] shadow-inner">
                                                <span class="material-symbols-outlined !text-base text-[#1c1c17] fill-1">inventory_2</span>
                                            </div>
                                            <div class="flex flex-col text-left">
                                                <span class="text-[11px] font-black text-white drop-shadow-md">1.542+ Sepatu</span>
                                                <span class="text-[9px] font-semibold text-white/90 drop-shadow-sm">Telah Disalurkan</span>
                                            </div>
                                        </div>
                                        {{-- Card 2 --}}
                                        <div class="absolute bottom-2 -right-2 sm:right-4 z-20 flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 shadow-lg backdrop-blur-md border border-white/20 animate-float-delayed pointer-events-none scale-90 sm:scale-100 origin-bottom-right">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-inner">
                                                <span class="material-symbols-outlined !text-base text-[#22AF85] fill-1">local_shipping</span>
                                            </div>
                                            <div class="flex flex-col text-left">
                                                <span class="text-[11px] font-black text-white drop-shadow-md">Menuju Panti</span>
                                                <span class="text-[9px] font-bold text-[#FFC232] drop-shadow-sm">Asuhan Bandung</span>
                                            </div>
                                        </div>
                                        {{-- Card 3 --}}
                                        <div class="absolute top-12 -right-2 sm:right-4 z-20 flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 shadow-lg backdrop-blur-md border border-white/20 animate-float pointer-events-none scale-90 sm:scale-100 origin-top-right" style="animation-delay: 1.5s;">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white shadow-inner">
                                                <span class="material-symbols-outlined !text-base text-[#FFC232] fill-1">handshake</span>
                                            </div>
                                            <div class="flex flex-col text-left">
                                                <span class="text-[11px] font-black text-white drop-shadow-md">100% Disalurkan</span>
                                                <span class="text-[9px] font-bold text-white/90 drop-shadow-sm">kepada yang berhak</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="relative z-10 flex flex-col px-4 pb-6 pt-2 sm:px-6 sm:pb-8">
                            
                            {{-- Mobile Carousel Dots --}}
                            @if($heroCount > 1)
                                <div class="flex justify-center mb-5">
                                    <div class="inline-flex items-center justify-center gap-2.5 rounded-full bg-black/10 px-4 py-2 backdrop-blur-sm pointer-events-auto">
                                        @foreach($heroes as $dotIndex => $dotHero)
                                            <button
                                                @click="goTo({{ $loop->index }})"
                                                :class="active === {{ $loop->index }} ? 'w-8 bg-[#FFC232]' : 'w-2.5 bg-white/55 hover:bg-white/80'"
                                                class="h-2 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/25"
                                                aria-label="Slide {{ $loop->index + 1 }} dari {{ $heroCount }}: {{ $dotHero->title }}">
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Mobile Buttons --}}
                            <div class="w-full space-y-3">
                                <a href="{{ $hero->primary_cta_link }}"
                                   class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#FFC232] px-4 py-3.5 text-sm font-bold text-[#1c1c17] shadow-[0_16px_30px_rgba(0,0,0,0.12)] transition-all active:scale-[0.98]">
                                    <span class="material-symbols-outlined !text-[20px]">{{ $isDonation ? 'volunteer_activism' : 'chat' }}</span>
                                    {{ $hero->primary_cta_text }}
                                </a>

                                @if($hero->secondary_cta_text && $hero->secondary_cta_link)
                                    <a href="{{ $hero->secondary_cta_link }}"
                                       class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-white/35 bg-white/5 px-4 py-3.5 text-sm font-bold text-white backdrop-blur-sm transition-all active:scale-[0.98]">
                                        {{ $hero->secondary_cta_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>                </section>
            @endforeach

            {{-- Desktop Navigation Arrows (Visible on Hover) --}}
            @if($heroCount > 1)
                <button @click="prev()"
                    class="hidden lg:flex absolute left-4 xl:left-6 top-1/2 -translate-y-1/2 z-30 h-14 w-14 items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-white backdrop-blur-md opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-[0_8px_30px_rgb(0,0,0,0.12)] focus:outline-none focus:ring-2 focus:ring-white/50 -translate-x-4 group-hover:translate-x-0"
                    aria-label="Previous slide">
                    <span class="material-symbols-outlined !text-4xl ml-[-2px]">chevron_left</span>
                </button>
                <button @click="next()"
                    class="hidden lg:flex absolute right-4 xl:right-6 top-1/2 -translate-y-1/2 z-30 h-14 w-14 items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-white backdrop-blur-md opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-[0_8px_30px_rgb(0,0,0,0.12)] focus:outline-none focus:ring-2 focus:ring-white/50 translate-x-4 group-hover:translate-x-0"
                    aria-label="Next slide">
                    <span class="material-symbols-outlined !text-4xl mr-[-2px]">chevron_right</span>
                </button>
            @endif
        </div>
    </section>
@endif