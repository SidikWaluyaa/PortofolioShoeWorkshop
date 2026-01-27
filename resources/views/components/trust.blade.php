@if(count($items) > 0)
<section class="bg-[#22AF85] py-12 relative overflow-hidden">
    <!-- Subtle Pattern -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
    
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-10 lg:gap-8">
            @foreach($items as $item)
            <div class="flex flex-col items-center justify-center text-white group">
                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition duration-300 backdrop-blur-sm border border-white/10">
                    {!! $item->icon !!}
                </div>
                <p class="text-[10px] sm:text-xs font-black uppercase tracking-[0.2em] text-white/90">{{ $item->label }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
