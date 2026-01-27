<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Project Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $project->title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" :value="old('category', $project->category)" placeholder="e.g. Repairs, Cleaning, Repaint" />
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <x-input-label for="before_image" :value="__('Before Image')" />
                                @if($project->before_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before" class="h-20 w-20 object-cover mt-2 rounded">
                                    </div>
                                @endif
                                <input id="before_image" name="before_image" type="file" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('before_image')" />
                            </div>
                            <div>
                                <x-input-label for="after_image" :value="__('After Image')" />
                                @if($project->after_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $project->after_image) }}" alt="After" class="h-20 w-20 object-cover mt-2 rounded">
                                    </div>
                                @endif
                                <input id="after_image" name="after_image" type="file" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('after_image')" />
                            </div>
                        </div>

                        <div class="block mb-4">
                            <label for="is_featured" class="inline-flex items-center">
                                <input id="is_featured" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Featured in home') }}</span>
                            </label>
                        </div>

                        <div class="block mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ $project->is_active ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Active') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <a href="{{ route('admin.projects.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
