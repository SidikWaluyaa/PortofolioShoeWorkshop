<x-donatur-layout>
    <x-slot name="header">Donasikan Sepatu</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
            <form action="{{ route('donatur.donations.store') }}" method="POST" enctype="multipart/form-data" x-data="{ metode: 'ekspedisi', preview: null }">
                @csrf

                {{-- Nama Sepatu --}}
                <div class="mb-6">
                    <label for="nama_sepatu" class="block text-sm font-bold text-gray-700 mb-2">Nama Sepatu <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_sepatu" id="nama_sepatu" value="{{ old('nama_sepatu') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                           placeholder="Contoh: Nike Air Jordan 1">
                    @error('nama_sepatu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    {{-- Ukuran --}}
                    <div>
                        <label for="ukuran" class="block text-sm font-bold text-gray-700 mb-2">Ukuran <span class="text-red-500">*</span></label>
                        <input type="text" name="ukuran" id="ukuran" value="{{ old('ukuran') }}" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                               placeholder="42">
                        @error('ukuran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Estimasi Harga --}}
                    <div>
                        <label for="harga" class="block text-sm font-bold text-gray-700 mb-2">Estimasi Nilai (Rp)</label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga', 0) }}" min="0"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                               placeholder="500000">
                        @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Kondisi Slider --}}
                <div class="mb-6" x-data="{ kondisi: {{ old('kondisi', 50) }} }">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kondisi Kelayakan <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-4">
                        <input type="range" name="kondisi" min="0" max="100" x-model="kondisi"
                               class="flex-1 h-2 rounded-full appearance-none cursor-pointer accent-emerald-500"
                               style="background: linear-gradient(to right, #ef4444 0%, #f59e0b 50%, #22c55e 100%)">
                        <span class="text-sm font-bold text-gray-900 bg-gray-100 px-3 py-1.5 rounded-lg min-w-[50px] text-center" x-text="kondisi + '%'"></span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Geser untuk menentukan persentase kelayakan fisik sepatu (0% = rusak berat, 100% = seperti baru).</p>
                    @error('kondisi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kondisi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition resize-none"
                              placeholder="Jelaskan kondisi sepatu secara detail...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Foto Sepatu --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Sepatu <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 transition cursor-pointer relative" onclick="document.getElementById('foto').click()">
                        <template x-if="!preview">
                            <div>
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm text-gray-500">Klik untuk unggah foto sepatu</p>
                                <p class="text-xs text-gray-400 mt-1">Foto akan dikompresi otomatis oleh sistem</p>
                            </div>
                        </template>
                        <template x-if="preview">
                            <div class="relative group">
                                <img :src="preview" class="max-h-48 mx-auto rounded-lg shadow-sm">
                                <div class="absolute inset-0 bg-black/45 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                                    <span class="text-white text-xs font-bold bg-gray-950/60 px-3 py-1.5 rounded-lg">Ganti Foto</span>
                                </div>
                            </div>
                        </template>
                    </div>
                    <input type="file" name="foto" id="foto" accept="image/*" class="hidden" required
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                    @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Metode Pengiriman --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3">Metode Pengiriman <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer" @click="metode = 'antar_langsung'">
                            <input type="radio" name="metode_pengiriman" value="antar_langsung" class="peer sr-only" {{ old('metode_pengiriman') === 'antar_langsung' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50"
                                 :class="metode === 'antar_langsung' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                                <div class="text-center">
                                    <span class="text-2xl">🏠</span>
                                    <p class="text-sm font-bold text-gray-900 mt-1">Antar Langsung</p>
                                    <p class="text-xs text-gray-500">Diantar ke gudang donasi</p>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer" @click="metode = 'ekspedisi'">
                            <input type="radio" name="metode_pengiriman" value="ekspedisi" class="peer sr-only" {{ old('metode_pengiriman', 'ekspedisi') === 'ekspedisi' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50"
                                 :class="metode === 'ekspedisi' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                                <div class="text-center">
                                    <span class="text-2xl">📦</span>
                                    <p class="text-sm font-bold text-gray-900 mt-1">Ekspedisi</p>
                                    <p class="text-xs text-gray-500">Menggunakan jasa kurir</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('metode_pengiriman') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Ekspedisi Details (dynamic) --}}
                <div x-show="metode === 'ekspedisi'" x-transition class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="nama_ekspedisi" class="block text-sm font-bold text-gray-700 mb-2">Nama Ekspedisi</label>
                        <input type="text" name="nama_ekspedisi" id="nama_ekspedisi" value="{{ old('nama_ekspedisi') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                               placeholder="Contoh: JNE, J&T, SiCepat">
                        @error('nama_ekspedisi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="no_resi" class="block text-sm font-bold text-gray-700 mb-2">No. Resi</label>
                        <input type="text" name="no_resi" id="no_resi" value="{{ old('no_resi') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                               placeholder="Masukkan nomor resi">
                        @error('no_resi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-4">
                    <button type="submit" class="px-8 py-3 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">
                        Kirim Donasi
                    </button>
                    <a href="{{ route('donatur.donations.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-donatur-layout>
