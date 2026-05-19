<div class="space-y-5">
    @forelse($posts as $post)
    <a href="{{ route('blog.show', $post->slug) }}" class="flex items-center gap-4 group">
        <div class="flex-shrink-0 w-20 h-16 rounded-xl overflow-hidden bg-gray-100">
            @if($post->thumbnail)
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            @else
            <div class="w-full h-full bg-gradient-to-br from-amber-50 to-stone-100"></div>
            @endif
        </div>
        <div class="flex-grow min-w-0">
            <p class="font-bold text-gray-900 text-sm group-hover:text-[#22AF85] transition-colors line-clamp-2 leading-snug mb-1">{{ $post->title }}</p>
            <p class="text-xs text-gray-400">{{ ($post->published_at ?? $post->created_at)->format('d M Y') }}</p>
        </div>
    </a>
    @empty
    <p class="text-sm text-gray-400">Belum ada artikel.</p>
    @endforelse

    <div class="pt-2">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-[#22AF85] transition-colors">
            Lihat semua artikel
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</div>