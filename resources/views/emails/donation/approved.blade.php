<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Disetujui</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: #0F3D3B; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin-bottom: 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 10px; }
        .info-box { background-color: #f3f4f6; border-radius: 12px; padding: 25px; margin: 30px 0; border-left: 4px solid #0F3D3B; }
        .info-box h3 { margin-top: 0; margin-bottom: 15px; color: #111827; font-size: 16px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; color: #4b5563; font-size: 14px; }
        .address-box { background-color: #FBF6EF; border-radius: 12px; padding: 20px; margin: 30px 0; border: 1px solid #F5DABF; text-align: left; }
        .address-box p { margin-bottom: 10px; color: #0F3D3B; font-size: 14px; margin-top: 0;}
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { color: #9ca3af; font-size: 12px; margin: 0; }
        .text-emerald { color: #0F3D3B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/adapt-adopt/adaptadopt_dark_beige_on_green.png') }}" alt="Adapt &amp; Adopt by ShoeWorkshop" width="150" style="width:150px;height:auto;display:inline-block;">
        </div>
        <div class="content">
            <div class="greeting">Halo, {{ $donation->user?->name ?? 'Donatur' }}! 💖</div>
            <p>Kabar gembira! Sepatu yang kamu ajukan untuk didonasikan (<strong class="text-emerald">{{ $donation->nama_sepatu ?? 'Sepatu kamu' }}</strong>) telah memenuhi standar kelayakan kami dan <strong class="text-emerald">DISETUJUI</strong>.</p>
            
            <p>Langkah selanjutnya adalah mengirimkan sepatu tersebut ke markas Shoe Workshop. Silakan kemas sepatu kamu dengan rapi dan aman, lalu kirimkan (atau antar langsung) ke alamat berikut:</p>

            <div class="address-box">
                <p><strong>Alamat Tujuan:</strong></p>
                <p style="font-size: 16px; font-weight: bold; color: #0F3D3B; line-height: 1.4;">Shoe Workshop Indonesia<br>Jl. Kembar I No.41, Cigereleng,<br>Kec. Regol, Kota Bandung,<br>Jawa Barat 40253</p>
                <p><strong>Kontak (WhatsApp):</strong> {{ '0' . substr($globalSettings['whatsapp_number'] ?? '62895339939800', 2) }}</p>
                <p><strong>Jam Operasional:</strong> Senin - Sabtu (09.00 - 17.00 WIB), Minggu tutup</p>
            </div>

            <div class="info-box">
                <h3>Detail Pengajuan kamu</h3>
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

            <p>Terima kasih atas kebaikan hati kamu. Setelah tim kami selesai membersihkan dan memperbaikinya, sepatu ini akan masuk katalog adopsi dan mendapatkan pemilik barunya!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Adapt &amp; Adopt by ShoeWorkshop.</p>
            <p>Menebar Kebaikan Lewat Sepatu</p>
        </div>
    </div>
</body>
</html>
