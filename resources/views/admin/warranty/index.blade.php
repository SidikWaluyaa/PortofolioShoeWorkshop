<x-app-layout>
    <x-slot name="header">Klaim Garansi</x-slot>

    <div class="space-y-8 max-w-3xl">

        {{-- API Status & Quick Actions --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 bg-[#22AF85]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Status & Manajemen Klaim</p>
                    <p class="text-xs text-gray-400">Integrasi API & Akses Dashboard Admin Utama</p>
                </div>
            </div>
            <div class="p-6 space-y-6">
                @if($baseUrl)
                <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-green-700">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        API KLAIM GARANSI TERKONEKSI
                    </div>
                    <p class="text-xs text-green-950">
                        Menggunakan konfigurasi Base URL bersama dari sistem tracking: 
                        <a href="{{ route('admin.tracking.index') }}" class="underline font-bold text-[#22AF85] hover:text-[#178a67]">{{ $baseUrl }}</a>
                    </p>
                    <div class="pt-1 text-[10px] text-green-600/80 font-mono">
                        Check Endpoint: {{ $warrantyClaimsApiUrl }}/check
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ $cxManagementUrl }}" target="_blank"
                       class="flex-1 px-5 py-3.5 bg-[#22AF85] hover:bg-[#178a67] text-white text-xs font-bold rounded-xl text-center transition-colors flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Buka Manajemen Klaim (SistemWorkshop)
                    </a>
                    <a href="{{ route('warranty.index') }}" target="_blank"
                       class="flex-1 px-5 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl text-center transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat Halaman Publik Klaim
                    </a>
                </div>
                @else
                <div class="p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-amber-700">
                        ⚠️ API BELUM DIKONFIGURASI
                    </div>
                    <p class="text-xs text-amber-950">
                        Untuk menggunakan sistem klaim garansi, silakan atur terlebih dahulu Base URL Backend Workshop pada menu konfigurasi tracking.
                    </p>
                    <a href="{{ route('admin.tracking.index') }}" class="inline-block text-xs font-bold text-[#22AF85] hover:text-[#178a67] underline">
                        Konfigurasi Sekarang &rarr;
                    </a>
                </div>
                @endif
            </div>
        </div>

        {{-- Test Validation Tool --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Alat Uji Garansi (API Checker)</p>
                    <p class="text-xs text-gray-400">Verifikasi status kelayakan klaim secara manual</p>
                </div>
            </div>
            <div class="p-6">
                <form method="GET" action="{{ route('admin.warranty-claims.index') }}">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor SPK</label>
                            <input type="text"
                                   name="spk"
                                   value="{{ $querySpk ?? '' }}"
                                   placeholder="Contoh: S-2604-23-0962-MY"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20"
                                   {{ !$baseUrl ? 'disabled' : '' }} required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor WhatsApp Pelanggan</label>
                            <input type="text"
                                   name="phone"
                                   value="{{ $queryPhone ?? '' }}"
                                   placeholder="Contoh: 628123456789"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20"
                                   {{ !$baseUrl ? 'disabled' : '' }} required>
                        </div>
                    </div>
                    <button type="submit"
                            class="w-full py-2.5 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-gray-700 transition-colors flex items-center justify-center gap-2"
                            {{ !$baseUrl ? 'disabled' : '' }}>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Uji Validitas Garansi SPK
                    </button>
                </form>

                {{-- Result Area --}}
                @if(isset($querySpk) && $querySpk && isset($queryPhone) && $queryPhone)
                    <div class="mt-6 border-t border-gray-100 pt-6">
                        @if($result)
                        <div class="border border-green-150 rounded-2xl overflow-hidden shadow-sm">
                            <div class="bg-[#22AF85] px-6 py-4 flex items-center justify-between text-white">
                                <div>
                                    <p class="text-[10px] font-bold text-white/75 uppercase tracking-wider">Nomor SPK Terverifikasi</p>
                                    <h4 class="text-base font-bold">{{ $querySpk }}</h4>
                                </div>
                                <span class="bg-white/20 text-white text-[10px] font-extrabold uppercase px-2.5 py-1 rounded">
                                    {{ $result['days_left'] }} Hari Tersisa
                                </span>
                            </div>
                            <div class="p-5 bg-gray-50/50 space-y-3.5 text-xs text-gray-700">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase">Nama Pelanggan</p>
                                        <p class="font-bold text-gray-900 mt-0.5">{{ $result['customer_name'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase">Masa Garansi Berakhir</p>
                                        <p class="font-bold text-gray-900 mt-0.5">{{ $result['warranty_expires_at'] }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-100 pt-3">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Model & Tipe Sepatu</p>
                                    <p class="font-semibold text-gray-950">
                                        {{ $result['shoe_brand'] }} ({{ $result['shoe_type'] }}) - {{ $result['shoe_color'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @elseif($error)
                        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-xs font-bold text-red-700">Validasi Garansi Gagal</p>
                                <p class="text-xs mt-1 text-red-650">{{ $error }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- API Documentation (Claims specific) --}}
        <div class="bg-blue-50 rounded-2xl border border-blue-100 p-6 space-y-3">
            <h3 class="text-xs font-bold text-blue-900 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Detail Integrasi REST API Klaim Garansi
            </h3>
            <div class="text-[11px] text-blue-800 space-y-2.5 font-sans leading-relaxed">
                <div>
                    <p class="font-bold">1. Check Ketersediaan Garansi (Step 1)</p>
                    <code class="block bg-white px-3 py-1.5 rounded border border-blue-100/60 mt-1 font-mono text-[10px]">
                        POST {{ $warrantyClaimsApiUrl ?? '{BASE_URL}' }}/check
                    </code>
                    <p class="mt-1">Parameter Wajib: <code class="bg-white/80 px-1 rounded">spk_number</code> dan <code class="bg-white/80 px-1 rounded">customer_phone</code>.</p>
                </div>
                <div class="border-t border-blue-200/40 pt-2.5">
                    <p class="font-bold">2. Kirim Klaim Garansi Baru (Step 2)</p>
                    <code class="block bg-white px-3 py-1.5 rounded border border-blue-100/60 mt-1 font-mono text-[10px]">
                        POST {{ $warrantyClaimsApiUrl ?? '{BASE_URL}' }}/submit
                    </code>
                    <p class="mt-1">
                        Dikirimkan dengan format <code class="bg-white/80 px-1 rounded">multipart/form-data</code>. Parameter Wajib: <code class="bg-white/80 px-1 rounded">spk_number</code>, <code class="bg-white/80 px-1 rounded">customer_phone</code>, <code class="bg-white/80 px-1 rounded">problem_description</code>, <code class="bg-white/80 px-1 rounded">penggunaan</code>, <code class="bg-white/80 px-1 rounded">problem_photos[]</code>, dan <code class="bg-white/80 px-1 rounded">google_review_photo</code>.
                    </p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
