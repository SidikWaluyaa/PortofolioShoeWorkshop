@if($heroes && $heroes->isNotEmpty())
    @foreach($heroes as $index => $hero)
        @php
            $isDonation = Str::contains($hero->primary_cta_link, 'donations') || Str::contains($hero->title, 'Donasi');
            // Even index (0, 2...) gets regular left text, right image layout
            // Odd index (1, 3...) gets reversed layout (left image, right text)
            $isEven = ($index % 2 === 0);
        @endphp
        <section class="min-h-[500px] lg:min-h-[700px] flex flex-col {{ $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse' }} overflow-hidden border-b border-gray-200 bg-white">
            {{-- Text Content Section --}}
            <div class="w-full lg:w-1/2 bg-white flex items-center justify-center px-5 sm:px-10 lg:px-16 py-16 sm:py-20 lg:py-0">
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
@endif