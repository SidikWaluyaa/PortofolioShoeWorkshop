{{-- Layout for Adapt & Adopt by ShoeWorkshop program emails (donation & adoption), brand guideline palette --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body { font-family: 'Inter', Helvetica, Arial, sans-serif; background-color: #FBF6EF; margin: 0; padding: 0; color: #1E1B1A; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #F5DABF; }
        .header { background-color: #0F3D3B; padding: 28px 30px; text-align: center; }
        .header img { width: 150px; height: auto; display: inline-block; }
        .header p { color: #8FB5AE; margin: 10px 0 0; font-size: 13px; letter-spacing: 0.5px; }
        .content { padding: 36px 30px; }
        .content p { color: #3a3532; line-height: 1.6; margin: 0 0 20px; font-size: 15px; }
        .greeting { font-size: 18px; font-weight: 700; color: #0F3D3B; margin-bottom: 10px; }
        .info-box { background-color: #FBF6EF; border-radius: 12px; padding: 20px 25px; margin: 30px 0; border-left: 4px solid #0F3D3B; }
        .info-box h3 { margin: 0 0 12px; color: #0F3D3B; font-size: 16px; }
        .info-row { margin-bottom: 8px; color: #3a3532; font-size: 14px; }
        .notice { border-radius: 12px; padding: 16px 20px; margin: 25px 0; font-size: 14px; line-height: 1.6; }
        .notice-warning { background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
        .notice-success { background-color: #F5DABF; border: 1px solid #F5DABF; color: #0F3D3B; }
        .notice-danger { background-color: #fef2f2; border: 1px solid #fecaca; color: #6C1420; }
        .btn-wrap { text-align: center; margin: 30px 0 10px; }
        .btn { display: inline-block; background-color: #6C1420; color: #F5DABF !important; text-decoration: none; padding: 14px 28px; border-radius: 10px; font-weight: 700; font-size: 15px; }
        .footer { background-color: #FBF6EF; padding: 20px; text-align: center; border-top: 1px solid #F5DABF; }
        .footer p { color: #6F6660; font-size: 12px; margin: 0 0 4px; }
        .text-emerald { color: #0F3D3B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/adapt-adopt/adaptadopt_dark_beige_on_green.png') }}" alt="Adapt & Adopt by ShoeWorkshop" width="150">
            @hasSection('subtitle')
                <p>@yield('subtitle')</p>
            @endif
        </div>
        <div class="content">
            @yield('content')
            <p style="margin-top: 30px;">Salam hangat,<br><strong>Tim Adapt &amp; Adopt by ShoeWorkshop</strong></p>
        </div>
        <div class="footer">
            <p><strong>Adapt the Mindset. Give a Second Chance.</strong></p>
            <p>&copy; {{ date('Y') }} Adapt &amp; Adopt by ShoeWorkshop · <a href="{{ route('adapt-adopt.index') }}" style="color:#6C1420;">shoeworkshop.id/adapt-adopt</a></p>
        </div>
    </div>
</body>
</html>
