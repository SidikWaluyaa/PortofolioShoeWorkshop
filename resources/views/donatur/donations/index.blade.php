<x-donatur-layout>
    <x-slot name="header">Donasi Saya</x-slot>

    <div x-data="{
        showModal: false,
        donationId: '',
        namaEkspedisi: '',
        noResi: '',
        updateUrl: '',
        openResiModal(id, ekspedisi, resi, url) {
            this.donationId = id;
            this.namaEkspedisi = ekspedisi || '';
            this.noResi = resi || '';
            this.updateUrl = url;
            this.showModal = true;
        }
    }">
        <div class="mb-6 flex items-center justify-between">
            <p class="text-sm text-gray-500">Riwayat pengajuan donasi sepatu Anda.</p>
            <a href="{{ route('donatur.donations.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Donasi Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium shadow-sm transition duration-150">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-medium shadow-sm transition duration-150">{{ session('error') }}</div>
        @endif

        @if($donations->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-emerald-50 flex items-center justify-center">
                    <svg class="w-10 h-10 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada donasi</h3>
                <p class="text-sm text-gray-500 mb-4">Mulai donasikan sepatu bekas layak pakai Anda untuk membantu sesama!</p>
                <a href="{{ route('donatur.donations.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition">+ Donasi Sepatu Pertama</a>
            </div>
        @else
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                                <th class="px-6 py-4">Sepatu</th>
                                <th class="px-6 py-4">Ukuran</th>
                                <th class="px-6 py-4">Kondisi</th>
                                <th class="px-6 py-4">Estimasi Nilai</th>
                                <th class="px-6 py-4">Metode</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($donations as $donation)
                            <tr class="hover:bg-gray-50 transition">
                                 <td class="px-6 py-4">
                                     <div class="flex items-center gap-3">
                                         <img src="{{ asset('storage/' . ($donation->foto_path[0] ?? '')) }}" alt="{{ $donation->nama_sepatu }}" class="w-10 h-10 rounded-lg object-cover bg-gray-100 flex-shrink-0">
                                         <div>
                                             @if($donation->spk)
                                                 <span class="font-mono text-[10px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded block w-fit mb-0.5">{{ $donation->spk }}</span>
                                             @endif
                                             <span class="font-medium text-gray-900">{{ $donation->nama_sepatu }}</span>
                                         </div>
                                     </div>
                                 </td>
                                <td class="px-6 py-4 text-gray-600">{{ $donation->ukuran }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 h-2 rounded-full bg-gray-200 overflow-hidden">
                                            <div class="h-full rounded-full {{ $donation->kondisi >= 70 ? 'bg-emerald-500' : ($donation->kondisi >= 40 ? 'bg-amber-500' : 'bg-red-500') }}" style="width: {{ $donation->kondisi }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium text-gray-500">{{ $donation->kondisi }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Rp {{ number_format($donation->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    <span class="capitalize">{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</span>
                                    @if($donation->no_resi)
                                        <p class="text-xs text-gray-400 mt-0.5"><span class="font-bold text-gray-600">{{ $donation->nama_ekspedisi }}:</span> {{ $donation->no_resi }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'diterima' => 'bg-emerald-100 text-emerald-700',
                                            'disalurkan' => 'bg-blue-100 text-blue-700',
                                            'ditolak' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $statusColors[$donation->status] }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                    @if($donation->catatan_admin)
                                        <p class="text-xs text-gray-400 mt-1 max-w-[150px] truncate" title="{{ $donation->catatan_admin }}">{{ $donation->catatan_admin }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $donation->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($donation->status === 'pending')
                                            <a href="{{ route('donatur.donations.edit', $donation) }}" 
                                               class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded-xl transition duration-150 shadow-sm flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            @if($donation->metode_pengiriman === 'ekspedisi')
                                                <button @click="openResiModal('{{ $donation->id }}', '{{ $donation->nama_ekspedisi }}', '{{ $donation->no_resi }}', '{{ route('donatur.donations.update-resi', $donation) }}')" 
                                                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition duration-150 shadow-sm flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                    {{ $donation->no_resi ? 'Edit Resi' : 'Input Resi' }}
                                                </button>
                                            @endif
                                        @else
                                            <span class="text-xs text-gray-400">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $donations->links() }}
                </div>
            </div>
        @endif

        {{-- Resi Modal --}}
        <div x-show="showModal" 
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;"
             x-keydown.escape.window="showModal = false">
            
            {{-- Backdrop --}}
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                 @click="showModal = false"></div>

            {{-- Container --}}
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-md border border-gray-100">
                    
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                        <h3 class="text-sm font-extrabold text-gray-900">Resi Pengiriman Donasi #<span x-text="donationId"></span></h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 p-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <form :action="updateUrl" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="modal_nama_ekspedisi" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Ekspedisi <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ekspedisi" id="modal_nama_ekspedisi" x-model="namaEkspedisi" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="Contoh: JNE, J&T, SiCepat">
                        </div>

                        <div>
                            <label for="modal_no_resi" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Resi <span class="text-red-500">*</span></label>
                            <input type="text" name="no_resi" id="modal_no_resi" x-model="noResi" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="Masukkan nomor resi">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="showModal = false" class="flex-1 py-2.5 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-100 transition">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-emerald-500/25">
                                Simpan Resi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-donatur-layout>
