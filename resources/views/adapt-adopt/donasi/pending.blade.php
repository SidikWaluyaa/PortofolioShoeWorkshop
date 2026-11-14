@extends('layouts.main')
@section('seo_title', 'Satu Langkah Lagi · Adapt & Adopt by ShoeWorkshop')
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
                <p class="text-xs font-bold tracking-[0.2em] uppercase text-aa-green">Donasi tersimpan</p>
                <h1 class="mt-3 font-aa text-3xl sm:text-4xl font-extrabold leading-tight text-aa-green">Satu langkah lagi</h1>
                <p class="mt-4 text-sm sm:text-base text-aa-neutral leading-relaxed">
                    Data dan foto sepatumu sudah kami simpan. Supaya kami bisa mengabari hasil tinjauan dan langkah pengiriman, masuk atau buat akun dulu. Setelah itu kamu langsung kembali ke sini untuk mengirimnya.
                </p>

                <div class="mt-7 flex flex-col gap-3">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-aa-burgundy hover:bg-aa-burgundy-dark text-aa-beige font-bold text-sm transition">
                        Buat akun <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-aa-green text-aa-green hover:bg-aa-beige/40 font-bold text-sm transition">
                        Sudah punya akun? Masuk
                    </a>
                </div>

                <ul class="mt-7 space-y-2 text-xs text-aa-neutral leading-relaxed">
                    <li class="flex gap-2"><span class="material-symbols-outlined text-aa-green !text-[16px]">mark_email_read</span><span>Akun baru perlu verifikasi email. Setelah kamu klik link verifikasinya, kamu langsung diarahkan untuk mengirim donasi ini.</span></li>
                    <li class="flex gap-2"><span class="material-symbols-outlined text-aa-green !text-[16px]">schedule</span><span>Data ini kami simpan selama {{ \App\Models\DonationDraft::KEEP_DAYS }} hari.</span></li>
                </ul>
            </div>

            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-black text-aa-ink">Sepatu yang akan kamu donasikan</h2>
                    <form method="POST" action="{{ route('adapt-adopt.donasi.discard', $draft) }}" onsubmit="return confirm('Hapus data ini dan isi ulang dari awal?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-bold text-aa-neutral hover:text-aa-burgundy underline">Isi ulang</button>
                    </form>
                </div>
                @include('adapt-adopt.donasi._summary')
            </div>
        </div>
    </main>

    @include('components.footer')
</div>
@endsection
