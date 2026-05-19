@if(count($items) > 0)
<div class="bg-[#1a1a1a] py-5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center lg:justify-between gap-6">
            @foreach($items as $item)
            <div class="flex items-center gap-3 text-white">
                <span class="text-xl">{!! $item->icon !!}</span>
                <span class="text-sm font-semibold">{{ $item->label }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif