<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Shoe Workshop - Profesional Shoe Repair &amp; Maintenance</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface": "#ffffff",
                        "tertiary-container": "#444749",
                        "error": "#ba1a1a",
                        "surface-container": "#f8f9fa",
                        "outline": "#926e69",
                        "secondary-fixed": "#FFC232",
                        "secondary-container": "#fff4d6",
                        "on-tertiary-fixed": "#191c1e",
                        "secondary": "#22AF85",
                        "primary-container": "#22AF85",
                        "on-surface": "#1c1c17",
                        "on-primary-fixed-variant": "#1a8a68",
                        "surface-dim": "#f8f9fa",
                        "on-surface-variant": "#444749",
                        "on-primary-fixed": "#00392b",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-container": "#000000",
                        "on-background": "#1c1c17",
                        "surface-container-high": "#f1f3f5",
                        "surface-tint": "#22AF85",
                        "surface-bright": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed-variant": "#444749",
                        "on-primary": "#ffffff",
                        "secondary-fixed-dim": "#ffb4a8",
                        "primary-fixed-dim": "#b3f0dd",
                        "on-secondary-fixed-variant": "#00513e",
                        "inverse-on-surface": "#ffffff",
                        "background": "#ffffff",
                        "tertiary-fixed": "#e1e2e5",
                        "primary": "#22AF85",
                        "outline-variant": "#dee2e6",
                        "on-secondary-fixed": "#000000",
                        "surface-variant": "#f8f9fa",
                        "surface-container-low": "#ffffff",
                        "inverse-surface": "#1c1c17",
                        "tertiary-fixed-dim": "#c5c7c9",
                        "on-tertiary-container": "#ffffff",
                        "on-error": "#ffffff",
                        "tertiary": "#4a4d4f",
                        "surface-container-highest": "#e9ecef",
                        "primary-fixed": "#d3f7ed",
                        "on-secondary": "#1c1c17",
                        "inverse-primary": "#22AF85",
                        "on-primary-container": "#002117",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "workshop-green": "#22AF85",
                        "workshop-yellow": "#FFC232",
                        "workshop-dark": "#1c1c17"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "stack-sm": "8px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "margin-desktop": "64px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "section-gap": "120px"
                    },
                    "fontFamily": {
                        "label-sm": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "title-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "label-sm": ["14px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "display-lg": ["56px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "headline-lg": ["40px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "title-md": ["18px", {"lineHeight": "1.5", "letterSpacing": "0.05em", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .active-nav-border {
            position: relative;
        }
        .active-nav-border::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 24px;
            height: 3px;
            background-color: #22AF85;
            border-radius: 2px;
        }
        .before-after-slider {
            position: relative;
            overflow: hidden;
        }
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            bottom: 0;
            width: 2px;
            background-color: #dee2e6;
            z-index: 0;
        }
    </style>
</head>
<body class="bg-background text-workshop-dark font-body-md overflow-x-hidden">
<!-- Top Navigation Bar -->
<header class="fixed top-0 left-0 w-full z-50 bg-surface/95 backdrop-blur-sm border-b border-outline-variant">
<nav class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-4 flex justify-between items-center">
<div class="flex items-center gap-2">
<div class="flex flex-col leading-tight">
<span class="font-title-md text-title-md font-bold text-workshop-dark">Shoe Workshop</span>
<div class="flex h-1 w-full">
<div class="w-1/2 bg-workshop-green"></div>
<div class="w-1/2 bg-workshop-yellow"></div>
</div>
</div>
</div>
<div class="hidden lg:flex items-center gap-8">
<a class="font-label-sm text-label-sm text-workshop-green active-nav-border" href="#">Beranda</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#layanan">Layanan</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#portfolio">Portfolio</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#review">Review</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#">Tracking</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#kontak">Kontak</a>
</div>
<a class="bg-workshop-yellow text-workshop-dark px-6 py-2.5 rounded-lg font-label-sm text-label-sm flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md shadow-workshop-yellow/20" href="https://wa.me/#">
<span class="material-symbols-outlined !text-[20px]">chat</span>
            Konsultasi via WhatsApp
        </a>
</nav>
</header>
<main class="pt-20">
<!-- Hero Section -->
<section class="min-h-[800px] flex flex-col md:flex-row overflow-hidden border-b border-outline-variant">
<div class="w-full md:w-1/2 bg-surface flex items-center justify-center px-margin-mobile md:px-margin-desktop py-section-gap/2 md:py-0">
<div class="max-w-[540px] space-y-stack-lg">
<div class="space-y-stack-sm">
<p class="font-label-sm text-label-sm tracking-[0.2em] text-on-surface-variant uppercase">Reparasi &amp; Perawatan Sepatu</p>
<h1 class="font-display-lg text-display-lg text-workshop-dark">Reparasi Sepatu Profesional</h1>
</div>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    Sepatu favoritmu rusak? Kirim fotonya, kami bantu cek dan rekomendasikan solusinya dengan standar workshop profesional.
                </p>
<div class="flex flex-wrap items-center gap-stack-lg pt-4">
<button class="bg-workshop-yellow text-workshop-dark px-8 py-4 rounded-lg font-title-md text-title-md flex items-center gap-3 shadow-lg shadow-workshop-yellow/20 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all">
<span class="material-symbols-outlined">chat</span>
                        Konsultasi via WhatsApp
                    </button>
<div class="flex items-center gap-3 py-2 px-4 border border-outline-variant rounded-xl bg-surface">
<span class="material-symbols-outlined text-workshop-green" style="font-variation-settings: 'FILL' 1;">verified_user</span>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-workshop-dark">Respons cepat</span>
<span class="text-[12px] text-on-surface-variant">&amp; gratis konsultasi</span>
</div>
</div>
</div>
</div>
</div>
<div class="w-full md:w-1/2 bg-workshop-green relative flex items-center justify-center p-8 md:p-0">
<div class="relative w-full h-full flex items-center justify-center transform hover:scale-105 transition-transform duration-700 ease-out">
<img alt="Red Nike Sneaker" class="w-4/5 object-contain drop-shadow-[0_35px_35px_rgba(0,0,0,0.4)]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoUtnNPmyEHrfPdAlDRWVVVj1rnHRv-FUhd2fEO4yUhg_5TfDRlb4c1oSsqq7AEEADm7aUMItqXaJEXEvxweUWtuf9U_rHLR75nErTp9h3Id9QWzeHu4zVx6yQYz0hoOptL67Y0DImXLPQyhmGiWZFxuIqXG6ahxmeP9gEL23kHudyPnV8UAZwKFGE1JOO35TG0KBWBpb3XsguEQ05WxpGIjAt0JkzasNPsI273nADEkS42j3v3w2RpEo-nCzgyjKFNJAqqrnuq9xm"/>
<div class="absolute bottom-12 right-12 bg-workshop-dark text-white px-8 py-4 rounded-2xl flex flex-col items-center gap-0 group">
<span class="font-label-sm text-label-sm tracking-[0.2em] opacity-80">SHOE</span>
<span class="font-headline-lg text-headline-lg !text-[24px] text-workshop-yellow group-hover:text-white transition-colors uppercase">Workshop</span>
</div>
</div>
</div>
</section>
<!-- 1. Layanan Kami -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto bg-surface" id="layanan">
<div class="text-center mb-16 space-y-4">
<p class="font-label-sm text-label-sm text-workshop-green tracking-widest uppercase">Layanan Kami</p>
<h2 class="font-headline-lg text-headline-lg text-workshop-dark">Solusi Terbaik Untuk Sepatu Anda</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
<div class="bg-surface p-8 rounded-2xl border border-outline-variant flex flex-col gap-4 hover:border-workshop-green hover:shadow-xl transition-all group">
<div class="w-12 h-12 rounded-xl bg-workshop-green/10 flex items-center justify-center">
<span class="material-symbols-outlined text-workshop-green">construction</span>
</div>
<h3 class="font-title-md text-title-md text-workshop-dark">Lem &amp; Jahit</h3>
<p class="text-on-surface-variant text-body-md">Sol lepas, jahitan terbuka? Kami perbaiki dengan lem standar industri dan teknik jahit manual yang kuat.</p>
</div>
<div class="bg-surface p-8 rounded-2xl border border-outline-variant flex flex-col gap-4 hover:border-workshop-green hover:shadow-xl transition-all group">
<div class="w-12 h-12 rounded-xl bg-workshop-green/10 flex items-center justify-center">
<span class="material-symbols-outlined text-workshop-green">palette</span>
</div>
<h3 class="font-title-md text-title-md text-workshop-dark">Repaint</h3>
<p class="text-on-surface-variant text-body-md">Warna sepatu pudar? Kami cat ulang dengan warna aslinya menggunakan cat khusus material sepatu.</p>
</div>
<div class="bg-surface p-8 rounded-2xl border border-outline-variant flex flex-col gap-4 hover:border-workshop-green hover:shadow-xl transition-all group">
<div class="w-12 h-12 rounded-xl bg-workshop-green/10 flex items-center justify-center">
<span class="material-symbols-outlined text-workshop-green">clean_hands</span>
</div>
<h3 class="font-title-md text-title-md text-workshop-dark">Deep Clean</h3>
<p class="text-on-surface-variant text-body-md">Pembersihan menyeluruh hingga ke sela-sela terdalam untuk membunuh bakteri dan menghilangkan noda membandel.</p>
</div>
<div class="bg-surface p-8 rounded-2xl border border-outline-variant flex flex-col gap-4 hover:border-workshop-green hover:shadow-xl transition-all group">
<div class="w-12 h-12 rounded-xl bg-workshop-green/10 flex items-center justify-center">
<span class="material-symbols-outlined text-workshop-green">hardware</span>
</div>
<h3 class="font-title-md text-title-md text-workshop-dark">Perbaikan Upper</h3>
<p class="text-on-surface-variant text-body-md">Robek atau bolong pada bagian kain/kulit? Kami tambal dan restorasi agar kembali nyaman dipakai.</p>
</div>
</div>
<div class="mt-12 text-center">
<a class="inline-flex items-center gap-2 font-label-sm text-label-sm text-workshop-green hover:underline group" href="#">
                Lihat semua layanan 
                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</a>
</div>
</section>
<!-- 2. Portfolio -->
<section class="py-section-gap bg-surface border-y border-outline-variant" id="portfolio">
<div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
<div class="text-center mb-16 space-y-4">
<p class="font-label-sm text-label-sm text-workshop-green tracking-widest uppercase">Portfolio</p>
<h2 class="font-headline-lg text-headline-lg text-workshop-dark">Hasil Restorasi Kami</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
<div class="relative before-after-slider rounded-2xl shadow-2xl border-4 border-white group">
<div class="flex">
<div class="relative w-1/2">
<img alt="Sebelum" class="grayscale brightness-75 h-[400px] object-cover w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBFs6Q1dYGq6j3nPwZs_fSZa1SoKDBhhMVpLVfnjKQ4tzlpYMtJ7lkkGsgQB8ZE9TVjhCOu02E-3AFK53Z_h-TYOpWOJN6Dcvbfdv5c7N73E4c9sFhT564QSqhYlzBxwT4vGuu7wvi7FslnIy_t_yeNnUBWg1-WlMbK1mxGr5gxT93YegWNa5UH1v_iZUuwlWwJU0KbzMUHMcQBROzgC5u7agUrWCycPbLCGduEHRZzMJ-X16yBjFq7nhlnZ24FKCuLmRk39k2ZfiJ"/>
<div class="absolute top-4 left-4 bg-workshop-dark text-white text-[10px] px-2 py-1 rounded font-bold uppercase">Sebelum</div>
</div>
<div class="relative w-1/2">
<img alt="Sesudah" class="h-[400px] object-cover w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuByy1aGPD_nYMyQxuCelukvdDpSWgZe0wlNCGGKEbVRkxG-8BshzyNV0T2583hpOpNT2f_MYwxsfua5KVrQurHNn-hoWQPVV-TU_pqU9g4S2CYhAM4x-29uNwjGKr7IFZTBqoDO3sX34ACgigKIRyeZuE9eol5cBCKO3P_Leas-sOoM2fqk_RRSUrlu6LOEIN2dXxswSY1K1606oe3UHPJIUkhhGEVhmYTJwSvFVlGA7VwbxxrMckTU8helDPPn9a5B8q9ryEtPz41L"/>
<div class="absolute top-4 right-4 bg-workshop-green text-white text-[10px] px-2 py-1 rounded font-bold uppercase">Sesudah</div>
</div>
</div>
<div class="absolute inset-0 pointer-events-none flex items-center justify-center">
<div class="w-1 h-full bg-white relative">
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg border border-outline-variant">
<span class="material-symbols-outlined text-workshop-green">unfold_more</span>
</div>
</div>
</div>
</div>
<div class="space-y-6">
<div class="inline-block px-3 py-1 bg-workshop-green/10 text-workshop-green rounded-full font-label-sm text-[12px] uppercase">Service: Repaint &amp; Deep Clean</div>
<h3 class="font-headline-lg text-[32px] text-workshop-dark">Nike Air Force 1 Restoration</h3>
<p class="text-body-lg text-on-surface-variant leading-relaxed">
                        Sepatu ikonik ini mengalami penurunan warna yang signifikan dan noda kotoran yang sudah mengerak selama bertahun-tahun. Dengan proses deep cleaning organik dan repaint premium, kami mengembalikan kejayaan klasiknya.
                    </p>
<div class="flex items-center gap-8 py-6 border-y border-outline-variant">
<div>
<p class="text-on-surface-variant font-label-sm">Waktu Pengerjaan</p>
<p class="font-title-md text-workshop-dark">4 Hari</p>
</div>
<div>
<p class="text-on-surface-variant font-label-sm">Biaya Estimasi</p>
<p class="font-title-md text-workshop-dark">Rp 350.000</p>
</div>
</div>
<button class="flex items-center gap-2 font-label-sm text-workshop-green hover:gap-4 transition-all duration-300">
                        Lihat Portfolio Lainnya
                        <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- 3. Cara Kerja -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto bg-surface">
<div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-start">
<div class="sticky top-32">
<p class="font-label-sm text-label-sm text-workshop-green tracking-widest uppercase mb-4">Proses Kerja</p>
<h2 class="font-headline-lg text-headline-lg mb-8 text-workshop-dark">Bagaimana Kami Merawat Sepatu Anda?</h2>
<p class="text-body-lg text-on-surface-variant mb-12">
                    Kami menjaga transparansi di setiap langkah. Mulai dari konsultasi awal hingga pengiriman kembali, Anda akan selalu mendapatkan update status pengerjaan.
                </p>
<div class="bg-surface p-8 rounded-2xl border border-outline-variant border-dashed">
<div class="flex items-center gap-4">
<div class="w-12 h-12 bg-workshop-green rounded-full flex items-center justify-center text-white">
<span class="material-symbols-outlined">call</span>
</div>
<div>
<h4 class="font-title-md text-workshop-dark">Ada Pertanyaan?</h4>
<p class="text-on-surface-variant">Tim teknis kami siap menjawab konsultasi Anda.</p>
</div>
</div>
</div>
</div>
<div class="space-y-12 relative timeline-line pl-12 md:pl-0">
<div class="relative flex gap-6 group">
<div class="absolute -left-[53px] w-10 h-10 bg-white border-2 border-workshop-green rounded-full flex items-center justify-center z-10 font-bold text-workshop-green">1</div>
<div>
<h4 class="font-title-md text-title-md mb-2 group-hover:text-workshop-green transition-colors text-workshop-dark">Kirim Foto &amp; Konsultasi</h4>
<p class="text-on-surface-variant">Kirimkan foto kondisi sepatu Anda via WhatsApp. CS kami akan memberikan analisa awal dan estimasi biaya secara gratis.</p>
</div>
</div>
<div class="relative flex gap-6 group">
<div class="absolute -left-[53px] w-10 h-10 bg-white border-2 border-outline-variant rounded-full flex items-center justify-center z-10 font-bold text-on-surface-variant">2</div>
<div>
<h4 class="font-title-md text-title-md mb-2 group-hover:text-workshop-green transition-colors text-workshop-dark">Analisa Mendalam</h4>
<p class="text-on-surface-variant">Antar sepatu ke workshop kami atau gunakan jasa pickup. Kami akan melakukan pengecekan material dan struktur secara langsung.</p>
</div>
</div>
<div class="relative flex gap-6 group">
<div class="absolute -left-[53px] w-10 h-10 bg-white border-2 border-outline-variant rounded-full flex items-center justify-center z-10 font-bold text-on-surface-variant">3</div>
<div>
<h4 class="font-title-md text-title-md mb-2 group-hover:text-workshop-green transition-colors text-workshop-dark">Proses Pengerjaan</h4>
<p class="text-on-surface-variant">Dikerjakan oleh artisan berpengalaman menggunakan tools profesional dan bahan kimia premium yang aman untuk material sepatu.</p>
</div>
</div>
<div class="relative flex gap-6 group">
<div class="absolute -left-[53px] w-10 h-10 bg-white border-2 border-outline-variant rounded-full flex items-center justify-center z-10 font-bold text-on-surface-variant">4</div>
<div>
<h4 class="font-title-md text-title-md mb-2 group-hover:text-workshop-green transition-colors text-workshop-dark">Quality Control (QC)</h4>
<p class="text-on-surface-variant">Setiap sepatu wajib melewati 3 tahap pengecekan kualitas sebelum dinyatakan selesai dan siap dikirim kembali ke Anda.</p>
</div>
</div>
<div class="relative flex gap-6 group">
<div class="absolute -left-[53px] w-10 h-10 bg-workshop-green border-2 border-workshop-green rounded-full flex items-center justify-center z-10 font-bold text-white">5</div>
<div>
<h4 class="font-title-md text-title-md mb-2 group-hover:text-workshop-green transition-colors text-workshop-dark">Selesai &amp; Pengiriman</h4>
<p class="text-on-surface-variant">Sepatu Anda sudah seperti baru! Kami akan mengirimkan foto hasil akhir sebelum melakukan pengiriman atau penjadwalan kurir.</p>
</div>
</div>
</div>
</div>
</section>
<!-- 4. Review Pelanggan -->
<section class="py-section-gap bg-surface-container border-y border-outline-variant" id="review">
<div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end gap-stack-lg mb-16">
<div class="max-w-[600px] space-y-4">
<p class="font-label-sm text-label-sm text-workshop-green tracking-widest uppercase">Testimoni</p>
<h2 class="font-headline-lg text-headline-lg text-workshop-dark">Apa Kata Mereka Tentang Kami?</h2>
</div>
<div class="flex gap-4">
<button class="w-12 h-12 rounded-full border border-outline flex items-center justify-center hover:bg-white transition-colors">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="w-12 h-12 rounded-full border border-outline flex items-center justify-center hover:bg-white transition-colors">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<div class="bg-white p-8 rounded-2xl shadow-sm border border-outline-variant space-y-6">
<div class="flex text-workshop-green">
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
</div>
<p class="text-body-md text-workshop-dark italic leading-relaxed">
                        "Hasilnya memuaskan banget! Sepatu yang tadinya kusam dan solnya hampir lepas jadi kelihatan baru lagi. Pelayanan ramah dan informatif."
                    </p>
<div class="flex items-center gap-4 pt-4 border-t border-outline-variant">
<div class="w-12 h-12 rounded-full bg-surface-dim flex items-center justify-center font-bold text-on-surface-variant">RP</div>
<div>
<p class="font-title-md text-workshop-dark">Rizky Pratama</p>
<p class="text-[12px] text-on-surface-variant uppercase tracking-wider">Jakarta Selatan</p>
</div>
</div>
</div>
<div class="bg-white p-8 rounded-2xl shadow-sm border border-outline-variant space-y-6">
<div class="flex text-workshop-green">
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
</div>
<p class="text-body-md text-workshop-dark italic leading-relaxed">
                        "Workshop sepatu paling terpercaya. Sudah langganan 2 tahun buat cuci rutin sneaker koleksi. Bahan kimianya aman, gak ngerusak bahan."
                    </p>
<div class="flex items-center gap-4 pt-4 border-t border-outline-variant">
<div class="w-12 h-12 rounded-full bg-surface-dim flex items-center justify-center font-bold text-on-surface-variant">AS</div>
<div>
<p class="font-title-md text-workshop-dark">Amanda Safira</p>
<p class="text-[12px] text-on-surface-variant uppercase tracking-wider">Bandung</p>
</div>
</div>
</div>
<div class="bg-white p-8 rounded-2xl shadow-sm border border-outline-variant space-y-6">
<div class="flex text-workshop-green">
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
<span class="material-symbols-outlined fill-1">star</span>
</div>
<p class="text-body-md text-workshop-dark italic leading-relaxed">
                        "Layanan repaint-nya juara. Warnanya persis banget sama aslinya. Gak kelihatan kalau pernah di-re-color. Sukses terus Shoe Workshop!"
                    </p>
<div class="flex items-center gap-4 pt-4 border-t border-outline-variant">
<div class="w-12 h-12 rounded-full bg-surface-dim flex items-center justify-center font-bold text-on-surface-variant">DR</div>
<div>
<p class="font-title-md text-workshop-dark">Dani Ramdan</p>
<p class="text-[12px] text-on-surface-variant uppercase tracking-wider">Tangerang</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- 5. Artikel Terbaru -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto bg-surface">
<div class="flex justify-between items-center mb-12">
<h2 class="font-headline-lg text-headline-lg text-workshop-dark">Tips &amp; Edukasi Perawatan</h2>
<a class="font-label-sm text-workshop-green hover:underline flex items-center gap-1" href="#">
                Semua Artikel <span class="material-symbols-outlined">north_east</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<article class="group cursor-pointer">
<div class="aspect-[16/10] overflow-hidden rounded-xl mb-4">
<img alt="Blog 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrdMRzgm3-MmgkZ2qgyQkD0D_C7TUfTb1irfcLUIK5cGU7XB5HxbL2TIk7zQ66gp_COwSMJy5Qv45hIOs4uj7E6l9N6hcKIHLi-KDxexNBX6F4kw-aFJlrg86Q2QH9feXNbBbEA1iBZxhpbl5gqzEUuWbo5EAKgtbzob0YnQMzXgOunlME51QrNeOAuIcakM3h4sZK20f8THa6quVgERp1M6tRpeYTAg1tatU_NENxYz3xX16lZ4YxHd1z1sg4OO6vL5ZwEPuaVE6z"/>
</div>
<p class="text-[12px] text-workshop-green font-bold uppercase mb-2">Perawatan</p>
<h3 class="font-title-md text-workshop-dark group-hover:text-workshop-green transition-colors">Cara Merawat Sepatu Leather Agar Tetap Mengkilap</h3>
<p class="text-on-surface-variant text-body-sm mt-2 line-clamp-2">Pelajari teknik conditioning dan polishing yang benar untuk menjaga elastisitas kulit sepatu Anda...</p>
</article>
<article class="group cursor-pointer">
<div class="aspect-[16/10] overflow-hidden rounded-xl mb-4">
<img alt="Blog 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBEK4nzRoIqSopeBPJRFZ_roWRt7x2WBcY9i8VLmBHCikBQ3E-GDCspk_rOGHL4eR0jPuKVjwx50u8PVKilD19ZUkeZnqSVEzkNAJav3TLH31P2F93E43Ad-GXQxx36hCsZDsjXW3uFHOsWUyzPrUAe8TxDGR269Coo5JiTSTv2mIUA_-6NXy8m8xBGVa8Ww45_cCm8pFlIg9ucUn04taFCyP1AnAE1zXFAq5be0_mFpzpJZmOtBKsmDPog9kqFeYJ5zZj04ep5umm"/>
</div>
<p class="text-[12px] text-workshop-green font-bold uppercase mb-2">Pengetahuan</p>
<h3 class="font-title-md text-workshop-dark group-hover:text-workshop-green transition-colors">Mengapa Sol Sepatu Sering Lepas? Ini Alasannya</h3>
<p class="text-on-surface-variant text-body-sm mt-2 line-clamp-2">Dari masalah kelembapan hingga cara pemakaian, cari tahu faktor utama penyebab sol sepatu Anda copot...</p>
</article>
<article class="group cursor-pointer">
<div class="aspect-[16/10] overflow-hidden rounded-xl mb-4">
<img alt="Blog 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrUdLehIXm5a0ZtQNoV-krs56hnFlcdQarrW6HRtrIk8o_p-BQ6zKcN8ylyJSgA5AoEJZsNPPYMaLHRCWXdy-4dJtT3ucprhuC0VAdD4I0C1f66CpEekiK9PJGxfe-3lEHk30ClUpTtbXnS1xFdKQZQf5npuZYyYj2o0Ckcrl2qDvws1Ms0EZisAumnKzk9-mS7XlAY5dk7KcqHx-B8eUNot9kRfWXLGtRV3gwK1s77QW7yAbwwqL8XXMljta9jMcDskXXhuZ9IOrE"/>
</div>
<p class="text-[12px] text-workshop-green font-bold uppercase mb-2">Promo</p>
<h3 class="font-title-md text-workshop-dark group-hover:text-workshop-green transition-colors">Ramadhan: Deep Clean 3 Sepatu Gratis 1</h3>
<p class="text-on-surface-variant text-body-sm mt-2 line-clamp-2">Rayakan lebaran dengan sepatu bersih menawan. Nikmati promo paket cleaning terbatas selama bulan Ramadhan.</p>
</article>
</div>
</section>
<!-- 6. Tentang Kami -->
<section class="py-section-gap bg-workshop-green text-white">
<div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto flex flex-col md:flex-row items-center gap-16">
<div class="w-full md:w-1/2 relative">
<div class="grid grid-cols-2 gap-4">
<img alt="Workshop" class="rounded-xl aspect-square object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPm2DdRBKN240i8GbSy96uUxctlETJimPG2EVwCIubBELe1NsPVGlSnHMR1Frw8Ov4PQIAdF96hFSKpaVqMckIMrKLeuaG4m157XaGpwh8VsUdkMUj0aVI11OjqM2HyjjTfz-HtqLkNkLqsdfNU18dEBI7keuQ4Z9uoyNtqAH-XJoAyyPYLRRkz-TIEejDOPlmDdnK_bC3rja7UCfZJtKP0tzOFl0oXlzrubgHxpOOuHiAf-PkSk4sziyB-MC2HVEhFGU82pjlt898"/>
<img alt="Tools" class="rounded-xl aspect-square object-cover mt-8" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWkXo-wjJMiHbOZyqwo4bkipp-Th4cHTwnxrIrGzlpBtwYWycQ0Bv707HTLcIsqKayFutp6de8dAyoxGi1eboaUVvs27WT7Jxzkb-MTw--3Vlj5fVKvyfI8IIg0Y78iPQpY2VVeWaz1IJ0hdDWFNWCNRYzsE_oFIU1Wj5O0dROCBjwFcynqU40MRQH4PT0nOPkfO2mfmvz8NU-SAqqVZO2spv1-SKxRVJetEB3WPvoLFRbqhXP5_iwhOP9_XR9TIWx8agTuy-yiHl0"/>
</div>
<div class="absolute -bottom-6 -right-6 bg-workshop-yellow p-8 rounded-2xl shadow-xl hidden md:block">
<p class="text-[48px] font-bold leading-none text-workshop-dark">9+</p>
<p class="font-label-sm uppercase tracking-widest opacity-80 text-workshop-dark">Tahun Berpengalaman</p>
</div>
</div>
<div class="w-full md:w-1/2 space-y-8">
<p class="font-label-sm tracking-[0.2em] opacity-80 uppercase">Berdiri Sejak 2017</p>
<h2 class="font-display-lg text-display-lg">Workshop Spesialis Reparasi &amp; Restorasi</h2>
<p class="text-body-lg opacity-90 leading-relaxed">
                    Shoe Workshop fokus pada reparasi sepatu yang rapi, fungsional, dan bertanggung jawab. Kami percaya sepatu favorit layak dipakai lebih lama. Dengan tim ahli dan peralatan modern, kami memastikan setiap detail diperhatikan.
                </p>
<div class="grid grid-cols-2 gap-8 py-8 border-y border-white/20">
<div>
<p class="text-[32px] font-bold">100K+</p>
<p class="font-label-sm opacity-70 uppercase">Pelanggan Puas</p>
</div>
<div>
<p class="text-[32px] font-bold">100%</p>
<p class="font-label-sm opacity-70 uppercase">Garansi Pengerjaan</p>
</div>
</div>
<button class="bg-workshop-yellow text-workshop-dark px-8 py-4 rounded-lg font-title-md hover:brightness-105 transition-all flex items-center gap-2">
                    Pelajari Selengkapnya
                    <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
</section>
<!-- 7. Lokasi Kami -->
<section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto bg-surface" id="kontak">
<div class="grid grid-cols-1 md:grid-cols-2 gap-16">
<div class="space-y-8">
<h2 class="font-headline-lg text-headline-lg text-workshop-dark">Kunjungi Workshop Kami</h2>
<div class="space-y-6">
<div class="flex gap-4">
<span class="material-symbols-outlined text-workshop-green">location_on</span>
<div>
<h4 class="font-title-md text-workshop-dark">Alamat Pusat</h4>
<p class="text-on-surface-variant">Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253</p>
</div>
</div>
<div class="flex gap-4">
<span class="material-symbols-outlined text-workshop-green">schedule</span>
<div>
<h4 class="font-title-md text-workshop-dark">Jam Operasional</h4>
<p class="text-on-surface-variant">Senin - Minggu: 09.00 - 17.00 WIB</p>
</div>
</div>
<div class="flex gap-4">
<span class="material-symbols-outlined text-workshop-green">phone_iphone</span>
<div>
<h4 class="font-title-md text-workshop-dark">Kontak</h4>
<p class="text-on-surface-variant">+62 812-3456-7890</p>
<p class="text-on-surface-variant">hello@shoeworkshop.id</p>
</div>
</div>
</div>
<div class="flex gap-4 pt-4">
<a class="w-12 h-12 rounded-full border border-outline-variant flex items-center justify-center hover:bg-workshop-green hover:text-white transition-all" href="#">
<img alt="IG" class="w-5 h-5 opacity-60 hover:invert" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQAUKYmjOUklfsUhzJiUIPq0us406PPhaQTPOPNuz4tZ5-TQ_wm2ZglTv9aBI_82v3zH995Arsm5Uwx97B9HUflAKV_qcfHwOFq6XDMBJxDxBkRJubLnd0l00orLxGcxFNoKwKWlo0e0GlEOLmyd4WGqNUyRbLINQAtJKnv_qBMP1Ttyy8TVXLvc0zRuRLDH37aJK_aOkNC73ZHv6ziB6mGIW802ubpBvokf6pv-SUQ7DQVtiraEhCFA6wMZkzhP6EZA5QENKKx9NT"/>
</a>
<a class="w-12 h-12 rounded-full border border-outline-variant flex items-center justify-center hover:bg-workshop-green hover:text-white transition-all" href="#">
<img alt="TK" class="w-5 h-5 opacity-60 hover:invert" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEcIFB2ljWB2ZydVplGNU3MQOt0qx1lVnci2joJche2ud6U4ChKUPMBBY5Yb5vN-aNdUk3CfmRRqKY2wHF8aV1oRFelYIsFN1oU0ifLSYvDV9YaqNliuct_wT5vMhCNF84MQlji8dz2_IMkp5X3a03jD8sJlcncVD6_XxCWic2xTQkK0QO93_oq1KG-Jl2fsiZhkI-VspDNyGpjA6ieErP8wTKyB5saiXiTt0Q1lhrzm0yypKUq_ipZkosoXw9-gp0P6_3hQYTrkvf"/>
</a>
<a class="w-12 h-12 rounded-full border border-outline-variant flex items-center justify-center hover:bg-workshop-green hover:text-white transition-all" href="#">
<img alt="FB" class="w-5 h-5 opacity-60 hover:invert" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDwDe3d5dYyd1BslajtFFJsiYwjN00NL6a_HEzqjqiFOnq83e3XlUtOPaT7imlmu0DIXrTV2A9_cQe7pwBpI3fc1vA2rnAvpF_dbJ_I19TN4LXrz41RD25PRVD5NmKKNowm_HjFBN8p_coihbLMDId1KxRZewgUJ3TdQPNd2LZcfS1bK8VubS6hlNH-UAiOiaWWzJZ6s7CxoiXnnKSypEkBJJ8ij43gFGe2e2-Dk5v-8bTwQNzlJrq2O7oM-K_d3pOMLVT3drA9F4Ed"/>
</a>
</div>
</div>
<div class="rounded-3xl overflow-hidden shadow-2xl border-8 border-white bg-surface-dim min-h-[400px] flex flex-col">
<div class="flex-grow bg-slate-200 flex items-center justify-center relative">
<img alt="Map" class="absolute inset-0 w-full h-full object-cover opacity-50 grayscale" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB259bUzaJXj9ugDTRLh5BAe0hq2PuWg7szgQkUgqIlv-n48yFJtl_aAsQwZGUkrymRZ3puC5n1gYkcKN9uz5rHHbR7AAiYxrWiCoAJRoppkbG2vmLM4K_cRDNFI-rStmqhDJSv8SLu1vZqlzV64wkYPQpzENeBxemVC4i4PCVIei6xb75GlVsas8NMTRTPnEM3iekSKSg1CwDBm5eLn6mRfTdLegNE_XRozIcMHA3WGnbjZqtXQ7NLmkSCpGFqcEmDlZlKUHB_i3xI"/>
<div class="relative z-10 text-center p-8">
<span class="material-symbols-outlined text-[48px] text-workshop-green mb-4">location_on</span>
<p class="font-title-md text-workshop-dark">Peta Lokasi Workshop</p>
<button class="mt-4 bg-white text-workshop-dark px-6 py-2 rounded-full shadow-lg font-label-sm flex items-center gap-2 mx-auto">
                            Buka di Google Maps
                        </button>
</div>
</div>
<div class="bg-white p-6 flex justify-between items-center border-t border-outline-variant">
<div>
<p class="font-title-md text-workshop-dark">Shoe Workshop Bandung</p>
<p class="text-[12px] text-on-surface-variant">Rating 4.9/5.0 (2,400+ Review)</p>
</div>
<div class="flex -space-x-3">
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-400"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-500"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-600"></div>
</div>
</div>
</div>
</div>
</section>
<!-- Final CTA Section -->
<section class="py-stack-lg px-margin-mobile md:px-margin-desktop bg-surface">
<div class="max-w-container-max mx-auto bg-workshop-green rounded-[40px] p-12 md:p-24 overflow-hidden relative text-white text-center">
<div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
<div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>
<div class="relative z-10 space-y-8">
<h2 class="font-display-lg text-display-lg max-w-[800px] mx-auto">Siap Mengembalikan Kejayaan Sepatu Anda?</h2>
<p class="text-body-lg opacity-90 max-w-[600px] mx-auto">Konsultasikan kerusakan sepatu Anda sekarang, kirim foto dan dapatkan estimasi biaya pengerjaan segera.</p>
<div class="flex flex-wrap justify-center gap-6">
<button class="bg-workshop-yellow text-workshop-dark px-10 py-5 rounded-xl font-title-md shadow-xl hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
<span class="material-symbols-outlined">chat</span>
                        WhatsApp Sekarang
                    </button>
<button class="bg-transparent border-2 border-white/50 text-white px-10 py-5 rounded-xl font-title-md hover:bg-white/10 transition-all">
                        Pelajari Layanan
                    </button>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface py-stack-lg px-margin-mobile md:px-margin-desktop border-t border-outline-variant">
<div class="max-w-container-max mx-auto">
<div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
<div class="md:col-span-1 space-y-6">
<div class="flex flex-col leading-tight">
<span class="font-title-md text-title-md font-black text-workshop-dark">Shoe Workshop</span>
<div class="flex h-1 w-24">
<div class="w-1/2 bg-workshop-green"></div>
<div class="w-1/2 bg-workshop-yellow"></div>
</div>
</div>
<p class="text-on-surface-variant text-body-md leading-relaxed">
                    Workshop spesialis reparasi dan perawatan sepatu profesional dengan hasil terbaik di Indonesia. Menggunakan teknologi modern dan bahan premium.
                </p>
<div class="flex gap-4">
<a class="text-on-surface-variant hover:text-workshop-green transition-colors" href="#"><span class="material-symbols-outlined">facebook</span></a>
<a class="text-on-surface-variant hover:text-workshop-green transition-colors" href="#"><span class="material-symbols-outlined">public</span></a>
</div>
</div>
<div class="space-y-6">
<h4 class="font-title-md text-workshop-dark uppercase tracking-widest text-[14px]">Navigasi</h4>
<ul class="space-y-4 text-on-surface-variant font-label-sm">
<li><a class="hover:text-workshop-green transition-colors" href="#">Beranda</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#layanan">Layanan</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#portfolio">Portfolio</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#review">Review</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#">Tracking Pesanan</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#">Klaim Garansi</a></li>
</ul>
</div>
<div class="space-y-6">
<h4 class="font-title-md text-workshop-dark uppercase tracking-widest text-[14px]">Layanan</h4>
<ul class="space-y-4 text-on-surface-variant font-label-sm">
<li><a class="hover:text-workshop-green transition-colors" href="#">Treatment</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#">Reparasi Sol</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#">Reglue</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#">Perbaikan Upper</a></li>
<li><a class="hover:text-workshop-green transition-colors" href="#">Lainnya</a></li>
</ul>
</div>
<div class="space-y-6">
<h4 class="font-title-md text-workshop-dark uppercase tracking-widest text-[14px]">Kontak</h4>
<ul class="space-y-4 text-on-surface-variant font-label-sm">
<li class="flex gap-2">
<span class="material-symbols-outlined text-[18px]">call</span>
                        628123456789
                    </li>
<li class="flex gap-2">
<span class="material-symbols-outlined text-[18px]">mail</span>
                        hello@shoeworkshop.id
                    </li>
<li class="flex gap-2">
<span class="material-symbols-outlined text-[18px]">location_on</span>
<span>Jl. Kembar I No.41, Cigereleng, Kec. Regol, Bandung, 40253</span>
</li>
</ul>
</div>
</div>
<div class="pt-8 border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-4">
<p class="font-body-md text-body-md text-on-surface-variant">© 2024 Shoe Workshop. Professional Shoe Repair &amp; Maintenance.</p>
<div class="flex gap-6">
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#">Privacy Policy</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-workshop-green transition-colors" href="#">Terms of Service</a>
</div>
</div>
</div>
</footer>
<script>
    // Intersection Observer for scroll reveal
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, observerOptions);

    document.querySelectorAll('section > div, .grid > div, article').forEach(el => {
        el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700', 'ease-out');
        observer.observe(el);
    });
</script>
</body></html>