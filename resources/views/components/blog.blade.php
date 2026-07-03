@if($posts && $posts->isNotEmpty())
    @php
        $postCount = $posts->count();
    @endphp

    <section class="relative" x-data="{
        active: 0,
        total: {{ $postCount }},
        timer: null,
        init() {
            if (this.total > 1) {
                this.timer = window.setInterval(() => {
                    this.active = (this.active + 1) % this.total;
                }, 7000);
            }
        },
        goTo(index) {
            this.active = index;
        }
    }" x-init="init()" x-cloak>
        <div class="relative min-h-[520px] sm:min-h-[560px] lg:min-h-[420px] overflow-hidden">
            @foreach($posts as $index => $post)
            @php
                $thumbnailUrl = $post->thumbnail;
                if ($thumbnailUrl && !Str::startsWith($thumbnailUrl, ['http://', 'https://'])) {
                    $thumbnailUrl = asset('storage/' . $thumbnailUrl);
                }
                if (!$thumbnailUrl) {
                    $thumbnailUrl = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=1200';
                }
            @endphp
            <article
                x-show="active === {{ $index }}"
                x-transition.opacity.duration.600ms
                class="absolute inset-0 flex items-center justify-center px-0 sm:px-4"
                aria-label="Artikel slider {{ $index + 1 }}">
                <a href="{{ route('blog.show', $post->slug) }}"
                   class="group w-full max-w-5xl mx-auto overflow-hidden rounded-[28px] border border-gray-100 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.08)] transition-all duration-500 hover:shadow-[0_24px_70px_rgba(15,23,42,0.12)] flex flex-col lg:flex-row">
                    
                    {{-- Image Container --}}
                    <div class="relative w-full lg:w-[45%] aspect-[16/10] lg:aspect-auto shrink-0 overflow-hidden bg-gray-50">
                        <img src="{{ $thumbnailUrl }}"
                             alt="{{ $post->title }}"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-black/5 to-transparent z-10 pointer-events-none"></div>
                        <div class="absolute left-4 top-4 sm:left-5 sm:top-5 z-20">
                            <span class="inline-flex items-center rounded-full bg-white/90 px-3 py-1.5 text-[11px] font-bold text-[#22AF85] shadow-sm backdrop-blur-md">
                                {{ $post->category ?? 'Tips & Edukasi' }}
                            </span>
                        </div>
                    </div>

                    {{-- Text Container --}}
                    <div class="flex w-full lg:w-[55%] flex-col justify-center px-6 py-8 sm:px-8 sm:py-10 lg:px-12 lg:py-12 text-left self-stretch">
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-4">
                            <time datetime="{{ ($post->published_at ?? $post->created_at)->format('Y-m-d') }}" class="font-medium text-gray-500">
                                {{ ($post->published_at ?? $post->created_at)->format('d M Y') }}
                            </time>
                            <span>·</span>
                            <span class="font-medium text-gray-500">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} menit baca</span>
                        </div>

                            <h3 class="text-xl sm:text-2xl lg:text-[2rem] font-extrabold text-[#1c1c17] leading-tight tracking-tight group-hover:text-[#22AF85] transition-colors">
                                {{ $post->title }}
                            </h3>

                            <p class="mt-4 text-sm sm:text-base text-gray-500 leading-relaxed max-w-2xl">
                                {{ Str::limit(strip_tags($post->content), 145) }}
                            </p>

                            <div class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#22AF85] uppercase tracking-wider">
                                Baca Selengkapnya
                                <span class="material-symbols-outlined !text-[18px] transition-transform duration-300 group-hover:translate-x-1">north_east</span>
                            </div>
                        </div>
                </a>
            </article>
            @endforeach
        </div>

        @if($postCount > 1)
            <div class="mt-8 flex flex-col items-center gap-6">
                {{-- Dots --}}
                <div class="flex items-center justify-center gap-2.5">
                    @foreach($posts as $index => $post)
                        <button
                            @click="goTo({{ $index }})"
                            :class="active === {{ $index }} ? 'w-8 bg-[#22AF85]' : 'w-2.5 bg-gray-300 hover:bg-gray-400'"
                            class="h-2 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20"
                            aria-label="Artikel {{ $index + 1 }} dari {{ $postCount }}: {{ $post->title }}">
                        </button>
                    @endforeach
                </div>
                
                {{-- Lihat Semua Button --}}
                <a href="{{ route('blog.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group mt-4">
                    Lihat Semua Artikel
                    <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        @else
            <div class="mt-8 flex justify-center">
                <a href="{{ route('blog.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group">
                    Lihat Semua Artikel
                    <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        @endif
    </section>
@else
    <div class="text-center py-16 text-gray-400 text-sm">Belum ada artikel.</div>
@endif
