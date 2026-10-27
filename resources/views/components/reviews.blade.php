{{-- Testimonials as till receipts hanging from an order rail that drifts slowly sideways --}}
@php
    $reviews = collect($reviews)->values();
    // Repeat the set so one half of the track is always wider than the screen, then double it for a seamless loop
    $repeat = $reviews->isEmpty() ? 0 : (int) ceil(6 / $reviews->count());
    $half = collect(range(1, max($repeat, 1)))->flatMap(fn () => $reviews);
@endphp
@if($reviews->isNotEmpty())
<style>
    .nota-rail { --nota-speed: {{ $half->count() * 9 }}s; }
    .nota-track { animation: nota-drift var(--nota-speed) linear infinite; }
    .nota-rail:hover .nota-track,
    .nota-rail.is-paused .nota-track { animation-play-state: paused; }
    @keyframes nota-drift { to { transform: translateX(-50%); } }

    .nota {
        background: #fafaf7;
        color: #2b2b2e;
        transform-origin: 50% 0;
        transition: transform .3s ease;
        /* torn, zig-zag bottom edge */
        -webkit-mask: conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) 50% / 12px 100%;
                mask: conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) 50% / 12px 100%;
    }
    .nota-wrap { filter: drop-shadow(0 6px 10px rgba(0, 0, 0, .18)); }
    .nota-wrap:nth-child(3n+1) .nota { transform: rotate(-1.2deg); }
    .nota-wrap:nth-child(3n+2) .nota { transform: rotate(.8deg); }
    .nota-wrap:nth-child(3n) .nota { transform: rotate(-.3deg); }
    .nota-wrap:hover .nota { transform: rotate(0); }
    .nota-rule { border-top: 1px dashed currentColor; opacity: .35; }
    .nota-barcode {
        height: 28px;
        background: repeating-linear-gradient(90deg, #2b2b2e 0 2px, transparent 2px 3px, #2b2b2e 3px 4px, transparent 4px 7px, #2b2b2e 7px 10px, transparent 10px 11px);
    }

    @media (prefers-reduced-motion: reduce) {
        .nota-track { animation: none; }
        .nota-rail { overflow-x: auto; }
    }
</style>

<div x-data="{ paused: false }"
     class="nota-rail relative overflow-hidden -mx-4 sm:-mx-6 lg:-mx-16"
     :class="paused && 'is-paused'"
     @touchstart.passive="paused = true"
     @touchend="paused = false"
     @touchcancel="paused = false">

    {{-- The rail the receipts are clipped to --}}
    <div class="absolute top-0 inset-x-0 h-3 bg-[#0f5a43] border-b border-white/10 z-10" aria-hidden="true"></div>

    <div class="nota-track flex items-start gap-5 sm:gap-7 w-max pt-1.5 pb-6 px-4">
        @foreach([false, true] as $isCopy)
            @foreach($half as $review)
                <div class="nota-wrap shrink-0 w-[248px] sm:w-[272px]" @if($isCopy || $loop->index >= $reviews->count()) aria-hidden="true" @endif>
                    <article class="nota font-mono text-[12px] leading-[1.55] px-5 pt-5 pb-7">
                        <header class="text-center">
                            <p class="text-[13px] font-bold tracking-[0.15em]">SHOE WORKSHOP</p>
                            <p class="opacity-70">Jl. Kembar I No.41 Bandung</p>
                        </header>

                        <div class="nota-rule my-3"></div>

                        <dl class="grid grid-cols-[auto_1fr] gap-x-3 uppercase">
                            @if($review->reviewed_at)
                                <dt class="opacity-60">Tgl</dt>
                                <dd class="text-right">{{ $review->reviewed_at->translatedFormat('M Y') }}</dd>
                            @endif
                            <dt class="opacity-60">Pelanggan</dt>
                            <dd class="text-right truncate">{{ $review->short_name }}</dd>
                            @if($review->location)
                                <dt class="opacity-60">Kota</dt>
                                <dd class="text-right truncate">{{ $review->location }}</dd>
                            @endif
                            @if($review->service)
                                <dt class="opacity-60">Layanan</dt>
                                <dd class="text-right truncate">{{ $review->service }}</dd>
                            @endif
                        </dl>

                        <div class="nota-rule my-3"></div>

                        <p class="text-[13px] leading-relaxed break-words">{{ $review->content }}</p>

                        <div class="nota-rule my-3"></div>

                        <div class="flex items-center justify-between uppercase">
                            <span class="opacity-60">Rating</span>
                            <span class="text-[15px] leading-none tracking-[0.1em]" aria-label="{{ $review->rating }} dari 5 bintang">
                                <span class="text-[#d99a00]">{{ str_repeat('★', $review->rating) }}</span><span class="opacity-25">{{ str_repeat('★', 5 - $review->rating) }}</span>
                            </span>
                        </div>

                        <p class="mt-4 text-center font-bold tracking-[0.2em]">TERIMA KASIH</p>
                        @if($review->source === 'google')
                            <p class="text-center opacity-60">dari ulasan Google Maps</p>
                        @endif
                        <div class="nota-barcode mt-3 mx-auto w-40" aria-hidden="true"></div>
                    </article>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
@else
<div class="text-center py-16 text-white/70 text-sm">Belum ada testimoni.</div>
@endif
