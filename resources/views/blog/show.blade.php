@extends('layouts.main')

@section('seo_title', $post->title . ' | Shoe Workshop')
@section('seo_description', Str::limit(strip_tags($post->content), 155))
@section('og_title', $post->title)
@section('og_description', Str::limit(strip_tags($post->content), 155))

@section('content')

{{-- Navbar --}}
<header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-12 w-auto" />
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-gray-600 hover:text-[#22AF85] transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Semua Artikel
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-lg hover:bg-[#178a67] transition-colors">
                    Konsultasi
                </a>
            </div>
        </div>
    </div>
</header>

<article>
    {{-- Hero Header --}}
    <div class="bg-[#f5f0e8] pt-16 pb-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-3 mb-5 text-xs text-gray-400 font-medium">
                <span class="w-8 h-px bg-gray-300"></span>
                <span class="uppercase tracking-widest">{{ $post->category }}</span>
                <span class="w-8 h-px bg-gray-300"></span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 leading-[1.1] mb-6">
                {{ $post->title }}
            </h1>
            <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                <span>{{ ($post->published_at ?? $post->created_at)->format('d M Y') }}</span>
                <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} menit baca</span>
            </div>
        </div>
    </div>

    {{-- Thumbnail --}}
    @if($post->thumbnail)
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-1 py-8">
        <div class="aspect-[21/9] rounded-2xl overflow-hidden shadow-xl">
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
    </div>
    @endif

    {{-- Content --}}
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="prose prose-lg prose-green max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>

        {{-- CTA --}}
        <div class="mt-14 p-8 bg-[#f5f0e8] rounded-2xl">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                <div>
                    <h4 class="text-lg font-bold text-gray-900 mb-1">Ada Masalah dengan Sepatumu?</h4>
                    <p class="text-gray-500 text-sm">Konsultasikan gratis — kirim foto via WhatsApp.</p>
                </div>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                   class="flex-shrink-0 inline-flex items-center gap-2.5 px-6 py-3.5 bg-[#22AF85] text-white font-bold text-sm rounded-xl hover:bg-[#178a67] transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Hubungi WhatsApp
                </a>
            </div>
        </div>
    </div>
</article>

{{-- Related posts --}}
@if($relatedPosts->isNotEmpty())
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-8">
            <div class="h-px flex-1 bg-gray-200"></div>
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Artikel Terkait</h3>
            <div class="h-px flex-1 bg-gray-200"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedPosts as $related)
            <article class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all flex flex-col">
                <div class="relative aspect-video overflow-hidden bg-gray-50">
                    @if($related->thumbnail)
                    <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @endif
                </div>
                <div class="p-5 flex-grow">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">{{ $related->category }}</p>
                    <h4 class="font-bold text-gray-900 group-hover:text-[#22AF85] mb-3 line-clamp-2 transition-colors text-sm leading-snug">
                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                    </h4>
                    <a href="{{ route('blog.show', $related->slug) }}" class="text-xs font-bold text-[#22AF85] inline-flex items-center gap-1 group/link">
                        Baca
                        <svg class="w-3 h-3 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('components.footer', ['settings' => $settings])

@endsection