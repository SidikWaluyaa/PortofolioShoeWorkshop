@props(['service', 'catIndex' => 0, 'class' => ''])

<div class="relative shrink-0 aspect-square bg-gray-100 overflow-hidden cursor-ew-resize select-none ba-slider flex items-center justify-center {{ $class }}">
    
    <!-- Fallback Gray Box -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400">
      <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"></path></svg>
      <span class="font-mono text-xs tracking-wider">NO IMAGE YET</span>
    </div>
    
    <div class="absolute inset-0 z-10 pointer-events-none before-layer bg-gray-200">
      <img draggable="false" src="{{ asset($service->image_before ?? '') }}" alt="{{ $service->name }} Before" class="absolute inset-0 w-full h-full object-cover" onerror="this.style.opacity='0'" loading="{{ $catIndex === 0 ? 'eager' : 'lazy' }}">
      <span class="absolute top-4 left-4 z-10 bg-black/60 text-white font-mono text-[10px] tracking-wider uppercase px-2 py-1 rounded backdrop-blur-sm">Before</span>
    </div>
    
    <div class="absolute inset-0 z-20 pointer-events-none after-layer bg-gray-100" style="clip-path: inset(0 0 0 50%);">
      <img draggable="false" src="{{ asset($service->image_after ?? '') }}" alt="{{ $service->name }} After" class="absolute inset-0 w-full h-full object-cover" onerror="this.style.opacity='0'" loading="{{ $catIndex === 0 ? 'eager' : 'lazy' }}">
      <span class="absolute top-4 right-4 z-10 bg-black/60 text-white font-mono text-[10px] tracking-wider uppercase px-2 py-1 rounded backdrop-blur-sm">After</span>
    </div>
    
    {{-- Divider + handle: same style as the portfolio slider (white line, white knob with ‹ › arrows) --}}
    <div class="absolute top-0 bottom-0 left-[50%] w-0.5 bg-white shadow-xl z-30 ba-handle -translate-x-1/2">
      <div class="absolute top-1/2 left-1/2 w-10 h-10 -translate-x-1/2 -translate-y-1/2 bg-white rounded-full border-2 border-gray-100 shadow-2xl flex items-center justify-center transition-transform knob">
        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3M16 9l3 3-3 3"/>
        </svg>
      </div>
    </div>
</div>
