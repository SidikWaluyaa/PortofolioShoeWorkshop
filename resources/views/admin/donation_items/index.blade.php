<x-app-layout>
    <x-slot name="header">Kelola Barang Katalog Donasi</x-slot>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <p class="text-sm text-gray-500">Kelola barang-barang layak pakai yang siap didonasikan kepada penerima.</p>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.donation-items.export-excel', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-bold rounded-xl hover:bg-emerald-100 transition shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel
            </a>
            <a href="{{ route('admin.donation-items.export-pdf', request()->query()) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-50 border border-rose-200 text-rose-700 text-sm font-bold rounded-xl hover:bg-rose-100 transition shadow-sm whitespace-nowrap" target="_blank">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Download PDF
            </a>
            <a href="{{ route('admin.donation-items.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-md whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Barang Katalog
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6 shadow-sm">
        <form action="{{ route('admin.donation-items.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
                {{-- Search --}}
                <div>
                    <label for="search" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Cari Barang</label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama / deskripsi..." class="w-full pl-9 pr-4 py-2.5 text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                    </div>
                </div>

                {{-- Brand --}}
                <div>
                    <label for="brand" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Brand</label>
                    <select name="brand" id="brand" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="">Semua Brand</option>
                        @foreach($brands as $b)
                            <option value="{{ $b }}" {{ request('brand') === $b ? 'selected' : '' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Kategori</label>
                    <select name="kategori" id="kategori" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="">Semua Kategori</option>
                        <option value="sepatu" {{ request('kategori') === 'sepatu' ? 'selected' : '' }}>👞 Sepatu</option>
                        <option value="tas" {{ request('kategori') === 'tas' ? 'selected' : '' }}>🎒 Tas</option>
                        <option value="topi" {{ request('kategori') === 'topi' ? 'selected' : '' }}>🧢 Topi</option>
                    </select>
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Status</label>
                    <select name="status" id="status" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disalurkan" {{ request('status') === 'disalurkan' ? 'selected' : '' }}>Sudah Disalurkan</option>
                    </select>
                </div>

                {{-- Urutan --}}
                <div>
                    <label for="sort" class="block text-xs font-black text-gray-700 mb-1.5 uppercase tracking-wider">Urutan Kode</label>
                    <select name="sort" id="sort" class="w-full text-xs border-gray-200 rounded-xl focus:border-[#22AF85] focus:ring-1 focus:ring-[#22AF85] bg-gray-50/50 py-2.5">
                        <option value="desc" {{ request('sort', 'desc') === 'desc' ? 'selected' : '' }}>⬇️ Terbaru (DESC)</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>⬆️ Terlama (ASC)</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-50">
                @if(request()->anyFilled(['search', 'brand', 'kategori', 'status']) || request('sort') === 'asc')
                    <a href="{{ route('admin.donation-items.index') }}" class="px-4 py-2 border border-gray-200 text-gray-500 rounded-xl text-xs font-bold hover:bg-gray-50 hover:text-gray-700 transition">
                        Reset Filter
                    </a>
                @endif
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#22AF85] text-white text-xs font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Card Grid Container -->
    @if($items->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
        @foreach($items as $item)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg">
            {{-- Image & Badge Overlays --}}
            <div class="relative w-full aspect-[4/3] bg-gray-50 overflow-hidden group">
                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                
                {{-- Status Overlay Badge (Top Left) --}}
                <div class="absolute top-3 left-3">
                    @if($item->status === 'tersedia')
                        <span class="px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-emerald-500 text-white shadow-sm">
                            Tersedia
                        </span>
                    @else
                        <span class="px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-gray-600 text-white shadow-sm">
                            Disalurkan
                        </span>
                    @endif
                </div>

                {{-- Category Overlay Badge (Top Right) --}}
                @php
                    $catLabels = [
                        'sepatu' => '👞 Sepatu',
                        'tas' => '🎒 Tas',
                        'topi' => '🧢 Topi'
                    ];
                @endphp
                <div class="absolute top-3 right-3">
                    <span class="px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-white/90 backdrop-blur-sm text-gray-800 border border-gray-150/50 shadow-sm">
                        {{ $catLabels[$item->kategori] ?? ucfirst($item->kategori) }}
                    </span>
                </div>

                {{-- Code Tag Overlay (Bottom Left) --}}
                <div class="absolute bottom-3 left-3">
                    <span class="px-2.5 py-1 rounded-xl text-[9px] font-mono font-bold bg-slate-900/75 backdrop-blur-sm text-white tracking-wider shadow-sm border border-white/10">
                        {{ $item->kode_barang ?? '-' }}
                    </span>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="p-5 flex-1 flex flex-col justify-between gap-4">
                <div>
                    {{-- Brand & Title --}}
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                            {{ $item->brand ?? '-' }}
                        </span>
                        @if($item->ukuran)
                            <span class="text-[9px] font-black bg-gray-100 text-gray-600 px-2 py-0.5 rounded-lg border border-gray-200">
                                Size: {{ $item->ukuran }}
                            </span>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-950 text-base leading-tight mt-1 group-hover:text-[#22AF85] transition-colors">
                        {{ $item->nama }}
                    </h3>

                    {{-- Description --}}
                    @if($item->deskripsi)
                        <p class="text-xs text-gray-400 mt-2 line-clamp-2 leading-relaxed min-h-[32px]">
                            {{ $item->deskripsi }}
                        </p>
                    @else
                        <p class="text-xs italic text-gray-300 mt-2 min-h-[32px]">
                            Tidak ada deskripsi barang.
                        </p>
                    @endif
                </div>

                {{-- Attributes & Score Badges --}}
                <div class="flex flex-wrap gap-1.5 pt-2 border-t border-gray-50">
                    @if($item->score_kelayakan)
                        @php
                            $colorMap = [
                                'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                'teal' => 'bg-teal-50 text-teal-700 border-teal-100',
                                'amber' => 'bg-amber-50 text-amber-700 border-amber-100',
                                'red' => 'bg-red-50 text-red-700 border-red-100',
                            ];
                            $colorClass = $colorMap[$item->score_kelayakan_color] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                        @endphp
                        <span class="text-[9px] font-black border px-2 py-0.5 rounded-lg {{ $colorClass }}" title="Skor Kelayakan">
                            🎯 {{ $item->score_kelayakan }}% layak
                        </span>
                    @endif
                    
                    @if($item->berat)
                        <span class="text-[9px] font-black bg-blue-50 text-blue-700 border border-blue-100 px-2 py-0.5 rounded-lg" title="Berat">
                            ⚖️ {{ $item->berat_formatted }}
                        </span>
                    @endif

                    @if($item->jasa_nama)
                        <span class="text-[9px] font-black bg-indigo-50 text-indigo-700 border border-indigo-100 px-2 py-0.5 rounded-lg max-w-full truncate" title="Pekerjaan Reparasi: {{ $item->jasa_nama }}">
                            🔧 {{ $item->jasa_nama }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Card Footer Actions --}}
            <div class="px-5 py-3.5 bg-gray-50/40 border-t border-gray-50 flex items-center justify-between">
                <a href="{{ route('admin.donation-items.edit', $item) }}" class="text-[#22AF85] hover:text-[#1d9a75] font-bold text-xs flex items-center gap-1 transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.donation-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus barang katalog ini? Semua data permohonan terkait barang ini juga akan ikut terhapus.')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs flex items-center gap-1 transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center text-gray-400 shadow-sm mb-6">
        <span class="material-symbols-outlined !text-[48px] text-gray-200 block mb-2">inventory_2</span>
        Belum ada barang di katalog donasi yang cocok dengan filter Anda.
    </div>
    @endif

    @if($items->hasPages())
    <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm mb-6">
        {{ $items->links() }}
    </div>
    @endif
</x-app-layout>
