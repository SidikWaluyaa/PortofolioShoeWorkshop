<div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-start">
    {{-- Left Panel --}}
    <div>
        <p class="text-sm font-semibold text-[#22AF85] tracking-widest uppercase mb-4">Proses Kerja</p>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1c1c17] mb-8 leading-tight">Bagaimana Kami Merawat Sepatu Anda?</h2>
        <p class="text-gray-500 text-sm sm:text-base leading-relaxed mb-12">
            Kami menjaga transparansi di setiap langkah. Mulai dari konsultasi awal hingga pengiriman kembali, Anda akan selalu mendapatkan update status pengerjaan.
        </p>
        <div class="bg-white p-8 rounded-2xl border border-dashed border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#22AF85] rounded-full flex items-center justify-center text-white flex-shrink-0">
                    <span class="material-symbols-outlined">call</span>
                </div>
                <div>
                    <h4 class="font-semibold text-[#1c1c17] text-sm sm:text-base">Ada Pertanyaan?</h4>
                    <p class="text-gray-500 text-xs sm:text-sm">Tim teknis kami siap menjawab konsultasi Anda.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Steps Timeline --}}
    <div class="relative pl-12 md:pl-0">
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
        <div class="relative flex gap-6 group {{ !$isLast ? 'pb-12' : '' }}">
            @if(!$isLast)
            {{-- Connecting line segment --}}
            <div class="absolute left-[-33px] top-10 bottom-0 w-[2px] bg-gray-200 -translate-x-1/2 z-0"></div>
            @endif
            
            {{-- Circle with Emoji from Database --}}
            <div class="absolute -left-[53px] w-10 h-10 bg-white border-2 border-[#22AF85] rounded-full flex items-center justify-center z-10 text-lg shadow-sm">
                {{ $step->icon }}
            </div>
            <div>
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