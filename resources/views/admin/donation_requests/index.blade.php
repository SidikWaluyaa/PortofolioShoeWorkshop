<x-app-layout>
    <x-slot name="header">Kelola Permohonan Barang Donasi</x-slot>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
        <p class="text-sm text-gray-500">Tinjau, setujui, atau tolak permohonan barang donasi dari pengunjung.</p>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-medium">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                        <th class="px-6 py-4">Waktu Pengajuan</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Alamat Pengiriman</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi / Chat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($requests as $req)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- Tanggal --}}
                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                            {{ $req->created_at->translatedFormat('d M Y, H:i') }} WIB
                        </td>

                        {{-- Pemohon --}}
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-900">{{ $req->nama_pemohon }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">Hub: +{{ $req->kontak_pemohon }}</p>
                            @if($req->user)
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 mt-1 rounded bg-gray-50 text-[10px] text-gray-500 font-semibold border border-gray-200">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Terdaftar (ID: {{ $req->user_id }})
                                </span>
                            @endif
                        </td>

                        {{-- Barang --}}
                        <td class="px-6 py-4">
                            @if($req->donationItem)
                                <div class="flex items-center gap-3">
                                    <img src="{{ $req->donationItem->foto_utama_url }}" alt="{{ $req->donationItem->nama }}" class="w-10 h-10 rounded-lg object-cover border border-gray-100 bg-gray-50 flex-shrink-0">
                                    <div>
                                        <p class="font-bold text-gray-950 leading-tight">{{ $req->donationItem->nama }}</p>
                                        <p class="text-[11px] text-gray-400 font-medium mt-0.5">Brand: {{ $req->donationItem->brand ?? '-' }} | Kategori: {{ ucfirst($req->donationItem->kategori) }}</p>
                                    </div>
                                </div>
                            @else
                                <span class="text-xs text-red-500 font-bold bg-red-50 border border-red-150 px-2 py-0.5 rounded-md">[BARANG DIHAPUS]</span>
                            @endif
                        </td>

                        {{-- Alamat --}}
                        <td class="px-6 py-4 text-gray-600 max-w-xs">
                            <span class="block truncate" title="{{ $req->alamat_pengiriman }}">{{ $req->alamat_pengiriman }}</span>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-50 text-amber-700 border border-amber-100',
                                    'disetujui' => 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                                    'ditolak' => 'bg-red-50 text-red-700 border border-red-100'
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu',
                                    'disetujui' => 'Disetujui',
                                    'ditolak' => 'Ditolak'
                                ];
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg text-xs font-black {{ $statusColors[$req->status] ?? 'bg-gray-50 text-gray-500' }}">
                                {{ $statusLabels[$req->status] ?? ucfirst($req->status) }}
                            </span>
                        </td>

                        {{-- Aksi / Chat --}}
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2">
                                {{-- Status Controls --}}
                                <div class="flex items-center gap-2">
                                    @if($req->status === 'pending')
                                        <form action="{{ route('admin.donation-requests.update', $req) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="px-2.5 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-bold transition">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.donation-requests.update', $req) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="px-2.5 py-1 bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 rounded-lg text-xs font-bold transition">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        {{-- Reset to pending control if needed --}}
                                        <form action="{{ route('admin.donation-requests.update', $req) }}" method="POST" onsubmit="return confirm('Ubah kembali status ke Menunggu?')">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="px-2 py-0.5 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded text-[11px] font-bold border border-gray-200 transition">
                                                Reset ke Menunggu
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                {{-- WhatsApp Pre-filled Chat template --}}
                                @if($req->donationItem)
                                    @php
                                        $itemName = $req->donationItem->nama;
                                        $approveMsg = "Halo {$req->nama_pemohon},\n\nPengajuan Anda untuk mendapatkan barang donasi *{$itemName}* telah kami *SETUJUI*. Barang akan segera disiapkan untuk pengiriman ke alamat:\n\n{$req->alamat_pengiriman}\n\nKami akan menginfokan resi pengiriman segera setelah paket diserahkan ke ekspedisi. Terima kasih!";
                                        $rejectMsg = "Halo {$req->nama_pemohon},\n\nTerima kasih telah mengajukan permohonan untuk barang donasi *{$itemName}*.\n\nMohon maaf, setelah melakukan verifikasi data, permohonan Anda belum dapat kami setujui saat ini. Anda dapat mencoba mengajukan permohonan untuk barang lain yang tersedia di katalog kami.\n\nTerima kasih atas pengertiannya.";
                                        
                                        $waApproveUrl = "https://wa.me/" . $req->kontak_pemohon . "?text=" . urlencode($approveMsg);
                                        $waRejectUrl = "https://wa.me/" . $req->kontak_pemohon . "?text=" . urlencode($rejectMsg);
                                    @endphp
                                    <div class="flex items-center gap-1.5">
                                        <a href="https://wa.me/{{ $req->kontak_pemohon }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-bold text-gray-500 hover:text-[#22AF85] transition">
                                            <svg class="w-3.5 h-3.5 text-[#22AF85]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.004 2C6.51 2 2.014 6.5 2.014 12c0 2.14.675 4.15 1.875 5.8l-1.378 4.63a1 1 0 0 0 1.22 1.23l4.735-1.39A9.97 9.97 0 0 0 12.004 22c5.495 0 9.991-4.5 9.991-10S17.499 2 12.004 2zm5.728 14.1c-.247.7-1.42 1.28-1.95 1.34c-.48.06-1.1.08-3.19-.78c-2.67-1.1-4.39-3.8-4.52-3.98c-.13-.18-1.09-1.45-1.09-2.77c0-1.32.69-1.97.94-2.23c.25-.26.54-.33.72-.33c.18 0 .36.01.52.02c.17.01.39-.06.61.47c.23.55.78 1.91.85 2.05c.07.14.12.31.02.51c-.1.2-.15.33-.3.5c-.15.17-.32.39-.46.52c-.15.15-.31.31-.13.62c.18.3.79 1.3 1.7 2.11c1.17 1.04 2.16 1.37 2.47 1.52c.31.15.49.13.67-.08c.18-.21.78-.91.99-1.22c.21-.31.42-.26.7-.15c.28.11 1.77.83 2.08.99c.3.16.51.24.59.37c.07.13.07.76-.17 1.46z"/></svg>
                                            Chat Langsung
                                        </a>
                                        @if($req->status === 'disetujui')
                                            <span class="text-gray-300">|</span>
                                            <a href="{{ $waApproveUrl }}" target="_blank" class="text-[11px] font-extrabold text-emerald-600 hover:underline">
                                                Kirim Template Setuju
                                            </a>
                                        @elseif($req->status === 'ditolak')
                                            <span class="text-gray-300">|</span>
                                            <a href="{{ $waRejectUrl }}" target="_blank" class="text-[11px] font-extrabold text-red-500 hover:underline">
                                                Kirim Template Tolak
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <span class="material-symbols-outlined !text-[48px] text-gray-200 block mb-2">inbox</span>
                            Belum ada permohonan barang donasi masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $requests->links() }}
        </div>
        @endif
    </div>

    {{-- Material Icons Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:FILL,GRAD,opsz,wght@0,0,24,400" />
</x-app-layout>
