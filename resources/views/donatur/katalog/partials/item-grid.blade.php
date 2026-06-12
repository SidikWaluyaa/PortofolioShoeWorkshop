@if($items->isEmpty())
    <div class="col-span-full py-16 text-center space-y-4 bg-white rounded-2xl border border-gray-100">
        <span class="material-symbols-outlined !text-[64px] text-gray-300">search_off</span>
        <h3 class="text-xl font-bold text-gray-900">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada barang donasi yang cocok dengan pencarian, kategori, atau kondisi yang Anda pilih.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($items as $item)
            @php
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
                    'foto_detail_urls' => $item->foto_detail_urls ?? []
                ]);
            @endphp
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full border border-gray-100">
                <!-- Image -->
                <div class="relative group cursor-pointer overflow-hidden bg-gray-50" @click="openDetail({{ $itemJson }})">
                    <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-52 object-cover hover:scale-105 transition-transform duration-500 bg-gray-50">
                    
                    <!-- Kondisi Badge -->
                    @php
                        $condLabels = [
                            'baru' => '🆕 Baru',
                            'seperti_baru' => '✨ Seperti Baru',
                            'sudah_diperbaiki' => '🔧 Refurbished'
                        ];
                    @endphp
                    <span class="absolute bottom-3 right-3 px-2.5 py-1 bg-black/60 backdrop-blur-sm text-white text-[10px] font-bold rounded-lg shadow-sm">
                        {{ $condLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                    </span>
                </div>

                <!-- Body -->
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <!-- Status -->
                            @if($item->status === 'tersedia')
                                <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-full font-bold text-[10px] tracking-wide uppercase">Tersedia</span>
                            @else
                                <span class="px-2.5 py-0.5 bg-gray-100 text-gray-500 border border-gray-200 rounded-full font-bold text-[10px] tracking-wide uppercase">Disalurkan</span>
                            @endif

                            <!-- Kategori -->
                            <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">
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
                        <h4 class="font-bold text-base text-gray-900 mb-1 leading-snug line-clamp-1 hover:text-emerald-600 transition-colors cursor-pointer" title="{{ $item->nama }}" @click="openDetail({{ $itemJson }})">
                            {{ $item->nama }}
                        </h4>

                        <!-- Brand -->
                        <p class="text-emerald-600 font-bold text-xs mb-3">
                            Brand: {{ $item->brand ?? 'Generic' }}
                        </p>

                        <!-- Description -->
                        <p class="text-xs text-gray-500 font-normal line-clamp-2 mb-4 leading-relaxed">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi barang.' }}
                        </p>
                    </div>

                    <!-- Button Action -->
                    <div class="pt-2">
                        <button @click="openDetail({{ $itemJson }})" class="w-full py-3 {{ $item->status === 'tersedia' ? 'bg-emerald-500 text-white hover:bg-emerald-600 active:scale-[0.98]' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }} rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2" {{ $item->status !== 'tersedia' ? 'disabled' : '' }}>
                            <span class="material-symbols-outlined !text-[16px]">visibility</span>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($items->hasPages())
        <div class="mt-8 flex justify-center donatur-catalog-pagination">
            {{ $items->links() }}
        </div>
    @endif
@endif
