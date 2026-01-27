<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Left: Main Content -->
                            <div class="lg:col-span-2 space-y-4">
                                <div>
                                    <x-input-label for="title" :value="__('Judul Artikel')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div>
                                    <x-input-label for="slug" :value="__('Slug (URL)')" />
                                    <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full bg-gray-50" :value="old('slug', $post->slug)" placeholder="Kosongkan untuk auto-generate" />
                                    <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                                </div>

                                <div>
                                    <x-input-label for="content" :value="__('Konten Artikel')" />
                                    <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="15" required>{{ old('content', $post->content) }}</textarea>
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
                                            <option value="Shoe Care" {{ old('category', $post->category) == 'Shoe Care' ? 'selected' : '' }}>Shoe Care (Tips)</option>
                                            <option value="Workshop Stories" {{ old('category', $post->category) == 'Workshop Stories' ? 'selected' : '' }}>Workshop Stories</option>
                                            <option value="Update & promo" {{ old('category', $post->category) == 'Update & promo' ? 'selected' : '' }}>Update & Promo</option>
                                            <option value="General" {{ old('category', $post->category) == 'General' ? 'selected' : '' }}>General</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label for="status" :value="__('Status')" />
                                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label for="thumbnail" :value="__('URL Thumbnail')" />
                                        @if($post->thumbnail)
                                            <img src="{{ $post->thumbnail }}" alt="Preview" class="mb-2 h-32 w-full object-cover rounded-md border">
                                        @endif
                                        <x-text-input id="thumbnail" name="thumbnail" type="text" class="mt-1 block w-full text-sm" :value="old('thumbnail', $post->thumbnail)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                                    </div>

                                    <div class="mb-6">
                                        <x-input-label for="published_at" :value="__('Jadwal Publikasi')" />
                                        <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full text-sm" :value="old('published_at', $post->published_at?->format('Y-m-d\TH:i'))" />
                                        <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                                    </div>

                                    <div class="flex flex-col gap-3">
                                        <x-primary-button class="justify-center w-full">{{ __('Update Artikel') }}</x-primary-button>
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
