<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Shoe Workshop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito-sans:400,600,700,800,900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
        <!-- Top accent -->
        <div class="h-2 w-full bg-[#22AF85]"></div>
        
        <div class="p-8 text-center">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Shoe Workshop Logo" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                    <span class="text-xl font-black text-gray-800 tracking-tight leading-none text-left">
                        SHOE<br><span class="text-[#22AF85]">WORKSHOP</span>
                    </span>
                </a>
            </div>

            <!-- Error Icon -->
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-50 border-8 border-white shadow-sm mb-6 text-gray-300">
                <span class="material-symbols-outlined text-5xl">
                    @yield('icon', 'error')
                </span>
            </div>

            <!-- Error Code -->
            <h1 class="text-6xl font-black text-gray-900 mb-2 tracking-tighter">
                @yield('code')
            </h1>
            
            <!-- Error Title -->
            <h2 class="text-xl font-bold text-gray-800 mb-3">
                @yield('title')
            </h2>
            
            <!-- Error Message -->
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                @yield('message')
            </p>

            <!-- Action Button -->
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center w-full px-6 py-3.5 bg-[#22AF85] hover:bg-[#1a936f] text-white font-bold text-sm rounded-xl transition-colors shadow-lg shadow-[#22AF85]/20 gap-2">
                <span class="material-symbols-outlined text-[18px]">home</span>
                Kembali ke Beranda
            </a>
        </div>
        
        <!-- Bottom Pattern/Shape -->
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gray-50/50 -skew-y-3 transform origin-bottom-right -z-10"></div>
    </div>
</body>
</html>
