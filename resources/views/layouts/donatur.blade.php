<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Donatur | {{ config('app.name', 'Shoe Workshop') }}</title>
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
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { font-size: 14px; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ sidebarOpen: false }">
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
            <a href="{{ route('donatur.dashboard') }}" class="flex items-center gap-3">
                <x-application-logo class="w-10 h-10 object-contain rounded-xl" />
                <div class="leading-none">
                    <p class="font-extrabold text-sm text-gray-900">SEPATU</p>
                    <p class="font-extrabold text-sm text-emerald-600">DONASI</p>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav id="donatur-sidebar-nav" class="flex-1 overflow-y-auto py-6 px-4 space-y-1" onscroll="sessionStorage.setItem('donatur-sidebar-scroll', this.scrollTop)">
            @php
            $links = [
                ['route' => 'donatur.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'donatur.reparation-history.index', 'label' => 'Riwayat Reparasi', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0'],
                ['route' => 'donatur.donations.index', 'label' => 'Donasi Saya', 'icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'],
                ['route' => 'donatur.checkin.index', 'label' => 'Daily Check-In', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['route' => 'donatur.rewards.index', 'label' => 'Rewards', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
            @endphp

            @foreach($links as $link)
            @php $isActive = request()->routeIs($link['route'] . '*'); @endphp
            <a href="{{ route($link['route']) }}"
               class="group flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 {{ $isActive ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/25' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $isActive ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                </svg>
                {{ $link['label'] }}
            </a>
            @endforeach
        </nav>

        {{-- User --}}
        <div class="p-4 border-t border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3 mb-3">
                @if(Auth::user()->avatar_path)
                    <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-xl object-cover border border-gray-200">
                @else
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
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
            <span class="font-extrabold text-sm text-gray-900">DONATUR PANEL</span>
            <div class="w-10"></div>
        </div>

        {{-- Page content --}}
        <main class="flex-1 overflow-y-auto p-6 sm:p-8 lg:p-10">
            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif

            @isset($header)
            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $header }}</h1>
            </div>
            @endisset
            {{ $slot }}
        </main>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarNav = document.getElementById('donatur-sidebar-nav');
        if (sidebarNav) {
            const scrollPos = sessionStorage.getItem('donatur-sidebar-scroll');
            if (scrollPos) {
                sidebarNav.scrollTop = scrollPos;
            }
        }
    });
</script>
</body>
</html>
