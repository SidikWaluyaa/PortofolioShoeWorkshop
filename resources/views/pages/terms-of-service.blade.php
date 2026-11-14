@extends('layouts.main')

@section('seo_title', 'Syarat dan Ketentuan - Shoe Workshop')
@section('seo_description', 'Syarat dan Ketentuan (Terms of Service) layanan reparasi dan donasi sepatu Shoe Workshop.')

@section('content')
@include('layouts.navigation-public')

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
                <p>Pembayaran layanan perbaikan maupun biaya jasa reparasi (untuk sepatu adopsi) harus dilakukan secara penuh sesuai dengan tagihan yang tertera di sistem kami. Ongkos kirim sepatu adopsi tidak termasuk dalam tagihan dan dikonfirmasi oleh tim CS kami setelah pembayaran. Pembayaran dilakukan melalui transfer bank ke rekening resmi Shoe Workshop yang tercantum pada tagihan. Untuk adopsi sepatu, bukti transfer wajib diunggah melalui halaman Adopsi Saya untuk diverifikasi admin. Pesanan akan diproses atau dikirimkan HANYA setelah pembayaran terverifikasi.</p>
                
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
                
                <h4 id="adapt-adopt" class="font-bold text-gray-900 text-xl mt-8 scroll-mt-24">6. Program Adapt &amp; Adopt by ShoeWorkshop</h4>
                <p>Adapt &amp; Adopt adalah program donasi dan adopsi sepatu. Ketentuan berikut berlaku khusus untuk program ini:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Kurasi donasi.</strong> Sepatu donasi diterima jika kondisinya minimal 70% menurut kurasi tim kami. Donasi online dikurasi dari foto, lalu diperiksa ulang saat sepatu tiba. Donasi di store dikurasi langsung di tempat.</li>
                    <li><strong>Pengiriman donasi.</strong> Setelah lolos kurasi, sepatu dikirim pendonor lewat ekspedisi atau diantar langsung ke store kami.</li>
                    <li><strong>Apresiasi pendonor.</strong> Bentuk apresiasi untuk pendonor menyesuaikan hasil kurasi sepatu yang didonasikan.</li>
                    <li><strong>Biaya adopsi.</strong> Pengadopsi tidak membayar harga sepatu. Yang dibayar adalah biaya jasa reparasi yang sudah dikerjakan pada sepatu tersebut, sesuai yang tercantum di Katalog Adopsi.</li>
                    <li><strong>Pemilihan penerima.</strong> Satu sepatu bisa diajukan beberapa orang. Tim kami memilih satu penerima dengan mempertimbangkan alasan dan urutan waktu pengajuan. Pemohon lain menjadi cadangan.</li>
                    <li><strong>Batas pembayaran.</strong> Penerima terpilih wajib membayar dalam 2×24 jam sejak dinyatakan terpilih. Jika lewat, pengajuan dibatalkan dan sepatu dialihkan ke pemohon cadangan.</li>
                    <li><strong>Tanpa komplain dan garansi.</strong> Tidak ada komplain maupun garansi untuk sepatu adopsi. Kondisi sepatu sudah ditampilkan di Katalog Adopsi sebelum kamu mengajukan.</li>
                </ul>

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
