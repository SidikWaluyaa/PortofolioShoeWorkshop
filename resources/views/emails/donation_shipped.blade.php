<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepatu Adopsi Dikirim</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: #10b981; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin-bottom: 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 10px; }
        .tracking-box { background-color: #f3f4f6; border-radius: 12px; padding: 25px; margin: 30px 0; border-left: 4px solid #10b981; text-align: center; }
        .tracking-label { color: #6b7280; font-size: 14px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
        .tracking-number { font-size: 28px; font-weight: 800; color: #111827; letter-spacing: 2px; margin: 10px 0; background: #fff; padding: 15px; border-radius: 8px; border: 2px dashed #d1d5db; }
        .courier-name { font-size: 16px; font-weight: 700; color: #059669; }
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
            <div class="greeting">Halo, {{ $donationRequest->nama_pemohon }}! 📦</div>
            <p>Hore! Sepatu adopsi impian Anda (<strong class="text-emerald">{{ $donationRequest->donationItem->nama ?? 'Sepatu' }}</strong>) telah kami serahkan ke pihak ekspedisi dan sedang dalam perjalanan menuju alamat Anda.</p>
            
            <div class="tracking-box">
                <div class="tracking-label">Nomor Resi Pengiriman</div>
                <div class="tracking-number">{{ $donationRequest->resi_pengiriman ?? 'Belum ada resi' }}</div>
            </div>

            <p>Anda dapat melacak status pengiriman paket Anda menggunakan nomor resi di atas melalui website resmi ekspedisi terkait.</p>
            <p>Jika paket sudah Anda terima dengan baik, mohon kesediaannya untuk mengonfirmasi penerimaan di halaman Adopsi Saya ya!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Shoe Workshop. All rights reserved.</p>
            <p>Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253</p>
        </div>
    </div>
</body>
</html>
