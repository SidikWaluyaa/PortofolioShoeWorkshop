<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('General Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-bold mb-4">Website Info</h3>
                                <div class="mb-4">
                                    <x-input-label for="site_title" :value="__('Site Title')" />
                                    <x-text-input id="site_title" name="site_title" type="text" class="mt-1 block w-full" :value="$settings['site_title'] ?? ''" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="site_description" :value="__('Site Description')" />
                                    <textarea id="site_description" name="site_description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold mb-4">Contact Info</h3>
                                <div class="mb-4">
                                    <x-input-label for="whatsapp_number" :value="__('WhatsApp Number (e.g. 628...)')" />
                                    <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full" :value="$settings['whatsapp_number'] ?? ''" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email Address')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$settings['email'] ?? ''" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="address" :value="__('Physical Address')" />
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="$settings['address'] ?? ''" />
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold mb-4">Social Media</h3>
                                <div class="mb-4">
                                    <x-input-label for="instagram_link" :value="__('Instagram URL')" />
                                    <x-text-input id="instagram_link" name="instagram_link" type="text" class="mt-1 block w-full" :value="$settings['instagram_link'] ?? ''" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="tiktok_link" :value="__('TikTok URL')" />
                                    <x-text-input id="tiktok_link" name="tiktok_link" type="text" class="mt-1 block w-full" :value="$settings['tiktok_link'] ?? ''" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="facebook_link" :value="__('Facebook URL')" />
                                    <x-text-input id="facebook_link" name="facebook_link" type="text" class="mt-1 block w-full" :value="$settings['facebook_link'] ?? ''" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-primary-button>{{ __('Save All Settings') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
