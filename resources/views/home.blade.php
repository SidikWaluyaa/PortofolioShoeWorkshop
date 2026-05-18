@extends('layouts.main')
@section('seo_title', ($settings['site_title'] ?? 'Shoe Workshop') . ' | Reparasi Sepatu Profesional')
@section('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit. Garansi kualitas, proses cepat.')
@section('seo_keywords', 'reparasi sepatu bandung, cuci sepatu, repaint sepatu, sol lepas, shoe repair bandung')
@section('content')

{{-- NAVBAR --}}
<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-12 w-auto" />
            </a>
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}"        class="text-sm font-semibold text-gray-800 border-b-2 border-[#B8952A] pb-0.5">Beranda</a>
                <a href="#services"                   class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Layanan</a>
                <a href="#portfolio"                  class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Portfolio</a>
                <a href="#reviews"                    class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Review</a>
                <a href="{{ route('blog.index') }}"   class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Artikel</a>
                <a href="#contact"                    class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Kontak</a>
            </div>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
               class="hidden md:inline-flex items-center gap-2 px-5 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-lg">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Konsultasi via WhatsApp
            </a>
            <button @click="open=!open" class="md:hidden p-2 text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
    <div x-show="open" class="md:hidden bg-white border-t border-gray-100 px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"  @click="open=false" class="block py-2.5 text-sm font-semibold text-gray-800">Beranda</a>
        <a href="#services"            @click="open=false" class="block py-2.5 text-sm font-semibold text-gray-600">Layanan</a>
        <a href="#portfolio"           @click="open=false" class="block py-2.5 text-sm font-semibold text-gray-600">Portfolio</a>
        <a href="#reviews"             @click="open=false" class="block py-2.5 text-sm font-semibold text-gray-600">Review</a>
        <a href="{{ route('blog.index') }}" @click="open=false" class="block py-2.5 text-sm font-semibold text-gray-600">Artikel</a>
        <a href="#contact"             @click="open=false" class="block py-2.5 text-sm font-semibold text-gray-600">Kontak</a>
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="block mt-3 py-3 bg-[#22AF85] text-white text-sm font-bold text-center rounded-lg">Konsultasi via WhatsApp</a>
    </div>
</nav>

{{-- 1. HERO --}}
@include('components.hero', ['hero' => $hero])

{{-- 2. TRUST STRIP --}}
@include('components.trust', ['items' => $trustItems])

{{-- 3. LAYANAN --}}
<section id="services" class="py-16 bg-white scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center gap-3 mb-10">
            <div class="h-px w-12 bg-gray-300"></div>
            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Layanan Kami</p>
            <div class="h-px w-12 bg-gray-300"></div>
        </div>
        @include('components.services', ['services' => $services])
    </div>
</section>

{{-- 4. PORTFOLIO & CARA KERJA --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">
            <div id="portfolio" class="scroll-mt-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-px flex-1 bg-gray-300"></div>
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Portfolio</p>
                    <div class="h-px flex-1 bg-gray-300"></div>
                </div>
                @include('components.portfolio', ['portfolio' => $portfolio])
            </div>
            <div id="workflow" class="scroll-mt-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-px flex-1 bg-gray-300"></div>
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Cara Kerja</p>
                    <div class="h-px flex-1 bg-gray-300"></div>
                </div>
                @include('components.workflow', ['workflow' => $workflow])
            </div>
        </div>
    </div>
</section>

{{-- 5. REVIEW & ARTIKEL --}}
<section id="reviews" class="py-16 bg-white scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">
            <div>
                <div class="flex items-center gap-3 mb-10">
                    <div class="h-px flex-1 bg-gray-300"></div>
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Review Pelanggan</p>
                    <div class="h-px flex-1 bg-gray-300"></div>
                </div>
                @include('components.reviews', ['reviews' => $reviews])
            </div>
            <div id="blog">
                <div class="flex items-center gap-3 mb-10">
                    <div class="h-px flex-1 bg-gray-300"></div>
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Artikel Terbaru</p>
                    <div class="h-px flex-1 bg-gray-300"></div>
                </div>
                @include('components.blog', ['posts' => $latestPosts])
            </div>
        </div>
    </div>
</section>

{{-- 6. TENTANG KAMI --}}
<section id="about" class="py-16 bg-gray-50 scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center gap-3 mb-12">
            <div class="h-px w-12 bg-gray-300"></div>
            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Tentang Kami</p>
            <div class="h-px w-12 bg-gray-300"></div>
        </div>
        @include('components.about', ['about' => $about])
    </div>
</section>

{{-- 7. LOKASI & CTA --}}
<section id="contact" class="py-16 bg-white scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-px flex-1 bg-gray-300"></div>
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Lokasi Kami</p>
                    <div class="h-px flex-1 bg-gray-300"></div>
                </div>
                <div class="rounded-2xl overflow-hidden border border-gray-200 mb-4" style="height:200px">
                    <iframe src="https://maps.google.com/maps?q={{ urlencode($settings['address'] ?? 'Bandung') }}&output=embed"
                            width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"
                            title="Lokasi Shoe Workshop"></iframe>
                </div>
                <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5">
                    <p class="font-bold text-gray-900 mb-1">Shoe Workshop</p>
                    <p class="text-sm text-gray-500 mb-4">{{ $settings['address'] ?? 'Bandung, Jawa Barat' }}</p>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="font-semibold text-gray-800 mb-0.5">Senin – Sabtu</p>
                            <p class="text-gray-500">09.00 – 19.00</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 mb-0.5">Minggu</p>
                            <p class="text-gray-500">10.00 – 17.00</p>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.cta', ['cta' => $cta])
        </div>
    </div>
</section>

{{-- FOOTER --}}
@include('components.footer', ['settings' => $settings])

@endsection