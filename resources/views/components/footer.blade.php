<footer class="bg-white py-16 px-4 sm:px-6 lg:px-16 border-t border-gray-200 text-[#1c1c17]">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            {{-- Brand / Col 1 --}}
            <div class="md:col-span-1 space-y-6">
                <a href="{{ route('home') }}" class="inline-block">
                    <picture>
                        <source srcset="{{ asset('images/logo-navbar.webp') }}" type="image/webp">
                        <img src="{{ asset('images/logo-navbar.png') }}" alt="Shoe Workshop" width="480" height="131" loading="lazy" class="h-10 w-auto">
                    </picture>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Workshop spesialis reparasi dan perawatan sepatu profesional dengan hasil terbaik di Indonesia. Menggunakan teknologi modern dan bahan premium.
                </p>
                <div class="flex gap-4">
                    @if(!empty($settings['instagram_link']))
                    <a class="text-gray-400 hover:text-[#22AF85] transition-colors" href="{{ $settings['instagram_link'] }}" target="_blank" rel="noopener" aria-label="Instagram Shoe Workshop">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                    </a>
                    @endif
                    @if(!empty($settings['tiktok_link']))
                    <a class="text-gray-400 hover:text-[#22AF85] transition-colors" href="{{ $settings['tiktok_link'] }}" target="_blank" rel="noopener" aria-label="TikTok Shoe Workshop">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M16.6 5.82A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/></svg>
                    </a>
                    @endif
                    @if(!empty($settings['facebook_link']))
                    <a class="text-gray-400 hover:text-[#22AF85] transition-colors" href="{{ $settings['facebook_link'] }}" target="_blank" rel="noopener" aria-label="Facebook Shoe Workshop">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M14 8.5V6.8c0-.8.2-1.3 1.4-1.3H17V2.2c-.3 0-1.3-.2-2.5-.2-2.5 0-4.2 1.5-4.2 4.3v2.2H7.5V12h2.8v10H14V12h2.8l.4-3.5z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Navigasi / Col 2 --}}
            <div class="space-y-6">
                <h4 class="font-bold uppercase tracking-widest text-xs text-[#1c1c17]">Navigasi</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('layanan.index') }}">Layanan</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('portfolio.index') }}">Portfolio</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('home') }}#review">Testimoni</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('katalog.index') }}">Donasi</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('tracking.index') }}">Tracking Pesanan</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('warranty.index') }}">Klaim Garansi</a></li>
                </ul>
            </div>

            {{-- Layanan / Col 3: the same categories as the /layanan tabs --}}
            @php $footerCategories = \App\Models\LayananCategory::orderBy('order')->get(['name', 'slug']); @endphp
            <div class="space-y-6">
                <h4 class="font-bold uppercase tracking-widest text-xs text-[#1c1c17]">Layanan</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    @foreach($footerCategories as $category)
                        <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('layanan.index') }}#{{ $category->slug }}">{{ $category->name }}</a></li>
                    @endforeach
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('layanan.index') }}">Semua Layanan</a></li>
                </ul>
            </div>

            {{-- Kontak / Col 4 --}}
            <div class="space-y-6">
                <h4 class="font-bold uppercase tracking-widest text-xs text-[#1c1c17]">Kontak</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    @if(!empty($settings['whatsapp_number']))
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-[18px] text-[#22AF85] flex-shrink-0">call</span>
                        {{ $settings['whatsapp_number'] }}
                    </li>
                    @endif
                    @if(!empty($settings['email']))
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-[18px] text-[#22AF85] flex-shrink-0">mail</span>
                        {{ $settings['email'] }}
                    </li>
                    @endif
                    @if(!empty($settings['address']))
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-[18px] text-[#22AF85] flex-shrink-0">location_on</span>
                        <span>{{ $settings['address'] }}</span>
                    </li>
                    @endif
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-[18px] text-[#22AF85] flex-shrink-0">schedule</span>
                        <span>Senin - Sabtu: 09.00 - 17.00 WIB (Minggu tutup)</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} Shoe Workshop. Professional Shoe Repair &amp; Maintenance.</p>
            <div class="flex gap-6">
                <a class="hover:text-[#22AF85] transition-colors" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a class="hover:text-[#22AF85] transition-colors" href="{{ route('terms-of-service') }}">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>