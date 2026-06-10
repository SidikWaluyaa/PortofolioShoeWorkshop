@if(count($reviews) > 0)
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($reviews->take(3) as $review)
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-6 hover:shadow-xl hover:border-[#22AF85]/20 hover:-translate-y-1 transition-all duration-300">
        {{-- Stars --}}
        <div class="flex text-[#22AF85]">
            @for($s = 1; $s <= 5; $s++)
            <span class="material-symbols-outlined {{ $s <= $review->rating ? 'fill-1' : '' }} !text-[20px]">star</span>
            @endfor
        </div>

        {{-- Content --}}
        <p class="text-sm sm:text-base text-[#1c1c17] italic leading-relaxed line-clamp-4">
            "{{ $review->content }}"
        </p>

        {{-- Avatar + Name --}}
        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            @if($review->avatar)
            <img src="{{ asset('storage/'.$review->avatar) }}" alt="{{ $review->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-gray-100 shadow-sm">
            @else
            <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center font-bold text-gray-500 border border-gray-200 shadow-sm">
                {{ strtoupper(substr($review->name, 0, 2)) }}
            </div>
            @endif
            <div>
                <p class="font-bold text-[#1c1c17] text-sm sm:text-base">{{ $review->name }}</p>
                @if($review->location)
                <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $review->location }}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada testimoni.</div>
@endif