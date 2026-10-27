{{-- Portfolio as a stack of workshop job tickets (SPK): each card tells the complaint, the actions and the QC result --}}
@php $cards = $portfolio->values(); @endphp
@if($cards->isNotEmpty())
<style>
    /* Perforation notches on both sides of the ticket header, cut out with a mask so the page background shows through */
    .spk-paper {
        --notch: 56px;
        background-color: #fbf7ee;
        background-image: repeating-linear-gradient(0deg, transparent 0 27px, rgba(28, 28, 23, .045) 27px 28px);
        -webkit-mask: radial-gradient(circle 11px at 0 var(--notch), transparent 98%, #000) left / 51% 100% no-repeat,
                      radial-gradient(circle 11px at 100% var(--notch), transparent 98%, #000) right / 51% 100% no-repeat;
                mask: radial-gradient(circle 11px at 0 var(--notch), transparent 98%, #000) left / 51% 100% no-repeat,
                      radial-gradient(circle 11px at 100% var(--notch), transparent 98%, #000) right / 51% 100% no-repeat;
    }
    .spk-card { transition: transform .55s cubic-bezier(.2, .8, .2, 1), opacity .45s ease; filter: drop-shadow(0 18px 30px rgba(28, 28, 23, .14)); }
    .spk-stamp { transform: rotate(-12deg); opacity: 0; }
    .spk-stamp.is-in { animation: spk-stamp .45s cubic-bezier(.2, .9, .3, 1.4) .35s both; }
    @keyframes spk-stamp {
        from { opacity: 0; transform: rotate(-22deg) scale(1.9); }
        to   { opacity: .9; transform: rotate(-12deg) scale(1); }
    }
    /* Mobile hint: the top card wiggles once to show it can be swiped */
    .spk-nudge { animation: spk-nudge 1.1s ease-in-out; }
    @keyframes spk-nudge {
        0%, 100% { transform: none; }
        30% { transform: translateX(-38px) rotate(-2deg); }
        60% { transform: translateX(8px) rotate(.5deg); }
    }
    .spk-swipe-icon { animation: spk-swipe 1.4s ease-in-out infinite; }
    @keyframes spk-swipe {
        0%, 100% { transform: translateX(3px); }
        50% { transform: translateX(-3px); }
    }
    /* Cards further down the pile show as blank paper */
    .spk-paper > * { transition: opacity .35s ease; }
    .spk-back > * { opacity: 0; }
    @media (prefers-reduced-motion: reduce) {
        .spk-card { transition: none; }
        .spk-stamp.is-in { animation: none; opacity: .9; }
        .spk-nudge, .spk-swipe-icon { animation: none; }
    }
</style>

<div x-data="spkStack({{ $cards->count() }})" x-init="watchNudge()"
     @keydown.arrow-right="next()" @keydown.arrow-left="prev()"
     class="max-w-5xl mx-auto">

    {{-- The stack: every card sits in the same grid cell so the tallest one sets the height --}}
    <div class="grid pb-12" style="touch-action: pan-y"
         @touchstart.passive="touchStart($event)"
         @touchmove.passive="touchMove($event)"
         @touchend="touchEnd()"
         @touchcancel="touchEnd()">
        @foreach($cards as $i => $project)
            @php
                $tindakan = $project->tindakan_list;
                if (empty($tindakan) && $project->category) {
                    $tindakan = [$project->category];
                }
                $layanan = $project->category ?? ($project->service->name ?? 'Restorasi');
            @endphp
            <article class="spk-card [grid-area:1/1] will-change-transform"
                     :style="cardStyle({{ $i }})"
                     :aria-hidden="(active !== {{ $i }}).toString()"
                     x-effect="$el.inert = active !== {{ $i }}">
                <div class="spk-paper rounded-md border border-[#e6dcc4]" :class="{ 'spk-back': active !== {{ $i }}, 'spk-nudge': nudging && active === {{ $i }} }">

                    {{-- Header --}}
                    <header class="h-14 px-5 sm:px-8 flex items-center justify-between gap-4 border-b-2 border-dashed border-[#d8ccb0]">
                        <div class="min-w-0 font-mono text-[11px] sm:text-xs tracking-wider text-[#6b6450] uppercase truncate">
                            <span class="font-bold text-[#1c1c17]">Surat Perintah Kerja</span>
                            <span class="hidden sm:inline">·</span>
                            <span class="hidden sm:inline">{{ $project->spk_number ? 'No. ' . $project->spk_number : 'Arsip #' . str_pad($project->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="shrink-0 flex items-center gap-1 -mr-2 sm:mr-0">
                            <button type="button" @click="prev()" aria-label="Kartu sebelumnya"
                                    class="sm:hidden w-9 h-9 rounded-full flex items-center justify-center text-[#1c1c17] active:bg-[#1c1c17]/10">
                                <span class="material-symbols-outlined !text-[22px]">chevron_left</span>
                            </button>
                            <span class="font-mono text-[11px] sm:text-xs font-bold tracking-wider text-[#1c1c17] tabular-nums">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}/{{ str_pad($cards->count(), 2, '0', STR_PAD_LEFT) }}</span>
                            <button type="button" @click="next()" aria-label="Kartu berikutnya"
                                    class="sm:hidden w-9 h-9 rounded-full flex items-center justify-center text-[#1c1c17] active:bg-[#1c1c17]/10">
                                <span class="material-symbols-outlined !text-[22px]">chevron_right</span>
                            </button>
                        </div>
                    </header>

                    <div class="grid md:grid-cols-[1.05fr_1fr] gap-8 md:gap-10 px-5 sm:px-8 pt-7 pb-6">

                        {{-- Polaroids: before & after pinned to the ticket --}}
                        <div class="relative grid grid-cols-2 gap-3 sm:gap-5 items-start self-center">
                            @foreach([['Sebelum', $project->before_image_url, '-rotate-3', 'text-[#6b6450]'], ['Sesudah', $project->after_image_url, 'rotate-2 translate-y-3', 'text-[#188060]']] as [$label, $src, $tilt, $tone])
                                <button type="button"
                                        @click="zoom('{{ $src }}', '{{ $label }}')"
                                        class="group relative bg-white p-2 pb-9 sm:p-2.5 sm:pb-10 shadow-[0_8px_18px_rgba(28,28,23,.18)] {{ $tilt }} hover:rotate-0 hover:-translate-y-1 transition-transform duration-300 text-left">
                                    <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 w-14 h-5 bg-[#f3e6b3]/80 rotate-[-4deg] shadow-sm" aria-hidden="true"></span>
                                    <span class="block aspect-square overflow-hidden bg-gray-100">
                                        <img src="{{ $src }}" alt="{{ $project->title }} - {{ strtolower($label) }}"
                                             loading="{{ $i === 0 ? 'eager' : 'lazy' }}" draggable="false"
                                             class="w-full h-full object-cover select-none">
                                    </span>
                                    <span class="absolute bottom-2.5 sm:bottom-3 left-2.5 right-2.5 flex items-center justify-between font-mono text-[10px] sm:text-[11px] font-bold uppercase tracking-widest {{ $tone }}">
                                        {{ $label }}
                                        <span class="material-symbols-outlined !text-[16px] opacity-0 group-hover:opacity-60 transition-opacity">zoom_in</span>
                                    </span>
                                </button>
                            @endforeach

                            {{-- Mobile: QC stamp pressed onto the "after" photo --}}
                            <div class="spk-stamp md:hidden pointer-events-none absolute bottom-10 -right-1 border-[3px] border-[#188060] rounded-md px-2.5 py-1 text-center text-[#188060] bg-[#fbf7ee]/70"
                                 :class="active === {{ $i }} && 'is-in'" aria-hidden="true">
                                <p class="text-sm font-black leading-none tracking-wider">LOLOS QC</p>
                                <p class="font-mono text-[8px] font-bold tracking-[0.2em] mt-0.5">3 TAHAP ✓</p>
                            </div>

                            {{-- Mobile: swipe hint until the visitor first interacts --}}
                            <span x-show="!touched" x-transition.opacity.duration.300ms
                                  class="sm:hidden pointer-events-none absolute left-1/2 -translate-x-1/2 -bottom-[34px] z-10 inline-flex items-center gap-1.5 whitespace-nowrap px-3 py-1.5 rounded-full bg-[#1c1c17]/85 text-white text-[11px] font-bold shadow-lg">
                                <span class="material-symbols-outlined !text-[16px] spk-swipe-icon">swipe</span>
                                Geser untuk kartu lain
                            </span>
                        </div>

                        {{-- Job details --}}
                        <div class="relative min-w-0 md:pb-16">
                            <p class="font-mono text-[10px] tracking-[0.2em] uppercase text-[#8a8169]">Layanan</p>
                            <p class="text-sm font-bold text-[#188060] mb-2">{{ $layanan }}</p>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-[#1c1c17] leading-snug mb-5">{{ $project->title }}</h3>

                            <dl class="space-y-4">
                                @if($project->keluhan)
                                    <div>
                                        <dt class="font-mono text-[10px] tracking-[0.2em] uppercase text-[#8a8169] mb-1">Keluhan</dt>
                                        <dd class="text-[15px] text-[#1c1c17] leading-relaxed">{{ $project->keluhan }}</dd>
                                    </div>
                                @endif

                                @if(!empty($tindakan))
                                    <div>
                                        <dt class="font-mono text-[10px] tracking-[0.2em] uppercase text-[#8a8169] mb-1.5">Tindakan</dt>
                                        <dd>
                                            <ul class="space-y-1.5">
                                                @foreach($tindakan as $action)
                                                    <li class="flex items-start gap-2.5 text-[15px] text-[#1c1c17]">
                                                        <span class="mt-0.5 w-[18px] h-[18px] shrink-0 rounded-[3px] border-2 border-[#188060] flex items-center justify-center">
                                                            <svg class="w-3 h-3 text-[#188060]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>
                                                        </span>
                                                        {{ $action }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </div>
                                @endif

                                @if($project->description)
                                    <div>
                                        <dt class="font-mono text-[10px] tracking-[0.2em] uppercase text-[#8a8169] mb-1">Catatan Teknisi</dt>
                                        <dd class="text-sm text-[#4a4535] leading-relaxed italic">"{{ $project->description }}"</dd>
                                    </div>
                                @endif
                            </dl>

                            {{-- QC stamp --}}
                            <div class="spk-stamp hidden md:block pointer-events-none absolute bottom-0 right-3 border-[3px] border-[#188060] rounded-md px-3 py-1.5 text-center text-[#188060] mix-blend-multiply"
                                 :class="active === {{ $i }} && 'is-in'" aria-hidden="true">
                                <p class="text-base sm:text-lg font-black leading-none tracking-wider">LOLOS QC</p>
                                <p class="font-mono text-[9px] font-bold tracking-[0.2em] mt-1">3 TAHAP ✓</p>
                            </div>
                        </div>
                    </div>

                    {{-- Footer: QC trail & duration --}}
                    <footer class="px-5 sm:px-8 py-4 border-t-2 border-dashed border-[#d8ccb0] flex flex-wrap items-center gap-x-5 gap-y-2 font-mono text-[10px] sm:text-[11px] uppercase tracking-wider text-[#6b6450]">
                        @foreach(['QC Awal', 'QC Hasil', 'QC Akhir'] as $qc)
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#22AF85]"></span>{{ $qc }}
                            </span>
                        @endforeach
                        @if($project->durasi_hari)
                            <span class="sm:ml-auto font-bold text-[#1c1c17]">Selesai dalam {{ $project->durasi_hari }} hari</span>
                        @endif
                    </footer>
                </div>
            </article>
        @endforeach
    </div>

    {{-- Controls --}}
    <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-5">
        <div class="flex items-center gap-2" role="tablist" aria-label="Pilih kartu portfolio">
            @foreach($cards as $i => $project)
                <button type="button" role="tab"
                        @click="go({{ $i }})"
                        :aria-selected="(active === {{ $i }}).toString()"
                        :class="active === {{ $i }} ? 'ring-2 ring-[#22AF85] ring-offset-2 opacity-100' : 'opacity-50 hover:opacity-90'"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-md overflow-hidden bg-gray-100 transition"
                        aria-label="{{ $project->title }}">
                    <img src="{{ $project->after_image_url }}" alt="" loading="lazy" class="w-full h-full object-cover">
                </button>
            @endforeach
        </div>

        <div class="flex items-center gap-3">
            <button type="button" @click="prev()" aria-label="Kartu sebelumnya"
                    class="w-11 h-11 rounded-full border-2 border-[#1c1c17]/15 hover:border-[#22AF85] hover:text-[#22AF85] flex items-center justify-center transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </button>
            <button type="button" @click="next()" aria-label="Kartu berikutnya"
                    class="w-11 h-11 rounded-full bg-[#1c1c17] hover:bg-[#22AF85] text-white flex items-center justify-center transition">
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
            <a href="{{ route('portfolio.index') }}"
               class="ml-2 inline-flex items-center gap-1.5 text-sm font-bold text-[#188060] hover:text-[#22AF85] group">
                Semua Portfolio
                <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
    </div>

    {{-- Photo zoom --}}
    <template x-teleport="body">
        <div x-show="zoomed" x-cloak x-transition.opacity
             @click="zoomed = null" @keydown.escape.window="zoomed = null"
             class="fixed inset-0 z-[100] bg-black/85 flex items-center justify-center p-4">
            <button type="button" class="absolute top-4 right-4 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center" aria-label="Tutup">
                <span class="material-symbols-outlined">close</span>
            </button>
            <figure class="bg-white p-3 pb-12 max-w-lg w-full relative" @click.stop>
                <img :src="zoomed?.src" :alt="zoomed?.label" class="w-full aspect-square object-cover">
                <figcaption class="absolute bottom-4 left-4 font-mono text-xs font-bold uppercase tracking-widest text-[#1c1c17]" x-text="zoomed?.label"></figcaption>
            </figure>
        </div>
    </template>
</div>

<script>
function spkStack(total) {
    return {
        total,
        active: 0,
        leaving: null,
        leaveDir: -1,
        zoomed: null,
        touched: false,
        nudging: false,
        drag: null,
        dragX: 0,
        next(dir = -1) {
            if (this.total < 2) return;
            this.throwActive(dir);
            this.active = (this.active + 1) % this.total;
        },
        prev(thrown = false) {
            if (this.total < 2) return;
            if (thrown) this.throwActive(1); else this.touched = true;
            this.active = (this.active - 1 + this.total) % this.total;
        },
        go(i) {
            if (i === this.active) return;
            this.throwActive(-1);
            this.active = i;
        },
        // Send the current top card flying off to the side before it settles into the pile
        throwActive(dir) {
            this.touched = true;
            this.leaving = this.active;
            this.leaveDir = dir;
            setTimeout(() => this.leaving = null, 380);
        },
        // Position of a card in the pile: the active one on top, the next two peeking out behind it
        cardStyle(i) {
            if (i === this.leaving) {
                return 'transform: translateX(' + (115 * this.leaveDir) + '%) rotate(' + (9 * this.leaveDir) + 'deg); opacity: 0; z-index: 60; pointer-events: none;';
            }
            const depth = (i - this.active + this.total) % this.total;
            if (depth === 0 && this.dragX) {
                return 'transform: translateX(' + this.dragX + 'px) rotate(' + (this.dragX / 30) + 'deg); z-index: 50; transition: none;';
            }
            const pile = [
                'translate(0, 0) rotate(0deg)',
                'translate(10px, 22px) rotate(1.2deg) scale(.985)',
                'translate(-8px, 40px) rotate(-1deg) scale(.97)',
            ];
            const visible = depth < pile.length;
            return 'transform: ' + (visible ? pile[depth] : 'translate(0, 48px) scale(.95)') + ';'
                + 'opacity: ' + (visible ? 1 : 0) + ';'
                + 'z-index: ' + (50 - depth) + ';'
                + (depth === 0 ? '' : 'pointer-events: none;');
        },
        zoom(src, label) {
            this.zoomed = { src, label };
        },
        // Touch: the top card follows the finger horizontally; vertical moves keep scrolling the page
        touchStart(e) {
            this.drag = { x: e.touches[0].clientX, y: e.touches[0].clientY, axis: null };
        },
        touchMove(e) {
            if (!this.drag || this.total < 2) return;
            const dx = e.touches[0].clientX - this.drag.x;
            const dy = e.touches[0].clientY - this.drag.y;
            if (!this.drag.axis && Math.abs(dx) + Math.abs(dy) > 8) {
                this.drag.axis = Math.abs(dx) > Math.abs(dy) ? 'x' : 'y';
            }
            if (this.drag.axis === 'x') {
                this.touched = true;
                this.dragX = dx;
            }
        },
        touchEnd() {
            const dx = this.dragX;
            this.drag = null;
            this.dragX = 0;
            if (Math.abs(dx) < 60) return;
            dx < 0 ? this.next(-1) : this.prev(true);
        },
        // On phones, wiggle the top card once when the section scrolls into view
        watchNudge() {
            if (this.total < 2 || !('IntersectionObserver' in window)) return;
            if (!window.matchMedia('(max-width: 639px)').matches) return;
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            const observer = new IntersectionObserver((entries) => {
                if (!entries[0].isIntersecting) return;
                observer.disconnect();
                setTimeout(() => {
                    if (this.touched) return;
                    this.nudging = true;
                    setTimeout(() => this.nudging = false, 1150);
                }, 700);
            }, { threshold: 0.3 });
            observer.observe(this.$el);
        },
    }
}
</script>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada portfolio.</div>
@endif
