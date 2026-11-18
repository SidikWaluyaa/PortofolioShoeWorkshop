{{-- Adapt & Adopt campaign block on the home page (program palette, see adopt-adapt brand guideline).
     Beige, not Deep Green: the next home section ("Tentang Kami") is green, two green blocks in a row look heavy. --}}
@push('head')
    @include('layouts.partials.aa-fonts')
@endpush
<section id="donasi-showcase" class="relative overflow-hidden bg-aa-beige text-aa-ink py-14 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 relative z-10">
        <div class="grid lg:grid-cols-[auto_1fr] gap-8 lg:gap-14 items-center mb-12">
            <img src="{{ asset('images/adapt-adopt/adaptadopt-original.webp') }}" alt="Adapt & Adopt by ShoeWorkshop" width="1632" height="995" loading="lazy" class="w-40 sm:w-64 lg:w-80">
            <div>
                <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-burgundy">Program donasi &amp; adopsi sepatu</p>
                <h2 class="mt-3 font-aa text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight text-aa-green">Adapt the Mindset. Give a Second Chance.</h2>
                <p class="mt-4 text-aa-ink/80 text-base sm:text-lg leading-relaxed max-w-2xl">
                    Sepatu yang sudah nggak kamu pakai masih bisa punya cerita berikutnya. Donasikan untuk kami kurasi dan perbaiki, atau adopsi sepatu hasil restorasi dengan membayar biaya jasa reparasinya saja.
                </p>
                <div class="mt-7 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('adapt-adopt.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-aa-burgundy hover:bg-aa-burgundy-dark text-aa-beige font-bold text-sm transition">
                        Kenali Adapt &amp; Adopt <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                    </a>
                    <a href="{{ route('katalog.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-aa-green hover:bg-aa-white text-aa-green font-bold text-sm transition">
                        Lihat Katalog Adopsi
                    </a>
                    <a href="{{ route('adapt-adopt.donasi.create') }}" class="inline-flex items-center justify-center gap-2 px-2 py-3.5 text-aa-green hover:text-aa-burgundy font-bold text-sm underline underline-offset-4 transition">
                        Donasikan sepatumu
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
                <div id="aa-showcase-track" class="flex overflow-x-auto gap-4 sm:gap-6 pb-4 hide-scrollbar text-aa-ink">
                    @foreach($donationShowcase as $item)
                        <div class="w-[260px] sm:w-[300px] shrink-0 h-auto">
                            @include('katalog.partials.item-card', ['item' => $item])
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Slow auto-scroll. It moves the real scroll position, so visitors can still swipe or drag the row. --}}
            <script>
                (function () {
                    const track = document.getElementById('aa-showcase-track');
                    if (!track || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

                    const SPEED = 28; // pixels per second
                    const originals = [...track.children];
                    const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
                    const setWidth = () => originals.reduce((sum, card) => sum + card.offsetWidth + gap, 0);

                    // Too few shoes to fill the row: leave it still
                    if (setWidth() < track.clientWidth) return;

                    // A second copy makes the loop seamless; it is hidden from keyboard and screen readers
                    originals.forEach((card) => {
                        const copy = card.cloneNode(true);
                        copy.setAttribute('aria-hidden', 'true');
                        copy.querySelectorAll('a').forEach((link) => link.setAttribute('tabindex', '-1'));
                        track.appendChild(copy);
                    });

                    let position = track.scrollLeft, last = null, visible = false, held = false, resumeTimer;
                    const hold = () => { clearTimeout(resumeTimer); held = true; };
                    const release = (delay = 0) => {
                        clearTimeout(resumeTimer);
                        resumeTimer = setTimeout(() => { position = track.scrollLeft; held = false; }, delay);
                    };

                    track.addEventListener('mouseenter', hold);
                    track.addEventListener('mouseleave', () => release());
                    track.addEventListener('focusin', hold);
                    track.addEventListener('focusout', () => release());
                    track.addEventListener('touchstart', hold, { passive: true });
                    track.addEventListener('touchend', () => release(2500), { passive: true });
                    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; }).observe(track);

                    requestAnimationFrame(function step(now) {
                        // Capped so returning from another tab does not make the row jump
                        const elapsed = last === null ? 0 : Math.min(now - last, 100);
                        last = now;
                        if (visible && !held && !document.hidden) {
                            position += SPEED * elapsed / 1000;
                            const width = setWidth();
                            if (position >= width) position -= width;
                            track.scrollLeft = position;
                        }
                        requestAnimationFrame(step);
                    });
                })();
            </script>
        @endif
    </div>
</section>
