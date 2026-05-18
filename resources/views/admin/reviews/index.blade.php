<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <span>Review Pelanggan</span>
            <a href="{{ route('admin.reviews.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#178a67] transition-colors">
                + Tambah Review
            </a>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 font-bold text-gray-600">Nama</th>
                    <th class="text-left px-6 py-4 font-bold text-gray-600">Lokasi</th>
                    <th class="text-left px-6 py-4 font-bold text-gray-600">Rating</th>
                    <th class="text-left px-6 py-4 font-bold text-gray-600">Review</th>
                    <th class="text-left px-6 py-4 font-bold text-gray-600">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($reviews as $review)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $review->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $review->location ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-500 max-w-xs">
                        <p class="line-clamp-2">{{ $review->content }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $review->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $review->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.reviews.edit', $review) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800">Edit</a>
                            <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Hapus review ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-gray-400 text-sm">
                        Belum ada review. Klik "Tambah Review" untuk menambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>