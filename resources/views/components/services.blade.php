{{-- Services: stacked sticky cards. Each card = Before/After slider + category info + 2 sub-services --}}
<div class="relative z-10 flex flex-col gap-6 lg:gap-0 pb-4">
    @foreach($services as $catIndex => $cat)
    @php
        $catServices = $cat->services->sortBy('order')->values();
        $featuredService = $catServices->first(fn($s) => $s->is_preview) ?? $catServices->first();
        $subServices = $catServices->take(2);
        $stackTop = 6 + ($catIndex * 1.25); // rem – each card peeks below the previous one
    @endphp
    <div class="lg:sticky lg:top-[var(--stack-top)] lg:mb-10" style="--stack-top: {{ $stackTop }}rem; z-index: {{ $catIndex + 1 }};">
        <article class="relative group overflow-hidden rounded-[1.75rem] sm:rounded-[2.25rem] bg-white/95 backdrop-blur-xl border border-[#22AF85]/25 shadow-[0_-12px_40px_rgba(28,28,23,0.07),0_24px_60px_rgba(34,175,133,0.12)] p-4 sm:p-6 lg:p-8">
            {{-- Decorative orbs --}}
            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-gradient-to-br from-[#22AF85]/20 to-[#FFC232]/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-gradient-to-tr from-[#FFC232]/15 to-[#22AF85]/15 blur-3xl pointer-events-none"></div>

            {{-- Big step number --}}
            <span class="absolute top-2 right-5 sm:right-8 text-[4rem] sm:text-[8rem] lg:text-[9rem] leading-none font-black text-[#22AF85]/[0.07] select-none pointer-events-none">
                {{ str_pad($catIndex + 1, 2, '0', STR_PAD_LEFT) }}
            </span>

            <div class="relative flex flex-col gap-4 sm:gap-6 lg:gap-7">
                {{-- Header --}}
                <div class="flex flex-col gap-3 pr-16 sm:pr-28">
                    <span class="w-12 h-1.5 rounded-full bg-gradient-to-r from-[#22AF85] to-[#FFC232]"></span>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1c1c17] leading-tight">{{ $cat->name }}</h3>
                    @if($cat->subtitle)
                        <p class="text-gray-500 text-sm sm:text-base leading-relaxed font-medium max-w-xl">{{ \Illuminate\Support\Str::limit($cat->subtitle, 140) }}</p>
                    @endif
                </div>

                {{-- Balanced row: 2 sub-services + main result, all equal size --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($subServices as $sub)
                    <div class="hidden sm:flex flex-col gap-3 p-3 rounded-2xl bg-white/80 border border-gray-100 shadow-sm hover:border-[#22AF85]/40 hover:shadow-md transition-all duration-300">
                        <div class="w-full aspect-[4/3] rounded-xl overflow-hidden relative ring-1 ring-gray-100">
                            <x-ba-slider :service="$sub" :catIndex="$catIndex" class="w-full h-full" />
                        </div>
                        <div class="min-w-0 px-1 pb-1">
                            <p class="text-[10px] font-bold tracking-[0.2em] text-[#22AF85] uppercase mb-1">Jasa Turunan</p>
                            <p class="font-bold text-[#1c1c17] text-sm leading-snug">{{ $sub->name }}</p>
                            @if($sub->subtitle_teknis)
                                <p class="text-gray-500 text-xs leading-relaxed mt-0.5">{{ \Illuminate\Support\Str::limit($sub->subtitle_teknis, 60) }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    {{-- Main result --}}
                    <div class="flex flex-col gap-3 p-3 rounded-2xl bg-gradient-to-br from-[#22AF85]/10 to-[#FFC232]/10 border border-[#22AF85]/20 shadow-sm sm:col-span-2 lg:col-span-1">
                        <div class="w-full aspect-[4/3] rounded-xl overflow-hidden relative ring-1 ring-white shadow-md">
                            @if($featuredService)
                                <x-ba-slider :service="$featuredService" :catIndex="$catIndex" class="w-full h-full" />
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <span class="font-mono text-[10px]">NO IMAGE</span>
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0 px-1 pb-1 flex flex-col gap-2">
                            <div>
                                <p class="text-[10px] font-bold tracking-[0.2em] text-[#22AF85] uppercase mb-1">Hasil {{ $cat->name }}</p>
                                @if($catServices->count() > $subServices->count())
                                    <p class="text-gray-500 text-xs">+{{ $catServices->count() - $subServices->count() }} jasa lainnya</p>
                                @endif
                            </div>

                            {{-- Mobile: sub-services as a compact list instead of full sliders --}}
                            @if($subServices->isNotEmpty())
                            <ul class="sm:hidden flex flex-col gap-2">
                                @foreach($subServices as $sub)
                                <li class="flex items-center gap-3 p-2 rounded-xl bg-white/80 border border-gray-100">
                                    <div class="w-12 h-12 shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                        @if($sub->image_after)
                                            <img src="{{ asset($sub->image_after) }}" alt="{{ $sub->name }}" class="w-full h-full object-cover" loading="lazy" onerror="this.style.opacity='0'">
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-[#1c1c17] text-sm leading-snug truncate">{{ $sub->name }}</p>
                                        @if($sub->subtitle_teknis)
                                            <p class="text-gray-500 text-xs leading-snug line-clamp-1">{{ $sub->subtitle_teknis }}</p>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            <a href="{{ route('layanan.index') }}#{{ \Illuminate\Support\Str::slug($cat->name) }}"
                               class="inline-flex items-center gap-2 self-start text-[#22AF85] font-bold text-sm hover:gap-3 transition-all">
                                Lihat detail layanan
                                <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
    @endforeach
</div>

{{-- Link --}}
<div class="mt-12 text-center">
    <a href="{{ route('layanan.index') }}"
       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group">
        Lihat semua layanan
        <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
    </a>
</div>