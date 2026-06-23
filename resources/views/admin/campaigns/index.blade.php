<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
            {{ __('Manajemen Iklan & Kampanye') }}
            <a href="{{ route('admin.campaigns.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                Tambah Kampanye
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posisi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clicks</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CTR</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($campaigns as $campaign)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        <div class="font-semibold text-gray-900">{{ $campaign->title }}</div>
                                        @if($campaign->type === 'image_upload' && $campaign->image_path)
                                            <div class="mt-1.5">
                                                <img src="{{ asset('storage/' . $campaign->image_path) }}" class="h-6 w-auto rounded border border-gray-200" alt="Preview" />
                                            </div>
                                        @elseif($campaign->type === 'image_url' && $campaign->image_url)
                                            <div class="mt-1.5">
                                                <img src="{{ $campaign->image_url }}" class="h-6 w-auto rounded border border-gray-200" alt="Preview" />
                                            </div>
                                        @else
                                            <span class="text-[10px] text-gray-400 italic">Hanya Teks</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $campaign->position }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs">
                                            {{ $campaign->type === 'image_upload' ? 'Upload Gambar' : ($campaign->type === 'image_url' ? 'URL Gambar' : 'Teks Saja') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $now = now();
                                            $isScheduledActive = $campaign->is_active && 
                                                (is_null($campaign->start_date) || $campaign->start_date <= $now) &&
                                                (is_null($campaign->end_date) || $campaign->end_date >= $now);
                                        @endphp
                                        @if($isScheduledActive)
                                            <span class="px-2.5 py-0.5 bg-green-100 text-green-800 rounded-full font-bold text-xs">Aktif</span>
                                        @else
                                            <span class="px-2.5 py-0.5 bg-red-100 text-red-800 rounded-full font-bold text-xs">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                        @if($campaign->start_date || $campaign->end_date)
                                            {{ $campaign->start_date ? $campaign->start_date->format('d/m/Y H:i') : 'Mulai' }} 
                                            s.d. 
                                            {{ $campaign->end_date ? $campaign->end_date->format('d/m/Y H:i') : 'Selesai' }}
                                        @else
                                            <span class="text-gray-400">Selalu Tayang</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $campaign->views_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $campaign->clicks_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-600">
                                        {{ $campaign->views_count > 0 ? number_format(($campaign->clicks_count / $campaign->views_count) * 100, 2) . '%' : '0.00%' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus kampanye ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-8 text-center text-gray-400">
                                        Belum ada kampanye / promosi iklan yang didaftarkan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
