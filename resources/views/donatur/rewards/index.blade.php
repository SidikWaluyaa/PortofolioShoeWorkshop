<x-donatur-layout>
    <x-slot name="header">Rewards</x-slot>

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

    {{-- Available Rewards --}}
    <h3 class="text-lg font-bold text-gray-900 mb-4">Reward Tersedia</h3>
    @if($rewards->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-sm text-gray-500">Belum ada reward yang tersedia saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($rewards as $reward)
            @php
                $canClaimThis = $streakStatus['can_claim'] && $reward->minggu_ke == $streakStatus['minggu_ke'];
                $alreadyClaimed = $claimedRewards->where('reward_id', $reward->id)->where('minggu_ke', $streakStatus['minggu_ke'])->isNotEmpty();
                $jenisColors = [
                    'voucher' => 'from-violet-500 to-purple-600',
                    'diskon' => 'from-blue-500 to-indigo-600',
                    'konsultasi' => 'from-amber-500 to-orange-600',
                    'lainnya' => 'from-pink-500 to-rose-600',
                ];
            @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                {{-- Header gradient --}}
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
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/></svg>
                            Minggu {{ $reward->minggu_ke }}
                        </span>
                        @if($reward->stok !== null)
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            Stok: {{ $reward->stok }}
                        </span>
                        @endif
                        @if($reward->berlaku_sampai)
                        <span>s/d {{ $reward->berlaku_sampai->format('d M Y') }}</span>
                        @endif
                    </div>

                    @if($alreadyClaimed)
                        <div class="w-full py-2.5 bg-gray-100 text-gray-500 text-xs font-bold rounded-xl text-center">✅ Sudah Diklaim</div>
                    @elseif($canClaimThis)
                        <form action="{{ route('donatur.rewards.claim') }}" method="POST" onsubmit="return confirm('Yakin ingin mengklaim reward ini?')">
                            @csrf
                            <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                            <input type="hidden" name="minggu_ke" value="{{ $streakStatus['minggu_ke'] }}">
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
                        <td class="px-6 py-4 text-gray-600">Minggu {{ $claim->minggu_ke }}</td>
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg text-sm">{{ $claim->unique_code }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $claim->claimed_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</x-donatur-layout>
