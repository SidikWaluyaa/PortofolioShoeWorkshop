<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: #10b981; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin-bottom: 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 15px; }
        .btn-wrapper { text-align: center; margin: 30px 0; }
        .btn { display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-weight: 700; font-size: 16px; transition: background-color 0.3s; }
        .btn:hover { background-color: #059669; }
        .warning { font-size: 13px; color: #6b7280; background: #f3f4f6; padding: 15px; border-radius: 8px; border-left: 3px solid #f59e0b; margin-top: 20px; }
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { color: #9ca3af; font-size: 12px; margin: 0; }
        .link-text { font-size: 12px; color: #9ca3af; word-break: break-all; margin-top: 30px; border-top: 1px solid #f3f4f6; padding-top: 20px;}
        .link-text a { color: #10b981; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Shoe Workshop</h1>
        </div>
        <div class="content">
            <div class="greeting">Halo, {{ $notifiable->name ?? 'Member' }}!</div>
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
            
            <div class="btn-wrapper">
                <a href="{{ $url }}" class="btn">Reset Password Sekarang</a>
            </div>

            <p>Tautan reset password ini akan kedaluwarsa dalam 60 menit.</p>

            <div class="warning">
                <strong>Catatan:</strong> Jika Anda tidak merasa melakukan permintaan reset password, abaikan email ini dan pastikan akun Anda tetap aman.
            </div>

            <div class="link-text">
                Jika Anda kesulitan mengklik tombol "Reset Password Sekarang", salin dan tempel URL di bawah ini ke browser web Anda:<br>
                <a href="{{ $url }}">{{ $url }}</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Shoe Workshop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
