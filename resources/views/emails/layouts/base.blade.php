<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
        .header { background-color: @yield('header_color', '#10b981'); padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; }
        .header p { color: rgba(255,255,255,0.9); margin: 6px 0 0; font-size: 14px; }
        .content { padding: 40px 30px; }
        .content p { color: #4b5563; line-height: 1.6; margin: 0 0 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 10px; }
        .info-box { background-color: #f3f4f6; border-radius: 12px; padding: 20px 25px; margin: 30px 0; border-left: 4px solid #10b981; }
        .info-box h3 { margin: 0 0 12px; color: #111827; font-size: 16px; }
        .info-row { margin-bottom: 8px; color: #4b5563; font-size: 14px; }
        .notice { border-radius: 12px; padding: 16px 20px; margin: 25px 0; font-size: 14px; line-height: 1.6; }
        .notice-warning { background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
        .notice-success { background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
        .notice-danger { background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
        .btn-wrap { text-align: center; margin: 30px 0 10px; }
        .btn { display: inline-block; background-color: #10b981; color: #ffffff !important; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-weight: 700; font-size: 15px; }
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { color: #9ca3af; font-size: 12px; margin: 0; }
        .text-emerald { color: #10b981; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Shoe Workshop</h1>
            @hasSection('subtitle')
                <p>@yield('subtitle')</p>
            @endif
        </div>
        <div class="content">
            @yield('content')
            <p style="margin-top: 30px;">Salam hangat,<br><strong>Tim Shoe Workshop</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Shoe Workshop. All rights reserved.</p>
            <p>Menebar Kebaikan Lewat Sepatu</p>
        </div>
    </div>
</body>
</html>
