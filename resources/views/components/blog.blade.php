@php
$gradients = [
    'from-[#22AF85] to-[#178a67]',
    'from-[#E74C3C] to-[#C0392B]',
    'from-[#3498DB] to-[#2980B9]',
];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($posts as $i => $post)
    <a href="{{ route('blog.show', $post->slug) }}" class="group block">
        <div class="rounded-2xl overflow-hidden bg-gradient-to-br {{ $gradients[$i % 3] }} relative h-52 sm:h-60 flex items-end p-6 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            {{-- Thumbnail overlay --}}
            @if($post->thumbnail)
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:opacity-30 group-hover:scale-105 transition-all duration-500">
            @endif
            {{-- Dark gradient overlay for text readability --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            {{-- Content --}}
            <div class="relative z-10">
                <p class="text-white/60 text-xs font-bold uppercase tracking-wider mb-2">{{ $post->category ?? 'Artikel' }}</p>
                <h3 class="text-white font-black text-base sm:text-lg leading-snug line-clamp-2 group-hover:underline decoration-2 underline-offset-2">{{ $post->title }}</h3>
                <p class="text-white/50 text-xs mt-2">{{ ($post->published_at ?? $post->created_at)->format('d M Y') }}</p>
            </div>
        </div>
    </a>
    @empty
    <div class="col-span-full text-center py-16 text-gray-400 text-sm">Belum ada artikel.</div>
    @endforelse
</div>

{{-- CTA Link --}}
<div class="text-center mt-10 sm:mt-12">
    <a href="{{ route('blog.index') }}"
       class="inline-flex items-center gap-2 px-6 py-3 border-2 border-gray-200 text-sm font-bold text-gray-700 rounded-xl hover:border-[#22AF85] hover:text-[#22AF85] transition-all duration-300 group">
        Lihat Semua Artikel
        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
</div>