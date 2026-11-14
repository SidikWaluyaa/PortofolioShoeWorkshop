<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// One-off: hero images uploaded before WebP support are multi-megabyte PNGs that slow the home page down,
// especially on phones. Converts them to WebP (transparency kept) and points the hero at the new file.
Artisan::command('images:optimize-hero {--dry-run : Only list what would be converted}', function () {
    $disk = \Illuminate\Support\Facades\Storage::disk('public');

    foreach (\App\Models\HeroSection::whereNotNull('image')->get() as $hero) {
        $old = $hero->image;
        if (\Illuminate\Support\Str::startsWith($old, ['http://', 'https://']) || str_ends_with(strtolower($old), '.webp') || !$disk->exists($old)) {
            $this->line("Lewati #{$hero->id}: {$old}");
            continue;
        }

        $before = $disk->size($old);
        if ($this->option('dry-run')) {
            $this->line(sprintf('Akan dikonversi #%d: %s (%d KB)', $hero->id, $old, $before / 1024));
            continue;
        }

        $new = \App\Helpers\ImageCompressionHelper::storeTransparentWebp($disk->path($old), 'hero');
        if ($new === $old || !$disk->exists($new)) {
            $this->warn("Gagal mengonversi #{$hero->id}, gambar lama dipertahankan.");
            continue;
        }

        $hero->update(['image' => $new]);
        $disk->delete($old);
        $this->info(sprintf('#%d: %s (%d KB) -> %s (%d KB)', $hero->id, $old, $before / 1024, $new, $disk->size($new) / 1024));
    }
})->purpose('Convert large hero images to WebP');
