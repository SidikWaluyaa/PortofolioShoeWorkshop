<x-member-layout>
    <x-slot name="header">Riwayat Reparasi</x-slot>

    <div class="max-w-6xl mx-auto py-2">
        {{-- 1. STATE: MISSING PHONE --}}
        @if($status === 'missing_phone')
            <div class="bg-white border border-yellow-200 rounded-2xl p-8 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-5 border border-yellow-100 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">Nomor Telepon Belum Dilengkapi</h3>
                <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                    Sistem memerlukan nomor WhatsApp aktif Anda untuk melakukan sinkronisasi otomatis dengan database pengerjaan di workshop kami. Silakan isi nomor telepon Anda di halaman profil.
                </p>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/25 transition-all">
                    Lengkapi Profil Sekarang
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        {{-- 2. STATE: MISSING CONFIG --}}
        @elseif($status === 'missing_config')
            <div class="bg-white border border-red-200 rounded-2xl p-8 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5 border border-red-100 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">Integrasi Belum Aktif</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-4">
                    Koneksi API sistem workshop luar belum dikonfigurasi oleh administrator saat ini.
                </p>
                <span class="inline-block bg-gray-50 text-gray-500 border border-gray-200 text-xs font-semibold px-4 py-2 rounded-xl">
                    Silakan hubungi admin di workshop untuk mengaktifkan modul integrasi ini.
                </span>
            </div>

        {{-- 3. STATE: API CONNECTION ERROR --}}
        @elseif($status === 'error')
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-8 text-red-800 text-sm shadow-sm flex items-start gap-4">
                <div class="p-2 bg-red-100 text-red-600 rounded-xl">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-red-950">Gagal Menghubungkan Layanan API</h4>
                    <p class="text-xs text-red-700 mt-1 leading-relaxed">{{ $error }}</p>
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $globalSettings['whatsapp_number'] ?? '') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-800 hover:underline mt-3">
                        Hubungi Dukungan CS WhatsApp →
                    </a>
                </div>
            </div>

        {{-- 4. STATE: SUCCESS --}}
        @else
            @php
                $orders = collect($orders ?? []);
                $waNumber = preg_replace('/\D/', '', $globalSettings['whatsapp_number'] ?? '');
                $address = $globalSettings['address'] ?? 'Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung';
                $steps = \App\Services\ReparationHistoryService::STEPS;
                $activeStages = \App\Services\ReparationHistoryService::ACTIVE_STAGES;
                // Tab each order belongs to (cancelled/donated/archived orders only show under "Semua")
                $groupOf = fn ($o) => match (true) {
                    in_array($o['stage'], $activeStages) || $o['stage'] === 'diantar' => 'berjalan',
                    $o['stage'] === 'siap_diambil' => 'siap',
                    $o['stage'] === 'diambil' => 'selesai',
                    default => 'lainnya',
                };
                // Ready to pick up first, then repairs in progress, then the rest (newest first within each)
                $orders = $orders->sortBy(fn ($o) => ['siap' => 0, 'berjalan' => 1, 'selesai' => 2, 'lainnya' => 3][$groupOf($o)])->values();
                $counts = $orders->countBy($groupOf);
                $tones = [
                    'amber'   => ['box' => 'bg-amber-50 border-amber-200', 'icon' => 'bg-amber-500', 'title' => 'text-amber-900', 'text' => 'text-amber-800'],
                    'purple'  => ['box' => 'bg-purple-50 border-purple-200', 'icon' => 'bg-purple-600', 'title' => 'text-purple-900', 'text' => 'text-purple-800'],
                    'blue'    => ['box' => 'bg-blue-50 border-blue-200', 'icon' => 'bg-blue-600', 'title' => 'text-blue-900', 'text' => 'text-blue-800'],
                    'emerald' => ['box' => 'bg-emerald-50 border-emerald-200', 'icon' => 'bg-[#22AF85]', 'title' => 'text-emerald-900', 'text' => 'text-emerald-800'],
                    'red'     => ['box' => 'bg-red-50 border-red-100', 'icon' => 'bg-red-500', 'title' => 'text-red-900', 'text' => 'text-red-700'],
                    'gray'    => ['box' => 'bg-gray-50 border-gray-200', 'icon' => 'bg-gray-600', 'title' => 'text-gray-900', 'text' => 'text-gray-600'],
                ];
                $rupiah = fn ($n) => 'Rp ' . number_format($n, 0, ',', '.');
            @endphp

            @if($orders->isEmpty())
                <div class="bg-white border border-gray-100 rounded-3xl p-10 sm:p-14 text-center shadow-sm max-w-xl mx-auto">
                    <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-5">
                        <span class="material-symbols-outlined !text-[32px]">build</span>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Belum ada riwayat reparasi</h3>
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">Kami belum menemukan pesanan reparasi untuk nomor HP <strong>{{ Auth::user()->phone }}</strong>. Kalau kamu pernah reparasi dengan nomor lain, hubungi CS kami.</p>
                    @if($waNumber)
                        <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#22AF85] hover:bg-[#1a936f] text-white font-bold text-sm rounded-xl transition">Hubungi CS via WhatsApp</a>
                    @endif
                </div>
            @else
                <div x-data="{ tab: 'all', q: '' }">
                    {{-- Tabs + search --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-5">
                        <div class="flex gap-2 overflow-x-auto -mx-4 px-4 sm:mx-0 sm:px-0 [scrollbar-width:none]">
                            @foreach(['all' => 'Semua', 'berjalan' => 'Sedang berjalan', 'siap' => 'Siap diambil', 'selesai' => 'Selesai'] as $key => $label)
                                <button type="button" @click="tab = '{{ $key }}'"
                                        :class="tab === '{{ $key }}' ? 'bg-[#22AF85] border-[#22AF85] text-white' : 'bg-white border-gray-200 text-gray-700 hover:border-[#22AF85]'"
                                        class="shrink-0 px-4 py-2 rounded-full border text-sm font-semibold transition">
                                    {{ $label }} <span class="opacity-70">{{ $key === 'all' ? $orders->count() : ($counts[$key] ?? 0) }}</span>
                                </button>
                            @endforeach
                        </div>
                        <label class="relative sm:ml-auto sm:w-72">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 !text-[20px]">search</span>
                            <input type="search" x-model="q" placeholder="Cari SPK atau merek"
                                   class="w-full pl-10 pr-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </label>
                    </div>

                    <div class="grid grid-cols-1 gap-5">
                        @foreach($orders as $order)
                            @php
                                $group = $groupOf($order);
                                $search = strtolower(implode(' ', [$order['spk'], $order['brand'], $order['type'], collect($order['services'])->pluck('name')->implode(' ')]));
                                $estimasi = $order['estimation_date'] ? ' Estimasi selesai ' . $order['estimation_date']->translatedFormat('d M Y') . '.' : '';
                                $waLink = $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode('Halo Shoe Workshop, saya mau tanya SPK ' . $order['spk']) : null;
                                [$toneKey, $icon, $title, $desc] = match ($order['stage']) {
                                    'belum_diterima' => ['blue', 'inventory', 'Sepatumu belum sampai di workshop', 'Antar atau kirim sepatumu ke workshop. Kami mulai mengecek begitu sepatu diterima.'],
                                    'dicek' => ['blue', 'manage_search', 'Sedang dicek tim kami', 'Kami memeriksa kondisi sepatu dan menentukan pengerjaan yang dibutuhkan.'],
                                    'konfirmasi' => ['amber', 'support_agent', 'Tim kami perlu konfirmasimu', 'CS kami akan menghubungimu lewat WhatsApp soal pengerjaan sepatu ini. Kamu juga bisa menghubungi kami lebih dulu.'],
                                    'pembayaran' => ['amber', 'payments', 'Menunggu pembayaran', 'Pengerjaan dimulai setelah pembayaran atau DP kami terima. Hubungi CS untuk rincian tagihan.'],
                                    'verifikasi' => ['purple', 'fact_check', 'Pembayaran sedang dicek', 'Tim kami sedang memverifikasi pembayaranmu. Pengerjaan berlanjut setelah terverifikasi.'],
                                    'dikerjakan' => ['blue', 'construction', 'Sedang dikerjakan', 'Tahap saat ini: ' . $order['status_label'] . '.' . $estimasi],
                                    'qc' => ['blue', 'verified', 'Pemeriksaan akhir (QC)', 'Sepatumu sedang dicek kualitasnya sebelum diserahkan.' . $estimasi],
                                    'siap_diambil' => ['emerald', 'storefront', 'Siap diambil!', 'Ambil di ' . $address . ', Senin–Sabtu 09.00–17.00 WIB (Minggu tutup).'],
                                    'diantar' => ['emerald', 'local_shipping', 'Sedang diantar', 'Sepatumu sedang dalam perjalanan ke alamatmu.'],
                                    'diambil' => ['emerald', 'task_alt', 'Sudah diambil' . ($order['taken_date'] ? ' ' . $order['taken_date']->translatedFormat('d M Y') : ''), 'Terima kasih sudah mempercayakan sepatumu ke Shoe Workshop.'],
                                    'batal' => ['red', 'cancel', 'Dibatalkan', 'Pesanan ini dibatalkan. Hubungi CS kalau ada pertanyaan.'],
                                    'donasi' => ['gray', 'volunteer_activism', 'Tidak diambil', 'Sepatu tidak diambil sampai batas waktu, sehingga didonasikan sesuai ketentuan.'],
                                    default => ['gray', 'inventory_2', 'Diarsipkan', 'Pesanan ini sudah diarsipkan.'],
                                };
                                $tone = $tones[$toneKey];
                                $showWa = in_array($order['stage'], ['konfirmasi', 'pembayaran', 'batal']);
                            @endphp

                            <article x-show="(tab === 'all' || tab === '{{ $group }}') && (!q || @js($search).includes(q.toLowerCase().trim()))"
                                     class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                                {{-- Shoe summary --}}
                                <div class="flex items-center gap-4 p-4 sm:p-5">
                                    @if($order['cover'])
                                        <img src="{{ $order['cover'] }}" alt="" loading="lazy" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-2xl border border-gray-200 bg-gray-50 flex-shrink-0">
                                    @else
                                        <span class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center flex-shrink-0 text-gray-300">
                                            <span class="material-symbols-outlined !text-[30px]">steps</span>
                                        </span>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="font-black text-gray-900 text-[15px] sm:text-base leading-snug">{{ trim(($order['brand'] ?? '') . ' ' . ($order['type'] ?? '')) ?: 'Sepatu' }}</h3>
                                            @if($order['is_warranty'])
                                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold uppercase tracking-wider">Garansi</span>
                                            @endif
                                        </div>
                                        <p class="text-[11px] font-bold text-gray-500 mt-1 uppercase tracking-wider truncate">
                                            {{ collect([$order['size'] ? 'Ukuran ' . $order['size'] : null, $order['color']])->filter()->implode(' • ') }}
                                        </p>
                                        <p class="text-[11px] text-gray-400 mt-0.5 font-mono">{{ $order['spk'] }}@if($order['entry_date']) <span class="font-sans">· masuk {{ $order['entry_date']->translatedFormat('d M Y') }}</span>@endif</p>
                                    </div>
                                </div>

                                {{-- Progress tracker --}}
                                @if($order['step'] !== null)
                                    <div class="px-4 sm:px-5 pb-1">
                                        <ol class="flex items-start">
                                            @foreach($steps as $index => $label)
                                                @php
                                                    $done = $index < $order['step'];
                                                    $active = $index === $order['step'];
                                                @endphp
                                                <li class="flex-1 flex flex-col items-center text-center relative">
                                                    @if(!$loop->first)
                                                        <span class="absolute top-[11px] right-1/2 w-full h-0.5 {{ $index <= $order['step'] ? 'bg-[#22AF85]' : 'bg-gray-200' }}"></span>
                                                    @endif
                                                    <span class="relative z-10 w-6 h-6 rounded-full flex items-center justify-center text-[11px] font-black
                                                        {{ $done ? 'bg-[#22AF85] text-white' : ($active ? 'bg-white text-[#22AF85] ring-2 ring-[#22AF85]' : 'bg-gray-100 text-gray-400') }}">
                                                        @if($done)
                                                            <span class="material-symbols-outlined !text-[14px]">check</span>
                                                        @else
                                                            {{ $index + 1 }}
                                                        @endif
                                                    </span>
                                                    <span class="mt-1.5 text-[10px] sm:text-[11px] leading-tight {{ $active ? 'font-black text-gray-900' : 'font-semibold text-gray-400' }}">{{ $label }}</span>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                @endif

                                {{-- What's happening / what to do --}}
                                <div class="p-4 sm:p-5">
                                    <div class="rounded-2xl border p-4 {{ $tone['box'] }}">
                                        <div class="flex items-start gap-3">
                                            <span class="w-8 h-8 rounded-full text-white flex items-center justify-center flex-shrink-0 {{ $tone['icon'] }}">
                                                <span class="material-symbols-outlined !text-[18px]">{{ $icon }}</span>
                                            </span>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-black {{ $tone['title'] }}">{{ $title }}</p>
                                                <p class="text-xs leading-relaxed mt-1 {{ $tone['text'] }}">{{ $desc }}</p>
                                            </div>
                                        </div>
                                        @if($showWa && $waLink)
                                            <a href="{{ $waLink }}" target="_blank" rel="noopener"
                                               class="mt-4 w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold bg-[#22AF85] hover:bg-[#1a936f] text-white transition">
                                                Hubungi CS via WhatsApp <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                                            </a>
                                        @elseif($order['stage'] === 'diambil')
                                            <a href="{{ route('warranty.index') }}" class="mt-3 inline-flex items-center gap-1 text-xs font-bold {{ $tone['title'] }} hover:underline">
                                                Ada masalah setelah diambil? Ajukan klaim garansi <span class="material-symbols-outlined !text-[16px]">arrow_forward</span>
                                            </a>
                                        @endif
                                    </div>

                                    {{-- Details --}}
                                    <details class="group mt-3">
                                        <summary class="flex items-center justify-between cursor-pointer list-none px-1 py-2 text-sm font-bold text-gray-700 hover:text-[#22AF85]">
                                            Rincian pengerjaan
                                            <span class="material-symbols-outlined text-gray-400 transition-transform group-open:rotate-180">expand_more</span>
                                        </summary>
                                        <div class="px-1 pb-1 space-y-4">
                                            <div class="rounded-xl border border-gray-100 overflow-hidden">
                                                @forelse($order['services'] as $service)
                                                    <div class="flex justify-between gap-3 px-4 py-2.5 text-sm border-b border-gray-100 last:border-0">
                                                        <span class="text-gray-700">{{ $service['name'] }}</span>
                                                        <span class="font-semibold text-gray-900 whitespace-nowrap">{{ $service['cost'] > 0 ? $rupiah($service['cost']) : '-' }}</span>
                                                    </div>
                                                @empty
                                                    <p class="px-4 py-2.5 text-sm text-gray-500">{{ $order['is_warranty'] ? 'Pengerjaan ulang dari klaim garansi.' : 'Rincian layanan belum tersedia.' }}</p>
                                                @endforelse
                                                <div class="flex justify-between items-center gap-3 px-4 py-3 bg-gray-50 text-sm">
                                                    <span class="font-bold text-gray-700">Total biaya</span>
                                                    <span class="flex items-center gap-2">
                                                        @if($order['is_warranty'] && $order['total'] <= 0)
                                                            <span class="font-black text-emerald-700">Gratis (garansi)</span>
                                                        @else
                                                            <span class="font-black text-gray-900">{{ $rupiah($order['total']) }}</span>
                                                            @if($order['is_paid'])
                                                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold uppercase">Lunas</span>
                                                            @endif
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            <dl class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                                                @foreach(['Masuk' => $order['entry_date'], 'Estimasi selesai' => $order['estimation_date'], 'Selesai' => $order['finished_date'], 'Diambil' => $order['taken_date']] as $label => $date)
                                                    <div class="rounded-xl bg-gray-50 px-3 py-2">
                                                        <dt class="text-gray-400 font-semibold">{{ $label }}</dt>
                                                        <dd class="mt-0.5 font-bold text-gray-800">{{ $date ? $date->translatedFormat('d M Y') : '-' }}</dd>
                                                    </div>
                                                @endforeach
                                            </dl>

                                            @if($order['photos'])
                                                <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                                    @foreach($order['photos'] as $photo)
                                                        <a href="{{ $photo['url'] }}" target="_blank" rel="noopener" class="block aspect-square rounded-lg overflow-hidden border border-gray-200 bg-gray-50" title="{{ $photo['caption'] }}">
                                                            <img src="{{ $photo['url'] }}" alt="{{ $photo['caption'] ?? 'Foto pengerjaan' }}" loading="lazy" class="w-full h-full object-cover">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </details>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <p x-show="q" x-cloak class="mt-6 text-center text-sm text-gray-500">Tidak menemukan yang dicari? Coba kata kunci lain atau hapus pencarian.</p>
                </div>
            @endif
        @endif
    </div>
</x-member-layout>
