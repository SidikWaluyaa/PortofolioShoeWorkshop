@extends('emails.layouts.base')

@section('title', 'Sepatu Tersedia Lagi')
@section('subtitle', 'Status Permohonan Adopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}! 🔔</div>
    <p>Kabar baik! Sepatu yang Anda ajukan <strong class="text-emerald">tersedia lagi</strong> karena pembayaran pemohon sebelumnya tidak dapat kami verifikasi.</p>

    @include('emails.adoption.partials.item')

    @if($otherOrder = $donationRequest->otherOrderInProgress())
        {{-- One shoe at a time: the member can't pay for this one until their other order ships --}}
        <div class="notice notice-warning">
            Permohonan Anda masih aktif, tetapi pesanan Anda yang lain (<strong>{{ $otherOrder->donationItem?->nama ?? 'pesanan sebelumnya' }}</strong>) sedang diverifikasi/diproses. <strong>Mohon jangan transfer untuk sepatu ini dulu.</strong> Pembayaran dapat dilakukan setelah pesanan tersebut dikirim, selama sepatu ini masih tersedia.
        </div>

        <div class="btn-wrap">
            <a href="{{ route('member.adoption-requests.show', $otherOrder->id) }}" class="btn">Lihat Pesanan Saya</a>
        </div>
    @else
        <div class="notice notice-success">
            Permohonan Anda masih aktif. Sistem tetap <strong>siapa cepat dia dapat</strong>: pemohon pertama yang mengunggah bukti pembayaran akan mendapatkan sepatu ini.
        </div>

        <div class="btn-wrap">
            <a href="{{ route('member.adoption-requests.show', $donationRequest->id) }}" class="btn">Bayar &amp; Unggah Bukti Sekarang</a>
        </div>
    @endif
@endsection
