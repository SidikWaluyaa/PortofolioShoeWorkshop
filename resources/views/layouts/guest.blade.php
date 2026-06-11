<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ShoeWorkshop') }} — {{ $pageTitle ?? 'Donasi' }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        
        <!-- PWA Settings -->
        <link rel="manifest" href="/manifest.webmanifest">
        <meta name="theme-color" content="#22AF85">
        <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.png') }}">
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then(reg => console.log('Service Worker registered with scope:', reg.scope))
                        .catch(err => console.log('Service Worker registration failed:', err));
                });
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            *, *::before, *::after { box-sizing: border-box; }
            body { font-family: 'Inter', sans-serif; }

            /* ── Split‐screen shell ── */
            .auth-split { display: flex; min-height: 100vh; }
            .auth-left  { display: none; position: relative; overflow: hidden; }
            .auth-right { flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem 1.25rem; background: #f8faf9; }

            @media (min-width: 1024px) {
                .auth-left  { display: flex; flex: 1; max-width: 55%; }
                .auth-right { max-width: 45%; padding: 3rem 4rem; }
            }

            /* ── Left panel gradient ── */
            .auth-left-bg {
                position: absolute; inset: 0;
                background: linear-gradient(155deg, #071a12 0%, #0b2e1e 40%, #0d3926 70%, #0f4530 100%);
            }
            .auth-left-glow {
                position: absolute; width: 500px; height: 500px; border-radius: 50%;
                background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%);
                top: 30%; left: 40%; transform: translate(-50%, -50%);
                pointer-events: none;
            }
            .auth-left-content {
                position: relative; z-index: 10;
                display: flex; flex-direction: column; justify-content: space-between;
                width: 100%; padding: 2.5rem 3rem;
            }

            /* ── Floating cards ── */
            .float-card {
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(255,255,255,0.10);
                border-radius: 16px; padding: 18px 20px;
                backdrop-filter: blur(12px);
                color: #d1fae5;
                animation: floatUp 6s ease-in-out infinite;
            }
            .float-card:nth-child(2) { animation-delay: -2s; }
            .float-card:nth-child(3) { animation-delay: -4s; }
            @keyframes floatUp {
                0%, 100% { transform: translateY(0); }
                50%      { transform: translateY(-8px); }
            }
            .tag {
                display: inline-block; padding: 3px 10px; border-radius: 6px;
                font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px;
            }
            .tag-green  { background: #065f46; color: #6ee7b7; }
            .tag-amber  { background: #78350f; color: #fcd34d; }
            .tag-blue   { background: #1e3a5f; color: #93c5fd; }

            /* ── Illustration ── */
            .shoe-illustration {
                position: relative; width: 320px; height: 260px; margin: 0 auto;
            }
            .shoe-circle {
                position: absolute; inset: 20px;
                border-radius: 50%;
                background: radial-gradient(circle at 40% 40%, rgba(16,185,129,0.18), transparent 70%);
                border: 1px solid rgba(16,185,129,0.15);
            }
            .shoe-logo-img {
                position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                width: 180px; height: auto; filter: brightness(1.15) drop-shadow(0 0 40px rgba(16,185,129,0.25));
            }

            /* ── Right panel form card ── */
            .form-card {
                width: 100%; max-width: 440px;
            }
            .form-card h1 {
                font-size: 1.75rem; font-weight: 800; color: #111827; line-height: 1.2;
            }
            .form-card .subtitle {
                font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem; line-height: 1.6;
            }

            /* ── Inputs ── */
            .auth-input {
                width: 100%; padding: 0.75rem 1rem;
                border: 2px solid #1f2937; border-radius: 12px;
                font-size: 0.875rem; color: #111827;
                background: #fff;
                transition: border-color .2s, box-shadow .2s;
                outline: none;
            }
            .auth-input:focus {
                border-color: #10b981;
                box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
            }
            .auth-input::placeholder { color: #9ca3af; }

            .auth-label {
                display: block; font-size: 0.8125rem; font-weight: 600;
                color: #374151; margin-bottom: 0.375rem;
            }

            /* ── CTA button ── */
            .btn-cta {
                width: 100%; padding: 0.875rem; border: none; border-radius: 12px;
                font-size: 0.9375rem; font-weight: 700; cursor: pointer;
                background: linear-gradient(135deg, #f59e0b, #d97706);
                color: #fff; letter-spacing: .3px;
                display: flex; align-items: center; justify-content: center; gap: 8px;
                transition: all .25s; position: relative; overflow: hidden;
                box-shadow: 0 4px 14px rgba(245,158,11,0.35);
            }
            .btn-cta:hover {
                background: linear-gradient(135deg, #d97706, #b45309);
                box-shadow: 0 6px 20px rgba(217,119,6,0.45);
                transform: translateY(-1px);
            }
            .btn-cta:active { transform: translateY(0); }
            .btn-cta svg { width: 18px; height: 18px; }

            /* ── Checkbox ── */
            .auth-check {
                width: 18px; height: 18px; border-radius: 5px; border: 2px solid #10b981;
                accent-color: #10b981; cursor: pointer;
            }

            /* ── Links ── */
            .auth-link {
                font-size: 0.8125rem; font-weight: 600; color: #10b981;
                text-decoration: none; transition: color .2s;
            }
            .auth-link:hover { color: #059669; text-decoration: underline; }

            /* ── Helper text ── */
            .auth-hint { font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem; }

            /* ── Validation errors ── */
            .auth-error { font-size: 0.75rem; color: #ef4444; margin-top: 0.375rem; }

            /* ── Divider ── */
            .auth-divider {
                display: flex; align-items: center; gap: 12px;
                font-size: 0.75rem; color: #9ca3af; margin: 1.5rem 0;
            }
            .auth-divider::before, .auth-divider::after {
                content: ''; flex: 1; height: 1px; background: #e5e7eb;
            }

            /* ── Phone prefix ── */
            .phone-prefix {
                position: absolute; left: 0; top: 0; bottom: 0;
                display: flex; align-items: center; padding-left: 1rem;
                font-size: 0.875rem; font-weight: 700; color: #374151;
                pointer-events: none;
            }

            /* ── Responsive overrides ── */
            @media (max-width: 480px) {
                .auth-right { padding: 1.5rem 1rem; }
                .form-card h1 { font-size: 1.5rem; }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="auth-split">
            <!-- ═══ LEFT PANEL (Desktop) ═══ -->
            <div class="auth-left">
                <div class="auth-left-bg"></div>
                <div class="auth-left-glow"></div>

                <div class="auth-left-content">
                    <!-- Branding -->
                    <div style="display:flex;align-items:center;gap:12px;">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:36px;width:auto;filter:brightness(1.5);">
                        <span style="color:#d1fae5;font-weight:700;font-size:1.05rem;letter-spacing:-.3px;">ShoeWorkshop Donasi</span>
                    </div>

                    <!-- Floating Cards + Illustration -->
                    <div style="position:relative;flex:1;display:flex;align-items:center;justify-content:center;">
                        <!-- Card Top-Left -->
                        <div class="float-card" style="position:absolute;top:10%;left:0;max-width:240px;">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                                <span style="font-size:12px;font-weight:700;color:#6ee7b7;">#DN-842</span>
                                <span class="tag tag-green">Donasi</span>
                            </div>
                            <p style="font-size:13px;font-weight:600;line-height:1.4;">Pengiriman sepatu bekas dari Surabaya</p>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px;">
                                <span class="tag tag-amber">Diverifikasi</span>
                                <span style="font-size:11px;color:#6b7280;">2 jam lalu</span>
                            </div>
                        </div>

                        <!-- Shoe Illustration -->
                        <div class="shoe-illustration">
                            <div class="shoe-circle"></div>
                            <img src="{{ asset('images/logo.png') }}" alt="ShoeWorkshop" class="shoe-logo-img">
                        </div>

                        <!-- Card Top-Right -->
                        <div class="float-card" style="position:absolute;top:5%;right:0;max-width:220px;">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                                <span style="font-size:12px;font-weight:700;color:#6ee7b7;">#DA-118</span>
                                <span class="tag tag-blue">Reparasi</span>
                            </div>
                            <p style="font-size:13px;font-weight:600;line-height:1.4;">Reparasi sol sepatu penerima Bandung</p>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px;">
                                <span class="tag tag-green">Selesai</span>
                                <span style="font-size:11px;color:#6b7280;">5 jam lalu</span>
                            </div>
                        </div>

                        <!-- Card Bottom-Left -->
                        <div class="float-card" style="position:absolute;bottom:12%;left:5%;max-width:230px;">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                                <span style="font-size:12px;font-weight:700;color:#6ee7b7;">#RD-031</span>
                                <span class="tag tag-green">Donasi</span>
                            </div>
                            <p style="font-size:13px;font-weight:600;line-height:1.4;">Koleksi 12 pasang sepatu layak untuk redistribusi</p>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px;">
                                <span class="tag tag-amber">Proses Kirim</span>
                                <span style="font-size:11px;color:#6b7280;">1 hari lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Headline -->
                    <div style="max-width:420px;">
                        <h2 style="font-size:1.6rem;font-weight:800;color:#fff;line-height:1.25;margin-bottom:10px;">
                            Satu tempat untuk setiap
                            <span style="color:#10b981;">Donasi</span>
                            & Reparasi.
                        </h2>
                        <p style="font-size:0.85rem;color:#9ca3af;line-height:1.7;">
                            Sistem donasi terintegrasi, manajemen distribusi sepatu, dan pelacakan reparasi real‑time untuk penerima manfaat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- ═══ RIGHT PANEL (Form) ═══ -->
            <div class="auth-right">
                <div class="form-card">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
