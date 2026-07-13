<x-app-layout>
    <x-slot name="header">Pesanan & Pengiriman</x-slot>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <p class="text-sm text-gray-500">Pantau dan kelola pesanan yang sudah lolos seleksi. Verifikasi pembayaran dan input resi pengiriman di sini.</p>
    </div>

    <!-- TABS -->
    <div class="bg-white rounded-t-2xl border-b border-gray-100 flex overflow-x-auto no-scrollbar">
        <a href="{{ route('admin.orders.index', ['tab' => 'siap_kirim']) }}" 
           class="px-6 py-4 text-xs font-bold whitespace-nowrap border-b-2 transition {{ $tab === 'siap_kirim' ? 'border-[#22AF85] text-[#22AF85]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
           Siap Kirim (Diproses)
        </a>
        <a href="{{ route('admin.orders.index', ['tab' => 'dikirim']) }}" 
           class="px-6 py-4 text-xs font-bold whitespace-nowrap border-b-2 transition {{ $tab === 'dikirim' ? 'border-[#22AF85] text-[#22AF85]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
           Sedang Dikirim
        </a>
        <a href="{{ route('admin.orders.index', ['tab' => 'selesai']) }}" 
           class="px-6 py-4 text-xs font-bold whitespace-nowrap border-b-2 transition {{ $tab === 'selesai' ? 'border-[#22AF85] text-[#22AF85]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
           Selesai
        </a>
    </div>

    <div class="bg-white rounded-b-2xl border border-t-0 border-gray-100 mb-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-[10px] text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold tracking-wider">Pemohon</th>
                        <th class="px-6 py-4 font-bold tracking-wider">Barang Donasi</th>
                        <th class="px-6 py-4 font-bold tracking-wider">Info Pengiriman & Tagihan</th>
                        <th class="px-6 py-4 font-bold tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 font-bold tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        @php
                            // Format timestamp
                            $timeStr = $order->created_at->format('d M Y, H:i') . ' WIB';
                            
                            $item = $order->donationItem;

                            // Calculate Total Biaya
                            $totalBiaya = 0;
                            if($item && $item->donation) {
                                // For simplicity, we just check total services if it exists
                                // But since this view doesn't load all services directly, let's keep it simple
                                // Admin already saw the breakdown in the drawer previously
                            }

                            $colors = [
                                'pending' => 'bg-gray-100 text-gray-700 border-gray-200',
                                'menunggu_pembayaran' => 'bg-amber-100 text-amber-700 border-amber-200',
                                'menunggu_verifikasi' => 'bg-purple-100 text-purple-700 border-purple-200',
                                'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'dikirim' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                'ditolak' => 'bg-red-50 text-red-500 border-red-100',
                                'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                'selesai' => 'bg-blue-100 text-blue-700 border-blue-200'
                            ];
                            $labels = [ 
                                'pending' => 'Menunggu', 
                                'menunggu_pembayaran' => 'Tagihan Dikirim', 
                                'menunggu_verifikasi' => 'Cek Pembayaran',
                                'diproses' => 'Diproses',
                                'dikirim' => 'Dikirim',
                                'ditolak' => 'Ditolak',
                                'dibatalkan' => 'Dibatalkan',
                                'selesai' => 'Selesai'
                            ];
                            $badgeColor = $colors[$order->status] ?? 'bg-gray-50 text-gray-500';
                            $labelText = $labels[$order->status] ?? $order->status;
                        @endphp
                        
                        <tr class="hover:bg-slate-50/70 transition" id="request-row-{{ $order->id }}">
                            <td class="px-6 py-4 align-top">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ $timeStr }}</span>
                                <h4 class="font-bold text-gray-900 text-sm mt-0.5">{{ $order->nama_pemohon }}</h4>
                                <div class="flex flex-col gap-0.5 mt-1 text-[11px] text-gray-500">
                                    <span>WA: <a href="https://wa.me/{{ $order->kontak_pemohon }}" target="_blank" class="font-bold text-[#22AF85] hover:underline">+{{ $order->kontak_pemohon }}</a></span>
                                    <span>Email: <strong>{{ $order->email ?? '-' }}</strong></span>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 align-top">
                                @if($item)
                                <div class="flex items-start gap-3">
                                    <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-xl object-cover border border-gray-100 bg-gray-50 flex-shrink-0">
                                    <div>
                                        <p class="font-bold text-gray-950 leading-tight">{{ $item->nama }}</p>
                                        <p class="text-[11px] text-gray-400 font-bold mt-0.5 font-mono">{{ $item->kode_barang }}</p>
                                    </div>
                                </div>
                                @else
                                <span class="text-xs text-gray-400 italic">Barang telah dihapus</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 align-top">
                                <div class="text-[11px] text-gray-700 max-w-xs mb-2">
                                    <strong class="text-gray-500 block">Alamat Pengiriman:</strong>
                                    {{ $order->alamat_pengiriman }}
                                </div>
                                
                                @if($order->bukti_pembayaran)
                                    <div class="mt-2 inline-flex">
                                        <a href="{{ asset('storage/' . $order->bukti_pembayaran) }}" target="_blank" class="px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-200 rounded-lg text-[10px] font-bold hover:bg-purple-100 transition flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">receipt_long</span> Lihat Struk
                                        </a>
                                    </div>
                                @endif
                                
                                @if($order->resi_pengiriman)
                                    <div class="mt-2 text-xs font-bold text-emerald-700 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">local_shipping</span> Resi: <span class="font-mono bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200 ml-1">{{ $order->resi_pengiriman }}</span>
                                    </div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center align-top">
                                <span id="badge-{{ $order->id }}" class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-black border {{ $badgeColor }} whitespace-nowrap">
                                    {{ $labelText }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 text-right align-top">
                                <div class="flex flex-col items-end gap-1.5" id="controls-{{ $order->id }}">
                                    @if($order->status === 'diproses')
                                        <button onclick="promptInputResi({{ $order->id }})" class="px-2.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold transition shadow-sm flex items-center justify-center gap-1 w-full">
                                            <span class="material-symbols-outlined text-[14px]">local_shipping</span> Input Resi
                                        </button>
                                    @endif

                                    @if($order->status === 'dikirim')
                                        <button onclick="confirmAjax('Tandai pesanan ini selesai secara manual? Pastikan barang sudah diterima.', () => ajaxUpdateStatus({{ $order->id }}, 'selesai', this))" class="px-2.5 py-1.5 bg-[#22AF85] hover:bg-[#1a936f] text-white rounded-lg text-xs font-bold transition shadow-sm w-full">Selesaikan</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <span class="material-symbols-outlined !text-[48px] text-gray-200 block mb-2">inbox</span>
                                Belum ada data pesanan di tab ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>

    <!-- Input Resi Modal -->
    <div id="resi-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[9990] hidden flex-col items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-2xl flex flex-col w-full max-w-sm mx-4 transform transition-all">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-black text-gray-900 flex items-center gap-2"><span class="material-symbols-outlined text-[#22AF85]">local_shipping</span> Input Resi</h3>
                <button onclick="closeResiModal()" class="text-gray-400 hover:text-gray-600 transition"><span class="material-symbols-outlined">close</span></button>
            </div>
            <p class="text-xs text-gray-500 mb-4">Masukkan nomor resi pengiriman. Member akan segera diberitahu via email.</p>
            <input type="text" id="resi-input" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#22AF85] focus:border-[#22AF85] outline-none transition mb-4" placeholder="Contoh: JNE-123456789" autocomplete="off">
            <input type="hidden" id="resi-req-id">
            <div class="flex gap-2 w-full">
                <button onclick="closeResiModal()" class="flex-1 py-2.5 rounded-xl font-bold text-xs bg-gray-100 text-gray-600 hover:bg-gray-200 transition">Batal</button>
                <button onclick="submitResiModal()" class="flex-1 py-2.5 rounded-xl font-bold text-xs bg-[#22AF85] text-white hover:bg-[#1a936f] transition shadow-lg shadow-[#22AF85]/30">Kirim Resi</button>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[9999] hidden flex-col items-center justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col items-center max-w-sm w-full mx-4 text-center">
            <span class="material-symbols-outlined text-[#22AF85] text-5xl animate-spin mb-4">progress_activity</span>
            <h3 class="text-lg font-black text-gray-900 mb-2">Memproses Pesanan</h3>
            <p class="text-sm text-gray-500 font-medium">Sistem sedang mengirimkan notifikasi email ke member. Mohon tunggu sebentar...</p>
        </div>
    </div>

    <!-- Scripts for AJAX (Reused from donation_requests) -->
    <script>
        // Set CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function ajaxUpdateStatus(reqId, newStatus, btnElement, extraData = {}) {
            let originalText = '';
            if (btnElement) {
                originalText = btnElement.innerText;
                btnElement.innerText = 'Loading...';
                btnElement.disabled = true;
            }

            const overlay = document.getElementById('loading-overlay');
            if (overlay) {
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
            }

            const payload = {
                status: newStatus,
                ...extraData
            };

            fetch(`/admin/donation-requests/${reqId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (overlay) {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                }

                if (data.success) {
                    // Success, show SweetAlert then reload
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#22AF85'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Gagal!', data.message || 'Terjadi kesalahan sistem.', 'error');
                    if (btnElement) {
                        btnElement.innerText = originalText;
                        btnElement.disabled = false;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (overlay) {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                }
                Swal.fire('Error!', 'Terjadi kesalahan koneksi.', 'error');
                if (btnElement) {
                    btnElement.innerText = originalText;
                    btnElement.disabled = false;
                }
            });
        }

        function promptInputResi(reqId) {
            document.getElementById('resi-req-id').value = reqId;
            document.getElementById('resi-input').value = '';
            
            const modal = document.getElementById('resi-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                document.getElementById('resi-input').focus();
            }, 100);
        }

        function closeResiModal() {
            const modal = document.getElementById('resi-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitResiModal() {
            const reqId = document.getElementById('resi-req-id').value;
            const resi = document.getElementById('resi-input').value;
            
            if (resi.trim() === '') {
                Swal.fire('Perhatian', 'Nomor resi tidak boleh kosong!', 'warning');
                return;
            }

            closeResiModal();
            ajaxUpdateStatus(reqId, 'dikirim', null, { resi_pengiriman: resi.trim() });
        }
    </script>
</x-app-layout>
