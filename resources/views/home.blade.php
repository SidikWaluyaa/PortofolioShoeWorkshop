@extends('layouts.main')
@section('seo_title', ($settings['site_title'] ?? 'Shoe Workshop') . ' | Reparasi Sepatu Profesional')
@section('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit. Garansi kualitas, proses cepat.')
@section('seo_keywords', 'reparasi sepatu bandung, cuci sepatu, repaint sepatu, sol lepas, shoe repair bandung')
@section('content')

@include('layouts.navigation-public')

<main class="pt-20">
    <div class="relative overflow-hidden bg-home-grid w-full">
        <!-- Glowing background blobs (Aurora style) -->
        <div class="absolute top-0 right-[-10%] w-[550px] h-[550px] rounded-full bg-[#22AF85]/15 blur-[110px] pointer-events-none z-0"></div>
        <div class="absolute top-[25%] left-[-15%] w-[650px] h-[650px] rounded-full bg-[#FFC232]/8 blur-[130px] pointer-events-none z-0"></div>
        <div class="absolute bottom-[35%] right-[-5%] w-[600px] h-[600px] rounded-full bg-[#22AF85]/8 blur-[110px] pointer-events-none z-0"></div>
        <div class="absolute bottom-[10%] left-[5%] w-[550px] h-[550px] rounded-full bg-[#FFC232]/12 blur-[110px] pointer-events-none z-0"></div>

{{-- 1. HERO --}}
@include('components.hero', ['heroes' => $heroes])

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
<section id="review" class="py-20 sm:py-24 bg-gray-50/60 backdrop-blur-md border-y border-gray-200 scroll-mt-20 relative z-10" x-data="reviewCarousel()">
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

    </div>
</main>

{{-- FOOTER --}}
@include('components.footer', ['settings' => $settings])

@guest
<!-- Floating Top Banner -->
<div x-data="registerBanner()"
     x-init="initBanner()"
     x-show="isOpen"
     class="fixed top-24 left-1/2 -translate-x-1/2 z-[49] w-[calc(100%-2rem)] max-w-4xl"
     style="display: none;"
     x-cloak>
    
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 -translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-8 scale-95"
         class="bg-[#1c1c17]/95 backdrop-blur-md text-white px-5 py-3.5 rounded-2xl shadow-2xl border border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
        
        <!-- Text & Icon -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#22AF85] flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-[#22AF85]/20 animate-pulse-soft">
                <span class="material-symbols-outlined !text-[20px] fill-1">volunteer_activism</span>
            </div>
            <div class="text-center md:text-left">
                <p class="text-sm font-extrabold tracking-tight">Mulai Berbagi Kebaikan Hari Ini! 🎉</p>
                <p class="text-xs text-gray-400 mt-0.5 font-medium">Daftar sebagai Donatur untuk mendonasikan sepatu bekas Anda & lacak riwayat reparasinya secara real-time.</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3 w-full md:w-auto justify-center md:justify-end">
            <a href="{{ route('register') }}" 
               class="px-5 py-2 bg-[#22AF85] hover:bg-[#1f9d77] text-white text-xs font-extrabold rounded-xl transition-all shadow-md shadow-[#22AF85]/10 whitespace-nowrap active:scale-95">
                Daftar Sekarang
            </a>
            <button @click="closeBanner()" class="p-2 text-gray-400 hover:text-white transition-colors rounded-lg hover:bg-white/5">
                <span class="material-symbols-outlined !text-[20px]">close</span>
            </button>
        </div>
    </div>
</div>

<script>
function registerBanner() {
    return {
        isOpen: false,
        initBanner() {
            const dismissed = sessionStorage.getItem('register_banner_dismissed');
            if (!dismissed) {
                setTimeout(() => {
                    this.isOpen = true;
                }, 800); // Smooth premium delay
            }
        },
        closeBanner() {
            this.isOpen = false;
            sessionStorage.setItem('register_banner_dismissed', 'true');
        }
    }
}
</script>

<style>
@keyframes pulse-soft {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
.animate-pulse-soft {
    animation: pulse-soft 2s infinite ease-in-out;
}
[x-cloak] { display: none !important; }
</style>
@endguest

@endsection