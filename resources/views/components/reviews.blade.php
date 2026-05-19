@if(count($reviews) > 0)
<div x-data="{ active: 0, total: {{ count($reviews) }} }">
    <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm px-10 py-10 text-center min-h-[280px] flex flex-col justify-center">
        {{-- Prev --}}
        <button @click="active = active > 0 ? active-1 : total-1"
                class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:border-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        {{-- Next --}}
        <button @click="active = active < total-1 ? active+1 : 0"
                class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:border-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        @foreach($reviews as $i => $review)
        <div x-show="active === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            {{-- Quote icon --}}
            <div class="text-[#B8952A] text-5xl font-serif leading-none mb-3" style="font-family:Georgia,serif">"</div>
            {{-- Stars --}}
            <div class="flex justify-center gap-1 mb-4">
                @for($s = 1; $s <= 5; $s++)
                <svg class="w-5 h-5 {{ $s <= $review->rating ? 'text-[#F5A623]' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                @endfor
            </div>
            {{-- Content --}}
            <p class="text-gray-600 text-sm leading-relaxed mb-6">{{ $review->content }}</p>
            {{-- Avatar + Name --}}
            <div class="flex items-center justify-center gap-3">
                @if($review->avatar)
                <img src="{{ asset('storage/'.$review->avatar) }}" alt="{{ $review->name }}" class="w-11 h-11 rounded-full object-cover border-2 border-gray-100">
                @else
                <div class="w-11 h-11 rounded-full bg-[#22AF85]/10 border-2 border-[#22AF85]/20 flex items-center justify-center font-black text-[#22AF85]">
                    {{ strtoupper(substr($review->name, 0, 1)) }}
                </div>
                @endif
                <div class="text-left">
                    <p class="font-bold text-gray-900 text-sm">{{ $review->name }}</p>
                    @if($review->location)
                    <p class="text-xs text-gray-400">{{ $review->location }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- Dots --}}
    <div class="flex justify-center gap-2 mt-4">
        @foreach($reviews as $i => $review)
        <button @click="active={{ $i }}"
                class="w-2 h-2 rounded-full transition-colors"
                :class="active==={{ $i }} ? 'bg-gray-700' : 'bg-gray-300'"></button>
        @endforeach
    </div>
</div>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada review.</div>
@endif