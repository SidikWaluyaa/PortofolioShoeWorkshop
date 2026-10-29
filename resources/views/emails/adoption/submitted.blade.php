@extends('emails.layouts.base')

@section('title', 'Pengajuan Adopsi Diterima')
@section('subtitle', 'Status Permohonan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}!</div>
    <p>Terima kasih, pengajuan adopsi Anda sudah kami terima dan <strong>sedang dikurasi</strong> oleh tim Shoe Workshop.</p>

    @include('emails.adoption.partials.item')

    <p>Satu sepatu bisa diajukan oleh beberapa orang. Tim kami meninjau semua pengajuan, dengan mempertimbangkan <strong>alasan pengajuan</strong> dan <strong>urutan waktu pengajuan</strong>.</p>

    <div class="notice notice-warning">
        <strong>Mohon jangan melakukan transfer apa pun dulu.</strong> Jika Anda terpilih, kami kirimkan tagihan lewat email dan tombol pembayaran muncul di halaman Adopsi Saya. Tagihan perlu dibayar dalam {{ \App\Models\DonationRequest::PAYMENT_WINDOW_HOURS / 24 }}×24 jam sejak terpilih.
    </div>

    <p>Jika belum terpilih, kami tetap mengabari Anda lewat email.</p>

    <div class="btn-wrap">
        <a href="{{ route('member.adoption-requests.show', $donationRequest->id) }}" class="btn">Lihat Status Pengajuan</a>
    </div>
@endsection
