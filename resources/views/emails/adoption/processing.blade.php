@extends('emails.layouts.base')

@section('title', 'Pembayaran Terverifikasi')
@section('subtitle', 'Status Permohonan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}! 🎉</div>
    <p>Pembayaran Anda telah kami <strong class="text-emerald">verifikasi</strong>. Sepatu ini resmi menjadi milik Anda dan sekarang sedang kami siapkan untuk dikirim.</p>

    @include('emails.adoption.partials.item')

    <p>Kami akan mengirim email berikutnya beserta nomor resi begitu sepatu dikirim ke alamat Anda.</p>

    <div class="btn-wrap">
        <a href="{{ route('member.adoption-requests.show', $donationRequest->id) }}" class="btn">Lihat Status Pesanan</a>
    </div>
@endsection
