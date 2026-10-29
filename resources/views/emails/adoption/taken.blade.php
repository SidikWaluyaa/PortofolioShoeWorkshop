@extends('emails.layouts.base')

@section('title', 'Sepatu Sudah Diadopsi Pemohon Lain')
@section('header_color', '#6b7280')
@section('subtitle', 'Status Permohonan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}!</div>
    @if(\App\Services\AdoptionService::curationMode())
        <p>Terima kasih atas minat dan alasan yang sudah Anda tuliskan. Setelah kurasi, sepatu di bawah ini <strong>sudah diadopsi oleh pemohon lain</strong>, sehingga permohonan Anda kami tutup.</p>
    @else
        <p>Terima kasih atas minat Anda. Mohon maaf, sepatu di bawah ini <strong>sudah diadopsi oleh pemohon lain</strong> yang lebih dulu menyelesaikan pembayaran, sehingga permohonan Anda kami tutup.</p>
    @endif

    @include('emails.adoption.partials.item')

    <p>Jangan berkecil hati! Masih banyak sepatu hasil restorasi tim kami yang siap menemani langkah baru Anda di katalog.</p>

    <div class="btn-wrap">
        <a href="{{ route('katalog.index') }}" class="btn">Jelajahi Katalog</a>
    </div>
@endsection
