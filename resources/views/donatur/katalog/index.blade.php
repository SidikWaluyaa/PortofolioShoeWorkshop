<x-donatur-layout>
    <x-slot name="header">Katalog Donasi</x-slot>
    <style>
        /* Hide spin buttons for range-linked number inputs */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>

    <div x-data="catalogApp()" x-init="initApp()" class="space-y-6 pb-12">
        @if(isset($activeCampaigns) && $activeCampaigns->isNotEmpty())
            <div x-data="{
                activeSlide: 0,
                slidesCount: {{ $activeCampaigns->count() }},
                intervalId: null,
                isMobile: window.innerWidth < 640,
                startAutoSlide() {
                    if (this.slidesCount > 1) {
                        this.intervalId = setInterval(() => {
                            this.next();
                        }, 5000);
                    }
                },
                stopAutoSlide() {
                    if (this.intervalId) {
                        clearInterval(this.intervalId);
                        this.intervalId = null;
                    }
                },
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
                },
                prev() {
                    this.activeSlide = (this.activeSlide - 1 + this.slidesCount) % this.slidesCount;
                }
            }"
            x-init="startAutoSlide()"
            @mouseenter="stopAutoSlide()"
            @mouseleave="startAutoSlide()"
            @resize.window="isMobile = window.innerWidth < 640"
            class="w-full relative group overflow-hidden">
                
                <!-- Carousel Slides Container -->
                <div class="flex transition-transform duration-500 ease-in-out w-full"
                     :style="isMobile ? `transform: translateX(calc(-${activeSlide * 82}% + 9%))` : `transform: translateX(-${activeSlide * 100}%)`">
                    @foreach($activeCampaigns as $index => $campaign)
                        <div class="w-[82%] sm:w-full flex-shrink-0 px-2 sm:px-0 transition-all duration-500"
                             :class="activeSlide === {{ $index }} ? 'opacity-100 scale-100' : 'opacity-60 scale-95 sm:scale-100 sm:opacity-100'">
                            
                            @if($campaign->type === 'text_only')
                                <!-- Text Only Glassmorphic Banner -->
                                <div class="relative overflow-hidden rounded-2xl border border-emerald-500/20 bg-gradient-to-r from-emerald-50/50 to-emerald-500/5 p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-6 transition-all hover:shadow-md aspect-[12/5] sm:aspect-auto h-auto sm:h-auto justify-center">
                                    <div class="absolute -right-16 -top-16 w-36 h-36 bg-emerald-500/5 rounded-full blur-2xl"></div>
                                    <div class="space-y-1 relative z-10 flex-grow max-w-3xl">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-500/10 text-emerald-700 uppercase tracking-wider">
                                            Promosi
                                        </span>
                                        <h3 class="text-xs sm:text-lg md:text-xl font-extrabold text-gray-900 truncate">
                                            {{ $campaign->title }}
                                        </h3>
                                        <p class="text-[10px] sm:text-xs md:text-sm text-gray-500 line-clamp-1 sm:line-clamp-none leading-relaxed font-normal">
                                            {{ $campaign->promo_text }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 relative z-10 hidden sm:block">
                                        <a href="{{ route('campaigns.click', $campaign->id) }}" target="_blank"
                                           class="inline-flex items-center gap-2 px-6 py-3.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 active:scale-95 transition-all shadow-md shadow-emerald-500/10">
                                            {{ $campaign->cta_text }}
                                            <span class="material-symbols-outlined !text-[16px]">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <!-- Image Banner (Uploaded or External Link) -->
                                <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-all group/item">
                                    <!-- Campaign Banner Image -->
                                    <a href="{{ route('campaigns.click', $campaign->id) }}" target="_blank" class="block relative overflow-hidden w-full">
                                        <div class="absolute inset-0 bg-black/0 group-hover/item:bg-black/5 transition-colors z-10"></div>
                                        <img src="{{ $campaign->banner_url }}" alt="{{ $campaign->title }}" class="w-full h-auto block group-hover/item:scale-[1.005] transition-transform duration-500" />
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Controls (Only show if multiple slides) -->
                <div x-show="slidesCount > 1" style="display: none;">
                    <!-- Prev Button -->
                    <button @click="prev()" 
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 border border-gray-200 text-gray-700 shadow-md flex items-center justify-center hover:bg-white active:scale-90 transition-all opacity-0 group-hover:opacity-100 z-20">
                        <span class="material-symbols-outlined !text-[24px]">chevron_left</span>
                    </button>
                    <!-- Next Button -->
                    <button @click="next()" 
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 border border-gray-200 text-gray-700 shadow-md flex items-center justify-center hover:bg-white active:scale-90 transition-all opacity-0 group-hover:opacity-100 z-20">
                        <span class="material-symbols-outlined !text-[24px]">chevron_right</span>
                    </button>

                    <!-- Indicators -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-20">
                        <template x-for="idx in Array.from({ length: slidesCount }, (_, i) => i)" :key="idx">
                            <button @click="activeSlide = idx" 
                                    :class="activeSlide === idx ? 'w-6 bg-emerald-500' : 'w-2 bg-gray-300 hover:bg-gray-400'"
                                    class="h-2 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>
                </div>
            </div>
        @endif

        <!-- Mobile Sticky Filter Bar -->
        <div class="lg:hidden block sticky top-[64px] z-30 bg-white border border-gray-150 rounded-2xl shadow-sm p-3 mb-2">
            <!-- Search Row -->
            <div class="flex items-center gap-2 mb-2">
                <div class="flex-grow flex items-center bg-gray-55 rounded-xl px-3 py-2 border border-gray-200 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500 transition-all">
                    <span class="material-symbols-outlined text-gray-400 mr-2 !text-[18px]">search</span>
                    <input type="text" x-model="search" @input.debounce.300ms="page = 1; fetchFilter()"
                           placeholder="Cari nama, brand..." class="bg-transparent border-none p-0 focus:ring-0 text-xs w-full text-gray-700 placeholder-gray-400"/>
                </div>
            </div>

            <!-- Pills Row -->
            <div class="flex items-center justify-between border-t border-gray-100 pt-2">
                <div class="flex-grow overflow-x-auto whitespace-nowrap scrollbar-none flex items-center gap-1.5 pr-2">
                    <!-- Category pills -->
                    <button @click="toggleCategory('sepatu')"
                            :class="categories.includes('sepatu') ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-650 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all flex items-center gap-1">
                        👞 Sepatu
                    </button>
                    <button @click="toggleCategory('tas')"
                            :class="categories.includes('tas') ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-650 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all flex items-center gap-1">
                        🎒 Tas
                    </button>
                    <button @click="toggleCategory('topi')"
                            :class="categories.includes('topi') ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-650 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all flex items-center gap-1">
                        🧢 Topi
                    </button>

                    <span class="text-gray-300">|</span>

                    <!-- Condition pills -->
                    <button @click="setCondition(condition === 'baru' ? '' : 'baru')"
                            :class="condition === 'baru' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-655 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all">
                        🆕 Baru
                    </button>
                    <button @click="setCondition(condition === 'seperti_baru' ? '' : 'seperti_baru')"
                            :class="condition === 'seperti_baru' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-655 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all">
                        ✨ Like New
                    </button>
                    <button @click="setCondition(condition === 'sudah_diperbaiki' ? '' : 'sudah_diperbaiki')"
                            :class="condition === 'sudah_diperbaiki' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-655 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all">
                        🔧 Refurbished
                    </button>

                    <span class="text-gray-300">|</span>

                    <!-- Status pills -->
                    <button @click="setStatus(status === 'tersedia' ? '' : 'tersedia')"
                            :class="status === 'tersedia' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-655 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all">
                        Tersedia
                    </button>
                    <button @click="setStatus(status === 'disalurkan' ? '' : 'disalurkan')"
                            :class="status === 'disalurkan' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-gray-655 border-gray-200'"
                            class="px-3 py-1.5 rounded-full border text-[11px] font-semibold transition-all">
                        Disalurkan
                    </button>
                </div>

                <div class="w-px h-6 bg-gray-200 mx-1 shrink-0"></div>

                <!-- Filter Button -->
                <button @click="mobileFilterOpen = true"
                        class="px-2 py-1 flex flex-col items-center justify-center text-[10px] font-bold text-gray-700 hover:text-emerald-500 shrink-0 active:scale-95 transition-all">
                    <span class="material-symbols-outlined !text-[18px]">filter_list</span>
                    <span>Filter</span>
                </button>
            </div>
        </div>

        <!-- Mobile Filter Drawer (Bottom Sheet) -->
        <div x-show="mobileFilterOpen" class="fixed inset-0 z-[60] lg:hidden" style="display: none;" x-cloak>
            <!-- Backdrop -->
            <div x-show="mobileFilterOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileFilterOpen = false"
                 class="fixed inset-0 bg-black/60 backdrop-blur-xs"></div>
            
            <!-- Drawer Panel -->
            <div x-show="mobileFilterOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-y-full"
                 x-transition:enter-end="translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-y-0"
                 x-transition:leave-end="translate-y-full"
                 class="fixed inset-x-0 bottom-0 bg-white rounded-t-3xl max-h-[85vh] overflow-y-auto z-10 flex flex-col border-t border-gray-200">
                
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-10">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-700 !text-[20px]">filter_list</span>
                        <h3 class="text-base font-bold text-gray-900">Semua Filter</h3>
                    </div>
                    <button @click="mobileFilterOpen = false" class="p-1 rounded-full hover:bg-gray-150">
                        <span class="material-symbols-outlined text-gray-500 !text-[20px]">close</span>
                    </button>
                </div>
                
                <div class="p-6 space-y-6 flex-grow overflow-y-auto">
                    <!-- Category -->
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-3">Kategori</h4>
                        <div class="flex flex-wrap gap-2">
                            <label class="cursor-pointer">
                                <input type="checkbox" value="sepatu" x-model="categories" @change="page = 1; updateCategoryFilter()" class="sr-only peer"/>
                                <span class="px-3.5 py-2 rounded-xl border text-xs font-bold block peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 bg-gray-50 border-gray-200 text-gray-650 transition-all">👞 Sepatu</span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" value="tas" x-model="categories" @change="page = 1; updateCategoryFilter()" class="sr-only peer"/>
                                <span class="px-3.5 py-2 rounded-xl border text-xs font-bold block peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 bg-gray-50 border-gray-200 text-gray-655 transition-all">🎒 Tas</span>
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" value="topi" x-model="categories" @change="page = 1; updateCategoryFilter()" class="sr-only peer"/>
                                <span class="px-3.5 py-2 rounded-xl border text-xs font-bold block peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 bg-gray-50 border-gray-200 text-gray-655 transition-all">🧢 Topi</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price -->
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-3">Harga Jasa Reparasi</h4>
                        <div class="relative min-h-[40px] mt-2 px-1">
                            <div class="absolute h-2 rounded bg-gray-200 left-0 right-0 top-1/2 -translate-y-1/2"></div>
                            <div class="absolute h-2 rounded bg-emerald-500 top-1/2 -translate-y-1/2"
                                 :style="`left: ${(minPrice / maxPriceLimit) * 100}%; right: ${100 - (maxPrice / maxPriceLimit) * 100}%`"></div>
                            
                            <input type="range" min="0" :max="maxPriceLimit" step="10000" x-model.number="minPrice"
                                   @input="page = 1; if(minPrice > maxPrice) minPrice = maxPrice; debouncedFetchFilter();"
                                   class="absolute pointer-events-none appearance-none z-20 h-2 w-full bg-transparent focus:outline-none focus:ring-0 top-1/2 -translate-y-1/2 [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-emerald-500 [&::-webkit-slider-thumb]:cursor-pointer [&::-webkit-slider-thumb]:shadow-md [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-white [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-emerald-500 [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:shadow-md" />
                            
                            <input type="range" min="0" :max="maxPriceLimit" step="10000" x-model.number="maxPrice"
                                   @input="page = 1; if(maxPrice < minPrice) maxPrice = minPrice; debouncedFetchFilter();"
                                   class="absolute pointer-events-none appearance-none z-20 h-2 w-full bg-transparent focus:outline-none focus:ring-0 top-1/2 -translate-y-1/2 [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-emerald-500 [&::-webkit-slider-thumb]:cursor-pointer [&::-webkit-slider-thumb]:shadow-md [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-white [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-emerald-500 [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:shadow-md" />
                        </div>
                        <div class="flex items-center justify-between gap-3 mt-4">
                            <div class="flex-grow bg-white border border-gray-200 rounded-xl p-2.5 shadow-sm focus-within:ring-1 focus-within:ring-emerald-500 focus-within:border-emerald-500 transition-all">
                                <label class="block text-[9px] font-extrabold text-gray-400 uppercase tracking-wider">Minimal</label>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <span class="text-xs font-bold text-gray-400">Rp</span>
                                    <input type="number" x-model.number="minPrice" @input="page = 1; if(minPrice > maxPrice) minPrice = maxPrice; debouncedFetchFilter();"
                                           class="w-full bg-transparent border-none p-0 focus:ring-0 text-xs font-extrabold text-gray-700 outline-none" />
                                </div>
                            </div>
                            <span class="text-gray-400 text-xs font-medium select-none">—</span>
                            <div class="flex-grow bg-white border border-gray-200 rounded-xl p-2.5 shadow-sm focus-within:ring-1 focus-within:ring-emerald-500 focus-within:border-emerald-500 transition-all">
                                <label class="block text-[9px] font-extrabold text-gray-400 uppercase tracking-wider">Maksimal</label>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <span class="text-xs font-bold text-gray-400">Rp</span>
                                    <input type="number" x-model.number="maxPrice" @input="page = 1; if(maxPrice < minPrice) maxPrice = minPrice; debouncedFetchFilter();"
                                           class="w-full bg-transparent border-none p-0 focus:ring-0 text-xs font-extrabold text-gray-700 outline-none" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Condition -->
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-3">Kondisi</h4>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter_mobile" :checked="condition === ''" @change="page = 1; setCondition('')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Semua Kondisi</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter_mobile" :checked="condition === 'baru'" @change="page = 1; setCondition('baru')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Baru</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter_mobile" :checked="condition === 'seperti_baru'" @change="page = 1; setCondition('seperti_baru')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Like New</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kondisi_filter_mobile" :checked="condition === 'sudah_diperbaiki'" @change="page = 1; setCondition('sudah_diperbaiki')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Refurbished</span>
                            </label>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-3">Status</h4>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="status_filter_mobile" :checked="status === ''" @change="page = 1; setStatus('')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Semua Status</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="status_filter_mobile" :checked="status === 'tersedia'" @change="page = 1; setStatus('tersedia')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Tersedia</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="status_filter_mobile" :checked="status === 'disalurkan'" @change="page = 1; setStatus('disalurkan')" class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                                <span class="text-sm font-medium text-gray-750 group-hover:text-emerald-500">Sudah Disalurkan</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 border-t border-gray-100 bg-gray-50 flex gap-4 sticky bottom-0 z-10">
                    <button @click="clearAll()"
                            class="w-1/2 py-3.5 bg-white border border-gray-200 text-gray-700 rounded-xl text-sm font-bold active:scale-95 transition-all">
                        Reset
                    </button>
                    <button @click="mobileFilterOpen = false"
                            class="w-1/2 py-3.5 bg-emerald-500 text-white rounded-xl text-sm font-bold active:scale-95 transition-all shadow-md shadow-emerald-500/20">
                        Tampilkan
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filter (Desktop Only) -->
            <aside class="hidden lg:block lg:col-span-1 space-y-5 lg:sticky lg:top-[90px] lg:self-start lg:max-h-[calc(100vh-120px)] lg:overflow-y-auto pr-2">
                <!-- Search Bar -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">search</span>
                        Cari Barang
                    </h3>
                    <div class="flex items-center bg-gray-50 rounded-xl px-4 py-3 border border-gray-200 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500 transition-all">
                        <input type="text" x-model="search" @input.debounce.300ms="page = 1; fetchFilter()"
                               placeholder="Nama atau brand..." class="bg-transparent border-none p-0 focus:ring-0 text-sm w-full text-gray-700 placeholder-gray-400"/>
                    </div>
                </div>

                <!-- Kategori Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">category</span>
                        Kategori
                    </h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="checkbox" value="sepatu" x-model="categories" @change="page = 1; updateCategoryFilter()"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Sepatu</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="checkbox" value="tas" x-model="categories" @change="page = 1; updateCategoryFilter()"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Tas</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="checkbox" value="topi" x-model="categories" @change="page = 1; updateCategoryFilter()"
                                   class="w-5 h-5 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Topi</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">payments</span>
                        Harga Jasa Reparasi
                    </h3>
                    <div class="relative min-h-[40px] mt-2 px-1">
                        <!-- Track background -->
                        <div class="absolute h-2 rounded bg-gray-200 left-0 right-0 top-1/2 -translate-y-1/2"></div>
                        <!-- Track active range -->
                        <div class="absolute h-2 rounded bg-emerald-500 top-1/2 -translate-y-1/2"
                             :style="`left: ${(minPrice / maxPriceLimit) * 100}%; right: ${100 - (maxPrice / maxPriceLimit) * 100}%`"></div>
                        
                        <!-- HTML Range inputs -->
                        <input type="range" min="0" :max="maxPriceLimit" step="10000" x-model.number="minPrice"
                               @input="page = 1; if(minPrice > maxPrice) minPrice = maxPrice; debouncedFetchFilter();"
                               class="absolute pointer-events-none appearance-none z-20 h-2 w-full bg-transparent focus:outline-none focus:ring-0 top-1/2 -translate-y-1/2 [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-emerald-500 [&::-webkit-slider-thumb]:cursor-pointer [&::-webkit-slider-thumb]:shadow-md [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-white [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-emerald-500 [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:shadow-md" />
                        
                        <input type="range" min="0" :max="maxPriceLimit" step="10000" x-model.number="maxPrice"
                               @input="page = 1; if(maxPrice < minPrice) maxPrice = minPrice; debouncedFetchFilter();"
                               class="absolute pointer-events-none appearance-none z-20 h-2 w-full bg-transparent focus:outline-none focus:ring-0 top-1/2 -translate-y-1/2 [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-emerald-500 [&::-webkit-slider-thumb]:cursor-pointer [&::-webkit-slider-thumb]:shadow-md [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-white [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-emerald-500 [&::-moz-range-thumb]:cursor-pointer [&::-moz-range-thumb]:shadow-md" />
                    </div>
                    <div class="flex items-center justify-between gap-3 mt-4">
                        <!-- Min Price Input Card -->
                        <div class="flex-grow bg-gray-50 border border-gray-200 rounded-xl p-2.5 shadow-sm focus-within:ring-1 focus-within:ring-emerald-500 focus-within:border-emerald-500 transition-all">
                            <label class="block text-[9px] font-extrabold text-gray-400 uppercase tracking-wider">Minimal</label>
                            <div class="flex items-center gap-1 mt-0.5">
                                <span class="text-xs font-bold text-gray-400">Rp</span>
                                <input type="number" x-model.number="minPrice" @input="page = 1; if(minPrice > maxPrice) minPrice = maxPrice; debouncedFetchFilter();"
                                       class="w-full bg-transparent border-none p-0 focus:ring-0 text-xs font-extrabold text-gray-700 outline-none" />
                            </div>
                        </div>

                        <!-- Separator -->
                        <span class="text-gray-400 text-xs font-medium select-none">—</span>

                        <!-- Max Price Input Card -->
                        <div class="flex-grow bg-gray-50 border border-gray-200 rounded-xl p-2.5 shadow-sm focus-within:ring-1 focus-within:ring-emerald-500 focus-within:border-emerald-500 transition-all">
                            <label class="block text-[9px] font-extrabold text-gray-400 uppercase tracking-wider">Maksimal</label>
                            <div class="flex items-center gap-1 mt-0.5">
                                <span class="text-xs font-bold text-gray-400">Rp</span>
                                <input type="number" x-model.number="maxPrice" @input="page = 1; if(maxPrice < minPrice) maxPrice = minPrice; debouncedFetchFilter();"
                                       class="w-full bg-transparent border-none p-0 focus:ring-0 text-xs font-extrabold text-gray-700 outline-none" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kondisi Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">verified</span>
                        Kondisi
                    </h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === ''" @change="page = 1; setCondition('')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Semua Kondisi</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === 'baru'" @change="page = 1; setCondition('baru')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Baru</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === 'seperti_baru'" @change="page = 1; setCondition('seperti_baru')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Like New</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="kondisi_filter" :checked="condition === 'sudah_diperbaiki'" @change="page = 1; setCondition('sudah_diperbaiki')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Refurbished</span>
                        </label>
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider mb-2.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400 !text-[18px]">rule</span>
                        Status
                    </h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="status_filter" :checked="status === ''" @change="page = 1; setStatus('')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Semua Status</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="status_filter" :checked="status === 'tersedia'" @change="page = 1; setStatus('tersedia')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Tersedia</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group select-none">
                            <input type="radio" name="status_filter" :checked="status === 'disalurkan'" @change="page = 1; setStatus('disalurkan')"
                                   class="w-5 h-5 border-gray-300 text-emerald-500 focus:ring-emerald-500"/>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-emerald-600 transition-colors">Sudah Disalurkan</span>
                        </label>
                    </div>
                </div>

                <!-- Hapus Semua Filter -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <button @click="clearAll()"
                            class="w-full py-3 bg-red-50 hover:bg-red-100 text-red-600 border border-red-100 rounded-xl text-sm font-bold active:scale-[0.98] transition-all flex items-center justify-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined !text-[18px]">delete_sweep</span>
                        HAPUS SEMUA
                    </button>
                </div>
            </aside>

            <!-- Product Grid Area -->
            <div class="lg:col-span-3 relative">
                <!-- Sorting & Header Info -->
                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-sm font-semibold text-gray-500">
                        Menampilkan katalog donasi hasil restorasi terbaik
                    </p>
                    <div class="flex items-center gap-2 self-end sm:self-auto">
                        <label for="sort-dropdown" class="text-xs font-bold text-gray-500 uppercase whitespace-nowrap">Urutkan:</label>
                        <select id="sort-dropdown" x-model="sort" @change="page = 1; setSort(sort)"
                                class="text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-xl px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none cursor-pointer shadow-sm">
                            <option value="">Terbaru (Default)</option>
                            <option value="harga_termurah">Harga Reparasi Termurah</option>
                            <option value="harga_termahal">Harga Reparasi Termahal</option>
                            <option value="rate_kelayakan">Rate Kelayakan (%)</option>
                        </select>
                    </div>
                </div>
                <!-- Loading Overlay -->
                <div x-show="loading" x-transition class="absolute inset-0 bg-white/70 z-10 flex items-center justify-center rounded-2xl" style="display: none;">
                    <div class="flex flex-col items-center gap-3">
                        <svg class="animate-spin h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-wider">Memuat data...</span>
                    </div>
                </div>

                <!-- Items Container -->
                <div id="item-grid-container">
                    @include('donatur.katalog.partials.item-grid', ['items' => $items])
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <div x-show="detailOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white rounded-2xl max-w-4xl w-full overflow-hidden relative shadow-2xl flex flex-col md:flex-row max-h-[90vh] md:max-h-none overflow-y-auto">
                <!-- Close Button -->
                <button class="absolute top-4 right-4 z-10 p-2 bg-white/95 rounded-full hover:bg-gray-100 border border-gray-200 flex items-center justify-center shadow-sm" @click="closeDetail()">
                    <span class="material-symbols-outlined text-gray-600">close</span>
                </button>
                
                <!-- Left Column: Photo View -->
                <div class="w-full md:w-1/2 bg-gray-50 p-6 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col space-y-4 justify-center">
                    <div class="flex-grow aspect-[4/3] rounded-xl border border-gray-200 overflow-hidden bg-white relative flex items-center justify-center p-4">
                        <img :src="activeImage" :alt="activeItem?.nama" class="max-h-full max-w-full object-contain">
                    </div>
                    <!-- Detail thumbs -->
                    <div class="flex gap-2 overflow-x-auto py-1">
                        <button @click="activeImage = activeItem ? activeItem.foto_utama_url : ''"
                                :class="activeImage === (activeItem ? activeItem.foto_utama_url : '') ? 'border-2 border-emerald-500' : 'border border-gray-200 hover:border-emerald-500'"
                                class="w-14 h-14 rounded-lg overflow-hidden bg-white flex-shrink-0 p-1 flex items-center justify-center">
                            <img :src="activeItem ? activeItem.foto_utama_url : ''" class="max-h-full max-w-full object-contain">
                        </button>
                        <template x-for="(photoUrl, idx) in activeItem?.foto_detail_urls" :key="idx">
                            <button @click="activeImage = photoUrl"
                                    :class="activeImage === photoUrl ? 'border-2 border-emerald-500' : 'border border-gray-200 hover:border-emerald-500'"
                                    class="w-14 h-14 rounded-lg overflow-hidden bg-white flex-shrink-0 p-1 flex items-center justify-center">
                                <img :src="photoUrl" class="max-h-full max-w-full object-contain">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Right Column: Detail Info -->
                <div class="w-full md:w-1/2 p-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest" x-text="activeItem?.brand"></span>
                            <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-full font-bold text-[10px] tracking-wide uppercase" x-text="activeItem?.kategori"></span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 leading-snug" x-text="activeItem?.nama"></h2>
                        
                        <div class="grid grid-cols-3 gap-3 border-t border-b border-gray-100 py-4 my-2">
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase">Kondisi</span>
                                <p class="text-sm font-bold text-gray-800 mt-0.5" x-text="activeItem ? formatCondition(activeItem.kondisi) : ''"></p>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase">Ukuran</span>
                                <p class="text-sm font-bold text-gray-800 mt-0.5" x-text="activeItem?.ukuran || '-'"></p>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase">Kuota Pengajuan</span>
                                <p class="text-sm font-bold mt-0.5" :class="activeItem?.is_quota_full ? 'text-red-650' : 'text-emerald-600'" x-text="activeItem ? (activeItem.pending_requests_count + '/5') : '0/5'"></p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 pt-2">
                            <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Catatan Kurator</h4>
                            <p class="text-sm text-gray-500 leading-relaxed font-normal" x-text="activeItem?.deskripsi || '-'"></p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 mt-6 flex flex-col gap-3">
                        <template x-if="activeItem?.is_quota_full && activeItem?.status === 'tersedia'">
                            <div class="p-3 bg-amber-50 text-amber-700 text-xs font-bold rounded-xl border border-amber-100 flex items-center gap-1.5 mb-2 leading-normal">
                                <span class="material-symbols-outlined !text-[16px] text-amber-600 shrink-0">info</span>
                                Item donasi ini dalam proses pengajuan.
                            </div>
                        </template>

                        <button class="w-full py-3.5 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 active:scale-[0.98] transition-all flex items-center justify-center gap-2 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed"
                                :disabled="activeItem?.status !== 'tersedia' || activeItem?.is_quota_full"
                                @click="openForm()">
                            <span class="material-symbols-outlined !text-[16px]">send</span>
                            <span x-text="activeItem?.is_quota_full && activeItem?.status === 'tersedia' ? 'Dalam Proses Pengajuan' : 'Ajukan Permohonan'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Form Modal -->
        <div x-show="formOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
                <button class="absolute top-4 right-4 p-2 rounded-full hover:bg-gray-100" @click="closeForm()">
                    <span class="material-symbols-outlined text-gray-600">close</span>
                </button>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Form Pengajuan Barang</h3>
                <p class="text-xs text-gray-500 mb-6">Lengkapi data berikut untuk mengirimkan permohonan donasi.</p>
                
                <form class="space-y-4" @submit.prevent="submitRequest">
                    <div x-show="generalError" x-text="generalError" class="p-3 bg-red-50 text-red-600 text-xs font-semibold rounded-xl border border-red-100" style="display: none;"></div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Lengkap Pemohon</label>
                        <input class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                               type="text" x-model="form.nama_pemohon" required placeholder="Contoh: Budi Santoso"/>
                        <span x-show="errors.nama_pemohon" x-text="errors.nama_pemohon" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Email Aktif</label>
                        <input class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                               type="email" x-model="form.email" required placeholder="Contoh: budi@gmail.com"/>
                        <span x-show="errors.email" x-text="errors.email" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Nomor WhatsApp</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-xs font-black text-gray-400 select-none">+62</span>
                            <input class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                                   type="tel" x-model="form.kontak_pemohon" required placeholder="8123456789"/>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1 font-semibold">Tulis tanpa angka 0 atau +62 di depan</p>
                        <span x-show="errors.kontak_pemohon" x-text="errors.kontak_pemohon" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Alamat Lengkap Pengiriman</label>
                        <textarea class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                                  rows="3" x-model="form.alamat_pengiriman" required placeholder="Alamat lengkap jalan, nomor, RT/RW, kecamatan..."></textarea>
                        <span x-show="errors.alamat_pengiriman" x-text="errors.alamat_pengiriman" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Alasan Mengajukan Donasi</label>
                        <textarea class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-55 text-sm"
                                  rows="3" x-model="form.alasan" required placeholder="Jelaskan mengapa Anda membutuhkan barang ini..."></textarea>
                        <span x-show="errors.alasan" x-text="errors.alasan" class="text-xs text-red-600 mt-1 block font-semibold" style="display: none;"></span>
                    </div>
                    
                    <button class="w-full py-4 bg-emerald-500 text-white rounded-xl font-bold text-sm hover:bg-emerald-600 active:scale-[0.99] transition-all shadow-md shadow-emerald-500/10 mt-6 flex items-center justify-center gap-2"
                            type="submit" :disabled="submitting">
                        <span x-show="!submitting">Kirim Pengajuan</span>
                        <span x-show="submitting" class="flex items-center gap-1.5" style="display: none;">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Success Message Modal -->
        <div x-show="successOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" style="display: none;" x-cloak>
            <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl text-center space-y-4 border border-gray-100">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
                    <span class="material-symbols-outlined !text-[40px]">check_circle</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Pengajuan Berhasil!</h3>
                    <p class="text-xs text-gray-500 mt-2 leading-relaxed">Data Anda telah kami simpan. Hubungi WhatsApp Admin untuk memverifikasi dan mempercepat proses pengiriman.</p>
                </div>
                <a class="w-full py-4 bg-[#25D366] text-white rounded-xl text-sm font-bold hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-2 shadow-sm"
                   :href="whatsappUrl" target="_blank">
                    Hubungi via WhatsApp
                </a>
                <button class="text-xs text-gray-500 hover:underline" @click="closeAll()">Kembali ke Katalog</button>
            </div>
        </div>
    </div>

    <script>
    function catalogApp() {
        return {
            search: '',
            categories: [],
            condition: '',
            status: '',
            minPrice: 0,
            maxPrice: {{ $maxPriceLimit }},
            maxPriceLimit: {{ $maxPriceLimit }},
            sort: '',
            page: 1,
            mobileFilterOpen: false,
            loading: false,
            detailOpen: false,
            formOpen: false,
            successOpen: false,
            submitting: false,
            whatsappUrl: '#',
            activeItem: null,
            activeImage: '',
            
            form: {
                nama_pemohon: '',
                kontak_pemohon: '',
                alamat_pengiriman: ''
            },
            errors: {
                nama_pemohon: '',
                kontak_pemohon: '',
                alamat_pengiriman: ''
            },
            generalError: '',

            debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            },

            initApp() {
                const urlParams = new URLSearchParams(window.location.search);
                this.search = urlParams.get('search') || '';
                
                const catParam = urlParams.get('category');
                if (catParam) {
                    if (catParam === 'none') {
                        this.categories = [];
                    } else {
                        this.categories = catParam.split(',').filter(c => c !== '');
                    }
                } else {
                    this.categories = ['sepatu', 'tas', 'topi'];
                }
                
                this.condition = urlParams.get('condition') || '';
                this.status = urlParams.get('status') || '';
                this.minPrice = urlParams.get('min_price') ? parseInt(urlParams.get('min_price')) : 0;
                this.maxPrice = urlParams.get('max_price') ? parseInt(urlParams.get('max_price')) : this.maxPriceLimit;
                this.sort = urlParams.get('sort') || '';
                this.page = urlParams.get('page') ? parseInt(urlParams.get('page')) : 1;
                
                this.debouncedFetchFilter = this.debounce(() => {
                    this.fetchFilter();
                    this.updateUrl();
                }, 300);
                
                window.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeDetail();
                        this.closeForm();
                    }
                });

                // Listen to browser Back/Forward navigation (history popstate)
                window.addEventListener('popstate', () => {
                    const params = new URLSearchParams(window.location.search);
                    this.search = params.get('search') || '';
                    const cat = params.get('category');
                    if (cat) {
                        this.categories = cat === 'none' ? [] : cat.split(',').filter(c => c !== '');
                    } else {
                        this.categories = ['sepatu', 'tas', 'topi'];
                    }
                    this.condition = params.get('condition') || '';
                    this.status = params.get('status') || '';
                    this.minPrice = params.get('min_price') ? parseInt(params.get('min_price')) : 0;
                    this.maxPrice = params.get('max_price') ? parseInt(params.get('max_price')) : this.maxPriceLimit;
                    this.sort = params.get('sort') || '';
                    this.page = params.get('page') ? parseInt(params.get('page')) : 1;
                    this.fetchFilter();
                });

                // Event delegation for Load More button clicks
                const gridContainer = document.getElementById('item-grid-container');
                if (gridContainer) {
                    gridContainer.addEventListener('click', (e) => {
                        const btn = e.target.closest('#load-more-btn');
                        if (btn) {
                            e.preventDefault();
                            const nextPage = parseInt(btn.getAttribute('data-next-page'));
                            if (nextPage) {
                                this.page = nextPage;
                                this.fetchFilter(true);
                                this.updateUrl();
                            }
                        }
                    });
                }
            },

            formatCondition(cond) {
                const map = {
                    'baru': '🆕 Baru',
                    'seperti_baru': '✨ Seperti Baru',
                    'sudah_diperbaiki': '🔧 Refurbished'
                };
                return map[cond] || cond;
            },

            async fetchFilter(isAppend = false) {
                this.loading = true;
                try {
                    const url = new URL("{{ route('donatur.katalog.filter') }}", window.location.origin);
                    if (this.search) url.searchParams.set('search', this.search);
                    
                    if (this.categories.length === 0) {
                        url.searchParams.set('category', 'none');
                    } else if (this.categories.length < 3) {
                        url.searchParams.set('category', this.categories.join(','));
                    }
                    
                    if (this.condition) url.searchParams.set('condition', this.condition);
                    if (this.status) url.searchParams.set('status', this.status);
                    
                    const minVal = parseInt(this.minPrice);
                    if (!isNaN(minVal) && minVal > 0) url.searchParams.set('min_price', minVal);
                    
                    const maxVal = parseInt(this.maxPrice);
                    if (!isNaN(maxVal) && maxVal < this.maxPriceLimit) url.searchParams.set('max_price', maxVal);
                    
                    if (this.sort) url.searchParams.set('sort', this.sort);
                    if (this.page && this.page > 1) url.searchParams.set('page', this.page);

                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        const html = await response.text();
                        if (isAppend) {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newGrid = doc.querySelector('.grid');
                            const existingGrid = document.querySelector('#item-grid-container .grid');
                            if (newGrid && existingGrid) {
                                Array.from(newGrid.children).forEach(card => {
                                    existingGrid.appendChild(card);
                                });
                            }
                            const newContainer = doc.getElementById('load-more-container');
                            const existingContainer = document.getElementById('load-more-container');
                            if (newContainer && existingContainer) {
                                existingContainer.replaceWith(newContainer);
                            }
                        } else {
                            document.getElementById('item-grid-container').innerHTML = html;
                        }
                    } else {
                        console.error('Filtering failed');
                    }
                } catch (err) {
                    console.error('Connection error:', err);
                } finally {
                    this.loading = false;
                }
            },

            updateUrl() {
                const url = new URL(window.location.href);
                if (this.search) {
                    url.searchParams.set('search', this.search);
                } else {
                    url.searchParams.delete('search');
                }
                
                if (this.categories.length === 0) {
                    url.searchParams.set('category', 'none');
                } else if (this.categories.length < 3) {
                    url.searchParams.set('category', this.categories.join(','));
                } else {
                    url.searchParams.delete('category');
                }
                
                if (this.condition) {
                    url.searchParams.set('condition', this.condition);
                } else {
                    url.searchParams.delete('condition');
                }
                
                if (this.status) {
                    url.searchParams.set('status', this.status);
                } else {
                    url.searchParams.delete('status');
                }
                
                const minVal = parseInt(this.minPrice);
                if (!isNaN(minVal) && minVal > 0) {
                    url.searchParams.set('min_price', minVal);
                } else {
                    url.searchParams.delete('min_price');
                }
                
                const maxVal = parseInt(this.maxPrice);
                if (!isNaN(maxVal) && maxVal < this.maxPriceLimit) {
                    url.searchParams.set('max_price', maxVal);
                } else {
                    url.searchParams.delete('max_price');
                }
                
                if (this.sort) {
                    url.searchParams.set('sort', this.sort);
                } else {
                    url.searchParams.delete('sort');
                }
                
                if (this.page && this.page > 1) {
                    url.searchParams.set('page', this.page);
                } else {
                    url.searchParams.delete('page');
                }
                
                window.history.pushState({}, '', url.toString());
            },

            toggleCategory(cat) {
                this.page = 1;
                if (this.categories.includes(cat)) {
                    this.categories = this.categories.filter(c => c !== cat);
                } else {
                    this.categories.push(cat);
                }
                this.updateCategoryFilter();
            },

            updateCategoryFilter() {
                this.page = 1;
                this.fetchFilter();
                this.updateUrl();
            },

            setCondition(cond) {
                this.page = 1;
                this.condition = cond;
                this.fetchFilter();
                this.updateUrl();
            },

            setStatus(stat) {
                this.page = 1;
                this.status = stat;
                this.fetchFilter();
                this.updateUrl();
            },

            setSort(sortVal) {
                this.page = 1;
                this.sort = sortVal;
                this.fetchFilter();
                this.updateUrl();
            },

            clearAll() {
                this.search = '';
                this.categories = ['sepatu', 'tas', 'topi'];
                this.condition = '';
                this.status = '';
                this.minPrice = 0;
                this.maxPrice = this.maxPriceLimit;
                this.sort = '';
                this.page = 1;
                this.mobileFilterOpen = false;
                this.fetchFilter();
                this.updateUrl();
            },

            formatRupiah(val) {
                return 'Rp ' + new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(val);
            },

            openDetail(item) {
                this.activeItem = item;
                this.activeImage = item.foto_utama_url;
                this.detailOpen = true;
            },

            closeDetail() {
                this.detailOpen = false;
            },

            openForm() {
                this.detailOpen = false;
                this.formOpen = true;
                this.generalError = '';
                this.errors = { nama_pemohon: '', email: '', kontak_pemohon: '', alamat_pengiriman: '', alasan: '' };
                
                this.form.nama_pemohon = "{{ Auth::user()->name }}";
                this.form.email = "{{ Auth::user()->email }}";
                this.form.kontak_pemohon = "{{ Auth::user()->phone ? (str_starts_with(Auth::user()->phone, '62') ? substr(Auth::user()->phone, 2) : Auth::user()->phone) : '' }}";
            },

            closeForm() {
                this.formOpen = false;
                this.resetFormFields();
            },

            resetFormFields() {
                this.form = { nama_pemohon: '', email: '', kontak_pemohon: '', alamat_pengiriman: '', alasan: '' };
                this.errors = { nama_pemohon: '', email: '', kontak_pemohon: '', alamat_pengiriman: '', alasan: '' };
                this.generalError = '';
            },

            closeAll() {
                this.successOpen = false;
                this.formOpen = false;
                this.detailOpen = false;
                this.resetFormFields();
            },

            async submitRequest() {
                this.submitting = true;
                this.generalError = '';
                this.errors = { nama_pemohon: '', email: '', kontak_pemohon: '', alamat_pengiriman: '', alasan: '' };

                try {
                    const url = `/donatur/katalog/${this.activeItem.id}/request`;
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.form)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.formOpen = false;
                        this.successOpen = true;
                        this.whatsappUrl = data.redirect_url;
                        
                        this.activeItem.status = 'disalurkan';
                        this.fetchFilter();

                        setTimeout(() => {
                            window.open(data.redirect_url, '_blank');
                        }, 800);
                    } else if (response.status === 422) {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(key => {
                                this.errors[key] = data.errors[key][0];
                            });
                        } else {
                            this.generalError = data.message || 'Validasi gagal. Harap periksa form Anda.';
                        }
                    } else {
                        this.generalError = data.message || 'Gagal memproses pengajuan. Silakan coba lagi.';
                    }
                } catch (err) {
                    console.error('Submission error:', err);
                    this.generalError = 'Terjadi gangguan jaringan. Pastikan Anda terhubung ke internet.';
                } finally {
                    this.submitting = false;
                }
            }
        }
    }
    </script>
</x-donatur-layout>
