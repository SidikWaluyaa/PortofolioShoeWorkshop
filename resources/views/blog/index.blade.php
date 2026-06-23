@extends('layouts.main')

@section('seo_title', 'Artikel & Tips Sepatu | Shoe Workshop Bandung')
@section('seo_description', 'Tips perawatan sepatu, edukasi reparasi, dan cerita dari Shoe Workshop Bandung. Pelajari cara merawat sepatu agar tahan lama.')
@section('seo_keywords', 'tips sepatu bandung, cara merawat sepatu, tips cuci sepatu, cara repaint sepatu, artikel sepatu bandung')
@section('canonical', route('blog.index'))

@section('content')
{{-- Navbar --}}
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
            <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Beranda</a>
            <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
            <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Portfolio</a>
            <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Artikel</a>
            <a href="{{ route('katalog.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Donasi</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Tracking</a>
            <a href="{{ route('warranty.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Garansi</a>
        </div>

        {{-- CTA & Account Buttons --}}
        <div class="hidden md:flex items-center gap-4">
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
        <a href="{{ route('home') }}"         @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Beranda</a>
        <a href="{{ route('home') }}#layanan" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Layanan</a>
        <a href="{{ route('portfolio.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Portfolio</a>
        <a href="{{ route('blog.index') }}"    @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-[#22AF85] bg-green-50 rounded-lg">Artikel</a>
        <a href="{{ route('katalog.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Donasi</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Tracking</a>
        <a href="{{ route('warranty.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Garansi</a>
    </div>
</header>

<main class="pt-20">
    {{-- Hero header --}}
    <div class="bg-gradient-to-br from-green-50/60 to-white py-16 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block text-xs font-bold tracking-[0.25em] text-[#22AF85] uppercase mb-3">Blog & Edukasi</span>
            <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Tips & Artikel Sepatu</h1>
            <p class="text-gray-500 max-w-xl mx-auto text-base">Pelajari cara merawat, memperbaiki, dan memaksimalkan usia pakai sepatu kesayanganmu.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-green-100/50 transition-all duration-500 flex flex-col"
                     itemscope itemtype="https://schema.org/BlogPosting">
                <meta itemprop="author" content="Shoe Workshop Bandung">

                <div class="relative aspect-[16/10] overflow-hidden bg-gray-50">
                    @if($post->thumbnail)
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" itemprop="image">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-green-50 to-yellow-50 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1.5 bg-white/90 backdrop-blur-md text-[#22AF85] text-xs font-bold rounded-full shadow-sm">{{ $post->category }}</span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 text-xs text-gray-400 mb-3">
                        <time itemprop="datePublished" datetime="{{ ($post->published_at ?? $post->created_at)->format('Y-m-d') }}">
                            {{ ($post->published_at ?? $post->created_at)->format('d M Y') }}
                        </time>
                        <span>·</span>
                        <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} menit baca</span>
                    </div>
                    <h2 class="text-base font-bold text-gray-900 mb-3 group-hover:text-[#22AF85] transition-colors line-clamp-2" itemprop="headline">
                        <a href="{{ route('blog.show', $post->slug) }}" itemprop="url">{{ $post->title }}</a>
                    </h2>
                    <p class="text-sm text-gray-500 line-clamp-2 mb-5 flex-grow" itemprop="description">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#22AF85] uppercase tracking-wider group/link">
                        Baca Selengkapnya
                        <svg class="w-3.5 h-3.5 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        @if($posts->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
            <p class="text-gray-400">Belum ada artikel.</p>
        </div>
        @endif
    </div>
</main>

@include('components.footer', ['settings' => $settings])
@endsection