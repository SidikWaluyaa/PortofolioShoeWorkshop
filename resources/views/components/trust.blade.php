@if(count($items) > 0)
<div class="bg-primary py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-4">
            @foreach($items as $item)
            <div class="col-span-1 flex flex-col items-center justify-center text-white">
                <div class="text-3xl mb-2">
                    {!! $item->icon !!}
                </div>
                <p class="text-sm font-semibold uppercase tracking-wider">{{ $item->label }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
