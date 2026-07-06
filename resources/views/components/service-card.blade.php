<article class="w-full bg-white border border-gray-200 rounded-xl overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300 card opacity-0 translate-y-6 motion-reduce:transition-none motion-reduce:opacity-100 motion-reduce:translate-y-0 text-left flex flex-col search-item" data-name="{{ strtolower($service->name) }}" data-desc="{{ strtolower($service->proses) }}" x-data="{ expanded: false }">
  
  <!-- BEFORE-AFTER SLIDER -->
  <x-ba-slider :service="$service" :catIndex="$catIndex" class="w-full border-b border-gray-200 rounded-t-xl" />
  
  <div class="p-5 md:p-6 flex flex-col flex-grow bg-white">
    <h3 class="text-xl font-bold text-gray-900">{{ $service->name }}</h3>
    @if($service->subtitle_teknis)
    <div class="text-sm text-gray-500 italic mt-1">{{ $service->subtitle_teknis }}</div>
    @endif
    
    <div x-show="expanded" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="display: none;" 
         class="mt-5 space-y-4">
      @if($service->kapan)
      <div>
        <span class="font-mono text-[10px] tracking-widest uppercase text-emerald-600 block mb-1">Kapan butuh ini?</span>
        <p class="text-sm text-gray-700 leading-relaxed">{{ $service->kapan }}</p>
      </div>
      @endif
      @if($service->proses)
      <div>
        <span class="font-mono text-[10px] tracking-widest uppercase text-emerald-600 block mb-1">Apa yang kami lakukan?</span>
        <p class="text-sm text-gray-700 leading-relaxed">{{ $service->proses }}</p>
      </div>
      @endif
      @if($service->kenapa_penting)
      <div>
        <span class="font-mono text-[10px] tracking-widest uppercase text-emerald-600 block mb-1">Kenapa penting?</span>
        <p class="text-sm text-gray-700 leading-relaxed">{{ $service->kenapa_penting }}</p>
      </div>
      @endif
    </div>

    <!-- Toggle Button -->
    <button type="button" @click="expanded = !expanded" class="mt-5 text-xs font-bold text-emerald-600 uppercase tracking-wider flex items-center justify-center gap-1.5 hover:text-emerald-700 transition-colors py-3 border-t border-gray-100/60 mt-auto">
        <span x-text="expanded ? 'Tutup Detail' : 'Baca Detail'"></span>
        <svg class="w-4 h-4 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>
  </div>
</article>
