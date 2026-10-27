@extends('emails.layouts.base')

@section('title', 'Sepatu Donasi Telah Diterima')
@section('subtitle', 'Status Pengajuan Donasi')

@section('content')
    <div class="greeting">Halo, {{ $donation->user?->name ?? 'Donatur' }}! 💚</div>
    <p>Sepatu donasi Anda, <strong class="text-emerald">{{ $donation->nama_sepatu }}</strong>, telah <strong>kami terima</strong> di workshop dan kini masuk antrean restorasi.</p>

    <div class="info-box">
        <h3>Detail Donasi</h3>
        <div class="info-row">No. Donasi: <strong>{{ $donation->spk }}</strong></div>
        @if($donation->ukuran)
            <div class="info-row">Ukuran: {{ $donation->ukuran }}</div>
        @endif
        @if($donation->catatan_admin)
            <div class="info-row">Catatan: {{ $donation->catatan_admin }}</div>
        @endif
    </div>

    <p>Setelah dibersihkan dan diperbaiki, sepatu ini akan masuk katalog adopsi dan siap menemani langkah baru seseorang. Terima kasih telah menebar kebaikan lewat sepatu!</p>

    <div class="btn-wrap">
        <a href="{{ route('member.donations.index') }}" class="btn">Lihat Donasi Saya</a>
    </div>
@endsection
