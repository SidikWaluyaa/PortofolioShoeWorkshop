<x-app-layout>
    <x-slot name="header">Moderasi Donasi</x-slot>

    <div x-data="{
        showModal: false,
        activeDonation: {},
        approveUrl: '',
        rejectUrl: '',
        distributeUrl: '',
        lightboxUrl: '',
        showLightbox: false,
        buktiPreview: null,
        openModal(donation, approveUrl, rejectUrl, distributeUrl) {
            this.activeDonation = donation;
            this.activeDonation.brand = this.activeDonation.brand || '';
            this.activeDonation.kategori = this.activeDonation.kategori || 'sepatu';
            
            // Auto calculate catalog conditions select default
            if (this.activeDonation.kondisi >= 90) {
                this.activeDonation.kondisi_katalog = 'baru';
            } else if (this.activeDonation.kondisi >= 70) {
                this.activeDonation.kondisi_katalog = 'seperti_baru';
            } else {
                this.activeDonation.kondisi_katalog = 'sudah_diperbaiki';
            }

            this.approveUrl = approveUrl;
            this.rejectUrl = rejectUrl;
            this.distributeUrl = distributeUrl;
            this.buktiPreview = null;
            this.showModal = true;
        }
    }" class="relative">

        {{-- Status Filter --}}
        <div class="flex items-center gap-2 mb-6 flex-wrap">
            <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ !$statusFilter ? 'bg-[#22AF85] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">Semua</a>
            @foreach(['pending', 'diterima', 'disalurkan', 'ditolak'] as $s)
            <a href="{{ route('admin.donations.index', ['status' => $s]) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $statusFilter === $s ? 'bg-[#22AF85] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">{{ ucfirst($s) }}</a>
            @endforeach
        </div>

        @if(session('success'))
        <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium shadow-sm transition duration-150">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                            <th class="px-6 py-4">Donatur</th>
                            <th class="px-6 py-4">Sepatu</th>
                            <th class="px-6 py-4">Ukuran</th>
                            <th class="px-6 py-4">Kondisi</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($donations as $donation)
                        @php
                             $donationData = [
                                 'id' => $donation->id,
                                 'user_name' => $donation->user->name,
                                 'user_email' => $donation->user->email,
                                 'spk' => $donation->spk,
                                 'nama_sepatu' => $donation->nama_sepatu,
                                 'ukuran' => $donation->ukuran,
                                 'kondisi' => $donation->kondisi,
                                 'harga_formatted' => 'Rp ' . number_format($donation->harga, 0, ',', '.'),
                                 'metode_pengiriman' => str_replace('_', ' ', $donation->metode_pengiriman),
                                 'nama_ekspedisi' => $donation->nama_ekspedisi,
                                 'no_resi' => $donation->no_resi,
                                 'tanggal' => $donation->created_at->format('d M Y, H:i') . ' WIB',
                                 'status' => $donation->status,
                                 'deskripsi' => $donation->deskripsi,
                                 'catatan_admin' => $donation->catatan_admin,
                                 'verifier_name' => $donation->verifier ? $donation->verifier->name : null,
                                 'verified_at' => $donation->verified_at ? $donation->verified_at->format('d M Y, H:i') . ' WIB' : null,
                                 'foto_url' => asset('storage/' . ($donation->foto_path[0] ?? '')),
                                 'foto_urls' => collect($donation->foto_path)->map(fn($path) => asset('storage/' . $path))->toArray(),
                                 'foto_bukti_url' => $donation->foto_bukti_path ? asset('storage/' . $donation->foto_bukti_path) : null,
                             ];
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $donation->user->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . ($donation->foto_path[0] ?? '')) }}" class="w-10 h-10 rounded-lg object-cover bg-gray-100 flex-shrink-0">
                                    <div>
                                        @if($donation->spk)
                                            <span class="font-mono text-[10px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded block w-fit mb-0.5">{{ $donation->spk }}</span>
                                        @endif
                                        <span class="text-gray-950 font-medium">{{ $donation->nama_sepatu }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $donation->ukuran }}</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold {{ $donation->kondisi >= 70 ? 'text-emerald-600' : ($donation->kondisi >= 40 ? 'text-amber-600' : 'text-red-600') }}">{{ $donation->kondisi }}%</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 capitalize text-xs">{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $sc = ['pending'=>'bg-amber-100 text-amber-700','diterima'=>'bg-emerald-100 text-emerald-700','disalurkan'=>'bg-blue-100 text-blue-700','ditolak'=>'bg-red-100 text-red-700'];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $sc[$donation->status] }}">{{ ucfirst($donation->status) }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $donation->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <button @click="openModal({{ json_encode($donationData) }}, '{{ route('admin.donations.approve', $donation) }}', '{{ route('admin.donations.reject', $donation) }}', '{{ route('admin.donations.distribute', $donation) }}')"
                                        class="text-[#22AF85] hover:underline font-bold text-xs">
                                    Detail &rarr;
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="px-6 py-12 text-center text-gray-400">Tidak ada data donasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $donations->appends(['status' => $statusFilter])->links() }}
            </div>
        </div>

        {{-- Donation Detail Modal --}}
        <div x-show="showModal" 
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;"
             x-keydown.escape.window="showModal = false">
            
            {{-- Backdrop blur overlay --}}
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-md transition-opacity"
                 @click="showModal = false"></div>

            {{-- Modal container --}}
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-4xl lg:max-w-6xl border border-gray-100 flex flex-col max-h-[90vh]">
                     
                    {{-- Modal Header --}}
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 flex-shrink-0">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <span>Detail Donasi Sepatu</span>
                                <span class="text-sm font-semibold bg-emerald-50 text-[#22AF85] px-2.5 py-0.5 rounded-md">ID #<span x-text="activeDonation.id"></span></span>
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">
                                Diajukan oleh: <span class="font-semibold text-gray-700" x-text="activeDonation.user_name"></span> 
                                (<span class="text-gray-600" x-text="activeDonation.user_email"></span>)
                            </p>
                        </div>
                        <button @click="showModal = false" class="rounded-xl p-2 text-gray-400 hover:text-gray-655 hover:bg-gray-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="px-6 py-6 overflow-y-auto flex-1 bg-gray-50/30">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            
                            {{-- Left Column: Details & Images --}}
                            <div class="lg:col-span-2 space-y-6">
                                {{-- Info Card --}}
                                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-4">Informasi Utama</h4>
                                    <div class="grid grid-cols-2 gap-4 text-xs">
                                        <div>
                                            <span class="text-gray-500 block mb-1">Nomor SPK</span>
                                            <span class="font-mono font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg text-xs" x-text="activeDonation.spk || '-'"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block mb-1">Nama Sepatu</span>
                                            <span class="font-bold text-gray-900 text-sm" x-text="activeDonation.nama_sepatu"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block mb-1">Ukuran</span>
                                            <span class="font-bold text-gray-900 text-sm" x-text="activeDonation.ukuran"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block mb-1">Kondisi Sepatu</span>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <div class="w-16 h-2 rounded-full bg-gray-150 overflow-hidden">
                                                    <div class="h-full rounded-full bg-emerald-500" :style="'width: ' + activeDonation.kondisi + '%'"></div>
                                                </div>
                                                <span class="font-bold text-emerald-600" x-text="activeDonation.kondisi + '%'"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block mb-1">Estimasi Nilai</span>
                                            <span class="font-bold text-gray-950 text-sm" x-text="activeDonation.harga_formatted"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block mb-1">Metode Pengiriman</span>
                                            <span class="font-bold text-gray-900 capitalize" x-text="activeDonation.metode_pengiriman"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 block mb-1">Tanggal Pengajuan</span>
                                            <span class="font-bold text-gray-900" x-text="activeDonation.tanggal"></span>
                                        </div>
                                        <template x-if="activeDonation.nama_ekspedisi">
                                            <div>
                                                <span class="text-gray-500 block mb-1">Nama Ekspedisi</span>
                                                <span class="font-bold text-gray-900" x-text="activeDonation.nama_ekspedisi"></span>
                                            </div>
                                        </template>
                                        <template x-if="activeDonation.no_resi">
                                            <div>
                                                <span class="text-gray-500 block mb-1">No. Resi</span>
                                                <span class="font-mono font-bold text-gray-900" x-text="activeDonation.no_resi"></span>
                                            </div>
                                        </template>
                                    </div>
                                    
                                    <template x-if="activeDonation.deskripsi">
                                        <div class="mt-4 pt-4 border-t border-gray-100 text-xs">
                                            <span class="text-gray-500 block mb-1">Deskripsi Kondisi</span>
                                            <p class="text-gray-700 leading-relaxed font-medium" x-text="activeDonation.deskripsi"></p>
                                        </div>
                                    </template>
                                    
                                    <template x-if="activeDonation.catatan_admin">
                                        <div class="mt-4 pt-4 border-t border-gray-100 text-xs">
                                            <span class="text-gray-500 block mb-1">Catatan Admin</span>
                                            <p class="text-gray-700 leading-relaxed font-medium" x-text="activeDonation.catatan_admin"></p>
                                            <p class="text-[10px] text-gray-400 mt-1" x-text="'Oleh: ' + activeDonation.verifier_name + ' • ' + activeDonation.verified_at"></p>
                                        </div>
                                    </template>
                                </div>

                                {{-- Photos --}}
                                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-4">Bukti Visual (Klik untuk perbesar)</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <span class="text-[10px] text-gray-400 uppercase font-bold tracking-wider block mb-2">Foto Sepatu (Donatur)</span>
                                            <div class="grid grid-cols-2 gap-2">
                                                <template x-for="(url, idx) in activeDonation.foto_urls" :key="idx">
                                                    <div class="relative aspect-[4/3] rounded-xl overflow-hidden bg-gray-100 border border-gray-200 cursor-zoom-in group"
                                                         @click="lightboxUrl = url, showLightbox = true">
                                                        <img :src="url" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                        <template x-if="activeDonation.foto_bukti_url">
                                            <div>
                                                <span class="text-[10px] text-gray-400 uppercase font-bold tracking-wider block mb-2">Bukti Penerimaan (Admin)</span>
                                                <div class="relative aspect-[4/3] rounded-xl overflow-hidden bg-gray-100 border border-gray-200 cursor-zoom-in group"
                                                     @click="lightboxUrl = activeDonation.foto_bukti_url, showLightbox = true">
                                                    <img :src="activeDonation.foto_bukti_url" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Action Forms --}}
                            <div class="space-y-6">
                                <template x-if="activeDonation.status === 'pending'">
                                    <div class="space-y-6">
                                        {{-- Setujui Form --}}
                                        <div class="bg-white rounded-2xl border border-emerald-100 p-6 shadow-sm">
                                            <h4 class="text-sm font-bold text-emerald-800 flex items-center gap-1.5 mb-4">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Setujui Donasi
                                            </h4>
                                            <form :action="approveUrl" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                
                                                {{-- Foto Bukti Penerimaan --}}
                                                <div>
                                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Foto Bukti Penerimaan <span class="text-red-500">*</span></label>
                                                    <div class="border-2 border-dashed border-gray-200 hover:border-emerald-400 rounded-xl p-4 text-center cursor-pointer transition relative bg-gray-50/50"
                                                         @click="$refs.approveFileInput.click()">
                                                        <template x-if="!buktiPreview">
                                                            <div>
                                                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                                <span class="text-[10px] font-bold text-gray-600 block">Pilih Gambar</span>
                                                            </div>
                                                        </template>
                                                        <template x-if="buktiPreview">
                                                            <div class="relative h-20 w-full rounded-lg overflow-hidden">
                                                                <img :src="buktiPreview" class="w-full h-full object-cover">
                                                            </div>
                                                        </template>
                                                    </div>
                                                    <input type="file" name="foto_bukti" x-ref="approveFileInput" accept="image/*" required class="hidden"
                                                           @change="buktiPreview = URL.createObjectURL($event.target.files[0])">
                                                </div>

                                                <div class="border-t border-gray-100 pt-3">
                                                    <p class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider mb-2 flex items-center gap-1">
                                                        <span>🛠️</span> Inspeksi Katalog (Koreksi Data)
                                                    </p>

                                                    {{-- Nama Sepatu & Brand --}}
                                                    <div class="grid grid-cols-2 gap-3 mb-3">
                                                        <div>
                                                            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Barang <span class="text-red-500">*</span></label>
                                                            <input type="text" name="nama" x-model="activeDonation.nama_sepatu" required
                                                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                                                        </div>
                                                        <div>
                                                            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-wider mb-1">Brand</label>
                                                            <input type="text" name="brand" x-model="activeDonation.brand"
                                                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                                                   placeholder="Misal: Nike">
                                                        </div>
                                                    </div>

                                                    {{-- Ukuran & Kategori --}}
                                                    <div class="grid grid-cols-2 gap-3 mb-3">
                                                        <div>
                                                            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-wider mb-1">Ukuran</label>
                                                            <input type="text" name="ukuran" x-model="activeDonation.ukuran"
                                                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                                                        </div>
                                                        <div>
                                                            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-wider mb-1">Kategori <span class="text-red-500">*</span></label>
                                                            <select name="kategori" x-model="activeDonation.kategori" required
                                                                    class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                                                                <option value="sepatu">Sepatu</option>
                                                                <option value="tas">Tas</option>
                                                                <option value="topi">Topi</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    {{-- Kondisi Katalog --}}
                                                    <div class="mb-3">
                                                        <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-wider mb-1">Kondisi Katalog <span class="text-[9px] text-gray-400 font-normal normal-case" x-text="'(Donatur: ' + activeDonation.kondisi + '%)'"></span> <span class="text-red-500">*</span></label>
                                                        <select name="kondisi" x-model="activeDonation.kondisi_katalog" required
                                                                class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                                                            <option value="baru">Baru</option>
                                                            <option value="seperti_baru">Like New</option>
                                                            <option value="sudah_diperbaiki">Sudah Diperbaiki</option>
                                                        </select>
                                                    </div>

                                                    {{-- Deskripsi Katalog --}}
                                                    <div class="mb-3">
                                                        <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-wider mb-1">Deskripsi Katalog</label>
                                                        <textarea name="deskripsi" x-model="activeDonation.deskripsi" rows="2"
                                                                  class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs resize-none focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                                                  placeholder="Kondisi detail untuk katalog..."></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="border-t border-gray-100 pt-3">
                                                    <label for="modal_catatan_admin_approve" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Catatan Verifikasi (Opsional)</label>
                                                    <textarea name="catatan_admin" id="modal_catatan_admin_approve" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 resize-none" placeholder="Catatan opsional..."></textarea>
                                                </div>
                                                
                                                <button type="submit" class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-emerald-500/25">
                                                    Setujui Donasi & Rilis
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Tolak Form --}}
                                        <div class="bg-white rounded-2xl border border-red-100 p-6 shadow-sm">
                                            <h4 class="text-sm font-bold text-red-800 flex items-center gap-1.5 mb-4">
                                                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Tolak Donasi
                                            </h4>
                                            <form :action="rejectUrl" method="POST" class="space-y-4" onsubmit="return confirm('Yakin ingin menolak donasi ini?')">
                                                @csrf
                                                <div>
                                                    <label for="modal_catatan_admin_reject" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Alasan Penolakan <span class="text-red-500">*</span></label>
                                                    <textarea name="catatan_admin" id="modal_catatan_admin_reject" rows="3" required class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 resize-none" placeholder="Berikan alasan penolakan..."></textarea>
                                                </div>
                                                
                                                <button type="submit" class="w-full py-2.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-red-500/25">
                                                    Tolak Donasi
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="activeDonation.status === 'diterima'">
                                    {{-- Salurkan Form --}}
                                    <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm">
                                        <h4 class="text-sm font-bold text-blue-800 flex items-center gap-1.5 mb-4">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                            Salurkan Donasi
                                        </h4>
                                        <form :action="distributeUrl" method="POST" class="space-y-4">
                                            @csrf
                                            <div>
                                                <label for="modal_catatan_admin_distribute" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Catatan Penyaluran</label>
                                                <textarea name="catatan_admin" id="modal_catatan_admin_distribute" rows="3" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none" placeholder="Masukkan catatan penyaluran..."></textarea>
                                            </div>
                                            
                                            <button type="submit" class="w-full py-2.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold rounded-xl transition shadow-lg shadow-blue-500/25">
                                                Tandai Disalurkan
                                            </button>
                                        </form>
                                    </div>
                                </template>

                                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 text-center text-xs text-gray-500 space-y-1">
                                    <p class="font-bold text-gray-700">Status Alur Donasi</p>
                                    <p>Siklus ini memastikan sepatu bekas disaring kelayakan fisiknya sebelum disalurkan.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between bg-gray-50/50 flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500 font-semibold">Status Saat Ini:</span>
                            <template x-if="activeDonation.status">
                                <span class="text-xs font-black px-2.5 py-0.5 rounded-full"
                                      :class="{
                                          'bg-amber-100 text-amber-700': activeDonation.status === 'pending',
                                          'bg-emerald-100 text-emerald-700': activeDonation.status === 'diterima',
                                          'bg-blue-100 text-blue-700': activeDonation.status === 'disalurkan',
                                          'bg-red-100 text-red-700': activeDonation.status === 'ditolak'
                                      }"
                                      x-text="activeDonation.status.toUpperCase()">
                                </span>
                            </template>
                        </div>
                        
                        <button @click="showModal = false" class="px-4 py-2 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-100 transition-colors">
                            Tutup Detail
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Lightbox Overlay (Separate modal layer) --}}
        <div x-show="showLightbox"
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm"
             style="display: none;"
             x-keydown.escape.window="showLightbox = false"
             @click="showLightbox = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <button class="absolute top-4 right-4 text-white hover:text-gray-300 p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <img :src="lightboxUrl" class="max-w-full max-h-[90vh] object-contain rounded-2xl shadow-2xl" @click.stop>
        </div>

    </div>
</x-app-layout>
