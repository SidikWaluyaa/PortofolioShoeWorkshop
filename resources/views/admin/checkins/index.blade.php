<x-app-layout>
    <x-slot name="header">Verifikasi Check-In</x-slot>

    <div x-data="{
        showModal: false,
        activeUser: { name: '', email: '' },
        activeStreak: [],
        activeWeek: 1,
        activeStatus: 'pending',
        approveUrl: '',
        rejectUrl: '',
        lightboxUrl: '',
        showLightbox: false,
        openModal(user, streak, week, status, approveUrl, rejectUrl) {
            this.activeUser = user;
            this.activeStreak = streak;
            this.activeWeek = week;
            this.activeStatus = status;
            this.approveUrl = approveUrl;
            this.rejectUrl = rejectUrl;
            this.showModal = true;
        }
    }" class="relative">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            {{-- Status Filter --}}
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('admin.checkins.index', ['status' => null, 'hari' => $hariFilter]) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ !$statusFilter ? 'bg-[#22AF85] text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">Semua Status</a>
                @foreach(['pending', 'approved', 'rejected'] as $s)
                <a href="{{ route('admin.checkins.index', ['status' => $s, 'hari' => $hariFilter]) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition {{ $statusFilter === $s ? 'bg-[#22AF85] text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">{{ ucfirst($s) }}</a>
                @endforeach
            </div>

            {{-- Day Filter --}}
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-xs font-bold text-gray-500 mr-1">Filter Hari:</span>
                <a href="{{ route('admin.checkins.index', ['status' => $statusFilter, 'hari' => 'all']) }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ !$hariFilter || $hariFilter === 'all' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">Semua Hari</a>
                @for($h = 1; $h <= 7; $h++)
                <a href="{{ route('admin.checkins.index', ['status' => $statusFilter, 'hari' => $h]) }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ (string)$hariFilter === (string)$h ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">Hari {{ $h }}</a>
                @endfor
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium shadow-sm transition duration-150">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50">
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4 text-center">Hari</th>
                            <th class="px-6 py-4 text-center">Minggu Streak</th>
                            <th class="px-6 py-4">Tanggal Check-In</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($checkins as $checkin)
                        @php
                            $streakData = [];
                            $existingStreak = $checkin->streak_checkins->keyBy('hari_ke');
                            for ($h = 1; $h <= 7; $h++) {
                                if (isset($existingStreak[$h])) {
                                    $sc = $existingStreak[$h];
                                    $streakData[] = [
                                        'hari_ke' => $h,
                                        'tanggal' => $sc->tanggal_checkin->format('d M Y'),
                                        'foto_url' => asset('storage/' . $sc->foto_sepatu_path),
                                        'status' => $sc->status,
                                        'exists' => true,
                                    ];
                                } else {
                                    $streakData[] = [
                                        'hari_ke' => $h,
                                        'tanggal' => '-',
                                        'foto_url' => null,
                                        'status' => 'belum_checkin',
                                        'exists' => false,
                                    ];
                                }
                            }
                            $userData = [
                                'name' => $checkin->user->name,
                                'email' => $checkin->user->email,
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $checkin->user->name }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $checkin->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-xl bg-indigo-50 text-indigo-700 text-xs font-bold">Hari {{ $checkin->hari_ke }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-gray-700">Minggu {{ $checkin->minggu_ke }}</td>
                            <td class="px-6 py-4 text-gray-600 font-medium">{{ $checkin->tanggal_checkin->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @php $scStatus = ['pending'=>'bg-amber-100 text-amber-700','approved'=>'bg-emerald-100 text-emerald-700','rejected'=>'bg-red-100 text-red-700']; @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $scStatus[$checkin->status] }}">{{ ucfirst($checkin->status) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <button @click="openModal({{ json_encode($userData) }}, {{ json_encode($streakData) }}, {{ $checkin->minggu_ke }}, '{{ $checkin->status }}', '{{ route('admin.checkins.approve', $checkin) }}', '{{ route('admin.checkins.reject', $checkin) }}')" class="px-3.5 py-2 bg-indigo-600 text-white text-xs font-bold rounded-xl hover:bg-indigo-700 active:bg-indigo-800 transition duration-150 shadow-sm shadow-indigo-100 hover:shadow-md flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Tinjau Streak
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                <p class="text-sm font-medium">Tidak ada data check-in.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $checkins->appends(['status' => $statusFilter, 'hari' => $hariFilter])->links() }}
            </div>
        </div>

        {{-- Streak Review Modal --}}
        <div x-show="showModal" 
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;"
             x-keydown.escape.window="showModal = false">
            
            {{-- Backdrop blur overlay --}}
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-md transition-opacity"
                 @click="showModal = false"></div>

            {{-- Modal container --}}
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-4xl lg:max-w-7xl border border-gray-100 flex flex-col max-h-[90vh]">
                    
                    {{-- Modal Header --}}
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 flex-shrink-0">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <span>Tinjau Streak Check-In</span>
                                <span class="text-sm font-semibold bg-indigo-50 text-indigo-700 px-2.5 py-0.5 rounded-md">Minggu <span x-text="activeWeek"></span></span>
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">
                                User: <span class="font-semibold text-gray-700" x-text="activeUser.name"></span> 
                                (<span class="text-gray-600" x-text="activeUser.email"></span>)
                            </p>
                        </div>
                        <button @click="showModal = false" class="rounded-xl p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="px-6 py-6 overflow-y-auto flex-1 bg-gray-50/30">
                        {{-- Instructions & Alert --}}
                        <div class="mb-6 bg-blue-50 border border-blue-100 rounded-2xl p-4 flex gap-3 text-sm text-blue-700">
                            <svg class="w-5 h-5 flex-shrink-0 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <span class="font-bold block mb-0.5">Sistem Verifikasi Otomatis (H1 - H6)</span>
                                Hari 1-6 disetujui otomatis oleh sistem untuk efisiensi admin. Peninjauan manual hanya dilakukan pada foto Hari 7. Menyetujui Hari ke-7 akan menyetujui seluruh rangkaian streak minggu ini, sedangkan menolaknya akan menandai seluruh streak sebagai ditolak.
                            </div>
                        </div>

                        {{-- 7-Day Grid --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-4">
                            <template x-for="day in activeStreak" :key="day.hari_ke">
                                <div class="bg-white rounded-2xl border transition-all duration-200 overflow-hidden flex flex-col shadow-sm"
                                     :class="{
                                         'border-amber-300 ring-2 ring-amber-300/30': day.hari_ke === 7 && day.exists,
                                         'border-gray-200 hover:border-gray-300': day.exists && day.hari_ke !== 7,
                                         'border-dashed border-gray-300 bg-gray-50/50': !day.exists
                                     }">
                                    
                                    {{-- Day Header Badge --}}
                                    <div class="px-3 py-2 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                                        <span class="text-xs font-black text-gray-700" x-text="'HARI ' + day.hari_ke"></span>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full"
                                              :class="{
                                                  'bg-emerald-100 text-emerald-700': day.status === 'approved',
                                                  'bg-amber-100 text-amber-700': day.status === 'pending',
                                                  'bg-red-100 text-red-700': day.status === 'rejected',
                                                  'bg-gray-100 text-gray-400': day.status === 'belum_checkin'
                                              }"
                                              x-text="day.status.toUpperCase()">
                                        </span>
                                    </div>

                                    {{-- Image Card / Placeholder --}}
                                    <div class="relative aspect-square overflow-hidden flex flex-col items-center justify-center"
                                         :class="day.exists ? 'bg-gray-100 cursor-zoom-in group' : 'bg-gray-50/30'"
                                         @click="day.exists ? (lightboxUrl = day.foto_url, showLightbox = true) : null">
                                        
                                        <template x-if="day.exists">
                                            <div class="w-full h-full">
                                                <img :src="day.foto_url" :alt="'Hari ' + day.hari_ke" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                                </div>
                                            </div>
                                        </template>

                                        <template x-if="!day.exists">
                                            <div class="text-center p-4">
                                                <svg class="w-8 h-8 text-gray-300 mx-auto mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Belum</span>
                                            </div>
                                        </template>
                                    </div>

                                    {{-- Card Footer --}}
                                    <div class="p-3 bg-white text-center border-t border-gray-100 flex-1 flex flex-col justify-end">
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Tanggal Check-In</div>
                                        <div class="text-xs text-gray-700 font-bold mt-0.5" x-text="day.tanggal"></div>
                                    </div>

                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between bg-gray-50/50 flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500 font-semibold">Status Streak Saat Ini:</span>
                            <span class="text-xs font-black px-2.5 py-0.5 rounded-full"
                                  :class="{
                                      'bg-emerald-100 text-emerald-700': activeStatus === 'approved',
                                      'bg-amber-100 text-amber-700': activeStatus === 'pending',
                                      'bg-red-100 text-red-700': activeStatus === 'rejected'
                                  }"
                                  x-text="activeStatus.toUpperCase()">
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button @click="showModal = false" class="px-4 py-2 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-100 transition-colors">
                                Tutup
                            </button>
                            
                            <template x-if="activeStatus === 'pending'">
                                <div class="flex items-center gap-2">
                                    <form :action="rejectUrl" method="POST" class="inline" onsubmit="return confirm('Tolak check-in ini? Seluruh streak di minggu ini akan ditolak.')">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-xl transition duration-150 shadow-sm hover:shadow-md flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Tolak Streak
                                        </button>
                                    </form>

                                    <form :action="approveUrl" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl transition duration-150 shadow-sm hover:shadow-md flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            Setujui Streak
                                        </button>
                                    </form>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Lightbox Overlay (Separate modal layer) --}}
        <div x-show="showLightbox"
             class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm"
             style="display: none;"
             x-keydown.escape.window="showLightbox = false"
             @click="showLightbox = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <button class="absolute top-4 right-4 text-white hover:text-gray-300 p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <img :src="lightboxUrl" class="max-w-full max-h-[90vh] object-contain rounded-2xl shadow-2xl" @click.stop>
        </div>

    </div>
</x-app-layout>
