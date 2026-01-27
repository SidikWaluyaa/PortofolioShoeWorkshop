<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.posts.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Left: Main Content -->
                            <div class="lg:col-span-2 space-y-4">
                                <div>
                                    <x-input-label for="title" :value="__('Judul Artikel')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required placeholder="Masukkan judul artikel yang menarik..." />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div>
                                    <x-input-label for="content" :value="__('Konten Artikel')" />
                                    <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="15" required placeholder="Tuliskan isi artikel di sini...">{{ old('content') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                                </div>
                            </div>

                            <!-- Right: Sidebar/Settings -->
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <h3 class="text-sm font-bold text-gray-700 mb-4 border-b pb-2 uppercase tracking-wider">Pengaturan Artikel</h3>
                                    
                                    <div class="mb-4">
                                        <x-input-label for="category" :value="__('Kategori')" />
                                        <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="Shoe Care" {{ old('category') == 'Shoe Care' ? 'selected' : '' }}>Shoe Care (Tips)</option>
                                            <option value="Workshop Stories" {{ old('category') == 'Workshop Stories' ? 'selected' : '' }}>Workshop Stories</option>
                                            <option value="Update & promo" {{ old('category') == 'Update & promo' ? 'selected' : '' }}>Update & Promo</option>
                                            <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label for="status" :value="__('Status')" />
                                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label for="thumbnail" :value="__('URL Thumbnail')" />
                                        <x-text-input id="thumbnail" name="thumbnail" type="text" class="mt-1 block w-full text-sm" :value="old('thumbnail')" placeholder="https://example.com/image.jpg" />
                                        <p class="text-[10px] text-gray-500 mt-1 italic">*Gunakan URL gambar publik (Unsplash atau Imgur).</p>
                                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                                    </div>

                                    <div class="mb-6">
                                        <x-input-label for="published_at" :value="__('Jadwal Publikasi (Opsional)')" />
                                        <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full text-sm" :value="old('published_at')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        <x-primary-button class="justify-center w-full">{{ __('Simpan Artikel') }}</x-primary-button>
                                        <a href="{{ route('admin.posts.index') }}" class="text-center text-sm text-gray-600 hover:text-gray-900 border border-gray-300 py-2 rounded-md bg-white">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
