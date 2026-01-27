@extends('layouts.main')

@section('content')
    <!-- Simple Navbar for Blog Detail -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('home') }}" class="relative block">
                        <x-application-logo class="h-20 w-auto" />
                    </a>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-[#22AF85] text-sm font-bold transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <article class="py-24">
        <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-[#22AF85] text-xs font-bold rounded-full border border-green-100 mb-6 uppercase tracking-wider">
                {{ $post->category }}
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-[1.1] mb-8">{{ $post->title }}</h1>
            
            <div class="flex items-center justify-center gap-6 text-sm text-gray-500 font-medium">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ ceil(str_word_count(strip_tags($post->content)) / 200) }} menit baca
                </div>
            </div>
        </header>

        @if($post->thumbnail)
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
                <div class="aspect-[21/9] rounded-[2rem] overflow-hidden shadow-2xl shadow-green-100/30">
                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            </div>
        @endif

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg prose-green max-w-none text-gray-600 leading-relaxed space-y-6">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="mt-20 pt-10 border-t border-gray-100">
                <div class="p-8 bg-gray-50 rounded-3xl flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Ada Masalah dengan Sepatumu?</h4>
                        <p class="text-gray-500">Konsultasikan gratis dengan ahli kami sekarang juga.</p>
                    </div>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '#' }}" class="inline-flex items-center gap-3 px-8 py-4 bg-[#FFC232] text-gray-900 font-bold rounded-2xl shadow-xl shadow-yellow-200 hover:shadow-2xl hover:-translate-y-1 transition-all">
                        Hubungi WhatsApp
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </article>

    @if($relatedPosts->isNotEmpty())
        <section class="py-24 bg-gray-50/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-2xl font-black text-gray-900 mb-12">Artikel Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $related)
                        <article class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all flex flex-col h-full text-sm">
                            <div class="relative aspect-[16/10] overflow-hidden">
                                @if($related->thumbnail)
                                    <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-6">
                                <h4 class="font-bold text-gray-900 group-hover:text-[#22AF85] mb-2 line-clamp-2">
                                    <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                </h4>
                                <p class="text-gray-500 line-clamp-2 mb-4">
                                    {{ Str::limit(strip_tags($related->content), 80) }}
                                </p>
                                <a href="{{ route('blog.show', $related->slug) }}" class="text-[#22AF85] font-bold inline-flex items-center gap-1 group/link text-xs uppercase tracking-wider">
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
