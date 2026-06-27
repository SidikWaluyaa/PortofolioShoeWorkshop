@extends('layouts.main')

@section('seo_title', 'Artikel & Tips Sepatu | Shoe Workshop Bandung')
@section('seo_description', 'Tips perawatan sepatu, edukasi reparasi, dan cerita dari Shoe Workshop Bandung. Pelajari cara merawat sepatu agar tahan lama.')
@section('seo_keywords', 'tips sepatu bandung, cara merawat sepatu, tips cuci sepatu, cara repaint sepatu, artikel sepatu bandung')
@section('canonical', route('blog.index'))

@section('content')
{{-- Navbar --}}
@include('layouts.navigation-public')

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