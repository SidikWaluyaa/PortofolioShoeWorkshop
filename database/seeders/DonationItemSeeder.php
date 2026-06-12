<?php

namespace Database\Seeders;

use App\Models\DonationItem;
use Illuminate\Database\Seeder;

class DonationItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Nike Air Max (Tersedia)
        DonationItem::create([
            'nama' => 'Nike Air Max 90 White',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'kondisi' => 'seperti_baru',
            'ukuran' => 'US 10.5',
            'status' => 'tersedia',
            'deskripsi' => 'Reparasi reglue sol bagian samping dan deep cleaning menyeluruh. Kondisi sol sangat kokoh and siap pakai kembali.',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
            'foto_detail' => [
                'images/katalog/nike_air_max.png',
                'images/katalog/nike_air_max.png',
                'images/katalog/nike_air_max.png'
            ]
        ]);

        // 2. Leather Backpack (Tersedia)
        DonationItem::create([
            'nama' => 'Classic Leather Backpack Brown',
            'brand' => 'Jansport',
            'kategori' => 'tas',
            'kondisi' => 'sudah_diperbaiki',
            'ukuran' => 'Medium',
            'status' => 'tersedia',
            'deskripsi' => 'Perbaikan resleting utama yang macet dan pewarnaan ulang (repaint) kulit asli agar kembali mengkilap dan bebas jamur.',
            'foto_utama_path' => 'images/katalog/leather_bag.png',
            'foto_detail' => [
                'images/katalog/leather_bag.png',
                'images/katalog/leather_bag.png'
            ]
        ]);

        // 3. Vintage Baseball Cap (Tersedia)
        DonationItem::create([
            'nama' => 'Vintage Navy Baseball Cap',
            'brand' => 'New Era',
            'kategori' => 'topi',
            'kondisi' => 'sudah_diperbaiki',
            'ukuran' => 'All Size',
            'status' => 'tersedia',
            'deskripsi' => 'Restorasi bentuk (reshaping) topi agar tegak kembali, pencucian noda keringat bandel (sweatband cleaning), dan pencegahan pemudaran warna.',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
            'foto_detail' => [
                'images/katalog/vintage_cap.png',
                'images/katalog/vintage_cap.png'
            ]
        ]);

        // 4. Adidas Ultraboost (Sudah Disalurkan)
        DonationItem::create([
            'nama' => 'Adidas Ultraboost 21 Triple Black',
            'brand' => 'Adidas',
            'kategori' => 'sepatu',
            'kondisi' => 'seperti_baru',
            'ukuran' => 'US 11.0',
            'status' => 'disalurkan',
            'deskripsi' => 'Perbaikan rajutan upper (stitching upper) yang sedikit sobek dan pewarnaan ulang midsole boost hitam agar pekat kembali.',
            'foto_utama_path' => 'images/katalog/nike_air_max.png', // Fallback to nike image for mock
            'foto_detail' => [
                'images/katalog/nike_air_max.png'
            ]
        ]);
    }
}
