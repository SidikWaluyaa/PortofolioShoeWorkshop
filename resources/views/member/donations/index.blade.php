<x-member-layout>
    <x-slot name="header">Donasi Saya</x-slot>

    <div x-data="{
        showModal: false,
        donationId: '',
        metodePengiriman: 'ekspedisi',
        namaEkspedisi: '',
        noResi: '',
        updateUrl: '',
        openResiModal(id, metode, ekspedisi, resi, url) {
            this.donationId = id;
            this.metodePengiriman = metode || 'antar_langsung';
            this.namaEkspedisi = ekspedisi || '';
            this.noResi = resi || '';
            this.updateUrl = url;
            this.showModal = true;
        }
    }">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <p class="text-sm text-gray-500">Pantau donasi sepatumu dan selesaikan langkah berikutnya di sini.</p>
            <a href="{{ route('member.donations.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-500/25">
                <span class="material-symbols-outlined !text-[18px]">add</span>
                Donasi Baru
            </a>
        </div>

        @if($donations->isEmpty())
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10 sm:p-12 text-center">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-emerald-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-400 !text-[40px]">volunteer_activism</span>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2">Belum ada donasi</h3>
                <p class="text-sm text-gray-500 max-w-md mx-auto">Punya sepatu yang masih layak tapi sudah tidak dipakai? Kami restorasi dan salurkan ke pemilik baru. Kami menerima sepatu dengan kelayakan di atas {{ \App\Models\Donation::MIN_KONDISI }}%.</p>
                <a href="{{ route('member.donations.create') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-emerald-500 text-white text-sm font-bold rounded-xl hover:bg-emerald-600 transition">Donasikan Sepatu Pertama</a>
            </div>
        @else
            @php
                $steps = ['Diajukan', 'Disetujui', 'Dikirim', 'Diterima', 'Restorasi', 'Selesai'];
                $address = $globalSettings['address'] ?? 'Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung';
                $tones = [
                    'amber'   => ['box' => 'bg-amber-50 border-amber-200', 'icon' => 'bg-amber-500', 'title' => 'text-amber-900', 'text' => 'text-amber-800'],
                    'purple'  => ['box' => 'bg-purple-50 border-purple-200', 'icon' => 'bg-purple-600', 'title' => 'text-purple-900', 'text' => 'text-purple-800'],
                    'blue'    => ['box' => 'bg-blue-50 border-blue-200', 'icon' => 'bg-blue-600', 'title' => 'text-blue-900', 'text' => 'text-blue-800'],
                    'emerald' => ['box' => 'bg-emerald-50 border-emerald-200', 'icon' => 'bg-[#22AF85]', 'title' => 'text-emerald-900', 'text' => 'text-emerald-800'],
                    'red'     => ['box' => 'bg-red-50 border-red-100', 'icon' => 'bg-red-500', 'title' => 'text-red-900', 'text' => 'text-red-700'],
                ];
            @endphp

            <div class="grid grid-cols-1 gap-5">
                @foreach($donations as $donation)
                    @php
                        $shipped = $donation->hasChosenShipping();
                        // Index of the current step; null for rejected, count($steps) when everything is done
                        $current = match ($donation->status) {
                            'pending' => 0,
                            'disetujui' => $shipped ? 2 : 1,
                            'diterima' => 4,
                            'siap_rilis' => 5,
                            'masuk_katalog', 'disalurkan' => count($steps),
                            default => null,
                        };
                        $resiArgs = "'{$donation->id}', " . \Illuminate\Support\Js::from($shipped ? $donation->metode_pengiriman : '') . ', ' . \Illuminate\Support\Js::from($donation->nama_ekspedisi) . ', ' . \Illuminate\Support\Js::from($donation->no_resi) . ', ' . \Illuminate\Support\Js::from(route('member.donations.update-resi', $donation));
                        $catalogItem = $donation->donationItem;

                        // [tone, icon, title, description, cta label, cta href or null, cta is the shipping modal, primary]
                        $next = match (true) {
                            $donation->status === 'pending' => ['blue', 'manage_search', 'Sedang ditinjau tim kami',
                                'Kami cek foto dan kondisi sepatumu, biasanya 1–2 hari kerja. Selama masih ditinjau, kamu masih bisa mengubah datanya.',
                                'Ubah Data Donasi', route('member.donations.edit', $donation), false, false],
                            $donation->status === 'disetujui' && !$shipped => ['amber', 'local_shipping', 'Disetujui! Kirim sepatumu ke workshop',
                                'Antar langsung atau kirim lewat ekspedisi ke ' . $address . ' (Senin–Sabtu, 09.00–17.00 WIB). Setelah dikirim, isi cara pengirimannya di sini.',
                                'Isi Cara Pengiriman', null, true, true],
                            $donation->status === 'disetujui' => ['purple', 'local_shipping', 'Sepatumu dalam perjalanan',
                                $donation->metode_pengiriman === 'antar_langsung'
                                    ? 'Kamu memilih antar langsung ke workshop (Senin–Sabtu, 09.00–17.00 WIB). Kami kabari begitu sepatu kami terima.'
                                    : 'Dikirim lewat ' . ($donation->nama_ekspedisi ?: 'ekspedisi') . ', resi ' . $donation->no_resi . '. Kami kabari begitu sepatu kami terima.',
                                'Ubah Info Pengiriman', null, true, false],
                            $donation->status === 'diterima' => ['emerald', 'construction', 'Sepatumu sudah kami terima',
                                'Terima kasih! Sepatumu sedang direstorasi tim kami sebelum masuk Katalog Adopsi.', null, null, false, false],
                            $donation->status === 'siap_rilis' => ['emerald', 'auto_awesome', 'Restorasi selesai',
                                'Sepatumu sudah selesai direstorasi dan segera tampil di Katalog Adopsi.', null, null, false, false],
                            $donation->status === 'masuk_katalog' => ['emerald', 'storefront', 'Sepatumu sudah di Katalog Adopsi',
                                'Sepatumu sudah direstorasi dan siap diadopsi pemilik baru. Terima kasih sudah berbagi!',
                                $catalogItem ? 'Lihat di Katalog' : null, $catalogItem ? route('katalog.show', $catalogItem) : null, false, false],
                            $donation->status === 'disalurkan' => ['emerald', 'favorite', 'Sepatumu sudah punya pemilik baru',
                                'Sepatu donasimu sudah disalurkan. Terima kasih sudah memberi kesempatan kedua untuk sepatu ini!', null, null, false, false],
                            default => ['red', 'info', 'Donasi belum bisa kami terima',
                                'Kami hanya menerima sepatu dengan kelayakan di atas ' . \App\Models\Donation::MIN_KONDISI . '%. Kamu tetap bisa mendonasikan sepatu lain.',
                                'Donasikan Sepatu Lain', route('member.donations.create'), false, false],
                        };
                        [$toneKey, $icon, $title, $desc, $ctaLabel, $ctaUrl, $ctaModal, $primary] = $next;
                        $tone = $tones[$toneKey];

                        $canClaimReward = $hasDonationReward
                            && in_array($donation->status, \App\Models\Donation::REWARD_ELIGIBLE_STATUSES)
                            && !$donation->is_reward_claimed;
                    @endphp

                    <article class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                        {{-- Shoe summary --}}
                        <div class="flex items-center gap-4 p-4 sm:p-5">
                            <img src="{{ asset('storage/' . ($donation->foto_path[0] ?? '')) }}" alt="{{ $donation->nama_sepatu }}"
                                 class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-2xl border border-gray-200 bg-gray-50 flex-shrink-0">
                            <div class="min-w-0 flex-1">
                                <h3 class="font-black text-gray-900 text-[15px] sm:text-base leading-snug line-clamp-2">{{ $donation->nama_sepatu }}</h3>
                                <p class="text-[11px] font-bold text-gray-500 mt-1 uppercase tracking-wider truncate">
                                    {{ $donation->brand ? $donation->brand . ' • ' : '' }}Ukuran {{ $donation->ukuran }} • {{ $donation->kondisi_label ?? 'Kondisi ' . $donation->kondisi . '%' }}
                                </p>
                                <p class="text-[11px] text-gray-400 mt-0.5">{{ $donation->spk }} · {{ $donation->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>

                        {{-- Progress tracker --}}
                        @if($current !== null)
                            <div class="px-4 sm:px-5 pb-1">
                                <ol class="flex items-start">
                                    @foreach($steps as $index => $label)
                                        @php
                                            $done = $index < $current;
                                            $active = $index === $current;
                                        @endphp
                                        <li class="flex-1 flex flex-col items-center text-center relative">
                                            @if(!$loop->first)
                                                <span class="absolute top-[11px] right-1/2 w-full h-0.5 {{ $index <= $current ? 'bg-[#22AF85]' : 'bg-gray-200' }}"></span>
                                            @endif
                                            <span class="relative z-10 w-6 h-6 rounded-full flex items-center justify-center text-[11px] font-black
                                                {{ $done ? 'bg-[#22AF85] text-white' : ($active ? 'bg-white text-[#22AF85] ring-2 ring-[#22AF85]' : 'bg-gray-100 text-gray-400') }}">
                                                @if($done)
                                                    <span class="material-symbols-outlined !text-[14px]">check</span>
                                                @else
                                                    {{ $index + 1 }}
                                                @endif
                                            </span>
                                            <span class="mt-1.5 text-[10px] sm:text-[11px] leading-tight {{ $active ? 'font-black text-gray-900' : 'font-semibold text-gray-400' }}">{{ $label }}</span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif

                        {{-- What to do next --}}
                        <div class="p-4 sm:p-5">
                            <div class="rounded-2xl border p-4 {{ $tone['box'] }}">
                                <div class="flex items-start gap-3">
                                    <span class="w-8 h-8 rounded-full text-white flex items-center justify-center flex-shrink-0 {{ $tone['icon'] }}">
                                        <span class="material-symbols-outlined !text-[18px]">{{ $icon }}</span>
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-black {{ $tone['title'] }}">{{ $title }}</p>
                                        <p class="text-xs leading-relaxed mt-1 {{ $tone['text'] }}">{{ $desc }}</p>
                                        @if($donation->status === 'ditolak' && $donation->catatan_admin)
                                            <p class="text-xs leading-relaxed mt-2 {{ $tone['text'] }}"><span class="font-bold">Catatan tim:</span> {{ $donation->catatan_admin }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if($ctaModal)
                                    <button type="button" @click="openResiModal({{ $resiArgs }})"
                                            class="mt-4 w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold transition
                                                   {{ $primary ? 'bg-[#22AF85] hover:bg-[#1a936f] text-white shadow-sm' : 'bg-white hover:bg-gray-50 text-gray-800 border border-gray-200' }}">
                                        {{ $ctaLabel }}
                                        <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                                    </button>
                                @elseif($ctaLabel && $ctaUrl)
                                    <a href="{{ $ctaUrl }}"
                                       class="mt-4 w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold transition
                                              {{ $primary ? 'bg-[#22AF85] hover:bg-[#1a936f] text-white shadow-sm' : 'bg-white hover:bg-gray-50 text-gray-800 border border-gray-200' }}">
                                        {{ $ctaLabel }}
                                        <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                                    </a>
                                @endif

                                {{-- Only while management runs a donation reward --}}
                                @if($canClaimReward)
                                    <a href="{{ route('member.rewards.index') }}" class="mt-3 flex items-center justify-between gap-3 rounded-xl bg-white/80 border border-emerald-100 px-4 py-3 text-xs font-bold text-emerald-800 hover:bg-white transition">
                                        <span class="flex items-center gap-2"><span class="material-symbols-outlined !text-[18px] text-emerald-600">redeem</span>Donasi ini bisa ditukar dengan reward</span>
                                        <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $donations->links() }}
            </div>
        @endif

        {{-- Resi Modal --}}
        <div x-show="showModal" 
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;"
             x-keydown.escape.window="showModal = false">
            
            {{-- Backdrop --}}
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                 @click="showModal = false"></div>

            {{-- Container --}}
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-md border border-gray-100">
                    
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                        <h3 class="text-sm font-extrabold text-gray-900">Cara Pengiriman Sepatu</h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 p-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <form :action="updateUrl" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Metode Pengiriman <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="relative cursor-pointer" @click="metodePengiriman = 'antar_langsung'">
                                    <input type="radio" name="metode_pengiriman" value="antar_langsung" class="peer sr-only" x-model="metodePengiriman">
                                    <div class="p-3 rounded-xl border transition-all"
                                         :class="metodePengiriman === 'antar_langsung' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                                        <div class="text-center">
                                            <span class="material-symbols-outlined text-xl text-emerald-600 block mx-auto">home</span>
                                            <p class="text-xs font-bold text-gray-900 mt-1">Antar Langsung</p>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer" @click="metodePengiriman = 'ekspedisi'">
                                    <input type="radio" name="metode_pengiriman" value="ekspedisi" class="peer sr-only" x-model="metodePengiriman">
                                    <div class="p-3 rounded-xl border transition-all"
                                         :class="metodePengiriman === 'ekspedisi' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                                        <div class="text-center">
                                            <span class="material-symbols-outlined text-xl text-emerald-600 block mx-auto">local_shipping</span>
                                            <p class="text-xs font-bold text-gray-900 mt-1">Ekspedisi</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div x-show="metodePengiriman === 'antar_langsung'" x-transition class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-800">
                            <p class="font-bold mb-1">Antar ke:</p>
                            <p>{{ $globalSettings['address'] ?? 'Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung' }}</p>
                            <p class="mt-1">Senin–Sabtu, 09.00–17.00 WIB (Minggu tutup)</p>
                        </div>

                        <div x-show="metodePengiriman === 'ekspedisi'" x-transition class="space-y-4">
                            <div>
                                <label for="modal_nama_ekspedisi" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Ekspedisi <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ekspedisi" id="modal_nama_ekspedisi" x-model="namaEkspedisi" :required="metodePengiriman === 'ekspedisi'"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                       placeholder="Contoh: JNE, J&T, SiCepat">
                            </div>

                            <div>
                                <label for="modal_no_resi" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Resi <span class="text-red-500">*</span></label>
                                <input type="text" name="no_resi" id="modal_no_resi" x-model="noResi" :required="metodePengiriman === 'ekspedisi'"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                       placeholder="Masukkan nomor resi">
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="showModal = false" class="flex-1 py-2.5 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-100 transition">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-emerald-500/25">
                                Simpan Info Pengiriman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-member-layout>
