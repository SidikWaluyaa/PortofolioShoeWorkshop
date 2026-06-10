@extends('layouts.main')
@section('seo_title', 'Portfolio | Shoe Workshop')
@section('seo_description', 'Lihat hasil reparasi sepatu kami — before & after per kategori layanan.')

@section('content')

{{-- NAVBAR --}}
<header x-data="{ open: false }" class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="flex flex-col leading-tight">
                <span class="text-lg font-extrabold text-[#1c1c17]">Shoe Workshop</span>
                <div class="flex h-1 w-full">
                    <div class="w-1/2 bg-[#22AF85]"></div>
                    <div class="w-1/2 bg-[#FFC232]"></div>
                </div>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Beranda</a>
            <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Layanan</a>
            <a href="{{ route('portfolio.index') }}" class="text-sm font-semibold text-[#22AF85] active-nav-border">Portfolio</a>
            <a href="{{ route('home') }}#review" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Review</a>
            <a href="{{ route('tracking.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Tracking</a>
            <a href="{{ route('home') }}#kontak" class="text-sm font-semibold text-gray-500 hover:text-[#22AF85] transition-colors">Kontak</a>
        </div>

        {{-- CTA Button --}}
        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}"
           class="hidden md:inline-flex items-center gap-2 px-6 py-2.5 bg-[#FFC232] text-[#1c1c17] text-sm font-semibold rounded-lg hover:brightness-105 active:scale-95 transition-all shadow-md shadow-[#FFC232]/20">
            <span class="material-symbols-outlined !text-[20px]">chat</span>
            Konsultasi via WhatsApp
        </a>

        {{-- Hamburger --}}
        <button @click="open=!open" class="lg:hidden p-2 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden bg-white border-t border-gray-100 px-4 py-3 space-y-1">
        <a href="{{ route('home') }}"         @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Beranda</a>
        <a href="{{ route('home') }}#layanan" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Layanan</a>
        <a href="{{ route('portfolio.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-[#22AF85] bg-green-50 rounded-lg">Portfolio</a>
        <a href="{{ route('home') }}#review"  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Review</a>
        <a href="{{ route('tracking.index') }}" @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Tracking</a>
        <a href="{{ route('home') }}#kontak"  @click="open=false" class="block px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 rounded-lg">Kontak</a>
        <div class="pt-2">
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}" class="flex items-center justify-center gap-2 w-full py-3 bg-[#FFC232] text-[#1c1c17] text-sm font-bold rounded-lg">
                <span class="material-symbols-outlined !text-[20px]">chat</span>
                Konsultasi via WhatsApp
            </a>
        </div>
    </div>
</header>

<main class="pt-20">

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
        @if(count($projects) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
            @foreach($projects as $project)
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
                    <img src="{{ $project->after_image_url }}"
                         alt="{{ $project->title }} Sesudah"
                         class="absolute inset-0 w-full h-full object-cover pointer-events-none"
                         draggable="false">

                    {{-- BEFORE (clipped left) --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none"
                         :style="'width:' + position + '%'">
                        <img src="{{ $project->before_image_url }}"
                             alt="{{ $project->title }} Sebelum"
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

                {{-- Project Info --}}
                <div class="mt-4 text-center">
                    <h3 class="font-bold text-gray-900 text-base">{{ $project->title }}</h3>
                    <p class="text-xs text-[#22AF85] font-semibold uppercase tracking-wider mt-0.5">{{ $project->category ?? ($project->service->name ?? 'Restorasi') }}</p>
                    @if($project->description)
                    <p class="text-xs text-gray-500 mt-1 line-clamp-2 px-4">{{ $project->description }}</p>
                    @endif
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
            <p class="text-sm text-gray-400">Gunakan dashboard admin untuk mengunggah proyek portfolio baru.</p>
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

</main>

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