@extends('layouts.main')

@section('seo_title', 'Layanan Reparasi Sepatu | Shoe Workshop')

@section('content')

@include('layouts.navigation-public')

<main class="pt-20">

<!-- HERO SECTION -->
<section class="bg-white pt-8 pb-6 md:pt-12 md:pb-8">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <h1 class="inline-block font-mono text-sm tracking-widest uppercase text-emerald-600 font-bold">Layanan & Reparasi</h1>
  </div>
</section>

<!-- NAV KATEGORI -->
<nav class="sticky top-[61px] z-40 bg-white/95 backdrop-blur-md border-b border-gray-200 pt-4 pb-1">
  <div class="max-w-6xl mx-auto px-6">
    <!-- SEARCH BAR -->
    {{-- <div class="max-w-md mx-auto mb-6 relative">
      <input type="text" id="searchInput" placeholder="Cari layanan (contoh: Lem Press)..." class="w-full bg-gray-50 border border-gray-200 rounded-full px-5 py-2.5 pl-10 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors">
      <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div> --}}

    <div class="flex justify-center gap-8 overflow-x-auto whitespace-nowrap scrollbar-hide py-2 cat-nav">
      @foreach($categories as $index => $cat)
          <button class="font-mono text-sm tracking-wider uppercase pb-2 border-b-2 transition-colors {{ $index === 0 ? 'border-emerald-600 text-emerald-600 active' : 'border-transparent text-gray-500 hover:text-gray-900' }}" data-cat="{{ $cat->slug }}">
            {{ $cat->name }}
          </button>
      @endforeach
    </div>
  </div>
</nav>

<div id="category-container" class="relative overflow-hidden min-h-[500px]">
@foreach($categories as $catIndex => $cat)
<section class="py-8 md:py-12 border-b border-gray-100 category-section transition-all duration-500 ease-out {{ $catIndex === 0 ? 'opacity-100 translate-y-0 relative z-10' : 'opacity-0 translate-y-12 absolute top-0 left-0 w-full pointer-events-none z-0' }}" id="{{ $cat->slug }}">
  <div class="max-w-6xl mx-auto px-6">
    
    <!-- CATEGORY HEADER 50:50 -->
    @php
        $featuredService = $cat->services->first(fn($s) => $s->is_preview) ?? $cat->services->first();
    @endphp
    <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-center mb-12">
      <!-- Left: Featured Image (Slider) -->
      <div class="w-full md:w-1/2 md:max-w-md mx-auto aspect-square rounded-2xl md:rounded-[2rem] overflow-hidden shadow-[0_20px_40px_rgba(0,0,0,0.08)] border border-gray-100 shrink-0">
        @if($featuredService)
          <x-ba-slider :service="$featuredService" :catIndex="$catIndex" class="w-full h-full" />
        @else
          <div class="w-full h-full bg-gray-50 flex items-center justify-center text-gray-400">
             <span class="font-mono text-xs">NO IMAGE</span>
          </div>
        @endif
      </div>
      
      <!-- Right: Category Details -->
      <div class="w-full md:w-1/2 text-left">
        <span class="inline-block font-mono text-[11px] tracking-widest uppercase text-emerald-600 mb-2 font-bold">Kategori 0{{ $cat->order }}</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">{{ $cat->name }}</h2>
        <p class="text-emerald-600 italic font-medium mb-5">{{ $cat->subtitle }}</p>
        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-8">{{ $cat->description }}</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="bg-gray-50/80 rounded-xl p-5 border border-gray-100">
            <span class="block font-mono text-[10px] tracking-widest uppercase text-emerald-600 mb-1.5">Nilai Material</span>
            <p class="text-gray-600 text-xs md:text-sm leading-relaxed">{{ $cat->value_material }}</p>
          </div>
          <div class="bg-gray-50/80 rounded-xl p-5 border border-gray-100">
            <span class="block font-mono text-[10px] tracking-widest uppercase text-emerald-600 mb-1.5">Nilai Kehidupan</span>
            <p class="text-gray-600 text-xs md:text-sm leading-relaxed">{{ $cat->value_kehidupan }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CARD GRID (Semua Jasa) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 w-full max-w-6xl mx-auto">
      @foreach($cat->services as $service)
        @include('components.service-card', ['service' => $service, 'catIndex' => $catIndex])
      @endforeach
    </div>

    <div class="mt-8 text-center">
      <a href="#" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold px-8 py-3.5 rounded-full transition-colors shadow-sm">
        {{ $cat->cta }}
      </a>
    </div>
  </div>
</section>
@endforeach
</div>

</main>

@include('components.footer', ['settings' => $settings])

<script>
document.addEventListener('DOMContentLoaded', () => {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Scroll reveal (Phase 4 & 5)
  const revealEls = document.querySelectorAll('.card');
  if (!prefersReducedMotion) {
    const io = new IntersectionObserver((entries)=>{
      entries.forEach((e,i)=>{
        if(e.isIntersecting){
          setTimeout(() => {
            e.target.classList.remove('opacity-0', 'translate-y-6');
            e.target.classList.add('opacity-100', 'translate-y-0');
          }, i*90);
          io.unobserve(e.target);
        }
      });
    }, {threshold:0.15});
    revealEls.forEach(el=>io.observe(el));
  } else {
    revealEls.forEach(el => {
      el.classList.remove('opacity-0', 'translate-y-6');
      el.classList.add('opacity-100', 'translate-y-0');
    });
  }

  // Before-after slider drag (Phase 2 & 5)
  document.querySelectorAll('.ba-slider').forEach(slider=>{
    const after = slider.querySelector('.after-layer');
    const handle = slider.querySelector('.ba-handle');
    const knob = slider.querySelector('.knob');
    let dragging = false;

    function setPos(clientX){
      const rect = slider.getBoundingClientRect();
      let pct = ((clientX - rect.left) / rect.width) * 100;
      pct = Math.max(0, Math.min(100, pct));
      if(after) after.style.clipPath = `inset(0 0 0 ${pct}%)`;
      if(handle) handle.style.left = pct + '%';
    }

    // Touch & Mouse events
    const startDrag = (e) => {
      dragging = true;
      if(knob) knob.classList.add('scale-110', 'shadow-xl');
      setPos(e.touches ? e.touches[0].clientX : e.clientX);
    };

    const moveDrag = (e) => {
      if(!dragging) return;
      setPos(e.touches ? e.touches[0].clientX : e.clientX);
    };

    const endDrag = () => {
      dragging = false;
      if(knob) knob.classList.remove('scale-110', 'shadow-xl');
    };

    slider.addEventListener('mousedown', startDrag);
    slider.addEventListener('touchstart', startDrag, {passive: true});
    
    window.addEventListener('mousemove', moveDrag);
    window.addEventListener('touchmove', (e) => {
      if (dragging) {
        // Phase 6: Prevent vertical scroll while horizontal dragging
        if(e.cancelable) e.preventDefault(); 
        moveDrag(e);
      }
    }, {passive: false});

    window.addEventListener('mouseup', endDrag);
    window.addEventListener('touchend', endDrag);

    // Intro hint animation (only if not reduced motion)
    if (!prefersReducedMotion) {
      const hintIO = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
          if(entry.isIntersecting){
            setTimeout(()=> { if(!dragging) setPos(slider.getBoundingClientRect().left + slider.getBoundingClientRect().width*0.28); }, 500);
            setTimeout(()=> { if(!dragging) setPos(slider.getBoundingClientRect().left + slider.getBoundingClientRect().width*0.5); }, 1100);
            hintIO.unobserve(slider);
          }
        });
      }, {threshold:0.5});
      hintIO.observe(slider);
    }
  });

  // Category nav active state (Tab Switcher)
  document.querySelectorAll('.cat-nav button').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const catId = btn.getAttribute('data-cat');
      const newSection = document.getElementById(catId);
      const activeSection = document.querySelector('.category-section.relative');
      
      if(newSection && activeSection !== newSection) {
        // Update Nav UI
        document.querySelectorAll('.cat-nav button').forEach(b=>{
          b.classList.remove('border-emerald-600', 'text-emerald-600', 'active');
          b.classList.add('border-transparent', 'text-gray-500');
        });
        btn.classList.remove('border-transparent', 'text-gray-500');
        btn.classList.add('border-emerald-600', 'text-emerald-600', 'active');
        
        // Hide Old
        if(activeSection) {
            activeSection.classList.remove('opacity-100', 'translate-y-0', 'relative', 'z-10');
            activeSection.classList.add('opacity-0', 'translate-y-12', 'absolute', 'top-0', 'left-0', 'w-full', 'pointer-events-none', 'z-0');
        }
        
        // Show New
        newSection.classList.remove('opacity-0', 'translate-y-12', 'absolute', 'top-0', 'left-0', 'w-full', 'pointer-events-none', 'z-0');
        newSection.classList.add('opacity-100', 'translate-y-0', 'relative', 'z-10');
      }
    });
  });
});

// Real-time DOM Search
document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  if(!searchInput) return;

  searchInput.addEventListener('input', (e) => {
    const term = e.target.value.toLowerCase().trim();
    
    // Switch to first tab if they search to see all results contextually, or just show everywhere
    // Easiest is to search across all active and inactive tabs, 
    // but inactive tabs are hidden. Let's make search open all tabs!
    const allSections = document.querySelectorAll('.category-section');
    
    if (term.length > 0) {
        // Show all sections when searching
        allSections.forEach(sec => {
            sec.classList.remove('opacity-0', 'translate-y-12', 'absolute', 'top-0', 'left-0', 'pointer-events-none', 'z-0');
            sec.classList.add('opacity-100', 'translate-y-0', 'relative', 'z-10');
            // Also open all accordions to show hidden results
            const acc = sec.querySelector('.accordion');
            if(acc) {
               acc.style.maxHeight = acc.scrollHeight + 'px';
               const btn = sec.querySelector('.more-toggle');
               if(btn) btn.style.display = 'none'; // hide the toggle button while searching
            }
        });
    } else {
        // Reset to default (first tab active)
        const activeNav = document.querySelector('.cat-nav button.active');
        if(activeNav) activeNav.click(); // simulate click to restore tab state
        
        allSections.forEach(sec => {
            const acc = sec.querySelector('.accordion');
            if(acc) {
               acc.style.maxHeight = '0px';
               const btn = sec.querySelector('.more-toggle');
               if(btn) btn.style.display = 'inline-flex';
            }
        });
    }

    const cards = document.querySelectorAll('.search-item');
    let hasResults = false;
    
    cards.forEach(card => {
      const name = card.getAttribute('data-name');
      const desc = card.getAttribute('data-desc');
      if (name.includes(term) || desc.includes(term)) {
        card.style.display = 'flex';
        hasResults = true;
      } else {
        card.style.display = 'none';
      }
    });
  });
});

// Accordion Toggles (Global Function)
window.toggleAccordion = function(catId) {
  const toggleBtn = document.getElementById('moreToggle_' + catId);
  const accordion = document.getElementById('accordion_' + catId);
  const chev = toggleBtn.querySelector('.chev');
  const textSpan = toggleBtn.querySelector('span');
  
  const isClosed = accordion.style.maxHeight === '0px' || accordion.style.maxHeight === '';
  const remainingCount = toggleBtn.textContent.replace(/[^0-9]/g, '');
  
  if (isClosed) {
    accordion.style.maxHeight = accordion.scrollHeight + 'px';
    chev.classList.add('rotate-180');
    textSpan.textContent = 'Tutup';
  } else {
    accordion.style.maxHeight = '0px';
    chev.classList.remove('rotate-180');
    textSpan.textContent = 'Lihat ' + remainingCount + ' jasa lainnya';
  }
};
</script>
@endsection