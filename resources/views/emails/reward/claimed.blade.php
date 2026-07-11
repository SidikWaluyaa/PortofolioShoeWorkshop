<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Berhasil Diklaim</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: #10b981; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin-bottom: 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 10px; }
        
        /* Ticket Design */
        .ticket { background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 16px; padding: 30px; margin: 30px 0; color: #fff; text-align: center; position: relative; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3); }
        .ticket::before, .ticket::after { content: ''; position: absolute; width: 30px; height: 30px; background-color: #ffffff; border-radius: 50%; top: 50%; transform: translateY(-50%); }
        .ticket::before { left: -15px; }
        .ticket::after { right: -15px; }
        .ticket-title { font-size: 14px; text-transform: uppercase; letter-spacing: 2px; opacity: 0.9; margin-bottom: 10px; font-weight: 600; }
        .ticket-reward { font-size: 24px; font-weight: 800; margin-bottom: 25px; line-height: 1.3; }
        .ticket-code-box { background: rgba(255, 255, 255, 0.2); padding: 15px; border-radius: 8px; backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .ticket-code { font-size: 32px; font-weight: 900; letter-spacing: 4px; font-family: monospace; }
        .ticket-footer { margin-top: 15px; font-size: 12px; opacity: 0.8; }

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
            <div class="greeting">Halo, {{ $userReward->user->name ?? 'Member' }}! 🏆</div>
            <p>Selamat! Kerja keras dan kedisiplinan Anda terbayar lunas. Anda telah berhasil mengklaim reward spesial atas penyelesaian <strong>Streak Minggu ke-{{ $userReward->minggu_ke }}</strong> Anda.</p>
            
            <p>Berikut adalah voucher eksklusif Anda. Tunjukkan kode unik ini kepada kasir/admin kami di *store* Shoe Workshop untuk menukarkannya.</p>

            <div class="ticket">
                <div class="ticket-title">Voucher Eksklusif Member</div>
                <div class="ticket-reward">{{ $userReward->reward->nama_reward ?? 'Reward Spesial' }}</div>
                
                <div class="ticket-code-box">
                    <div class="ticket-code">{{ $userReward->unique_code }}</div>
                </div>
                
                @if($userReward->reward && $userReward->reward->berlaku_sampai)
                <div class="ticket-footer">
                    Berlaku s/d {{ \Carbon\Carbon::parse($userReward->reward->berlaku_sampai)->format('d F Y') }}
                </div>
                @endif
            </div>

            <p style="font-size: 13px; color: #6b7280; background: #f3f4f6; padding: 15px; border-radius: 8px; border-left: 3px solid #9ca3af;">
                <strong>Syarat & Ketentuan:</strong><br>
                - Kode voucher ini unik dan hanya bisa digunakan 1 (satu) kali.<br>
                - Voucher tidak dapat diuangkan.<br>
                - Harap tidak membagikan screenshot email ini kepada orang lain.
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Shoe Workshop. All rights reserved.</p>
            <p>Terima kasih telah menjadi bagian dari perjalanan kami!</p>
        </div>
    </div>
</body>
</html>
