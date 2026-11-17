<x-app-layout>
    <x-slot name="header">
        <span>
            {{ __('Edit Call to Action') }}
        </span>
    </x-slot>

    <div>
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.cta.update', $cta) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $cta->title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="subtitle" :value="__('Subjudul')" />
                            <textarea id="subtitle" name="subtitle" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('subtitle', $cta->subtitle) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('subtitle')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="button_text" :value="__('Teks Tombol')" />
                                <x-text-input id="button_text" name="button_text" type="text" class="mt-1 block w-full" :value="old('button_text', $cta->button_text)" />
                            </div>
                            <div>
                                <x-input-label for="button_link" :value="__('Link Tombol')" />
                                <x-text-input id="button_link" name="button_link" type="text" class="mt-1 block w-full" :value="old('button_link', $cta->button_link)" />
                            </div>
                        </div>

                        <div class="block mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ $cta->is_active ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Aktif') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('admin.cta.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
