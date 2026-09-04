@extends('layouts.main')

@section('seo_title', 'Syarat dan Ketentuan - Shoe Workshop')
@section('seo_description', 'Syarat dan Ketentuan (Terms of Service) layanan reparasi dan donasi sepatu Shoe Workshop.')

@section('content')
<x-navbar />

<main class="min-h-screen pt-32 pb-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="px-8 py-8 md:px-12 md:py-12 border-b border-gray-100 bg-gradient-to-r from-emerald-500 to-teal-600">
                <h1 class="text-3xl md:text-4xl font-black text-white">Syarat & Ketentuan</h1>
                <p class="text-emerald-50 mt-2 font-medium">Terms of Service Shoe Workshop</p>
            </div>
            
            <!-- Body -->
            <div class="px-8 py-10 md:px-12 md:py-12 text-gray-600 space-y-6 text-base leading-relaxed">
                <p class="text-lg text-gray-800 font-medium">Syarat dan Ketentuan (TOS) ini mengatur penggunaan Anda atas situs web dan layanan Shoe Workshop. Dengan mengakses atau menggunakan layanan perbaikan maupun donasi kami, Anda menyetujui ketentuan berikut.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">1. Layanan Reparasi & Pencucian</h4>
                <p>Estimasi waktu pengerjaan (SLA) yang kami berikan adalah perkiraan. Waktu aktual dapat berubah sewaktu-waktu tergantung pada tingkat kerusakan, ketersediaan material, dan antrean pengerjaan di workshop kami. Segala kerusakan bawaan yang tidak dilaporkan atau terlihat saat serah terima barang bukan menjadi tanggung jawab Shoe Workshop.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">2. Pembayaran & Tagihan</h4>
                <p>Pembayaran layanan perbaikan maupun biaya ongkos kirim (untuk sepatu adopsi/donasi) harus dilakukan secara penuh sesuai dengan tagihan yang tertera di sistem kami. Pembayaran dilakukan melalui metode transfer bank, dompet digital, atau QRIS yang disediakan oleh mitra payment gateway resmi. Pesanan akan diproses atau dikirimkan kembali HANYA setelah dana terverifikasi masuk.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">3. Kebijakan Pengembalian Dana (Refund Policy)</h4>
                <p>Pengembalian dana (refund) HANYA dapat diproses dalam kondisi berikut:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Pesanan dibatalkan sebelum pengerjaan perbaikan dimulai.</li>
                    <li>Terjadi kesalahan fatal dari pihak Shoe Workshop yang menyebabkan kerusakan permanen sehingga sepatu tidak dapat digunakan.</li>
                    <li>Terjadi kelebihan bayar akibat kesalahan sistem tagihan.</li>
                </ul>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">4. Kebijakan Garansi</h4>
                <p>Kami memberikan garansi perbaikan (misalnya untuk pengeleman / reglue) sesuai dengan ketentuan masa garansi layanan masing-masing. Garansi ini otomatis batal/hangus jika kerusakan disebabkan oleh kelalaian penggunaan, cuaca ekstrem, atau dicuci sendiri dengan cara yang salah setelah barang dikembalikan.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">5. Pengambilan & Pengiriman Barang</h4>
                <p>Sepatu yang tidak diambil lebih dari 30 hari kalender sejak pemberitahuan selesai berisiko disumbangkan atau tidak lagi menjadi tanggung jawab kami. Kerusakan atau kehilangan selama proses pengiriman oleh pihak ketiga (kurir/ekspedisi logistik) sepenuhnya merupakan tanggung jawab pihak ekspedisi.</p>
                
                <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-400 font-medium">Terakhir diperbarui: {{ date('d F Y') }}</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-[#22AF85] hover:text-[#198f6b] font-bold transition-colors">
                        <span class="material-symbols-outlined !text-[20px]">arrow_back</span>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer />
@endsection
