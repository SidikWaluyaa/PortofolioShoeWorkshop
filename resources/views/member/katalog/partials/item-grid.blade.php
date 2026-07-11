@if($items->isEmpty())
    <div class="col-span-full py-16 text-center space-y-4 bg-white rounded-2xl border border-gray-100">
        <span class="material-symbols-outlined !text-[64px] text-gray-300">search_off</span>
        <h3 class="text-xl font-bold text-gray-900">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada barang donasi yang cocok dengan pencarian, kategori, atau kondisi yang Anda pilih.</p>
    </div>
@else
    <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-6">
        @foreach($items as $item)
            @php
                $isQuotaFull = $item->status === 'tersedia' && $item->isQuotaFull();
                $itemJson = json_encode([
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'brand' => $item->brand ?? 'Generic',
                    'kategori' => ucfirst($item->kategori),
                    'kondisi' => $item->kondisi,
                    'status' => $item->status,
                    'deskripsi' => $item->deskripsi ?? 'Tidak ada deskripsi.',
                    'ukuran' => $item->ukuran ?? 'Semua Ukuran',
                    'foto_utama_url' => $item->foto_utama_url,
                    'foto_detail_urls' => $item->foto_detail_urls ?? [],
                    'is_quota_full' => $isQuotaFull,
                    'pending_requests_count' => $item->pending_requests_count
                ]);
            @endphp
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md group hover:-translate-y-0.5 transition-all duration-300 flex flex-col h-full border border-gray-100 {{ $isQuotaFull ? 'filter grayscale contrast-75 brightness-95 opacity-90' : '' }}">
                <!-- Image -->
                <div class="relative overflow-hidden cursor-pointer bg-gray-55" @click="openDetail({{ $itemJson }})">
                    <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-32 sm:h-52 object-cover group-hover:scale-105 transition-transform duration-500 bg-gray-55">
                    
                    <!-- Kondisi Badge -->
                    @php
                        $condLabels = [
                            'baru' => 'Baru',
                            'seperti_baru' => 'Seperti Baru',
                            'sudah_diperbaiki' => 'Refurbished'
                        ];
                    @endphp
                    <span class="absolute bottom-2 right-2 px-1.5 sm:px-2.5 py-0.5 sm:py-1 bg-black/60 backdrop-blur-sm text-white text-[9px] sm:text-[10px] font-bold rounded-lg shadow-sm">
                        {{ $condLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                    </span>
                </div>
 
                <!-- Body -->
                <div class="p-3 sm:p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center gap-2 mb-3">
                            <!-- Status -->
                            @if($item->status === 'tersedia')
                                @if($isQuotaFull)
                                    <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-100 rounded-full font-bold text-[9px] sm:text-[10px] tracking-wide uppercase">Dalam Pengajuan (5/5)</span>
                                @else
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-full font-bold text-[9px] sm:text-[10px] tracking-wide uppercase">Tersedia ({{ $item->pending_requests_count }}/5)</span>
                                @endif
                            @else
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-500 border border-gray-200 rounded-full font-bold text-[9px] sm:text-[10px] tracking-wide uppercase">Disalurkan</span>
                            @endif

                            <!-- Kategori -->
                            <span class="text-[9px] sm:text-[10px] font-extrabold text-gray-400 uppercase tracking-wider shrink-0">
                                @if($item->kategori === 'sepatu')
                                    Sepatu
                                @elseif($item->kategori === 'tas')
                                    Tas
                                @elseif($item->kategori === 'topi')
                                    Topi
                                @else
                                    {{ $item->kategori }}
                                @endif
                            </span>
                        </div>

                        <!-- Title -->
                        <h4 class="font-bold text-sm sm:text-base text-gray-900 mb-1 leading-snug line-clamp-2 min-h-[2.25rem] sm:min-h-[3rem] hover:text-emerald-600 transition-colors cursor-pointer" title="{{ $item->nama }}" @click="openDetail({{ $itemJson }})">
                            {{ $item->nama }}
                        </h4>

                        <!-- Brand & Quota -->
                        <div class="flex justify-between items-center gap-2 mb-3">
                            <p class="text-emerald-600 font-bold text-[10px] sm:text-xs">
                                Brand: {{ $item->brand ?? 'Generic' }}
                            </p>
                            @if($item->status === 'tersedia')
                                <span class="px-1.5 py-0.5 {{ $isQuotaFull ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }} rounded text-[9px] sm:text-[10px] font-extrabold shrink-0 flex items-center gap-1" title="Kuota Pengajuan">
                                    <span class="material-symbols-outlined !text-[12px] sm:text-[14px] {{ $isQuotaFull ? 'text-red-500' : 'text-amber-500' }}">groups</span>
                                    Kuota: {{ $item->pending_requests_count }}/5
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="text-xs text-gray-500 font-normal line-clamp-2 mb-4 leading-relaxed min-h-[2rem] sm:min-h-[2.5rem]">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi barang.' }}
                        </p>

                        @if($isQuotaFull)
                            <p class="text-[10px] sm:text-xs font-bold text-amber-700 bg-amber-50/50 border border-amber-100 rounded-xl p-2.5 mb-3 flex items-center gap-1.5 leading-normal">
                                <span class="material-symbols-outlined !text-[14px] sm:text-[16px] text-amber-600 shrink-0">info</span>
                                Item donasi ini dalam proses pengajuan.
                            </p>
                        @endif
                    </div>

                    <!-- Button Action -->
                    <div class="pt-2">
                        @if($item->status === 'tersedia')
                            @if($isQuotaFull)
                                <button @click="openDetail({{ $itemJson }})" class="w-full py-2 sm:py-3 bg-amber-500 hover:bg-amber-600 text-white active:scale-[0.98] rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined !text-[16px]">visibility</span>
                                    Lihat Detail
                                </button>
                            @else
                                <button @click="openDetail({{ $itemJson }})" class="w-full py-2 sm:py-3 bg-emerald-500 text-white hover:bg-emerald-600 active:scale-[0.98] rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined !text-[16px]">visibility</span>
                                    Lihat Detail
                                </button>
                            @endif
                        @else
                            <button class="w-full py-2 sm:py-3 bg-gray-100 text-gray-400 cursor-not-allowed rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2" disabled>
                                Sudah Disalurkan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Load More Section -->
    <div id="load-more-container" class="mt-8 flex flex-col items-center gap-4 w-full py-6 border-t border-gray-150">
        <p class="text-sm font-semibold text-gray-500">
            Showing <span class="font-extrabold text-gray-900" id="current-count-display">{{ $items->lastItem() }}</span> of <span class="font-extrabold text-gray-900">{{ $items->total() }}</span> results
        </p>
        @if($items->hasMorePages())
            <button id="load-more-btn" data-next-page="{{ $items->currentPage() + 1 }}"
                    class="px-8 py-3.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/10 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined !text-[18px]">expand_more</span>
                Muat Lebih Banyak
            </button>
        @endif
    </div>
@endif

