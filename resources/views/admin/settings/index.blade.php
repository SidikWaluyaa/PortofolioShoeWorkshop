<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('General Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

                            <div>
                                <h3 class="text-lg font-bold mb-4">Workshop API Integration</h3>
                                <div class="mb-4">
                                    <x-input-label for="workshop_api_base_url" :value="__('Workshop API Base URL')" />
                                    <x-text-input id="workshop_api_base_url" name="workshop_api_base_url" type="url" class="mt-1 block w-full" :value="$settings['workshop_api_base_url'] ?? ''" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="workshop_api_key" :value="__('Workshop API Key (X-API-KEY)')" />
                                    <x-text-input id="workshop_api_key" name="workshop_api_key" type="password" class="mt-1 block w-full" :value="$settings['workshop_api_key'] ?? ''" />
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold mb-4">Marketing & Analytics</h3>
                                <div class="mb-4">
                                    <x-input-label for="looker_studio_url" :value="__('Google Looker Studio Embed URL')" />
                                    <x-text-input id="looker_studio_url" name="looker_studio_url" type="url" class="mt-1 block w-full" :value="$settings['looker_studio_url'] ?? ''" placeholder="https://lookerstudio.google.com/embed/reporting/..." />
                                    <p class="text-xs text-gray-400 mt-1">Tempel link "Embed Report" (hanya URL di dalam atribut src) dari Google Looker Studio untuk menampilkan grafik Google Analytics & Search Console di dashboard admin.</p>
                                </div>
                            </div>
                        </div>

                        @php $adoptionMode = ($settings['adoption_mode'] ?? 'kurasi') === 'cepat' ? 'cepat' : 'kurasi'; @endphp
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h3 class="text-lg font-bold mb-1">Mode Adopsi Sepatu</h3>
                            <p class="text-xs text-gray-400 mb-4">Menentukan cara penerima sepatu adopsi dipilih. Ganti mode hanya saat tidak ada pemohon yang sedang terpilih atau menunggu pembayaran.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="flex items-start gap-3 p-4 rounded-xl border cursor-pointer has-[:checked]:border-[#22AF85] has-[:checked]:bg-emerald-50/50">
                                    <input type="radio" name="adoption_mode" value="kurasi" class="mt-1 text-[#22AF85] focus:ring-[#22AF85]" @checked($adoptionMode === 'kurasi')>
                                    <span>
                                        <span class="block font-bold text-sm text-gray-900">Kurasi Admin</span>
                                        <span class="block text-xs text-gray-500 mt-1 leading-relaxed">Member mengajukan tanpa membayar. Admin memilih satu penerima dari alasan dan urutan pengajuan. Penerima terpilih membayar dalam 2×24 jam, pemohon lain menjadi cadangan. Maksimal 3 pengajuan per member yang sedang dikurasi.</span>
                                    </span>
                                </label>
                                <label class="flex items-start gap-3 p-4 rounded-xl border cursor-pointer has-[:checked]:border-[#22AF85] has-[:checked]:bg-emerald-50/50">
                                    <input type="radio" name="adoption_mode" value="cepat" class="mt-1 text-[#22AF85] focus:ring-[#22AF85]" @checked($adoptionMode === 'cepat')>
                                    <span>
                                        <span class="block font-bold text-sm text-gray-900">Siapa Cepat Dia Dapat</span>
                                        <span class="block text-xs text-gray-500 mt-1 leading-relaxed">Tagihan langsung terbit saat mengajukan. Pemohon pertama yang mengunggah bukti bayar mendapatkan sepatu, pemohon lain ditahan.</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h3 class="text-lg font-bold mb-1">Rating Google</h3>
                            <p class="text-xs text-gray-400 mb-4">Ditampilkan di section Testimoni & hero beranda. Samakan dengan angka di Google Maps secara berkala.</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="google_rating" value="Rating (mis. 4,4)" />
                                    <x-text-input id="google_rating" name="google_rating" type="text" class="mt-1 block w-full" :value="$settings['google_rating'] ?? ''" />
                                </div>
                                <div>
                                    <x-input-label for="google_review_count" value="Jumlah Ulasan (mis. 2.315)" />
                                    <x-text-input id="google_review_count" name="google_review_count" type="text" class="mt-1 block w-full" :value="$settings['google_review_count'] ?? ''" />
                                </div>
                                <div>
                                    <x-input-label for="google_maps_url" value="Link Google Maps" />
                                    <x-text-input id="google_maps_url" name="google_maps_url" type="url" class="mt-1 block w-full" :value="$settings['google_maps_url'] ?? ''" />
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
