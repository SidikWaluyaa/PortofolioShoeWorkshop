<x-app-layout>
    <x-slot name="header">
        Tambah Kategori Layanan
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('admin.layanan-categories.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-black text-gray-900">Tambah Kategori Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Buat kategori utama (misal: "Reparasi Sol", "Treatment").</p>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <form action="{{ route('admin.layanan-categories.store') }}" method="POST" class="p-6 md:p-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- KIRI: INFORMASI UTAMA -->
                <div class="space-y-6">
                    <h3 class="text-sm font-black tracking-wider text-gray-400 uppercase border-b border-gray-100 pb-2 mb-4">Informasi Utama</h3>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Kategori *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Contoh: Reparasi Sol">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Urutan (Order) *</label>
                            <input type="number" name="order" value="{{ old('order', 1) }}" required class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder='Contoh: "Perbaikan total tanpa batas"'>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                        <textarea name="description" rows="4" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm" placeholder="Jelaskan secara detail kategori ini...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- KANAN: NILAI & CTA -->
                <div class="space-y-6">
                    <h3 class="text-sm font-black tracking-wider text-gray-400 uppercase border-b border-gray-100 pb-2 mb-4">Nilai & Call to Action</h3>

                    <div class="bg-blue-50/50 p-5 rounded-xl border border-blue-100 space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-blue-900 mb-1.5">Nilai Material (Material Value)</label>
                            <textarea name="value_material" rows="2" class="w-full rounded-xl border-blue-200 focus:border-blue-500 focus:ring-blue-500 text-sm bg-white" placeholder="Contoh: Menghemat biaya beli sepatu baru...">{{ old('value_material') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-blue-900 mb-1.5">Nilai Kehidupan (Life Value)</label>
                            <textarea name="value_kehidupan" rows="2" class="w-full rounded-xl border-blue-200 focus:border-blue-500 focus:ring-blue-500 text-sm bg-white" placeholder="Contoh: Melestarikan kenangan indah...">{{ old('value_kehidupan') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Teks Tombol (CTA)</label>
                        <input type="text" name="cta" value="{{ old('cta', 'Konsultasi Sekarang') }}" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.layanan-categories.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#22AF85] text-white text-sm font-bold hover:bg-[#1a8b69] transition-colors shadow-sm shadow-[#22AF85]/20">Simpan Kategori</button>
            </div>
        </form>
    </div>
</x-app-layout>
