<div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg group hover:-translate-y-0.5 transition-all duration-300 flex flex-col h-full border border-gray-200/80 w-full">
    <!-- Image -->
    <div class="relative overflow-hidden">
        @if($item->status === 'tersedia')
            <a href="{{ route('katalog.show', $item->id) }}">
                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-40 sm:h-52 md:h-56 object-cover bg-gray-55 group-hover:scale-105 transition-transform duration-500">
            </a>
        @else
            <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-40 sm:h-52 md:h-56 object-cover bg-gray-55">
        @endif
        
        <!-- Kondisi Badge -->
        @php
            $condLabels = [
                'baru' => 'Baru',
                'seperti_baru' => 'Seperti Baru',
                'sudah_diperbaiki' => 'Refurbished'
            ];
        @endphp
        <span class="absolute bottom-2 right-2 px-1.5 sm:px-2 py-0.5 bg-black/60 backdrop-blur-sm text-white text-[9px] sm:text-[10px] font-bold rounded">
            {{ $condLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
        </span>

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
            <h4 class="font-bold text-sm sm:text-base md:text-lg text-[#191c1d] mb-1 leading-snug line-clamp-2 min-h-[2.25rem] sm:min-h-[3rem] hover:text-[#22AF85] transition-colors" title="{{ $item->nama }}">
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

            <!-- Repairs Summary -->
            <p class="text-[10px] sm:text-xs text-gray-500 leading-relaxed line-clamp-2 mb-3">
                {{ $item->jasa_nama ?: $item->deskripsi }}
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
