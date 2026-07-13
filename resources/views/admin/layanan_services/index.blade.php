<x-app-layout>
    <x-slot name="header">
        Sub-Jasa Layanan
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('admin.layanan-categories.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Kategori
        </a>
    </div>

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-black text-gray-900">Sub-Jasa: {{ $layanan_category->name }}</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola daftar layanan/treatment di bawah kategori ini.</p>
        </div>
        <a href="{{ route('admin.layanan-categories.services.create', $layanan_category->id) }}" class="inline-flex items-center gap-2 bg-[#22AF85] hover:bg-[#1a8b69] text-white font-bold py-2 px-4 rounded-xl transition-colors shadow-sm shadow-[#22AF85]/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Sub-Jasa
        </a>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Sub-Jasa</th>
                    <th class="px-6 py-4 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Posisi Tampil</th>
                    <th class="px-6 py-4 text-center text-xs font-black text-gray-500 uppercase tracking-wider">Foto B/A</th>
                    <th class="px-6 py-4 text-right text-xs font-black text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($services as $service)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">{{ $service->name }}</div>
                        <div class="text-xs text-gray-500 mt-0.5 max-w-xs truncate">{{ $service->subtitle_teknis }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($service->is_preview)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                Kartu Utama
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-50 text-gray-600 border border-gray-200 text-xs font-bold">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                Dalam Akordion
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            @if($service->image_before)
                                <img src="{{ asset($service->image_before) }}" class="w-8 h-8 rounded object-cover border border-gray-200" title="Before">
                            @else
                                <div class="w-8 h-8 rounded bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 text-[8px] font-bold">B</div>
                            @endif
                            
                            @if($service->image_after)
                                <img src="{{ asset($service->image_after) }}" class="w-8 h-8 rounded object-cover border border-gray-200" title="After">
                            @else
                                <div class="w-8 h-8 rounded bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 text-[8px] font-bold">A</div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.layanan-categories.services.edit', [$layanan_category->id, $service->id]) }}" class="inline-block text-gray-400 hover:text-indigo-600 mr-3 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.layanan-categories.services.destroy', [$layanan_category->id, $service->id]) }}" method="POST" class="inline" onsubmit="confirmAction(event, this, 'Yakin ingin menghapus sub-jasa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                        Belum ada sub-jasa di kategori ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
