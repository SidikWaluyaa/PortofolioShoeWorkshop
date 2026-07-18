<x-app-layout>
    <x-slot name="header">Tambah Barang Katalog Donasi</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.donation-items.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 font-semibold transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8 max-w-4xl" x-data="formApp()">
        <form action="{{ route('admin.donation-items.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            @if(isset($donation))
                <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl mb-6">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-blue-500">info</span>
                        <div>
                            <h3 class="text-sm font-bold text-blue-900">Merilis Sepatu dari Dapur Restorasi</h3>
                            <p class="text-xs text-blue-700 mt-1">Sistem telah memuat data awal dari donasi
                                <strong>{{ $donation->nama_sepatu }}</strong>. Setelah disimpan, sepatu ini akan otomatis
                                diarsipkan dari antrean Dapur Restorasi.</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Barang --}}
                <div>
                    <label for="nama" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Nama
                        Barang <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama"
                        value="{{ old('nama', isset($donation) ? $donation->nama_sepatu : '') }}" required
                        placeholder="Contoh: Nike Air Max 90"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('nama')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Brand --}}
                <div>
                    <label for="brand"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Brand /
                        Merek</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}"
                        placeholder="Contoh: Nike (kosongkan jika tidak ada)"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('brand')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                {{-- Kategori --}}
                <div>
                    <label for="kategori"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Kategori <span
                            class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-semibold transition">
                        <option value="" disabled {{ old('kategori', isset($donation) ? 'sepatu' : '') ? '' : 'selected' }}>Pilih Kategori</option>
                        <option value="sepatu" {{ old('kategori', isset($donation) ? 'sepatu' : '') === 'sepatu' ? 'selected' : '' }}>👞 Sepatu</option>
                        <option value="tas" {{ old('kategori') === 'tas' ? 'selected' : '' }}>🎒 Tas</option>
                        <option value="topi" {{ old('kategori') === 'topi' ? 'selected' : '' }}>🧢 Topi</option>
                    </select>
                    @error('kategori')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kondisi --}}
                <div>
                    <label for="kondisi"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Kondisi <span
                            class="text-red-500">*</span></label>
                    <select id="kondisi" name="kondisi" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-semibold transition">
                        <option value="" disabled {{ old('kondisi') ? '' : 'selected' }}>Pilih Kondisi</option>
                        <option value="baru" {{ old('kondisi') === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="seperti_baru" {{ old('kondisi') === 'seperti_baru' ? 'selected' : '' }}>Like New
                        </option>
                        <option value="sudah_diperbaiki" {{ old('kondisi', isset($donation) ? 'sudah_diperbaiki' : 'sudah_diperbaiki') === 'sudah_diperbaiki' ? 'selected' : '' }}>Refurbished</option>
                    </select>
                    @error('kondisi')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ukuran --}}
                <div>
                    <label for="ukuran"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Ukuran</label>
                    <input type="text" id="ukuran" name="ukuran"
                        value="{{ old('ukuran', isset($donation) ? $donation->ukuran : '') }}"
                        placeholder="Contoh: US 10.5, Medium, All Size"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('ukuran')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Warna --}}
                <div>
                    <label for="warna"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Warna</label>
                    <input type="text" id="warna" name="warna" value="{{ old('warna') }}"
                        placeholder="Contoh: Hitam, Biru Navy"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('warna')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Status Ketersediaan
                        <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-semibold transition">
                        <option value="tersedia" {{ old('status', 'tersedia') === 'tersedia' ? 'selected' : '' }}>Tersedia
                        </option>
                        <option value="arsip" {{ old('status') === 'arsip' ? 'selected' : '' }}>Arsip</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Informasi Tambahan (Spesifikasi & Kelayakan) --}}
            <div class="border-t border-gray-100 pt-6">
                <h3 class="text-sm font-extrabold text-gray-800 uppercase tracking-wider mb-4">Informasi Spesifikasi &
                    Kelayakan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Berat Barang --}}
                    <div>
                        <label for="berat"
                            class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Berat Barang
                            (Gram)</label>
                        <input type="number" id="berat" name="berat" value="{{ old('berat') }}" min="0"
                            placeholder="Contoh: 850 (untuk 0.85 kg)"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                        @error('berat')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Skor Kelayakan --}}
                    <div>
                        <label for="score_kelayakan"
                            class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Skor Kelayakan
                            (%)</label>
                        <input type="number" id="score_kelayakan" name="score_kelayakan"
                            value="{{ old('score_kelayakan') }}" min="0" max="100" placeholder="Contoh: 90"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                        @error('score_kelayakan')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Dinamis Service Repeater --}}
            <div class="border-t border-gray-100 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-extrabold text-gray-800 uppercase tracking-wider">Jasa Restorasi / Reparasi
                    </h3>
                    <button type="button" @click="addService()"
                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#22AF85]/10 hover:bg-[#22AF85]/20 text-[#22AF85] text-xs font-bold rounded-lg transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Jasa
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="(srv, index) in services" :key="index">
                        <div
                            class="p-4 bg-gray-50 rounded-2xl border border-gray-200 relative space-y-4 sm:space-y-0 sm:flex sm:items-center sm:gap-4 pr-12">
                            {{-- Layanan Workshop Dropdown --}}
                            <div class="flex-1">
                                <label
                                    class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Layanan
                                    (Dropdown)</label>
                                <select :name="`services[${index}][service_id]`" x-model="srv.service_id"
                                    class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-semibold focus:outline-none focus:border-[#22AF85]">
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Jasa Kustom / Manual --}}
                            <div class="flex-1">
                                <label
                                    class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Jasa
                                    Kustom (Manual)</label>
                                <input type="text" :name="`services[${index}][jasa_nama_manual]`"
                                    x-model="srv.jasa_nama_manual" @input="
                                           const found = masterJasa.find(j => j.nama === srv.jasa_nama_manual);
                                           if (found) srv.jasa_harga = found.harga;
                                       " list="jasa-list-options" placeholder="Ketik atau pilih jasa..."
                                    autocomplete="off"
                                    class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium focus:outline-none focus:border-[#22AF85]" />
                            </div>

                            {{-- Biaya Jasa --}}
                            <div class="w-full sm:w-36">
                                <label
                                    class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Biaya
                                    Jasa (Rp)</label>
                                <input type="number" :name="`services[${index}][jasa_harga]`" x-model="srv.jasa_harga"
                                    placeholder="Contoh: 50000"
                                    class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium focus:outline-none focus:border-[#22AF85]" />
                            </div>

                            {{-- Estimasi Waktu --}}
                            <div class="w-full sm:w-28">
                                <label
                                    class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Waktu
                                    (Hari)</label>
                                <input type="number" :name="`services[${index}][jasa_estimasi_waktu]`"
                                    x-model="srv.jasa_estimasi_waktu" placeholder="Contoh: 3"
                                    class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium focus:outline-none focus:border-[#22AF85]" />
                            </div>

                            {{-- Jasa Wajib --}}
                            <div class="w-full sm:w-24">
                                <label
                                    class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5 text-center">Wajib?</label>
                                <div class="flex items-center justify-center mt-2">
                                    <input type="checkbox" :name="`services[${index}][is_mandatory]`" value="1"
                                        x-model="srv.is_mandatory"
                                        class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500 cursor-pointer" />
                                </div>
                            </div>

                            {{-- Hapus Baris button --}}
                            <button type="button" @click="removeService(index)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 p-1 rounded transition">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    <template x-if="services.length === 0">
                        <div
                            class="py-8 text-center text-gray-450 text-xs border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50">
                            Tidak ada jasa restorasi terdaftar. Klik "+ Tambah Jasa" untuk menambahkan.
                        </div>
                    </template>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="deskripsi"
                        class="block text-xs font-black text-gray-700 uppercase tracking-wider">Deskripsi Barang & Hasil
                        Reparasi</label>
                    <button type="button" @click="showAiModal = true"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white text-[10px] font-bold rounded-lg shadow-sm transition transform hover:-translate-y-0.5">
                        <span class="text-sm">✨</span> Generate dengan AI
                    </button>
                </div>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    placeholder="Jelaskan kondisi barang dan reparasi apa saja yang sudah dilakukan (misal: deep cleaning, reglue outsole, repaint upper)..."
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 pt-6">
                {{-- Foto Utama --}}
                <div class="space-y-3">
                    <label class="block text-xs font-black text-gray-700 uppercase tracking-wider">Foto Utama <span
                            class="text-red-500">*</span></label>
                    <p class="text-xs text-gray-400">Foto utama yang akan tampil di grid depan.</p>

                    <div
                        class="relative flex items-center justify-center border-2 border-dashed border-gray-200 hover:border-[#22AF85] rounded-2xl aspect-square max-h-[300px] w-full max-w-[300px] bg-gray-50 hover:bg-[#22AF85]/5 transition overflow-hidden group">
                        <input type="file" id="foto_utama" name="foto_utama" accept="image/*" required
                            @change="previewUtama" class="absolute inset-0 opacity-0 cursor-pointer z-10" />

                        <template x-if="!utamaPreviewUrl">
                            <div class="text-center p-4">
                                <span
                                    class="material-symbols-outlined !text-[32px] text-gray-400 group-hover:text-[#22AF85] mb-2">add_photo_alternate</span>
                                <p class="text-xs font-bold text-gray-500 group-hover:text-[#22AF85]">Pilih Foto Utama
                                </p>
                            </div>
                        </template>

                        <template x-if="utamaPreviewUrl">
                            <div class="w-full h-full relative">
                                <img :src="utamaPreviewUrl" class="w-full h-full object-cover" />
                                <button type="button" @click="clearUtama"
                                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-lg p-1.5 shadow-md transition z-20">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    @error('foto_utama')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto Detail --}}
                <div class="space-y-3">
                    <label class="block text-xs font-black text-gray-700 uppercase tracking-wider">Foto Detail
                        (Multi-Sudut)</label>
                    <p class="text-xs text-gray-400">Foto tambahan dari berbagai sisi barang untuk slider detail.</p>

                    <div
                        class="relative flex items-center justify-center border-2 border-dashed border-gray-200 hover:border-[#22AF85] rounded-2xl aspect-square max-h-[300px] w-full max-w-[300px] bg-gray-50 hover:bg-[#22AF85]/5 transition overflow-hidden group">
                        <input type="file" id="foto_detail" name="foto_detail[]" accept="image/*" multiple
                            @change="previewDetail" class="absolute inset-0 opacity-0 cursor-pointer z-10" />

                        <div class="text-center p-4">
                            <span
                                class="material-symbols-outlined !text-[32px] text-gray-400 group-hover:text-[#22AF85] mb-2">collections</span>
                            <p class="text-xs font-bold text-gray-500 group-hover:text-[#22AF85]">Pilih Foto Detail
                                (Multi)</p>
                            <p class="text-[10px] text-gray-400 mt-1" x-text="`Terpilih ${detailPreviews.length} foto`">
                            </p>
                        </div>
                    </div>
                    @error('foto_detail')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                    @error('foto_detail.*')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Grid Preview Detail --}}
            <template x-if="detailPreviews.length > 0">
                <div class="border-t border-gray-100 pt-6">
                    <p class="text-xs font-black text-gray-700 uppercase tracking-wider mb-3">Preview Foto Detail</p>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                        <template x-for="(url, index) in detailPreviews" :key="index">
                            <div class="relative rounded-xl border border-gray-200 aspect-square overflow-hidden group">
                                <img :src="url" class="w-full h-full object-cover" />
                                <button type="button" @click="removeDetail(index)"
                                    class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-md p-1 shadow-md transition opacity-0 group-hover:opacity-100">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            {{-- Actions --}}
            <div class="flex items-center gap-4 border-t border-gray-100 pt-6">
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-md">
                    Simpan Barang
                </button>
                <a href="{{ route('admin.donation-items.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-900 font-bold transition">Batal</a>
            </div>

            <!-- AI Modal Component -->
            <x-ai-description-modal />

        </form>

        <datalist id="jasa-list-options">
            <template x-for="jasa in masterJasa" :key="jasa.nama">
                <option :value="jasa.nama"></option>
            </template>
        </datalist>
    </div>

    {{-- Material Icons Font --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <script>
        function formApp() {
            return {
                utamaPreviewUrl: '',
                detailPreviews: [],
                detailFiles: [],
                services: <?php 
                    $oldServices = old('services');
if ($oldServices) {
    $servicesData = collect($oldServices)->map(function ($rs) {
        return [
            'service_id' => $rs['service_id'] ?? '',
            'jasa_nama_manual' => $rs['jasa_nama_manual'] ?? '',
            'jasa_harga' => $rs['jasa_harga'] ?? '',
            'jasa_estimasi_waktu' => $rs['jasa_estimasi_waktu'] ?? '',
            'is_mandatory' => !empty($rs['is_mandatory'])
        ];
    })->values()->toArray();
} else {
    $servicesData = [];
}
echo json_encode($servicesData);
                ?>,

                masterJasa: [
                    { "nama": "Lem Press", "harga": 210000 },
                    { "nama": "Lem Jahit", "harga": 210000 },
                    { "nama": "Lem Jahit Double", "harga": 230000 },
                    { "nama": "Lem Spesial (Lapis Kulit)", "harga": 275000 },
                    { "nama": "Lem Checkup", "harga": 125000 },
                    { "nama": "Lem Anak (SZ 25-30)", "harga": 80000 },
                    { "nama": "Lem Anak (SZ 30-35)", "harga": 110000 },
                    { "nama": "Ganti Sol Potong", "harga": 300000 },
                    { "nama": "Ganti Alas Polos", "harga": 225000 },
                    { "nama": "Ganti Alas Berpola", "harga": 275000 },
                    { "nama": "Ganti Alas Hak Cewe", "harga": 75000 },
                    { "nama": "Ganti Alas Hak Cowo", "harga": 175000 },
                    { "nama": "Ganti Alas Anak", "harga": 125000 },
                    { "nama": "Ganti Alas Polos + Lem Sole", "harga": 275000 },
                    { "nama": "Ganti Alas Pola + Lem Sole", "harga": 325000 },
                    { "nama": "Ganti Sol Crepe", "harga": 325000 },
                    { "nama": "Sepatu Premium", "harga": 725000 },
                    { "nama": "Resize", "harga": 225000 },
                    { "nama": "Upsize (Shoelast)", "harga": 125000 },
                    { "nama": "Downsize (Double Insole)", "harga": 175000 },
                    { "nama": "Shoelast", "harga": 50000 },
                    { "nama": "Bongkar Sole", "harga": 125000 },
                    { "nama": "Midsole Flat", "harga": 305000 },
                    { "nama": "Midsole Non Flat", "harga": 355000 },
                    { "nama": "Midsole Hard", "harga": 480000 },
                    { "nama": "Midsole Lapis", "harga": 125000 },
                    { "nama": "Midsole Lapis Kulit", "harga": 175000 },
                    { "nama": "Ganti Sol Kulit", "harga": 525000 },
                    { "nama": "Ganti Sol Kulit + Alas", "harga": 675000 },
                    { "nama": "Goodyear Welt", "harga": 1000000 },
                    { "nama": "Goodyear Welt + Vibram", "harga": 1900000 },
                    { "nama": "Ganti Sol Jadi (Cupsole)", "harga": 250000 },
                    { "nama": "Ganti Sol Jadi Spesial", "harga": 275000 },
                    { "nama": "Ganti Sol Foxing", "harga": 225000 },
                    { "nama": "Ganti Sol Foxing + Alas", "harga": 275000 },
                    { "nama": "Swapsole Type Sol Cup", "harga": 190000 },
                    { "nama": "Swapsole Type Sol Potong", "harga": 225000 },
                    { "nama": "Alas Komponen + Lem", "harga": 180000 },
                    { "nama": "Repaint Standard", "harga": 170000 },
                    { "nama": "Repaint Standard Bahan Spesial", "harga": 195000 },
                    { "nama": "Repaint Spesial", "harga": 195000 },
                    { "nama": "Repaint Spesial Bahan Spesial", "harga": 245000 },
                    { "nama": "Repaint Patina", "harga": 245000 },
                    { "nama": "Repaint Patina Bahan Spesial", "harga": 295000 },
                    { "nama": "Repaint Multicolor 2 Warna", "harga": 245000 },
                    { "nama": "Repaint Multicolor >3 Warna", "harga": 295000 },
                    { "nama": "Repaint Premium", "harga": 375000 },
                    { "nama": "Upper Treatment", "harga": 90000 },
                    { "nama": "Unyellowing Sole", "harga": 125000 },
                    { "nama": "Ganti Upper Pola Standard (Quarter-S)", "harga": 175000 },
                    { "nama": "Ganti Upper Pola Kecil", "harga": 75000 },
                    { "nama": "Ganti Upper Pola Sedang (Quarter-M)", "harga": 225000 },
                    { "nama": "Ganti Upper Pola Besar (Quarter-L)", "harga": 325000 },
                    { "nama": "Ganti Lining Kulit", "harga": 225000 },
                    { "nama": "Ganti Lining Mesh", "harga": 175000 },
                    { "nama": "Ganti Lining Pola Besar", "harga": 325000 },
                    { "nama": "Ganti Lining + Padded Collar", "harga": 275000 },
                    { "nama": "Ganti Stabilizer + Lem", "harga": 225000 },
                    { "nama": "Lapis Kulit Keliling", "harga": 125000 },
                    { "nama": "Lapis Kanvas Keliling", "harga": 125000 },
                    { "nama": "Lapis Kulit 1 Pola", "harga": 175000 },
                    { "nama": "Lapis Kulit Depan/Belakang", "harga": 75000 },
                    { "nama": "Lapis Kulit Recon", "harga": 275000 },
                    { "nama": "Laser", "harga": 95000 },
                    { "nama": "DTF", "harga": 75000 },
                    { "nama": "Ganti Velcrow", "harga": 175000 },
                    { "nama": "Ganti Karet Elastis Kecil", "harga": 125000 },
                    { "nama": "Ganti Karet Elastis 1 Pola", "harga": 175000 },
                    { "nama": "Ganti Zipper", "harga": 175000 },
                    { "nama": "Custom Zipper", "harga": 225000 },
                    { "nama": "Insole Kulit", "harga": 125000 },
                    { "nama": "Insole Mesh", "harga": 75000 },
                    { "nama": "Tambah Busa Insole (Upsize)", "harga": 175000 },
                    { "nama": "Ganti Boa Lacing", "harga": 700000 },
                    { "nama": "Service Boa Lacing", "harga": 275000 },
                    { "nama": "Ganti Eyelet <10 Lubang (Reparasi)", "harga": 125000 },
                    { "nama": "Ganti Eyelet >10 Lubang (Reparasi)", "harga": 175000 },
                    { "nama": "Ganti Tambah TA", "harga": 125000 },
                    { "nama": "Toecup", "harga": 75000 },
                    { "nama": "Custom Upper", "harga": 275000 },
                    { "nama": "Ganti Steel Toe", "harga": 175000 },
                    { "nama": "Pengait Lidah", "harga": 125000 },
                    { "nama": "Tambah Stabilizer", "harga": 75000 },
                    { "nama": "Ganti Paded", "harga": 175000 },
                    { "nama": "Rapihkan Jahitan", "harga": 125000 },
                    { "nama": "Sole Protector >Size 42", "harga": 250000 },
                    { "nama": "Sole Protector <Size 42", "harga": 225000 },
                    { "nama": "Ganti Hook 1 pc", "harga": 15000 },
                    { "nama": "Ganti D-Ring 1 pcs", "harga": 20000 },
                    { "nama": "Ganti Eyelet <10 Lubang (Aksesoris)", "harga": 65000 },
                    { "nama": "Ganti Eyelet >10 Lubang (Aksesoris)", "harga": 115000 },
                    { "nama": "Heel Patch", "harga": 35000 }
                ],

                addService() {
                    this.services.push({ service_id: '', jasa_nama_manual: '', jasa_harga: '', jasa_estimasi_waktu: '', is_mandatory: true });
                },

                removeService(index) {
                    this.services.splice(index, 1);
                },

                previewUtama(e) {
                    const file = e.target.files[0];
                    if (file) {
                        this.utamaPreviewUrl = URL.createObjectURL(file);
                    }
                },

                clearUtama() {
                    this.utamaPreviewUrl = '';
                    document.getElementById('foto_utama').value = '';
                },

                previewDetail(e) {
                    const files = Array.from(e.target.files);
                    files.forEach(file => {
                        this.detailFiles.push(file);
                        this.detailPreviews.push(URL.createObjectURL(file));
                    });
                    this.updateDetailInput();
                },

                removeDetail(index) {
                    this.detailPreviews.splice(index, 1);
                    this.detailFiles.splice(index, 1);
                    this.updateDetailInput();
                },

                updateDetailInput() {
                    const dataTransfer = new DataTransfer();
                    this.detailFiles.forEach(file => dataTransfer.items.add(file));
                    document.getElementById('foto_detail').files = dataTransfer.files;
                },

                // --- AI Generator Logic ---
                showAiModal: false,
                isGeneratingAi: false,
                aiError: '',
                aiForm: {
                    tipe: '',
                    bahan_upper: '',
                    gender: '',
                    sol: '',
                    upper: '',
                    jahitan: '',
                    insole: '',
                    tali: '',
                    kelengkapan: [],
                    catatan: ''
                },

                async generateAi() {
                    this.isGeneratingAi = true;
                    this.aiError = '';

                    const payload = {
                        ...this.aiForm,
                        nama_barang: document.getElementById('nama')?.value || '',
                        merek: document.getElementById('brand')?.value || '',
                        ukuran: document.getElementById('ukuran')?.value || '',
                        warna: document.getElementById('warna')?.value || '',
                        kategori: document.getElementById('kategori_id')?.options[document.getElementById('kategori_id').selectedIndex]?.text || '',
                        kondisi_umum: document.getElementById('kondisi')?.options[document.getElementById('kondisi').selectedIndex]?.text || '',
                        services: this.services.map((srv, idx) => {
                            const selectEl = document.querySelector(`select[name="services[${idx}][service_id]"]`);
                            return {
                                layanan: selectEl && selectEl.selectedIndex > 0 ? selectEl.options[selectEl.selectedIndex].text : '',
                                kustom: srv.jasa_nama_manual,
                                biaya: srv.jasa_harga,
                                wajib: srv.is_mandatory ? 'Ya' : 'Tidak'
                            };
                        })
                    };

                    try {
                        const response = await fetch('{{ route("admin.ai.generate-description") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.error || 'Terjadi kesalahan saat memanggil AI.');
                        }

                        if (data.description) {
                            document.getElementById('deskripsi').value = data.description;
                            this.showAiModal = false;
                        }
                    } catch (error) {
                        this.aiError = error.message;
                    } finally {
                        this.isGeneratingAi = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>