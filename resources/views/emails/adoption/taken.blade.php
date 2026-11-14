@extends('emails.layouts.base')

@section('title', 'Sepatu Sudah Diadopsi Pemohon Lain')
@section('header_color', '#6b7280')
@section('subtitle', 'Status Permohonan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}!</div>
    @if(\App\Services\AdoptionService::curationMode())
        <p>Terima kasih atas minat dan alasan yang sudah kamu tuliskan. Setelah kurasi, sepatu di bawah ini <strong>sudah diadopsi oleh pemohon lain</strong>, sehingga permohonan kamu kami tutup.</p>
    @else
        <p>Terima kasih atas minat kamu. Mohon maaf, sepatu di bawah ini <strong>sudah diadopsi oleh pemohon lain</strong> yang lebih dulu menyelesaikan pembayaran, sehingga permohonan kamu kami tutup.</p>
    @endif

    @include('emails.adoption.partials.item')

    <p>Jangan berkecil hati! Masih banyak sepatu hasil restorasi tim kami yang siap menemani langkah baru kamu di katalog.</p>

    <div class="btn-wrap">
        <a href="{{ route('katalog.index') }}" class="btn">Jelajahi Katalog</a>
    </div>
@endsection
