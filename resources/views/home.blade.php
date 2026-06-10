@extends('layouts.main')
@section('seo_title', ($settings['site_title'] ?? 'Shoe Workshop') . ' | Reparasi Sepatu Profesional')
@section('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit. Garansi kualitas, proses cepat.')
@section('seo_keywords', 'reparasi sepatu bandung, cuci sepatu, repaint sepatu, sol lepas, shoe repair bandung')
@section('content')

{{-- NAVBAR --}}
<nav x-data="{
        open: false,
        scrolled: false,
        active: 'beranda',
        init() {
            this.updateActive();
            this.checkScroll();
            window.addEventListener('scroll', () => {
                this.updateActive();
                this.checkScroll();
            });
        },
        checkScroll() {
            this.scrolled = window.scrollY > 20;
        },
        updateActive() {
            const ids = ['contact','about','blog','reviews','workflow','portfolio','services'];
            const offset = 80;
            let found = 'beranda';
            for (const id of ids) {
                const el = document.getElementById(id);
                if (el && window.scrollY >= el.offsetTop - offset) {
                    found = id;
                    break;
                }
            }
            this.active = found;
        }
     }"
     class="sticky top-0 z-50 transition-all duration-300"
     :class="scrolled ? 'bg-[#1a9970] shadow-lg' : 'bg-[#22AF85]'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                <x-application-logo class="h-9 w-auto brightness-0 invert" />
                <div>
                    <p class="font-black text-sm leading-none text-white">SHOE</p>
                    <p class="font-black text-sm leading-none text-white/70">WORKSHOP</p>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-0.5">
                <a href="{{ route('home') }}"
                   class="px-3 py-2 text-sm font-semibold rounded-lg transition-all duration-200"
                   :class="active === 'beranda' ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10'">
                    Beranda
                </a>
                <a href="#services" @click="active='services'"
                   class="px-3 py-2 text-sm font-semibold rounded-lg transition-all duration-200"
                   :class="active === 'services' ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10'">
                    Layanan
                </a>
                <a href="#portfolio" @click="active='portfolio'"
                   class="px-3 py-2 text-sm font-semibold rounded-lg transition-all duration-200"
                   :class="active === 'portfolio' ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10'">
                    Portfolio
                </a>
                <a href="#reviews" @click="active='reviews'"
                   class="px-3 py-2 text-sm font-semibold rounded-lg transition-all duration-200"
                   :class="active === 'reviews' ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10'">
                    Review
                </a>
                <a href="{{ route('blog.index') }}"
                   class="px-3 py-2 text-sm font-semibold text-white/80 hover:text-white hover:bg-white/10 transition-all rounded-lg">
                    Artikel
                </a>
                <a href="{{ route('tracking.index') }}"
                   class="px-3 py-2 text-sm font-semibold text-white/80 hover:text-white hover:bg-white/10 transition-all rounded-lg">
                    Tracking
                </a>
                <a href="#contact" @click="active='contact'"
                   class="px-3 py-2 text-sm font-semibold rounded-lg transition-all duration-200"
                   :class="active === 'contact' ? 'text-white bg-white/20' : 'text-white/80 hover:text-white hover:bg-white/10'">
                    Kontak
                </a>
            </div>

            {{-- WA Button --}}
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
               class="hidden md:inline-flex items-center gap-2 px-5 py-2 bg-white text-[#22AF85] text-sm font-bold rounded-lg hover:bg-white/90 transition-colors flex-shrink-0 shadow-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Konsultasi
            </a>

            {{-- Hamburger --}}
            <button @click="open=!open" class="md:hidden p-2 text-white rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-[#1a9970] border-t border-white/10 px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"        @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white bg-white/15 rounded-lg">Beranda</a>
        <a href="#services"                   @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 rounded-lg transition-colors">Layanan</a>
        <a href="#portfolio"                  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 rounded-lg transition-colors">Portfolio</a>
        <a href="#reviews"                    @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 rounded-lg transition-colors">Review</a>
        <a href="{{ route('blog.index') }}"   @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 rounded-lg transition-colors">Artikel</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 rounded-lg transition-colors">Tracking</a>
        <a href="#contact"                    @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 rounded-lg transition-colors">Kontak</a>
        <div class="pt-2">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-white text-[#22AF85] text-sm font-bold rounded-lg hover:bg-white/90 transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Konsultasi via WhatsApp
            </a>
        </div>
    </div>
</nav>

{{-- 1. HERO --}}
@include('components.hero', ['hero' => $hero])

{{-- 2. LAYANAN --}}
<section id="services" class="py-16 sm:py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-14">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Solusi Terbaik Untuk Sepatu Anda</h2>
            <div class="w-16 h-1 bg-[#22AF85] mx-auto mt-4 rounded-full"></div>
        </div>
        @include('components.services', ['services' => $services])
    </div>
</section>

{{-- 3. PORTFOLIO --}}
<section id="portfolio" class="py-16 sm:py-20 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-14">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Hasil Restorasi Kami</h2>
            <div class="w-16 h-1 bg-[#22AF85] mx-auto mt-4 rounded-full"></div>
        </div>
        @include('components.portfolio', ['portfolio' => $portfolio])
    </div>
</section>

{{-- 4. CARA KERJA --}}
<section id="workflow" class="py-16 sm:py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @include('components.workflow', ['workflow' => $workflow])
    </div>
</section>

{{-- 5. REVIEW --}}
<section id="reviews" class="py-16 sm:py-20 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-14">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Apa Kata Mereka Tentang Kami?</h2>
            <div class="w-16 h-1 bg-[#22AF85] mx-auto mt-4 rounded-full"></div>
        </div>
        @include('components.reviews', ['reviews' => $reviews])
    </div>
</section>

{{-- 6. ARTIKEL --}}
<section id="blog" class="py-16 sm:py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-14">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Tips & Edukasi Perawatan</h2>
            <div class="w-16 h-1 bg-[#22AF85] mx-auto mt-4 rounded-full"></div>
        </div>
        @include('components.blog', ['posts' => $latestPosts])
    </div>
</section>

{{-- 7. TENTANG KAMI / STATS --}}
<section id="about" class="scroll-mt-20">
    @include('components.about', ['about' => $about])
</section>

{{-- 8. LOKASI --}}
<section id="contact" class="py-16 sm:py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-14">
            <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Kunjungi Workshop Kami</h2>
            <div class="w-16 h-1 bg-[#22AF85] mx-auto mt-4 rounded-full"></div>
        </div>
        <a href="https://maps.app.goo.gl/rSxrp8gRqce2Euxr5" target="_blank"
           class="block rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 relative group"
           style="height:300px">
            <div class="absolute inset-0 bg-black/5 group-hover:bg-black/0 transition-colors pointer-events-none z-10"></div>
            <iframe src="https://maps.google.com/maps?q={{ urlencode($settings['address'] ?? 'Bandung') }}&output=embed"
                    width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"
                    title="Lokasi Shoe Workshop" class="pointer-events-none"></iframe>
        </a>
        <div class="mt-6 bg-gray-50 rounded-2xl border border-gray-100 p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="font-bold text-gray-900">Shoe Workshop</p>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $settings['address'] ?? 'Bandung, Jawa Barat' }}</p>
                </div>
                <div class="text-sm text-gray-500">
                    <p class="font-semibold text-gray-700">Senin – Minggu</p>
                    <p>09.00 – 17.00</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 9. CTA FINAL --}}
@include('components.cta', ['cta' => $cta])

{{-- FOOTER --}}
@include('components.footer', ['settings' => $settings])

@endsection