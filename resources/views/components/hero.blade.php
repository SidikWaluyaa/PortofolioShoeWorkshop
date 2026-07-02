@if($heroes && $heroes->isNotEmpty())

    {{-- ═══════════════════════════════════════════════════════════════
         1. DESKTOP VERSION (Stacked layout, non-slider)
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="hidden lg:block">
        @foreach($heroes as $index => $hero)
            @php
                $isDonation = Str::contains($hero->primary_cta_link, 'donations') || Str::contains($hero->title, 'Donasi');
                $isEven = ($index % 2 === 0);
            @endphp
            <section class="min-h-[500px] lg:min-h-[700px] flex flex-col {{ $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse' }} overflow-hidden border-b border-gray-200 bg-white/40 backdrop-blur-md relative z-10">
                {{-- Text Content Section --}}
                <div class="w-full lg:w-1/2 bg-transparent flex items-center justify-center px-5 sm:px-10 lg:px-16 py-16 sm:py-20 lg:py-0">
                    <div class="max-w-[540px] space-y-5 sm:space-y-8 w-full">
                        <div class="space-y-2.5">
                            <p class="text-xs sm:text-sm font-bold tracking-[0.2em] text-gray-400 uppercase">
                                {{ $isDonation ? 'Program Sosial Shoe Workshop' : 'Reparasi & Perawatan Sepatu' }}
                            </p>
                            <h1 class="text-3xl sm:text-5xl lg:text-[56px] font-extrabold text-[#1c1c17] leading-[1.15] sm:leading-[1.1] tracking-tight">
                                {{ $hero->title }}
                            </h1>
                        </div>
                        <p class="text-sm sm:text-lg text-gray-500 leading-relaxed font-normal">
                            {{ $hero->subtitle }}
                        </p>
                        
                        <!-- CTA Buttons Container -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3.5 pt-2">
                            <a href="{{ $hero->primary_cta_link }}"
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#FFC232] text-[#1c1c17] font-bold text-base rounded-xl shadow-md shadow-[#FFC232]/10 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all text-center">
                                <span class="material-symbols-outlined !text-[20px]">{{ $isDonation ? 'volunteer_activism' : 'chat' }}</span>
                                {{ $hero->primary_cta_text }}
                            </a>
                            
                            @if($hero->secondary_cta_text && $hero->secondary_cta_link)
                                <a href="{{ $hero->secondary_cta_link }}"
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 border border-gray-300 text-gray-700 font-bold text-sm rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all text-center">
                                    {{ $hero->secondary_cta_text }}
                                </a>
                            @endif

                            <div class="w-full sm:w-auto flex items-center justify-center sm:justify-start gap-3 py-2.5 px-4 border border-gray-150 rounded-xl bg-gray-50/50 shadow-sm">
                                @if($isDonation)
                                    <span class="material-symbols-outlined text-[#22AF85] fill-1 !text-[20px]">handshake</span>
                                    <div class="flex flex-col text-left">
                                        <span class="text-xs font-bold text-[#1c1c17] leading-none">100% Disalurkan</span>
                                        <span class="text-[10px] text-gray-400 mt-0.5">kepada yang berhak</span>
                                    </div>
                                @else
                                    <span class="material-symbols-outlined text-[#22AF85] fill-1 !text-[20px]">verified_user</span>
                                    <div class="flex flex-col text-left">
                                        <span class="text-xs font-bold text-[#1c1c17] leading-none">Respons Cepat</span>
                                        <span class="text-[10px] text-gray-400 mt-0.5">& konsultasi gratis</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Image Content Section --}}
                <div class="w-full lg:w-1/2 bg-[#22AF85] relative flex items-center justify-center p-8 lg:p-0 min-h-[300px] sm:min-h-[400px] lg:min-h-0">
                    <div class="relative w-full h-full flex items-center justify-center hover:scale-105 transition-transform duration-700 ease-out p-6">
                        <img src="{{ $hero->image_url }}"
                             alt="{{ $hero->title }}"
                             {{ $index === 0 ? 'fetchpriority=high loading=eager' : 'loading=lazy decoding=async' }}
                             class="max-w-[80%] max-h-[70%] sm:max-h-[80%] object-contain drop-shadow-[0_25px_25px_rgba(0,0,0,0.35)]">
                    </div>
                    {{-- Brand Badge --}}
                    <div class="absolute bottom-6 right-6 sm:bottom-12 sm:right-12 bg-[#1c1c17] text-white px-5 sm:px-8 py-3 sm:py-4 rounded-2xl flex flex-col items-center group shadow-md">
                        <span class="text-[10px] sm:text-sm font-semibold tracking-[0.2em] opacity-80">SHOE</span>
                        <span class="text-sm sm:text-2xl font-bold text-[#FFC232] group-hover:text-white transition-colors uppercase">Workshop</span>
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         2. MOBILE VERSION (Slider / Carousel)
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="block lg:hidden relative bg-white border-b border-gray-200 overflow-hidden" 
         x-data="{ 
            active: 0, 
            total: {{ $heroes->count() }},
            init() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.total;
                }, 6000);
            }
         }">
         
         {{-- Slider Wrapper --}}
         <div class="relative w-full min-h-[510px] sm:min-h-[600px]">
            @foreach($heroes as $index => $hero)
                @php
                    $isDonation = Str::contains($hero->primary_cta_link, 'donations') || Str::contains($hero->title, 'Donasi');
                @endphp
                <div x-show="active === {{ $index }}"
                     x-transition:enter="transition ease-out duration-500 transform"
                     x-transition:enter-start="opacity-0 translate-x-full"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-500 transform absolute inset-0"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-full"
                     class="w-full min-h-[510px] sm:min-h-[600px] flex flex-col justify-between">
                     
                     {{-- Text Content --}}
                     <div class="px-5 sm:px-10 pt-10 pb-6 flex-grow flex items-center">
                         <div class="space-y-5 sm:space-y-7 w-full">
                             <div class="space-y-2">
                                 <p class="text-[10px] sm:text-xs font-bold tracking-[0.2em] text-[#22AF85] uppercase">
                                     {{ $isDonation ? 'Program Sosial Shoe Workshop' : 'Reparasi & Perawatan Sepatu' }}
                                 </p>
                                 <h1 class="text-2xl sm:text-4xl font-extrabold text-[#1c1c17] leading-tight tracking-tight">
                                     {{ $hero->title }}
                                 </h1>
                             </div>
                             <p class="text-xs sm:text-base text-gray-500 leading-relaxed font-normal">
                                 {{ $hero->subtitle }}
                             </p>
                             
                             <div class="flex flex-col gap-3 pt-1">
                                 {{-- CTA Buttons Grid (Side-by-Side if secondary exists) --}}
                                 <div class="grid @if($hero->secondary_cta_text && $hero->secondary_cta_link) grid-cols-2 @else grid-cols-1 @endif gap-2.5">
                                     <a href="{{ $hero->primary_cta_link }}"
                                        class="inline-flex items-center justify-center gap-1.5 px-3 py-3 bg-[#FFC232] text-[#1c1c17] font-extrabold text-[11px] sm:text-xs rounded-xl shadow-sm active:scale-[0.98] transition-all text-center">
                                         <span class="material-symbols-outlined !text-[16px]">{{ $isDonation ? 'volunteer_activism' : 'chat' }}</span>
                                         {{ $hero->primary_cta_text }}
                                     </a>
                                     
                                     @if($hero->secondary_cta_text && $hero->secondary_cta_link)
                                         <a href="{{ $hero->secondary_cta_link }}"
                                            class="inline-flex items-center justify-center gap-1.5 px-3 py-3 border border-gray-300 text-gray-700 font-extrabold text-[11px] sm:text-xs rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all text-center">
                                             {{ $hero->secondary_cta_text }}
                                         </a>
                                     @endif
                                 </div>

                                 {{-- Simplified Inline Badge --}}
                                 <div class="flex items-center justify-center gap-1.5 pt-1 text-[11px] font-bold text-[#22AF85]">
                                     <span class="material-symbols-outlined !text-[15px] fill-1">check_circle</span>
                                     @if($isDonation)
                                         <span>100% Disalurkan kepada yang berhak</span>
                                     @else
                                         <span>Respons Cepat & Konsultasi Gratis</span>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div>
                     
                     {{-- Image Content (Fixed base height) --}}
                     <div class="bg-[#22AF85] relative flex items-center justify-center p-6 h-[200px] sm:h-[260px] shrink-0">
                         <img src="{{ $hero->image_url }}"
                              alt="{{ $hero->title }}"
                              {{ $index === 0 ? 'fetchpriority=high loading=eager' : 'loading=lazy decoding=async' }}
                              class="max-h-[85%] object-contain drop-shadow-[0_15px_15px_rgba(0,0,0,0.3)]">
                         <div class="absolute bottom-4 right-4 bg-[#1c1c17] text-white px-4 py-2 rounded-xl flex flex-col items-center">
                             <span class="text-[8px] font-semibold tracking-[0.2em] opacity-80">SHOE</span>
                             <span class="text-xs font-bold text-[#FFC232] uppercase">Workshop</span>
                         </div>
                     </div>
                </div>
            @endforeach
         </div>

         {{-- Dot indicators --}}
         @if($heroes->count() > 1)
             <div class="absolute top-4 left-1/2 -translate-x-1/2 flex items-center gap-2.5 z-20 bg-white/80 backdrop-blur-sm px-3.5 py-1.5 rounded-full border border-gray-150">
                 @foreach($heroes as $index => $hero)
                     <button @click="active = {{ $index }}" 
                             :class="active === {{ $index }} ? 'w-5 bg-[#22AF85]' : 'w-2 bg-gray-300'"
                             class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                             aria-label="Slide {{ $index + 1 }} dari {{ $heroes->count() }}: {{ $hero->title }}"></button>
                 @endforeach
             </div>
         @endif
    </div>

@endif