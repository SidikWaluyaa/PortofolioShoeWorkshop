@if($hero)
<section class="relative bg-white pt-12 pb-24 lg:pt-20 lg:pb-36 overflow-hidden">
    <!-- Background Glow (Desktop Only for Performance) -->
    <div class="hidden lg:block absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[600px] h-[600px] bg-green-50 rounded-full blur-[120px] opacity-60"></div>
    
    <div class="max-width-site max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center text-center lg:text-left">
            
            <!-- Left Side: Content -->
            <div class="lg:col-span-7 z-10">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-green-50 border border-green-100 mb-8 mx-auto lg:mx-0">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#22AF85] mr-3 animate-pulse"></span>
                    <span class="text-[10px] sm:text-xs font-black tracking-[0.2em] text-[#22AF85] uppercase">Best Shoe Care in Town</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-gray-900 leading-[1.1] mb-8 tracking-tighter">
                    {{ $hero->title }}
                </h1>
                
                <p class="text-lg sm:text-xl text-gray-500 max-w-2xl mx-auto lg:mx-0 leading-relaxed mb-12">
                    {{ $hero->subtitle }}
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-5">
                    <a href="{{ $hero->primary_cta_link }}" class="inline-flex items-center justify-center px-10 py-5 bg-[#FFC232] text-gray-900 text-sm sm:text-base font-black rounded-2xl shadow-xl shadow-yellow-200 hover:shadow-2xl hover:-translate-y-1 active:scale-95 transition-all duration-300">
                        {{ $hero->primary_cta_text }}
                        <svg class="ml-3 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                    <a href="{{ $hero->secondary_cta_link }}" class="inline-flex items-center justify-center px-10 py-5 bg-white border-2 border-gray-100 text-gray-600 text-sm sm:text-base font-black rounded-2xl hover:border-[#22AF85] hover:text-[#22AF85] transition-all duration-300">
                        {{ $hero->secondary_cta_text }}
                    </a>
                </div>
            </div>

            <!-- Right Side: Image with Polish -->
            <div class="mt-16 lg:mt-0 lg:col-span-5 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[480px]">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-[#22AF85]/10 to-[#FFC232]/10 rounded-[40px] blur-2xl"></div>
                    <div class="relative aspect-[4/5] rounded-[32px] overflow-hidden shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] border-8 border-white">
                        <img class="w-full h-full object-cover transform hover:scale-105 transition duration-700" src="{{ $hero->image ? asset('storage/' . $hero->image) : 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=800&q=80' }}" alt="Workshop Image">
                        <!-- Horizontal Fade for Desktop -->
                        <div class="absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-white/20 to-transparent hidden lg:block"></div>
                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-2xl border border-gray-50 hidden sm:flex items-center gap-4 animate-bounce-slow">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <div>
                            <p class="text-xs font-black text-gray-900 uppercase tracking-widest leading-none mb-1">Guaranteed</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Premium Service</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
