@if($items->isEmpty())
    <div class="col-span-full py-16 text-center space-y-4">
        <span class="material-symbols-outlined !text-[64px] text-gray-300">search_off</span>
        <h3 class="text-xl font-bold text-[#191c1d]">Barang Tidak Ditemukan</h3>
        <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada barang donasi yang cocok dengan pencarian, kategori, atau kondisi yang Anda pilih.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($items as $item)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 flex flex-col h-full border border-gray-200">
                <!-- Image -->
                <div class="relative">
                    @if($item->status === 'tersedia')
                        <a href="{{ route('katalog.show', $item->id) }}">
                            <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-56 object-cover bg-gray-50 hover:opacity-95 transition-opacity">
                        </a>
                    @else
                        <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-56 object-cover bg-gray-50">
                    @endif
                    
                    <!-- Kondisi Badge (Bottom-Right on image for extra premium feel) -->
                    @php
                        $condLabels = [
                            'baru' => '🆕 Baru',
                            'seperti_baru' => '✨ Seperti Baru',
                            'sudah_diperbaiki' => '🔧 Refurbished'
                        ];
                    @endphp
                    <span class="absolute bottom-2 right-2 px-2 py-0.5 bg-black/60 backdrop-blur-sm text-white text-[10px] font-bold rounded">
                        {{ $condLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                    </span>
                </div>

                <!-- Body -->
                <div class="p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <!-- Status -->
                            @if($item->status === 'tersedia')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full font-bold text-[11px]">Tersedia</span>
                            @else
                                <span class="px-3 py-1 bg-[#e1e3e4] text-[#3d4947] rounded-full font-bold text-[11px]">Sudah Disalurkan</span>
                            @endif

                            <!-- Kategori -->
                            <span class="text-[11px] font-bold text-[#6d7a77] uppercase tracking-wider">
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
                        <h4 class="font-bold text-lg text-[#191c1d] mb-1 leading-snug line-clamp-1" title="{{ $item->nama }}">
                            @if($item->status === 'tersedia')
                                <a href="{{ route('katalog.show', $item->id) }}" class="hover:text-[#22AF85] transition-colors">
                                    {{ $item->nama }}
                                </a>
                            @else
                                {{ $item->nama }}
                            @endif
                        </h4>

                        <!-- Brand -->
                        <p class="text-[#22AF85] font-bold text-xs mb-2">
                            Brand: {{ $item->brand ?? 'Generic' }}
                        </p>

                        <!-- Description -->
                        <p class="text-sm text-[#3d4947] font-normal line-clamp-2 mb-4">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi barang.' }}
                        </p>
                    </div>

                    <!-- Button Action -->
                    <div class="pt-2">
                        @if($item->status === 'tersedia')
                            <a href="{{ route('katalog.show', $item->id) }}" class="w-full py-3 bg-[#22AF85] text-white rounded-lg font-bold text-sm hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined !text-[18px]">visibility</span>
                                Lihat Detail
                            </a>
                        @else
                            <button class="w-full py-3 bg-[#d9dadb] text-[#3d4947] rounded-lg font-bold text-sm cursor-not-allowed flex items-center justify-center gap-1.5" disabled>
                                Sudah Disalurkan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($items->hasPages())
        <div class="mt-12 flex justify-center custom-pagination">
            {{ $items->links() }}
        </div>
    @endif
@endif
