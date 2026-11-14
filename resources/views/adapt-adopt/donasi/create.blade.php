@extends('layouts.main')
@section('seo_title', 'Donasikan Sepatu · Adapt & Adopt by ShoeWorkshop')
@section('seo_description', 'Donasikan sepatu yang sudah tidak kamu pakai lewat Adapt & Adopt by ShoeWorkshop. Isi data dan foto sepatu, tim kami meninjaunya dalam 1–2 hari kerja.')

@push('head')
    @include('layouts.partials.aa-fonts')
    <style>[x-cloak] { display: none !important; }</style>
@endpush

@section('content')
<div class="bg-aa-white text-aa-ink min-h-screen flex flex-col">
    @include('layouts.navigation-public')

    <main class="flex-grow pt-16 sm:pt-20">
        <section class="bg-aa-green text-aa-beige">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
                <a href="{{ route('adapt-adopt.index') }}" class="inline-flex items-center gap-1 text-xs font-bold tracking-[0.2em] uppercase text-aa-sage hover:text-aa-beige transition">
                    <span class="material-symbols-outlined !text-[16px]">arrow_back</span> Adapt &amp; Adopt
                </a>
                <h1 class="mt-3 font-aa text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight">Donasikan sepatumu</h1>
                <p class="mt-3 text-sm sm:text-base text-aa-beige/90 leading-relaxed max-w-2xl">
                    Isi data dan foto sepatunya dulu. Untuk mengirim, kamu perlu masuk atau membuat akun. Tenang, data dan foto yang sudah kamu isi tidak hilang.
                </p>
            </div>
        </section>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            @if($draft)
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center gap-3 p-4 rounded-2xl bg-aa-beige/60 border border-aa-beige">
                    <span class="material-symbols-outlined text-aa-green">inventory_2</span>
                    <p class="text-sm text-aa-ink flex-1">Kamu masih punya donasi yang belum dikirim: <strong>{{ $draft->data['nama_sepatu'] }}</strong>. Mengisi form ini akan menggantikannya.</p>
                    <a href="{{ route('adapt-adopt.donasi.pending') }}" class="inline-flex items-center justify-center gap-1 px-4 py-2 rounded-xl bg-aa-green text-aa-beige text-sm font-bold hover:bg-aa-green-dark transition">
                        Lanjutkan yang tadi <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                    </a>
                </div>
            @endif

            @include('member.donations._form', [
                'action' => route('adapt-adopt.donasi.store'),
                'submitLabel' => 'Kirim Donasi',
                'cancelUrl' => route('adapt-adopt.index'),
                'submitNote' => auth()->check() ? null : 'Setelah ini kamu akan diminta masuk atau daftar. Data dan foto sepatumu tetap tersimpan.',
            ])
        </div>
    </main>

    @include('components.footer')
</div>
@endsection
