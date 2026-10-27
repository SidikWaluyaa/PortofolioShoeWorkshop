@if($item = $donationRequest->donationItem)
<div class="info-box">
    <h3>Detail Sepatu</h3>
    <div class="info-row"><strong>{{ $item->nama }}</strong></div>
    <div class="info-row">Brand: {{ $item->brand ?? '-' }}@if($item->ukuran) &nbsp;|&nbsp; Ukuran: {{ $item->ukuran }}@endif</div>
    <div class="info-row">Kode Barang: {{ $item->kode_barang ?? '-' }}</div>
</div>
@endif
