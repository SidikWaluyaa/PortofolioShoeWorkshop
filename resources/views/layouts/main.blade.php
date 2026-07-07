<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Shoe Workshop">
    <meta name="robots" content="index, follow">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SSD46ZTTY4"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-SSD46ZTTY4');
    </script>

    {{-- Primary SEO --}}
    <title>@yield('seo_title', config('app.name'))</title>
    <meta name="description" content="@yield('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit profesional. Garansi kualitas, proses cepat.')">
    <meta name="keywords" content="@yield('seo_keywords', 'reparasi sepatu, cuci sepatu, repaint sepatu, shoe repair bandung')">

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical_url', 'https://shoeworkshop.id/')">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Shoe Workshop">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="@yield('seo_title', 'Shoe Workshop | Reparasi Sepatu Profesional')">
    <meta property="og:description" content="@yield('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit profesional. Garansi kualitas, proses cepat.')">
    <meta property="og:url" content="@yield('canonical_url', 'https://shoeworkshop.id/')">
    <meta property="og:image" content="@yield('og_image', 'https://shoeworkshop.id/images/og-default.jpg')">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Shoe Workshop – Reparasi & Perawatan Sepatu Profesional">

    {{-- Twitter / X Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('seo_title', 'Shoe Workshop | Reparasi Sepatu Profesional')">
    <meta name="twitter:description" content="@yield('seo_description', 'Shoe Workshop – jasa reparasi sepatu, cuci, repaint, reglue, jahit profesional. Garansi kualitas, proses cepat.')">
    <meta name="twitter:image" content="@yield('og_image', 'https://shoeworkshop.id/images/og-default.jpg')">

    {{-- PWA Meta Tags --}}
    <link rel="manifest" href="/manifest.webmanifest">
    <meta name="theme-color" content="#22AF85">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Shoe Workshop">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Preconnect to external origins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Critical Font: Preload first weight, then full range --}}
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"></noscript>

    {{-- Material Symbols: non-blocking load --}}
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL,wght@0..1,100..700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL,wght@0..1,100..700&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL,wght@0..1,100..700&display=swap"></noscript>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .fill-1 { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .active-nav-border { position: relative; }
        .active-nav-border::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 24px;
            height: 3px;
            background-color: #22AF85;
            border-radius: 2px;
        }
        .timeline-line { position: relative; }
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            bottom: 0;
            width: 2px;
            background-color: #dee2e6;
            z-index: 0;
        }
        
        /* WhatsApp Floating Widget Animations & Styles */
        .wa-pulse {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background-color: #25D366;
            opacity: 0.4;
            z-index: -1;
            animation: wa-ripple 2s infinite;
        }
        @keyframes wa-ripple {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }
            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }
        .blink-fast {
            animation: blink 1.5s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
    </style>
    @yield('head')

    {{-- Structured Data (JSON-LD) --}}
    @yield('schema_json')
</head>
<body class="antialiased bg-white text-[#1c1c17] overflow-x-hidden">
    @yield('content')

    <!-- Floating WhatsApp Widget -->
    <div x-data="{ open: false, showBadge: false }" 
         x-init="setTimeout(() => { showBadge = true }, 3000)" 
         class="fixed bottom-6 right-6 z-[9999] flex flex-col items-end gap-3"
         x-cloak>
        
        <!-- Chat Popup Card -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-8 scale-90"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-90"
             class="w-[320px] sm:w-[360px] bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-100 overflow-hidden mb-2"
             style="display: none;">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white border border-white/20">
                            <span class="material-symbols-outlined !text-[24px]">support_agent</span>
                        </div>
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-400 border-2 border-emerald-500 rounded-full blink-fast"></span>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm tracking-wide">Customer Service</h4>
                        <p class="text-xs text-emerald-100 flex items-center gap-1 font-medium">
                            <span class="inline-block w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                            Online
                        </p>
                    </div>
                </div>
                <button @click="open = false" aria-label="Tutup chat" class="text-white/80 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/10">
                    <span class="material-symbols-outlined !text-[20px]">close</span>
                </button>
            </div>
            
            <!-- Body / Chat Bubbles -->
            <div class="p-4 bg-gray-50/50 space-y-3 min-h-[100px] flex flex-col justify-end">
                <div class="bg-white text-gray-700 text-sm p-3.5 rounded-2xl rounded-tl-none shadow-sm max-w-[85%] border border-gray-100 self-start">
                    <p class="leading-relaxed font-medium">Halo! Ada yang bisa kami bantu mengenai cuci, reparasi, atau donasi sepatu Anda? 😊</p>
                    <span class="text-[9px] text-gray-400 block text-right mt-1.5 font-medium">Baru saja</span>
                </div>
            </div>
            
            <!-- Footer / CTA -->
            <div class="p-4 bg-white border-t border-gray-100">
                <a href="https://wa.me/{{ $globalSettings['whatsapp_number'] ?? '628123456789' }}?text=Halo%20Admin%20ShoeWorkshop,%20saya%20ingin%20tanya%20mengenai%20layanan%20reparasi/cuci%20sepatu." 
                   target="_blank"
                   @click="open = false; showBadge = false;"
                   class="flex items-center justify-center gap-2.5 w-full py-3 bg-[#25D366] hover:bg-[#20ba5a] text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-[#25D366]/20 active:scale-95">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.73-1.45L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.963C16.59 1.981 14.119.953 11.49.953c-5.447 0-9.875 4.372-9.88 9.802-.002 2.01.524 3.971 1.533 5.727l-.993 3.624 3.737-.968c1.677.925 3.325 1.411 4.76 1.411zm11.758-6.845c-.312-.154-1.848-.901-2.133-.999-.285-.099-.492-.148-.7 1.54-.207.285-.799 1.002-.978 1.201-.18.199-.359.222-.672.068-.312-.154-1.32-.48-2.514-1.531-.93-.819-1.558-1.83-1.74-2.137-.18-.308-.02-.475.137-.629.139-.139.312-.359.469-.539.156-.18.207-.308.312-.513.104-.207.052-.387-.026-.541-.078-.154-.7-1.658-.959-2.27-.253-.599-.51-.517-.7-.527-.183-.009-.393-.01-.602-.01-.209 0-.549.078-.836.387-.286.31-1.096 1.059-1.096 2.581 0 1.522 1.127 2.99 1.282 3.196.156.207 2.219 3.344 5.378 4.679.751.318 1.339.508 1.796.65.758.238 1.448.205 1.992.124.607-.091 1.847-.745 2.108-1.464.262-.719.262-1.336.183-1.464-.078-.129-.285-.207-.597-.362z"/>
                    </svg>
                    Mulai Chat di WhatsApp
                </a>
            </div>
        </div>
        
        <!-- Toggle Button -->
        <button @click="open = !open" 
                aria-label="Hubungi kami via WhatsApp"
                :aria-expanded="open"
                class="w-14 h-14 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-xl shadow-[#25D366]/30 hover:scale-110 active:scale-95 transition-all relative group cursor-pointer">
            
            <!-- Pulse ripple element -->
            <span class="wa-pulse"></span>
            
            <!-- WhatsApp SVG Icon -->
            <svg class="w-7 h-7 fill-current transform group-hover:rotate-12 transition-transform duration-300" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.73-1.45L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.963C16.59 1.981 14.119.953 11.49.953c-5.447 0-9.875 4.372-9.88 9.802-.002 2.01.524 3.971 1.533 5.727l-.993 3.624 3.737-.968c1.677.925 3.325 1.411 4.76 1.411zm11.758-6.845c-.312-.154-1.848-.901-2.133-.999-.285-.099-.492-.148-.7 1.54-.207.285-.799 1.002-.978 1.201-.18.199-.359.222-.672.068-.312-.154-1.32-.48-2.514-1.531-.93-.819-1.558-1.83-1.74-2.137-.18-.308-.02-.475.137-.629.139-.139.312-.359.469-.539.156-.18.207-.308.312-.513.104-.207.052-.387-.026-.541-.078-.154-.7-1.658-.959-2.27-.253-.599-.51-.517-.7-.527-.183-.009-.393-.01-.602-.01-.209 0-.549.078-.836.387-.286.31-1.096 1.059-1.096 2.581 0 1.522 1.127 2.99 1.282 3.196.156.207 2.219 3.344 5.378 4.679.751.318 1.339.508 1.796.65.758.238 1.448.205 1.992.124.607-.091 1.847-.745 2.108-1.464.262-.719.262-1.336.183-1.464-.078-.129-.285-.207-.597-.362z"/>
            </svg>
            
            <!-- Notification Badge -->
            <span x-show="showBadge && !open"
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="scale-0"
                  x-transition:enter-end="scale-100"
                  class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-extrabold rounded-full flex items-center justify-center border-2 border-white shadow-md animate-bounce"
                  style="display: none;">
                1
            </span>
        </button>
    </div>

    @guest
        <!-- Registration Modal Popup -->
        <div x-data="registerModal()" 
             x-init="initModal()" 
             x-show="isOpen"
             @scroll.window="handleScroll"
             class="fixed inset-0 z-[9999] flex items-center justify-center p-4 sm:p-6" 
             style="display: none;" 
             x-cloak>
             
            <!-- Backdrop -->
            <div x-show="isOpen" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer"></div>

            <!-- Modal Card -->
            <div x-show="isOpen" 
                 x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-8"
                 class="relative w-full max-w-[420px] bg-transparent rounded-3xl shadow-[0_30px_60px_rgba(0,0,0,0.4)] overflow-hidden flex flex-col z-10">
                 
                <!-- Close button top right -->
                <button @click="closeModal()" class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center rounded-full bg-black/10 backdrop-blur-md text-white hover:bg-black/30 hover:scale-110 active:scale-95 transition-all z-20">
                    <span class="material-symbols-outlined !text-[20px]">close</span>
                </button>

                <!-- Image Link -->
                <a href="{{ route('register') }}" class="block w-full cursor-pointer hover:scale-[1.01] transition-transform duration-300 relative z-10">
                    <img src="{{ asset('images/pop-up.png') }}" alt="Daftar Sebagai Donatur" class="w-full h-auto object-cover rounded-3xl block">
                </a>
            </div>
        </div>

        <script>
            function registerModal() {
                return {
                    isOpen: false,
                    hasAppeared: false,
                    initModal() {
                        const dismissed = sessionStorage.getItem('register_modal_dismissed');
                        if (dismissed) {
                            this.hasAppeared = true;
                        }
                    },
                    handleScroll() {
                        if (this.hasAppeared) return;
                        
                        // Munculkan popup saat user scroll lebih dari 400px (LCP sangat aman)
                        if (window.scrollY > 400) {
                            this.isOpen = true;
                            this.hasAppeared = true;
                        }
                    },
                    closeModal() {
                        this.isOpen = false;
                        sessionStorage.setItem('register_modal_dismissed', 'true');
                    }
                }
            }
        </script>
    @endguest
</body>
</html>