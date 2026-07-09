<div x-show="showAiModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" x-cloak>
    <div x-show="showAiModal" x-transition.opacity class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" @click="showAiModal = false"></div>

    <div x-show="showAiModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative bg-white rounded-2xl shadow-xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <div>
                <h3 class="text-lg font-black text-gray-900 flex items-center gap-2">
                    <span class="text-xl">✨</span> AI Description Generator
                </h3>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Isi detail kondisi untuk menghasilkan teks deskripsi natural.</p>
            </div>
            <button type="button" @click="showAiModal = false" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Body -->
        <div class="p-6 overflow-y-auto flex-1 space-y-6">
            {{-- Info Dasar --}}
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Bahan Upper</label>
                        <select x-model="aiForm.bahan_upper" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Bahan</option>
                            <option value="Kanvas">Kanvas</option>
                            <option value="Kulit Asli">Kulit Asli</option>
                            <option value="Suede">Suede</option>
                            <option value="Mesh">Mesh</option>
                            <option value="Kulit Sintetis">Kulit Sintetis</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Gender / Kategori</label>
                        <select x-model="aiForm.gender" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Kategori</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                            <option value="Unisex">Unisex</option>
                            <option value="Anak-anak">Anak-anak</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Detail Kondisi Bagian --}}
            <div>
                <h4 class="text-sm font-extrabold text-gray-800 border-b border-gray-100 pb-2 mb-4">Detail Kondisi Per Bagian</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    {{-- Sol --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Sol (Outsole)</label>
                        <select x-model="aiForm.sol" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Kondisi Sol</option>
                            <option value="Tebal, grip masih bagus">Tebal, grip masih bagus</option>
                            <option value="Mulai tipis / aus di bagian tertentu (mis: tumit)">Mulai tipis / aus sebagian</option>
                            <option value="Mulai terkelupas/lepas dari upper">Mulai terkelupas/lepas</option>
                            <option value="Retak/getas">Retak/getas</option>
                            <option value="Sudah diganti baru (reglue/resole)">Sudah diganti baru</option>
                        </select>
                    </div>
                    {{-- Upper --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Upper</label>
                        <select x-model="aiForm.upper" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Kondisi Upper</option>
                            <option value="Bersih, tanpa noda">Bersih, tanpa noda</option>
                            <option value="Ada noda ringan (bisa dibersihkan)">Ada noda ringan</option>
                            <option value="Ada noda membandel">Ada noda membandel</option>
                            <option value="Warna masih cerah">Warna masih cerah</option>
                            <option value="Warna mulai pudar">Warna mulai pudar</option>
                            <option value="Ada sobek/lubang kecil">Ada sobek/lubang kecil</option>
                        </select>
                    </div>
                    {{-- Jahitan --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Jahitan & Lem</label>
                        <select x-model="aiForm.jahitan" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Kondisi Jahitan & Lem</option>
                            <option value="Rapi, tidak ada yang lepas">Rapi, tidak ada yang lepas</option>
                            <option value="Ada jahitan renggang">Ada jahitan renggang</option>
                            <option value="Ada bagian lem yang mulai lepas">Ada bagian lem yang lepas</option>
                            <option value="Sudah dijahit ulang / dilem (reparasi)">Sudah direparasi (dijahit/dilem)</option>
                        </select>
                    </div>
                    {{-- Insole --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Insole & Interior</label>
                        <select x-model="aiForm.insole" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Kondisi Insole</option>
                            <option value="Empuk, masih nyaman">Empuk, masih nyaman</option>
                            <option value="Sudah kempes/tipis">Sudah kempes/tipis</option>
                            <option value="Ada noda/bau di dalam">Ada noda di dalam</option>
                            <option value="Lapisan dalam mengelupas">Lapisan dalam mengelupas</option>
                            <option value="Insole sudah diganti baru">Insole diganti baru</option>
                        </select>
                    </div>
                    {{-- Tali --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Tali & Aksesoris</label>
                        <select x-model="aiForm.tali" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition">
                            <option value="">Pilih Kondisi Tali</option>
                            <option value="Tali original masih bagus">Tali original masih bagus</option>
                            <option value="Tali diganti baru">Tali diganti baru</option>
                            <option value="Tali rusak / tidak ada tali">Tali rusak/tidak ada</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Kelengkapan & Catatan --}}
            <div>
                <h4 class="text-sm font-extrabold text-gray-800 border-b border-gray-100 pb-2 mb-4">Kelengkapan & Catatan Tambahan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-2">Kelengkapan (Bisa pilih multiple)</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="Sepasang lengkap" x-model="aiForm.kelengkapan" class="w-4 h-4 text-emerald-500 rounded border-gray-300 focus:ring-emerald-500">
                                <span class="text-xs font-medium text-gray-700">Sepasang lengkap</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="Ada box/dus asli" x-model="aiForm.kelengkapan" class="w-4 h-4 text-emerald-500 rounded border-gray-300 focus:ring-emerald-500">
                                <span class="text-xs font-medium text-gray-700">Ada box/dus asli</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="Ada tali cadangan" x-model="aiForm.kelengkapan" class="w-4 h-4 text-emerald-500 rounded border-gray-300 focus:ring-emerald-500">
                                <span class="text-xs font-medium text-gray-700">Ada tali cadangan</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-wider mb-1.5">Catatan Tambahan (Opsional)</label>
                        <textarea x-model="aiForm.catatan" rows="3" placeholder="Contoh: Sedikit belang di bagian ujung kanan karena sinar matahari..."
                                  class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-[#22AF85]/20 focus:border-[#22AF85] transition resize-none"></textarea>
                    </div>
                </div>
            </div>
            
            {{-- Error Message Alert --}}
            <div x-show="aiError" class="p-3 bg-red-50 border border-red-100 text-red-600 text-xs font-semibold rounded-xl flex items-start gap-2" x-cloak>
                <span class="material-symbols-outlined !text-[16px]">error</span>
                <span x-text="aiError"></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-3 rounded-b-2xl">
            <button type="button" @click="showAiModal = false" :disabled="isGeneratingAi"
                    class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition disabled:opacity-50">
                Batal
            </button>
            <button type="button" @click="generateAi()" :disabled="isGeneratingAi"
                    class="px-5 py-2 bg-[#22AF85] text-white text-xs font-bold rounded-xl hover:bg-[#1d9672] focus:outline-none focus:ring-2 focus:ring-[#22AF85]/50 transition shadow-sm flex items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                <template x-if="!isGeneratingAi">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined !text-[16px]">auto_awesome</span> Generate
                    </span>
                </template>
                <template x-if="isGeneratingAi">
                    <span class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Memproses...
                    </span>
                </template>
            </button>
        </div>
    </div>
</div>
