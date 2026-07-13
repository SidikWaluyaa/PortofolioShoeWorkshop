<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight flex items-center gap-2">
                    Dapur Restorasi (Workshop)
                </h2>
                <p class="text-sm text-gray-500 mt-1">Lacak dan kelola antrean sepatu yang sedang dibersihkan atau direstorasi.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'diterima' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tabs --}}
            <div class="flex border-b border-gray-200">
                <button @click="tab = 'diterima'"
                        :class="tab === 'diterima' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-8 border-b-2 font-bold text-sm transition flex items-center gap-2">
                    <span>Sedang Dikerjakan</span>
                    <span class="bg-gray-100 text-gray-600 py-0.5 px-2.5 rounded-full text-xs">{{ $inRestoration->count() }}</span>
                </button>
                <button @click="tab = 'siap_rilis'"
                        :class="tab === 'siap_rilis' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-8 border-b-2 font-bold text-sm transition flex items-center gap-2">
                    <span>Siap Rilis ke Katalog</span>
                    <span class="bg-gray-100 text-gray-600 py-0.5 px-2.5 rounded-full text-xs">{{ $readyToPublish->count() }}</span>
                </button>
            </div>

            {{-- Tab 1: Sedang Dikerjakan --}}
            <div x-show="tab === 'diterima'" class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-[10px] text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 font-bold tracking-wider">Donatur</th>
                                <th class="px-6 py-4 font-bold tracking-wider">Sepatu</th>
                                <th class="px-6 py-4 font-bold tracking-wider">Ukuran</th>
                                <th class="px-6 py-4 font-bold tracking-wider">Kondisi</th>
                                <th class="px-6 py-4 font-bold tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($inRestoration as $donation)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $donation->user->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-gray-500">{{ $donation->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200">
                                            <img src="{{ asset('storage/' . ($donation->foto_path[0] ?? '')) }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $donation->nama_sepatu }}</div>
                                            @if($donation->spk)
                                            <div class="mt-1">
                                                <span class="font-mono text-[9px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded">{{ $donation->spk }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-600">{{ $donation->ukuran }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-black text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded-full">{{ $donation->kondisi }}%</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.restorations.mark-ready', $donation) }}" method="POST" onsubmit="confirmAction(event, this, 'Tandai sepatu ini sudah selesai direstorasi?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg text-xs font-bold transition">
                                            Selesai Restorasi
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada sepatu di dapur restorasi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tab 2: Siap Rilis --}}
            <div x-show="tab === 'siap_rilis'" class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100" style="display: none;">
                <div class="p-6 bg-blue-50/50 border-b border-blue-100 flex items-start gap-4">
                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-blue-900">Antrean Siap Rilis</h4>
                        <p class="text-xs text-blue-700 mt-1">Daftar sepatu di bawah ini sudah bersih. Silakan buka menu <strong>Katalog Barang Donasi -> Tambah Barang</strong> untuk merilisnya. Setelah dirilis, klik tombol "Arsip" di bawah ini.</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-[10px] text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 font-bold tracking-wider">Donatur</th>
                                <th class="px-6 py-4 font-bold tracking-wider">Sepatu</th>
                                <th class="px-6 py-4 font-bold tracking-wider">Ukuran</th>
                                <th class="px-6 py-4 font-bold tracking-wider">Kondisi Awal</th>
                                <th class="px-6 py-4 font-bold tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($readyToPublish as $donation)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $donation->user->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-gray-500">{{ $donation->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200">
                                            <img src="{{ asset('storage/' . ($donation->foto_path[0] ?? '')) }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $donation->nama_sepatu }}</div>
                                            @if($donation->spk)
                                            <div class="mt-1">
                                                <span class="font-mono text-[9px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded">{{ $donation->spk }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-600">{{ $donation->ukuran }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-black text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded-full">{{ $donation->kondisi }}%</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.donation-items.create', ['donation_id' => $donation->id]) }}" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#22AF85] text-white hover:bg-[#1a936f] rounded-lg text-xs font-bold transition shadow-lg shadow-[#22AF85]/30">
                                            <span class="material-symbols-outlined text-[14px]">storefront</span> Rilis ke Katalog
                                        </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada sepatu yang siap dirilis.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
