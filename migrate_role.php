<?php

$rootDir = __DIR__;

echo "1. Mengubah nama direktori Controllers...\n";
if (file_exists("$rootDir/app/Http/Controllers/Donatur")) {
    rename("$rootDir/app/Http/Controllers/Donatur", "$rootDir/app/Http/Controllers/Member");
}

echo "2. Mengubah nama direktori Views...\n";
if (file_exists("$rootDir/resources/views/donatur")) {
    rename("$rootDir/resources/views/donatur", "$rootDir/resources/views/member");
}

echo "3. Mengubah nama file layouts...\n";
$layoutFiles = [
    "$rootDir/resources/views/layouts/donatur.blade.php" => "$rootDir/resources/views/layouts/member.blade.php",
    "$rootDir/resources/views/layouts/navigation-donatur.blade.php" => "$rootDir/resources/views/layouts/navigation-member.blade.php",
    "$rootDir/resources/views/components/donatur-layout.blade.php" => "$rootDir/resources/views/components/member-layout.blade.php",
];
foreach ($layoutFiles as $old => $new) {
    if (file_exists($old)) {
        rename($old, $new);
    }
}

echo "4. Mengganti string 'donatur' menjadi 'member' di dalam file view...\n";
$directoriesToScan = [
    "$rootDir/resources/views/member", // sudah di-rename
    "$rootDir/resources/views/auth",
    "$rootDir/resources/views/profile",
    "$rootDir/resources/views/layouts",
    "$rootDir/resources/views/components",
];

foreach ($directoriesToScan as $dir) {
    if (!file_exists($dir)) continue;
    
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $path = $file->getPathname();
            $content = file_get_contents($path);
            
            $originalContent = $content;
            
            // Lakukan replacement yang spesifik (bukan semua kata donatur agar tidak merusak kata di paragraf publik)
            $content = str_replace("route('donatur.", "route('member.", $content);
            $content = str_replace('route("donatur.', 'route("member.', $content);
            $content = str_replace("x-donatur-layout", "x-member-layout", $content);
            $content = str_replace("layouts.donatur", "layouts.member", $content);
            $content = str_replace("layouts.navigation-donatur", "layouts.navigation-member", $content);
            
            // Text Dashboard
            $content = str_replace("Dashboard Donatur", "Dashboard Member", $content);
            $content = str_replace("Dashboard Anda sebagai Donatur", "Dashboard Anda sebagai Member", $content);
            $content = str_replace("Login sebagai Donatur", "Login sebagai Member", $content);
            
            if ($content !== $originalContent) {
                file_put_contents($path, $content);
                echo " - Updated: " . basename($path) . "\n";
            }
        }
    }
}

echo "Selesai! Anda sekarang bisa menjalankan php artisan migrate\n";
