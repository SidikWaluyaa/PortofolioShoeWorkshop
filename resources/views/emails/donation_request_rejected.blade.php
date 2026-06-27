<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan Barang Donasi - Shoe Workshop</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; color: #1e293b;">

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; padding: 30px 15px;">
        <tr>
            <td align="center">
                
                <!-- Main Card Container -->
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td align="center" style="background-color: #64748b; padding: 40px 30px; text-align: center;">
                            <span style="font-size: 11px; font-weight: 900; color: #cbd5e1; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 8px;">Shoe Workshop Donation</span>
                            <h1 style="color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; line-height: 1.2;">Status Pengajuan Barang</h1>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="font-size: 15px; line-height: 1.6; color: #334155; margin-top: 0; margin-bottom: 20px;">
                                Halo <strong>{{ $donationRequest->nama_pemohon }}</strong>,
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; color: #334155; margin-bottom: 20px;">
                                Terima kasih telah mengajukan permohonan donasi di platform kami serta atas waktu yang Anda luangkan untuk melengkapi data pengajuan.
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; color: #334155; margin-bottom: 25px;">
                                Mohon maaf, saat ini pengajuan Anda untuk barang donasi di bawah ini <strong>belum terpilih</strong> untuk disetujui:
                            </p>

                            <!-- Item Card Details -->
                            @if($donationRequest->donationItem)
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h3 style="font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 0; margin-bottom: 12px;">Detail Barang Katalog</h3>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <p style="font-size: 16px; font-weight: bold; color: #0f172a; margin: 0 0 4px 0;">{{ $donationRequest->donationItem->nama }}</p>
                                                    <p style="font-size: 12px; color: #64748b; margin: 0 0 8px 0;">Brand: {{ $donationRequest->donationItem->brand ?? '-' }} | Kategori: {{ ucfirst($donationRequest->donationItem->kategori) }}</p>
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td style="background-color: #e2e8f0; border-radius: 6px; padding: 4px 10px; font-size: 11px; font-weight: bold; color: #334155; font-family: monospace;">
                                                                Kode: {{ $donationRequest->donationItem->kode_barang ?? '-' }}
                                                            </td>
                                                            @if($donationRequest->donationItem->ukuran)
                                                            <td style="width: 8px;"></td>
                                                            <td style="background-color: #f1f5f9; border-radius: 6px; padding: 4px 10px; font-size: 11px; font-weight: bold; color: #475569;">
                                                                Ukuran: {{ $donationRequest->donationItem->ukuran }}
                                                            </td>
                                                            @endif
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin-bottom: 20px;">
                                Dikarenakan ketersediaan barang donasi gratis kami yang sangat terbatas (hasil restorasi restorator profesional Shoe Workshop yang unik) dan tingginya volume pengajuan, tim kurasi kami harus memprioritaskan alasan pengajuan yang paling mendesak pada kesempatan kali ini.
                            </p>

                            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin-bottom: 30px;">
                                <strong>Jangan berkecil hati!</strong> Masih banyak pilihan barang donasi gratis berkualitas lainnya di katalog kami yang siap pakai. Kami sangat menyarankan Anda untuk mengajukan permohonan kembali pada barang alternatif lainnya yang masih tersedia.
                            </p>

                            <!-- Call To Action -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align: center; margin-bottom: 30px;">
                                <tr>
                                    <td>
                                        <a href="{{ route('katalog.index') }}" style="background-color: #22AF85; color: #ffffff; text-decoration: none; padding: 14px 30px; font-size: 14px; font-weight: bold; border-radius: 10px; display: inline-block; box-shadow: 0 4px 6px -1px rgba(34, 175, 133, 0.2);">
                                            Jelajahi Katalog Donasi
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin-top: 25px; margin-bottom: 0;">
                                Salam hangat,<br>
                                <strong>Tim Shoe Workshop</strong>
                            </p>

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
