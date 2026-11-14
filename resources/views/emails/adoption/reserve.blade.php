@extends('emails.layouts.base')

@section('title', 'Kamu Masuk Daftar Cadangan')
@section('subtitle', 'Status Pengajuan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}!</div>
    <p>Terima kasih sudah mengajukan adopsi. Setelah meninjau semua pengajuan, sepatu di bawah ini sudah kami tawarkan ke pemohon lain.</p>

    @include('emails.adoption.partials.item')

    <div class="notice notice-success">
        <strong>Kamu masuk daftar cadangan.</strong> Kalau penerima terpilih tidak menyelesaikan pembayaran dalam 2×24 jam, pengajuanmu masih bisa kami pilih dan kami kabari lewat email. <strong>Mohon jangan transfer apa pun sebelum terpilih.</strong>
    </div>

    <div class="btn-wrap">
        <a href="{{ route('member.adoption-requests.show', $donationRequest->id) }}" class="btn">Lihat Status Pengajuan</a>
    </div>
@endsection
