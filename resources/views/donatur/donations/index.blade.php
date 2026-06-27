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
            <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-6">
                @foreach($donations as $donation)
                @php
                    $statusColors = [
                        'pending' => 'bg-amber-500/10 text-amber-600 border-amber-500/20',
                        'diterima' => 'bg-emerald-500/10 text-emerald-600 border-emerald-500/20',
                        'disalurkan' => 'bg-blue-500/10 text-blue-600 border-blue-500/20',
                        'ditolak' => 'bg-red-500/10 text-red-600 border-red-500/20',
                    ];
                @endphp
                <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex flex-col h-full border border-gray-200/80">
                    {{-- Card Image Header --}}
                    <div class="relative overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img src="{{ asset('storage/' . ($donation->foto_path[0] ?? '')) }}" 
                             alt="{{ $donation->nama_sepatu }}" 
                             class="w-full h-32 sm:h-48 md:h-52 object-cover bg-gray-55 group-hover:scale-105 transition-transform duration-500">
                        
                        {{-- Floating Badges --}}
                        <div class="absolute top-2 right-2">
                            <span class="px-1.5 sm:px-2 py-0.5 border rounded text-[8px] sm:text-[9px] font-extrabold tracking-wider uppercase {{ $statusColors[$donation->status] }}">
                                {{ $donation->status }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-3 sm:p-4 flex-grow flex flex-col justify-between">
                        <div>
                            @if($donation->spk)
                            <div class="mb-1.5">
                                <span class="font-mono text-[8px] sm:text-[9px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded">
                                    {{ $donation->spk }}
                                </span>
                            </div>
                            @endif

                            {{-- Shoe Name --}}
                            <h4 class="font-bold text-xs sm:text-sm md:text-base text-[#191c1d] mb-1.5 truncate" title="{{ $donation->nama_sepatu }}">
                                {{ $donation->nama_sepatu }}
                            </h4>

                            {{-- Brand & Size & Price --}}
                            <div class="space-y-1 mb-3">
                                <div class="flex items-center justify-between text-[9px] sm:text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">
                                    <span>Ukuran: {{ $donation->ukuran }}</span>
                                    <span>{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</span>
                                </div>
                                <div class="text-[10px] sm:text-xs font-semibold text-gray-500">
                                    Estimasi: <span class="font-bold text-gray-950">Rp {{ number_format($donation->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Condition progress bar --}}
                            <div class="mb-3">
                                <div class="flex items-center justify-between text-[10px] sm:text-xs mb-1">
                                    <span class="text-gray-500 font-medium">Kondisi</span>
                                    <span class="font-bold {{ $donation->kondisi >= 70 ? 'text-emerald-500' : ($donation->kondisi >= 40 ? 'text-amber-500' : 'text-red-500') }}">{{ $donation->kondisi }}%</span>
                                </div>
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $donation->kondisi >= 70 ? 'bg-emerald-500' : ($donation->kondisi >= 40 ? 'bg-amber-500' : 'bg-red-500') }}" 
                                         style="width: {{ $donation->kondisi }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Delivery Method info --}}
                        <div class="border-t border-gray-100 pt-3 mt-auto space-y-1.5">
                            <div class="flex items-center justify-between text-[10px] sm:text-xs">
                                <span class="text-gray-400 font-medium">Metode</span>
                                <span class="font-bold text-gray-700 capitalize text-[10px] sm:text-xs">{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</span>
                            </div>
                            
                            @if($donation->no_resi)
                            <div class="p-2 bg-gray-50 border border-gray-100 rounded-lg flex items-center justify-between text-[9px] sm:text-[11px] gap-2">
                                <div class="flex flex-col min-w-0">
                                    <span class="text-[8px] sm:text-[9px] font-extrabold text-gray-400 uppercase tracking-wider">No. Resi</span>
                                    <span class="font-bold text-gray-750 font-mono truncate mt-0.5" title="{{ $donation->no_resi }}">{{ $donation->no_resi }}</span>
                                </div>
                                <span class="px-1.5 py-0.5 bg-gray-200/60 rounded text-[8px] sm:text-[9px] font-extrabold text-gray-600 uppercase tracking-wider shrink-0">{{ $donation->nama_ekspedisi }}</span>
                            </div>
                            @endif

                            @if($donation->catatan_admin)
                            <div class="p-2 bg-red-50 border border-red-100 text-red-700 text-[10px] rounded-lg flex flex-col gap-0.5">
                                <span class="font-bold uppercase tracking-wider text-[8px] text-red-500">Catatan Admin:</span>
                                <p class="font-medium text-red-600 leading-normal line-clamp-2" title="{{ $donation->catatan_admin }}">{{ $donation->catatan_admin }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Card Footer Action Buttons --}}
                    <div class="px-3 sm:px-4 py-3 border-t border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        @if($donation->status === 'pending')
                            <div class="flex items-center gap-1.5 w-full">
                                <a href="{{ route('donatur.donations.edit', $donation) }}" 
                                   class="flex-1 inline-flex items-center justify-center gap-1 px-2.5 py-1.5 bg-amber-500 hover:brightness-105 active:scale-95 text-white text-[10px] sm:text-xs font-bold rounded-lg transition duration-150 shadow-sm">
                                    <span class="material-symbols-outlined !text-[14px]">edit</span>
                                    Edit
                                </a>
                                @if($donation->metode_pengiriman === 'ekspedisi')
                                    <button @click="openResiModal('{{ $donation->id }}', '{{ $donation->nama_ekspedisi }}', '{{ $donation->no_resi }}', '{{ route('donatur.donations.update-resi', $donation) }}')" 
                                            class="flex-1 inline-flex items-center justify-center gap-1 px-2.5 py-1.5 bg-indigo-600 hover:brightness-105 active:scale-95 text-white text-[10px] sm:text-xs font-bold rounded-lg transition duration-150 shadow-sm">
                                        <span class="material-symbols-outlined !text-[14px]">local_shipping</span>
                                        Resi
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="flex items-center justify-between w-full text-[10px] sm:text-xs text-gray-400">
                                <span class="font-medium">Tanggal</span>
                                <span class="font-bold text-gray-650">{{ $donation->created_at->format('d M Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $donations->links() }}
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
