@php
    $waNum = $settings['whatsapp_number'] ?? '';
    $waMsg = "Halo Shoe Workshop, saya ingin bertanya mengenai proses kerja perawatan/reparasi sepatu saya.";
    $waUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $waNum) . "?text=" . urlencode($waMsg);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-start">
    {{-- Left Panel --}}
    <div class="text-center md:text-left flex flex-col items-center md:items-start">
        <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase mb-4">Proses Kerja</p>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17] mb-8 leading-tight">Bagaimana Kami Merawat Sepatu Anda?</h2>
        <p class="text-gray-500 text-sm sm:text-base leading-relaxed mb-12">
            Kami menjaga transparansi di setiap langkah. Mulai dari konsultasi awal hingga pengiriman kembali, Anda akan selalu mendapatkan update status pengerjaan.
        </p>
        
        {{-- Clickable WhatsApp Question Card --}}
        <a href="{{ $waUrl }}" target="_blank" class="block w-full max-w-md bg-white p-8 rounded-2xl border border-dashed border-gray-200 hover:border-[#22AF85] hover:shadow-lg transition-all duration-300 group cursor-pointer">
            <div class="flex items-center justify-center md:justify-start gap-4">
                <div class="w-12 h-12 bg-[#22AF85] rounded-full flex items-center justify-center text-white flex-shrink-0 group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined">chat</span>
                </div>
                <div class="text-left">
                    <h4 class="font-bold text-[#1c1c17] text-sm sm:text-base group-hover:text-[#22AF85] transition-colors">Ada Pertanyaan?</h4>
                    <p class="text-gray-500 text-xs sm:text-sm">Hubungi CS via WhatsApp untuk konsultasi cepat.</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Right Steps Timeline --}}
    <div class="relative flex flex-col gap-0">
        @foreach($workflow as $i => $step)
        @php
        $descs = [
            'Kirimkan foto kondisi sepatu Anda via WhatsApp. CS kami akan memberikan analisa awal dan estimasi biaya secara gratis.',
            'Antar sepatu ke workshop kami atau gunakan jasa pickup. Kami akan melakukan pengecekan material dan struktur secara langsung.',
            'Dikerjakan oleh artisan berpengalaman menggunakan tools profesional dan bahan kimia premium yang aman untuk material sepatu.',
            'Setiap sepatu wajib melewati 3 tahap pengecekan kualitas sebelum dinyatakan selesai dan siap dikirim kembali ke Anda.',
            'Sepatu Anda sudah seperti baru! Kami akan mengirimkan foto hasil akhir sebelum melakukan pengiriman atau penjadwalan kurir.',
        ];
        $isLast = $i === count($workflow) - 1;
        @endphp
        <div class="relative flex flex-row gap-4 md:gap-6 group {{ !$isLast ? 'pb-12' : '' }} items-start text-left">
            @if(!$isLast)
            {{-- Connecting line segment --}}
            <div class="absolute left-[19px] md:left-[-33px] top-10 bottom-0 w-[2px] bg-gray-200 z-0"></div>
            @endif
            
            {{-- Circle with Emoji from Database --}}
            <div class="w-10 h-10 bg-white border-2 border-[#22AF85] rounded-full flex items-center justify-center z-10 text-lg shadow-sm shrink-0 md:absolute md:-left-[53px]">
                {{ $step->icon }}
            </div>
            <div class="pt-1 md:pt-0">
                <h4 class="font-bold text-sm sm:text-base text-[#1c1c17] mb-2 group-hover:text-[#22AF85] transition-colors">
                    {{ $step->title }}
                </h4>
                <p class="text-gray-500 text-xs sm:text-sm leading-relaxed">
                    {{ !empty($step->description) ? $step->description : ($descs[$i] ?? '') }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>