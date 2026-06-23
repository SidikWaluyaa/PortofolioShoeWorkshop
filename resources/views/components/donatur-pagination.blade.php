@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full py-6 mt-8 border-t border-gray-200/60">
        <!-- Left: Showing Info -->
        <div class="text-sm font-semibold text-gray-500">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>

        <!-- Right: Pagination Buttons -->
        <nav class="flex items-center gap-1.5" role="navigation" aria-label="Pagination Navigation">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="pagination-link w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-55 active:scale-95 transition-all text-sm font-bold shadow-sm"
                   aria-label="Previous Page">
                    <span class="material-symbols-outlined !text-[20px]">chevron_left</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-10 h-10 flex items-center justify-center text-gray-400 font-semibold select-none">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-emerald-500 text-white text-sm font-extrabold shadow-md shadow-emerald-500/20 select-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               class="pagination-link w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 active:scale-95 transition-all text-sm font-bold shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="pagination-link w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-55 active:scale-95 transition-all text-sm font-bold shadow-sm"
                   aria-label="Next Page">
                    <span class="material-symbols-outlined !text-[20px]">chevron_right</span>
                </a>
            @endif
        </nav>
    </div>
@endif
