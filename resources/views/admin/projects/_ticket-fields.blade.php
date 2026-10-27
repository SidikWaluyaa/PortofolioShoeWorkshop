{{-- Fields for the "kartu SPK" card on the home page portfolio section --}}
@php $project = $project ?? null; @endphp
<div class="mb-4 rounded-lg border border-dashed border-gray-300 bg-gray-50 p-4">
    <p class="text-sm font-semibold text-gray-800">Detail Kartu SPK (tampil di beranda)</p>
    <p class="text-xs text-gray-500 mb-4">Isi agar kartu portfolio bercerita: apa masalahnya, apa yang dikerjakan, berapa lama. Bagian yang kosong tidak ditampilkan.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <x-input-label for="spk_number" value="No. SPK (opsional)" />
            <x-text-input id="spk_number" name="spk_number" type="text" class="mt-1 block w-full" :value="old('spk_number', $project?->spk_number)" placeholder="mis. S-2603-28-0882" />
            <x-input-error class="mt-2" :messages="$errors->get('spk_number')" />
        </div>
        <div>
            <x-input-label for="durasi_hari" value="Lama Pengerjaan (hari)" />
            <x-text-input id="durasi_hari" name="durasi_hari" type="number" min="1" max="365" class="mt-1 block w-full" :value="old('durasi_hari', $project?->durasi_hari)" placeholder="mis. 7" />
            <x-input-error class="mt-2" :messages="$errors->get('durasi_hari')" />
        </div>
    </div>

    <div class="mb-4">
        <x-input-label for="keluhan" value="Keluhan / Kondisi Awal" />
        <x-text-input id="keluhan" name="keluhan" type="text" class="mt-1 block w-full" :value="old('keluhan', $project?->keluhan)" placeholder="mis. Sol aus dan mulai lepas, warna upper kusam" />
        <x-input-error class="mt-2" :messages="$errors->get('keluhan')" />
    </div>

    <div class="mb-4">
        <x-input-label for="tindakan" value="Tindakan (satu per baris)" />
        <textarea id="tindakan" name="tindakan" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ganti sol&#10;Repaint 2 warna&#10;Deep clean">{{ old('tindakan', $project?->tindakan) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('tindakan')" />
    </div>

    <div>
        <x-input-label for="description" value="Catatan Teknisi / Deskripsi" />
        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Cerita singkat pengerjaannya">{{ old('description', $project?->description) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>
</div>
