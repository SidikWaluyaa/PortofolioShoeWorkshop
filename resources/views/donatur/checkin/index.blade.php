<x-donatur-layout>
    <x-slot name="header">Daily Check-In</x-slot>

    {{-- Streak Visual --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 mb-8">
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">Streak Minggu {{ $streakStatus['minggu_ke'] }}</h2>
            <p class="text-sm text-gray-500 mt-1">Unggah foto sepatu setiap hari selama 7 hari berturut-turut untuk mendapatkan reward!</p>
        </div>

        {{-- Day circles --}}
        <div class="flex items-center justify-start sm:justify-center gap-3 sm:gap-5 mb-8 overflow-x-auto pb-3 scrollbar-thin">
            @for($i = 1; $i <= 7; $i++)
                @php
                    $checkin = $streakStatus['checkins']->firstWhere('hari_ke', $i);
                    $status = $checkin ? $checkin->status : 'empty';
                    $dayLabels = ['Hari 1', 'Hari 2', 'Hari 3', 'Hari 4', 'Hari 5', 'Hari 6', 'Hari 7'];
                @endphp
                <div class="flex flex-col items-center gap-2 flex-shrink-0 min-w-[4.5rem]">
                    <div class="relative w-12 h-12 sm:w-14 sm:h-14 rounded-full flex items-center justify-center text-sm font-bold transition-all flex-shrink-0
                        {{ $status === 'approved' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30 ring-4 ring-emerald-100' : '' }}
                        {{ $status === 'pending' ? 'bg-amber-100 text-amber-600 border-2 border-amber-300 animate-pulse' : '' }}
                        {{ $status === 'rejected' ? 'bg-red-100 text-red-500 border-2 border-red-300' : '' }}
                        {{ $status === 'empty' ? 'bg-gray-100 text-gray-400 border-2 border-dashed border-gray-300' : '' }}
                    ">
                        @if($status === 'approved')
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @elseif($status === 'pending')
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($status === 'rejected')
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        @else
                            {{ $i }}
                        @endif
                    </div>
                    <span class="text-xs font-medium {{ $status !== 'empty' ? 'text-gray-700' : 'text-gray-400' }}">{{ $dayLabels[$i - 1] }}</span>
                    @if($status === 'pending')
                        <span class="text-[10px] font-bold text-amber-600">Menunggu</span>
                    @elseif($status === 'approved')
                        <span class="text-[10px] font-bold text-emerald-600">Disetujui</span>
                    @elseif($status === 'rejected')
                        <span class="text-[10px] font-bold text-red-500">Ditolak</span>
                    @endif
                </div>

                @if($i < 7)
                    <div class="hidden sm:block w-8 h-0.5 {{ ($streakStatus['checkins']->where('hari_ke', '<=', $i)->where('status', 'approved')->count() >= $i) ? 'bg-emerald-400' : 'bg-gray-200' }} rounded-full mt-[-20px]"></div>
                @endif
            @endfor
        </div>

        @if($streakStatus['streak_complete'] && $streakStatus['can_claim'])
            <div class="p-5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-center">
                <p class="font-bold">🎉 Selamat! Streak 7 hari tercapai!</p>
                <p class="text-sm mt-1 text-emerald-100">Semua check-in telah disetujui admin. Klaim reward Anda sekarang!</p>
                <a href="{{ route('donatur.rewards.index') }}" class="inline-block mt-3 px-6 py-2.5 bg-white text-emerald-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition">🎁 Klaim Reward</a>
            </div>
        @endif
    </div>

    {{-- Check-in Form --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Check-In Hari Ini</h3>

        @if($streakStatus['already_checked_in_today'])
            <div class="p-6 rounded-xl bg-emerald-50 border border-emerald-200 text-center">
                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="font-bold text-emerald-700">Anda sudah check-in hari ini!</p>
                <p class="text-sm text-emerald-600 mt-1">Kembali besok untuk melanjutkan streak Anda. 💪</p>
            </div>
        @else
            <form action="{{ route('donatur.checkin.store') }}" method="POST" enctype="multipart/form-data" x-data="{ preview: null }">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Sepatu Hari Ini <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-emerald-400 transition cursor-pointer relative" onclick="document.getElementById('foto_sepatu').click()">
                        <template x-if="!preview">
                            <div>
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="text-sm font-medium text-gray-600">Klik untuk foto sepatu yang Anda pakai hari ini</p>
                                <p class="text-xs text-gray-400 mt-1">Foto akan dikompresi otomatis</p>
                            </div>
                        </template>
                        <template x-if="preview">
                            <img :src="preview" class="max-h-48 mx-auto rounded-lg">
                        </template>
                    </div>
                    <input type="file" name="foto_sepatu" id="foto_sepatu" accept="image/*" class="hidden" required
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                    @error('foto_sepatu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">
                    📸 Check-In Sekarang
                </button>
            </form>
        @endif
    </div>

    {{-- Check-in History --}}
    @if($streakStatus['checkins']->isNotEmpty())
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Check-In Minggu Ini</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-4">
            @foreach($streakStatus['checkins'] as $checkin)
            <div class="rounded-xl border {{ $checkin->status === 'approved' ? 'border-emerald-200 bg-emerald-50' : ($checkin->status === 'rejected' ? 'border-red-200 bg-red-50' : 'border-amber-200 bg-amber-50') }} p-3 text-center">
                <img src="{{ asset('storage/' . $checkin->foto_sepatu_path) }}" alt="Day {{ $checkin->hari_ke }}" class="w-full h-20 object-cover rounded-lg mb-2 bg-gray-100">
                <p class="text-xs font-bold text-gray-700">Hari {{ $checkin->hari_ke }}</p>
                <p class="text-[10px] text-gray-500">{{ $checkin->tanggal_checkin->format('d M') }}</p>
                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold
                    {{ $checkin->status === 'approved' ? 'bg-emerald-200 text-emerald-700' : ($checkin->status === 'rejected' ? 'bg-red-200 text-red-700' : 'bg-amber-200 text-amber-700') }}">
                    {{ ucfirst($checkin->status) }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</x-donatur-layout>
