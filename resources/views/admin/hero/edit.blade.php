<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hero Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.hero.update', $hero) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $hero->title)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="subtitle" :value="__('Subtitle')" />
                            <textarea id="subtitle" name="subtitle" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('subtitle', $hero->subtitle) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('subtitle')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="primary_cta_text" :value="__('Primary CTA Text')" />
                                <x-text-input id="primary_cta_text" name="primary_cta_text" type="text" class="mt-1 block w-full" :value="old('primary_cta_text', $hero->primary_cta_text)" />
                            </div>
                            <div>
                                <x-input-label for="primary_cta_link" :value="__('Primary CTA Link')" />
                                <x-text-input id="primary_cta_link" name="primary_cta_link" type="text" class="mt-1 block w-full" :value="old('primary_cta_link', $hero->primary_cta_link)" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="secondary_cta_text" :value="__('Secondary CTA Text')" />
                                <x-text-input id="secondary_cta_text" name="secondary_cta_text" type="text" class="mt-1 block w-full" :value="old('secondary_cta_text', $hero->secondary_cta_text)" />
                            </div>
                            <div>
                                <x-input-label for="secondary_cta_link" :value="__('Secondary CTA Link')" />
                                <x-text-input id="secondary_cta_link" name="secondary_cta_link" type="text" class="mt-1 block w-full" :value="old('secondary_cta_link', $hero->secondary_cta_link)" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Hero Image')" />
                            @if($hero->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $hero->image) }}" alt="Current Hero" class="h-20 w-40 object-cover">
                                </div>
                            @endif
                            <input id="image" name="image" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="block mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ $hero->is_active ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Active') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <a href="{{ route('admin.hero.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
