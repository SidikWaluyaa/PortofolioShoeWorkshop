<footer class="bg-[#1F2937] text-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 border-b border-white/5 pb-20 mb-12">
            <!-- Brand Column -->
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-8 group">
                    <x-application-logo class="h-10 w-auto" />
                    <span class="text-xl font-black tracking-tighter uppercase">SHOE <span class="text-[#22AF85]">WORKSHOP</span></span>
                </a>
                <p class="text-sm text-gray-400 leading-loose max-w-xs font-medium">
                    {{ $settings['site_description'] ?? 'Layanan reparasi sepatu profesional di kota Anda. Cepat, tepat, dan terpercaya.' }}
                </p>
            </div>

            <!-- Links Column -->
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-white/40 mb-8 pb-4 border-b border-white/5 inline-block">Tautan Cepat</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}#services" class="text-sm font-black text-gray-400 hover:text-[#22AF85] transition-all flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-[#22AF85] opacity-0 group-hover:opacity-100 transition-opacity"></span>Layanan Kami</a></li>
                    <li><a href="{{ route('home') }}#portfolio" class="text-sm font-black text-gray-400 hover:text-[#22AF85] transition-all flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-[#22AF85] opacity-0 group-hover:opacity-100 transition-opacity"></span>Portfolio</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-sm font-black text-gray-400 hover:text-[#22AF85] transition-all flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-[#22AF85] opacity-0 group-hover:opacity-100 transition-opacity"></span>Cobbler's Journal</a></li>
                    <li><a href="{{ route('home') }}#about" class="text-sm font-black text-gray-400 hover:text-[#22AF85] transition-all flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-[#22AF85] opacity-0 group-hover:opacity-100 transition-opacity"></span>Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-white/40 mb-8 pb-4 border-b border-white/5 inline-block">Kontak Kami</h4>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4 text-gray-400">
                        <div class="mt-1 w-5 h-5 flex-shrink-0 text-[#22AF85]"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                        <span class="text-xs font-bold leading-relaxed">{{ $settings['address'] ?? 'Jl. Shoe Workshop No. 1' }}</span>
                    </li>
                    <li class="flex items-center gap-4 text-gray-400">
                        <div class="w-5 h-5 flex-shrink-0 text-[#22AF85]"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 004.516 4.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></div>
                        <span class="text-xs font-black tracking-widest">{{ $settings['whatsapp_number'] ?? '-' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Social Column -->
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-white/40 mb-8 pb-4 border-b border-white/5 inline-block">Follow Us</h4>
                <div class="flex gap-4">
                    <a href="{{ $settings['instagram_link'] ?? '#' }}" class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-gray-400 hover:bg-[#22AF85] hover:text-white hover:shadow-lg hover:shadow-green-500/20 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.53c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                    </a>
                    <a href="{{ $settings['tiktok_link'] ?? '#' }}" class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-gray-400 hover:bg-[#22AF85] hover:text-white hover:shadow-lg hover:shadow-green-500/20 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M16.25 2H13v14.75c0 2.9-2.35 5.25-5.25 5.25S2.5 19.65 2.5 16.75 4.85 11.5 7.75 11.5c.73 0 1.41.15 2.03.43V8.2c-.65-.18-1.33-.28-2.03-.28-4.83 0-8.75 3.92-8.75 8.75s3.92 8.75 8.75 8.75 8.75-3.92 8.75-8.75 8.75-3.92 8.75-8.75v-8.58c1.72 1.22 3.8 1.94 6.03 1.94v-3.5c-2.8 0-5.22-1.6-6.28-3.96z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs font-black uppercase tracking-widest text-gray-500">&copy; {{ date('Y') }} Shoe Workshop Indonesia. All rights reserved.</p>
            <div class="flex gap-8">
                <a href="/login" class="text-xs font-black uppercase tracking-widest text-gray-500 hover:text-white transition-colors">Admin Login</a>
            </div>
        </div>
    </div>
</footer>
