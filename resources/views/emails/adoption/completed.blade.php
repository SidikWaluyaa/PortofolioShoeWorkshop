@extends('emails.layouts.base')

@section('title', 'Adopsi Sepatu Selesai')
@section('subtitle', 'Terima kasih telah mengadopsi')

@section('content')
    <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}! 💚</div>
    <p>Sepatu adopsi Anda telah <strong class="text-emerald">diterima</strong> dan permohonan ini kami nyatakan selesai. Terima kasih telah memberi kesempatan kedua untuk sepatu ini!</p>

    @include('emails.adoption.partials.item')

    <p>Semoga sepatu ini nyaman menemani langkah Anda. Jika butuh perawatan atau reparasi di kemudian hari, tim Shoe Workshop siap membantu.</p>

    <div class="btn-wrap">
        <a href="{{ route('member.adoption-requests.show', $donationRequest->id) }}" class="btn">Lihat Riwayat Adopsi</a>
    </div>
@endsection
