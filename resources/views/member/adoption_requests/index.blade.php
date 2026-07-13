<x-member-layout>
    <x-slot name="header">Adopsi Saya</x-slot>

    <div class="mb-6">
        <p class="text-sm text-gray-500">Pantau status permohonan donasi sepatu Anda di sini.</p>
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

            <div class="grid grid-cols-1 gap-6">
                @forelse($requests as $req)
                    @php
                        $item = $req->donationItem;
                        $servicesHtml = '';
                        $totalBiaya = 0;
                        if ($req->selected_services && count($req->selected_services) > 0 && $item) {
                            foreach ($req->selected_services as $srvId) {
                                $srv = $item->reparationServices->where('id', $srvId)->first();
                                if ($srv) {
                                    $totalBiaya += $srv->jasa_harga;
                                }
                            }
                        }

                        // Status Color Mapping
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

                        $colorClass = $statusColors[$req->status] ?? 'bg-gray-100 text-gray-700';
                        $labelText = $statusLabels[$req->status] ?? $req->status;
                    @endphp
                    
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col md:flex-row">
                        <div class="md:w-1/3 bg-gray-50 border-r border-gray-100 p-6 flex flex-col items-center justify-center text-center">
                            @if($item)
                                <img src="{{ $item->foto_utama_url }}" alt="Sepatu" class="w-32 h-32 object-cover rounded-2xl shadow-sm border border-gray-200 mb-4">
                                <h3 class="font-black text-gray-900 text-lg">{{ $item->nama }}</h3>
                                <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">{{ $item->brand ?? 'No Brand' }} • {{ $item->kode_barang }}</p>
                            @else
                                <div class="w-32 h-32 bg-gray-200 rounded-2xl flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-gray-400 text-4xl">inventory_2</span>
                                </div>
                                <p class="text-gray-500 font-bold">Barang tidak tersedia</p>
                            @endif
                        </div>
                        
                        <div class="p-6 md:w-2/3 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Status Permohonan</span>
                                        <span class="inline-flex px-3 py-1 rounded-xl text-xs font-black border {{ $colorClass }}">
                                            {{ $labelText }}
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Tanggal</span>
                                        <span class="text-sm font-semibold text-gray-700">{{ $req->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                
                                @if($req->status === 'menunggu_pembayaran')
                                    <div class="bg-amber-50 p-4 rounded-xl border border-amber-100 flex items-start gap-3 mb-4">
                                        <span class="material-symbols-outlined text-amber-500 text-lg mt-0.5">notification_important</span>
                                        <div>
                                            <p class="text-sm font-bold text-amber-900">Menunggu Pembayaran</p>
                                            <p class="text-xs text-amber-700 mt-1">Harap segera lunasi tagihan sebesar <strong class="font-black">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</strong> agar pesanan tidak batal.</p>
                                        </div>
                                    </div>
                                @elseif($req->status === 'dikirim')
                                    <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100 flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-emerald-600 shadow-sm">
                                                <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-0.5">Pesanan Dikirim</p>
                                                <p class="text-xs font-medium text-emerald-800">Cek detail untuk mengonfirmasi penerimaan barang.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">ID Permohonan:</span>
                                    <span class="text-xs font-black text-gray-700">#ADPS-{{ str_pad($req->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <a href="{{ route('member.adoption-requests.show', $req->id) }}" class="px-5 py-2 bg-[#22AF85]/10 hover:bg-[#22AF85]/20 text-[#22AF85] font-bold text-xs rounded-xl transition flex items-center gap-1.5">
                                    Lihat Detail
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center shadow-sm">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                            <span class="material-symbols-outlined text-4xl text-gray-300">inbox</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-900 mb-2">Belum ada permohonan</h3>
                        <p class="text-gray-500 text-sm font-medium">Anda belum pernah mengajukan permohonan donasi sepatu. Yuk cek katalog donasi!</p>
                        <a href="{{ route('katalog.index') }}" class="inline-block mt-6 px-6 py-3 bg-[#22AF85] hover:bg-[#1a936f] text-white font-bold rounded-xl transition shadow-sm">Lihat Katalog Donasi</a>
                    </div>
                @endforelse
            </div>
</x-member-layout>
