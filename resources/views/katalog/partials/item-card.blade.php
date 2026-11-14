{{-- Adoption catalog card (catalog grid and home page). Kept short for phones: photo, brand, name, size, fitness, service fee.
     Note: no element here may carry the bare `grid` class, the catalog's "load more" script appends the children of the first `.grid`. --}}
@php
    $available = $item->status === 'tersedia';
    $tag = $available ? 'a' : 'div';
@endphp
<{{ $tag }} @if($available) href="{{ route('katalog.show', $item->id) }}" @endif
    class="group flex flex-col h-full w-full bg-white rounded-2xl overflow-hidden border border-aa-beige/80 shadow-sm {{ $available ? 'hover:shadow-lg hover:-translate-y-0.5 active:scale-[0.99]' : 'opacity-80' }} transition-all duration-300">
    <div class="relative aspect-square overflow-hidden bg-gray-100">
        <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" loading="lazy"
             class="w-full h-full object-cover {{ $available ? 'group-hover:scale-105' : 'grayscale' }} transition-transform duration-500">
        @if($item->score_kelayakan)
            <span class="absolute top-2 left-2 inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-white/95 text-aa-green text-[10px] sm:text-[11px] font-bold shadow-sm">
                <span class="material-symbols-outlined fill-1 !text-[12px] text-amber-400">star</span>{{ $item->score_kelayakan }}% layak
            </span>
        @endif
        @unless($available)
            <span class="absolute inset-x-0 bottom-0 py-1.5 bg-aa-ink/75 text-white text-[11px] font-bold text-center">Sudah diadopsi</span>
        @endunless
    </div>

    <div class="flex flex-col flex-grow p-3 sm:p-4">
        <p class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-aa-neutral truncate">{{ $item->brand ?: 'Tanpa merek' }}</p>
        <h4 class="mt-0.5 font-bold text-sm sm:text-base text-aa-ink leading-snug line-clamp-2 {{ $available ? 'group-hover:text-aa-green' : '' }} transition-colors" title="{{ $item->nama }}">{{ $item->nama }}</h4>
        @if($item->ukuran)
            <span class="mt-2 self-start px-2 py-0.5 rounded-md bg-aa-beige/60 text-aa-green text-[11px] sm:text-xs font-bold">Ukuran {{ $item->ukuran }}</span>
        @endif

        @if($item->jasa_harga_total > 0)
            <div class="mt-auto pt-3">
                <p class="text-[10px] sm:text-[11px] text-aa-neutral">Biaya jasa reparasi</p>
                <p class="text-sm sm:text-base font-extrabold text-aa-green">{{ $item->jasa_harga_formatted }}</p>
            </div>
        @endif
    </div>
</{{ $tag }}>
