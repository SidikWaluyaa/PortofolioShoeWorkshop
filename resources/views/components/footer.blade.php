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
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-[18px] text-[#22AF85] flex-shrink-0">schedule</span>
                        <span>Senin - Minggu: 09.00 - 17.00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500" x-data="{ showPrivacy: false, showTOS: false }">
            <p>&copy; {{ date('Y') }} Shoe Workshop. Professional Shoe Repair &amp; Maintenance.</p>
            <div class="flex gap-6">
                <button @click="showPrivacy = true" class="hover:text-[#22AF85] transition-colors focus:outline-none">Privacy Policy</button>
                <button @click="showTOS = true" class="hover:text-[#22AF85] transition-colors focus:outline-none">Terms of Service</button>
            </div>

            <!-- Privacy Policy Modal -->
            <template x-teleport="body">
                <div x-show="showPrivacy" 
                     style="display: none;" 
                     class="fixed inset-0 z-[99999] flex items-center justify-center p-4 sm:p-6" x-cloak>
                    
                    <!-- Backdrop -->
                    <div x-show="showPrivacy" 
                         x-transition.opacity.duration.300ms
                         @click="showPrivacy = false"
                         class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer"></div>

                    <!-- Modal Content -->
                    <div x-show="showPrivacy" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                         class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col z-10 max-h-[85vh]">
                        
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-lg font-bold text-[#1c1c17]">Kebijakan Privasi (Privacy Policy)</h3>
                            <button @click="showPrivacy = false" class="text-gray-400 hover:text-gray-700 transition-colors rounded-full p-1 hover:bg-gray-200">
                                <span class="material-symbols-outlined !text-[20px]">close</span>
                            </button>
                        </div>
                        
                        <!-- Body (Scrollable) -->
                        <div class="px-6 py-6 overflow-y-auto text-sm text-gray-600 space-y-4">
                            <p>Selamat datang di Shoe Workshop. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami di website ini.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">1. Pengumpulan Informasi</h4>
                            <p>Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, seperti saat Anda membuat akun, melakukan pemesanan reparasi, berdonasi sepatu, atau mendaftar untuk newsletter. Informasi ini mungkin termasuk nama lengkap, alamat email, nomor telepon, dan alamat pengiriman.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">2. Penggunaan Informasi</h4>
                            <p>Informasi yang kami kumpulkan digunakan untuk memproses pesanan dan layanan Anda (termasuk verifikasi pembayaran melalui payment gateway resmi kami), memberikan layanan pelanggan, serta mengirimkan pembaruan status perbaikan sepatu Anda.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">3. Keamanan Data</h4>
                            <p>Kami mengimplementasikan standar keamanan yang memadai untuk melindungi data pribadi Anda dari akses yang tidak sah. Jika Anda melakukan pembayaran online, data pembayaran (seperti rincian kartu/rekening) diproses dengan aman secara langsung oleh mitra payment gateway (seperti Midtrans/Xendit) dan tidak disimpan di server kami.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">4. Berbagi Informasi Pihak Ketiga</h4>
                            <p>Kami tidak menjual atau menyewakan informasi pribadi Anda kepada pihak ketiga manapun. Kami hanya membagikan informasi terbatas dengan penyedia layanan pihak ketiga yang membantu operasional kami, seperti jasa ekspedisi/kurir logistik untuk pengiriman, dan penyedia layanan pembayaran terverifikasi.</p>
                            
                            <p class="mt-6 text-xs text-gray-400">Terakhir diperbarui: {{ date('d F Y') }}</p>
                        </div>
                        
                        <!-- Footer -->
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex justify-end">
                            <button @click="showPrivacy = false" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-bold rounded-xl transition-colors active:scale-95">
                                Tutup / Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <!-- TOS Modal -->
            <template x-teleport="body">
                <div x-show="showTOS" 
                     style="display: none;" 
                     class="fixed inset-0 z-[99999] flex items-center justify-center p-4 sm:p-6" x-cloak>
                    
                    <!-- Backdrop -->
                    <div x-show="showTOS" 
                         x-transition.opacity.duration.300ms
                         @click="showTOS = false"
                         class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer"></div>

                    <!-- Modal Content -->
                    <div x-show="showTOS" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                         class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col z-10 max-h-[85vh]">
                        
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-lg font-bold text-[#1c1c17]">Syarat & Ketentuan (Terms of Service)</h3>
                            <button @click="showTOS = false" class="text-gray-400 hover:text-gray-700 transition-colors rounded-full p-1 hover:bg-gray-200">
                                <span class="material-symbols-outlined !text-[20px]">close</span>
                            </button>
                        </div>
                        
                        <!-- Body (Scrollable) -->
                        <div class="px-6 py-6 overflow-y-auto text-sm text-gray-600 space-y-4">
                            <p>Syarat dan Ketentuan (TOS) ini mengatur penggunaan Anda atas situs web dan layanan Shoe Workshop. Dengan mengakses atau menggunakan layanan perbaikan maupun donasi kami, Anda menyetujui ketentuan berikut.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">1. Layanan Reparasi & Pencucian</h4>
                            <p>Estimasi waktu pengerjaan (SLA) yang kami berikan adalah perkiraan. Waktu aktual dapat berubah sewaktu-waktu tergantung pada tingkat kerusakan, ketersediaan material, dan antrean pengerjaan di workshop kami. Segala kerusakan bawaan yang tidak dilaporkan atau terlihat saat serah terima barang bukan menjadi tanggung jawab Shoe Workshop.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">2. Pembayaran & Tagihan</h4>
                            <p>Pembayaran layanan perbaikan maupun biaya ongkos kirim (untuk sepatu adopsi/donasi) harus dilakukan secara penuh sesuai dengan tagihan yang tertera di sistem kami. Pembayaran dilakukan melalui metode transfer bank, dompet digital, atau QRIS yang disediakan oleh mitra payment gateway resmi. Pesanan akan diproses atau dikirimkan kembali HANYA setelah dana terverifikasi masuk.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">3. Kebijakan Pengembalian Dana (Refund Policy)</h4>
                            <p>Pengembalian dana (refund) HANYA dapat diproses dalam kondisi berikut: <br>a) Pesanan dibatalkan sebelum pengerjaan perbaikan dimulai.<br>b) Terjadi kesalahan fatal dari pihak Shoe Workshop yang menyebabkan kerusakan permanen sehingga sepatu tidak dapat digunakan.<br>c) Terjadi kelebihan bayar akibat kesalahan sistem tagihan.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">4. Kebijakan Garansi</h4>
                            <p>Kami memberikan garansi perbaikan (misalnya untuk pengeleman / reglue) sesuai dengan ketentuan masa garansi layanan masing-masing. Garansi ini otomatis batal/hangus jika kerusakan disebabkan oleh kelalaian penggunaan, cuaca ekstrem, atau dicuci sendiri dengan cara yang salah setelah barang dikembalikan.</p>
                            
                            <h4 class="font-bold text-gray-800 mt-4">5. Pengambilan & Pengiriman Barang</h4>
                            <p>Sepatu yang tidak diambil lebih dari 30 hari kalender sejak pemberitahuan selesai berisiko disumbangkan atau tidak lagi menjadi tanggung jawab kami. Kerusakan atau kehilangan selama proses pengiriman oleh pihak ketiga (kurir/ekspedisi logistik) sepenuhnya merupakan tanggung jawab pihak ekspedisi.</p>
                            
                            <p class="mt-6 text-xs text-gray-400">Terakhir diperbarui: {{ date('d F Y') }}</p>
                        </div>
                        
                        <!-- Footer -->
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex justify-end">
                            <button @click="showTOS = false" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-bold rounded-xl transition-colors active:scale-95">
                                Tutup / Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</footer>