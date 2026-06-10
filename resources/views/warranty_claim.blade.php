@extends('layouts.main')
@section('seo_title', 'Klaim Garansi | Shoe Workshop')
@section('seo_description', 'Ajukan klaim garansi reparasi sepatu kamu secara mudah dan cepat di Shoe Workshop.')

@section('content')

{{-- NAVBAR --}}
<header x-data="{ open: false }" class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="flex flex-col leading-tight">
                <span class="text-lg font-extrabold text-[#1c1c17]">Shoe Workshop</span>
                <div class="flex h-1 w-full">
                    <div class="w-1/2 bg-[#22AF85]"></div>
                    <div class="w-1/2 bg-[#FFC232]"></div>
                </div>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Beranda</a>
            <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
            <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Portfolio</a>
            <a href="{{ route('home') }}#review" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Review</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Tracking</a>
            <a href="{{ route('home') }}#kontak" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Kontak</a>
        </div>

        {{-- CTA Button --}}
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
           class="hidden md:inline-flex items-center gap-2 px-6 py-2.5 bg-[#FFC232] text-[#1c1c17] text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#FFC232]/20">
            <span class="material-symbols-outlined !text-[20px]">chat</span>
            Konsultasi via WhatsApp
        </a>

        {{-- Hamburger --}}
        <button @click="open=!open" class="lg:hidden p-2 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden bg-white border-t border-gray-100 px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"         @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Beranda</a>
        <a href="{{ route('home') }}#layanan" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Layanan</a>
        <a href="{{ route('portfolio.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Portfolio</a>
        <a href="{{ route('home') }}#review"  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Review</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Tracking</a>
        <a href="{{ route('home') }}#kontak"  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Kontak</a>
        <div class="pt-2">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#FFC232] text-[#1c1c17] text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined !text-[20px]">chat</span>
                Konsultasi via WhatsApp
            </a>
        </div>
    </div>
</header>

<main class="pt-20">
<div class="min-h-screen bg-gray-50/50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                <span>KLAIM</span>
                <span class="text-[#22AF85]">GARANSI</span>
            </h1>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Ajukan klaim perbaikan jika hasil reparasi sepatu Anda tidak sesuai dengan standar garansi kami.
            </p>
            <div class="mt-4 flex items-center justify-center">
                <a href="{{ route('tracking.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-650 hover:text-[#22AF85] transition-colors border border-gray-200 rounded-lg px-3 py-1.5 hover:bg-gray-50 bg-white shadow-sm">
                    📦 Lacak Status Pesanan Anda
                </a>
            </div>
        </div>

        {{-- Progress Steps --}}
        <div class="mb-10 sm:mb-12">
            <div class="flex items-center justify-center">
                {{-- Desktop Stepper --}}
                <div class="hidden sm:flex items-center w-full max-w-lg justify-between">
                    {{-- Step 1 Indicator --}}
                    <div class="flex flex-col items-center relative" id="step-indicator-1">
                        <div class="w-10 h-10 rounded-full bg-[#22AF85] text-white flex items-center justify-center font-bold ring-4 ring-[#22AF85]/20 transition-all duration-300">
                            1
                        </div>
                        <span class="text-xs font-bold mt-2 text-gray-800 transition-colors">Validasi</span>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-4 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-200 transition-all duration-500" id="progress-line-1"></div>
                    </div>

                    {{-- Step 2 Indicator --}}
                    <div class="flex flex-col items-center relative" id="step-indicator-2">
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300" id="step-circle-2">
                            2
                        </div>
                        <span class="text-xs font-semibold mt-2 text-gray-400" id="step-text-2">Klaim Form</span>
                    </div>

                    <div class="flex-1 h-1 bg-gray-200 mx-4 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-200 transition-all duration-500" id="progress-line-2"></div>
                    </div>

                    {{-- Step 3 Indicator --}}
                    <div class="flex flex-col items-center relative" id="step-indicator-3">
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300" id="step-circle-3">
                            3
                        </div>
                        <span class="text-xs font-semibold mt-2 text-gray-400" id="step-text-3">Selesai</span>
                    </div>
                </div>

                {{-- Mobile Stepper (Premium Compact Progress Bar) --}}
                <div class="flex sm:hidden flex-col items-center w-full px-2">
                    <div class="flex justify-between w-full items-center mb-2.5">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Langkah <span id="mobile-step-num" class="text-gray-800">1</span> dari 3</span>
                        <span class="text-xs font-extrabold text-[#22AF85] uppercase tracking-wider" id="mobile-step-name">Validasi</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                        <div id="mobile-step-progress" class="bg-[#22AF85] h-full w-1/3 transition-all duration-500 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alert Area --}}
        <div id="alert-box" class="hidden mb-6 p-4 rounded-lg border flex items-start gap-3 animate-fade-in">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" id="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <p class="text-sm font-bold" id="alert-title"></p>
                <p class="text-sm mt-0.5 text-gray-600" id="alert-message"></p>
            </div>
        </div>

        {{-- Step Card Containers --}}
        <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

            {{-- STEP 1: VALIDATION --}}
            <div id="step-content-1" class="transition-all duration-300">
                <form id="form-step-1" class="space-y-6">
                    <div>
                        <label for="spk_number" class="block text-sm font-bold text-gray-700 mb-1.5">Nomor SPK</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <input type="text" id="spk_number" required placeholder="Contoh: S-2604-23-0962-MY" 
                                   class="block w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20 transition-all">
                        </div>
                        <p class="mt-1.5 text-xs text-gray-500">Nomor Surat Perintah Kerja yang Anda terima saat pengerjaan selesai.</p>
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-sm font-bold text-gray-700 mb-1.5">Nomor WhatsApp Pelanggan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <input type="tel" id="customer_phone" required placeholder="Contoh: 628123456789" 
                                   class="block w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20 transition-all">
                        </div>
                        <p class="mt-1.5 text-xs text-gray-500">Gunakan nomor telepon yang Anda daftarkan saat melakukan transaksi.</p>
                    </div>

                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl">
                        <h4 class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-2">Ketentuan Garansi:</h4>
                        <ul class="text-xs text-amber-700 space-y-1.5 list-disc pl-4">
                            <li>Status pengerjaan pesanan harus sudah <strong>SELESAI</strong>.</li>
                            <li>Klaim diajukan sebelum masa garansi berakhir (sesuai paket pengerjaan).</li>
                            <li>Tidak diperkenankan mengajukan klaim berulang untuk SPK yang sedang diproses (*Pending* atau *Approved*).</li>
                        </ul>
                    </div>

                    {{-- Checkbox T&C --}}
                    <div class="flex items-start gap-3 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <input type="checkbox" id="agree_terms" required 
                               class="w-5 h-5 rounded border-gray-300 text-[#22AF85] focus:ring-[#22AF85]/20 focus:ring-2 mt-0.5 accent-[#22AF85] cursor-pointer">
                        <label for="agree_terms" class="text-xs text-gray-600 leading-relaxed cursor-pointer select-none">
                            Saya telah membaca dan menyetujui <span id="btn-open-terms" class="text-[#22AF85] hover:text-[#178a67] font-bold underline cursor-pointer">Syarat & Ketentuan</span> klaim garansi.
                        </label>
                    </div>

                    <button type="submit" id="btn-submit-step-1" 
                            class="w-full py-3 px-6 bg-[#22AF85] hover:bg-[#178a67] text-white font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                        <span id="btn-text-1">Cek Ketersediaan Garansi</span>
                        <svg id="btn-spinner-1" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            {{-- STEP 2: FORM SUBMISSION --}}
            <div id="step-content-2" class="hidden transition-all duration-300">
                
                {{-- Customer / Shoe Information Card --}}
                <div class="mb-8 p-5 bg-[#e8f8f5]/40 border border-[#22AF85]/20 rounded-2xl flex flex-col sm:flex-row justify-between gap-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Pelanggan</p>
                        <p class="font-bold text-gray-900" id="info-customer-name">-</p>
                        <p class="text-xs text-gray-500 mt-1" id="info-spk-number">-</p>
                    </div>
                    <div class="sm:border-l sm:border-gray-200/60 sm:pl-6">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Detail Sepatu</p>
                        <p class="font-bold text-gray-900" id="info-shoe-details">-</p>
                        <p class="text-xs text-gray-500 mt-1" id="info-shoe-color">-</p>
                    </div>
                    <div class="sm:border-l sm:border-gray-200/60 sm:pl-6 flex flex-col justify-center">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold bg-[#e8f8f5] text-[#22AF85] rounded-full border border-[#22AF85]/20 w-fit" id="info-warranty-badge">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#22AF85] animate-pulse"></span>
                            Garansi Aktif
                        </span>
                        <p class="text-xs text-gray-500 mt-1.5 font-medium" id="info-warranty-expires">-</p>
                    </div>
                </div>

                <form id="form-step-2" class="space-y-6" enctype="multipart/form-data">
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="problem_description" class="block text-sm font-bold text-gray-700">Detail Keluhan Kerusakan</label>
                            <span class="text-xs text-gray-400" id="char-counter-desc">0 / 1000</span>
                        </div>
                        <textarea id="problem_description" required minlength="10" maxlength="1000" rows="4" 
                                  placeholder="Tuliskan secara detail bagian sepatu mana yang rusak kembali (misal: Sol bagian tumit sepatu kanan terkelupas lagi setelah dipakai 2 kali)..."
                                  class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20 transition-all"></textarea>
                        <p class="mt-1.5 text-xs text-gray-400">Jelaskan kondisi kerusakan yang terjadi secara spesifik agar tim kami mudah memprosesnya (min 10 karakter).</p>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="penggunaan" class="block text-sm font-bold text-gray-700">Keterangan Penggunaan Sepatu</label>
                            <span class="text-xs text-gray-400" id="char-counter-use">0 / 100</span>
                        </div>
                        <input type="text" id="penggunaan" required minlength="5" maxlength="100" placeholder="Contoh: Dipakai jalan santai di mall, dipakai lari pagi" 
                               class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20 transition-all">
                        <p class="mt-1.5 text-xs text-gray-400">Bagaimana sepatu ini digunakan setelah diserahkan ke Anda?</p>
                    </div>

                    {{-- Upload Foto Kerusakan --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Foto Bukti Kerusakan (1 - 3 Foto)</label>
                        <div id="dropzone-problem" class="border-2 border-dashed border-gray-300 hover:border-[#22AF85] rounded-2xl p-5 sm:p-6 text-center cursor-pointer transition-colors bg-gray-50/30">
                            <input type="file" id="problem_photos" multiple accept="image/*" class="hidden">
                            <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm font-bold text-gray-700 block">
                                <span class="hidden sm:inline">Tarik gambar Anda kemari, atau </span>
                                <span class="text-[#22AF85] hover:text-[#178a67]">pilih file / ambil foto</span>
                            </span>
                            <span class="text-xs text-gray-400 block mt-1">Hanya file JPG, PNG, atau WEBP. Maksimal 20MB per file.</span>
                        </div>
                        {{-- Thumbnail Previews --}}
                        <div id="preview-problem" class="grid grid-cols-3 gap-4 mt-4"></div>
                    </div>

                    {{-- Upload Bukti Google Review --}}
                    <div class="border-t border-gray-100 pt-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4 flex gap-3">
                            <span class="text-xl">🌟</span>
                            <div>
                                <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wider mb-1">Dapatkan Claim Priority:</h4>
                                <p class="text-xs text-blue-700 leading-relaxed">
                                    Unggah screenshot bukti ulasan Bintang 5 Anda di Google Maps kami untuk mempercepat proses persetujuan admin. Anda bisa memberi ulasan melalui 
                                    <a href="https://maps.app.goo.gl/rSxrp8gRqce2Euxr5" target="_blank" class="underline font-bold text-[#22AF85]">Link Google Maps Kami</a>.
                                </p>
                            </div>
                        </div>

                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Bukti Screenshot Google Review (1 Foto)</label>
                        <div id="dropzone-review" class="border-2 border-dashed border-gray-300 hover:border-[#22AF85] rounded-2xl p-5 sm:p-6 text-center cursor-pointer transition-colors bg-gray-50/30">
                            <input type="file" id="google_review_photo" accept="image/*" class="hidden">
                            <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm font-bold text-gray-700 block">
                                <span class="hidden sm:inline">Tarik gambar ulasan Anda kemari, atau </span>
                                <span class="text-[#22AF85] hover:text-[#178a67]">pilih file / screenshot</span>
                            </span>
                            <span class="text-xs text-gray-400 block mt-1">Maksimal 20MB. Format JPG, PNG, atau WEBP.</span>
                        </div>
                        {{-- Single Preview --}}
                        <div id="preview-review" class="mt-4 max-w-[200px]"></div>
                    </div>

                    {{-- Submission Progress Bar --}}
                    <div id="upload-progress-container" class="hidden space-y-2">
                        <div class="flex justify-between items-center text-xs font-bold text-gray-600">
                            <span>Sedang mengunggah data klaim...</span>
                            <span id="upload-percent">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2.5 rounded-full overflow-hidden">
                            <div id="upload-progress-bar" class="bg-[#22AF85] h-full w-0 transition-all duration-300 rounded-full"></div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4 border-t border-gray-100">
                        <button type="button" id="btn-back-step-1" 
                                class="flex-1 py-3 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-colors">
                            Kembali
                        </button>
                        <button type="submit" id="btn-submit-step-2" 
                                class="flex-[2] py-3 px-6 bg-[#22AF85] hover:bg-[#178a67] text-white font-bold rounded-xl transition-colors flex items-center justify-center gap-2">
                            <span>Kirim Klaim Garansi</span>
                            <svg id="btn-spinner-2" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- STEP 3: SUCCESS --}}
            <div id="step-content-3" class="hidden text-center py-6 transition-all duration-300">
                <div class="w-20 h-20 bg-[#e8f8f5] text-[#22AF85] rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-[#22AF85]/20 animate-bounce">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 mb-2">Klaim Garansi Berhasil Diajukan!</h3>
                <p class="text-gray-500 max-w-md mx-auto text-sm leading-relaxed mb-8">
                    Data laporan Anda sudah masuk ke sistem backend. Tim verifikator kami akan meninjau keluhan Anda dalam kurun waktu 1x24 jam kerja.
                </p>

                {{-- Submitted Info Card --}}
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 max-w-md mx-auto text-left space-y-4 mb-8">
                    <div class="flex justify-between items-center border-b border-gray-200/60 pb-3">
                        <span class="text-xs text-gray-500 font-bold uppercase">Nomor SPK</span>
                        <span class="text-sm font-bold text-gray-900" id="success-spk">-</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200/60 pb-3">
                        <span class="text-xs text-gray-500 font-bold uppercase">Nama Pelanggan</span>
                        <span class="text-sm font-semibold text-gray-800" id="success-customer">-</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200/60 pb-3">
                        <span class="text-xs text-gray-500 font-bold uppercase">Status Pengajuan</span>
                        <span class="inline-flex px-2.5 py-0.5 text-xs font-bold bg-amber-50 text-amber-700 rounded-full border border-amber-200" id="success-status">PENDING</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 font-bold uppercase">Tanggal Pengajuan</span>
                        <span class="text-xs font-medium text-gray-600" id="success-date">-</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <a href="{{ route('home') }}" class="flex-1 py-3 px-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-colors text-sm">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('tracking.index') }}" class="flex-1 py-3 px-6 bg-[#22AF85] hover:bg-[#178a67] text-white font-bold rounded-xl transition-colors text-sm">
                        Lacak Pesanan Lain
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal Syarat & Ketentuan (Big 4 Styling - Bottom Sheet on Mobile) --}}
<div id="terms-modal" class="hidden fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true" id="close-modal-bg"></div>

    {{-- Modal Panel --}}
    <div class="mobile-bottom-sheet desktop-modal w-full sm:max-w-2xl bg-white rounded-t-3xl sm:rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all border border-gray-100 flex flex-col max-h-[85vh] sm:max-h-[90vh] z-10 animate-fade-in">
        {{-- Drag Handle (Mobile Only) --}}
        <div class="flex sm:hidden justify-center py-3 bg-white cursor-pointer rounded-t-3xl flex-shrink-0" id="modal-drag-handle">
            <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
        </div>

        {{-- Header --}}
        <div class="px-6 pb-4 pt-2 sm:pt-4 border-b border-gray-100 flex items-center justify-between bg-white z-10 flex-shrink-0">
            <div class="flex items-center gap-2">
                <x-application-logo class="h-8 w-auto" />
                <div>
                    <h3 class="text-sm font-extrabold text-gray-900" id="modal-title">Syarat & Ketentuan Garansi</h3>
                    <p class="text-[10px] text-gray-400">Shoe Workshop Peraturan & Kebijakan</p>
                </div>
            </div>
            <button type="button" id="btn-close-terms" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-6 py-5 overflow-y-auto space-y-4 text-xs text-gray-650 leading-relaxed flex-1">
            <div class="text-center pb-3 border-b border-gray-100">
                <p class="font-extrabold text-gray-900 text-sm">Kebijakan Garansi Shoe Workshop</p>
            </div>
            <ol class="list-decimal pl-5 space-y-3">
                <li>Garansi ini hanya berlaku untuk sepatu kamu yang direparasi di Shoe Workshop, sesuai dengan jasa yang dipilih ketika melakukan reparasi sepatu.</li>
                <li>Waktu garansi adalah 100 hari setelah tanggal sepatu selesai dikerjakan oleh Shoe Workshop.</li>
                <li>Garansi menjadi tidak berlaku jika pihak Shoe Workshop menemukan adanya unsur kesengajaan, penyalahgunaan garansi, campur tangan pihak ketiga dalam perbaikan, pemakaian yang tidak sesuai, serta force majeure yang menyebabkan kerusakan pada sepatu.</li>
                <li>Kamu harus melakukan klaim garansi hanya melalui nomor pengaduan ShoeWorkshop (<strong>089533993980</strong>) (WA). Selain nomor ini, tidak akan kami tanggapi.</li>
                <li>Jangan lupa, ketika klaim garansi, kamu harus mengirimkan bukti transaksi, nama akun Instagram/TikTok, atau username lain jika kamu tidak bisa menunjukkan informasi tersebut. Garansi kamu tidak akan kami proses.</li>
                <li>Setelah klaim garansi sepatu disetujui pihak Shoe Workshop, kamu bisa mengirim kembali sepatumu untuk dilakukan proses garansi.</li>
                <li>Biaya pengajuan reparasi sepatu garansi akan ditanggung sepenuhnya oleh pihak Shoe Workshop, tetapi tidak dengan ongkos kirim sepatu.</li>
                <li>Pengerjaan reparasi ulang akan diestimasi kurang lebih 2 minggu setelah barang diterima kembali pihak Shoe Workshop.</li>
                <li>Saat melakukan klaim garansi, sampaikan komplain dan klaim garansi sepatumu dengan tutur kata yang baik dan komunikasi positif. <em>Solve the problem with positivity.</em></li>
                <li>Pihak Shoe Workshop tidak akan merespon jika kamu mengeluarkan kata-kata yang tidak pantas dan tidak berorientasi untuk hal yang solutif. <em>Negativity is not acceptable.</em></li>
                <li>ShoeWorkshop berhak menolak klaim yang tidak sesuai dengan syarat dan ketentuan.</li>
            </ol>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-3 flex-shrink-0">
            <div class="text-[10px] text-gray-400 hidden sm:block">Jam Operasional: Senin - Minggu (09.00 - 17.00)</div>
            <button type="button" id="btn-agree-modal" class="w-full sm:w-auto px-5 py-2.5 bg-[#22AF85] hover:bg-[#178a67] text-white font-bold rounded-xl text-xs transition-colors shadow-sm shadow-[#22AF85]/10">
                Saya Setuju & Lanjutkan
            </button>
        </div>
    </div>
</div>
</main>

@include('components.footer', ['settings' => $settings])

{{-- JavaScript Logic --}}
@section('head')
<style>
    @media (max-width: 639px) {
        .mobile-bottom-sheet {
            animation: slideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            transition: transform 0.15s ease-out;
            will-change: transform;
        }
        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
    }
    @media (min-width: 640px) {
        .desktop-modal {
            animation: fadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
    }
    .animate-fade-in {
        animation: simpleFadeIn 0.3s ease-out forwards;
    }
    @keyframes simpleFadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // API Base configuration
        const API_URL = "{{ $apiUrl }}";
        
        // Form states & Data cache
        let activeStep = 1;
        let validatedSpk = "";
        let validatedPhone = "";
        let problemPhotosList = [];
        let reviewPhotoFile = null;

        // Elements
        const alertBox = document.getElementById('alert-box');
        const alertIcon = document.getElementById('alert-icon');
        const alertTitle = document.getElementById('alert-title');
        const alertMessage = document.getElementById('alert-message');

        const step1Content = document.getElementById('step-content-1');
        const step2Content = document.getElementById('step-content-2');
        const step3Content = document.getElementById('step-content-3');

        const stepCircle2 = document.getElementById('step-circle-2');
        const stepText2 = document.getElementById('step-text-2');
        const stepCircle3 = document.getElementById('step-circle-3');
        const stepText3 = document.getElementById('step-text-3');

        const progressLine1 = document.getElementById('progress-line-1');
        const progressLine2 = document.getElementById('progress-line-2');

        // Step 1 Form
        const formStep1 = document.getElementById('form-step-1');
        const spkInput = document.getElementById('spk_number');
        const phoneInput = document.getElementById('customer_phone');
        const btnSubmit1 = document.getElementById('btn-submit-step-1');
        const btnText1 = document.getElementById('btn-text-1');
        const btnSpinner1 = document.getElementById('btn-spinner-1');

        // Step 2 Form
        const formStep2 = document.getElementById('form-step-2');
        const descInput = document.getElementById('problem_description');
        const useInput = document.getElementById('penggunaan');
        const charCounterDesc = document.getElementById('char-counter-desc');
        const charCounterUse = document.getElementById('char-counter-use');
        
        const dropzoneProblem = document.getElementById('dropzone-problem');
        const fileInputProblem = document.getElementById('problem_photos');
        const previewProblem = document.getElementById('preview-problem');

        const dropzoneReview = document.getElementById('dropzone-review');
        const fileInputReview = document.getElementById('google_review_photo');
        const previewReview = document.getElementById('preview-review');

        const progressContainer = document.getElementById('upload-progress-container');
        const progressPercent = document.getElementById('upload-percent');
        const progressBar = document.getElementById('upload-progress-bar');
        const btnSubmit2 = document.getElementById('btn-submit-step-2');
        const btnSpinner2 = document.getElementById('btn-spinner-2');
        const btnBackStep1 = document.getElementById('btn-back-step-1');

        // Info labels
        const infoCustomerName = document.getElementById('info-customer-name');
        const infoSpkNumber = document.getElementById('info-spk-number');
        const infoShoeDetails = document.getElementById('info-shoe-details');
        const infoShoeColor = document.getElementById('info-shoe-color');
        const infoWarrantyBadge = document.getElementById('info-warranty-badge');
        const infoWarrantyExpires = document.getElementById('info-warranty-expires');

        // Step 3 Elements
        const successSpk = document.getElementById('success-spk');
        const successCustomer = document.getElementById('success-customer');
        const successStatus = document.getElementById('success-status');
        const successDate = document.getElementById('success-date');

        // Helper: Alert Display
        function showAlert(type, title, message) {
            alertBox.className = `mb-6 p-4 rounded-xl border flex items-start gap-3 animate-fade-in ${
                type === 'error' 
                ? 'bg-red-50 border-red-200 text-red-800' 
                : 'bg-green-50 border-green-200 text-green-800'
            }`;
            alertTitle.textContent = title;
            alertMessage.textContent = message;
            alertBox.classList.remove('hidden');
            
            // Scroll to alert
            alertBox.scrollIntoView({ behavior: 'smooth', block: 'end' });
        }

        function hideAlert() {
            alertBox.classList.add('hidden');
        }

        // Live counter
        descInput.addEventListener('input', () => {
            charCounterDesc.textContent = `${descInput.value.length} / 1000`;
            sessionStorage.setItem('draft_warranty_desc', descInput.value);
        });

        useInput.addEventListener('input', () => {
            charCounterUse.textContent = `${useInput.value.length} / 100`;
            sessionStorage.setItem('draft_warranty_use', useInput.value);
        });

        // Load Session Drafts
        if(sessionStorage.getItem('draft_warranty_desc')) {
            descInput.value = sessionStorage.getItem('draft_warranty_desc');
            charCounterDesc.textContent = `${descInput.value.length} / 1000`;
        }
        if(sessionStorage.getItem('draft_warranty_use')) {
            useInput.value = sessionStorage.getItem('draft_warranty_use');
            charCounterUse.textContent = `${useInput.value.length} / 100`;
        }

        // Friendly error mapping for technical error codes & messages (Big 4 Resilient Standard)
        function getFriendlyErrorMessage(status, rawMessage) {
            if (!rawMessage) {
                return {
                    title: 'Gangguan Jaringan',
                    message: 'Gagal menghubungi server verifikasi. Silakan periksa koneksi internet Anda atau coba beberapa saat lagi.'
                };
            }

            const msg = rawMessage.toLowerCase();

            // 1. Method Not Supported / Redirect / Routing Issue
            if (msg.includes('method is not supported') || msg.includes('methodnotallowed') || status === 405) {
                return {
                    title: 'Kendala Koneksi Sistem',
                    message: 'Sistem verifikasi mendeteksi pengalihan koneksi (HTTP/HTTPS) dari browser Anda ke server. Silakan hubungi admin kami atau pastikan setelan link menggunakan protokol HTTPS di Admin Settings.'
                };
            }

            // 2. Not Found / Invalid SPK
            if (msg.includes('tidak ditemukan') || msg.includes('not found') || msg.includes('tidak cocok') || status === 404) {
                return {
                    title: 'Data Garansi Tidak Ditemukan',
                    message: 'Kombinasi Nomor SPK dan Nomor WhatsApp tidak cocok atau tidak terdaftar di sistem. Mohon periksa kembali kesesuaian data pada nota fisik Anda.'
                };
            }

            // 3. Double Claim
            if (msg.includes('double') || msg.includes('sudah ada') || msg.includes('pending') || msg.includes('approved') || (msg.includes('aktif') && (msg.includes('klaim') || msg.includes('claim')))) {
                return {
                    title: 'Klaim Sedang Diproses',
                    message: 'Klaim garansi untuk nomor SPK ini sedang dalam antrean peninjauan atau telah disetujui sebelumnya. Anda tidak dapat mengajukan klaim ganda.'
                };
            }

            // 4. Warranty Expired
            if (msg.includes('expired') || msg.includes('berakhir') || msg.includes('habis') || msg.includes('melewati')) {
                return {
                    title: 'Masa Garansi Berakhir',
                    message: 'Masa berlaku garansi untuk pengerjaan sepatu ini telah berakhir. Jika Anda membutuhkan perbaikan lebih lanjut, silakan hubungi WhatsApp kami untuk konsultasi.'
                };
            }

            // 5. Order Not Finished
            if (msg.includes('selesai') || msg.includes('finish') || msg.includes('proses')) {
                return {
                    title: 'Pesanan Belum Selesai',
                    message: 'Pengajuan klaim garansi hanya dapat dilakukan setelah status pesanan pengerjaan sepatu Anda telah dinyatakan SELESAI.'
                };
            }

            // Fallback for general errors
            return {
                title: 'Klaim Tidak Tersedia',
                message: rawMessage
            };
        }

        // STEP 1 Form submit Handler
        formStep1.addEventListener('submit', async function(e) {
            e.preventDefault();
            hideAlert();

            const agreeTerms = document.getElementById('agree_terms');
            if (!agreeTerms.checked) {
                showAlert('error', 'Persetujuan Diperlukan', 'Anda harus membaca dan menyetujui Syarat & Ketentuan untuk melanjutkan pengajuan klaim garansi.');
                return;
            }

            const spk = spkInput.value.trim();
            const phone = phoneInput.value.trim();

            if (!spk || !phone) {
                showAlert('error', 'Form Belum Lengkap', 'Silakan masukkan nomor SPK dan nomor WhatsApp.');
                return;
            }

            // Lock UI
            btnSubmit1.disabled = true;
            btnText1.textContent = 'Memvalidasi...';
            btnSpinner1.classList.remove('hidden');

            try {
                const response = await fetch(`${API_URL}/check`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        spk_number: spk,
                        customer_phone: phone
                    })
                });

                let resData;
                let isJson = true;
                try {
                    resData = await response.json();
                } catch(e) {
                    isJson = false;
                }

                if (response.ok && isJson && resData.success) {
                    // Cache SPK & Phone
                    validatedSpk = spk;
                    validatedPhone = phone;

                    // Fill Info Card
                    const data = resData.data;
                    infoCustomerName.textContent = data.customer_name;
                    infoSpkNumber.textContent = `No. SPK: ${spk}`;
                    infoShoeDetails.textContent = `${data.shoe_brand} (${data.shoe_type})`;
                    infoShoeColor.textContent = `Warna: ${data.shoe_color}`;
                    infoWarrantyExpires.textContent = `Berlaku s/d: ${data.warranty_expires_at} (${data.days_left} hari tersisa)`;

                    // Go to Step 2
                    transitionToStep(2);
                } else {
                    const errMsg = isJson ? resData.message : 'Respon dari server tidak valid (Format non-JSON).';
                    const friendly = getFriendlyErrorMessage(response.status, errMsg);
                    showAlert('error', friendly.title, friendly.message);
                }
            } catch (err) {
                console.error(err);
                showAlert('error', 'Protokol / Kendala Koneksi', 'Gagal memproses validasi. Mohon pastikan setelan base URL Anda di Admin Settings sudah cocok (diawali dengan https:// jika server backend mengaktifkan SSL/pengalihan HTTPS).');
            } finally {
                // Unlock UI
                btnSubmit1.disabled = false;
                btnText1.textContent = 'Cek Ketersediaan Garansi';
                btnSpinner1.classList.add('hidden');
            }
        });

        // Transition logic
        function transitionToStep(step) {
            activeStep = step;
            hideAlert();

            // Mobile step indicator update
            const mobileStepNum = document.getElementById('mobile-step-num');
            const mobileStepName = document.getElementById('mobile-step-name');
            const mobileStepProgress = document.getElementById('mobile-step-progress');

            if (step === 1) {
                step2Content.classList.add('hidden');
                step3Content.classList.add('hidden');
                step1Content.classList.remove('hidden');
                
                // Indicators reset
                progressLine1.className = "h-full bg-gray-200 transition-all duration-500 w-0";
                stepCircle2.className = "w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300";
                stepText2.className = "text-xs font-semibold mt-2 text-gray-400";

                if (mobileStepNum) mobileStepNum.textContent = "1";
                if (mobileStepName) mobileStepName.textContent = "Validasi";
                if (mobileStepProgress) mobileStepProgress.style.width = "33.33%";
            } else if (step === 2) {
                step1Content.classList.add('hidden');
                step3Content.classList.add('hidden');
                step2Content.classList.remove('hidden');

                // Progress Line active
                progressLine1.className = "h-full bg-[#22AF85] transition-all duration-500 w-full";
                stepCircle2.className = "w-10 h-10 rounded-full bg-[#22AF85] text-white flex items-center justify-center font-bold ring-4 ring-[#22AF85]/20 transition-all duration-300";
                stepText2.className = "text-xs font-bold mt-2 text-gray-800";
                
                progressLine2.className = "h-full bg-gray-200 transition-all duration-500 w-0";
                stepCircle3.className = "w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold transition-all duration-300";
                stepText3.className = "text-xs font-semibold mt-2 text-gray-400";

                if (mobileStepNum) mobileStepNum.textContent = "2";
                if (mobileStepName) mobileStepName.textContent = "Klaim Form";
                if (mobileStepProgress) mobileStepProgress.style.width = "66.66%";
            } else if (step === 3) {
                step1Content.classList.add('hidden');
                step2Content.classList.add('hidden');
                step3Content.classList.remove('hidden');

                // Progress Line all active
                progressLine2.className = "h-full bg-[#22AF85] transition-all duration-500 w-full";
                stepCircle3.className = "w-10 h-10 rounded-full bg-[#22AF85] text-white flex items-center justify-center font-bold ring-4 ring-[#22AF85]/20 transition-all duration-300";
                stepText3.className = "text-xs font-bold mt-2 text-gray-800";

                if (mobileStepNum) mobileStepNum.textContent = "3";
                if (mobileStepName) mobileStepName.textContent = "Selesai";
                if (mobileStepProgress) mobileStepProgress.style.width = "100%";
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Back action
        btnBackStep1.addEventListener('click', () => {
            transitionToStep(1);
        });

        // Dropzones - Problem Photos File Management
        dropzoneProblem.addEventListener('click', () => fileInputProblem.click());
        dropzoneProblem.addEventListener('dragover', (e) => { e.preventDefault(); dropzoneProblem.classList.add('border-[#22AF85]', 'bg-gray-100/50'); });
        dropzoneProblem.addEventListener('dragleave', () => dropzoneProblem.classList.remove('border-[#22AF85]', 'bg-gray-100/50'));
        dropzoneProblem.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzoneProblem.classList.remove('border-[#22AF85]', 'bg-gray-100/50');
            handleProblemPhotos(e.dataTransfer.files);
        });
        fileInputProblem.addEventListener('change', () => {
            handleProblemPhotos(fileInputProblem.files);
        });

        function handleProblemPhotos(files) {
            hideAlert();
            for(let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!file.type.startsWith('image/')) {
                    showAlert('error', 'Format File Salah', 'Hanya file gambar (JPG, PNG, WEBP) yang diizinkan.');
                    continue;
                }
                if (file.size > 20 * 1024 * 1024) {
                    showAlert('error', 'File Terlalu Besar', 'Batas maksimal per berkas adalah 20MB.');
                    continue;
                }
                if (problemPhotosList.length >= 3) {
                    showAlert('error', 'Batas File Terpenuhi', 'Maksimal 3 foto kerusakan yang dapat diunggah.');
                    break;
                }
                
                problemPhotosList.push(file);
            }
            renderProblemPreviews();
        }

        function renderProblemPreviews() {
            previewProblem.innerHTML = "";
            problemPhotosList.forEach((file, index) => {
                const reader = new FileReader();
                const div = document.createElement('div');
                div.className = "relative rounded-xl overflow-hidden border border-gray-200 group h-28 bg-gray-100";
                
                reader.onload = function(e) {
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <button type="button" class="absolute top-1 right-1 bg-red-600/90 text-white rounded-full p-1 hover:bg-red-700 transition-colors shadow-sm" onclick="removeProblemPhoto(${index})">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    `;
                }
                reader.readAsDataURL(file);
                previewProblem.appendChild(div);
            });
        }

        window.removeProblemPhoto = function(index) {
            problemPhotosList.splice(index, 1);
            renderProblemPreviews();
        };

        // Dropzones - Google Review Photo File Management
        dropzoneReview.addEventListener('click', () => fileInputReview.click());
        dropzoneReview.addEventListener('dragover', (e) => { e.preventDefault(); dropzoneReview.classList.add('border-[#22AF85]', 'bg-gray-100/50'); });
        dropzoneReview.addEventListener('dragleave', () => dropzoneReview.classList.remove('border-[#22AF85]', 'bg-gray-100/50'));
        dropzoneReview.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzoneReview.classList.remove('border-[#22AF85]', 'bg-gray-100/50');
            if(e.dataTransfer.files.length > 0) handleReviewPhoto(e.dataTransfer.files[0]);
        });
        fileInputReview.addEventListener('change', () => {
            if(fileInputReview.files.length > 0) handleReviewPhoto(fileInputReview.files[0]);
        });

        function handleReviewPhoto(file) {
            hideAlert();
            if (!file.type.startsWith('image/')) {
                showAlert('error', 'Format File Salah', 'Screenshot Google Maps review wajib berformat gambar.');
                return;
            }
            if (file.size > 20 * 1024 * 1024) {
                showAlert('error', 'File Terlalu Besar', 'Batas maksimum ukuran gambar ulasan adalah 20MB.');
                return;
            }

            reviewPhotoFile = file;
            renderReviewPreview();
        }

        function renderReviewPreview() {
            previewReview.innerHTML = "";
            if (!reviewPhotoFile) return;

            const reader = new FileReader();
            const div = document.createElement('div');
            div.className = "relative rounded-xl overflow-hidden border border-gray-200 group h-28 bg-gray-100";
            
            reader.onload = function(e) {
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <button type="button" class="absolute top-1 right-1 bg-red-600/90 text-white rounded-full p-1 hover:bg-red-700 transition-colors shadow-sm" onclick="removeReviewPhoto()">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                `;
            }
            reader.readAsDataURL(reviewPhotoFile);
            previewReview.appendChild(div);
        }

        window.removeReviewPhoto = function() {
            reviewPhotoFile = null;
            renderReviewPreview();
        };

        // STEP 2 Form Submit Handler
        formStep2.addEventListener('submit', function(e) {
            e.preventDefault();
            hideAlert();

            const description = descInput.value.trim();
            const usage = useInput.value.trim();

            if (description.length < 10) {
                showAlert('error', 'Keluhan Terlalu Singkat', 'Deskripsi keluhan minimal terdiri dari 10 karakter.');
                return;
            }
            if (usage.length < 5) {
                showAlert('error', 'Penggunaan Terlalu Singkat', 'Keterangan penggunaan sepatu minimal 5 karakter.');
                return;
            }
            if (problemPhotosList.length === 0) {
                showAlert('error', 'Bukti Foto Diperlukan', 'Harap unggah minimal 1 foto bukti kerusakan sepatu Anda.');
                return;
            }
            if (!reviewPhotoFile) {
                showAlert('error', 'Screenshot Google Review Diperlukan', 'Harap unggah screenshot bukti Google Review Bintang 5 Anda.');
                return;
            }

            // Lock UI & Show Progress
            btnSubmit2.disabled = true;
            btnBackStep1.disabled = true;
            btnSpinner2.classList.remove('hidden');
            progressContainer.classList.remove('hidden');
            
            // Build Multipart Form Data
            const formData = new FormData();
            formData.append('spk_number', validatedSpk);
            formData.append('customer_phone', validatedPhone);
            formData.append('problem_description', description);
            formData.append('penggunaan', usage);
            
            problemPhotosList.forEach((file, index) => {
                formData.append('problem_photos[]', file);
            });
            formData.append('google_review_photo', reviewPhotoFile);

            // AJAX Upload using XMLHttpRequest to support upload progress bar
            const xhr = new XMLHttpRequest();
            xhr.open('POST', `${API_URL}/submit`, true);
            xhr.setRequestHeader('Accept', 'application/json');

            // Track upload progress
            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percentComplete + '%';
                    progressPercent.textContent = percentComplete + '%';
                }
            };

            // Request completed callback
            xhr.onload = function() {
                btnSubmit2.disabled = false;
                btnBackStep1.disabled = false;
                btnSpinner2.classList.add('hidden');
                
                let res = {};
                try {
                    res = JSON.parse(xhr.responseText);
                } catch(err) {
                    res = { success: false, message: 'Respon server tidak valid.' };
                }

                if (xhr.status >= 200 && xhr.status < 300 && res.success) {
                    // Success! Clear drafts
                    sessionStorage.removeItem('draft_warranty_desc');
                    sessionStorage.removeItem('draft_warranty_use');

                    // Set step 3 data
                    successSpk.textContent = res.data.spk_number || validatedSpk;
                    successCustomer.textContent = res.data.customer_name || 'Pelanggan';
                    successStatus.textContent = res.data.status || 'PENDING';
                    successDate.textContent = new Date().toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }) + ' WIB';

                    // Switch to Step 3
                    transitionToStep(3);
                } else {
                    // Handle validation errors or server failures
                    let errorMsg = res.message || 'Terjadi kesalahan sistem saat mengirimkan data klaim.';
                    if (res.errors) {
                        const firstErr = Object.values(res.errors)[0];
                        if (Array.isArray(firstErr) && firstErr.length > 0) {
                            errorMsg = firstErr[0];
                        }
                    }
                    showAlert('error', 'Gagal Mengirim Klaim', errorMsg);
                    progressContainer.classList.add('hidden');
                }
            };

            xhr.onerror = function() {
                btnSubmit2.disabled = false;
                btnBackStep1.disabled = false;
                btnSpinner2.classList.add('hidden');
                progressContainer.classList.add('hidden');
                showAlert('error', 'Koneksi Bermasalah', 'Gagal mengirimkan klaim karena terputus dari jaringan.');
            };

            // Send payload
            xhr.send(formData);
        });

        // Terms & Conditions Modal logic
        const termsModal = document.getElementById('terms-modal');
        const btnOpenTerms = document.getElementById('btn-open-terms');
        const btnCloseTerms = document.getElementById('btn-close-terms');
        const closeTermsBg = document.getElementById('close-modal-bg');
        const btnAgreeModal = document.getElementById('btn-agree-modal');
        const agreeTermsCheckbox = document.getElementById('agree_terms');

        const modalPanel = termsModal.querySelector('.mobile-bottom-sheet');
        let touchStartY = 0;
        let touchCurrentY = 0;

        function openModal() {
            termsModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            if (modalPanel) modalPanel.style.transform = '';
        }

        function closeModal() {
            termsModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            if (modalPanel) modalPanel.style.transform = '';
        }

        btnOpenTerms.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openModal();
        });
        
        btnCloseTerms.addEventListener('click', closeModal);
        closeTermsBg.addEventListener('click', closeModal);
        
        btnAgreeModal.addEventListener('click', function() {
            agreeTermsCheckbox.checked = true;
            closeModal();
        });

        // Swipe-down to dismiss bottom sheet (for mobile ergonomics)
        if (modalPanel) {
            modalPanel.addEventListener('touchstart', function(e) {
                if (window.innerWidth < 640) {
                    touchStartY = e.touches[0].clientY;
                    touchCurrentY = touchStartY;
                }
            }, { passive: true });

            modalPanel.addEventListener('touchmove', function(e) {
                if (window.innerWidth < 640) {
                    touchCurrentY = e.touches[0].clientY;
                    const deltaY = touchCurrentY - touchStartY;
                    if (deltaY > 0) {
                        // Apply CSS translation to pull the panel down
                        modalPanel.style.transform = `translateY(${deltaY}px)`;
                    }
                }
            }, { passive: true });

            modalPanel.addEventListener('touchend', function() {
                if (window.innerWidth < 640) {
                    const deltaY = touchCurrentY - touchStartY;
                    if (deltaY > 120) {
                        // If pulled down far enough, close the modal
                        closeModal();
                    } else {
                        // Otherwise, snap back into place
                        modalPanel.style.transform = '';
                    }
                }
            });
        }
    });
</script>
@endsection

@endsection
