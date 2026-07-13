<x-app-layout>
    <x-slot name="header">Detail Donasi #{{ $donation->id }}</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left: Donation Details --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Info Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Donasi</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Donatur</span><span class="font-bold text-gray-900">{{ $donation->user->name }}</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Email</span><span class="text-gray-700">{{ $donation->user->email }}</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Nomor SPK</span><span class="font-mono font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg text-xs">{{ $donation->spk ?? '-' }}</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Nama Sepatu</span><span class="font-bold text-gray-900">{{ $donation->nama_sepatu }}</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Ukuran</span><span class="text-gray-700">{{ $donation->ukuran }}</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Kondisi</span>
                        <div class="flex items-center gap-2">
                            <div class="w-20 h-2 rounded-full bg-gray-200 overflow-hidden"><div class="h-full rounded-full {{ $donation->kondisi >= 70 ? 'bg-emerald-500' : ($donation->kondisi >= 40 ? 'bg-amber-500' : 'bg-red-500') }}" style="width: {{ $donation->kondisi }}%"></div></div>
                            <span class="text-xs font-bold">{{ $donation->kondisi }}%</span>
                        </div>
                    </div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Estimasi Nilai</span><span class="text-gray-700">Rp {{ number_format($donation->harga, 0, ',', '.') }}</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Metode Pengiriman</span><span class="text-gray-700 capitalize">{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</span></div>
                    @if($donation->nama_ekspedisi)
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Ekspedisi</span><span class="text-gray-700">{{ $donation->nama_ekspedisi }}</span></div>
                    @endif
                    @if($donation->no_resi)
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">No. Resi</span><span class="font-mono text-gray-700">{{ $donation->no_resi }}</span></div>
                    @endif
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Tanggal Pengajuan</span><span class="text-gray-700">{{ $donation->created_at->format('d M Y, H:i') }} WIB</span></div>
                    <div><span class="text-gray-500 block text-xs font-medium mb-1">Status</span>
                        @php $sc = ['pending'=>'bg-amber-100 text-amber-700','disetujui'=>'bg-cyan-100 text-cyan-700','diterima'=>'bg-emerald-100 text-emerald-700','siap_rilis'=>'bg-purple-100 text-purple-700','disalurkan'=>'bg-blue-100 text-blue-700','ditolak'=>'bg-red-100 text-red-700']; @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $sc[$donation->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $donation->status === 'disetujui' ? 'Menunggu Pengiriman' : ucfirst($donation->status) }}</span>
                    </div>
                </div>
                @if($donation->deskripsi)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <span class="text-gray-500 block text-xs font-medium mb-1">Deskripsi Kondisi</span>
                    <p class="text-sm text-gray-700">{{ $donation->deskripsi }}</p>
                </div>
                @endif
                @if($donation->catatan_admin)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <span class="text-gray-500 block text-xs font-medium mb-1">Catatan Admin</span>
                    <p class="text-sm text-gray-700">{{ $donation->catatan_admin }}</p>
                    @if($donation->verifier)
                    <p class="text-xs text-gray-400 mt-1">Oleh: {{ $donation->verifier->name }} • {{ $donation->verified_at->format('d M Y, H:i') }} WIB</p>
                    @endif
                </div>
                @endif
            </div>

            {{-- Photos --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Foto</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-2">Foto Sepatu (Donatur)</p>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($donation->foto_path as $path)
                                <img src="{{ asset('storage/' . $path) }}" alt="Foto Sepatu" class="w-full h-32 object-cover rounded-xl bg-gray-100 border border-gray-150">
                            @endforeach
                        </div>
                    </div>
                    @if($donation->foto_bukti_path)
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-2">Bukti Penerimaan (Admin)</p>
                        <img src="{{ asset('storage/' . $donation->foto_bukti_path) }}" alt="Bukti Penerimaan" class="w-full h-48 object-cover rounded-xl bg-gray-100 border border-gray-150">
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: Action Panel --}}
        <div class="space-y-6">
            @if($donation->status === 'pending')
            {{-- Approve Submission Form --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-base font-bold text-emerald-700 mb-4">✅ Setujui Pengajuan Online</h3>
                <form action="{{ route('admin.donations.approve-submission', $donation) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <p class="text-xs text-gray-500 mb-2">Member akan menerima email persetujuan dan diinstruksikan untuk mengirimkan sepatu ke bengkel.</p>
                        <label for="catatan_admin" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Catatan Verifikasi (Opsional)</label>
                        <textarea name="catatan_admin" id="catatan_admin" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="Catatan internal verifikasi..."></textarea>
                        @error('catatan_admin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">Setujui Pengajuan</button>
                </form>
            </div>
            @endif

            @if($donation->status === 'disetujui')
            {{-- Confirm Receipt Form --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-base font-bold text-emerald-700 mb-4">✅ Konfirmasi Penerimaan Fisik</h3>
                <form action="{{ route('admin.donations.confirm-receipt', $donation) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Foto Bukti Penerimaan --}}
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Foto Bukti Penerimaan <span class="text-red-500">*</span></label>
                        <input type="file" name="foto_bukti" accept="image/*" required class="w-full text-sm border border-gray-200 rounded-xl p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        @error('foto_bukti') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>


                    <div class="border-t border-gray-100 my-4 pt-4 mb-4">
                        <label for="catatan_admin" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Catatan Verifikasi (Opsional)</label>
                        <textarea name="catatan_admin" id="catatan_admin" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="Catatan internal verifikasi..."></textarea>
                        @error('catatan_admin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">Konfirmasi Terima & Masukkan ke Restorasi</button>
                </form>
            </div>
            @endif

            @if($donation->status === 'pending')
            {{-- Reject Form --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-base font-bold text-red-600 mb-4">❌ Tolak Donasi</h3>
                <form action="{{ route('admin.donations.reject', $donation) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea name="catatan_admin" rows="3" required class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm resize-none" placeholder="Berikan alasan penolakan..."></textarea>
                        @error('catatan_admin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-red-500 text-white text-sm font-bold rounded-xl hover:bg-red-600 transition" onclick="confirmAction(event, this.closest('form'), 'Yakin ingin menolak donasi ini?')">Tolak</button>
                </form>
            </div>
            @endif

            @if($donation->status === 'diterima')
            <div class="bg-gray-50 rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
                <span class="material-symbols-outlined text-4xl text-gray-300 mb-2 block">build</span>
                <h3 class="text-sm font-bold text-gray-700 mb-1">Sedang Direstorasi</h3>
                <p class="text-xs text-gray-500">Sepatu ini sedang berada di antrean Dapur Restorasi. Silakan proses lebih lanjut melalui menu Dapur Restorasi.</p>
                <a href="{{ route('admin.restorations.index') }}" class="mt-4 inline-block px-4 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-600 hover:bg-gray-50 transition">Pergi ke Dapur Restorasi</a>
            </div>
            @endif

            <a href="{{ route('admin.donations.index') }}" class="block text-center text-sm font-bold text-gray-500 hover:text-gray-700 transition">← Kembali ke Daftar</a>
        </div>
    </div>
</x-app-layout>
