<x-donatur-layout>
    <x-slot name="header">Edit Donasi Sepatu</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Form Column --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <form action="{{ route('donatur.donations.update', $donation) }}" method="POST" enctype="multipart/form-data" 
                      x-data="{ 
                          metode: '{{ old('metode_pengiriman', $donation->metode_pengiriman) }}', 
                          existingPhotos: {{ json_encode($donation->foto_path ?? []) }}, 
                          uploadedFiles: [], 
                          triggerInput() { 
                              this.$refs.fileInput.click(); 
                          }, 
                          handleFiles(event) { 
                              const selected = Array.from(event.target.files); 
                              selected.forEach(file => { 
                                  this.uploadedFiles.push({ 
                                      id: Math.random().toString(36).substring(2, 9), 
                                      file: file, 
                                      url: URL.createObjectURL(file) 
                                  }); 
                              }); 
                              this.syncFiles(); 
                              event.target.value = ''; 
                          }, 
                          removeUploadedFile(index) { 
                              URL.revokeObjectURL(this.uploadedFiles[index].url); 
                              this.uploadedFiles.splice(index, 1); 
                              this.syncFiles(); 
                          }, 
                          removeExistingPhoto(index) { 
                              this.existingPhotos.splice(index, 1); 
                          }, 
                          syncFiles() { 
                              const dataTransfer = new DataTransfer(); 
                              this.uploadedFiles.forEach(item => { 
                                  dataTransfer.items.add(item.file); 
                              }); 
                              this.$refs.realInput.files = dataTransfer.files; 
                              this.$refs.realInput.dispatchEvent(new Event('change', { bubbles: true }));
                          },
                          totalPhotos() {
                              return this.existingPhotos.length + this.uploadedFiles.length;
                          }
                      }">
                    @csrf
                    @method('PUT')

                    <!-- Hidden input to indicate that photo editing fields are present -->
                    <input type="hidden" name="existing_photos_present" value="1">
                    
                    <!-- Render hidden inputs for each remaining existing photo -->
                    <template x-for="(path, idx) in existingPhotos" :key="idx">
                        <input type="hidden" name="existing_photos[]" :value="path">
                    </template>

                    {{-- Nama Sepatu --}}
                    <div class="mb-6">
                        <label for="nama_sepatu" class="block text-sm font-bold text-gray-700 mb-2">Nama Sepatu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sepatu" id="nama_sepatu" value="{{ old('nama_sepatu', $donation->nama_sepatu) }}" required
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                               placeholder="Contoh: Nike Air Jordan 1">
                        @error('nama_sepatu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        {{-- Ukuran --}}
                        <div>
                            <label for="ukuran" class="block text-sm font-bold text-gray-700 mb-2">Ukuran <span class="text-red-500">*</span></label>
                            <input type="text" name="ukuran" id="ukuran" value="{{ old('ukuran', $donation->ukuran) }}" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="42">
                            @error('ukuran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Estimasi Harga --}}
                        <div>
                            <label for="harga" class="block text-sm font-bold text-gray-700 mb-2">Estimasi Nilai (Rp)</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga', $donation->harga) }}" min="0"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="500000">
                            @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Kondisi Slider --}}
                    <div class="mb-6" x-data="{ kondisi: {{ old('kondisi', $donation->kondisi ?? 50) }} }">
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
                                  placeholder="Jelaskan kondisi sepatu secara detail...">{{ old('deskripsi', $donation->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Foto Sepatu --}}
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Foto Sepatu <span class="text-red-500">*</span></label>
                        
                        <!-- Upload Container Grid/Box -->
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-emerald-400 transition relative bg-gray-50/50">
                            <!-- Previews Grid -->
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-4" x-show="totalPhotos() > 0">
                                
                                <!-- Existing Photos -->
                                <template x-for="(path, index) in existingPhotos" :key="path">
                                    <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200 bg-white group shadow-sm">
                                        <img :src="'{{ asset('storage') }}/' + path" class="w-full h-full object-cover">
                                        
                                        <!-- Hover Overlay with Delete Button -->
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <button type="button" @click.stop="removeExistingPhoto(index)" class="p-1.5 bg-red-600 hover:bg-red-700 text-white rounded-full transition shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Tag/Number -->
                                        <div class="absolute bottom-1 left-1 bg-emerald-600/90 text-[9px] text-white px-1.5 py-0.5 rounded font-bold">
                                            Lama #<span x-text="index + 1"></span>
                                        </div>
                                    </div>
                                </template>

                                <!-- New Uploaded Photos -->
                                <template x-for="(fileObj, index) in uploadedFiles" :key="fileObj.id">
                                    <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200 bg-white group shadow-sm">
                                        <img :src="fileObj.url" class="w-full h-full object-cover">
                                        
                                        <!-- Hover Overlay with Delete Button -->
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <button type="button" @click.stop="removeUploadedFile(index)" class="p-1.5 bg-red-600 hover:bg-red-700 text-white rounded-full transition shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Tag/Number -->
                                        <div class="absolute bottom-1 left-1 bg-blue-600/90 text-[9px] text-white px-1.5 py-0.5 rounded font-bold">
                                            Baru #<span x-text="index + 1"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Empty/Placeholder state -->
                            <div class="text-center py-4 cursor-pointer" x-show="totalPhotos() === 0" @click="triggerInput()">
                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-sm text-gray-500 font-bold">Unggah Foto Sepatu</p>
                                <p class="text-xs text-gray-400 mt-1">Klik untuk memilih satu atau beberapa foto sekaligus</p>
                            </div>
                        </div>

                        <!-- Action Buttons below -->
                        <div class="flex items-center justify-between mt-2.5">
                            <div>
                                <button type="button" @click="triggerInput()" class="inline-flex items-center gap-1.5 px-4 py-2 border border-emerald-500 text-emerald-600 hover:bg-emerald-50 rounded-xl text-xs font-bold transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Tambah Foto
                                </button>
                            </div>
                            <span class="text-xs text-gray-400 font-bold" x-text="totalPhotos() + ' foto total'"></span>
                        </div>

                        <!-- Hidden files inputs -->
                        <input type="file" x-ref="fileInput" accept="image/*" class="hidden" multiple @change="handleFiles($event)">
                        <input type="file" name="foto[]" x-ref="realInput" id="foto" class="hidden" multiple :required="totalPhotos() === 0">

                        <p class="text-xs text-gray-400 mt-1.5">Sistem mengompresi gambar otomatis demi performa optimal. Pastikan minimal ada 1 foto.</p>
                        @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        @error('foto.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Metode Pengiriman --}}
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-3">Metode Pengiriman <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer" @click="metode = 'antar_langsung'">
                                <input type="radio" name="metode_pengiriman" value="antar_langsung" class="peer sr-only" {{ old('metode_pengiriman', $donation->metode_pengiriman) === 'antar_langsung' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50"
                                     :class="metode === 'antar_langsung' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-3xl text-emerald-600 block mx-auto">home</span>
                                        <p class="text-sm font-bold text-gray-900 mt-2">Antar Langsung</p>
                                        <p class="text-xs text-gray-500">Diantar ke gudang donasi</p>
                                    </div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer" @click="metode = 'ekspedisi'">
                                <input type="radio" name="metode_pengiriman" value="ekspedisi" class="peer sr-only" {{ old('metode_pengiriman', $donation->metode_pengiriman) === 'ekspedisi' ? 'checked' : '' }}>
                                <div class="p-4 rounded-xl border-2 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50"
                                     :class="metode === 'ekspedisi' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-3xl text-emerald-600 block mx-auto">local_shipping</span>
                                        <p class="text-sm font-bold text-gray-900 mt-2">Ekspedisi</p>
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
                            <input type="text" name="nama_ekspedisi" id="nama_ekspedisi" value="{{ old('nama_ekspedisi', $donation->nama_ekspedisi) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="Contoh: JNE, J&T, SiCepat">
                            @error('nama_ekspedisi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="no_resi" class="block text-sm font-bold text-gray-700 mb-2">No. Resi</label>
                            <input type="text" name="no_resi" id="no_resi" value="{{ old('no_resi', $donation->no_resi) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="Masukkan nomor resi">
                            @error('no_resi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-8 py-3 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('donatur.donations.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Guideline Column --}}
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-500 !text-[20px]">photo_camera</span>
                    Panduan Sudut Foto Sepatu
                </h3>
                <p class="text-xs text-gray-500 mb-4 leading-relaxed">Untuk mempercepat verifikasi kondisi oleh tim kami, harap unggah foto sepatu dengan 4 sudut pengambilan gambar (angle) sebagai berikut:</p>
                
                <!-- Guideline Image -->
                <div class="rounded-xl overflow-hidden border border-gray-100 shadow-sm mb-4 bg-gray-50 aspect-[16/9] flex items-center justify-center">
                    <img src="{{ asset('images/contoh_angle_sepatu.jpg') }}" alt="Panduan Angle Foto Sepatu" class="w-full h-full object-cover">
                </div>

                <!-- Legend of Angles -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-xs font-bold text-emerald-600">1. Sisi Depan</span>
                        <p class="text-[10px] text-gray-400 mt-0.5 leading-relaxed">Menilai kerapian ujung depan (toe box), lidah, & tali.</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-xs font-bold text-emerald-600">2. Sisi Samping</span>
                        <p class="text-[10px] text-gray-400 mt-0.5 leading-relaxed">Menilai kondisi sol samping, logo, & keausan outsole.</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-xs font-bold text-emerald-600">3. Sisi Belakang</span>
                        <p class="text-[10px] text-gray-400 mt-0.5 leading-relaxed">Menilai bentuk tumit (heel counter) & sol belakang.</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-xs font-bold text-emerald-600">4. Detail Samping</span>
                        <p class="text-[10px] text-gray-400 mt-0.5 leading-relaxed">Menilai sol bagian dalam, insole, dan tag ukuran.</p>
                    </div>
                </div>

                <div class="mt-4 p-3.5 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-100 flex gap-2">
                    <span class="material-symbols-outlined text-emerald-600 !text-[18px] flex-shrink-0">info</span>
                    <p class="text-[10px] leading-relaxed">Pastikan pencahayaan cukup terang, tidak blur/buram, dan menampilkan detail fisik sepatu secara jelas.</p>
                </div>
            </div>
        </div>
    </div>
</x-donatur-layout>
