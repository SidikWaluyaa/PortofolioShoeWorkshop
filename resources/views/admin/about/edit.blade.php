<x-app-layout>
    <x-slot name="header">
        <span>
            {{ __('Edit Section Tentang Kami') }}
        </span>
    </x-slot>

    <div>
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $about->title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required>{{ old('description', $about->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Gambar')" />

                            {{-- Current / Live Preview --}}
                            <div class="mt-2 mb-3">
                                @if($about->image)
                                    <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                                    <img id="image-preview"
                                         src="{{ asset('storage/' . $about->image) }}"
                                         alt="Current About"
                                         class="h-40 w-64 object-cover rounded-lg border border-gray-200 shadow-sm">
                                @else
                                    <p class="text-xs text-gray-500 mb-1">Preview:</p>
                                    <img id="image-preview"
                                         src=""
                                         alt="Preview"
                                         class="h-40 w-64 object-cover rounded-lg border border-gray-200 shadow-sm hidden">
                                @endif
                            </div>

                            <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                            <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <script>
                            document.getElementById('image').addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                if (!file) return;
                                const preview = document.getElementById('image-preview');
                                preview.src = URL.createObjectURL(file);
                                preview.classList.remove('hidden');
                            });
                        </script>

                        <div class="block mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ $about->is_active ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Aktif') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('admin.about.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
