@extends('emails.layouts.base')

@section('title', 'Sepatu Sedang Dipesan Pemohon Lain')
@section('header_color', '#f59e0b')
@section('subtitle', 'Status Permohonan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}!</div>
    <p>Sepatu yang Anda ajukan baru saja <strong>lebih dulu dibayar oleh pemohon lain</strong> dan saat ini sedang diverifikasi oleh tim kami. Sesuai sistem <em>siapa cepat dia dapat</em>, sepatu ini kami tahan sementara untuk pemohon tersebut.</p>

    @include('emails.adoption.partials.item')

    <div class="notice notice-warning">
        <strong>Mohon jangan melakukan transfer dulu.</strong> Permohonan Anda tetap aktif. Jika pembayaran pemohon tersebut tidak valid, sepatu akan tersedia lagi dan kami akan langsung mengabari Anda lewat email.
    </div>

    <div class="btn-wrap">
        <a href="{{ route('member.adoption-requests.show', $donationRequest->id) }}" class="btn">Lihat Status Permohonan</a>
    </div>
@endsection
