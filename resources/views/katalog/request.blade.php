@extends('layouts.main')
@section('seo_title', 'Ajukan Adopsi — ' . $item->nama . ' - Shoe Workshop')
@section('seo_description', 'Form permohonan adopsi ' . $item->nama . ' dari Shoe Workshop.')

@section('head')
<style>
    [x-cloak] { display: none !important; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .fill-1 { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .input-focus:focus {
        outline: none;
        border-color: #22AF85;
        box-shadow: 0 0 0 3px rgba(34, 175, 133, 0.12);
    }
</style>
@endsection

@section('content')
<div class="bg-[#f8f9fa] text-[#1c1c17] min-h-screen flex flex-col">

    {{-- NavBar --}}
    @include('layouts.navigation-public')

    <main class="pt-20 sm:pt-24 flex-grow max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-16 py-5 sm:py-8">

        {{-- Breadcrumb --}}
        <nav class="mb-4 sm:mb-6 flex items-center gap-1.5 sm:gap-2 text-gray-500 text-[10px] sm:text-xs font-semibold overflow-x-auto whitespace-nowrap">
            <a href="{{ route('katalog.index') }}" class="hover:text-[#22AF85] transition-colors shrink-0">Katalog Adopsi</a>
            <span class="material-symbols-outlined !text-[14px] shrink-0">chevron_right</span>
            <a href="{{ route('katalog.show', $item) }}" class="hover:text-[#22AF85] transition-colors shrink-0 max-w-[120px] sm:max-w-none truncate">{{ $item->nama }}</a>
            <span class="material-symbols-outlined !text-[14px] shrink-0">chevron_right</span>
            <span class="text-[#22AF85] shrink-0">Ajukan Adopsi</span>
        </nav>

        {{-- Mobile: compact item summary strip --}}
        <div class="flex sm:hidden items-center gap-3 bg-white border border-gray-200 rounded-xl p-3 mb-4 shadow-sm">
            <div class="w-16 h-16 bg-gray-50 rounded-lg flex items-center justify-center p-1.5 shrink-0 border border-gray-100">
                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="max-h-full max-w-full object-contain">
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-[#22AF85] uppercase tracking-wider">{{ $item->brand ?? 'Shoe Workshop' }}</p>
                <p class="font-extrabold text-[#1c1c17] text-sm leading-tight truncate">{{ $item->nama }}</p>
                <div class="flex items-center gap-1.5 mt-1">
                    @php
                        $condBadgeClasses = [
                            'baru' => 'bg-blue-50 text-blue-700',
                            'seperti_baru' => 'bg-green-50 text-green-700',
                            'sudah_diperbaiki' => 'bg-yellow-50 text-yellow-700',
                        ];
                        $condBadgeLabels = [
                            'baru' => 'Baru',
                            'seperti_baru' => 'Sangat Baik',
                            'sudah_diperbaiki' => 'Refurbished',
                        ];
                    @endphp
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold {{ $condBadgeClasses[$item->kondisi] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $condBadgeLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                    </span>
                    @if($item->ukuran)
                        <span class="text-[9px] text-gray-400 font-semibold">Ukuran {{ $item->ukuran }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 sm:gap-6">

            {{-- Left Column: Item Preview — hidden on mobile (shown as strip above) --}}
            <div class="hidden sm:flex md:col-span-5 flex-col gap-5" x-data="{ activeImage: '{{ $item->foto_utama_url }}', activeIndex: 0 }">

                {{-- Item Card --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="relative aspect-square w-full bg-gray-50 flex items-center justify-center p-6 sm:p-8">
                        <img src="{{ $item->foto_utama_url }}" :src="activeImage" alt="{{ $item->nama }}"
                             class="max-h-full max-w-full object-contain transition-transform duration-400 hover:scale-105">
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
                            <span class="bg-green-500 text-white px-2.5 py-1 rounded-full text-[10px] font-bold flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined !text-[12px]">verified</span>
                                Kualitas Terverifikasi
                            </span>
                        </div>
                    </div>
                    
                    {{-- Thumbnails Row --}}
                    @if(!empty($item->foto_detail) && count($item->foto_detail) > 0)
                    <div class="flex gap-2 sm:gap-3 overflow-x-auto p-4 border-t border-gray-100 bg-gray-50/50">
                        <!-- Thumbnail 1 (Active) -->
                        <button @click="activeImage = '{{ $item->foto_utama_url }}'; activeIndex = 0" 
                                :class="activeIndex === 0 ? 'border-2 border-[#22AF85]' : 'border border-gray-200 hover:border-[#22AF85]'"
                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg overflow-hidden bg-white p-1.5 transition-all shadow-sm flex-shrink-0 flex items-center justify-center">
                            <img alt="Foto Utama" class="max-w-full max-h-full object-contain" src="{{ $item->foto_utama_url }}"/>
                        </button>
                        
                        @php
                            $detailPhotos = $item->foto_detail ?? [];
                            $detailUrl = function (string $path): string {
                                if (str_starts_with($path, 'http') || str_starts_with($path, 'images/')) {
                                    return asset($path);
                                }
                                return asset('storage/' . $path);
                            };
                        @endphp
                        
                        @foreach($detailPhotos as $i => $path)
                            @if($i < 3)
                                <button @click="activeImage = '{{ $detailUrl($path) }}'; activeIndex = {{ $i + 1 }}" 
                                        :class="activeIndex === {{ $i + 1 }} ? 'border-2 border-[#22AF85]' : 'border border-gray-200 hover:border-[#22AF85]'"
                                        class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg overflow-hidden bg-white p-1.5 transition-all shadow-sm flex-shrink-0 flex items-center justify-center">
                                    <img alt="Detail {{ $i + 1 }}" class="max-w-full max-h-full object-contain" src="{{ $detailUrl($path) }}"/>
                                </button>
                            @endif
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="p-5 border-t border-gray-100">
                        @php
                            $condBadgeClasses = [
                                'baru' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                'seperti_baru' => 'bg-green-50 text-green-700 border border-green-200',
                                'sudah_diperbaiki' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                            ];
                            $condBadgeLabels = [
                                'baru' => 'Kondisi: Baru',
                                'seperti_baru' => 'Kondisi: Sangat Baik',
                                'sudah_diperbaiki' => 'Kondisi: Hasil Refurbished',
                            ];
                        @endphp
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $condBadgeClasses[$item->kondisi] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $condBadgeLabels[$item->kondisi] ?? ucfirst($item->kondisi) }}
                            </span>
                            @if($item->ukuran)
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-700">
                                    Ukuran: {{ $item->ukuran }}
                                </span>
                            @endif
                        </div>
                        <h2 class="font-extrabold text-[#1c1c17] text-lg leading-tight">{{ $item->nama }}</h2>
                        <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                            {{ Str::limit($item->deskripsi, 120) ?? 'Sepatu hasil restorasi berkualitas dari Shoe Workshop.' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Column: Form --}}
            <div class="md:col-span-7" x-data="requestApp()">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 sm:p-8">

                    {{-- Form Header --}}
                    <div class="mb-6">
                        <h1 class="text-2xl font-extrabold text-[#1c1c17] mb-1">Ajukan Adopsi</h1>
                        <p class="text-sm text-gray-500">Lengkapi data berikut untuk mengajukan permohonan adopsi sepatu ini.</p>
                    </div>

                    {{-- Progress Indicator --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[11px] font-bold text-[#22AF85] uppercase tracking-wider">Data & Pengiriman</span>
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Langkah 1 dari 1</span>
                        </div>
                        <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-[#22AF85] rounded-full w-full transition-all"></div>
                        </div>
                    </div>

                    @if($hasActiveRequest)
                    <div class="mb-6 p-4 bg-orange-50 border border-orange-200 rounded-2xl flex items-start gap-3">
                        <div class="bg-orange-100 p-2 rounded-xl text-orange-600 flex-shrink-0 mt-0.5">
                            <span class="material-symbols-outlined !text-[20px]">warning</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-extrabold text-orange-800 mb-1">Belum bisa mengajukan sepatu ini</h4>
                            <p class="text-xs text-orange-700 leading-relaxed mb-3">{{ $blockReason }}</p>
                            <a href="{{ route('member.adoption-requests.index') }}" class="inline-flex items-center gap-1 text-[11px] font-bold bg-orange-600 hover:bg-orange-700 text-white px-3 py-1.5 rounded-lg transition-colors">
                                Lihat Adopsi Saya <span class="material-symbols-outlined !text-[14px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    @elseif($curationMode)
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-start gap-3">
                        <div class="bg-white p-2 rounded-xl text-[#22AF85] flex-shrink-0 mt-0.5">
                            <span class="material-symbols-outlined !text-[20px]">manage_search</span>
                        </div>
                        <div class="text-xs text-emerald-900 leading-relaxed">
                            <h4 class="text-sm font-extrabold mb-1">Pengajuan dikurasi oleh tim kami</h4>
                            <p>Satu sepatu bisa diajukan beberapa orang. Kami memilih penerimanya dengan mempertimbangkan <strong>alasan pengajuan</strong> dan <strong>urutan waktu pengajuan</strong>. Jika terpilih, tagihan dikirim lewat email dan perlu dibayar dalam 2×24 jam. Belum ada pembayaran apa pun saat mengajukan.</p>
                        </div>
                    </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined !text-[18px]">error</span>
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- General Error --}}
                    @if ($errors->has('general'))
                        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-semibold flex items-center gap-2">
                            <span class="material-symbols-outlined !text-[18px]">error</span>
                            {{ $errors->first('general') }}
                        </div>
                    @endif

                    <form action="{{ route('katalog.request', $item) }}" method="POST" class="space-y-5" id="requestForm">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="nama_pemohon" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">person</span>
                                <input type="text" id="nama_pemohon" name="nama_pemohon"
                                       value="{{ old('nama_pemohon', Auth::user()?->name ?? '') }}"
                                       placeholder="Masukkan nama lengkap Anda"
                                       required
                                       class="w-full pl-11 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all {{ $errors->has('nama_pemohon') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            </div>
                            @error('nama_pemohon')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Email Aktif</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">mail</span>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email', Auth::user()?->email ?? '') }}"
                                       placeholder="Masukkan alamat email aktif Anda"
                                       required
                                       class="w-full pl-11 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor WhatsApp --}}
                        <div>
                            <label for="kontak_pemohon" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nomor WhatsApp</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">chat</span>
                                <span class="absolute left-10 top-1/2 -translate-y-1/2 text-xs font-black text-gray-400 select-none pl-1 border-r border-gray-200 pr-2">+62</span>
                                <input type="tel" id="kontak_pemohon" name="kontak_pemohon"
                                       value="{{ old('kontak_pemohon', Auth::user()?->phone ? (str_starts_with(Auth::user()->phone, '62') ? substr(Auth::user()->phone, 2) : Auth::user()->phone) : '') }}"
                                       placeholder="8123456789"
                                       required
                                       class="w-full pl-20 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all {{ $errors->has('kontak_pemohon') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            </div>
                            <p class="mt-1 text-[10px] text-gray-400 font-semibold">Tulis tanpa angka 0 atau +62 di depan</p>
                            @error('kontak_pemohon')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Alamat Pengiriman: structured so couriers and CS get the district and postcode --}}
                        @php
                            $addressInit = collect(\App\Models\DonationRequest::ADDRESS_FIELDS)
                                ->mapWithKeys(fn ($field) => [$field => old($field, $lastAddress[$field] ?? '')])
                                ->all();
                            $prefilled = !old('alamat_jalan') && !empty($lastAddress);
                            $inputClass = 'w-full px-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all';
                            $fieldBorder = fn ($field) => $errors->has($field) ? 'border-red-400 bg-red-50' : 'border-gray-200';
                        @endphp
                        <fieldset x-data="{
                                      tree: [],
                                      kecamatanList: [],
                                      provinsi: @js($addressInit['provinsi']),
                                      kota: @js($addressInit['kota']),
                                      kecamatan: @js($addressInit['kecamatan']),
                                      loadingKecamatan: false,
                                      async init() {
                                          this.tree = await (await fetch(@js(asset('data/wilayah/provinsi-kota.json')))).json();
                                          if (this.kota) await this.loadKecamatan(false);
                                      },
                                      get kotaList() {
                                          return (this.tree.find(p => p.nama === this.provinsi) || { kota: [] }).kota;
                                      },
                                      async loadKecamatan(reset = true) {
                                          if (reset) this.kecamatan = '';
                                          this.kecamatanList = [];
                                          const city = this.kotaList.find(k => k.nama === this.kota);
                                          if (!city) return;
                                          this.loadingKecamatan = true;
                                          this.kecamatanList = await (await fetch(@js(asset('data/wilayah/kecamatan')) + '/' + city.kode + '.json')).json();
                                          this.loadingKecamatan = false;
                                      }
                                  }">
                            <legend class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Alamat Pengiriman</legend>
                            <p class="text-xs text-gray-500 mb-3">Lengkapi sampai kecamatan dan kode pos supaya ongkos kirim bisa langsung kami hitung.</p>
                            @if($prefilled)
                                <p class="mb-3 text-xs text-emerald-800 bg-emerald-50 border border-emerald-100 rounded-xl px-3 py-2">Diisi dari alamat pengajuan terakhirmu. Ubah jika perlu.</p>
                            @endif

                            <div class="space-y-3">
                                <div>
                                    <label for="alamat_jalan" class="block text-xs font-bold text-gray-600 mb-1">Nama jalan & nomor rumah</label>
                                    <input type="text" id="alamat_jalan" name="alamat_jalan" value="{{ $addressInit['alamat_jalan'] }}" required minlength="5" maxlength="255" autocomplete="address-line1"
                                           placeholder="Contoh: Jl. Kembar I No. 41" class="{{ $inputClass }} {{ $fieldBorder('alamat_jalan') }}">
                                    @error('alamat_jalan') <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p> @enderror
                                </div>

                                <div class="grid grid-cols-3 gap-3 items-end">
                                    <div>
                                        <label for="alamat_rt_rw" class="block text-xs font-bold text-gray-600 mb-1">RT/RW <span class="font-medium text-gray-400">(opsional)</span></label>
                                        <input type="text" id="alamat_rt_rw" name="alamat_rt_rw" value="{{ $addressInit['alamat_rt_rw'] }}" maxlength="20"
                                               placeholder="002/005" class="{{ $inputClass }} {{ $fieldBorder('alamat_rt_rw') }}">
                                    </div>
                                    <div class="col-span-2">
                                        <label for="alamat_patokan" class="block text-xs font-bold text-gray-600 mb-1">Patokan <span class="font-medium text-gray-400">(opsional)</span></label>
                                        <input type="text" id="alamat_patokan" name="alamat_patokan" value="{{ $addressInit['alamat_patokan'] }}" maxlength="255"
                                               placeholder="Contoh: depan masjid, pagar hijau" class="{{ $inputClass }} {{ $fieldBorder('alamat_patokan') }}">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label for="provinsi" class="block text-xs font-bold text-gray-600 mb-1">Provinsi</label>
                                        <select id="provinsi" name="provinsi" required x-model="provinsi" @change="kota = ''; kecamatan = ''; kecamatanList = []"
                                                class="{{ $inputClass }} {{ $fieldBorder('provinsi') }}">
                                            <option value="">Pilih provinsi</option>
                                            <template x-for="p in tree" :key="p.kode">
                                                <option :value="p.nama" x-text="p.nama" :selected="p.nama === provinsi"></option>
                                            </template>
                                        </select>
                                        @error('provinsi') <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="kota" class="block text-xs font-bold text-gray-600 mb-1">Kota/Kabupaten</label>
                                        <select id="kota" name="kota" required x-model="kota" @change="loadKecamatan()" :disabled="!provinsi"
                                                class="{{ $inputClass }} {{ $fieldBorder('kota') }} disabled:opacity-60">
                                            <option value="" x-text="provinsi ? 'Pilih kota/kabupaten' : 'Pilih provinsi dulu'"></option>
                                            <template x-for="k in kotaList" :key="k.kode">
                                                <option :value="k.nama" x-text="k.nama" :selected="k.nama === kota"></option>
                                            </template>
                                        </select>
                                        @error('kota') <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="kecamatan" class="block text-xs font-bold text-gray-600 mb-1">Kecamatan</label>
                                        <select id="kecamatan" name="kecamatan" required x-model="kecamatan" :disabled="!kota || loadingKecamatan"
                                                class="{{ $inputClass }} {{ $fieldBorder('kecamatan') }} disabled:opacity-60">
                                            <option value="" x-text="loadingKecamatan ? 'Memuat…' : (kota ? 'Pilih kecamatan' : 'Pilih kota dulu')"></option>
                                            <template x-for="name in kecamatanList" :key="name">
                                                <option :value="name" x-text="name" :selected="name === kecamatan"></option>
                                            </template>
                                        </select>
                                        @error('kecamatan') <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="kelurahan" class="block text-xs font-bold text-gray-600 mb-1">Kelurahan/Desa</label>
                                        <input type="text" id="kelurahan" name="kelurahan" value="{{ $addressInit['kelurahan'] }}" required maxlength="100"
                                               placeholder="Contoh: Cigereleng" class="{{ $inputClass }} {{ $fieldBorder('kelurahan') }}">
                                        @error('kelurahan') <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="kode_pos" class="block text-xs font-bold text-gray-600 mb-1">Kode pos</label>
                                        <input type="text" id="kode_pos" name="kode_pos" value="{{ $addressInit['kode_pos'] }}" required inputmode="numeric" pattern="[0-9]{5}" maxlength="5" autocomplete="postal-code"
                                               placeholder="40253" class="{{ $inputClass }} {{ $fieldBorder('kode_pos') }}">
                                        @error('kode_pos') <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        {{-- Alasan Pengajuan --}}
                        <div x-data="{ alasan: @js(old('alasan', '')) }">
                            <label for="alasan" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Alasan Mengajukan Adopsi</label>
                            <p id="alasan-hint" class="text-xs text-gray-500 leading-relaxed mb-2">
                                Ceritakan singkat: <strong class="text-gray-700">sepatu ini untuk siapa</strong> (diri sendiri, anak, orang tua, dll.), <strong class="text-gray-700">akan dipakai untuk apa</strong> (kerja, sekolah, olahraga, harian), dan <strong class="text-gray-700">kenapa Anda membutuhkannya</strong>.@if($curationMode) Alasan ini jadi bahan pertimbangan tim kami saat kurasi.@endif
                            </p>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-gray-400 !text-[20px]">description</span>
                                <textarea id="alasan" name="alasan"
                                          rows="4"
                                          required
                                          minlength="20"
                                          maxlength="1000"
                                          x-model="alasan"
                                          aria-describedby="alasan-hint"
                                          placeholder="Contoh: Untuk anak saya yang baru masuk SMP. Sepatu sekolahnya sudah jebol dan ukuran ini pas untuknya."
                                          class="w-full pl-11 pr-4 py-3 bg-gray-50 border rounded-xl text-sm font-medium text-[#1c1c17] placeholder-gray-400 input-focus transition-all resize-none {{ $errors->has('alasan') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">{{ old('alasan') }}</textarea>
                            </div>
                            <p class="mt-1.5 text-xs font-semibold" :class="alasan.trim().length >= 20 ? 'text-[#22AF85]' : 'text-gray-400'"
                               x-text="alasan.trim().length >= 20 ? 'Sudah cukup, terima kasih!' : `Minimal 20 karakter (${alasan.trim().length}/20)`"></p>
                            @error('alasan')
                                <p class="mt-1.5 text-xs text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Ringkasan Jasa & Biaya --}}
                        @if($item->reparationServices->isNotEmpty())
                        <div class="mt-6 border border-gray-200 rounded-xl overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <h3 class="text-sm font-extrabold text-[#1c1c17]">Ringkasan Jasa & Biaya</h3>
                                <p class="text-xs text-gray-500">Pilih opsi jasa yang diinginkan (jasa wajib tidak dapat diubah).</p>
                            </div>
                            <div class="p-4 space-y-3">
                                @foreach($item->reparationServices as $index => $rs)
                                    <label class="flex items-start gap-3 cursor-pointer p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                        <div class="pt-0.5">
                                            <input type="checkbox" name="selected_services[]" value="{{ $rs->id }}" 
                                                class="w-5 h-5 rounded border-gray-300 text-[#22AF85] focus:ring-[#22AF85]"
                                                @change="calculateTotal"
                                                x-model="checkedServices"
                                                @if($rs->is_mandatory) checked disabled @endif>
                                            
                                            {{-- Jika disabled (mandatory), kita butuh hidden input untuk submit value-nya --}}
                                            @if($rs->is_mandatory)
                                                <input type="hidden" name="selected_services[]" value="{{ $rs->id }}">
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="text-sm font-bold text-[#1c1c17]">
                                                        {{ $rs->jasa_nama }}
                                                    </p>
                                                    <p class="text-[10px] font-semibold text-gray-500 uppercase">{{ $rs->jasa_estimasi_waktu }} Hari Pengerjaan</p>
                                                </div>
                                                <p class="text-sm font-bold text-[#22AF85]">{{ $rs->jasa_harga_formatted }}</p>
                                            </div>
                                            @if($rs->is_mandatory)
                                                <span class="inline-block mt-1 px-2 py-0.5 bg-red-50 text-red-600 rounded text-[9px] font-bold uppercase">Wajib</span>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <div class="bg-[#1c1c17] text-white px-4 py-3 flex justify-between items-center">
                                <span class="text-sm font-bold uppercase tracking-wider">Total Biaya Jasa (di luar ongkir)</span>
                                <span class="text-lg font-black text-[#22AF85]" x-text="formattedTotal"></span>
                            </div>
                        </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="pt-3 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <button type="submit" id="submitBtn" {{ $hasActiveRequest ? 'disabled' : '' }}
                                    class="w-full py-4 {{ $hasActiveRequest ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-[#22AF85] hover:opacity-90 text-white active:scale-[0.98]' }} rounded-xl font-bold text-sm shadow-md shadow-[#22AF85]/20 transition-all flex items-center justify-center gap-2">
                                <span id="btnText">{{ $hasActiveRequest ? 'Pengajuan Terkunci' : 'Kirim Pengajuan' }}</span>
                                @if(!$hasActiveRequest)
                                    <span class="material-symbols-outlined !text-[18px]" id="btnIcon">send</span>
                                    <svg id="btnSpinner" class="hidden animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                @else
                                    <span class="material-symbols-outlined !text-[18px]">lock</span>
                                @endif
                            </button>
                            <a href="{{ route('katalog.show', $item) }}"
                               class="text-center sm:text-left text-sm text-gray-500 hover:text-[#22AF85] transition-colors font-semibold underline underline-offset-4">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Trust Bar --}}
                <div class="mt-5 sm:mt-6 flex justify-center items-center gap-5 sm:gap-8 opacity-50">
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">verified_user</span>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider">Data Aman</span>
                    </div>
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">receipt_long</span>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider">Biaya Transparan</span>
                    </div>
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <span class="material-symbols-outlined !text-[18px] sm:!text-[22px]">eco</span>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider">Ramah Lingkungan</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('components.footer', ['settings' => $settings])
</div>

<script>
function requestApp() {
    return {
        // Init with mandatory items
        checkedServices: [
            @if(isset($selectedServiceIds) && is_array($selectedServiceIds))
                @foreach($selectedServiceIds as $id)
                    '{{ $id }}',
                @endforeach
                {{-- Selalu sertakan yang wajib agar tidak terlewat --}}
                @foreach($item->reparationServices as $rs)
                    @if($rs->is_mandatory && !in_array($rs->id, $selectedServiceIds))
                        '{{ $rs->id }}',
                    @endif
                @endforeach
            @else
                @foreach($item->reparationServices as $rs)
                    '{{ $rs->id }}',
                @endforeach
            @endif
        ],
        servicesData: {
            @foreach($item->reparationServices as $rs)
                '{{ $rs->id }}': {{ $rs->jasa_harga }},
            @endforeach
        },
        total: 0,
        formattedTotal: 'Rp 0',
        
        init() {
            this.calculateTotal();
        },
        
        calculateTotal() {
            let sum = 0;
            // Force include mandatory services in case they are not in checkedServices array (disabled checkbox might not trigger model properly on init)
            @foreach($item->reparationServices as $rs)
                @if($rs->is_mandatory)
                    sum += this.servicesData['{{ $rs->id }}'];
                @endif
            @endforeach
            
            // Add optional checked services
            this.checkedServices.forEach(id => {
                // To avoid double adding mandatory services if they are in the array
                let isMandatory = false;
                @foreach($item->reparationServices as $rs)
                    if('{{ $rs->id }}' == id && {{ $rs->is_mandatory ? 'true' : 'false' }}) {
                        isMandatory = true;
                    }
                @endforeach
                
                if(!isMandatory && this.servicesData[id]) {
                    sum += this.servicesData[id];
                }
            });
            
            this.total = sum;
            this.formattedTotal = 'Rp ' + this.total.toLocaleString('id-ID');
        }
    }
}

document.getElementById('requestForm').addEventListener('submit', function () {
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnSpinner = document.getElementById('btnSpinner');

    btn.disabled = true;
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    btnText.textContent = 'Mengirim...';
    btnIcon.classList.add('hidden');
    btnSpinner.classList.remove('hidden');
});
</script>
@endsection
