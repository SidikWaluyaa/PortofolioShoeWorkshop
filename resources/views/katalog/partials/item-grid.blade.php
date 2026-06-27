@if($items->isEmpty())
    <div class="col-span-full py-16 text-center space-y-4">
        <span class="material-symbols-outlined !text-[64px] text-gray-300">search_off</span>
        <h3 class="text-xl font-bold text-[#191c1d]">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada barang donasi yang cocok dengan pencarian, kategori, atau kondisi yang Anda pilih.</p>
    </div>
@else
    <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-6">
        @foreach($items as $item)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg group hover:-translate-y-0.5 transition-all duration-300 flex flex-col h-full border border-gray-200/80">
                <!-- Image -->
                <div class="relative overflow-hidden">
                    @if($item->status === 'tersedia')
                        <a href="{{ route('katalog.show', $item->id) }}">
                            <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-32 sm:h-52 md:h-56 object-cover bg-gray-55 group-hover:scale-105 transition-transform duration-500">
                        </a>
                    @else
                        <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-32 sm:h-52 md:h-56 object-cover bg-gray-55">
                    @endif
                    
                    <!-- Kondisi Badge -->
                    @php
                        $condLabels = [
                            'baru' => '🆕 Baru',
                            'seperti_baru' => '✨ Seperti Baru',
                            'sudah_diperbaiki' => '🔧 Refurbished'
                        ];
                    @endphp
                    <span class="absolute bottom-2 right-2 px-1.5 sm:px-2 py-0.5 bg-black/60 backdrop-blur-sm text-white text-[9px] sm:text-[10px] font-bold rounded">
                        {{ $condLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                    </span>

                    <!-- Score Kelayakan Badge -->
                    <!-- Score Kelayakan Badge -->
                    @if($item->score_kelayakan)
                        <span class="absolute top-2 left-2 px-2 py-1 bg-white/90 backdrop-blur-sm border border-gray-250/30 rounded-lg flex items-center gap-1 shadow-sm select-none">
                            <span class="flex items-center gap-0.5">
                                @php
                                    $stars = round(($item->score_kelayakan / 100) * 5);
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $stars)
                                        <span class="material-symbols-outlined !text-[12px] text-amber-400 fill-1">star</span>
                                    @else
                                        <span class="material-symbols-outlined !text-[12px] text-gray-300">star</span>
                                    @endif
                                @endfor
                            </span>
                            <span class="text-[9px] font-black text-gray-650 ml-0.5">{{ $item->score_kelayakan }}% Layak</span>
                        </span>
                    @endif
                </div>

                <!-- Body -->
                <div class="p-3 sm:p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center gap-2 mb-2">
                            <!-- Status -->
                            @if($item->status === 'tersedia')
                                <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full font-bold text-[9px] sm:text-[10px]">Tersedia</span>
                            @else
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full font-bold text-[9px] sm:text-[10px]">Disalurkan</span>
                            @endif

                            <!-- Kategori -->
                            <span class="text-[9px] sm:text-[10px] font-bold text-[#6d7a77] uppercase tracking-wider shrink-0">
                                @if($item->kategori === 'sepatu')
                                    👞 Sepatu
                                @elseif($item->kategori === 'tas')
                                    🎒 Tas
                                @elseif($item->kategori === 'topi')
                                    🧢 Topi
                                @else
                                    {{ $item->kategori }}
                                @endif
                            </span>
                        </div>

                        <!-- Title -->
                        <h4 class="font-bold text-sm sm:text-base md:text-lg text-[#191c1d] mb-1 leading-snug line-clamp-2 h-9 sm:h-12 hover:text-[#22AF85] transition-colors" title="{{ $item->nama }}">
                            @if($item->status === 'tersedia')
                                <a href="{{ route('katalog.show', $item->id) }}">
                                    {{ $item->nama }}
                                </a>
                            @else
                                {{ $item->nama }}
                            @endif
                        </h4>

                        <!-- Brand & Price -->
                        <div class="flex justify-between items-center gap-2 mb-2">
                            <p class="text-[#22AF85] font-bold text-[10px] sm:text-xs truncate">
                                Brand: {{ $item->brand ?? 'Generic' }}
                            </p>
                            @if($item->jasa_harga_total > 0)
                                <span class="text-[9px] sm:text-xs font-black text-[#191c1d] px-1.5 sm:px-2 py-0.5 bg-gray-100 rounded-lg shrink-0">
                                    {{ $item->jasa_harga_formatted }}
                                </span>
                            @endif
                        </div>

                        <!-- Specifications badges -->
                        <div class="flex flex-wrap gap-1 mb-3">
                            @if($item->jasa_nama)
                                <span class="px-1.5 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-100 rounded text-[9px] sm:text-[10px] font-bold truncate max-w-[120px]" title="{{ $item->jasa_nama }}">
                                    🔧 {{ $item->jasa_nama }}
                                </span>
                            @endif
                            @if($item->berat)
                                <span class="px-1.5 py-0.5 bg-blue-50 text-blue-800 border border-blue-100 rounded text-[9px] sm:text-[10px] font-bold shrink-0" title="Berat">
                                    ⚖️ {{ $item->berat_formatted }}
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-[#3d4947] font-normal line-clamp-2 mb-4 h-8 sm:h-10">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi barang.' }}
                        </p>
                    </div>

                    <!-- Button Action -->
                    <div class="pt-2">
                        @if($item->status === 'tersedia')
                            <a href="{{ route('katalog.show', $item->id) }}" class="w-full py-2 sm:py-3 bg-[#22AF85] text-white rounded-lg font-bold text-xs sm:text-sm hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined !text-[16px] sm:text-[18px]">visibility</span>
                                Lihat Detail
                            </a>
                        @else
                            <button class="w-full py-2 sm:py-3 bg-[#d9dadb] text-[#3d4947] rounded-lg font-bold text-xs sm:text-sm cursor-not-allowed flex items-center justify-center gap-1.5" disabled>
                                Sudah Disalurkan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Load More Section -->
    <div id="load-more-container" class="mt-8 flex flex-col items-center gap-4 w-full py-6 border-t border-gray-200/60">
        <p class="text-sm font-semibold text-gray-500">
            Showing <span class="font-extrabold text-[#191c1d]" id="current-count-display">{{ $items->lastItem() }}</span> of <span class="font-extrabold text-[#191c1d]">{{ $items->total() }}</span> results
        </p>
        @if($items->hasMorePages())
            <button id="load-more-btn" data-next-page="{{ $items->currentPage() + 1 }}"
                    class="px-8 py-3.5 bg-[#22AF85] hover:opacity-90 text-white rounded-xl font-bold text-sm shadow-md shadow-[#22AF85]/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined !text-[18px]">expand_more</span>
                Muat Lebih Banyak
            </button>
        @endif
    </div>
@endif
