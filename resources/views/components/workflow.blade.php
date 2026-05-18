<div class="space-y-6">
    @foreach($workflow as $i => $step)
    <div class="flex items-start gap-4">
        <div class="flex-shrink-0 w-12 h-12 rounded-full border-2 border-gray-200 bg-white flex items-center justify-center text-xl shadow-sm">
            {!! $step->icon !!}
        </div>
        <div class="pt-1">
            <p class="font-bold text-gray-900 text-sm mb-1">{{ $i + 1 }}. {{ $step->title }}</p>
            @if(!empty($step->description))
            <p class="text-xs text-gray-500 leading-relaxed">{{ $step->description }}</p>
            @else
            @php
            $descs = [
                'Kirim foto sepatu Anda via WhatsApp. Kami akan cek dan berikan estimasi.',
                'Antar ke workshop kami atau kami bisa pickup (Jabodetabek).',
                'Dikerjakan oleh tenaga ahli dengan material premium dan teliti.',
                'Sepatu kembali seperti baru dan siap dipakai kembali.',
            ];
            @endphp
            <p class="text-xs text-gray-500 leading-relaxed">{{ $descs[$i] ?? '' }}</p>
            @endif
        </div>
    </div>
    @if(!$loop->last)
    <div class="ml-6 w-px h-4 bg-gray-200"></div>
    @endif
    @endforeach
</div>