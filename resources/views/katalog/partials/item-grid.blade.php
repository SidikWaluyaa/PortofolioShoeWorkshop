@if($items->isEmpty())
    <div class="col-span-full py-16 text-center space-y-4">
        <span class="material-symbols-outlined !text-[64px] text-gray-300">search_off</span>
        <h3 class="text-xl font-bold text-[#191c1d]">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada sepatu yang cocok dengan pencarian, kategori, atau kondisi yang kamu pilih.</p>
    </div>
@else
    <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-5">
        @foreach($items as $item)
            @include('katalog.partials.item-card', ['item' => $item])
        @endforeach
    </div>

    @if($items instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
        <!-- Load More Section -->
        <div id="load-more-container" class="mt-8 flex flex-col items-center gap-4 w-full py-6 border-t border-gray-200/60">
            <p class="text-sm font-semibold text-gray-500">
                Menampilkan <span class="font-extrabold text-[#191c1d]" id="current-count-display">{{ $items->lastItem() }}</span> dari <span class="font-extrabold text-[#191c1d]">{{ $items->total() }}</span> sepatu
            </p>
            @if($items->hasMorePages())
                <button id="load-more-btn" data-next-page="{{ $items->currentPage() + 1 }}"
                        class="px-8 py-3.5 bg-aa-green hover:opacity-90 text-white rounded-xl font-bold text-sm shadow-md shadow-aa-green/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined !text-[18px]">expand_more</span>
                    Muat Lebih Banyak
                </button>
            @endif
        </div>
    @endif
@endif
