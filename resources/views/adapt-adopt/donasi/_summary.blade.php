{{-- Read-only summary of a DonationDraft. Expects $draft. --}}
@php
    $d = $draft->data;
    $kondisi = \App\Models\Donation::KONDISI_OPTIONS[(int) ($d['kondisi'] ?? 0)] ?? null;
@endphp
<div class="bg-white rounded-2xl border border-aa-beige shadow-sm p-5 sm:p-6">
    <div class="grid grid-cols-4 gap-2">
        @foreach($draft->foto_path as $path)
            <img src="{{ asset('storage/' . $path) }}" alt="Foto {{ $loop->iteration }} {{ $d['nama_sepatu'] }}" class="aspect-square w-full object-cover rounded-xl border border-gray-100">
        @endforeach
    </div>
    <dl class="mt-5 grid grid-cols-2 gap-x-4 gap-y-3 text-sm">
        <div class="col-span-2">
            <dt class="text-xs font-bold text-aa-neutral">Nama / model</dt>
            <dd class="font-black text-aa-ink">{{ $d['nama_sepatu'] }}</dd>
        </div>
        <div>
            <dt class="text-xs font-bold text-aa-neutral">Brand</dt>
            <dd class="font-bold text-aa-ink">{{ $d['brand'] ?: '–' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-bold text-aa-neutral">Ukuran</dt>
            <dd class="font-bold text-aa-ink">{{ $d['ukuran'] }}</dd>
        </div>
        <div class="col-span-2">
            <dt class="text-xs font-bold text-aa-neutral">Kondisi</dt>
            <dd class="font-bold text-aa-ink">{{ $kondisi['label'] ?? '–' }} <span class="text-aa-neutral font-semibold">(±{{ (int) $d['kondisi'] }}%)</span></dd>
        </div>
        @if(!empty($d['deskripsi']))
            <div class="col-span-2">
                <dt class="text-xs font-bold text-aa-neutral">Catatan kondisi</dt>
                <dd class="text-aa-ink leading-relaxed">{{ $d['deskripsi'] }}</dd>
            </div>
        @endif
    </dl>
</div>
