<x-member-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('member.adoption-requests.index') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center border border-gray-200 text-gray-500 hover:text-[#22AF85] hover:border-[#22AF85] transition shadow-sm flex-shrink-0">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div class="flex flex-col">
                    <span class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight">Detail Adopsi</span>
                    <span class="text-sm text-gray-500 font-medium">ID Permohonan: <strong class="text-gray-700">#ADPS-{{ str_pad($adoptionRequest->id, 5, '0', STR_PAD_LEFT) }}</strong></span>
                </div>
            </div>
            @php
                $statusColors = [
                    'pending' => 'bg-gray-100 text-gray-700 border-gray-200',
                    'menunggu_pembayaran' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'menunggu_verifikasi' => 'bg-purple-100 text-purple-700 border-purple-200',
                    'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'dikirim' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                    'ditolak' => 'bg-red-50 text-red-500 border-red-100',
                    'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                    'selesai' => 'bg-blue-100 text-blue-700 border-blue-200',
                ];
                $statusLabels = [
                    'pending' => 'Menunggu Seleksi',
                    'menunggu_pembayaran' => 'Menunggu Pembayaran',
                    'menunggu_verifikasi' => 'Menunggu Verifikasi',
                    'diproses' => 'Sedang Diproses',
                    'dikirim' => 'Telah Dikirim',
                    'ditolak' => 'Ditolak',
                    'dibatalkan' => 'Dibatalkan',
                    'selesai' => 'Selesai',
                ];
                $colorClass = $statusColors[$adoptionRequest->status] ?? 'bg-gray-100 text-gray-700';
                $labelText = $statusLabels[$adoptionRequest->status] ?? $adoptionRequest->status;
            @endphp
            <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-xl text-sm font-black border {{ $colorClass }}">
                {{ $labelText }}
            </span>
        </div>
    </x-slot>

    <div class="w-full">

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl font-medium text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-6">
                {{-- Timeline Section --}}
                <div class="p-6 md:p-8 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-6">Status Perjalanan Adopsi</h3>
                    
                    @if(in_array($adoptionRequest->status, ['ditolak', 'dibatalkan']))
                        <div class="bg-red-50 border border-red-100 p-4 rounded-xl flex items-center gap-4">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-500 shadow-sm">
                                <span class="material-symbols-outlined">cancel</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-900 text-sm">Permohonan {{ ucfirst($adoptionRequest->status) }}</h4>
                                <p class="text-xs text-red-700 mt-1">Mohon maaf, permohonan Anda tidak dapat dilanjutkan.</p>
                            </div>
                        </div>
                    @else
                        @php
                            $steps = [
                                'pending' => ['label' => 'Diajukan', 'icon' => 'drafts'],
                                'menunggu_pembayaran' => ['label' => 'Tagihan', 'icon' => 'account_balance'],
                                'menunggu_verifikasi' => ['label' => 'Verifikasi', 'icon' => 'hourglass_empty'],
                                'diproses' => ['label' => 'Diproses', 'icon' => 'build'],
                                'dikirim' => ['label' => 'Dikirim', 'icon' => 'local_shipping'],
                                'selesai' => ['label' => 'Selesai', 'icon' => 'task_alt']
                            ];
                            $stepKeys = array_keys($steps);
                            $currentIndex = array_search($adoptionRequest->status, $stepKeys);
                            if ($currentIndex === false) $currentIndex = 0;
                        @endphp
                        
                        <div class="relative overflow-x-auto pb-4 custom-scrollbar">
                            <div class="min-w-[600px] relative mt-2 mb-2">
                                <!-- Progress Line -->
                                <div class="absolute left-6 right-6 top-5 w-[calc(100%-3rem)] h-1 bg-gray-200 rounded-full z-0"></div>
                                <div class="absolute left-6 top-5 h-1 bg-[#22AF85] rounded-full z-0 transition-all duration-500" style="width: {{ count($stepKeys) > 1 ? ($currentIndex / (count($stepKeys) - 1) * 100) * 0.9 : 0 }}%;"></div>

                                <!-- Steps -->
                                <div class="relative z-10 flex justify-between">
                                    @foreach($steps as $key => $step)
                                        @php
                                            $index = array_search($key, $stepKeys);
                                            $isPast = $index < $currentIndex;
                                            $isCurrent = $index === $currentIndex;
                                            
                                            $circleClass = '';
                                            $iconClass = '';
                                            $textClass = '';
                                            
                                            if ($isPast || $isCurrent) {
                                                $circleClass = 'bg-[#22AF85] shadow-md shadow-[#22AF85]/20 ring-4 ring-gray-50';
                                                $iconClass = 'text-white';
                                                $textClass = $isCurrent ? 'text-[#22AF85] font-black' : 'text-gray-700 font-bold';
                                            } else {
                                                $circleClass = 'bg-white border-2 border-gray-200 ring-4 ring-gray-50';
                                                $iconClass = 'text-gray-300';
                                                $textClass = 'text-gray-400 font-medium';
                                            }
                                        @endphp
                                        <div class="flex flex-col items-center gap-2 w-24">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $circleClass }} transition-colors duration-300 relative">
                                                <span class="material-symbols-outlined text-[18px] {{ $iconClass }}">{{ $step['icon'] }}</span>
                                                @if($isCurrent)
                                                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-amber-400 border-2 border-white rounded-full animate-pulse"></span>
                                                @endif
                                            </div>
                                            <span class="text-[10px] md:text-xs text-center {{ $textClass }}">{{ $step['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col md:flex-row">
                    {{-- Shoe Info --}}
                    <div class="md:w-1/3 bg-white p-6 md:p-8 border-r border-gray-100 flex flex-col text-center">
                        @php $item = $adoptionRequest->donationItem; @endphp
                        @if($item)
                            <div class="relative inline-block mx-auto mb-5">
                                <img src="{{ $item->foto_utama_url }}" alt="Sepatu" class="w-40 h-40 md:w-48 md:h-48 object-cover rounded-2xl shadow-sm border border-gray-200">
                                <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md whitespace-nowrap">
                                    {{ $item->kode_barang }}
                                </span>
                            </div>
                            <h3 class="font-black text-gray-900 text-lg md:text-xl">{{ $item->nama }}</h3>
                            <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">{{ $item->brand ?? 'No Brand' }}</p>
                        @else
                            <div class="w-40 h-40 md:w-48 md:h-48 bg-gray-50 rounded-2xl flex items-center justify-center mb-5 mx-auto border border-gray-100">
                                <span class="material-symbols-outlined text-gray-300 text-5xl">inventory_2</span>
                            </div>
                            <p class="text-gray-500 font-bold">Barang tidak tersedia</p>
                        @endif
                    </div>
                    
                    {{-- Detail Info --}}
                    <div class="p-6 md:p-8 md:w-2/3">
                        @php
                            $totalBiaya = 0;
                            if ($adoptionRequest->selected_services && count($adoptionRequest->selected_services) > 0 && $item) {
                                foreach ($adoptionRequest->selected_services as $srvId) {
                                    $srv = $item->reparationServices->where('id', $srvId)->first();
                                    if ($srv) {
                                        $totalBiaya += $srv->jasa_harga;
                                    }
                                }
                            }
                        @endphp

                        @if($adoptionRequest->status === 'dikirim' && $adoptionRequest->resi_pengiriman)
                            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-2xl mb-6 flex flex-col md:flex-row items-center gap-4">
                                <div class="flex items-center gap-4 w-full md:w-auto flex-1">
                                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-emerald-600 shadow-sm flex-shrink-0">
                                        <span class="material-symbols-outlined text-2xl">local_shipping</span>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-0.5">Nomor Resi Pengiriman</p>
                                        <p class="font-mono text-emerald-900 font-black text-xl">{{ $adoptionRequest->resi_pengiriman }}</p>
                                    </div>
                                </div>
                                <div class="w-full md:w-auto shrink-0 mt-2 md:mt-0">
                                    <form action="{{ route('member.adoption-requests.complete', $adoptionRequest->id) }}" method="POST" onsubmit="confirmAction(event, this, 'Apakah Anda yakin sudah menerima sepatu ini dalam kondisi baik?')">
                                        @csrf
                                        <button type="submit" class="w-full px-5 py-3 bg-[#22AF85] hover:bg-[#1a936f] text-white font-bold text-sm rounded-xl transition shadow-md shadow-[#22AF85]/20 flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-[18px]">done_all</span> Pesanan Diterima
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif($adoptionRequest->status === 'selesai' && $adoptionRequest->resi_pengiriman)
                            <div class="bg-blue-50 border border-blue-100 p-4 rounded-2xl mb-6 flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-600 shadow-sm flex-shrink-0">
                                    <span class="material-symbols-outlined">local_shipping</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider mb-0.5">Nomor Resi Pengiriman</p>
                                    <p class="font-mono text-blue-900 font-black text-lg">{{ $adoptionRequest->resi_pengiriman }}</p>
                                </div>
                            </div>
                        @endif

                        @if($adoptionRequest->status === 'menunggu_pembayaran')
                            {{-- Warning Banner --}}
                            <div class="bg-amber-50 border border-amber-200/60 p-4 rounded-2xl mb-6 flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-amber-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-[16px] font-bold">priority_high</span>
                                </div>
                                <p class="text-[13px] text-amber-900 leading-relaxed font-medium">
                                    <strong class="font-bold">Sistem berlaku siapa cepat dia dapat.</strong> Sepatu akan dikunci hanya setelah bukti transfer diunggah dan terverifikasi. Segera lakukan pembayaran untuk mengamankan barang ini.
                                </p>
                            </div>

                            {{-- Tagihan Card --}}
                            <div class="bg-white border border-gray-100 p-6 md:p-8 rounded-2xl mb-6 shadow-sm">
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-gray-400">account_balance</span>
                                        <h4 class="font-black text-gray-900 text-lg">Tagihan Pembayaran</h4>
                                    </div>
                                    <div class="text-gray-500 font-medium text-sm">
                                        Rp {{ number_format($totalBiaya, 0, ',', '.') }}
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div class="bg-white p-5 rounded-xl border border-gray-200">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Bank BCA</p>
                                        <div class="flex justify-between items-center">
                                            <p class="font-mono text-xl font-black text-gray-900">8100978521</p>
                                            <button type="button" x-data="{ copied: false }" @click="navigator.clipboard.writeText('8100978521'); copied = true; setTimeout(() => copied = false, 2000)" class="text-xs font-bold text-gray-500 border border-gray-200 rounded px-2 py-1 flex items-center gap-1 hover:bg-gray-50 transition">
                                                <span class="material-symbols-outlined text-[12px]" x-text="copied ? 'check' : 'content_copy'"></span> 
                                                <span x-text="copied ? 'Tersalin!' : 'Copy'"></span>
                                            </button>
                                        </div>
                                        <p class="text-[11px] font-bold text-gray-500 mt-2">a.n PT TERANG GARAM SOLUSINDO</p>
                                    </div>
                                    <div class="bg-white p-5 rounded-xl border border-gray-200">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Bank Mandiri</p>
                                        <div class="flex justify-between items-center">
                                            <p class="font-mono text-xl font-black text-gray-900">1300030119047</p>
                                            <button type="button" x-data="{ copied: false }" @click="navigator.clipboard.writeText('1300030119047'); copied = true; setTimeout(() => copied = false, 2000)" class="text-xs font-bold text-gray-500 border border-gray-200 rounded px-2 py-1 flex items-center gap-1 hover:bg-gray-50 transition">
                                                <span class="material-symbols-outlined text-[12px]" x-text="copied ? 'check' : 'content_copy'"></span> 
                                                <span x-text="copied ? 'Tersalin!' : 'Copy'"></span>
                                            </button>
                                        </div>
                                        <p class="text-[11px] font-bold text-gray-500 mt-2">a.n PT TERANG GARAM SOLUSINDO</p>
                                    </div>
                                </div>

                                <form action="{{ route('member.adoption-requests.upload-payment', $adoptionRequest->id) }}" method="POST" enctype="multipart/form-data" x-data="{ fileName: null }">
                                    @csrf
                                    <div class="relative border-2 border-dashed border-gray-200 bg-gray-50/50 hover:bg-gray-50 rounded-xl p-8 text-center transition cursor-pointer mb-4" onclick="document.getElementById('bukti_pembayaran').click()">
                                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg,application/pdf" required class="hidden" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null">
                                        
                                        <div class="w-10 h-10 bg-white shadow-sm border border-gray-200 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-600">
                                            <span class="material-symbols-outlined text-[20px]">upload</span>
                                        </div>
                                        <p class="text-sm font-bold text-gray-700 mb-1" x-show="!fileName">Seret bukti transfer ke sini, atau <span class="text-[#22AF85] underline">pilih file</span></p>
                                        <p class="text-[11px] text-gray-500" x-show="!fileName">Format JPG, PNG, atau PDF, maks 5MB</p>
                                        
                                        <div x-show="fileName" class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-200" style="display: none;">
                                            <span class="material-symbols-outlined text-[14px] text-gray-400">attach_file</span>
                                            <span class="text-xs font-bold text-gray-700" x-text="fileName"></span>
                                            <button type="button" @click.stop="fileName = null; document.getElementById('bukti_pembayaran').value = ''" class="text-gray-400 hover:text-red-500 ml-1">
                                                <span class="material-symbols-outlined text-[14px]">close</span>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full py-3.5 bg-[#22AF85] hover:bg-[#1a936f] text-white font-bold text-sm rounded-xl transition shadow-md shadow-[#22AF85]/20 flex items-center justify-center gap-2">
                                        Kirim Bukti Transfer &rarr;
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Pengiriman</p>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-sm text-gray-700 font-medium h-full">
                                    {{ $adoptionRequest->alamat_pengiriman }}
                                </div>
                            </div>
                            
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Alasan Pengajuan</p>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-sm text-gray-700 italic font-medium h-full">
                                    "{{ $adoptionRequest->alasan ?: '-' }}"
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3">Rincian Jasa & Biaya</p>
                            <div class="bg-gray-50 rounded-xl border border-gray-100 overflow-hidden">
                                @if($adoptionRequest->selected_services && count($adoptionRequest->selected_services) > 0 && $item)
                                    <div class="divide-y divide-gray-100 p-2">
                                        @foreach($adoptionRequest->selected_services as $srvId)
                                            @php
                                                $srv = $item->reparationServices->where('id', $srvId)->first();
                                            @endphp
                                            @if($srv)
                                                <div class="flex justify-between items-center py-3 px-3">
                                                    <span class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                                        <span class="material-symbols-outlined text-[16px] text-[#22AF85]">check_circle</span>
                                                        {{ $srv->jasa_nama_manual ?: ($srv->service ? $srv->service->name : 'Layanan') }}
                                                    </span>
                                                    <span class="text-sm font-bold text-gray-900">Rp {{ number_format($srv->jasa_harga, 0, ',', '.') }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="flex justify-between items-center py-3 px-3 border-t border-dashed border-gray-200 mt-2">
                                            <span class="text-[11px] font-bold text-gray-500">Subtotal</span>
                                            <span class="text-[11px] font-bold text-gray-500">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-5 text-center text-sm text-gray-500 font-medium flex flex-col items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-gray-300 text-3xl">money_off</span>
                                        Tidak ada jasa berbayar yang dipilih. (Gratis)
                                    </div>
                                @endif
                                <div class="bg-gray-900 px-5 py-4 flex justify-between items-center">
                                    <span class="font-bold text-gray-400 text-[10px] uppercase tracking-wider">Total Pembayaran</span>
                                    <span class="text-xl font-black text-[#22AF85]">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        @if($adoptionRequest->bukti_pembayaran)
                            <div class="mt-8 border-t border-gray-100 pt-6">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-3">Bukti Pembayaran Tersimpan</p>
                                <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-100 rounded-xl">
                                    <div class="w-12 h-12 bg-white rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden">
                                        <img src="/storage/{{ $adoptionRequest->bukti_pembayaran }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-gray-900">struk_pembayaran.jpg</p>
                                        <p class="text-xs text-gray-500">Telah diunggah</p>
                                    </div>
                                    <a href="/storage/{{ $adoptionRequest->bukti_pembayaran }}" target="_blank" class="px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-lg transition shadow-sm">
                                        Lihat Gambar
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Help text --}}
            <div class="text-center pb-8">
                <p class="text-xs text-gray-400 font-medium">Ada masalah dengan pesanan ini? <a href="#" class="text-[#22AF85] hover:underline">Hubungi Admin</a></p>
            </div>
    </div>
</x-member-layout>
