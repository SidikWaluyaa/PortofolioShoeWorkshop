@php $featured = $portfolio->first(); @endphp
@if($featured)
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    {{-- Left: Before/After Image --}}
    <div class="relative rounded-2xl shadow-2xl border-4 border-white overflow-hidden group select-none h-[280px] sm:h-[400px] w-full"
         x-data="beforeAfterSlider()"
         @mousedown="startDrag($event)"
         @mousemove="onDrag($event)"
         @mouseup="stopDrag()"
         @mouseleave="stopDrag()"
         @touchstart.prevent="startDragTouch($event)"
         @touchmove.prevent="onDragTouch($event)"
         @touchend="stopDrag()">

        {{-- AFTER (background full) --}}
        <img src="{{ $featured->after_image_url }}"
             alt="Sesudah"
             class="absolute inset-0 w-full h-full object-cover pointer-events-none"
             draggable="false">

        {{-- BEFORE (clipped left) --}}
        <div class="absolute inset-0 pointer-events-none"
             :style="'clip-path: inset(0 ' + (100 - position) + '% 0 0)'">
            <img src="{{ $featured->before_image_url }}"
                 alt="Sebelum"
                 class="absolute inset-0 w-full h-full object-cover"
                 draggable="false">
        </div>

        {{-- Divider line --}}
        <div class="absolute top-0 bottom-0 w-0.5 bg-white shadow-xl pointer-events-none"
             :style="'left:' + position + '%'"></div>

        {{-- Handle --}}
        <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 w-10 h-10 bg-white rounded-full shadow-2xl flex items-center justify-center cursor-grab active:cursor-grabbing z-10 border-2 border-gray-100"
             :style="'left:' + position + '%'">
            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/>
            </svg>
        </div>

        {{-- Labels --}}
        <div class="absolute top-3 left-3 pointer-events-none">
            <span class="px-3 py-1.5 bg-[#1c1c17] text-white text-[10px] rounded font-bold uppercase shadow-sm">Sebelum</span>
        </div>
        <div class="absolute top-3 right-3 pointer-events-none">
            <span class="px-3 py-1.5 bg-[#22AF85] text-white text-[10px] rounded font-bold uppercase shadow-sm">Sesudah</span>
        </div>
    </div>

    <script>
    function beforeAfterSlider() {
        return {
            position: 50,
            dragging: false,
            getRelativeX(clientX) {
                const rect = this.$el.getBoundingClientRect();
                const x = clientX - rect.left;
                return Math.min(Math.max((x / rect.width) * 100, 2), 98);
            },
            startDrag(e) {
                this.dragging = true;
                this.position = this.getRelativeX(e.clientX);
            },
            onDrag(e) {
                if (!this.dragging) return;
                this.position = this.getRelativeX(e.clientX);
            },
            stopDrag() {
                this.dragging = false;
            },
            startDragTouch(e) {
                this.dragging = true;
                this.position = this.getRelativeX(e.touches[0].clientX);
            },
            onDragTouch(e) {
                if (!this.dragging) return;
                this.position = this.getRelativeX(e.touches[0].clientX);
            },
        }
    }
    </script>

    {{-- Right: Details --}}
    <div class="space-y-5 sm:space-y-6 flex flex-col items-center sm:items-start text-center sm:text-left">
        <div class="inline-block px-3 py-1 bg-[#22AF85]/10 text-[#22AF85] rounded-full text-xs font-semibold uppercase tracking-wider">Service: {{ $featured->category ?? ($featured->service->name ?? 'Restorasi') }}</div>
        <h3 class="text-2xl sm:text-[32px] font-extrabold text-[#1c1c17] leading-tight">{{ $featured->title }}</h3>
        @if($featured->description)
        <p class="text-gray-500 text-base leading-relaxed">{{ $featured->description }}</p>
        @else
        <p class="text-gray-500 text-base leading-relaxed">Transformasi luar biasa dari sepatu yang sudah rusak menjadi tampak seperti baru. Dengan proses deep cleaning organik dan repaint premium, kami mengembalikan kejayaan klasiknya.</p>
        @endif
        <a href="{{ route('portfolio.index') }}"
           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-[#22AF85] text-[#22AF85] bg-transparent hover:bg-[#22AF85] hover:text-white rounded-xl font-bold transition-all duration-300 group mt-4">
            Lihat Portfolio Lainnya
            <span class="material-symbols-outlined !text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
    </div>
</div>
@else
<div class="text-center py-16 text-gray-400 text-sm">Belum ada portfolio.</div>
@endif