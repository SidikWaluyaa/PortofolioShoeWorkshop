<x-app-layout>
    <x-slot name="header">Kelola Barang Katalog Donasi</x-slot>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <p class="text-sm text-gray-500">Kelola barang-barang layak pakai yang siap didonasikan kepada penerima.</p>
        <a href="{{ route('admin.donation-items.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-md whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Barang Katalog
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6 shadow-sm">
        <form action="{{ route('admin.donation-items.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
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
            </div>

            <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-50">
                @if(request()->anyFilled(['search', 'brand', 'kategori', 'status']))
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

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Nama Barang</th>
                        <th class="px-6 py-4">Brand</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($items as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-lg object-cover border border-gray-100 bg-gray-50">
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">
                            <div class="flex items-center gap-2">
                                <span>{{ $item->nama }}</span>
                                @if($item->ukuran)
                                    <span class="text-[10px] font-black bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded">{{ $item->ukuran }}</span>
                                @endif
                            </div>
                            @if($item->deskripsi)
                                <p class="text-xs text-gray-400 font-normal mt-0.5 line-clamp-1 max-w-xs">{{ $item->deskripsi }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-semibold">{{ $item->brand ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @php 
                                $catColors = [
                                    'sepatu' => 'bg-indigo-50 text-indigo-700 border border-indigo-100',
                                    'tas' => 'bg-violet-50 text-violet-700 border border-violet-100',
                                    'topi' => 'bg-amber-50 text-amber-700 border border-amber-100'
                                ]; 
                                $catLabels = [
                                    'sepatu' => '👞 Sepatu',
                                    'tas' => '🎒 Tas',
                                    'topi' => '🧢 Topi'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $catColors[$item->kategori] ?? 'bg-gray-50 text-gray-600 border border-gray-200' }}">
                                {{ $catLabels[$item->kategori] ?? ucfirst($item->kategori) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $item->status === 'tersedia' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-gray-50 text-gray-400 border border-gray-200' }}">
                                {{ $item->status === 'tersedia' ? 'Tersedia' : 'Sudah Disalurkan' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.donation-items.edit', $item) }}" class="text-[#22AF85] hover:underline font-bold text-xs flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.donation-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus barang katalog ini? Semua data permohonan terkait barang ini juga akan ikut terhapus.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-bold text-xs flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <span class="material-symbols-outlined !text-[48px] text-gray-200 block mb-2">inventory_2</span>
                            Belum ada barang di katalog donasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($items->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $items->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
