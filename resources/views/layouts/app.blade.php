<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | {{ config('app.name', 'Shoe Workshop') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- PWA Settings -->
    <link rel="manifest" href="/manifest.webmanifest">
    <meta name="theme-color" content="#22AF85">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.png') }}">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('Service Worker registered with scope:', reg.scope))
                    .catch(err => console.log('Service Worker registration failed:', err));
            });
        }
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { font-size: 14px; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ 
    sidebarOpen: false, 
    searchQuery: '', 
    openSections: {
        'Utama': {{ request()->routeIs('admin.dashboard*') || request()->routeIs('admin.settings*') ? 'true' : 'false' }},
        'Transaksi & Reparasi': {{ request()->routeIs('admin.tracking*') || request()->routeIs('admin.warranty-claims*') || request()->routeIs('admin.donations*') ? 'true' : 'false' }},
        'Loyalitas Donatur': {{ request()->routeIs('admin.checkins*') || request()->routeIs('admin.rewards*') ? 'true' : 'false' }},
        'Konten Website': {{ request()->routeIs('admin.hero*') || request()->routeIs('admin.services*') || request()->routeIs('admin.projects*') || request()->routeIs('admin.reviews*') || request()->routeIs('admin.workflow*') || request()->routeIs('admin.posts*') || request()->routeIs('admin.trust*') || request()->routeIs('admin.about*') || request()->routeIs('admin.cta*') ? 'true' : 'false' }}
    }
}">
<div class="flex h-screen overflow-hidden">

    {{-- Overlay mobile --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 lg:hidden bg-gray-600/75"
         @click="sidebarOpen = false"></div>

    {{-- SIDEBAR --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform lg:translate-x-0 lg:static transition duration-300 ease-in-out flex flex-col h-screen">

        {{-- Logo --}}
        <div class="h-20 flex items-center px-6 border-b border-gray-100 flex-shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <x-application-logo class="h-12 w-auto" />
                <div class="leading-none">
                    <p class="font-black text-sm text-gray-900">SHOE</p>
                    <p class="font-black text-sm text-[#22AF85]">WORKSHOP</p>
                </div>
            </a>
        </div>

        {{-- Search Input --}}
        <div class="px-4 pt-4 pb-2 flex-shrink-0">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Cari menu..." 
                       class="w-full pl-9 pr-8 py-2 bg-gray-50 hover:bg-gray-100/70 focus:bg-white text-xs font-semibold text-gray-700 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition-all" />
                <button x-show="searchQuery" @click="searchQuery = ''" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-3.5 h-3.5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Nav --}}
        <nav id="admin-sidebar-nav" class="flex-1 overflow-y-auto py-3 px-4 space-y-3" onscroll="sessionStorage.setItem('admin-sidebar-scroll', this.scrollTop)">
            @php
            $sections = [
                [
                    'title' => 'Utama',
                    'dot_color' => 'bg-indigo-500',
                    'active_bg' => 'bg-indigo-600 text-white shadow-sm shadow-indigo-600/20',
                    'icon_active' => 'text-white',
                    'icon_inactive' => 'text-indigo-400 group-hover:text-indigo-500',
                    'links' => [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'admin.settings.index', 'label' => 'Pengaturan API', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                    ]
                ],
                [
                    'title' => 'Transaksi & Reparasi',
                    'dot_color' => 'bg-emerald-500',
                    'active_bg' => 'bg-[#22AF85] text-white shadow-sm shadow-[#22AF85]/20',
                    'icon_active' => 'text-white',
                    'icon_inactive' => 'text-emerald-400 group-hover:text-emerald-500',
                    'links' => [
                        ['route' => 'admin.tracking.index', 'label' => 'Lacak Order', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                        ['route' => 'admin.warranty-claims.index', 'label' => 'Klaim Garansi', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['route' => 'admin.donations.index', 'label' => 'Donasi Sepatu', 'icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'],
                    ]
                ],
                [
                    'title' => 'Loyalitas Donatur',
                    'dot_color' => 'bg-amber-500',
                    'active_bg' => 'bg-amber-500 text-white shadow-sm shadow-amber-500/20',
                    'icon_active' => 'text-white',
                    'icon_inactive' => 'text-amber-400 group-hover:text-amber-500',
                    'links' => [
                        ['route' => 'admin.checkins.index', 'label' => 'Check-In Harian', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['route' => 'admin.rewards.index', 'label' => 'Daftar Rewards', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ]
                ],
                [
                    'title' => 'Konten Website',
                    'dot_color' => 'bg-purple-500',
                    'active_bg' => 'bg-purple-600 text-white shadow-sm shadow-purple-600/20',
                    'icon_active' => 'text-white',
                    'icon_inactive' => 'text-purple-400 group-hover:text-purple-500',
                    'links' => [
                        ['route' => 'admin.hero.index', 'label' => 'Hero Banner', 'icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z'],
                        ['route' => 'admin.services.index', 'label' => 'Daftar Layanan', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['route' => 'admin.projects.index', 'label' => 'Portfolio Layanan', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['route' => 'admin.reviews.index', 'label' => 'Review Pelanggan', 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                        ['route' => 'admin.workflow.index', 'label' => 'Langkah Kerja', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['route' => 'admin.posts.index', 'label' => 'Artikel & Berita', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z'],
                        ['route' => 'admin.trust.index', 'label' => 'Trust Strip', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['route' => 'admin.about.index', 'label' => 'Tentang Kami', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['route' => 'admin.cta.index', 'label' => 'Call to Action', 'icon' => 'M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5'],
                    ]
                ]
            ];
            @endphp

            @foreach($sections as $sec)
                @php
                    $searchString = strtolower(implode(' ', array_column($sec['links'], 'label')));
                @endphp
                <div data-search-terms="{{ $searchString }}"
                     x-show="!searchQuery || $el.dataset.searchTerms.includes(searchQuery.toLowerCase())"
                     class="bg-gray-50/40 border border-gray-100/80 rounded-2xl p-2 transition-all duration-300 hover:bg-gray-50/70 hover:border-gray-200/60 shadow-[0_1px_3px_rgba(0,0,0,0.01)]">
                     
                     {{-- Toggle Button --}}
                     <button @click="openSections['{{ $sec['title'] }}'] = !openSections['{{ $sec['title'] }}']" 
                             class="w-full flex items-center justify-between px-2.5 py-1.5 text-[10px] font-black text-gray-500 uppercase tracking-wider hover:text-gray-800 transition-colors focus:outline-none">
                         <div class="flex items-center gap-2">
                             <span class="w-1.5 h-1.5 rounded-full {{ $sec['dot_color'] }}"></span>
                             <span>{{ $sec['title'] }}</span>
                         </div>
                         <svg class="w-3.5 h-3.5 transform transition-transform duration-200 text-gray-400" 
                              :class="openSections['{{ $sec['title'] }}'] || searchQuery ? 'rotate-180 text-gray-600' : ''" 
                              fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                         </svg>
                     </button>
                     
                     {{-- Links --}}
                     <div x-show="openSections['{{ $sec['title'] }}'] || searchQuery"
                          x-transition:enter="transition ease-out duration-200"
                          x-transition:enter-start="opacity-0 transform -translate-y-1"
                          x-transition:enter-end="opacity-100 transform translate-y-0"
                          class="space-y-0.5 mt-1.5">
                          
                          @foreach($sec['links'] as $link)
                              @php $isActive = request()->routeIs($link['route'] . '*'); @endphp
                              <a href="{{ route($link['route']) }}"
                                 data-label="{{ strtolower($link['label']) }}"
                                 x-show="!searchQuery || $el.dataset.label.includes(searchQuery.toLowerCase())"
                                 class="group flex items-center gap-2.5 px-3 py-2 text-xs font-bold rounded-xl transition-all duration-200 {{ $isActive ? $sec['active_bg'] : 'text-gray-500 hover:text-gray-900 hover:bg-white border border-transparent hover:border-gray-100 hover:shadow-sm' }}">
                                  <svg class="w-4 h-4 flex-shrink-0 {{ $isActive ? $sec['icon_active'] : $sec['icon_inactive'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                                  </svg>
                                  <span>{{ $link['label'] }}</span>
                              </a>
                          @endforeach
                     </div>
                </div>
            @endforeach
        </nav>

        {{-- User --}}
        <div class="p-4 border-t border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3 mb-3">
                @if(Auth::user()->avatar_path)
                    <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-xl object-cover border border-gray-200">
                @else
                    <div class="w-10 h-10 rounded-xl bg-[#22AF85] flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-center gap-2 py-2 mb-2 text-xs font-bold text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Edit Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 text-xs font-bold text-red-500 bg-red-50 hover:bg-red-100 border border-red-100 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Mobile topbar --}}
        <div class="lg:hidden h-16 flex items-center justify-between px-4 bg-white border-b border-gray-200 flex-shrink-0">
            <button @click="sidebarOpen = true" class="p-2 text-gray-500 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="font-black text-sm text-gray-900">ADMIN PANEL</span>
            <div class="w-10"></div>
        </div>

        {{-- Page content --}}
        <main class="flex-1 overflow-y-auto p-6 sm:p-8 lg:p-10">
            @isset($header)
            <div class="mb-8">
                <h1 class="text-2xl font-black text-gray-900">{{ $header }}</h1>
            </div>
            @endisset
            {{ $slot }}
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarNav = document.getElementById('admin-sidebar-nav');
        if (sidebarNav) {
            const scrollPos = sessionStorage.getItem('admin-sidebar-scroll');
            if (scrollPos) {
                sidebarNav.scrollTop = scrollPos;
            }
        }
    });
</script>
</body>
</html>