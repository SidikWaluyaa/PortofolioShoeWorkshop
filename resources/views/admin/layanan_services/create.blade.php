<x-app-layout>
    <x-slot name="header">
        Tambah Sub-Jasa
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('admin.layanan-categories.services.index', $layanan_category->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-black text-gray-900">Tambah Sub-Jasa Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Kategori: <span class="font-bold text-emerald-600">{{ $layanan_category->name }}</span></p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
            <ul class="list-disc pl-5 text-sm font-medium space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('admin.layanan-categories.services.store', $layanan_category->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- KIRI: INFORMASI TEKS -->
                <div class="space-y-6">
                    <h3 class="text-sm font-black tracking-wider text-gray-400 uppercase border-b border-gray-100 pb-2 mb-4">Informasi Jasa</h3>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Jasa *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Contoh: Reglue Full">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Subtitle Teknis</label>
                        <input type="text" name="subtitle_teknis" value="{{ old('subtitle_teknis') }}" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Contoh: (Bongkar Pasang + Jahit)">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Proses Pengerjaan</label>
                        <textarea name="proses" rows="3" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Jelaskan apa yang dilakukan tim...">{{ old('proses') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Kapan Butuh Ini?</label>
                        <textarea name="kapan" rows="2" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Kondisi sepatu seperti apa yang butuh ini?">{{ old('kapan') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Kenapa Penting?</label>
                        <textarea name="kenapa_penting" rows="2" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Alasan customer harus memilih ini...">{{ old('kenapa_penting') }}</textarea>
                    </div>
                </div>

                <!-- KANAN: PENGATURAN & FOTO -->
                <div class="space-y-6">
                    <h3 class="text-sm font-black tracking-wider text-gray-400 uppercase border-b border-gray-100 pb-2 mb-4">Pengaturan & Media</h3>

                    <div class="bg-amber-50/50 border border-amber-200 rounded-xl p-5 mb-6">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_preview" value="1" {{ old('is_preview') ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-amber-500 focus:ring-amber-500 cursor-pointer">
                            </div>
                            <div class="text-sm">
                                <span class="font-bold text-gray-900 block mb-0.5">Tampilkan Sebagai Kartu Utama (Preview)</span>
                                <span class="text-gray-500">Jika dicentang, jasa ini akan tampil besar dengan slider Before-After di luar Akordion. Jika tidak, ia akan disembunyikan di dalam tombol Akordion "Lihat jasa lainnya".</span>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Foto Before (Sebelum)</label>
                            <input type="file" name="image_before" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                            <p class="text-[10px] text-gray-400 mt-2">Rasio 1:1 disarankan. Max 2MB.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Foto After (Sesudah)</label>
                            <input type="file" name="image_after" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.layanan-categories.services.index', $layanan_category->id) }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#22AF85] text-white text-sm font-bold hover:bg-[#1a8b69] transition-colors shadow-sm shadow-[#22AF85]/20">Simpan Jasa</button>
            </div>
        </form>
    </div>
</x-app-layout>
