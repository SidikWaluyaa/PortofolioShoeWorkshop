{{-- Adapt & Adopt campaign block on the home page (program palette, see adopt-adapt brand guideline) --}}
@push('head')
    @include('layouts.partials.aa-fonts')
@endpush
<section id="donasi-showcase" class="relative overflow-hidden bg-aa-green text-aa-beige py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 relative z-10">
        <div class="grid lg:grid-cols-[auto_1fr] gap-8 lg:gap-14 items-center mb-12">
            <img src="{{ asset('images/adapt-adopt/adaptadopt_dark_beige_on_green.png') }}" alt="Adapt & Adopt by ShoeWorkshop" width="820" height="500" loading="lazy" class="w-48 sm:w-64 lg:w-80">
            <div>
                <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-sage">Program donasi &amp; adopsi sepatu</p>
                <h2 class="mt-3 font-aa text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight">Adapt the Mindset. Give a Second Chance.</h2>
                <p class="mt-4 text-aa-beige/85 text-base sm:text-lg leading-relaxed max-w-2xl">
                    Sepatu yang sudah nggak kamu pakai masih bisa punya cerita berikutnya. Donasikan untuk kami kurasi dan perbaiki, atau adopsi sepatu hasil restorasi dengan membayar biaya jasa reparasinya saja.
                </p>
                <div class="mt-7 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('adapt-adopt.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-aa-burgundy hover:bg-aa-burgundy-dark text-aa-beige font-bold text-sm transition">
                        Kenali Adapt &amp; Adopt <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                    </a>
                    <a href="{{ route('katalog.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-aa-beige/40 hover:bg-aa-beige/10 text-aa-beige font-bold text-sm transition">
                        Lihat Katalog Adopsi
                    </a>
                </div>
            </div>
        </div>

        @if(collect($donationShowcase)->isNotEmpty())
            <div class="relative z-20">
                <style>
                    .hide-scrollbar::-webkit-scrollbar { display: none; }
                    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
                </style>
                <div class="flex overflow-x-auto gap-4 sm:gap-6 pb-4 snap-x snap-mandatory hide-scrollbar text-aa-ink">
                    @foreach($donationShowcase as $item)
                        <div class="w-[260px] sm:w-[300px] shrink-0 snap-center sm:snap-start h-auto">
                            @include('katalog.partials.item-card', ['item' => $item])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
