<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Disetujui</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: #10b981; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin-bottom: 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 10px; }
        .info-box { background-color: #f3f4f6; border-radius: 12px; padding: 25px; margin: 30px 0; border-left: 4px solid #10b981; }
        .info-box h3 { margin-top: 0; margin-bottom: 15px; color: #111827; font-size: 16px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; color: #4b5563; font-size: 14px; }
        .address-box { background-color: #ecfdf5; border-radius: 12px; padding: 20px; margin: 30px 0; border: 1px solid #a7f3d0; text-align: left; }
        .address-box p { margin-bottom: 10px; color: #065f46; font-size: 14px; margin-top: 0;}
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
            <div class="greeting">Halo, {{ $donation->nama }}! 💖</div>
            <p>Kabar gembira! Sepatu yang Anda ajukan untuk didonasikan (<strong class="text-emerald">{{ $donation->brand ?? 'Sepatu Anda' }}</strong>) telah memenuhi standar kelayakan kami dan <strong class="text-emerald">DISETUJUI</strong>.</p>
            
            <p>Langkah selanjutnya adalah mengirimkan sepatu tersebut ke markas Shoe Workshop. Silakan kemas sepatu Anda dengan rapi dan aman, lalu kirimkan (atau antar langsung) ke alamat berikut:</p>

            <div class="address-box">
                <p><strong>Alamat Tujuan:</strong></p>
                <p style="font-size: 16px; font-weight: bold; color: #047857; line-height: 1.4;">Shoe Workshop Indonesia<br>Jl. Kembar I No.41, Cigereleng,<br>Kec. Regol, Kota Bandung,<br>Jawa Barat 40253</p>
                <p><strong>Kontak:</strong> 08123456789</p>
                <p><strong>Jam Operasional:</strong> Senin - Minggu (09.00 - 17.00 WIB)</p>
            </div>

            <div class="info-box">
                <h3>Detail Pengajuan Anda</h3>
                <div class="info-row">
                    <span>Metode Pengiriman:</span>
                    <strong style="text-transform: capitalize;">{{ str_replace('_', ' ', $donation->metode_pengiriman) }}</strong>
                </div>
                @if($donation->metode_pengiriman == 'ekspedisi')
                <div class="info-row">
                    <span>Kurir & Resi:</span>
                    <strong>{{ $donation->nama_ekspedisi }} ({{ $donation->no_resi }})</strong>
                </div>
                @endif
            </div>

            <p>Terima kasih atas kebaikan hati Anda. Donasi ini akan sangat berarti bagi mereka yang membutuhkan setelah tim kami selesai membersihkan dan memperbaikinya!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Shoe Workshop. All rights reserved.</p>
            <p>Menebar Kebaikan Lewat Sepatu</p>
        </div>
    </div>
</body>
</html>
