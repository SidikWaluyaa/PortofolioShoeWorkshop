<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center mb-6">
                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Total Portfolio</h4>
            <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['projects'] }}</p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 rounded-2xl bg-[#22AF85]/10 flex items-center justify-center mb-6">
                <svg class="h-6 w-6 text-[#22AF85]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Total Layanan</h4>
            <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['services'] }}</p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 rounded-2xl bg-[#FFC232]/10 flex items-center justify-center mb-6">
                <svg class="h-6 w-6 text-[#FFC232]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM12 9H7m5 4H7m8 4h-8"></path>
                </svg>
            </div>
            <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Artikel Berita</h4>
            <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['posts'] }}</p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 rounded-2xl bg-purple-50 flex items-center justify-center mb-6">
                <svg class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Langkah Workflow</h4>
            <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['workflows'] }}</p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 rounded-2xl bg-red-50 flex items-center justify-center mb-6">
                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h4 class="text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] mb-1">Trust Items</h4>
            <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $stats['trust_items'] }}</p>
        </div>
    </div>

    <div class="mt-12 bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm">
        <div class="flex items-center gap-4 mb-6">
            <div class="h-3 w-3 rounded-full bg-[#22AF85] animate-pulse"></div>
            <h3 class="text-xl font-black text-gray-900">Selamat datang kembali, {{ Auth::user()->name }}!</h3>
        </div>
        <p class="text-gray-500 leading-relaxed max-w-2xl">
            Panel admin Shoe Workshop sekarang lebih optimal dengan sistem **Sidebar Navigation** dan **Smart Scrolling**. Silakan gunakan menu di samping untuk memperbarui konten website Anda secara real-time.
        </p>
    </div>
</x-app-layout>
