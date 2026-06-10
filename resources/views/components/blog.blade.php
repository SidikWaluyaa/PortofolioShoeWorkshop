<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @forelse($posts as $post)
    @php
        $thumbnailUrl = $post->thumbnail;
        if ($thumbnailUrl && !Str::startsWith($thumbnailUrl, ['http://', 'https://'])) {
            $thumbnailUrl = asset('storage/' . $thumbnailUrl);
        }
        if (!$thumbnailUrl) {
            $thumbnailUrl = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800'; // fallback
        }
    @endphp
    <a href="{{ route('blog.show', $post->slug) }}" class="group block">
        <div class="aspect-[16/10] overflow-hidden rounded-xl mb-4 bg-gray-100 shadow-sm border border-gray-100">
            <img src="{{ $thumbnailUrl }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
        <p class="text-[12px] text-[#22AF85] font-bold uppercase mb-2">{{ $post->category ?? 'Tips & Edukasi' }}</p>
        <h3 class="font-semibold text-[#1c1c17] group-hover:text-[#22AF85] transition-colors leading-snug line-clamp-2">
            {{ $post->title }}
        </h3>
        <p class="text-gray-500 text-xs sm:text-sm mt-2 line-clamp-2 leading-relaxed">
            {{ Str::limit(strip_tags($post->content), 100) }}
        </p>
    </a>
    @empty
    <div class="col-span-full text-center py-16 text-gray-400 text-sm">Belum ada artikel.</div>
    @endforelse
</div>