<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50 h-full overflow-hidden" x-data="{ sidebarOpen: false }">
        <div class="flex h-full">
            <!-- Background overlay for mobile sidebar -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-40 lg:hidden bg-gray-600 bg-opacity-75"
                 @click="sidebarOpen = false"></div>

            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                   class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-gray-200 transform lg:translate-x-0 lg:static transition duration-300 ease-in-out flex flex-col shadow-2xl lg:shadow-none h-screen transition-all overflow-hidden">
                
                <!-- Sidebar Header (Stay Top) -->
                <div class="h-24 flex items-center px-8 border-b border-gray-100 flex-shrink-0 bg-white">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 group">
                        <div class="relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-[#22AF85] to-[#FFC232] rounded-full opacity-0 group-hover:opacity-20 blur transition duration-300"></div>
                            <x-application-logo class="relative h-14 w-auto" />
                        </div>
                        <span class="font-black text-xl tracking-tighter text-gray-900">ADMIN <span class="text-[#22AF85]">PANEL</span></span>
                    </a>
                </div>

                <!-- Scrollable Wrapper -->
                <div class="flex-1 flex flex-col overflow-y-auto custom-scrollbar">
                    <!-- Navigation Links -->
                    <nav class="py-8 px-6 space-y-2">
                        @php
                            $links = [
                                ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                                ['route' => 'admin.hero.index', 'label' => 'Hero Banner', 'icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z'],
                                ['route' => 'admin.services.index', 'label' => 'Layanan', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                                ['route' => 'admin.projects.index', 'label' => 'Portfolio', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                ['route' => 'admin.workflow.index', 'label' => 'Workflow', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                                ['route' => 'admin.posts.index', 'label' => 'Artikel Berita', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM12 9H7m5 4H7m8 4h-8'],
                                ['route' => 'admin.trust.index', 'label' => 'Trust Strip', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                ['route' => 'admin.about.index', 'label' => 'Tentang Kami', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['route' => 'admin.cta.index', 'label' => 'Call to Action', 'icon' => 'M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5'],
                                ['route' => 'admin.settings.index', 'label' => 'Settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                            ];
                        @endphp

                        @foreach($links as $link)
                            @php $isActive = request()->routeIs($link['route'] . '*'); @endphp
                            <a href="{{ route($link['route']) }}" 
                               class="group flex items-center px-5 py-3.5 text-sm font-bold rounded-2xl transition-all duration-300 {{ $isActive ? 'bg-[#22AF85] text-white shadow-xl shadow-green-100' : 'text-gray-500 hover:text-[#22AF85] hover:bg-green-50' }}">
                                <div class="h-10 w-10 rounded-xl flex items-center justify-center mr-3 transition-colors {{ $isActive ? 'bg-white/20' : 'bg-gray-50 group-hover:bg-green-100' }}">
                                    <svg class="h-5 w-5 {{ $isActive ? 'text-white' : 'text-gray-400 group-hover:text-[#22AF85]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"></path>
                                    </svg>
                                </div>
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </nav>

                    <!-- User Section (Inside Scroll for Flexibility) -->
                    <div class="mt-auto p-6 border-t border-gray-100 bg-gray-50/50">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-[#22AF85] to-[#1a8a68] flex items-center justify-center text-white font-black text-lg shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-black text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold text-[#22AF85] hover:underline uppercase tracking-widest">Edit Profile</a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 text-xs font-black text-red-500 bg-red-50/50 hover:bg-red-50 border border-red-100 rounded-2xl transition-all duration-300">
                                <svg class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                LOGOUT
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
                <!-- Mobile Toggle bar -->
                <div class="lg:hidden h-20 flex items-center justify-between px-6 bg-white border-b border-gray-100 flex-shrink-0">
                    <button @click="sidebarOpen = true" class="p-3 bg-gray-50 text-gray-500 rounded-2xl hover:text-[#22AF85] hover:bg-green-50 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="flex items-center gap-2">
                        <x-application-logo class="h-10 w-auto" />
                        <span class="font-black text-sm tracking-tighter">ADMIN</span>
                    </div>
                    <div class="w-12"></div> <!-- Spacer -->
                </div>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-6 sm:p-10 lg:p-12 custom-scrollbar scroll-smooth">
                    @isset($header)
                        <div class="mb-10 text-3xl font-black text-gray-900 tracking-tight">
                            {{ $header }}
                        </div>
                    @endisset

                    <div class="max-w-6xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <style>
            .custom-scrollbar::-webkit-scrollbar {
                width: 6px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
                background: transparent;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #e5e7eb;
                border-radius: 10px;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #d1d5db;
            }
        </style>
    </body>
</html>
