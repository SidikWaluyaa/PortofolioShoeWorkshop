<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Adopsi Sepatu</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: #10b981; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin-bottom: 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 10px; }
        .invoice-box { background-color: #f3f4f6; border-radius: 12px; padding: 20px; margin: 30px 0; border-left: 4px solid #10b981; }
        .invoice-box h3 { margin-top: 0; margin-bottom: 15px; color: #111827; font-size: 16px; }
        .invoice-row { display: flex; justify-content: space-between; margin-bottom: 10px; color: #4b5563; font-size: 14px; }
        .invoice-total { display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 1px dashed #d1d5db; font-weight: 700; color: #111827; font-size: 16px; }
        .payment-info { background-color: #ecfdf5; border-radius: 12px; padding: 20px; margin: 30px 0; border: 1px solid #a7f3d0; text-align: center; }
        .payment-info p { margin-bottom: 10px; color: #065f46; font-size: 14px; }
        .account-number { font-size: 24px; font-weight: 800; color: #047857; letter-spacing: 1px; margin: 15px 0; }
        .btn { display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-weight: 700; font-size: 16px; margin-top: 20px; text-align: center; }
        .btn:hover { background-color: #059669; }
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { color: #9ca3af; font-size: 12px; margin: 0; }
        .text-emerald { color: #10b981; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Shoe Workshop</h1>
        </div>
        <div class="content">
            <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}! 🎉</div>
            <p>Selamat! Permohonan adopsi Anda untuk sepatu <strong class="text-emerald">{{ $donationRequest->donationItem->nama ?? 'Sepatu' }}</strong> telah <strong class="text-emerald">DISETUJUI</strong> oleh tim Shoe Workshop.</p>
            
            <p>Sepatu ini siap menjadi teman perjalanan Anda yang baru. Namun sebelum itu, silakan selesaikan pembayaran biaya/ongkos kirim agar kami dapat segera mengirimkannya kepada Anda.</p>

            <div class="invoice-box">
                <h3>Detail Tagihan</h3>
                <div class="invoice-row">
                    <span>Kode Barang:</span>
                    <span style="text-transform: uppercase;">{{ $donationRequest->donationItem->kode_barang ?? '-' }}</span>
                </div>
                @php
                    $totalTagihan = 0;
                    $servicesHtml = '';
                    if ($donationRequest->selected_services && count($donationRequest->selected_services) > 0 && $donationRequest->donationItem) {
                        foreach ($donationRequest->selected_services as $srvId) {
                            $srv = $donationRequest->donationItem->reparationServices->where('id', $srvId)->first();
                            if ($srv) {
                                $totalTagihan += $srv->jasa_harga;
                                $servicesHtml .= '<div class="invoice-row" style="font-size: 13px; color: #6b7280; padding-left: 10px;"><span>+ ' . $srv->jasa_nama . '</span><span>Rp ' . number_format($srv->jasa_harga, 0, ',', '.') . '</span></div>';
                            }
                        }
                    }
                @endphp

                <div class="invoice-row">
                    <span>Sepatu:</span>
                    <span>{{ $donationRequest->donationItem->nama ?? '-' }}</span>
                </div>
                {!! $servicesHtml !!}
                <div class="invoice-total">
                    <span>Total Tagihan:</span>
                    <span class="text-emerald">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="payment-info">
                <p>Silakan transfer tepat sesuai nominal di atas ke salah satu rekening berikut:</p>
                <div style="margin-bottom: 20px;">
                    <div><strong>BCA (Bank Central Asia)</strong></div>
                    <div class="account-number" style="margin: 5px 0;">8100978521</div>
                    <div>a.n PT TERANG GARAM SOLUSINDO</div>
                </div>
                <div>
                    <div><strong>Bank Mandiri</strong></div>
                    <div class="account-number" style="margin: 5px 0;">1300030119047</div>
                    <div>a.n PT TERANG GARAM SOLUSINDO</div>
                </div>
            </div>

            <div style="text-align: center;">
                <p style="font-size: 13px; margin-bottom: 5px;">Setelah melakukan transfer, harap kirimkan bukti pembayaran melalui WhatsApp admin kami.</p>
                <a href="https://wa.me/628123456789?text=Halo%20Admin%20Shoe%20Workshop,%20saya%20ingin%20konfirmasi%20pembayaran%20adopsi%20untuk%20ID%20ADPS-{{ $donationRequest->id }}" class="btn">Konfirmasi Pembayaran</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Shoe Workshop. All rights reserved.</p>
            <p>Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253</p>
        </div>
    </div>
</body>
</html>
