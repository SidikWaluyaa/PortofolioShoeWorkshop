<footer class="bg-white py-16 px-4 sm:px-6 lg:px-16 border-t border-gray-200 text-[#1c1c17]">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            {{-- Brand / Col 1 --}}
            <div class="md:col-span-1 space-y-6">
                <div class="flex flex-col leading-tight">
                    <span class="text-lg font-black text-[#1c1c17]">Shoe Workshop</span>
                    <div class="flex h-1 w-24">
                        <div class="w-1/2 bg-[#22AF85]"></div>
                        <div class="w-1/2 bg-[#FFC232]"></div>
                    </div>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Workshop spesialis reparasi dan perawatan sepatu profesional dengan hasil terbaik di Indonesia. Menggunakan teknologi modern dan bahan premium.
                </p>
                <div class="flex gap-4">
                    @if(!empty($settings['facebook_link']))
                    <a class="text-gray-400 hover:text-[#22AF85] transition-colors" href="{{ $settings['facebook_link'] }}" target="_blank">
                        <span class="material-symbols-outlined !text-[20px]">public</span>
                    </a>
                    @endif
                    @if(!empty($settings['instagram_link']))
                    <a class="text-gray-400 hover:text-[#22AF85] transition-colors" href="{{ $settings['instagram_link'] }}" target="_blank">
                        <span class="material-symbols-outlined !text-[20px]">public</span>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Navigasi / Col 2 --}}
            <div class="space-y-6">
                <h4 class="font-bold uppercase tracking-widest text-xs text-[#1c1c17]">Navigasi</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#layanan">Layanan</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#portfolio">Portfolio</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#review">Review</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('tracking.index') }}">Tracking Pesanan</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="{{ route('warranty.index') }}">Klaim Garansi</a></li>
                </ul>
            </div>

            {{-- Layanan / Col 3 --}}
            <div class="space-y-6">
                <h4 class="font-bold uppercase tracking-widest text-xs text-[#1c1c17]">Layanan</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#layanan">Treatment</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#layanan">Reparasi Sol</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#layanan">Reglue</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#layanan">Perbaikan Upper</a></li>
                    <li><a class="hover:text-[#22AF85] transition-colors" href="#layanan">Lainnya</a></li>
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
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} Shoe Workshop. Professional Shoe Repair &amp; Maintenance.</p>
            <div class="flex gap-6">
                <a class="hover:text-[#22AF85] transition-colors" href="#">Privacy Policy</a>
                <a class="hover:text-[#22AF85] transition-colors" href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>