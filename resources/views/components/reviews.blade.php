@if(count($reviews) > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($reviews->take(3) as $review)
    <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 hover:shadow-xl hover:border-[#22AF85]/20 hover:-translate-y-1 transition-all duration-300">
        {{-- Quote icon --}}
        <div class="text-[#22AF85] mb-4">
            <svg class="w-8 h-8 opacity-60" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
        </div>

        {{-- Stars --}}
        <div class="flex gap-0.5 mb-4">
            @for($s = 1; $s <= 5; $s++)
            <svg class="w-4 h-4 {{ $s <= $review->rating ? 'text-[#F5A623]' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            @endfor
        </div>

        {{-- Content --}}
        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-4">{{ $review->content }}</p>

        {{-- Avatar + Name --}}
        <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
            @if($review->avatar)
            <img src="{{ asset('storage/'.$review->avatar) }}" alt="{{ $review->name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-100">
            @else
            <div class="w-10 h-10 rounded-full bg-[#22AF85]/10 flex items-center justify-center font-black text-[#22AF85] text-sm ring-2 ring-[#22AF85]/10">
                {{ strtoupper(substr($review->name, 0, 1)) }}
            </div>
            @endif
            <div>
                <p class="font-bold text-gray-900 text-sm">{{ $review->name }}</p>
                @if($review->location)
                <p class="text-xs text-gray-400">{{ $review->location }}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada review.</div>
@endif