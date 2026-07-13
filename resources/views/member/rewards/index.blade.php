<x-member-layout>
    <x-slot name="header">Rewards</x-slot>

    {{-- Donation Claim Banner --}}
    @if($unclaimedDonationCount > 0)
    <div class="mb-6 p-6 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500 text-white shadow-lg flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="text-lg font-bold flex items-center gap-2"><span class="material-symbols-outlined">volunteer_activism</span> Kesempatan Klaim Reward Donasi!</h2>
            <p class="text-sm text-amber-100 mt-1">Terima kasih orang baik! Kamu memiliki <strong>{{ $unclaimedDonationCount }}</strong> kesempatan klaim reward dari donasi sepatumu.</p>
        </div>
    </div>
    @endif

    {{-- Streak Status Banner --}}
    <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 text-white shadow-lg">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-lg font-bold">Streak Minggu {{ $streakStatus['minggu_ke'] }}</h2>
                <p class="text-sm text-emerald-100 mt-1">Progress: {{ $streakStatus['hari_ke'] }}/7 hari check-in berturut-turut</p>
            </div>
            <div class="flex items-center gap-1">
                @for($i = 1; $i <= 7; $i++)
                    @php $done = $streakStatus['checkins']->where('hari_ke', $i)->where('status', 'approved')->count() > 0; @endphp
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ $done ? 'bg-white text-emerald-600' : 'bg-white/20 text-white/70' }}">
                        @if($done) ✓ @else {{ $i }} @endif
                    </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- Donation Rewards --}}
    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-amber-500">volunteer_activism</span> Reward Eksklusif Donatur</h3>
    @if($donasiRewards->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center mb-8">
            <p class="text-sm text-gray-500">Belum ada reward khusus donasi saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($donasiRewards as $reward)
            @php
                $canClaimThis = $unclaimedDonationCount > 0;
                $jenisColors = ['voucher'=>'from-violet-500 to-purple-600','diskon'=>'from-blue-500 to-indigo-600','konsultasi'=>'from-amber-500 to-orange-600','lainnya'=>'from-pink-500 to-rose-600'];
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                <div class="h-2 bg-gradient-to-r {{ $jenisColors[$reward->jenis] ?? 'from-gray-500 to-gray-600' }}"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gradient-to-r {{ $jenisColors[$reward->jenis] ?? 'from-gray-500 to-gray-600' }} text-white uppercase">{{ $reward->jenis }}</span>
                            <h4 class="text-base font-bold text-gray-900 mt-2">{{ $reward->nama_reward }}</h4>
                        </div>
                        @if($reward->nilai)
                        <span class="text-lg font-extrabold text-amber-600">{{ $reward->nilai }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $reward->deskripsi }}</p>

                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                        <span class="flex items-center gap-1 font-bold text-amber-600">
                            Syarat: 1 Sepatu Donasi
                        </span>
                        @if($reward->stok !== null)
                        <span class="flex items-center gap-1">
                            Stok: {{ $reward->stok }}
                        </span>
                        @endif
                    </div>

                    @if($canClaimThis)
                        <form action="{{ route('member.rewards.claim-donation') }}" method="POST" onsubmit="confirmAction(event, this, 'Yakin ingin menukarkan 1 kesempatan donasimu dengan reward ini?')">
                            @csrf
                            <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                            <button type="submit" class="w-full py-2.5 bg-amber-500 text-white text-xs font-bold rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-500/25">
                                🎁 Klaim Reward Ini
                            </button>
                        </form>
                    @else
                        <div class="w-full py-2.5 bg-gray-50 text-gray-400 text-xs font-bold rounded-xl text-center border border-dashed border-gray-200">
                            🔒 Butuh 1 Donasi Tersetujui
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- Daily Rewards --}}
    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-emerald-500">today</span> Reward Check-in Harian</h3>
    @if($dailyRewards->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center mb-8">
            <p class="text-sm text-gray-500">Belum ada reward check-in harian saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($dailyRewards as $reward)
            @php
                $completedDaysThisWeek = \App\Models\DailyLogin::where('user_id', Auth::id())
                    ->where('minggu_ke', $reward->minggu_ke)
                    ->where('status', 'approved')
                    ->count();
                $hasCompletedThisWeek = $completedDaysThisWeek >= 7;
                $alreadyClaimed = $claimedRewards->where('reward_id', $reward->id)->where('minggu_ke', $reward->minggu_ke)->isNotEmpty();
                $canClaimThis = $hasCompletedThisWeek && !$alreadyClaimed;
                $jenisColors = ['voucher'=>'from-violet-500 to-purple-600','diskon'=>'from-blue-500 to-indigo-600','konsultasi'=>'from-amber-500 to-orange-600','lainnya'=>'from-pink-500 to-rose-600'];
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                <div class="h-2 bg-gradient-to-r {{ $jenisColors[$reward->jenis] ?? 'from-gray-500 to-gray-600' }}"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gradient-to-r {{ $jenisColors[$reward->jenis] ?? 'from-gray-500 to-gray-600' }} text-white uppercase">{{ $reward->jenis }}</span>
                            <h4 class="text-base font-bold text-gray-900 mt-2">{{ $reward->nama_reward }}</h4>
                        </div>
                        @if($reward->nilai)
                        <span class="text-lg font-extrabold text-emerald-600">{{ $reward->nilai }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $reward->deskripsi }}</p>

                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                        <span class="flex items-center gap-1 font-bold">
                            Minggu {{ $reward->minggu_ke }}
                        </span>
                        @if($reward->stok !== null)
                        <span class="flex items-center gap-1">Stok: {{ $reward->stok }}</span>
                        @endif
                    </div>

                    @if($alreadyClaimed)
                        <div class="w-full py-2.5 bg-gray-100 text-gray-500 text-xs font-bold rounded-xl text-center">✅ Sudah Diklaim</div>
                    @elseif($canClaimThis)
                        <form action="{{ route('member.rewards.claim') }}" method="POST" onsubmit="confirmAction(event, this, 'Yakin ingin mengklaim reward ini?')">
                            @csrf
                            <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                            <input type="hidden" name="minggu_ke" value="{{ $reward->minggu_ke }}">
                            <button type="submit" class="w-full py-2.5 bg-emerald-500 text-white text-xs font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">
                                🎁 Klaim Reward
                            </button>
                        </form>
                    @else
                        <div class="w-full py-2.5 bg-gray-50 text-gray-400 text-xs font-bold rounded-xl text-center border border-dashed border-gray-200">
                            🔒 Selesaikan streak minggu {{ $reward->minggu_ke }}
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- Claimed Rewards History --}}
    @if($claimedRewards->isNotEmpty())
    <div class="mt-8">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Klaim Reward</h3>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                        <th class="px-6 py-4">Reward</th>
                        <th class="px-6 py-4">Minggu</th>
                        <th class="px-6 py-4">Kode Unik</th>
                        <th class="px-6 py-4">Tanggal Klaim</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($claimedRewards as $claim)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $claim->reward->nama_reward }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            @if($claim->reward->kategori_reward === 'donasi')
                                <span class="text-xs font-bold text-amber-600">Donasi</span>
                            @else
                                <span class="text-xs">Minggu {{ $claim->minggu_ke }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg text-sm">{{ $claim->unique_code }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $claim->claimed_at->format('d M Y, H:i') }} WIB</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</x-member-layout>
