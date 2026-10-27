@php
    /*
     * Photo helper: returns the URL of the first existing file (public/images/tentang-kami/<name>),
     * or null so a placeholder is rendered. Drop the office photos in that folder using the names
     * listed in the $steps / $gallery arrays below (jpg, jpeg, png, webp are all picked up).
     * A same-named .webp next to the original (e.g. rak.png -> rak.webp) is served in its place.
     */
    $photoDir = 'images/tentang-kami/';
    $photo = function (array $names) use ($photoDir) {
        foreach ($names as $name) {
            $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $name);
            foreach (array_unique([$webp, $name]) as $file) {
                if (file_exists(public_path($photoDir . $file))) {
                    return asset($photoDir . rawurlencode($file));
                }
            }
        }
        return null;
    };
    $variants = fn(string $base) => array_map(fn($ext) => "$base.$ext", ['jpg', 'jpeg', 'png', 'webp']);

    $waNumber = $globalSettings['whatsapp_number'] ?? '628123456789';
    $waUrl = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode('Halo Shoe Workshop, saya ingin konsultasi mengenai sepatu saya.');

    $gallery = [
        ['img' => $photo(['pengerjaan3.png']), 'label' => 'Ruang Produksi',     'span' => 'col-span-2 row-span-2'],
        ['img' => $photo(['pengerjaan.png']),  'label' => 'Workshop Jahit',     'span' => 'col-span-1 row-span-1'],
        ['img' => $photo(['pengerjaan2.png']), 'label' => 'Pengerjaan Sol & Lem','span' => 'col-span-1 row-span-1'],
        ['img' => $photo(['mesin-industri.png']), 'label' => 'Mesin Press Industri', 'span' => 'col-span-1 row-span-1'],
        ['img' => $photo(['inside-office.jpeg']), 'label' => 'Kantor Operasional', 'span' => 'col-span-1 row-span-1'],
    ];

    $steps = [
        ['no' => '01', 'team' => 'office',   'icon' => 'support_agent', 'title' => 'Konsultasi & SPK',
         'desc' => 'Kirim foto kondisi sepatu via WhatsApp. CS memberi analisa awal dan estimasi biaya gratis, lalu menerbitkan SPK.',
         'img' => $photo(array_merge($variants('kantor-cs'), ['front-office.png'])), 'hint' => 'kantor-cs.jpg'],
        ['no' => '02', 'team' => 'gudang', 'badge' => 'Tim QC (Gudang)', 'icon' => 'fact_check', 'title' => 'Penerimaan & QC Awal',
         'desc' => 'Antar langsung ke workshop atau kirim via ekspedisi (J&T, dll). QC pertama: material dan struktur dicek lalu dicatat.',
         'img' => $photo(array_merge(['qc-awal.png'], $variants('penerimaan'), ['rak after.png'])), 'hint' => 'qc-awal.png'],
        ['no' => '03', 'team' => 'workshop', 'icon' => 'construction', 'title' => 'Pengerjaan Workshop',
         'desc' => 'Dikerjakan artisan berpengalaman dengan tools profesional dan bahan premium yang aman untuk material. Diakhiri QC hasil pengerjaan.',
         'img' => $photo(['pengerjaan3.png']), 'hint' => null],
        ['no' => '04', 'team' => 'workshop', 'icon' => 'verified', 'title' => 'QC Akhir',
         'desc' => 'QC ketiga sebelum sepatu dinyatakan selesai. Jika belum lolos, dikerjakan ulang hingga sesuai standar.',
         'img' => $photo(['QC.png']), 'hint' => null],
        ['no' => '05', 'team' => 'gudang',   'icon' => 'shield_with_heart', 'title' => 'Selesai & Garansi 100 Hari',
         'desc' => 'Foto before–after kami kirim ke Anda, lalu sepatu dikemas untuk diambil atau dikirim. Klaim garansi bisa diajukan online.',
         'img' => $photo(['rak.png']), 'hint' => null],
    ];

    // Team styling for the flow (timeline dot, card badge, mobile mini-label). A step may override the badge text via 'badge'.
    $teams = [
        'office'   => ['label' => 'Tim Kantor',   'short' => 'KANTOR',   'dot' => 'bg-[#FFC232]', 'text' => 'text-[#FFC232]', 'badge' => 'bg-[#FFC232] text-[#1c1c17]'],
        'gudang'   => ['label' => 'Tim Gudang',   'short' => 'GUDANG',   'dot' => 'bg-sky-300',   'text' => 'text-sky-200',   'badge' => 'bg-sky-300 text-[#0c3b52]'],
        'workshop' => ['label' => 'Tim Workshop', 'short' => 'WORKSHOP', 'dot' => 'bg-white',     'text' => 'text-white/80',  'badge' => 'bg-white text-[#188060]'],
    ];

    $careImg = $photo($variants('customer-care'));
@endphp

<div class="relative bg-[#188060] text-white py-20 sm:py-28 overflow-hidden z-0"
     x-data="{
        lightbox: { open: false, src: '', alt: '' },
        openLightbox(img) {
            if (!img) return;
            this.lightbox = { open: true, src: img.currentSrc || img.src, alt: img.alt };
        },
        closeLightbox() { this.lightbox.open = false; },
     }"
     x-effect="document.documentElement.classList.toggle('overflow-hidden', lightbox.open)">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-[#22AF85]/40 to-transparent rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-[#FFC232]/20 to-transparent rounded-full blur-[80px] translate-y-1/3 -translate-x-1/3 pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:24px_24px] opacity-10 pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 z-10 space-y-16 sm:space-y-24">

        {{-- ============ 1. STORY + STATS ============ --}}
        <div class="space-y-12">
            <div class="flex flex-col items-center text-center gap-4">
                <p class="text-sm font-semibold text-[#FFC232] tracking-widest uppercase">Tentang Kami</p>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight tracking-tight">Mengenal Shoe Workshop</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-10 lg:gap-16 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm">
                        <span class="material-symbols-outlined text-[#FFC232] !text-sm">verified</span>
                        <p class="text-xs font-bold tracking-widest text-white uppercase">{{ $about->title ?? 'Berdiri sejak 2017' }}</p>
                    </div>
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.15] text-white">
                        Restorasi Sepatu &amp; <br>
                        <span class="text-[#FFC232]">Dampak Sosial.</span>
                    </h3>
                    {{-- Mobile: clamp the long story, expandable --}}
                    <div x-data="{ open: false }">
                        <p class="text-[15px] sm:text-lg text-white/90 leading-relaxed whitespace-pre-line sm:line-clamp-none" :class="open ? '' : 'line-clamp-5'">{{ $about->description ?? '' }}</p>
                        <button type="button" @click="open = !open" class="sm:hidden mt-2 inline-flex items-center gap-1 text-sm font-bold text-[#FFC232]">
                            <span x-text="open ? 'Tutup' : 'Baca selengkapnya'">Baca selengkapnya</span>
                            <span class="material-symbols-outlined !text-lg transition-transform" :class="open && 'rotate-180'">expand_more</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-3 lg:grid-cols-1 gap-3 sm:gap-4">
                    @foreach([
                        ['work_history', '9+', 'Tahun Berjalan'],
                        ['group', '84K+', 'Pelanggan'],
                        ['volunteer_activism', '1.5K+', 'Donasi Disalurkan'],
                    ] as [$icon, $num, $label])
                    <div class="flex flex-col lg:flex-row items-center lg:items-center gap-1 sm:gap-4 text-center lg:text-left bg-white/5 border border-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-5 hover:bg-white/10 transition-colors">
                        <span class="material-symbols-outlined text-[#FFC232] !text-2xl sm:!text-4xl">{{ $icon }}</span>
                        <div>
                            <p class="text-xl sm:text-4xl font-black text-white leading-none">{{ $num }}</p>
                            <p class="text-[10px] sm:text-[11px] font-bold text-white/70 uppercase tracking-wide sm:tracking-widest leading-tight mt-1.5">{{ $label }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ============ 2. WORKSHOP GALLERY (bento) ============ --}}
        <div class="space-y-8">
            <div class="text-center space-y-3">
                <p class="text-sm font-semibold text-[#FFC232] tracking-widest uppercase">Lihat Sendiri Kualitas Kerjanya</p>
                <h3 class="text-2xl sm:text-4xl font-extrabold text-white">Di Balik Setiap Sepatu</h3>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 auto-rows-[130px] sm:auto-rows-[200px] lg:auto-rows-[230px] gap-3 sm:gap-4">
                @foreach($gallery as $g)
                <figure class="relative overflow-hidden rounded-2xl sm:rounded-3xl border border-white/15 shadow-2xl group {{ $g['span'] }} {{ $g['img'] ? 'cursor-zoom-in' : '' }}"
                        @if($g['img']) @click="openLightbox($el.querySelector('img'))" @endif>
                    @if($g['img'])
                        <img src="{{ $g['img'] }}" alt="{{ $g['label'] }}" loading="lazy"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 bg-white/10 flex items-center justify-center text-white/60 text-xs">Foto segera hadir</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                    <figcaption class="absolute bottom-3 left-4 right-4 text-white font-bold text-sm sm:text-base">{{ $g['label'] }}</figcaption>
                </figure>
                @endforeach
            </div>
        </div>

        {{-- ============ 3. OPERATIONAL FLOW ============ --}}
        <div class="space-y-10">
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <p class="text-sm font-semibold text-[#FFC232] tracking-widest uppercase">Alur Kerja Kami</p>
                <h3 class="text-2xl sm:text-4xl font-extrabold text-white">Dari Konsultasi Hingga Sepatu Kembali ke Tangan Anda</h3>
                <p class="text-white/80 text-sm sm:text-base">Transparan di setiap langkah: Anda selalu mendapat update status, dan setiap sepatu melewati tiga kali Quality Control.</p>            </div>

            <div class="relative">
                {{-- connector line (desktop) --}}
                <div class="hidden lg:block absolute top-[11px] left-[10%] right-[10%] h-px bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>

                {{-- connector line (mobile timeline) --}}
                <div class="sm:hidden absolute top-6 bottom-6 left-[2.75rem] w-px bg-gradient-to-b from-white/0 via-white/30 to-white/0"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-5">
                    @foreach($steps as $s)
                    @php $team = $teams[$s['team']]; @endphp
                    <div class="relative flex flex-col gap-4">
                        <div class="relative hidden lg:flex justify-center">
                            <span class="w-[22px] h-[22px] rounded-full border-4 border-[#188060] {{ $team['dot'] }} shadow-[0_0_0_4px_rgba(255,255,255,0.15)]"></span>
                        </div>
                        {{-- Mobile: compact row (thumb + text); sm+: stacked card --}}
                        <div class="flex-1 flex flex-row sm:flex-col items-stretch rounded-2xl sm:rounded-3xl bg-white/10 backdrop-blur-md border border-white/15 overflow-hidden hover:-translate-y-1 hover:bg-white/15 transition-all duration-500">
                            <div class="relative w-[5.5rem] shrink-0 sm:w-auto sm:aspect-[4/3] bg-black/20 {{ $s['img'] ? 'cursor-zoom-in' : '' }}"
                                 @if($s['img']) @click="openLightbox($el.querySelector('img'))" @endif>
                                @if($s['img'])
                                    <img src="{{ $s['img'] }}" alt="{{ $s['title'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-1 text-white/60 border-r sm:border-r-0 sm:border-b border-dashed border-white/25">
                                        <span class="material-symbols-outlined !text-2xl sm:!text-3xl">add_photo_alternate</span>
                                        <span class="hidden sm:inline text-[10px] font-mono">{{ $s['hint'] ?? 'foto.jpg' }}</span>
                                    </div>
                                @endif
                                <span class="hidden sm:inline absolute top-3 left-3 text-[10px] font-black tracking-widest px-2.5 py-1 rounded-full uppercase {{ $team['badge'] }}">
                                    {{ $s['badge'] ?? $team['label'] }}
                                </span>
                            </div>
                            <div class="min-w-0 p-3.5 sm:p-5 flex flex-col gap-1.5 sm:gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[#FFC232] !text-lg sm:!text-xl">{{ $s['icon'] }}</span>
                                    <span class="text-xs font-black text-white/50 tracking-widest">{{ $s['no'] }}</span>
                                    <span class="sm:hidden ml-auto inline-flex items-center gap-1.5 text-[9px] font-black tracking-widest {{ $team['text'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $team['dot'] }}"></span>
                                        {{ $team['short'] }}
                                    </span>
                                </div>
                                <h4 class="font-extrabold text-white text-[15px] sm:text-base leading-snug">{{ $s['title'] }}</h4>
                                <p class="text-white/75 text-xs sm:text-[13px] leading-relaxed">{{ $s['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Customer Care companion band --}}
            <div class="relative rounded-3xl bg-gradient-to-r from-[#FFC232]/20 via-white/10 to-white/5 border border-[#FFC232]/40 backdrop-blur-md p-5 sm:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-[220px_1fr_auto] gap-6 lg:gap-8 items-center">
                    <div class="relative aspect-[16/9] sm:aspect-[4/3] lg:aspect-square rounded-2xl overflow-hidden bg-black/20 border border-white/15 {{ $careImg ? 'cursor-zoom-in' : '' }}"
                         @if($careImg) @click="openLightbox($el.querySelector('img'))" @endif>
                        @if($careImg)
                            <img src="{{ $careImg }}" alt="Customer Care" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center gap-1 text-white/60 border border-dashed border-white/25 rounded-2xl">
                                <span class="material-symbols-outlined !text-3xl">add_photo_alternate</span>
                                <span class="text-[10px] font-mono">customer-care.jpg</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-1">
                            <p class="text-[11px] font-bold tracking-[0.2em] text-[#FFC232] uppercase">Selama Pengerjaan</p>
                            <h4 class="text-xl sm:text-2xl font-extrabold text-white">Didampingi Customer Care dari Awal Sampai Akhir</h4>
                        </div>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm text-white/85">
                            @foreach([
                                'Report progress pengerjaan secara berkala',
                                'Siap menjawab pertanyaan dan follow-up Anda',
                                'Konfirmasi catatan jika ada temuan saat pengerjaan',
                                'Penanganan komplain dengan alur yang jelas',
                            ] as $point)
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-[#FFC232] !text-lg mt-px">check_circle</span>{{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex flex-col gap-3 min-w-[220px]">
                        <a href="{{ route('tracking.index') }}"
                           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-[#FFC232] text-[#1c1c17] font-bold hover:scale-105 active:scale-95 transition-transform shadow-[0_10px_30px_rgba(255,194,50,0.3)]">
                            <span class="material-symbols-outlined !text-lg">location_searching</span> Lacak Sepatu (SPK)
                        </a>
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white/10 border border-white/25 text-white font-bold hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined !text-lg">forum</span> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            {{-- Warranty banner --}}
            <div class="rounded-3xl bg-white text-[#1c1c17] p-6 sm:p-8 flex flex-col md:flex-row items-center gap-6 md:gap-10 shadow-[0_30px_60px_rgba(0,0,0,0.25)]">
                <div class="shrink-0 w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-gradient-to-br from-[#22AF85] to-[#188060] text-white flex flex-col items-center justify-center shadow-lg">
                    <span class="text-3xl sm:text-4xl font-black leading-none">100</span>
                    <span class="text-[10px] font-bold tracking-widest uppercase mt-1">Hari</span>
                </div>
                <div class="flex-1 text-center md:text-left space-y-1">
                    <h4 class="text-xl sm:text-2xl font-extrabold">Garansi Pengerjaan 100 Hari</h4>
                    <p class="text-gray-600 text-sm sm:text-base">Hasil kurang sesuai? Ajukan klaim langsung lewat sistem, cukup masukkan nomor SPK dan nomor HP Anda. Tim kami akan memverifikasi dan menindaklanjuti.</p>
                </div>
                <a href="{{ route('warranty.index') }}"
                   class="shrink-0 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#22AF85] text-white font-bold hover:bg-[#188060] hover:scale-105 active:scale-95 transition-all">
                    Ajukan Klaim Garansi
                    <span class="material-symbols-outlined !text-lg">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Photo lightbox: teleported to <body> so the section's overflow/z-index can't clip it.
         Closes via the X button, a click anywhere outside the photo, or Escape. --}}
    <template x-teleport="body">
        <div x-show="lightbox.open" x-cloak
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="closeLightbox()" @keydown.escape.window="closeLightbox()"
             class="fixed inset-0 z-[10000] flex items-center justify-center p-4 sm:p-10 bg-black/85 backdrop-blur-sm"
             role="dialog" aria-modal="true" :aria-label="lightbox.alt">
            <button type="button" @click.stop="closeLightbox()" aria-label="Tutup"
                    class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/15 hover:bg-white/30 border border-white/20 text-white flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <figure class="flex flex-col items-center gap-3 max-w-6xl">
                <img :src="lightbox.src" :alt="lightbox.alt" @click.stop
                     class="max-w-full max-h-[80vh] rounded-2xl object-contain shadow-2xl">
                <figcaption x-text="lightbox.alt" @click.stop class="text-white font-bold text-sm sm:text-base text-center"></figcaption>
            </figure>
        </div>
    </template>
</div>