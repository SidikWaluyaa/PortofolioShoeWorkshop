<x-app-layout>
    <x-slot name="header">Tambah Barang Katalog Donasi</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.donation-items.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 font-semibold transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8 max-w-4xl" x-data="imageUploads()">
        <form action="{{ route('admin.donation-items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Barang --}}
                <div>
                    <label for="nama" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Nama Barang <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Nike Air Max 90"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('nama')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Brand --}}
                <div>
                    <label for="brand" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Brand / Merek</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}" placeholder="Contoh: Nike (kosongkan jika tidak ada)"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('brand')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                {{-- Kategori --}}
                <div>
                    <label for="kategori" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori" required
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-semibold transition">
                        <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori</option>
                        <option value="sepatu" {{ old('kategori') === 'sepatu' ? 'selected' : '' }}>👞 Sepatu</option>
                        <option value="tas" {{ old('kategori') === 'tas' ? 'selected' : '' }}>🎒 Tas</option>
                        <option value="topi" {{ old('kategori') === 'topi' ? 'selected' : '' }}>🧢 Topi</option>
                    </select>
                    @error('kategori')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kondisi --}}
                <div>
                    <label for="kondisi" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Kondisi <span class="text-red-500">*</span></label>
                    <select id="kondisi" name="kondisi" required
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-semibold transition">
                        <option value="" disabled {{ old('kondisi') ? '' : 'selected' }}>Pilih Kondisi</option>
                        <option value="baru" {{ old('kondisi') === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="seperti_baru" {{ old('kondisi') === 'seperti_baru' ? 'selected' : '' }}>Like New</option>
                        <option value="sudah_diperbaiki" {{ old('kondisi', 'sudah_diperbaiki') === 'sudah_diperbaiki' ? 'selected' : '' }}>Refurbished</option>
                    </select>
                    @error('kondisi')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ukuran --}}
                <div>
                    <label for="ukuran" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Ukuran</label>
                    <input type="text" id="ukuran" name="ukuran" value="{{ old('ukuran') }}" placeholder="Contoh: US 10.5, Medium, All Size"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition" />
                    @error('ukuran')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Status Ketersediaan <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-semibold transition">
                        <option value="tersedia" {{ old('status', 'tersedia') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disalurkan" {{ old('status') === 'disalurkan' ? 'selected' : '' }}>Sudah Disalurkan</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="deskripsi" class="block text-xs font-black text-gray-700 uppercase tracking-wider mb-2">Deskripsi Barang & Hasil Reparasi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan kondisi barang dan reparasi apa saja yang sudah dilakukan (misal: deep cleaning, reglue outsole, repaint upper)..."
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] text-sm text-gray-900 font-medium transition">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 pt-6">
                {{-- Foto Utama --}}
                <div class="space-y-3">
                    <label class="block text-xs font-black text-gray-700 uppercase tracking-wider">Foto Utama <span class="text-red-500">*</span></label>
                    <p class="text-xs text-gray-400">Foto utama yang akan tampil di grid depan.</p>
                    
                    <div class="relative flex items-center justify-center border-2 border-dashed border-gray-200 hover:border-[#22AF85] rounded-2xl h-48 bg-gray-50 hover:bg-[#22AF85]/5 transition overflow-hidden group">
                        <input type="file" id="foto_utama" name="foto_utama" accept="image/*" required @change="previewUtama"
                               class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                        
                        <template x-if="!utamaPreviewUrl">
                            <div class="text-center p-4">
                                <span class="material-symbols-outlined !text-[32px] text-gray-400 group-hover:text-[#22AF85] mb-2">add_photo_alternate</span>
                                <p class="text-xs font-bold text-gray-500 group-hover:text-[#22AF85]">Pilih Foto Utama</p>
                            </div>
                        </template>

                        <template x-if="utamaPreviewUrl">
                            <div class="w-full h-full relative">
                                <img :src="utamaPreviewUrl" class="w-full h-full object-cover" />
                                <button type="button" @click="clearUtama" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-lg p-1.5 shadow-md transition z-20">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
                    <label class="block text-xs font-black text-gray-700 uppercase tracking-wider">Foto Detail (Multi-Sudut)</label>
                    <p class="text-xs text-gray-400">Foto tambahan dari berbagai sisi barang untuk slider detail.</p>
                    
                    <div class="relative flex items-center justify-center border-2 border-dashed border-gray-200 hover:border-[#22AF85] rounded-2xl h-48 bg-gray-50 hover:bg-[#22AF85]/5 transition overflow-hidden group">
                        <input type="file" id="foto_detail" name="foto_detail[]" accept="image/*" multiple @change="previewDetail"
                               class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                        
                        <div class="text-center p-4">
                            <span class="material-symbols-outlined !text-[32px] text-gray-400 group-hover:text-[#22AF85] mb-2">collections</span>
                            <p class="text-xs font-bold text-gray-500 group-hover:text-[#22AF85]">Pilih Foto Detail (Multi)</p>
                            <p class="text-[10px] text-gray-400 mt-1" x-text="`Terpilih ${detailPreviews.length} foto`"></p>
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
                            <div class="relative rounded-xl border border-gray-150 h-24 overflow-hidden group">
                                <img :src="url" class="w-full h-full object-cover" />
                                <button type="button" @click="removeDetail(index)" class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-md p-1 shadow-md transition opacity-0 group-hover:opacity-100">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            {{-- Actions --}}
            <div class="flex items-center gap-4 border-t border-gray-100 pt-6">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#1d9a75] transition shadow-md">
                    Simpan Barang
                </button>
                <a href="{{ route('admin.donation-items.index') }}" class="text-sm text-gray-500 hover:text-gray-900 font-bold transition">Batal</a>
            </div>
        </form>
    </div>

    {{-- Material Icons Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <script>
        function imageUploads() {
            return {
                utamaPreviewUrl: '',
                detailPreviews: [],
                detailFiles: [],

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
                    // Update the actual file input files list if possible (read-only for standard inputs,
                    // but we can pass them in the backend via array. It is fine as browser will send
                    // whatever was selected. To allow removals we could just let the backend receive them).
                    // This is primarily for visual feedback, but to fully bind file lists in JS:
                    const dataTransfer = new DataTransfer();
                    this.detailFiles.forEach(file => dataTransfer.items.add(file));
                    document.getElementById('foto_detail').files = dataTransfer.files;
                }
            }
        }
    </script>
</x-app-layout>
