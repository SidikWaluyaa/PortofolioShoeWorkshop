{{-- Klinik Sepatu: pick a shoe problem, get the article that explains it plus the services that fix it --}}
@php
    $posts = collect($posts);
    $byKeluhan = $posts->whereNotNull('keluhan')->groupBy('keluhan');
    // Problems that already have an article come first
    $keluhanList = collect(\App\Models\Post::KELUHAN)
        ->sortBy(fn ($item, $key) => $byKeluhan->has($key) ? 0 : 1);
    $selected = $keluhanList->keys()->first();
    $categoryNames = \App\Models\LayananCategory::pluck('name', 'slug');
    $waNumber = preg_replace('/\D/', '', $globalSettings['whatsapp_number'] ?? '');
    $otherReads = $posts->whereNull('keluhan')->take(3);
@endphp

<div x-data="{ pick: '{{ $selected }}' }" class="max-w-5xl mx-auto">

    {{-- Problem picker --}}
    <div class="-mx-4 px-4 sm:mx-0 sm:px-0 flex sm:flex-wrap sm:justify-center gap-2.5 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
         role="group" aria-label="Pilih keluhan sepatu">
        @foreach($keluhanList as $key => $item)
            <button type="button"
                    @click="pick = '{{ $key }}'; $el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' })"
                    :aria-pressed="(pick === '{{ $key }}').toString()"
                    :class="pick === '{{ $key }}'
                        ? 'bg-[#188060] border-[#188060] text-white'
                        : 'bg-white border-gray-300 text-[#1c1c17] hover:border-[#188060] hover:text-[#188060]'"
                    class="shrink-0 px-4 py-2.5 rounded-full border text-sm font-semibold transition-colors">
                {{ $item['label'] }}
            </button>
        @endforeach
    </div>

    {{-- One answer panel per problem --}}
    @foreach($keluhanList as $key => $item)
        @php
            $articles = $byKeluhan->get($key, collect());
            $main = $articles->first();
            $more = $articles->slice(1);
            $waLink = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode('Halo Shoe Workshop, sepatu saya ' . strtolower($item['label']) . '. Boleh dibantu cek?');
        @endphp
        <div x-show="pick === '{{ $key }}'" @if($key !== $selected) x-cloak @endif
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mt-6 bg-white border border-gray-200 rounded-2xl overflow-hidden">

            <div class="grid {{ $main?->thumbnail_url ? 'md:grid-cols-[2fr_3fr]' : '' }}">
                @if($main?->thumbnail_url)
                    <a href="{{ route('blog.show', $main->slug) }}" class="relative block aspect-[16/10] md:aspect-auto md:min-h-[300px] bg-gray-100 overflow-hidden" tabindex="-1" aria-hidden="true">
                        <img src="{{ $main->thumbnail_url }}" alt="" loading="lazy" class="absolute inset-0 w-full h-full object-cover">
                    </a>
                @endif

                <div class="p-6 sm:p-8 flex flex-col">
                    <p class="text-sm text-gray-500">Keluhan: <span class="font-semibold text-[#1c1c17]">{{ $item['label'] }}</span></p>

                    @if($main)
                        <h3 class="mt-3 text-xl sm:text-2xl font-extrabold text-[#1c1c17] leading-snug">
                            <a href="{{ route('blog.show', $main->slug) }}" class="hover:text-[#188060] transition-colors">{{ $main->title }}</a>
                        </h3>
                        <p class="mt-3 text-gray-600 leading-relaxed">{{ Str::limit($main->plain_text, 170) }}</p>
                        <p class="mt-3 text-sm text-gray-400">{{ $main->reading_minutes }} menit baca</p>
                    @else
                        <h3 class="mt-3 text-xl sm:text-2xl font-extrabold text-[#1c1c17] leading-snug">Kirim fotonya, kami bantu cek</h3>
                        <p class="mt-3 text-gray-600 leading-relaxed">Artikel untuk keluhan ini sedang kami siapkan. Sementara itu, kirim foto sepatumu lewat WhatsApp dan tim kami akan menjelaskan penyebab serta perbaikan yang cocok.</p>
                    @endif

                    <div class="mt-6 flex flex-wrap gap-3">
                        @if($main)
                            <a href="{{ route('blog.show', $main->slug) }}"
                               class="inline-flex items-center px-5 py-3 rounded-xl bg-[#188060] hover:bg-[#146b50] text-white text-sm font-bold transition-colors">
                                Baca artikel
                            </a>
                        @endif
                        @if($waNumber)
                            <a href="{{ $waLink }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold transition-colors {{ $main ? 'border border-gray-300 text-[#1c1c17] hover:border-[#188060] hover:text-[#188060]' : 'bg-[#188060] hover:bg-[#146b50] text-white' }}">
                                Tanya via WhatsApp
                            </a>
                        @endif
                    </div>

                    <div class="mt-auto pt-6">
                        <p class="pt-5 border-t border-gray-100 text-sm text-gray-500">
                            Layanan terkait:
                            @foreach($item['layanan'] as $slug)
                                <a href="{{ route('layanan.index') }}#{{ $slug }}" class="font-semibold text-[#188060] hover:underline underline-offset-4">{{ $categoryNames[$slug] ?? Str::headline($slug) }}</a>@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        @if($more->isNotEmpty())
                            <p class="mt-2 text-sm text-gray-500">
                                Baca juga:
                                @foreach($more as $article)
                                    <a href="{{ route('blog.show', $article->slug) }}" class="text-[#1c1c17] hover:text-[#188060] underline decoration-gray-300 underline-offset-4">{{ $article->title }}</a>@if(!$loop->last); @endif
                                @endforeach
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Articles not tied to a problem (QC, shipping, warranty, ...) --}}
    <div class="mt-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        @if($otherReads->isNotEmpty())
            <div>
                <p class="text-sm font-semibold text-[#1c1c17] mb-2">Bacaan lain</p>
                <ul class="space-y-1.5">
                    @foreach($otherReads as $article)
                        <li><a href="{{ route('blog.show', $article->slug) }}" class="text-gray-600 hover:text-[#188060] underline decoration-gray-300 underline-offset-4">{{ $article->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{ route('blog.index') }}" class="shrink-0 sm:ml-auto text-sm font-bold text-[#188060] hover:underline underline-offset-4">Lihat semua artikel</a>
    </div>
</div>
