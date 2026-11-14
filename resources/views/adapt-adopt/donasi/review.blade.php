@extends('layouts.main')
@section('seo_title', 'Periksa dan Kirim Donasi · Adapt & Adopt by ShoeWorkshop')
@push('head')
    <meta name="robots" content="noindex, nofollow">
    @include('layouts.partials.aa-fonts')
@endpush

@section('content')
<div class="bg-aa-white text-aa-ink min-h-screen flex flex-col">
    @include('layouts.navigation-public')

    <main class="flex-grow pt-24 sm:pt-28 pb-14 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-[1fr_1.05fr] gap-8 lg:gap-12 items-start">
            <div>
                <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-green">Hai, {{ auth()->user()->name }}</p>
                <h1 class="mt-3 font-aa text-3xl sm:text-4xl font-extrabold leading-tight text-aa-green">Periksa lagi lalu kirim</h1>
                <p class="mt-4 text-sm sm:text-base text-aa-neutral leading-relaxed">
                    Ini data sepatu yang tadi kamu isi. Kalau sudah sesuai, kirim donasinya. Tim kami meninjaunya dalam 1–2 hari kerja dan mengabarimu lewat email.
                </p>

                <form method="POST" action="{{ route('adapt-adopt.donasi.submit', $draft) }}" class="mt-7">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-aa-burgundy hover:bg-aa-burgundy-dark text-aa-beige font-bold text-sm transition">
                        Kirim Donasi <span class="material-symbols-outlined !text-[18px]">send</span>
                    </button>
                </form>
                <form method="POST" action="{{ route('adapt-adopt.donasi.discard', $draft) }}" class="mt-3" onsubmit="return confirm('Hapus data ini dan isi ulang dari awal?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-6 py-3 rounded-xl border border-aa-green text-aa-green hover:bg-aa-beige/40 font-bold text-sm transition">Ada yang salah? Isi ulang</button>
                </form>

                <p class="mt-6 text-xs text-aa-neutral leading-relaxed">
                    Jangan kirim sepatunya dulu. Setelah donasimu disetujui, kami kabari cara mengantar atau mengirimnya ke workshop.
                </p>
            </div>

            <div>
                <h2 class="text-sm font-black text-aa-ink mb-3">Sepatu yang akan kamu donasikan</h2>
                @include('adapt-adopt.donasi._summary')
            </div>
        </div>
    </main>

    @include('components.footer')
</div>
@endsection
