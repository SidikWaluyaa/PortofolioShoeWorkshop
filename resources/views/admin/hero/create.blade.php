<x-app-layout>
    <x-slot name="header">
        <span>
            {{ __('Tambah Hero Banner') }}
        </span>
    </x-slot>

    <div>
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="subtitle" :value="__('Subjudul')" />
                            <textarea id="subtitle" name="subtitle" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('subtitle') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('subtitle')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="primary_cta_text" :value="__('Teks Tombol Utama')" />
                                <x-text-input id="primary_cta_text" name="primary_cta_text" type="text" class="mt-1 block w-full" :value="old('primary_cta_text')" />
                            </div>
                            <div>
                                <x-input-label for="primary_cta_link" :value="__('Link Tombol Utama')" />
                                <x-text-input id="primary_cta_link" name="primary_cta_link" type="text" class="mt-1 block w-full" :value="old('primary_cta_link')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="secondary_cta_text" :value="__('Teks Tombol Kedua')" />
                                <x-text-input id="secondary_cta_text" name="secondary_cta_text" type="text" class="mt-1 block w-full" :value="old('secondary_cta_text')" />
                            </div>
                            <div>
                                <x-input-label for="secondary_cta_link" :value="__('Link Tombol Kedua')" />
                                <x-text-input id="secondary_cta_link" name="secondary_cta_link" type="text" class="mt-1 block w-full" :value="old('secondary_cta_link')" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Gambar Hero')" />
                            <input id="image" name="image" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="block mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" checked>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Aktif') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('admin.hero.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
