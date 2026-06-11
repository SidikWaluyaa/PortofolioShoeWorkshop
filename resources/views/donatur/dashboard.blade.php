<x-donatur-layout>
    <x-slot name="header">Dashboard Donatur</x-slot>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Donasi --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $totalDonations }}</p>
                    <p class="text-xs text-gray-500 font-medium">Total Donasi</p>
                </div>
            </div>
        </div>

        {{-- Diterima --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $acceptedDonations }}</p>
                    <p class="text-xs text-gray-500 font-medium">Diterima</p>
                </div>
            </div>
        </div>

        {{-- Disalurkan --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $distributedDonations }}</p>
                    <p class="text-xs text-gray-500 font-medium">Disalurkan</p>
                </div>
            </div>
        </div>

        {{-- Streak Status --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-gray-900">{{ $streakStatus['hari_ke'] }}/7</p>
                    <p class="text-xs text-gray-500 font-medium">Streak Minggu {{ $streakStatus['minggu_ke'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Check-In Streak Visual --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900">Streak Check-In Minggu {{ $streakStatus['minggu_ke'] }}</h2>
                <a href="{{ route('donatur.checkin.index') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">Lihat Semua →</a>
            </div>
            <div class="flex items-center justify-between gap-2 overflow-x-auto pb-3 scrollbar-thin">
                @for($i = 1; $i <= 7; $i++)
                    @php
                        $checkin = $streakStatus['checkins']->firstWhere('hari_ke', $i);
                        $status = $checkin ? $checkin->status : 'empty';
                        $dayLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    @endphp
                    <div class="flex flex-col items-center gap-2 flex-shrink-0 min-w-[3.5rem]">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center text-sm font-bold transition-all flex-shrink-0
                            {{ $status === 'approved' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : '' }}
                            {{ $status === 'pending' ? 'bg-amber-100 text-amber-600 border-2 border-amber-300' : '' }}
                            {{ $status === 'rejected' ? 'bg-red-100 text-red-500 border-2 border-red-300' : '' }}
                            {{ $status === 'empty' ? 'bg-gray-100 text-gray-400 border-2 border-dashed border-gray-300' : '' }}
                        ">
                            @if($status === 'approved')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @elseif($status === 'pending')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif($status === 'rejected')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            @else
                                {{ $i }}
                            @endif
                        </div>
                        <span class="text-xs font-medium text-gray-500">{{ $dayLabels[$i - 1] }}</span>
                    </div>
                @endfor
            </div>
            @if($streakStatus['streak_complete'] && $streakStatus['can_claim'])
                <div class="mt-6 p-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-center">
                    <p class="font-bold text-sm">🎉 Streak 7 hari tercapai! Klaim reward Anda sekarang!</p>
                    <a href="{{ route('donatur.rewards.index') }}" class="inline-block mt-2 px-4 py-2 bg-white text-emerald-600 font-bold text-xs rounded-lg hover:bg-gray-50 transition">Klaim Reward →</a>
                </div>
            @endif
        </div>

        {{-- Kode Kupon Aktif --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Kode Kupon Saya</h2>
            @if($claimedRewards->isEmpty())
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    </div>
                    <p class="text-sm text-gray-500">Belum ada kupon. Selesaikan streak untuk mendapatkan reward!</p>
                </div>
            @else
                <div class="space-y-3 max-h-80 overflow-y-auto">
                    @foreach($claimedRewards as $claim)
                    <div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-emerald-50 border border-emerald-100">
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $claim->reward->nama_reward }}</p>
                            <p class="text-xs text-gray-500">Minggu {{ $claim->minggu_ke }} • {{ $claim->claimed_at->format('d M Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-mono font-bold text-emerald-600 bg-emerald-100 px-3 py-1 rounded-lg">{{ $claim->unique_code }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Recent Donations --}}
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-gray-900">Donasi Terbaru</h2>
            <a href="{{ route('donatur.donations.index') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">Lihat Semua →</a>
        </div>
        @if($donations->isEmpty())
            <div class="text-center py-8">
                <p class="text-sm text-gray-500">Belum ada donasi. Mulai donasikan sepatu Anda!</p>
                <a href="{{ route('donatur.donations.create') }}" class="inline-block mt-3 px-4 py-2 bg-emerald-500 text-white font-bold text-xs rounded-lg hover:bg-emerald-600 transition">+ Donasi Sepatu</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                            <th class="pb-3 pr-4">Sepatu</th>
                            <th class="pb-3 pr-4">Ukuran</th>
                            <th class="pb-3 pr-4">Kondisi</th>
                            <th class="pb-3 pr-4">Metode</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($donations as $donation)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 pr-4 font-medium text-gray-900">{{ $donation->nama_sepatu }}</td>
                            <td class="py-3 pr-4 text-gray-600">{{ $donation->ukuran }}</td>
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-16 h-2 rounded-full bg-gray-200 overflow-hidden">
                                        <div class="h-full rounded-full {{ $donation->kondisi >= 70 ? 'bg-emerald-500' : ($donation->kondisi >= 40 ? 'bg-amber-500' : 'bg-red-500') }}" style="width: {{ $donation->kondisi }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium text-gray-500">{{ $donation->kondisi }}%</span>
                                </div>
                            </td>
                            <td class="py-3 pr-4 text-gray-600 capitalize">{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</td>
                            <td class="py-3">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'diterima' => 'bg-emerald-100 text-emerald-700',
                                        'disalurkan' => 'bg-blue-100 text-blue-700',
                                        'ditolak' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $statusColors[$donation->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-donatur-layout>
