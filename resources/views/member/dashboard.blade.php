<x-member-layout>
    <x-slot name="header">Halo, {{ \Illuminate\Support\Str::of($user->name)->before(' ') }}!</x-slot>

    @php
        $tones = [
            'amber'   => 'bg-amber-50 text-amber-600',
            'red'     => 'bg-red-50 text-red-600',
            'emerald' => 'bg-emerald-50 text-emerald-600',
            'blue'    => 'bg-blue-50 text-blue-600',
        ];
        $adoptionLabels = [
            'pending' => 'Sedang dikurasi',
            'menunggu_pembayaran' => 'Menunggu pembayaran',
            'menunggu_verifikasi' => 'Pembayaran dicek admin',
            'diproses' => 'Sedang disiapkan',
            'dikirim' => 'Dalam pengiriman',
            'selesai' => 'Selesai',
            'ditolak' => 'Tidak dilanjutkan',
            'dibatalkan' => 'Dibatalkan',
        ];
        $donationLabels = [
            'pending' => 'Sedang ditinjau',
            'disetujui' => 'Disetujui, kirim sepatumu',
            'diterima' => 'Diterima, sedang direstorasi',
            'siap_rilis' => 'Restorasi selesai',
            'masuk_katalog' => 'Sudah di Katalog Adopsi',
            'disalurkan' => 'Sudah punya pemilik baru',
            'ditolak' => 'Belum bisa diterima',
        ];
    @endphp

    <p class="-mt-2 mb-6 text-sm text-gray-500">Semua urusan sepatumu di Shoe Workshop: reparasi, adopsi, dan donasi.</p>

    {{-- What needs the member's action --}}
    <section class="bg-white rounded-3xl border border-gray-100 shadow-sm p-5 sm:p-6 mb-6">
        <h2 class="text-base font-black text-gray-900">Perlu tindakanmu</h2>

        @if($tasks->isEmpty())
            <div class="mt-4 flex items-center gap-3 rounded-2xl bg-emerald-50 border border-emerald-100 p-4">
                <span class="w-9 h-9 rounded-full bg-white text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined !text-[20px]">task_alt</span>
                </span>
                <p class="text-sm text-emerald-900"><span class="font-bold">Semua beres.</span> Tidak ada yang perlu kamu lakukan saat ini.</p>
            </div>
        @else
            <ul class="mt-4 divide-y divide-gray-100">
                @foreach($tasks as $task)
                    <li>
                        <a href="{{ $task['url'] }}" class="flex items-center gap-3 py-3 group">
                            <span class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $tones[$task['tone']] }}">
                                <span class="material-symbols-outlined !text-[20px]">{{ $task['icon'] }}</span>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-gray-900 group-hover:text-[#22AF85] transition-colors">{{ $task['title'] }}</span>
                                <span class="block text-xs text-gray-500 mt-0.5">{{ $task['desc'] }}</span>
                            </span>
                            <span class="hidden sm:inline-flex items-center gap-1 text-xs font-bold text-[#22AF85] flex-shrink-0">
                                {{ $task['cta'] }} <span class="material-symbols-outlined !text-[16px]">arrow_forward</span>
                            </span>
                            {{-- The icon font sets its own display, so hide a wrapper instead --}}
                            <span class="sm:hidden flex-shrink-0"><span class="material-symbols-outlined text-gray-300">chevron_right</span></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    {{-- Adapt & Adopt: the campaign ShoeWorkshop currently puts first --}}
    <section class="rounded-3xl bg-aa-green text-aa-beige p-5 sm:p-7 mb-6 overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center gap-5">
            <img src="{{ asset('images/adapt-adopt/adaptadopt_dark_beige_on_green.png') }}" alt="Adapt & Adopt by ShoeWorkshop" width="820" height="500" class="w-36 sm:w-44 flex-shrink-0">
            <div class="min-w-0 flex-1">
                <p class="text-[11px] font-bold tracking-[0.2em] uppercase text-aa-sage">by ShoeWorkshop</p>
                <h2 class="mt-1 font-aa text-2xl sm:text-3xl font-extrabold leading-tight">Adapt the Mindset. Give a Second Chance.</h2>
                <p class="mt-2 text-sm text-aa-beige/85 leading-relaxed">Donasikan sepatu yang sudah nggak kamu pakai, atau adopsi sepatu hasil restorasi dengan membayar biaya jasa reparasinya saja.</p>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Adoptions --}}
            <a href="{{ $latestAdoption ? route('member.adoption-requests.index') : route('katalog.index') }}" class="group rounded-2xl bg-aa-beige text-aa-ink p-5 flex flex-col hover:bg-[#f8e3cf] transition">
                <span class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-aa-green text-aa-beige flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined !text-[20px]">footprint</span>
                    </span>
                    <span class="font-aa text-lg font-extrabold text-aa-green">Adopsi</span>
                </span>
                <span class="mt-3 text-sm text-aa-ink/80 flex-1">
                    @if($latestAdoption)
                        <span class="font-bold text-aa-ink">{{ $latestAdoption->donationItem?->nama ?? 'Sepatu adopsi' }}</span>: {{ $adoptionLabels[$latestAdoption->status] ?? $latestAdoption->status }}.
                    @else
                        Belum ada pengajuan. Lihat sepatu hasil restorasi yang menunggu pemilik baru.
                    @endif
                </span>
                <span class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-aa-burgundy">{{ $latestAdoption ? 'Adopsi Saya' : 'Lihat Katalog Adopsi' }} <span class="material-symbols-outlined !text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span></span>
            </a>

            {{-- Donations --}}
            <a href="{{ $latestDonation ? route('member.donations.index') : route('member.donations.create') }}" class="group rounded-2xl bg-aa-beige text-aa-ink p-5 flex flex-col hover:bg-[#f8e3cf] transition">
                <span class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-xl bg-aa-green text-aa-beige flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined !text-[20px]">volunteer_activism</span>
                    </span>
                    <span class="font-aa text-lg font-extrabold text-aa-green">Donasi</span>
                </span>
                <span class="mt-3 text-sm text-aa-ink/80 flex-1">
                    @if($latestDonation)
                        <span class="font-bold text-aa-ink">{{ $latestDonation->nama_sepatu }}</span>: {{ $donationLabels[$latestDonation->status] ?? $latestDonation->status }}.
                    @else
                        Punya sepatu layak pakai yang sudah nggak kamu pakai? Donasikan untuk kami kurasi dan perbaiki.
                    @endif
                </span>
                <span class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-aa-burgundy">{{ $latestDonation ? 'Donasi Saya' : 'Donasikan Sepatu' }} <span class="material-symbols-outlined !text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span></span>
            </a>
        </div>

        <a href="{{ route('adapt-adopt.index') }}" class="mt-5 inline-flex items-center gap-1 text-sm font-bold text-aa-beige hover:underline underline-offset-4">
            Tentang Adapt &amp; Adopt <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
        </a>
    </section>

    {{-- Repairs --}}
    <a href="{{ route('member.reparation-history.index') }}" class="group bg-white rounded-3xl border border-gray-100 shadow-sm p-5 sm:p-6 flex items-center gap-4 hover:shadow-md transition">
        <span class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
            <span class="material-symbols-outlined">build</span>
        </span>
        <span class="min-w-0 flex-1">
            <span class="block text-sm font-black text-gray-900">Reparasi</span>
            <span class="block mt-0.5 text-sm text-gray-500">
                @if($reparationSummary)
                    @if($reparationSummary['total'] === 0)
                        Belum ada riwayat reparasi dengan nomor HP-mu.
                    @else
                        <span class="font-bold text-gray-900">{{ $reparationSummary['in_progress'] }}</span> sedang dikerjakan dari {{ $reparationSummary['total'] }} SPK.
                    @endif
                @elseif($reparation['status'] === 'missing_phone')
                    Tambahkan nomor HP di profil untuk melihat riwayat reparasimu.
                @else
                    Data reparasi belum bisa dimuat. Coba lagi nanti.
                @endif
            </span>
        </span>
        <span class="hidden sm:inline-flex items-center gap-1 text-xs font-bold text-[#22AF85] flex-shrink-0">Riwayat Reparasi <span class="material-symbols-outlined !text-[16px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span></span>
    </a>

    {{-- Only while Daily Check-In is switched on --}}
    @if($streakStatus)
        <a href="{{ route('member.checkin.index') }}" class="mt-6 flex items-center gap-4 bg-white rounded-3xl border border-gray-100 shadow-sm p-5 sm:p-6 hover:shadow-md transition">
            <span class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined">local_fire_department</span>
            </span>
            <span class="flex-1">
                <span class="block text-sm font-black text-gray-900">Streak Check-In Minggu {{ $streakStatus['minggu_ke'] }}: {{ $streakStatus['hari_ke'] }}/7 hari</span>
                <span class="block text-xs text-gray-500 mt-0.5">Unggah foto sepatumu hari ini untuk melanjutkan streak.</span>
            </span>
            <span class="material-symbols-outlined text-gray-300">chevron_right</span>
        </a>
    @endif
</x-member-layout>
