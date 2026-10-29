{{-- Shared donation form. Expects $donation (null when creating), $action, $submitLabel. --}}
@php
    use App\Models\Donation;

    $isEdit = isset($donation);
    $existing = $isEdit ? array_values($donation->foto_path ?? []) : [];
    $slots = [
        ['label' => 'Depan', 'hint' => 'Ujung depan, lidah, dan tali'],
        ['label' => 'Samping kiri', 'hint' => 'Sisi kiri dan sol samping'],
        ['label' => 'Samping kanan', 'hint' => 'Sisi kanan, logo, dan sol samping'],
        ['label' => 'Belakang', 'hint' => 'Tumit dan sol belakang'],
    ];
    $extraPhotos = array_slice($existing, count($slots));

    $currentKondisi = old('kondisi', $isEdit ? $donation->kondisi : null);
    // Older donations used a free 0-100 slider: only preselect values that match a card
    $selectedKondisi = array_key_exists((int) $currentKondisi, Donation::KONDISI_OPTIONS) ? (string) (int) $currentKondisi : '';
@endphp

{{-- How it works --}}
<ol class="grid grid-cols-3 gap-2 sm:gap-3 mb-6">
    @foreach([
        ['edit_note', 'Ajukan', 'Isi data dan foto sepatu. Tim kami meninjau dalam 1–2 hari kerja.'],
        ['local_shipping', 'Kirim sepatu', 'Setelah disetujui, antar langsung atau kirim lewat ekspedisi ke workshop.'],
        ['autorenew', 'Restorasi & adopsi', 'Sepatu kami restorasi, lalu diadopsi pemilik baru lewat katalog.'],
    ] as [$icon, $title, $desc])
        <li class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-2 sm:gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm p-3 sm:p-4">
            <span class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined !text-[20px]">{{ $icon }}</span>
            </span>
            <span>
                <span class="block text-[10px] sm:text-[11px] font-bold text-gray-400">Langkah {{ $loop->iteration }}</span>
                <span class="block text-xs sm:text-sm font-black text-gray-900 leading-tight">{{ $title }}</span>
                <span class="hidden sm:block text-xs text-gray-500 leading-relaxed mt-0.5">{{ $desc }}</span>
            </span>
        </li>
    @endforeach
</ol>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
    <div class="lg:col-span-7">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" novalidate
              class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-8"
              x-data="{
                  kondisi: @js($selectedKondisi),
                  photoError: '',
                  kondisiError: '',
                  check(event) {
                      this.photoError = '';
                      this.kondisiError = '';
                      const form = event.target;
                      const photos = [...form.querySelectorAll('input[type=file][name=\'foto[]\']')].filter(i => i.files.length).length
                          + form.querySelectorAll('input[name=\'existing_photos[]\']').length;
                      if (this.kondisi === 'below') {
                          this.kondisiError = 'Sepatu dengan kelayakan di bawah {{ Donation::MIN_KONDISI }}% belum bisa kami terima.';
                      } else if (!this.kondisi) {
                          this.kondisiError = 'Pilih kondisi sepatu.';
                      }
                      if (photos === 0) {
                          this.photoError = 'Unggah minimal 1 foto sepatu.';
                      }
                      if (this.kondisiError || this.photoError || !form.checkValidity()) {
                          event.preventDefault();
                          form.reportValidity();
                          (this.kondisiError ? this.$refs.kondisi : this.$refs.foto).scrollIntoView({ behavior: 'smooth', block: 'center' });
                      }
                  }
              }"
              @submit="check($event)">
            @csrf
            @if($isEdit)
                @method('PUT')
                <input type="hidden" name="existing_photos_present" value="1">
            @endif

            <div class="space-y-8">

            {{-- 1. Shoe data --}}
            <section>
                <h2 class="text-base font-black text-gray-900 mb-4">Data sepatu</h2>
                <div class="space-y-4">
                    <div>
                        <label for="nama_sepatu" class="block text-sm font-bold text-gray-700 mb-1.5">Nama / model sepatu <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sepatu" id="nama_sepatu" value="{{ old('nama_sepatu', $donation->nama_sepatu ?? '') }}" required maxlength="150"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                               placeholder="Contoh: Air Jordan 1 Mid">
                        @error('nama_sepatu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="brand" class="block text-sm font-bold text-gray-700 mb-1.5">Brand</label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand', $donation->brand ?? '') }}" maxlength="100"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="Contoh: Nike">
                            @error('brand') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="ukuran" class="block text-sm font-bold text-gray-700 mb-1.5">Ukuran <span class="text-red-500">*</span></label>
                            <input type="text" name="ukuran" id="ukuran" value="{{ old('ukuran', $donation->ukuran ?? '') }}" required maxlength="10" inputmode="decimal"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   placeholder="Contoh: 42">
                            @error('ukuran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. Condition --}}
            <section x-ref="kondisi">
                <h2 class="text-base font-black text-gray-900">Kondisi sepatu <span class="text-red-500">*</span></h2>
                <p class="text-xs text-gray-500 mt-1 mb-4">Kami hanya menerima sepatu dengan kelayakan <strong class="text-gray-700">di atas {{ Donation::MIN_KONDISI }}%</strong>. Pilih yang paling mendekati.</p>
                <input type="hidden" name="kondisi" :value="kondisi === 'below' ? '' : kondisi">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" role="radiogroup" aria-label="Kondisi sepatu">
                    @foreach(Donation::KONDISI_OPTIONS as $value => $option)
                        <button type="button" role="radio" @click="kondisi = '{{ $value }}'; kondisiError = ''"
                                :aria-checked="(kondisi === '{{ $value }}').toString()"
                                :class="kondisi === '{{ $value }}' ? 'border-emerald-500 bg-emerald-50/60 ring-1 ring-emerald-500' : 'border-gray-200 hover:border-gray-300'"
                                class="text-left p-4 rounded-xl border transition">
                            <span class="flex items-center justify-between gap-2">
                                <span class="text-sm font-black text-gray-900">{{ $option['label'] }}</span>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">±{{ $value }}%</span>
                            </span>
                            <span class="block text-xs text-gray-500 leading-relaxed mt-1.5">{{ $option['desc'] }}</span>
                        </button>
                    @endforeach
                    <button type="button" role="radio" @click="kondisi = 'below'; kondisiError = ''"
                            :aria-checked="(kondisi === 'below').toString()"
                            :class="kondisi === 'below' ? 'border-red-400 bg-red-50/60 ring-1 ring-red-400' : 'border-gray-200 hover:border-gray-300'"
                            class="text-left p-4 rounded-xl border transition">
                        <span class="flex items-center justify-between gap-2">
                            <span class="text-sm font-black text-gray-900">Rusak berat</span>
                            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-full">&lt; {{ Donation::MIN_KONDISI }}%</span>
                        </span>
                        <span class="block text-xs text-gray-500 leading-relaxed mt-1.5">Sol jebol atau lepas, upper sobek, berjamur, atau bau menyengat.</span>
                    </button>
                </div>

                <div x-show="kondisi === 'below'" x-cloak class="mt-3 p-4 rounded-xl bg-red-50 border border-red-100 text-xs text-red-800 leading-relaxed">
                    <p class="font-bold text-sm mb-1">Sepatu ini belum bisa kami terima sebagai donasi</p>
                    <p>Donasi hanya untuk sepatu dengan kelayakan di atas {{ Donation::MIN_KONDISI }}%. Kalau sepatumu masih ingin dipakai, kamu bisa memperbaikinya lewat <a href="{{ route('layanan.index') }}" class="font-bold underline">layanan reparasi</a> kami.</p>
                </div>
                @if($isEdit && $currentKondisi && $selectedKondisi === '')
                    <p class="mt-3 text-xs text-amber-700 bg-amber-50 border border-amber-100 rounded-xl p-3">Sebelumnya kamu menilai kondisi {{ (int) $currentKondisi }}%. Pilih ulang sesuai kategori di atas.</p>
                @endif
                <p x-show="kondisiError" x-text="kondisiError" x-cloak class="text-red-500 text-xs mt-2"></p>
                @error('kondisi') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror

                <label for="deskripsi" class="block text-sm font-bold text-gray-700 mt-5 mb-1.5">Catatan kondisi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" maxlength="2000"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition resize-none"
                          placeholder="Contoh: Ada lecet kecil di ujung kiri, sol masih tebal, tali lengkap.">{{ old('deskripsi', $donation->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </section>

            {{-- 3. Photos: one slot per angle --}}
            <section x-ref="foto">
                <h2 class="text-base font-black text-gray-900">Foto sepatu <span class="text-red-500">*</span></h2>
                <p class="text-xs text-gray-500 mt-1 mb-4">Minimal 1 foto. Lengkapi keempat sudut supaya penilaian lebih cepat. Gunakan cahaya terang dan pastikan foto tidak buram.</p>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($slots as $i => $slot)
                        <div x-data="{ preview: null, existing: @js($existing[$i] ?? null) }" class="flex flex-col">
                            <label class="relative aspect-square rounded-xl border-2 overflow-hidden cursor-pointer transition group"
                                   :class="preview || existing ? 'border-emerald-500 border-solid' : 'border-dashed border-gray-300 hover:border-emerald-400 bg-gray-50/60'">
                                <input type="file" name="foto[]" accept="image/*" class="sr-only" x-ref="input"
                                       @change="if ($event.target.files[0]) { if (preview) URL.revokeObjectURL(preview); preview = URL.createObjectURL($event.target.files[0]); existing = null; photoError = ''; }">
                                <template x-if="existing">
                                    <input type="hidden" name="existing_photos[]" :value="existing">
                                </template>

                                <img x-show="preview || existing" x-cloak :src="preview || (existing ? '{{ asset('storage') }}/' + existing : '')" alt="" class="absolute inset-0 w-full h-full object-cover">

                                <span x-show="!preview && !existing" class="absolute inset-0 flex flex-col items-center justify-center text-center p-2">
                                    <span class="material-symbols-outlined text-gray-400 !text-[26px]">add_a_photo</span>
                                    <span class="text-xs font-bold text-gray-700 mt-1">{{ $slot['label'] }}</span>
                                    <span class="text-[10px] text-gray-400 leading-tight mt-0.5">{{ $slot['hint'] }}</span>
                                </span>

                                {{-- Saved photos have no stored angle, so only a newly picked photo is labelled with the slot's angle --}}
                                <span x-show="preview || existing" x-cloak class="absolute bottom-1.5 left-1.5 bg-gray-900/75 text-white text-[10px] font-bold px-1.5 py-0.5 rounded"
                                      x-text="preview ? '{{ $loop->iteration }}. {{ $slot['label'] }}' : 'Foto {{ $loop->iteration }}'"></span>
                            </label>
                            <button type="button" x-show="preview || existing" x-cloak
                                    @click="if (preview) URL.revokeObjectURL(preview); preview = null; existing = null; $refs.input.value = ''"
                                    class="mt-1.5 text-[11px] font-bold text-red-500 hover:underline self-start">Hapus foto</button>
                        </div>
                    @endforeach
                </div>

                @if($extraPhotos)
                    <p class="text-xs font-bold text-gray-500 mt-4 mb-2">Foto lain yang sudah diunggah</p>
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                        @foreach($extraPhotos as $path)
                            <div x-data="{ keep: true }" x-show="keep" class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                                <input type="hidden" name="existing_photos[]" value="{{ $path }}" :disabled="!keep">
                                <img src="{{ asset('storage/' . $path) }}" alt="" class="w-full h-full object-cover">
                                <button type="button" @click="keep = false" class="absolute top-1 right-1 w-6 h-6 rounded-full bg-black/60 text-white flex items-center justify-center" aria-label="Hapus foto">
                                    <span class="material-symbols-outlined !text-[14px]">close</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <p x-show="photoError" x-text="photoError" x-cloak class="text-red-500 text-xs mt-2"></p>
                @error('foto') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                @error('foto.*') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
            </section>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('member.donations.index') }}" class="text-center px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                <button type="submit" :disabled="kondisi === 'below'"
                        class="sm:ml-auto px-8 py-3 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25 disabled:bg-gray-300 disabled:shadow-none disabled:cursor-not-allowed">
                    {{ $submitLabel }}
                </button>
            </div>
            </div>
        </form>
    </div>

    {{-- Guidance --}}
    <aside class="lg:col-span-5 space-y-4 lg:sticky lg:top-24">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6">
            <h3 class="text-sm font-black text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500 !text-[20px]">fact_check</span>
                Sepatu yang kami terima
            </h3>
            <ul class="mt-3 space-y-2 text-xs text-gray-600 leading-relaxed">
                <li class="flex gap-2"><span class="material-symbols-outlined text-emerald-500 !text-[16px]">check_circle</span><span>Kelayakan <strong>di atas {{ Donation::MIN_KONDISI }}%</strong>: masih nyaman dan aman dipakai.</span></li>
                <li class="flex gap-2"><span class="material-symbols-outlined text-emerald-500 !text-[16px]">check_circle</span><span>Sepasang lengkap, kiri dan kanan.</span></li>
                <li class="flex gap-2"><span class="material-symbols-outlined text-emerald-500 !text-[16px]">check_circle</span><span>Kondisi yang dipilih sesuai dengan foto. Tim kami menilai ulang saat sepatu tiba.</span></li>
            </ul>
            <p class="mt-4 text-xs text-gray-500 leading-relaxed">Contoh yang belum bisa kami terima: sol jebol atau lepas, upper sobek, berjamur, atau bau menyengat.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-6">
            <h3 class="text-sm font-black text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500 !text-[20px]">photo_camera</span>
                Contoh foto 4 sudut
            </h3>
            <div class="mt-3 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 aspect-[16/9]">
                <img src="{{ asset('images/contoh_angle_sepatu.jpg') }}" alt="Contoh foto sepatu dari depan, samping, dan belakang" class="w-full h-full object-cover" loading="lazy">
            </div>
            <p class="mt-3 text-xs text-gray-500 leading-relaxed">Foto sesuai urutan kotak di form: depan, samping kiri, samping kanan, lalu belakang. Foto akan dikompres otomatis.</p>
        </div>
    </aside>
</div>
