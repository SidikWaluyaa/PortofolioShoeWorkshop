<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
    {{-- Left: Heading --}}
    <div>
        <p class="text-xs font-bold tracking-[0.2em] text-[#22AF85] uppercase mb-4">Cara Kerja</p>
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-gray-900 leading-tight mb-4">Bagaimana Kami Merawat Sepatu Anda?</h2>
        <p class="text-gray-500 text-sm leading-relaxed max-w-md">Proses reparasi kami yang terstruktur memastikan sepatu Anda mendapatkan penanganan terbaik dari awal hingga selesai.</p>
    </div>

    {{-- Right: Steps Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        @foreach($workflow as $i => $step)
        @php
        $descs = [
            'Kirim foto sepatu Anda via WhatsApp. Kami akan cek dan berikan estimasi.',
            'Antar ke workshop kami atau gunakan layanan pickup kami.',
            'Dikerjakan oleh tenaga ahli dengan material premium dan teliti.',
            'Sepatu kembali seperti baru dan siap dipakai kembali.',
        ];
        $colors = ['bg-[#22AF85]', 'bg-[#E74C3C]', 'bg-[#3498DB]', 'bg-[#F39C12]'];
        @endphp
        <div class="group bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 hover:shadow-lg hover:border-[#22AF85]/20 hover:-translate-y-1 transition-all duration-300">
            <div class="w-10 h-10 {{ $colors[$i] ?? 'bg-gray-400' }} rounded-xl flex items-center justify-center text-white font-black text-lg mb-4 shadow-md">
                {{ $i + 1 }}
            </div>
            <h3 class="font-bold text-gray-900 text-sm mb-2">{{ $step->title }}</h3>
            @if(!empty($step->description))
            <p class="text-xs text-gray-500 leading-relaxed">{{ $step->description }}</p>
            @else
            <p class="text-xs text-gray-500 leading-relaxed">{{ $descs[$i] ?? '' }}</p>
            @endif
        </div>
        @endforeach
    </div>
</div>