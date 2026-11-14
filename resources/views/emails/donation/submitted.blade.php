@extends('emails.layouts.base')

@section('title', 'Pengajuan Donasi Diterima')
@section('subtitle', 'Status Donasi')

@section('content')
    <div class="greeting">Halo, {{ $donation->user->name ?? 'kamu' }}!</div>
    <p>Terima kasih sudah mau memberi kesempatan kedua untuk sepatumu. Pengajuan donasimu sudah kami terima dan sedang kami kurasi.</p>

    <div class="info-box">
        <h3>Detail Donasi</h3>
        <div class="info-row"><strong>{{ $donation->nama_sepatu }}</strong></div>
        <div class="info-row">{{ collect([$donation->brand, 'Ukuran ' . $donation->ukuran])->filter()->implode(' · ') }}</div>
        @if($donation->spk)
            <div class="info-row">Nomor: {{ $donation->spk }}</div>
        @endif
    </div>

    <p>Tim kami akan mengecek kelayakan sepatu dari foto yang kamu kirim (kondisi minimal 70%), biasanya dalam 1–2 hari kerja. Hasilnya kami sampaikan lewat email dan notifikasi di akunmu.</p>

    <div class="notice notice-warning">
        Mohon <strong>jangan kirim sepatunya dulu</strong> sebelum ada kabar bahwa donasimu lolos kurasi.
    </div>

    <div class="btn-wrap">
        <a href="{{ route('member.donations.index') }}" class="btn">Lihat Status Donasi</a>
    </div>
@endsection
