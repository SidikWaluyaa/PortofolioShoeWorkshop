@extends('layouts.main')
@section('seo_title', ($settings['site_title'] ?? 'Shoe Workshop') . ' | Reparasi & Perawatan Sepatu Profesional Bandung')
@section('seo_description', 'Shoe Workshop Bandung – jasa reparasi sepatu, cuci sepatu, repaint, reglue, sol, dan jahit profesional. Garansi kualitas, proses cepat, konsultasi gratis. Berdiri sejak 2017, 84K+ pelanggan.')
@section('seo_keywords', 'reparasi sepatu bandung, cuci sepatu, repaint sepatu, reglue sepatu, sol lepas, jahit sepatu, shoe repair bandung, restorasi sepatu')
@section('canonical_url', 'https://shoeworkshop.id/')
@section('og_image', 'https://shoeworkshop.id/images/og-default.jpg')
@section('schema_json')
@php
    $schemaData = [
        '@context' => 'https://schema.org',
        '@type'    => 'LocalBusiness',
        'name'     => $settings['site_title'] ?? 'Shoe Workshop',
        'description' => 'Jasa reparasi sepatu, cuci, repaint, reglue, sol, dan jahit profesional di Bandung. Berdiri sejak 2017, 84K+ pelanggan.',
        'url'      => 'https://shoeworkshop.id',
        'logo'     => 'https://shoeworkshop.id/favicon.png',
        'image'    => 'https://shoeworkshop.id/images/og-default.jpg',
        'telephone' => $settings['whatsapp_number'] ?? '',
        'email'    => $settings['email'] ?? '',
        'priceRange' => '$$',
        'currenciesAccepted' => 'IDR',
        'paymentAccepted' => 'Cash, Transfer Bank',
        'openingHoursSpecification' => [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
            'opens' => '09:00',
            'closes' => '17:00',
        ]],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $settings['address'] ?? 'Bandung',
            'addressLocality' => 'Bandung',
            'addressRegion' => 'Jawa Barat',
            'addressCountry' => 'ID',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '-6.9175',
            'longitude' => '107.6191',
        ],
        'sameAs' => array_filter([
            $settings['instagram_link'] ?? '',
            $settings['tiktok_link'] ?? '',
            $settings['facebook_link'] ?? '',
        ]),
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Layanan Reparasi Sepatu',
            'itemListElement' => [
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Cuci Sepatu']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Repaint Sepatu']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Reglue / Sol Lepas']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Jahit Sepatu']],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Restorasi Sepatu']],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . json_encode($schemaData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
@endphp
@endsection

@section('content')

    @include('layouts.navigation-public')

    <main class="pt-20">
        <div class="relative overflow-x-clip bg-home-grid w-full">
            <!-- Glowing background blobs (Aurora style) -->
            <div
                class="absolute top-0 right-[-10%] w-[550px] h-[550px] rounded-full bg-[#22AF85]/15 blur-[110px] pointer-events-none z-0">
            </div>
            <div
                class="absolute top-[25%] left-[-15%] w-[650px] h-[650px] rounded-full bg-[#FFC232]/8 blur-[130px] pointer-events-none z-0">
            </div>
            <div
                class="absolute bottom-[35%] right-[-5%] w-[600px] h-[600px] rounded-full bg-[#22AF85]/8 blur-[110px] pointer-events-none z-0">
            </div>
            <div
                class="absolute bottom-[10%] left-[5%] w-[550px] h-[550px] rounded-full bg-[#FFC232]/12 blur-[110px] pointer-events-none z-0">
            </div>

            {{-- 1. HERO --}}
            @include('components.hero', ['heroes' => $heroes])

            {{-- 2. LAYANAN --}}
            <section id="layanan" class="py-20 sm:py-24 px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto scroll-mt-20 border-b border-gray-100">
                <div class="text-center mb-14 space-y-4">
                    <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Layanan Kami</p>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17]">Solusi Terbaik Untuk Sepatu Anda</h2>
                </div>
                @include('components.services', ['services' => $services])
            </section>

            {{-- 3. TENTANG KAMI --}}
            <section id="about" class="scroll-mt-20">
                @include('components.about', ['about' => $about])
            </section>

            {{-- 4. PORTFOLIO --}}
            <section id="portfolio" class="py-20 sm:py-24 border-y border-gray-200 scroll-mt-20">
                <div class="px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto">
                    <div class="text-center mb-14 space-y-4">
                        <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Portfolio</p>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17]">Hasil Restorasi Kami</h2>
                        <p class="text-gray-500 max-w-xl mx-auto">Setiap sepatu yang masuk punya kartu kerjanya sendiri. Ini beberapa di antaranya, lengkap dengan keluhan, tindakan, dan hasil QC-nya.</p>
                    </div>
                    @include('components.portfolio', ['portfolio' => $portfolio])
                </div>
            </section>

            {{-- Cara kerja is now part of "Alur Kerja Kami" inside the about section --}}

            {{-- 6. REVIEW --}}
            <section id="review"
                class="pt-20 sm:pt-24 pb-10 bg-[#188060] border-y border-[#188060] scroll-mt-20 relative z-10 text-white overflow-hidden">
                <div class="px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 text-center md:text-left">
                        <div class="max-w-[560px] space-y-4 mx-auto md:mx-0">
                            <p class="text-sm font-semibold text-[#FFC232] tracking-widest uppercase">Testimoni</p>
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">Kata mereka setelah sepatunya kembali</h2>
                        </div>
                        @if(!empty($globalSettings['google_rating']))
                            <a href="{{ $globalSettings['google_maps_url'] ?? '#' }}" target="_blank" rel="noopener"
                               class="group mx-auto md:mx-0 inline-flex items-center gap-3 text-left">
                                <span class="text-4xl font-extrabold leading-none">{{ $globalSettings['google_rating'] }}</span>
                                <span class="text-sm leading-snug">
                                    @php $ratingPct = min(100, max(0, (float) str_replace(',', '.', $globalSettings['google_rating']) / 5 * 100)); @endphp
                                    <span class="relative block w-max tracking-[0.15em]" aria-hidden="true">
                                        <span class="text-white/25">★★★★★</span>
                                        <span class="absolute inset-y-0 left-0 overflow-hidden whitespace-nowrap text-[#FFC232]" style="width: {{ $ratingPct }}%">★★★★★</span>
                                    </span>
                                    <span class="text-white/80 group-hover:text-white underline decoration-white/30 underline-offset-4 group-hover:decoration-white">
                                        {{ $globalSettings['google_review_count'] ?? '' }} ulasan di Google Maps
                                    </span>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto">
                    @include('components.reviews', ['reviews' => $reviews])
                </div>
            </section>

            {{-- 6.5 DONASI SHOWCASE --}}
            @include('components.donasi-showcase')

            {{-- 7. ARTIKEL --}}
            <section id="blog" class="py-20 sm:py-24 px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto scroll-mt-20">
                <div class="text-center mb-8 sm:mb-10 space-y-4">
                    <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Klinik Sepatu</p>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17] leading-tight">Sepatumu kenapa?</h2>
                    <p class="text-gray-500 max-w-xl mx-auto">Pilih keluhannya. Kami jelaskan penyebabnya, cara mencegahnya, dan layanan yang bisa memperbaikinya.</p>
                </div>
                @include('components.blog', ['posts' => $latestPosts])
            </section>

            {{-- 8. LOKASI --}}
            <section id="kontak" class="relative bg-[#188060] text-white py-20 sm:py-28 overflow-hidden scroll-mt-20 z-0">
                {{-- Decorative Background Elements --}}
                <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-br from-[#22AF85]/40 to-transparent rounded-full blur-[80px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle,#ffffff_1px,transparent_1px)] bg-[length:24px_24px] opacity-10 pointer-events-none"></div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                        {{-- Left: CTA Info --}}
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                                    {{ $cta->title ?? 'Butuh saran perawatan atau estimasi biaya?' }}
                                </h2>
                                <p class="text-emerald-50 opacity-90 text-lg leading-relaxed">
                                    {{ $cta->subtitle ?? 'Konsultasikan sepatu Anda sekarang juga. Tim kami siap membantu Anda.' }}
                                </p>
                            </div>
                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            @php
                                $message = "Halo Shoe Workshop, saya ingin berkonsultasi mengenai perawatan/reparasi sepatu saya. Boleh bantu estimasi biayanya?";
                                $waUrl = $cta->button_link ?? 'https://wa.me/' . ($settings['whatsapp_number'] ?? '628123456789');
                                if (str_contains($waUrl, 'wa.me') && !str_contains($waUrl, 'text=')) {
                                    $separator = str_contains($waUrl, '?') ? '&' : '?';
                                    $waUrl .= $separator . 'text=' . urlencode($message);
                                }
                            @endphp
                            <a href="{{ $waUrl }}" target="_blank"
                                class="inline-flex justify-center items-center gap-2 px-6 py-3.5 bg-[#FFC232] hover:bg-[#f5b82c] text-[#1c1c17] rounded-xl font-bold hover:scale-105 active:scale-95 transition-transform shadow-[0_10px_30px_rgba(255,194,50,0.3)]">
                                <span class="material-symbols-outlined !text-lg">chat</span>
                                {{ $cta->button_text ?? 'Konsultasi via WhatsApp' }}
                            </a>
                        </div>
                    </div>
                    {{-- Right: Map --}}
                    <div
                        class="rounded-3xl overflow-hidden shadow-2xl border-4 sm:border-8 border-white bg-gray-100 min-h-[400px] flex flex-col">
                        <div class="flex-grow relative min-h-[300px]">
                            <iframe
                                src="https://maps.google.com/maps?q={{ urlencode($settings['address'] ?? 'Bandung') }}&output=embed"
                                width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"
                                title="Lokasi Shoe Workshop" class="absolute inset-0 w-full h-full"></iframe>
                        </div>
                        <div
                            class="bg-white p-4 sm:p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 border-t border-gray-200">
                            <div>
                                <p class="font-semibold text-[#1c1c17]">Shoe Workshop Bandung</p>
                                <p class="text-xs text-gray-500">Klik peta untuk navigasi</p>
                            </div>
                            <a href="https://maps.app.goo.gl/rSxrp8gRqce2Euxr5" target="_blank"
                                class="bg-white text-[#1c1c17] px-6 py-2 rounded-full shadow-lg text-sm font-semibold flex items-center gap-2 border border-gray-200 hover:border-[#22AF85] transition-colors whitespace-nowrap">
                                Buka di Google Maps
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </section>

    </main>

    {{-- FOOTER --}}
    @include('components.footer', ['settings' => $settings])

    @guest


        <style>
            @verbatim
            @keyframes pulse-soft {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }
            }

            .animate-pulse-soft {
                animation: pulse-soft 2s infinite ease-in-out;
            }

            [x-cloak] {
                display: none !important;
            }
            @endverbatim
        </style>
    @endguest

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      // Before-after slider drag (Phase 2 & 5)
      document.querySelectorAll('.ba-slider').forEach(slider=>{
        const after = slider.querySelector('.after-layer');
        const handle = slider.querySelector('.ba-handle');
        const knob = slider.querySelector('.knob');
        let dragging = false;

        function setPos(clientX){
          const rect = slider.getBoundingClientRect();
          let pct = ((clientX - rect.left) / rect.width) * 100;
          pct = Math.max(0, Math.min(100, pct));
          if(after) after.style.clipPath = `inset(0 0 0 ${pct}%)`;
          if(handle) handle.style.left = pct + '%';
        }

        // Touch & Mouse events
        const startDrag = (e) => {
          // Mouse: stop the browser from text-selecting the page while dragging
          if (!e.touches) e.preventDefault();
          dragging = true;
          if(knob) knob.classList.add('scale-110', 'shadow-xl');
          setPos(e.touches ? e.touches[0].clientX : e.clientX);
        };

        const moveDrag = (e) => {
          if(!dragging) return;
          setPos(e.touches ? e.touches[0].clientX : e.clientX);
        };

        const endDrag = () => {
          dragging = false;
          if(knob) knob.classList.remove('scale-110', 'shadow-xl');
        };

        slider.addEventListener('mousedown', startDrag);
        slider.addEventListener('touchstart', startDrag, {passive: true});
        
        window.addEventListener('mousemove', moveDrag);
        window.addEventListener('touchmove', (e) => {
          if (dragging) {
            // Prevent vertical scroll while horizontal dragging
            if(e.cancelable) e.preventDefault(); 
            moveDrag(e);
          }
        }, {passive: false});

        window.addEventListener('mouseup', endDrag);
        window.addEventListener('touchend', endDrag);

        // Intro hint animation (only if not reduced motion)
        if (!prefersReducedMotion) {
          const hintIO = new IntersectionObserver((entries)=>{
            entries.forEach(entry=>{
              if(entry.isIntersecting){
                setTimeout(()=> { if(!dragging) setPos(slider.getBoundingClientRect().left + slider.getBoundingClientRect().width*0.28); }, 500);
                setTimeout(()=> { if(!dragging) setPos(slider.getBoundingClientRect().left + slider.getBoundingClientRect().width*0.5); }, 1100);
                hintIO.unobserve(slider);
              }
            });
          }, {threshold:0.5});
          hintIO.observe(slider);
        }
      });
    });
    </script>
@endsection