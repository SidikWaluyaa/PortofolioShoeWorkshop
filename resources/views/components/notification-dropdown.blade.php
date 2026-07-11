@props(['align' => 'right'])

<div class="relative" x-data="{ openNotif: false }">
    <button @click="openNotif = !openNotif" @click.outside="openNotif = false"
            class="relative inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 text-gray-500 hover:text-[#22AF85] hover:bg-[#22AF85]/10 transition-colors focus:outline-none">
        <span class="material-symbols-outlined !text-[22px]">notifications</span>
        
        @php $unreadCount = Auth::user()->unreadNotifications->count(); @endphp
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 flex items-center justify-center min-w-[16px] h-[16px] px-1 text-[9px] font-black leading-none text-white bg-red-500 rounded-full border-2 border-white translate-x-1/4 -translate-y-1/4 shadow-sm">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>
    
    <div x-show="openNotif"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute {{ $align === 'right' ? 'right-0' : 'left-0' }} mt-2 w-80 sm:w-96 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 overflow-hidden flex flex-col max-h-[400px]"
         style="display: none;">
        
        {{-- Header --}}
        <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between flex-shrink-0">
            <h3 class="text-sm font-black text-gray-900">Notifikasi</h3>
            @if($unreadCount > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[10px] font-bold text-[#22AF85] hover:text-[#1d9a75] hover:underline">
                        Tandai semua dibaca
                    </button>
                </form>
            @endif
        </div>

        {{-- List --}}
        <div class="overflow-y-auto flex-1 overscroll-contain">
            @forelse(Auth::user()->notifications()->limit(10)->get() as $notification)
                <div class="relative block px-4 py-3 border-b border-gray-50 transition-colors {{ $notification->unread() ? 'bg-[#22AF85]/10 hover:bg-[#22AF85]/15' : 'bg-white hover:bg-gray-50/50' }}">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 mt-0.5">
                            @php
                                $typeMap = [
                                    'info' => 'text-blue-500 bg-blue-50 border-blue-100',
                                    'success' => 'text-emerald-500 bg-emerald-50 border-emerald-100',
                                    'warning' => 'text-amber-500 bg-amber-50 border-amber-100',
                                    'error' => 'text-red-500 bg-red-50 border-red-100',
                                ];
                                $colorClass = $typeMap[$notification->data['type'] ?? 'info'] ?? $typeMap['info'];
                            @endphp
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border {{ $colorClass }}">
                                <span class="material-symbols-outlined !text-[16px]">{{ $notification->data['icon'] ?? 'notifications' }}</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-bold text-gray-900 mb-0.5 {{ $notification->unread() ? '' : 'text-opacity-80' }}">{{ $notification->data['title'] ?? 'Pemberitahuan' }}</p>
                            <p class="text-[11px] leading-snug break-words line-clamp-2 {{ $notification->unread() ? 'text-gray-700 font-medium' : 'text-gray-500' }}">
                                {{ $notification->data['message'] ?? '' }}
                            </p>
                            <p class="text-[9px] font-bold mt-1.5 {{ $notification->unread() ? 'text-[#22AF85]' : 'text-gray-400' }}">{{ $notification->created_at->diffForHumans() }}</p>
                            
                            @if(isset($notification->data['url']) && $notification->data['url'])
                                <a href="{{ $notification->data['url'] }}" class="absolute inset-0 z-10" title="Buka tautan" 
                                   @if($notification->unread()) 
                                        onclick="event.preventDefault(); document.getElementById('form-mark-read-{{ $notification->id }}').submit();"
                                   @endif
                                ></a>
                            @endif
                        </div>
                        @if($notification->unread())
                            <div class="flex-shrink-0 self-center">
                                <span class="w-2.5 h-2.5 bg-[#22AF85] rounded-full block shadow-sm border-2 border-white"></span>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Hidden form to mark as read when clicked --}}
                    @if($notification->unread())
                    <form id="form-mark-read-{{ $notification->id }}" action="{{ route('notifications.mark-read', $notification->id) }}" method="POST" class="hidden">
                        @csrf
                        @if(isset($notification->data['url']) && $notification->data['url'])
                            <input type="hidden" name="redirect_url" value="{{ $notification->data['url'] }}">
                        @endif
                    </form>
                    @endif
                </div>
            @empty
                <div class="px-4 py-8 text-center">
                    <span class="material-symbols-outlined !text-[32px] text-gray-300 mb-2">notifications_paused</span>
                    <p class="text-xs font-medium text-gray-500">Belum ada notifikasi baru.</p>
                </div>
            @endforelse
        </div>
        
        @if(Auth::user()->notifications()->count() > 10)
            <div class="px-4 py-2 bg-gray-50/50 border-t border-gray-50 text-center flex-shrink-0">
                <span class="text-[10px] font-bold text-gray-400">Menampilkan 10 notifikasi terbaru</span>
            </div>
        @endif
    </div>
</div>
