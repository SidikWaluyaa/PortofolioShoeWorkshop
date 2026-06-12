<x-app-layout>
    <x-slot name="header">Tracking Pesanan</x-slot>

    <div class="space-y-8 max-w-3xl">

        {{-- API Configuration --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 bg-[#22AF85]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Konfigurasi API Tracking</p>
                    <p class="text-xs text-gray-400">Atur base URL untuk sistem tracking</p>
                </div>
            </div>
            <div class="p-6">
                @if(session('api_saved'))
                <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-xs font-semibold rounded-xl">
                    ✓ Base URL berhasil disimpan.
                </div>
                @endif
                <form method="POST" action="{{ route('admin.tracking.save') }}">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Base URL</label>
                            <input type="url"
                                   name="tracking_base_url"
                                   value="{{ old('tracking_base_url', $baseUrl ?? '') }}"
                                   placeholder="https://your-sistemworkshop-domain.com"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20"
                                   required>
                            @error('tracking_base_url')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-400 mt-2">Format: https://domain.com (tanpa trailing slash)</p>
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-[#22AF85] text-white text-sm font-bold rounded-xl hover:bg-[#178a67] transition-colors whitespace-nowrap">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Test Tracking --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Test Tracking</p>
                    <p class="text-xs text-gray-400">Cari pesanan berdasarkan SPK number</p>
                </div>
            </div>
            <div class="p-6">
                @if(!$baseUrl)
                <div class="px-4 py-3 bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-semibold rounded-xl mb-4">
                    ⚠️ Base URL belum dikonfigurasi. Silakan isi terlebih dahulu.
                </div>
                @endif
                
                <form method="GET" action="{{ route('admin.tracking.index') }}">
                    <div class="flex flex-col sm:flex-row gap-3 mb-6">
                        <input type="text"
                               name="q"
                               value="{{ $query ?? '' }}"
                               placeholder="Contoh: S-2605-04-0001-SW"
                               autofocus
                               class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#22AF85] focus:ring-2 focus:ring-[#22AF85]/20"
                               {{ !$baseUrl ? 'disabled' : '' }}>
                        <button type="submit"
                                class="px-6 py-3 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-gray-700 transition-colors flex items-center gap-2 flex-shrink-0"
                                {{ !$baseUrl ? 'disabled' : '' }}>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>

                {{-- Result --}}
                @if(isset($query) && $query)
                    @if(isset($result) && $result)
                    <div class="border border-gray-100 rounded-2xl overflow-hidden space-y-0">
                        {{-- Header --}}
                        <div class="bg-[#22AF85] px-6 py-5 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold text-white/70 uppercase tracking-widest mb-1">Kode Pesanan</p>
                                <p class="text-2xl font-black text-white">{{ $result['spk_number'] ?? '-' }}</p>
                            </div>
                            <span class="px-4 py-2 bg-white/20 text-white text-xs font-black uppercase tracking-widest rounded-lg">
                                {{ $result['current_status']['label'] ?? 'Dalam Proses' }}
                            </span>
                        </div>

                        {{-- Main Info --}}
                        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100 grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Pelanggan</p>
                                <p class="font-semibold text-gray-900">{{ $result['customer_name'] ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Prioritas</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst(strtolower($result['priority'] ?? '-')) }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Sepatu</p>
                                <p class="font-semibold text-gray-900 text-sm">
                                    @if($result['shoe'] ?? null)
                                        {{ $result['shoe']['brand'] ?? '-' }} {{ $result['shoe']['type'] ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Warna / Ukuran</p>
                                <p class="font-semibold text-gray-900 text-sm">
                                    @if($result['shoe'] ?? null)
                                        {{ $result['shoe']['color'] ?? '-' }} / Size {{ $result['shoe']['size'] ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Timeline Table --}}
                        @if($result['timeline'] ?? null)
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h4 class="text-sm font-bold text-gray-900 mb-4">Timeline Pengerjaan</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-2 px-3 font-bold text-gray-600">No</th>
                                            <th class="text-left py-2 px-3 font-bold text-gray-600">Tahap</th>
                                            <th class="text-center py-2 px-3 font-bold text-gray-600">Status</th>
                                            <th class="text-left py-2 px-3 font-bold text-gray-600">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($result['timeline'] as $index => $stage)
                                        @php
                                            $isCompleted = $stage['is_completed'] ?? false;
                                            $isCurrent = $stage['is_current'] ?? false;
                                            $timestamp = $stage['waktu'] ?? null;
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-3 font-semibold text-gray-600">{{ $loop->iteration }}</td>
                                            <td class="py-3 px-3 font-semibold text-gray-900">{{ $stage['label'] ?? '-' }}</td>
                                            <td class="py-3 px-3 text-center">
                                                @if($isCompleted && !$isCurrent)
                                                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">✓ Selesai</span>
                                                @elseif($isCurrent)
                                                <span class="inline-block px-2 py-1 bg-[#22AF85]/20 text-[#22AF85] rounded text-xs font-bold">● Berlangsung</span>
                                                @else
                                                <span class="inline-block px-2 py-1 bg-gray-100 text-gray-500 rounded text-xs font-bold">○ Menunggu</span>
                                                @endif
                                            </td>
                                                @if($timestamp)
                                                    {{ \Carbon\Carbon::parse($timestamp)->format('d/m/Y H:i') }} WIB
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        {{-- Services --}}
                        @if($result['services'] ?? null)
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h4 class="text-sm font-bold text-gray-900 mb-4">Layanan yang Dikerjakan</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="text-left py-2 px-3 font-bold text-gray-600">Layanan</th>
                                            <th class="text-left py-2 px-3 font-bold text-gray-600">Kategori</th>
                                            <th class="text-right py-2 px-3 font-bold text-gray-600">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($result['services'] as $service)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-3 font-semibold text-gray-900">{{ $service['service_name'] ?? '-' }}</td>
                                            <td class="py-3 px-3 text-gray-600">{{ $service['category'] ?? '-' }}</td>
                                            <td class="py-3 px-3 text-right font-bold text-gray-900">
                                                Rp {{ number_format($service['cost'] ?? 0, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        {{-- Status Description --}}
                        @if($result['current_status']['description'] ?? null)
                        <div class="px-6 py-5 bg-blue-50 border-t border-blue-100">
                            <p class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">Deskripsi Status</p>
                            <p class="text-sm text-blue-900">{{ $result['current_status']['description'] }}</p>
                        </div>
                        @endif
                    </div>
                    @elseif(isset($error))
                    <div class="text-center py-10 bg-red-50 rounded-2xl border border-red-100">
                        <svg class="w-10 h-10 text-red-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="font-bold text-red-600 mb-1">Pesanan tidak ditemukan</p>
                        <p class="text-xs text-red-400">{{ $error }}</p>
                    </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- API Documentation --}}
        <div class="bg-blue-50 rounded-2xl border border-blue-100 p-6">
            <h3 class="text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Dokumentasi API
            </h3>
            <div class="text-xs text-blue-800 space-y-2">
                <p><strong>Endpoint:</strong> <code class="bg-white px-2 py-1 rounded">{BASE_URL}/api/v1/public/track</code></p>
                <p><strong>Method:</strong> GET</p>
                <p><strong>Parameter:</strong> <code class="bg-white px-2 py-1 rounded">spk_number=S-2605-04-0001-SW</code></p>
                <p><strong>Rate Limit:</strong> 60 requests per minute per IP</p>
            </div>
        </div>

    </div>
</x-app-layout>