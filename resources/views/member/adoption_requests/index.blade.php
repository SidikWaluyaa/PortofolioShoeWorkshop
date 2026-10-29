<x-member-layout>
    <x-slot name="header">Adopsi Saya</x-slot>

    <div class="mb-6">
        <p class="text-sm text-gray-500">Pantau status adopsi sepatu Anda dan selesaikan langkah berikutnya di sini.</p>
    </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl font-medium text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                // Progress tracker shown for active orders; curation adds a first step
                $curationMode = \App\Services\AdoptionService::curationMode();
                $steps = ($curationMode ? ['pending' => 'Kurasi'] : []) + [
                    'menunggu_pembayaran' => 'Bayar',
                    'menunggu_verifikasi' => 'Verifikasi',
                    'diproses' => 'Disiapkan',
                    'dikirim' => 'Dikirim',
                    'selesai' => 'Selesai',
                ];
                $stepKeys = array_keys($steps);

                $tones = [
                    'amber'   => ['box' => 'bg-amber-50 border-amber-200', 'icon' => 'bg-amber-500', 'title' => 'text-amber-900', 'text' => 'text-amber-800'],
                    'purple'  => ['box' => 'bg-purple-50 border-purple-200', 'icon' => 'bg-purple-600', 'title' => 'text-purple-900', 'text' => 'text-purple-800'],
                    'blue'    => ['box' => 'bg-blue-50 border-blue-200', 'icon' => 'bg-blue-600', 'title' => 'text-blue-900', 'text' => 'text-blue-800'],
                    'emerald' => ['box' => 'bg-emerald-50 border-emerald-200', 'icon' => 'bg-[#22AF85]', 'title' => 'text-emerald-900', 'text' => 'text-emerald-800'],
                    'gray'    => ['box' => 'bg-gray-50 border-gray-200', 'icon' => 'bg-gray-600', 'title' => 'text-gray-900', 'text' => 'text-gray-600'],
                    'red'     => ['box' => 'bg-red-50 border-red-100', 'icon' => 'bg-red-500', 'title' => 'text-red-900', 'text' => 'text-red-700'],
                ];
            @endphp

            <div class="grid grid-cols-1 gap-5">
                @forelse($requests as $req)
                    @php
                        $item = $req->donationItem;
                        $totalBiaya = 0;
                        if ($req->selected_services && count($req->selected_services) > 0 && $item) {
                            foreach ($req->selected_services as $srvId) {
                                $srv = $item->reparationServices->where('id', $srvId)->first();
                                if ($srv) {
                                    $totalBiaya += $srv->jasa_harga;
                                }
                            }
                        }
                        $totalFormatted = 'Rp ' . number_format($totalBiaya, 0, ',', '.');
                        $detailUrl = route('member.adoption-requests.show', $req->id);
                        $otherOrder = $req->status === 'menunggu_pembayaran' ? $req->otherOrderInProgress() : null;

                        // "What do I do next?" panel: [tone, icon, title, description, button label, button url, primary?]
                        if ($req->isReserve()) {
                            $next = ['gray', 'hourglass_top', 'Kamu masuk daftar cadangan',
                                'Sepatu ini sedang ditawarkan ke pemohon lain yang terpilih. Jika pemohon tersebut tidak menyelesaikan pembayaran, pengajuanmu masih bisa dipilih. Mohon jangan transfer apa pun.',
                                'Lihat Detail Pengajuan', $detailUrl, false];
                        } elseif ($req->status === 'pending') {
                            $next = ['blue', 'manage_search', 'Sedang dikurasi tim kami',
                                'Kami meninjau semua pengajuan untuk sepatu ini. Alasan pengajuan dan urutan waktu pengajuan jadi bahan pertimbangan. Jika terpilih, tagihan dikirim lewat email dan tombol bayar muncul di sini. Mohon jangan transfer apa pun sebelum terpilih.',
                                'Lihat Detail Pengajuan', $detailUrl, false];
                        } elseif ($req->isOnHold()) {
                            $next = ['gray', 'hourglass_top', 'Sedang dipesan pemohon lain',
                                'Pemohon lain sudah lebih dulu membayar dan sedang diverifikasi. Mohon jangan transfer dulu, kami kabari jika sepatu tersedia lagi.',
                                'Lihat Status', $detailUrl, false];
                        } elseif ($otherOrder) {
                            $next = ['blue', 'pending_actions', 'Selesaikan pesanan lain dulu',
                                'Pesanan ' . ($otherOrder->donationItem?->nama ?? 'Anda yang lain') . ' sedang diverifikasi/diproses. Mohon jangan transfer untuk sepatu ini dulu.',
                                'Lihat Pesanan Lain', route('member.adoption-requests.show', $otherOrder->id), false];
                        } else {
                            $next = match ($req->status) {
                                'menunggu_pembayaran' => $req->batas_bayar
                                    ? ['amber', 'celebration', 'Selamat, kamu terpilih! Bayar sebelum ' . $req->batas_bayar->translatedFormat('d M, H.i') . ' WIB',
                                        $req->isPaymentOverdue()
                                            ? 'Batas waktu pembayaran sudah lewat. Segera unggah bukti transfer atau hubungi CS kami, karena sepatu dapat dialihkan ke pemohon lain.'
                                            : 'Sepatu sudah kami amankan untukmu. Transfer sesuai tagihan, lalu unggah bukti transfernya sebelum batas waktu.',
                                        'Bayar & Unggah Bukti', $detailUrl . '#pembayaran', true]
                                    : ['amber', 'payments', 'Langkah berikutnya: bayar tagihan',
                                        'Transfer sesuai tagihan, lalu unggah bukti transfernya. Siapa cepat dia dapat: sepatu jadi milik pemohon pertama yang mengunggah bukti bayar.',
                                        'Bayar & Unggah Bukti', $detailUrl . '#pembayaran', true],
                                'menunggu_verifikasi' => ['purple', 'fact_check', 'Bukti bayar sedang dicek',
                                    'Admin sedang memverifikasi pembayaran Anda. Selama proses ini sepatu sudah diamankan untuk Anda.',
                                    'Lihat Detail Pesanan', $detailUrl, false],
                                'diproses' => ['blue', 'inventory_2', 'Sepatu sedang disiapkan',
                                    'Pembayaran terverifikasi. Kami akan mengabari nomor resi saat sepatu dikirim.',
                                    'Lihat Detail Pesanan', $detailUrl, false],
                                'dikirim' => ['emerald', 'local_shipping', 'Sepatu dalam perjalanan',
                                    ($req->resi_pengiriman ? 'No. resi: ' . $req->resi_pengiriman . '. ' : '') . 'Sudah sampai? Konfirmasi penerimaan agar adopsi selesai.',
                                    'Konfirmasi Sepatu Diterima', $detailUrl . '#konfirmasi', true],
                                'selesai' => ['emerald', 'check_circle', 'Adopsi selesai',
                                    'Sepatu resmi menjadi milik Anda. Terima kasih telah memberi kesempatan kedua untuk sepatu ini!',
                                    'Lihat Detail', $detailUrl, false],
                                'ditolak', 'dibatalkan' => ['red', 'cancel', $req->status === 'ditolak' ? 'Permohonan ditolak' : 'Permohonan dibatalkan',
                                    'Permohonan ini tidak dapat dilanjutkan. Masih banyak sepatu hasil restorasi lain di katalog.',
                                    'Cari Sepatu Lain', route('katalog.index'), false],
                                default => ['gray', 'schedule', 'Menunggu proses',
                                    'Permohonan Anda sedang kami proses.',
                                    'Lihat Detail', $detailUrl, false],
                            };
                        }
                        [$toneKey, $icon, $title, $desc, $ctaLabel, $ctaUrl, $isPrimary] = $next;
                        $tone = $tones[$toneKey];

                        $showSteps = in_array($req->status, $stepKeys) && !$req->isOnHold() && !$req->isReserve();
                        $currentStep = array_search($req->status, $stepKeys);
                    @endphp

                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                        {{-- Shoe summary --}}
                        <a href="{{ $detailUrl }}" class="flex items-center gap-4 p-4 sm:p-5 hover:bg-gray-50/60 transition">
                            @if($item)
                                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-2xl border border-gray-200 flex-shrink-0">
                            @else
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-gray-400">inventory_2</span>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <h3 class="font-black text-gray-900 text-[15px] sm:text-base leading-snug line-clamp-2">{{ $item?->nama ?? 'Barang tidak tersedia' }}</h3>
                                @if($item)
                                    <p class="text-[11px] font-bold text-gray-500 mt-1 uppercase tracking-wider truncate">{{ $item->brand ?? 'No Brand' }} • {{ $item->kode_barang }}</p>
                                @endif
                                <p class="text-[11px] text-gray-400 mt-0.5">#ADPS-{{ str_pad($req->id, 5, '0', STR_PAD_LEFT) }} · {{ $req->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="material-symbols-outlined text-gray-300 flex-shrink-0">chevron_right</span>
                        </a>

                        {{-- Progress tracker --}}
                        @if($showSteps)
                            <div class="px-4 sm:px-5 pb-1">
                                <ol class="flex items-start">
                                    @foreach($steps as $key => $label)
                                        @php
                                            $index = $loop->index;
                                            $done = $index < $currentStep;
                                            $active = $index === $currentStep;
                                        @endphp
                                        <li class="flex-1 flex flex-col items-center text-center relative">
                                            @if(!$loop->first)
                                                <span class="absolute top-[11px] right-1/2 w-full h-0.5 {{ $index <= $currentStep ? 'bg-[#22AF85]' : 'bg-gray-200' }}"></span>
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

                        {{-- What to do next --}}
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

                                @if($req->status === 'menunggu_pembayaran' && !$req->isOnHold() && !$otherOrder)
                                    <div class="mt-4 flex items-center justify-between rounded-xl bg-white/70 border border-amber-100 px-4 py-3">
                                        <span class="text-xs font-bold text-amber-900">Total tagihan <span class="font-medium text-amber-700">(di luar ongkir)</span></span>
                                        <span class="text-base font-black text-gray-900">{{ $totalFormatted }}</span>
                                    </div>
                                @endif

                                <a href="{{ $ctaUrl }}"
                                   class="mt-4 w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold transition
                                          {{ $isPrimary ? 'bg-[#22AF85] hover:bg-[#1a936f] text-white shadow-sm' : 'bg-white hover:bg-gray-50 text-gray-800 border border-gray-200' }}">
                                    {{ $ctaLabel }}
                                    <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center shadow-sm">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                            <span class="material-symbols-outlined text-4xl text-gray-300">inbox</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 mb-2">Belum ada permohonan adopsi</h3>
                        <p class="text-gray-500 text-sm font-medium">Anda belum pernah mengajukan adopsi sepatu. Yuk cek sepatu hasil restorasi di katalog!</p>
                        <a href="{{ route('katalog.index') }}" class="inline-block mt-6 px-6 py-3 bg-[#22AF85] hover:bg-[#1a936f] text-white font-bold rounded-xl transition shadow-sm">Lihat Katalog</a>
                    </div>
                @endforelse
            </div>
</x-member-layout>
