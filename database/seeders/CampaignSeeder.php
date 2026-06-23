<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Banner images are stored in database/seeders/data/campaigns/
     * and copied to storage/app/public/campaigns/ during seeding.
     *
     * Recommended banner dimensions: 1200 x 400 px (rasio 3:1).
     */
    public function run(): void
    {
        // Ensure the campaigns storage directory exists
        $storagePath = storage_path('app/public/campaigns');
        if (! File::isDirectory($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        // Copy seed banner images from database/seeders/data/campaigns/ to storage
        $seedDataPath = database_path('seeders/data/campaigns');
        $bannerFiles = ['reparasi_promo.png', 'voucher_promo.png'];

        foreach ($bannerFiles as $file) {
            $source = $seedDataPath . DIRECTORY_SEPARATOR . $file;
            $destination = $storagePath . DIRECTORY_SEPARATOR . $file;

            if (File::exists($source)) {
                File::copy($source, $destination);
            }
        }

        Campaign::create([
            'title' => 'Reparasi Sepatu untuk Donatur',
            'position' => 'catalog_top',
            'type' => 'image_upload',
            'image_path' => 'campaigns/reparasi_promo.png',
            'cta_text' => 'Pesan Reparasi',
            'target_url' => 'https://wa.me/628123456789',
            'is_active' => true,
            'start_date' => now()->subDays(2),
            'end_date' => now()->addDays(30),
            'views_count' => 0,
            'clicks_count' => 0,
        ]);

        Campaign::create([
            'title' => 'Voucher Gratis Cuci Sepatu',
            'position' => 'catalog_top',
            'type' => 'image_upload',
            'image_path' => 'campaigns/voucher_promo.png',
            'cta_text' => 'Klaim Voucher',
            'target_url' => 'https://wa.me/628123456789',
            'is_active' => true,
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(30),
            'views_count' => 0,
            'clicks_count' => 0,
        ]);
    }
}
