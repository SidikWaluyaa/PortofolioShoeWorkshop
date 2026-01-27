<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings['site_title'] ?? config('app.name', 'Shoe Workshop') }}</title>
    <meta name="description" content="{{ $settings['site_description'] ?? '' }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #22AF85;
            --accent: #FFC232;
            --text-dark: #1F2937;
        }
        .text-primary { color: var(--primary); }
        .bg-primary { background-color: var(--primary); }
        .text-accent { color: var(--accent); }
        .bg-accent { background-color: var(--accent); }
        .btn-whatsapp {
            background-color: var(--primary);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-whatsapp:hover {
            background-color: #1a8a68;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(34, 175, 133, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    @yield('content')
</body>
</html>
