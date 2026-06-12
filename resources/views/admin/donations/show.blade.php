<x-app-layout>
    <x-slot name="header">Detail Donasi #{{ $donation->id }}</x-slot>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif

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
                        @php $sc = ['pending'=>'bg-amber-100 text-amber-700','diterima'=>'bg-emerald-100 text-emerald-700','disalurkan'=>'bg-blue-100 text-blue-700','ditolak'=>'bg-red-100 text-red-700']; @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $sc[$donation->status] }}">{{ ucfirst($donation->status) }}</span>
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
            {{-- Approve Form --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-base font-bold text-emerald-700 mb-4">✅ Setujui Donasi</h3>
                <form action="{{ route('admin.donations.approve', $donation) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Foto Bukti Penerimaan --}}
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Foto Bukti Penerimaan <span class="text-red-500">*</span></label>
                        <input type="file" name="foto_bukti" accept="image/*" required class="w-full text-sm border border-gray-200 rounded-xl p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        @error('foto_bukti') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="border-t border-gray-100 my-5 pt-4">
                        <p class="text-xs font-black text-emerald-800 uppercase tracking-wider mb-3 flex items-center gap-1">
                            <span>🛠️</span> Inspeksi Katalog (Koreksi Data)
                        </p>
                        
                        {{-- Nama Sepatu & Brand --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nama" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Barang <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $donation->nama_sepatu) }}" required
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                @error('nama') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="brand" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Brand</label>
                                <input type="text" name="brand" id="brand" value="{{ old('brand') }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                       placeholder="Misal: Nike">
                                @error('brand') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Ukuran & Kategori --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="ukuran" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Ukuran</label>
                                <input type="text" name="ukuran" id="ukuran" value="{{ old('ukuran', $donation->ukuran) }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                @error('ukuran') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="kategori" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Kategori <span class="text-red-500">*</span></label>
                                <select name="kategori" id="kategori" required
                                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                    <option value="sepatu" {{ old('kategori') === 'sepatu' ? 'selected' : '' }}>Sepatu</option>
                                    <option value="tas" {{ old('kategori') === 'tas' ? 'selected' : '' }}>Tas</option>
                                    <option value="topi" {{ old('kategori') === 'topi' ? 'selected' : '' }}>Topi</option>
                                </select>
                                @error('kategori') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Kondisi Katalog --}}
                        <div class="mb-4">
                            <label for="kondisi" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Kondisi Katalog <span class="text-[9px] text-gray-400 font-normal normal-case">(Donatur: {{ $donation->kondisi }}%)</span> <span class="text-red-500">*</span></label>
                            <select name="kondisi" id="kondisi" required
                                    class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                @php
                                    $defaultKondisi = 'sudah_diperbaiki';
                                    if ($donation->kondisi >= 90) {
                                        $defaultKondisi = 'baru';
                                    } elseif ($donation->kondisi >= 70) {
                                        $defaultKondisi = 'seperti_baru';
                                    }
                                @endphp
                                <option value="baru" {{ old('kondisi', $defaultKondisi) === 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="seperti_baru" {{ old('kondisi', $defaultKondisi) === 'seperti_baru' ? 'selected' : '' }}>Seperti Baru</option>
                                <option value="sudah_diperbaiki" {{ old('kondisi', $defaultKondisi) === 'sudah_diperbaiki' ? 'selected' : '' }}>Sudah Diperbaiki</option>
                            </select>
                            @error('kondisi') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Deskripsi Katalog --}}
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Deskripsi Katalog</label>
                            <textarea name="deskripsi" id="deskripsi" rows="2"
                                      class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                      placeholder="Jelaskan kondisi detail barang untuk katalog...">{{ old('deskripsi', $donation->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="border-t border-gray-100 my-4 pt-4 mb-4">
                        <label for="catatan_admin" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Catatan Verifikasi (Opsional)</label>
                        <textarea name="catatan_admin" id="catatan_admin" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="Catatan internal verifikasi..."></textarea>
                        @error('catatan_admin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">Setujui & Rilis ke Katalog</button>
                </form>
            </div>

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
                    <button type="submit" class="w-full py-2.5 bg-red-500 text-white text-sm font-bold rounded-xl hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menolak donasi ini?')">Tolak</button>
                </form>
            </div>
            @endif

            @if($donation->status === 'diterima')
            {{-- Distribute --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-base font-bold text-blue-600 mb-4">📦 Tandai Disalurkan</h3>
                <form action="{{ route('admin.donations.distribute', $donation) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="catatan_admin" rows="2" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm resize-none" placeholder="Catatan penyaluran..."></textarea>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-blue-500 text-white text-sm font-bold rounded-xl hover:bg-blue-600 transition">Tandai Disalurkan</button>
                </form>
            </div>
            @endif

            <a href="{{ route('admin.donations.index') }}" class="block text-center text-sm font-bold text-gray-500 hover:text-gray-700 transition">← Kembali ke Daftar</a>
        </div>
    </div>
</x-app-layout>
