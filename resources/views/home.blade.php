@extends('layouts.main')

@section('content')

    <!-- Navbar -->
    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3 group cursor-pointer">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-[#22AF85] to-[#FFC232] rounded-full opacity-0 group-hover:opacity-20 blur transition duration-200"></div>
                        <a href="/" class="relative block">
                            <x-application-logo class="h-20 w-auto transform transition-transform group-hover:scale-105 duration-300" />
                        </a>
                    </div>
                </div>
                <div class="hidden md:ml-8 md:flex md:space-x-8">
                    <a href="#services" class="text-gray-600 hover:text-[#22AF85] px-3 py-2 text-sm font-bold tracking-wide transition-colors duration-200 relative group">
                        Layanan
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#22AF85] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                    </a>
                    <a href="#portfolio" class="text-gray-600 hover:text-[#22AF85] px-3 py-2 text-sm font-bold tracking-wide transition-colors duration-200 relative group">
                        Portfolio
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#22AF85] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                    </a>
                    <a href="#workflow" class="text-gray-600 hover:text-[#22AF85] px-3 py-2 text-sm font-bold tracking-wide transition-colors duration-200 relative group">
                        Cara Kerja
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#22AF85] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                    </a>
                    <a href="#about" class="text-gray-600 hover:text-[#22AF85] px-3 py-2 text-sm font-bold tracking-wide transition-colors duration-200 relative group">
                        Tentang
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#22AF85] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                    </a>
                    <a href="#blog" class="text-gray-600 hover:text-[#22AF85] px-3 py-2 text-sm font-bold tracking-wide transition-colors duration-200 relative group">
                        Artikel
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#22AF85] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="hidden md:inline-flex items-center gap-2 px-6 py-2.5 bg-[#FFC232] text-gray-900 text-sm font-bold rounded-full shadow-lg shadow-yellow-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                        <span>Konsultasi</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-[#22AF85] p-2 hover:bg-green-50 rounded-lg transition-colors">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-white border-b border-gray-100 overflow-hidden"
             @click.away="mobileMenuOpen = false">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="#services" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-bold text-gray-600 hover:text-[#22AF85] hover:bg-green-50 rounded-xl transition-all">Layanan</a>
                <a href="#portfolio" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-bold text-gray-600 hover:text-[#22AF85] hover:bg-green-50 rounded-xl transition-all">Portfolio</a>
                <a href="#workflow" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-bold text-gray-600 hover:text-[#22AF85] hover:bg-green-50 rounded-xl transition-all">Cara Kerja</a>
                <a href="#about" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-bold text-gray-600 hover:text-[#22AF85] hover:bg-green-50 rounded-xl transition-all">Tentang</a>
                <a href="#blog" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-bold text-gray-600 hover:text-[#22AF85] hover:bg-green-50 rounded-xl transition-all">Artikel</a>
                <div class="pt-4 px-4">
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="flex items-center justify-center gap-2 w-full py-4 bg-[#FFC232] text-gray-900 font-bold rounded-2xl shadow-lg">
                        <span>Konsultasi WhatsApp</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white">
        @include('components.hero', ['hero' => $hero])
    </div>

    <!-- Trust Strip -->
    @include('components.trust', ['items' => $trustItems])
    
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-20 sm:py-32">
        <!-- row 1: Services | Portfolio -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 lg:gap-16 mb-24 sm:mb-32">
            <div id="services" class="scroll-mt-32">
                <div class="text-center lg:text-left mb-12 sm:mb-10">
                    <p class="text-[10px] font-black text-[#22AF85] uppercase tracking-[0.3em] mb-4">Our Expertise</p>
                    <h2 class="text-4xl sm:text-4xl font-black text-gray-900 tracking-tighter">Layanan Reparasi</h2>
                </div>
                @include('components.services', ['services' => $services])
            </div>
            <div id="portfolio" class="scroll-mt-32">
                <div class="text-center lg:text-left mb-12 sm:mb-10">
                    <p class="text-[10px] font-black text-[#FFC232] uppercase tracking-[0.3em] mb-4">Proof of Quality</p>
                    <h2 class="text-4xl sm:text-4xl font-black text-gray-900 tracking-tighter">Hasil Pekerjaan</h2>
                </div>
                @include('components.portfolio', ['portfolio' => $portfolio])
            </div>
        </div>

        <!-- row 2: Workflow | About -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 lg:gap-16">
            <div id="workflow" class="scroll-mt-32">
                <div class="text-center lg:text-left mb-12 sm:mb-10">
                    <p class="text-[10px] font-black text-[#22AF85] uppercase tracking-[0.3em] mb-4">Simple Process</p>
                    <h2 class="text-4xl sm:text-4xl font-black text-gray-900 tracking-tighter">Cara Kerja Kami</h2>
                </div>
                @include('components.workflow', ['workflow' => $workflow])
            </div>
            <div id="about" class="scroll-mt-32">
                <div class="text-center lg:text-left mb-12 sm:mb-10">
                    <p class="text-[10px] font-black text-[#FFC232] uppercase tracking-[0.3em] mb-4">Our Legend</p>
                    <h2 class="text-4xl sm:text-4xl font-black text-gray-900 tracking-tighter">Reputasi Kami</h2>
                </div>
                @include('components.about', ['about' => $about])
            </div>
        </div>
    </div>

    @include('components.blog', ['posts' => $latestPosts])

    @include('components.cta', ['cta' => $cta])

    @include('components.footer', ['settings' => $settings])

@endsection
