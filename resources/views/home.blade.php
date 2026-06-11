@extends('layouts.main')
@section('seo_title', ($settings['site_title'] ?? 'Shoe Workshop') . ' | Reparasi Sepatu Profesional')
@section('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit. Garansi kualitas, proses cepat.')
@section('seo_keywords', 'reparasi sepatu bandung, cuci sepatu, repaint sepatu, sol lepas, shoe repair bandung')
@section('content')

{{-- NAVBAR --}}
<header x-data="{ open: false }" class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="flex flex-col leading-tight">
                <span class="text-lg font-extrabold text-[#1c1c17]">Shoe Workshop</span>
                <div class="flex h-1 w-full">
                    <div class="w-1/2 bg-[#22AF85]"></div>
                    <div class="w-1/2 bg-[#FFC232]"></div>
                </div>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Beranda</a>
            <a href="#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
            <a href="#portfolio" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Portfolio</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Tracking</a>
            <a href="{{ route('warranty.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Garansi</a>
        </div>

        {{-- CTA & Account Buttons --}}
        <div class="hidden md:flex items-center gap-4">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
               class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FFC232] text-[#1c1c17] text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#FFC232]/20">
                <span class="material-symbols-outlined !text-[20px]">chat</span>
                Konsultasi via WhatsApp
            </a>

            <div class="relative" x-data="{ openAccount: false }">
                <button @click="openAccount = !openAccount" @click.outside="openAccount = false"
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#22AF85]/20">
                    <span class="material-symbols-outlined !text-[20px]">account_circle</span>
                    @auth
                        <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                    @else
                        Akun
                    @endauth
                    <span class="material-symbols-outlined !text-[16px] transition-transform duration-200" :class="openAccount ? 'rotate-180' : ''">keyboard_arrow_down</span>
                </button>
                
                <div x-show="openAccount"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-1.5 overflow-hidden"
                     style="display: none;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                            <span class="material-symbols-outlined !text-[18px]">dashboard</span>
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <span class="material-symbols-outlined !text-[18px]">logout</span>
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                            <span class="material-symbols-outlined !text-[18px]">login</span>
                            Masuk (Login)
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                                <span class="material-symbols-outlined !text-[18px]">person_add</span>
                                Daftar (Register)
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        {{-- Hamburger --}}
        <button @click="open=!open" class="lg:hidden p-2 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden bg-white border-t border-gray-100 px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"         @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-[#22AF85] bg-green-50 rounded-lg">Beranda</a>
        <a href="#layanan"                     @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Layanan</a>
        <a href="#portfolio"                   @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Portfolio</a>
        <a href="{{ route('blog.index') }}"    @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Artikel</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Tracking</a>
        <a href="{{ route('warranty.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Garansi</a>
        <div class="pt-2 space-y-2">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#FFC232] text-[#1c1c17] text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined !text-[20px]">chat</span>
                Konsultasi via WhatsApp
            </a>
            <div class="border-t border-gray-100 pt-2 mt-2">
                @auth
                    <p class="px-3 py-1.5 text-xs font-semibold text-gray-400">Akun: {{ Auth::user()->name }}</p>
                    <a href="{{ route('dashboard') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">dashboard</span>
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50 rounded-lg">
                            <span class="material-symbols-outlined !text-[20px]">logout</span>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">login</span>
                        Masuk (Login)
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                            <span class="material-symbols-outlined !text-[20px]">person_add</span>
                            Daftar (Register)
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</header>

<main class="pt-20">

{{-- 1. HERO --}}
@include('components.hero', ['hero' => $hero])

{{-- 2. LAYANAN --}}
<section id="layanan" class="py-20 sm:py-24 px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto scroll-mt-20">
    <div class="text-center mb-14 space-y-4">
        <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Layanan Kami</p>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17]">Solusi Terbaik Untuk Sepatu Anda</h2>
    </div>
    @include('components.services', ['services' => $services])
</section>

{{-- 3. PORTFOLIO --}}
<section id="portfolio" class="py-20 sm:py-24 border-y border-gray-200 scroll-mt-20">
    <div class="px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto">
        <div class="text-center mb-14 space-y-4">
            <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Portfolio</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17]">Hasil Restorasi Kami</h2>
        </div>
        @include('components.portfolio', ['portfolio' => $portfolio])
    </div>
</section>

{{-- 4. CARA KERJA --}}
<section id="workflow" class="py-20 sm:py-24 px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto scroll-mt-20">
    @include('components.workflow', ['workflow' => $workflow])
</section>

{{-- 5. REVIEW --}}
<section id="review" class="py-20 sm:py-24 bg-gray-50 border-y border-gray-200 scroll-mt-20" x-data="reviewCarousel()">
    <div class="px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16">
            <div class="max-w-[600px] space-y-4">
                <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase">Testimoni</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17] leading-tight">Apa Kata Mereka Tentang Kami?</h2>
            </div>
            <div class="flex gap-4">
                <button @click="prev()" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-white active:scale-95 transition-all text-[#1c1c17]">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button @click="next()" class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-white active:scale-95 transition-all text-[#1c1c17]">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
        @include('components.reviews', ['reviews' => $reviews])
    </div>
</section>

{{-- 6. ARTIKEL --}}
<section id="blog" class="py-20 sm:py-24 px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto scroll-mt-20">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17]">Tips & Edukasi Perawatan</h2>
        <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-[#22AF85] hover:underline flex items-center gap-1">
            Semua Artikel <span class="material-symbols-outlined">north_east</span>
        </a>
    </div>
    @include('components.blog', ['posts' => $latestPosts])
</section>

{{-- 7. TENTANG KAMI --}}
<section id="about" class="scroll-mt-20">
    @include('components.about', ['about' => $about])
</section>

{{-- 8. LOKASI --}}
<section id="kontak" class="py-20 sm:py-24 px-4 sm:px-6 lg:px-16 max-w-7xl mx-auto scroll-mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
        {{-- Left: Contact Info --}}
        <div class="space-y-8">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17]">Kunjungi Workshop Kami</h2>
            <div class="space-y-6">
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-[#22AF85]">location_on</span>
                    <div>
                        <h4 class="font-semibold text-[#1c1c17]">Alamat Pusat</h4>
                        <p class="text-gray-500">{{ $settings['address'] ?? 'Bandung, Jawa Barat' }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-[#22AF85]">schedule</span>
                    <div>
                        <h4 class="font-semibold text-[#1c1c17]">Jam Operasional</h4>
                        <p class="text-gray-500">Senin - Minggu: 09.00 - 17.00 WIB</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-[#22AF85]">phone_iphone</span>
                    <div>
                        <h4 class="font-semibold text-[#1c1c17]">Kontak</h4>
                        @if(!empty($settings['whatsapp_number']))
                        <p class="text-gray-500">{{ $settings['whatsapp_number'] }}</p>
                        @endif
                        @if(!empty($settings['email']))
                        <p class="text-gray-500">{{ $settings['email'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex gap-4 pt-4">
                @if(!empty($settings['instagram_link']))
                <a href="{{ $settings['instagram_link'] }}" target="_blank" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-[#22AF85] hover:text-white hover:border-[#22AF85] transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                </a>
                @endif
                @if(!empty($settings['tiktok_link']))
                <a href="{{ $settings['tiktok_link'] }}" target="_blank" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-[#22AF85] hover:text-white hover:border-[#22AF85] transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34l.04-8.46a8.16 8.16 0 004.79 1.53V5.01a4.85 4.85 0 01-1.06-.32z"/></svg>
                </a>
                @endif
                @if(!empty($settings['facebook_link']))
                <a href="{{ $settings['facebook_link'] }}" target="_blank" class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-[#22AF85] hover:text-white hover:border-[#22AF85] transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                </a>
                @endif
            </div>
        </div>
        {{-- Right: Map --}}
        <div class="rounded-3xl overflow-hidden shadow-2xl border-4 sm:border-8 border-white bg-gray-100 min-h-[400px] flex flex-col">
            <div class="flex-grow relative min-h-[300px]">
                <iframe src="https://maps.google.com/maps?q={{ urlencode($settings['address'] ?? 'Bandung') }}&output=embed"
                        width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"
                        title="Lokasi Shoe Workshop" class="absolute inset-0 w-full h-full"></iframe>
            </div>
            <div class="bg-white p-4 sm:p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 border-t border-gray-200">
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
</section>

{{-- 9. CTA FINAL --}}
@include('components.cta', ['cta' => $cta])

</main>

{{-- FOOTER --}}
@include('components.footer', ['settings' => $settings])

@endsection