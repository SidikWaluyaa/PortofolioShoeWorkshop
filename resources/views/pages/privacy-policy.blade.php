@extends('layouts.main')

@section('seo_title', 'Kebijakan Privasi - Shoe Workshop')
@section('seo_description', 'Kebijakan Privasi (Privacy Policy) layanan reparasi dan donasi sepatu Shoe Workshop.')

@section('content')
<x-navbar />

<main class="min-h-screen pt-32 pb-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="px-8 py-8 md:px-12 md:py-12 border-b border-gray-100 bg-gradient-to-r from-emerald-500 to-teal-600">
                <h1 class="text-3xl md:text-4xl font-black text-white">Kebijakan Privasi</h1>
                <p class="text-emerald-50 mt-2 font-medium">Privacy Policy Shoe Workshop</p>
            </div>
            
            <!-- Body -->
            <div class="px-8 py-10 md:px-12 md:py-12 text-gray-600 space-y-6 text-base leading-relaxed">
                <p class="text-lg text-gray-800 font-medium">Selamat datang di Shoe Workshop. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami di website ini.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">1. Pengumpulan Informasi</h4>
                <p>Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, seperti saat Anda membuat akun, melakukan pemesanan reparasi, berdonasi sepatu, atau mendaftar untuk newsletter. Informasi ini mungkin termasuk nama lengkap, alamat email, nomor telepon, dan alamat pengiriman.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">2. Penggunaan Informasi</h4>
                <p>Informasi yang kami kumpulkan digunakan untuk memproses pesanan dan layanan Anda (termasuk verifikasi pembayaran melalui payment gateway resmi kami), memberikan layanan pelanggan, serta mengirimkan pembaruan status perbaikan sepatu Anda.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">3. Keamanan Data</h4>
                <p>Kami mengimplementasikan standar keamanan yang memadai untuk melindungi data pribadi Anda dari akses yang tidak sah. Jika Anda melakukan pembayaran online, data pembayaran (seperti rincian kartu/rekening) diproses dengan aman secara langsung oleh mitra payment gateway (seperti Midtrans/Xendit) dan tidak disimpan di server kami.</p>
                
                <h4 class="font-bold text-gray-900 text-xl mt-8">4. Berbagi Informasi Pihak Ketiga</h4>
                <p>Kami tidak menjual atau menyewakan informasi pribadi Anda kepada pihak ketiga manapun. Kami hanya membagikan informasi terbatas dengan penyedia layanan pihak ketiga yang membantu operasional kami, seperti jasa ekspedisi/kurir logistik untuk pengiriman, dan penyedia layanan pembayaran terverifikasi.</p>
                
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
