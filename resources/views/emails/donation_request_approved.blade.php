<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Donasi Anda Disetujui! 🎉</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; color: #1e293b;">

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; padding: 30px 15px;">
        <tr>
            <td align="center">
                
                <!-- Main Card Container -->
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td align="center" style="background-color: #22AF85; padding: 40px 30px; text-align: center;">
                            <span style="font-size: 11px; font-weight: 900; color: #d1fae5; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 8px;">Shoe Workshop Donation</span>
                            <h1 style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; line-height: 1.2;">Permohonan Anda Disetujui! 🎉</h1>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                            <p style="font-size: 15px; line-height: 1.6; color: #334155; margin-top: 0; margin-bottom: 20px;">
                                Halo <strong>{{ $donationRequest->nama_pemohon }}</strong>,
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; color: #334155; margin-bottom: 25px;">
                                Kabar baik! Tim kami telah meninjau pengajuan Anda dan dengan senang hati mengabarkan bahwa Anda terpilih untuk mengadopsi barang donasi di bawah ini!
                            </p>

                            <!-- Item Card Details -->
                            @if($donationRequest->donationItem)
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h3 style="font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 0; margin-bottom: 12px;">Sepatu Adopsi</h3>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <p style="font-size: 16px; font-weight: bold; color: #0f172a; margin: 0 0 4px 0;">{{ $donationRequest->donationItem->nama }}</p>
                                                    <p style="font-size: 12px; color: #64748b; margin: 0 0 8px 0;">Brand: {{ $donationRequest->donationItem->brand ?? '-' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @endif
                            
                            @php
                                $totalBiaya = 0;
                                if ($donationRequest->selected_services && $donationRequest->donationItem) {
                                    foreach ($donationRequest->selected_services as $srvId) {
                                        $srv = $donationRequest->donationItem->reparationServices->where('id', $srvId)->first();
                                        if ($srv) {
                                            $totalBiaya += $srv->jasa_harga;
                                        }
                                    }
                                }
                            @endphp

                            <!-- Tagihan & Instruksi Pembayaran -->
                            <div style="background-color: #fffbeb; border: 1px solid #fcd34d; border-radius: 12px; padding: 25px; margin-bottom: 30px;">
                                <h2 style="margin-top:0; color:#92400e; font-size:18px;">Tagihan: Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h2>
                                <p style="font-size:14px; color:#92400e; margin-bottom:15px; line-height:1.5;">
                                    Silakan lakukan transfer ke salah satu rekening resmi kami di bawah ini:
                                </p>
                                
                                <div style="background-color:#ffffff; padding:15px; border-radius:8px; border:1px solid #fde68a; margin-bottom:10px;">
                                    <p style="margin:0; font-size:11px; color:#78350f; font-weight:bold; text-transform:uppercase;">Bank BCA</p>
                                    <p style="margin:4px 0; font-size:18px; font-family:monospace; font-weight:bold; color:#1e3a8a;">8100978521</p>
                                    <p style="margin:0; font-size:12px; color:#451a03;">a.n PT TERANG GARAM SOLUSINDO</p>
                                </div>

                                <div style="background-color:#ffffff; padding:15px; border-radius:8px; border:1px solid #fde68a;">
                                    <p style="margin:0; font-size:11px; color:#78350f; font-weight:bold; text-transform:uppercase;">Bank Mandiri</p>
                                    <p style="margin:4px 0; font-size:18px; font-family:monospace; font-weight:bold; color:#1e3a8a;">1300030119047</p>
                                    <p style="margin:0; font-size:12px; color:#451a03;">a.n PT TERANG GARAM SOLUSINDO</p>
                                </div>
                            </div>

                            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin-bottom: 30px; background-color:#f1f5f9; padding: 15px; border-radius:8px;">
                                Setelah melakukan transfer, harap segera mengunggah bukti pembayaran di Dashboard Member pada menu <strong>"Adopsi Saya"</strong> agar sepatu segera kami proses dan kirimkan.
                            </p>

                            <!-- Call To Action -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align: center;">
                                <tr>
                                    <td>
                                        <a href="{{ route('member.dashboard') }}" target="_blank" style="background-color: #22AF85; color: #ffffff; text-decoration: none; padding: 14px 30px; font-size: 14px; font-weight: bold; border-radius: 10px; display: inline-block; box-shadow: 0 4px 6px -1px rgba(34, 175, 133, 0.2);">
                                            Upload Bukti Pembayaran Sekarang
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer Content -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="font-size: 12px; color: #64748b; margin: 0 0 8px 0;">
                                Email ini dikirim secara otomatis oleh platform donasi <strong>Shoe Workshop</strong>.
                            </p>
                            <p style="font-size: 11px; color: #94a3b8; margin: 0;">
                                &copy; {{ date('Y') }} Shoe Workshop. Hak Cipta Dilindungi Undang-Undang.
                            </p>
                        </td>
                    </tr>

                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>
