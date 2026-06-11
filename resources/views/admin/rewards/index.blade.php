<x-app-layout>
    <x-slot name="header">Kelola Rewards</x-slot>

    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Kelola katalog hadiah dan kupon untuk pengguna.</p>
        <a href="{{ route('admin.rewards.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-md">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Reward
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                        <th class="px-6 py-4">Nama Reward</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4">Nilai</th>
                        <th class="px-6 py-4">Minggu</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4">Klaim</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($rewards as $reward)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $reward->nama_reward }}</td>
                        <td class="px-6 py-4">
                            @php $jc = ['voucher'=>'bg-violet-100 text-violet-700','diskon'=>'bg-blue-100 text-blue-700','konsultasi'=>'bg-amber-100 text-amber-700','lainnya'=>'bg-pink-100 text-pink-700']; @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $jc[$reward->jenis] }}">{{ ucfirst($reward->jenis) }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $reward->nilai ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600 text-center">{{ $reward->minggu_ke }}</td>
                        <td class="px-6 py-4 text-gray-600 text-center">{{ $reward->stok ?? '∞' }}</td>
                        <td class="px-6 py-4 text-gray-600 text-center font-bold">{{ $reward->user_rewards_count }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $reward->status_aktif ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $reward->status_aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.rewards.edit', $reward) }}" class="text-[#22AF85] hover:underline font-bold text-xs">Edit</a>
                                <form action="{{ route('admin.rewards.destroy', $reward) }}" method="POST" onsubmit="return confirm('Hapus reward ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline font-bold text-xs">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-12 text-center text-gray-400">Belum ada reward.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $rewards->links() }}
        </div>
    </div>
</x-app-layout>
