@extends('layouts.main')
@section('seo_title', 'Adapt & Adopt by ShoeWorkshop · Donasi dan Adopsi Sepatu')
@section('seo_description', 'Adapt & Adopt by ShoeWorkshop: donasikan sepatu yang sudah tidak kamu pakai, atau adopsi sepatu hasil restorasi dengan membayar biaya jasa reparasinya saja.')
@section('seo_keywords', 'adapt and adopt, adapt & adopt, donasi sepatu, adopsi sepatu, sepatu restorasi, shoeworkshop bandung')

@section('mobile_action_bar', '1')

@push('head')
    @include('layouts.partials.aa-fonts')
@endpush

@section('content')
@php
    $rupiah = fn ($n) => 'Rp ' . number_format($n, 0, ',', '.');
@endphp
<div class="bg-aa-white text-aa-ink min-h-screen flex flex-col">
    @include('layouts.navigation-public')

    <main class="flex-grow pt-16 sm:pt-20">
        {{-- Hero --}}
        <section class="bg-aa-green text-aa-beige">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20 grid lg:grid-cols-[1.1fr_1fr] gap-10 items-center">
                <div>
                    <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-sage">by ShoeWorkshop</p>
                    <h1 class="mt-4 font-aa text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05]">
                        Adapt the Mindset.<br>Give a Second Chance.
                    </h1>
                    <p class="mt-5 text-base sm:text-lg text-aa-beige/90 leading-relaxed max-w-xl">
                        Sepatu yang sudah nggak kamu pakai belum tentu kehilangan manfaatnya. Lewat Adapt &amp; Adopt, sepatu itu kami kurasi, kami perbaiki, lalu menemukan pemilik barunya.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('katalog.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-aa-burgundy hover:bg-aa-burgundy-dark text-aa-beige font-bold text-sm transition">
                            Lihat Katalog Adopsi <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                        </a>
                        <a href="{{ route('adapt-adopt.donasi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-aa-beige/40 hover:bg-aa-beige/10 text-aa-beige font-bold text-sm transition">
                            Donasikan Sepatu
                        </a>
                    </div>
                </div>
                <div class="flex justify-start lg:justify-end order-first lg:order-none">
                    <img src="{{ asset('images/adapt-adopt/adaptadopt_dark_beige_on_green.png') }}" alt="Logo Adapt & Adopt" width="820" height="500" class="w-full max-w-[180px] sm:max-w-xs lg:max-w-md">
                </div>
            </div>
        </section>

        {{-- Meaning of the name --}}
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
            <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-burgundy">Siapa kami</p>
            <h2 class="mt-3 font-aa text-3xl sm:text-4xl font-extrabold text-aa-green max-w-2xl leading-tight">Sesuatu yang sudah nggak kita butuhkan, belum tentu kehilangan manfaatnya.</h2>
            <p class="mt-4 text-aa-neutral leading-relaxed max-w-3xl">
                Adapt &amp; Adopt adalah inisiatif dari ShoeWorkshop untuk memberi sepatu kesempatan kedua lewat program donasi dan adopsi. Kami percaya barang yang rusak atau jarang dipakai tidak harus langsung dibuang. Banyak yang masih bisa dirawat, diperbaiki, dan dipakai lagi oleh orang lain.
            </p>
            <div class="mt-10 grid md:grid-cols-2 gap-5">
                <div class="rounded-3xl bg-aa-beige p-6 sm:p-8">
                    <h3 class="font-aa text-2xl font-extrabold text-aa-green">Adapt</h3>
                    <p class="mt-3 text-aa-ink/80 leading-relaxed">Dari <em>adaptation</em>: mengubah kebiasaan dan nggak terburu-buru membuang barang yang masih bernilai. Sekaligus dari <em>adab</em>: menghargai kerja perajin dan peduli pada orang lain yang membutuhkan.</p>
                </div>
                <div class="rounded-3xl bg-aa-beige p-6 sm:p-8">
                    <h3 class="font-aa text-2xl font-extrabold text-aa-green">Adopt</h3>
                    <p class="mt-3 text-aa-ink/80 leading-relaxed">Dari <em>adoption</em>: sepatu yang sudah nggak dibutuhkan pemilik lamanya menemukan pemilik baru, dan kembali menemani perjalanan seseorang.</p>
                </div>
            </div>
        </section>

        {{-- Two ways to take part --}}
        <section class="bg-white border-y border-aa-beige">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
                <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-burgundy">Cara ikut</p>
                <h2 class="mt-3 font-aa text-3xl sm:text-4xl font-extrabold text-aa-green">Dua cara memberi kesempatan kedua</h2>

                <div class="mt-10 grid lg:grid-cols-2 gap-6">
                    @foreach([
                        ['Donasi', 'volunteer_activism', 'Punya sepatu yang sudah lama nggak kamu pakai?', [
                            ['Ajukan sepatumu', 'Isi form donasi dan unggah foto sepatu dari 4 sisi.'],
                            ['Kurasi tim kami', 'Kami cek kelayakannya dari foto. Sepatu yang kami terima kondisinya minimal 70%.'],
                            ['Kirim atau antar', 'Kalau lolos kurasi, kirim lewat ekspedisi atau antar langsung ke store kami.'],
                            ['Kami perbaiki', 'Sepatu direparasi di workshop, lalu ditampilkan di Katalog Adopsi.'],
                        ], route('adapt-adopt.donasi.create'), 'Donasikan Sepatu'],
                        ['Adopsi', 'footprint', 'Cari sepatu yang siap menemani aktivitasmu?', [
                            ['Pilih dari katalog', 'Lihat kondisi, ukuran, dan biaya jasa reparasi setiap sepatu.'],
                            ['Ajukan dengan alasan', 'Ceritakan sepatu itu untuk siapa dan kenapa kamu membutuhkannya.'],
                            ['Tunggu hasil kurasi', 'Tim kami memilih satu penerima. Pemohon lain menjadi cadangan.'],
                            ['Bayar biaya jasanya', 'Kalau terpilih, bayar biaya jasa reparasi dalam 2×24 jam, lalu sepatu kami kirim.'],
                        ], route('katalog.index'), 'Lihat Katalog Adopsi'],
                    ] as [$title, $icon, $lead, $steps, $url, $cta])
                        <div class="rounded-3xl border border-aa-beige bg-aa-white p-6 sm:p-8 flex flex-col">
                            <div class="flex items-center gap-3">
                                <span class="w-11 h-11 rounded-2xl bg-aa-green text-aa-beige flex items-center justify-center">
                                    <span class="material-symbols-outlined">{{ $icon }}</span>
                                </span>
                                <h3 class="font-aa text-2xl font-extrabold text-aa-green">{{ $title }}</h3>
                            </div>
                            <p class="mt-4 text-aa-ink font-semibold">{{ $lead }}</p>
                            <ol class="mt-5 space-y-4 flex-1">
                                @foreach($steps as [$stepTitle, $stepDesc])
                                    <li class="flex gap-4">
                                        <span class="w-7 h-7 rounded-full bg-aa-beige text-aa-green text-sm font-black flex items-center justify-center flex-shrink-0">{{ $loop->iteration }}</span>
                                        <span>
                                            <span class="block font-bold text-aa-ink">{{ $stepTitle }}</span>
                                            <span class="block text-sm text-aa-neutral mt-0.5 leading-relaxed">{{ $stepDesc }}</span>
                                        </span>
                                    </li>
                                @endforeach
                            </ol>
                            <a href="{{ $url }}" class="mt-7 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-aa-green hover:bg-aa-green-dark text-aa-beige font-bold text-sm transition">
                                {{ $cta }} <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Catalog preview --}}
        @if($items->isNotEmpty())
            <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-burgundy">Katalog Adopsi</p>
                        <h2 class="mt-3 font-aa text-3xl sm:text-4xl font-extrabold text-aa-green">Sepatu yang menunggu pemilik baru</h2>
                        <p class="mt-2 text-aa-neutral">{{ $availableCount }} sepatu tersedia{{ $adoptedCount ? ', ' . $adoptedCount . ' sudah punya pemilik baru' : '' }}.</p>
                    </div>
                    <a href="{{ route('katalog.index') }}" class="inline-flex items-center gap-1 text-sm font-bold text-aa-burgundy hover:underline underline-offset-4">Lihat semua <span class="material-symbols-outlined !text-[18px]">arrow_forward</span></a>
                </div>
                <div class="mt-8 grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($items as $item)
                        <a href="{{ route('katalog.show', $item) }}" class="group rounded-2xl bg-white border border-aa-beige overflow-hidden hover:shadow-md transition">
                            <div class="aspect-square bg-aa-beige/40 overflow-hidden">
                                <img src="{{ $item->foto_utama_url }}" alt="{{ $item->nama }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-3 sm:p-4">
                                <p class="font-bold text-sm text-aa-ink line-clamp-2 leading-snug">{{ $item->nama }}</p>
                                <p class="mt-1 text-xs text-aa-neutral">{{ collect([$item->brand, $item->ukuran ? 'Ukuran ' . $item->ukuran : null])->filter()->implode(' · ') }}</p>
                                <p class="mt-2 text-xs text-aa-neutral">Biaya jasa reparasi</p>
                                <p class="font-aa font-extrabold text-aa-green">{{ $rupiah($item->total_reparation_price ?? 0) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Rules, stated plainly --}}
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-14 sm:pb-20">
            <div class="rounded-3xl bg-aa-beige p-6 sm:p-10">
                <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-burgundy">Aturan main</p>
                <h2 class="mt-3 font-aa text-3xl font-extrabold text-aa-green">Supaya semuanya jelas dari awal</h2>
                <ul class="mt-6 grid md:grid-cols-2 gap-x-10 gap-y-4 text-aa-ink/85 leading-relaxed">
                    @foreach([
                        'Sepatu donasi kami terima kalau kondisinya minimal 70% setelah dikurasi tim kami.',
                        'Apresiasi untuk pendonor menyesuaikan hasil kurasi sepatu yang didonasikan.',
                        'Pengadopsi tidak membayar harga sepatu. Yang dibayar hanya biaya jasa reparasi yang sudah kami kerjakan.',
                        'Penerima dipilih tim kami dengan mempertimbangkan alasan dan urutan waktu pengajuan.',
                        'Penerima terpilih membayar dalam 2×24 jam. Kalau lewat, kesempatan dialihkan ke pemohon cadangan.',
                        'Ongkos kirim sepatu adopsi dikonfirmasi oleh CS kami setelah pembayaran.',
                        'Tidak ada komplain dan garansi untuk sepatu adopsi. Kondisi sepatu sudah kami tampilkan di katalog sebelum kamu mengajukan.',
                    ] as $rule)
                        <li class="flex gap-3">
                            <span class="mt-2 w-1.5 h-1.5 rounded-full bg-aa-burgundy flex-shrink-0"></span>
                            <span>{{ $rule }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-6 text-sm text-aa-neutral">Ketentuan lengkap ada di <a href="{{ route('terms-of-service') }}#adapt-adopt" class="font-bold text-aa-burgundy underline underline-offset-4">Syarat &amp; Ketentuan</a>.</p>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-14 sm:pb-20">
            <h2 class="font-aa text-3xl font-extrabold text-aa-green text-center">Yang sering ditanyakan</h2>
            <div class="mt-8 divide-y divide-aa-beige border-y border-aa-beige">
                @foreach([
                    ['Sepatunya gratis?', 'Kamu tidak membayar harga sepatunya. Yang dibayar hanya biaya jasa reparasi yang sudah kami kerjakan supaya sepatu siap dipakai lagi.'],
                    ['Kenapa sepatu saya tidak lolos kurasi?', 'Kondisinya di bawah batas kelayakan program (minimal 70%), jadi belum bisa kami teruskan ke pemilik baru.'],
                    ['Kenapa saya tidak terpilih sebagai penerima?', 'Penerima dipilih berdasarkan kriteria program. Kamu tercatat sebagai cadangan, dan akan kami kabari kalau penerima sebelumnya batal.'],
                    ['Berapa lama waktu untuk membayar?', '2×24 jam sejak kamu menerima pemberitahuan terpilih.'],
                    ['Kalau sepatunya ada masalah, bisa komplain atau garansi?', 'Untuk sepatu adopsi tidak ada komplain dan garansi. Kondisi sepatu sudah kami tampilkan di katalog sebelum kamu mengajukan.'],
                    ['Bisa donasi langsung di store?', 'Bisa. Datang ke store kami, tim front office akan mengecek kelayakan sepatumu di tempat.'],
                ] as [$question, $answer])
                    <details class="group py-4">
                        <summary class="flex items-center justify-between gap-4 cursor-pointer list-none font-bold text-aa-ink">
                            {{ $question }}
                            <span class="material-symbols-outlined text-aa-neutral transition-transform group-open:rotate-45">add</span>
                        </summary>
                        <p class="mt-3 text-aa-neutral leading-relaxed">{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </section>

        {{-- Closing --}}
        <section class="bg-aa-green text-aa-beige">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 text-center">
                <p class="font-aa text-2xl sm:text-3xl font-extrabold leading-snug">Tidak perlu memiliki lebih banyak untuk memberikan lebih banyak manfaat.</p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                    <a href="{{ route('katalog.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-aa-burgundy hover:bg-aa-burgundy-dark text-aa-beige font-bold text-sm transition">Lihat Katalog Adopsi</a>
                    <a href="{{ route('adapt-adopt.donasi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-aa-beige/40 hover:bg-aa-beige/10 text-aa-beige font-bold text-sm transition">Donasikan Sepatu</a>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer', ['settings' => $settings])
    <div class="h-20 sm:hidden" aria-hidden="true"></div>

    {{-- Phones: the page is long, keep both actions one tap away once the hero is scrolled past --}}
    <div x-data="{ show: false }" @scroll.window="show = window.scrollY > 520"
         x-show="show" x-cloak
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
         class="fixed inset-x-0 bottom-0 z-40 sm:hidden bg-aa-white/95 backdrop-blur border-t border-aa-beige px-4 py-3 flex gap-2">
        <a href="{{ route('katalog.index') }}" class="flex-1 inline-flex items-center justify-center gap-1.5 py-3 rounded-xl bg-aa-burgundy text-aa-beige font-bold text-sm">
            <span class="material-symbols-outlined !text-[18px]">footprint</span> Adopsi
        </a>
        <a href="{{ route('adapt-adopt.donasi.create') }}" class="flex-1 inline-flex items-center justify-center gap-1.5 py-3 rounded-xl border border-aa-green text-aa-green font-bold text-sm">
            <span class="material-symbols-outlined !text-[18px]">volunteer_activism</span> Donasi
        </a>
    </div>
</div>
@endsection
