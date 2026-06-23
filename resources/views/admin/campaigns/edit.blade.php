<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kampanye / Iklan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ type: '{{ old('type', $campaign->type) }}' }">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul Kampanye -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Nama / Judul Kampanye')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $campaign->title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Posisi Penempatan -->
                            <div>
                                <x-input-label for="position" :value="__('Posisi Banner')" />
                                <select id="position" name="position" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="catalog_top" {{ old('position', $campaign->position) === 'catalog_top' ? 'selected' : '' }}>Katalog Bagian Atas (catalog_top)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('position')" />
                            </div>

                            <!-- Tipe Promosi -->
                            <div>
                                <x-input-label for="type" :value="__('Tipe Media')" />
                                <select id="type" name="type" x-model="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="image_upload">Upload Gambar Desain</option>
                                    <option value="image_url">Link URL Gambar Eksternal</option>
                                    <option value="text_only">Hanya Teks Promosi (Tanpa Gambar)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>
                        </div>

                        <!-- Panel Unggah Gambar -->
                        <div class="mb-4" x-show="type === 'image_upload'">
                            <x-input-label for="image" :value="__('Ganti File Gambar Banner (Opsional)')" />
                            <p class="mt-1 text-xs text-gray-500">
                                📐 <strong>Ukuran rekomendasi: 1200 × 400 px</strong> (rasio 3:1, maks 10MB).
                                Gambar akan ditampilkan utuh 100% tanpa terpotong di semua perangkat.
                            </p>
                            @if($campaign->image_path)
                                <div class="my-3 p-2 bg-gray-50 rounded-lg border border-gray-200 inline-block w-full max-w-md">
                                    <p class="text-xs text-gray-400 mb-1 font-bold">Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $campaign->image_path) }}" class="w-full h-auto rounded border border-gray-300" alt="Preview" />
                                </div>
                            @endif
                            <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 file:cursor-pointer hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <!-- Panel URL Gambar Eksternal -->
                        <div class="mb-4" x-show="type === 'image_url'">
                            <x-input-label for="image_url" :value="__('Link URL Gambar Banner')" />
                            @if($campaign->image_url && $campaign->type === 'image_url')
                                <div class="my-3 p-2 bg-gray-50 rounded-lg border border-gray-200 inline-block w-full max-w-md">
                                    <p class="text-xs text-gray-400 mb-1 font-bold">Gambar Saat Ini:</p>
                                    <img src="{{ $campaign->image_url }}" class="w-full h-auto rounded border border-gray-300" alt="Preview" />
                                </div>
                            @endif
                            <x-text-input id="image_url" name="image_url" type="url" class="mt-1 block w-full" :value="old('image_url', $campaign->image_url)" placeholder="https://example.com/banner-promosi.png" />
                            <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                        </div>

                        <!-- Panel Hanya Teks (Or overlay caption) -->
                        <div class="mb-4" x-show="type === 'text_only'">
                            <x-input-label for="promo_text" :value="__('Teks Pesan Promosi')" />
                            <textarea id="promo_text" name="promo_text" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" placeholder="Pesan promosi...">{{ old('promo_text', $campaign->promo_text) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('promo_text')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- CTA Button Text -->
                            <div>
                                <x-input-label for="cta_text" :value="__('Label Tombol Aksi (CTA)')" />
                                <x-text-input id="cta_text" name="cta_text" type="text" class="mt-1 block w-full" :value="old('cta_text', $campaign->cta_text)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('cta_text')" />
                            </div>

                            <!-- Target URL (Link) -->
                            <div>
                                <x-input-label for="target_url" :value="__('Link Target Klik (Arah Aksi)')" />
                                <x-text-input id="target_url" name="target_url" type="url" class="mt-1 block w-full" :value="old('target_url', $campaign->target_url)" />
                                <x-input-error class="mt-2" :messages="$errors->get('target_url')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Waktu Mulai -->
                            <div>
                                <x-input-label for="start_date" :value="__('Mulai Tayang (Opsional)')" />
                                <input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->format('Y-m-d\TH:i') : '') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <!-- Waktu Selesai -->
                            <div>
                                <x-input-label for="end_date" :value="__('Selesai Tayang (Opsional)')" />
                                <input id="end_date" name="end_date" type="datetime-local" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d\TH:i') : '') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <!-- Checkbox Aktif -->
                        <div class="block mb-6">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', $campaign->is_active) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Tampilkan Kampanye Ini') }}</span>
                            </label>
                        </div>

                        <!-- Button Action -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Perbarui Kampanye') }}</x-primary-button>
                            <a href="{{ route('admin.campaigns.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
