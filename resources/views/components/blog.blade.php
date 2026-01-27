<section id="blog" class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <p class="text-[#22AF85] font-bold tracking-[0.2em] uppercase text-sm mb-4">The Cobbler's Journal</p>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight">Berita & <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#22AF85] to-[#FFC232]">Tips Terbaru</span></h2>
            </div>
            <a href="{{ route('blog.index') }}" class="group inline-flex items-center gap-2 text-gray-900 font-bold hover:text-[#22AF85] transition-colors duration-300">
                Lihat Semua Artikel
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-green-100/50 transition-all duration-500 flex flex-col h-full">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        @if($post->thumbnail)
                            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 bg-white/90 backdrop-blur-md text-[#22AF85] text-xs font-bold rounded-full shadow-sm">{{ $post->category }}</span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 text-xs text-gray-400 font-medium mb-4">
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-[#22AF85] transition-colors line-clamp-2">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6 flex-grow">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        
                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#22AF85] group/link">
                            BACA SELENGKAPNYA
                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 italic">Belum ada artikel yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
