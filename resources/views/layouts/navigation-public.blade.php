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
        <div class="hidden lg:flex items-center gap-6 xl:gap-8">
            <a href="{{ route('home') }}" class="text-sm font-semibold {{ request()->routeIs('home') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Beranda</a>
            <a href="{{ route('layanan.index') }}" class="text-sm font-semibold {{ request()->routeIs('layanan.index') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Layanan</a>
            <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold {{ request()->routeIs('portfolio.index') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Portfolio</a>
            <a href="{{ route('blog.index') }}" class="text-sm font-semibold {{ request()->routeIs('blog.*') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Artikel</a>
            <a href="{{ route('katalog.index') }}" class="text-sm font-semibold {{ request()->routeIs('katalog.*') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Donasi</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold {{ request()->routeIs('tracking.index') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Tracking</a>
            <a href="{{ route('warranty.index') }}" class="text-sm font-semibold {{ request()->routeIs('warranty.index') ? 'text-[#22AF85] active-nav-border' : 'text-gray-500 hover:text-[#22AF85] transition-colors' }}">Garansi</a>
        </div>

        {{-- CTA & Account Buttons --}}
        <div class="hidden md:flex items-center gap-4">
            <div class="relative" x-data="{ openAccount: false }">
                <button @click="openAccount = !openAccount" @click.outside="openAccount = false"
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#22AF85]/20 whitespace-nowrap">
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
                     class="absolute right-0 mt-2 w-56 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-1.5 overflow-hidden"
                     style="display: none;">
                    @auth
                        {{-- User Header Info --}}
                        <div class="px-4 py-2 border-b border-gray-50 bg-gray-50/50">
                            <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>

                        {{-- Donatur Sidebar Menu Links inside Dropdown --}}
                        <div class="py-1">
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-[#22AF85] hover:bg-[#22AF85]/10 transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">admin_panel_settings</span>
                                    Panel Admin
                                </a>
                            @else
                                <a href="{{ route('donatur.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">dashboard</span>
                                    Dashboard Donatur
                                </a>
                                <a href="{{ route('donatur.reparation-history.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">history</span>
                                    Riwayat Reparasi
                                </a>
                                <a href="{{ route('donatur.donations.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">inventory_2</span>
                                    Donasi Saya
                                </a>
                                <a href="{{ route('donatur.katalog.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">apps</span>
                                    Katalog Donasi
                                </a>
                                <a href="{{ route('donatur.checkin.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">event_available</span>
                                    Daily Check-In
                                </a>
                                <a href="{{ route('donatur.rewards.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">card_membership</span>
                                    Rewards Saya
                                </a>
                            @endif
                        </div>

                        <div class="border-t border-gray-50 py-1">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#22AF85]/10 hover:text-[#22AF85] transition-all">
                                <span class="material-symbols-outlined !text-[18px]">person</span>
                                Edit Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2.5 w-full text-left px-4 py-2.5 text-xs font-bold text-red-600 hover:bg-red-50 transition-all">
                                    <span class="material-symbols-outlined !text-[18px]">logout</span>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
                            <span class="material-symbols-outlined !text-[18px]">login</span>
                            Masuk (Login)
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#22AF85]">
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
        <a href="{{ route('home') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Beranda</a>
        <a href="{{ route('layanan.index') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('layanan.index') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Layanan</a>
        <a href="{{ route('portfolio.index') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('portfolio.index') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Portfolio</a>
        <a href="{{ route('blog.index') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('blog.*') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Artikel</a>
        <a href="{{ route('katalog.index') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('katalog.*') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Donasi</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('tracking.index') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Tracking</a>
        <a href="{{ route('warranty.index') }}" @click="open=false" class="block px-3 py-2 text-sm font-semibold {{ request()->routeIs('warranty.index') ? 'text-[#22AF85] bg-green-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">Garansi</a>
        
        <div class="border-t border-gray-100 pt-3 mt-3">
            @auth
                <div class="px-3 py-1.5 border-b border-gray-50 bg-gray-50/50 rounded-lg mb-2">
                    <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                </div>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-[#22AF85] hover:bg-[#22AF85]/10 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">admin_panel_settings</span>
                        Panel Admin
                    </a>
                @else
                    <a href="{{ route('donatur.dashboard') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">dashboard</span>
                        Dashboard Donatur
                    </a>
                    <a href="{{ route('donatur.reparation-history.index') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">history</span>
                        Riwayat Reparasi
                    </a>
                    <a href="{{ route('donatur.donations.index') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">inventory_2</span>
                        Donasi Saya
                    </a>
                    <a href="{{ route('donatur.katalog.index') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">apps</span>
                        Katalog Donasi
                    </a>
                    <a href="{{ route('donatur.checkin.index') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">event_available</span>
                        Daily Check-In
                    </a>
                    <a href="{{ route('donatur.rewards.index') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                        <span class="material-symbols-outlined !text-[20px]">card_membership</span>
                        Rewards Saya
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" @click="open=false" class="flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">
                    <span class="material-symbols-outlined !text-[20px]">person</span>
                    Edit Profil
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
</header>
