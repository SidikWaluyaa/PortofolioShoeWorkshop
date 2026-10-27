@extends('emails.layouts.base')

@section('title', 'Pengajuan Donasi Belum Dapat Diterima')
@section('header_color', '#6b7280')
@section('subtitle', 'Status Pengajuan Donasi')

@section('content')
    <div class="greeting">Halo, {{ $donation->user?->name ?? 'Donatur' }}!</div>
    <p>Terima kasih atas niat baik Anda untuk mendonasikan sepatu <strong>{{ $donation->nama_sepatu }}</strong>. Setelah kami tinjau, mohon maaf pengajuan donasi ini <strong>belum dapat kami terima</strong>.</p>

    @if($donation->catatan_admin)
        <div class="notice notice-danger">
            <strong>Catatan dari tim kami:</strong><br>{{ $donation->catatan_admin }}
        </div>
    @endif

    <p>Anda tetap dapat mengajukan donasi sepatu lain yang masih layak pakai kapan saja.</p>

    <div class="btn-wrap">
        <a href="{{ route('member.donations.create') }}" class="btn">Ajukan Donasi Lain</a>
    </div>
@endsection
