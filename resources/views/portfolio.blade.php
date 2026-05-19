@extends('layouts.main')
@section('seo_title', 'Portfolio | Shoe Workshop')
@section('seo_description', 'Lihat hasil reparasi sepatu kami — before & after per kategori layanan.')

@section('content')

{{-- Navbar --}}
<nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-12 w-auto" />
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-600 hover:text-[#22AF85] transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Beranda
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 bg-[#22AF85] text-white text-sm font-bold rounded-lg hover:bg-[#178a67] transition-colors">
                    Konsultasi
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Header --}}
<div class="bg-[#f5f0e8] py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex items-center justify-center gap-3 mb-4">
            <div class="h-px w-12 bg-gray-400"></div>
            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Before & After</p>
            <div class="h-px w-12 bg-gray-400"></div>
        </div>
        <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-3">Portfolio</h1>
        <p class="text-gray-500 text-sm">Geser slider untuk melihat perbandingan sebelum dan sesudah pengerjaan</p>
    </div>
</div>

{{-- Portfolio Grid --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(count($categories) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
            @foreach($categories as $category => $images)
            <div class="group">
                {{-- Slider --}}
                <div class="relative rounded-2xl overflow-hidden shadow-lg bg-gray-100 select-none"
                     style="aspect-ratio: 4/3"
                     x-data="beforeAfterSlider()"
                     x-init="init()"
                     @mousedown="startDrag($event)"
                     @mousemove="onDrag($event)"
                     @mouseup="stopDrag()"
                     @mouseleave="stopDrag()"
                     @touchstart.prevent="startDragTouch($event)"
                     @touchmove.prevent="onDragTouch($event)"
                     @touchend="stopDrag()">

                    {{-- AFTER (background full) --}}
                    <img src="{{ asset('images/portfolio/' . $images['after']) }}"
                         alt="{{ $category }} Sesudah"
                         class="absolute inset-0 w-full h-full object-cover pointer-events-none"
                         draggable="false">

                    {{-- BEFORE (clipped left) --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none"
                         :style="'width:' + position + '%'">
                        <img src="{{ asset('images/portfolio/' . $images['before']) }}"
                             alt="{{ $category }} Sebelum"
                             class="absolute inset-0 w-full h-full object-cover"
                             style="min-width: 100vw; max-width: none;"
                             :style="'width:' + (10000/position) + '%; max-width: none'"
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
                        <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-xs font-bold text-gray-700 rounded-lg shadow-sm">Sebelum</span>
                    </div>
                    <div class="absolute top-3 right-3 pointer-events-none">
                        <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-xs font-bold text-gray-700 rounded-lg shadow-sm">Sesudah</span>
                    </div>
                </div>

                {{-- Category label --}}
                <div class="mt-4 text-center">
                    <h3 class="font-bold text-gray-900 text-base">{{ str_replace('_', ' ', $category) }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Geser slider untuk perbandingan</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-24 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="font-bold text-gray-400 mb-1">Belum ada foto portfolio</p>
            <p class="text-sm text-gray-400">Tambahkan foto ke folder <code class="bg-gray-100 px-2 py-0.5 rounded text-xs">public/images/portfolio/</code></p>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-black text-gray-900 mb-3">Mau sepatu kamu seperti ini?</h2>
        <p class="text-gray-500 text-sm mb-6">Konsultasikan gratis lewat WhatsApp, kami bantu analisa kondisi sepatumu</p>
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
           class="inline-flex items-center gap-2.5 px-8 py-4 bg-[#22AF85] text-white font-bold rounded-xl hover:bg-[#178a67] transition-colors shadow-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Konsultasi via WhatsApp
        </a>
    </div>
</section>

@include('components.footer', ['settings' => $settings])

<script>
function beforeAfterSlider() {
    return {
        position: 50,
        dragging: false,
        init() {
            // touch hint animation on load
        },
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

@endsection