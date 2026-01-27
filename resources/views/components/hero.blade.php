@if($hero)
<section class="relative bg-white pt-10 pb-20 lg:pt-16 lg:pb-32 overflow-hidden">
    <div class="max-width-site max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
            
            <!-- Left Side: Content -->
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-7 lg:text-left z-10 relative">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-green-50 border border-green-100 mb-6">
                    <span class="w-2 h-2 rounded-full bg-[#22AF85] mr-2 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wide text-[#22AF85] uppercase">Best Shoe Care in Town</span>
                </div>
                <h1 class="text-4xl tracking-tight font-extrabold text-[#1F2937] sm:text-5xl md:text-6xl leading-tight mb-6">
                    {{ $hero->title }}
                </h1>
                <p class="mt-4 text-lg text-gray-500 sm:text-xl max-w-lg leading-relaxed mb-10">
                    {{ $hero->subtitle }}
                </p>
                <div class="flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-4">
                    <a href="{{ $hero->primary_cta_link }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-gray-900 bg-[#FFC232] hover:bg-[#e6ae2d] shadow-lg shadow-yellow-200 transition-all duration-300 transform hover:-translate-y-1">
                        {{ $hero->primary_cta_text }}
                    </a>
                    <a href="{{ $hero->secondary_cta_link }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-100 text-base font-bold rounded-xl text-gray-600 bg-white hover:border-[#22AF85] hover:text-[#22AF85] transition-all duration-300">
                        {{ $hero->secondary_cta_text }}
                    </a>
                </div>
            </div>

            <!-- Right Side: Image with Fade -->
            <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-5 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[500px]">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img class="w-full h-auto object-cover" src="{{ $hero->image ? asset('storage/' . $hero->image) : 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=800&q=80' }}" alt="Workshop Image">
                        <!-- Horizontal Fade for Desktop -->
                        <div class="absolute inset-y-0 left-0 w-1/4 bg-gradient-to-r from-white to-transparent hidden lg:block"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
