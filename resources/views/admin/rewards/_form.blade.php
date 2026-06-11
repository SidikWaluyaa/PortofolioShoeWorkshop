@php $r = $reward ?? null; @endphp

{{-- Nama Reward --}}
<div class="mb-6">
    <label for="nama_reward" class="block text-sm font-bold text-gray-700 mb-2">Nama Reward <span class="text-red-500">*</span></label>
    <input type="text" name="nama_reward" id="nama_reward" value="{{ old('nama_reward', $r?->nama_reward) }}" required
           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition"
           placeholder="Contoh: Voucher Cuci Sepatu Gratis">
    @error('nama_reward') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    {{-- Jenis --}}
    <div>
        <label for="jenis" class="block text-sm font-bold text-gray-700 mb-2">Jenis <span class="text-red-500">*</span></label>
        <select name="jenis" id="jenis" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition">
            @foreach(['voucher', 'diskon', 'konsultasi', 'lainnya'] as $j)
            <option value="{{ $j }}" {{ old('jenis', $r?->jenis) === $j ? 'selected' : '' }}>{{ ucfirst($j) }}</option>
            @endforeach
        </select>
        @error('jenis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Minggu Ke --}}
    <div>
        <label for="minggu_ke" class="block text-sm font-bold text-gray-700 mb-2">Target Minggu Streak <span class="text-red-500">*</span></label>
        <input type="number" name="minggu_ke" id="minggu_ke" value="{{ old('minggu_ke', $r?->minggu_ke) }}" min="1" required
               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition"
               placeholder="1">
        @error('minggu_ke') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

{{-- Deskripsi --}}
<div class="mb-6">
    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
    <textarea name="deskripsi" id="deskripsi" rows="3" required
              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition resize-none"
              placeholder="Petunjuk penukaran dan syarat hadiah...">{{ old('deskripsi', $r?->deskripsi) }}</textarea>
    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    {{-- Kode Kupon --}}
    <div>
        <label for="kode_kupon" class="block text-sm font-bold text-gray-700 mb-2">Kode Kupon Dasar</label>
        <input type="text" name="kode_kupon" id="kode_kupon" value="{{ old('kode_kupon', $r?->kode_kupon) }}"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition"
               placeholder="Opsional">
        @error('kode_kupon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Nilai --}}
    <div>
        <label for="nilai" class="block text-sm font-bold text-gray-700 mb-2">Nilai Benefit</label>
        <input type="text" name="nilai" id="nilai" value="{{ old('nilai', $r?->nilai) }}"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition"
               placeholder="Contoh: Rp 50.000 atau 20%">
        @error('nilai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    {{-- Berlaku Dari --}}
    <div>
        <label for="berlaku_dari" class="block text-sm font-bold text-gray-700 mb-2">Berlaku Dari</label>
        <input type="date" name="berlaku_dari" id="berlaku_dari" value="{{ old('berlaku_dari', $r?->berlaku_dari?->format('Y-m-d')) }}"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition">
        @error('berlaku_dari') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Berlaku Sampai --}}
    <div>
        <label for="berlaku_sampai" class="block text-sm font-bold text-gray-700 mb-2">Berlaku Sampai</label>
        <input type="date" name="berlaku_sampai" id="berlaku_sampai" value="{{ old('berlaku_sampai', $r?->berlaku_sampai?->format('Y-m-d')) }}"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition">
        @error('berlaku_sampai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    {{-- Stok --}}
    <div>
        <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">Stok Kupon</label>
        <input type="number" name="stok" id="stok" value="{{ old('stok', $r?->stok) }}" min="0"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] transition"
               placeholder="Kosongkan untuk unlimited">
        @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Status Aktif --}}
    <div class="flex items-center pt-8">
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="hidden" name="status_aktif" value="0">
            <input type="checkbox" name="status_aktif" value="1" class="sr-only peer" {{ old('status_aktif', $r?->status_aktif ?? true) ? 'checked' : '' }}>
            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#22AF85]"></div>
            <span class="ms-3 text-sm font-bold text-gray-700">Aktif</span>
        </label>
    </div>
</div>
