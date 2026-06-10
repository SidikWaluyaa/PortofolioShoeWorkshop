<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            ['name' => 'Rizky Pratama', 'location' => 'Jakarta', 'rating' => 5, 'content' => 'Hasilnya memuaskan banget! Sepatu yang kusam kembali seperti baru. Pelayanan ramah dan cepat. Pasti langganan di Shoe Workshop.', 'order' => 1],
            ['name' => 'Sari Dewi', 'location' => 'Bandung', 'rating' => 5, 'content' => 'Sol sepatu saya yang lepas berhasil diperbaiki dengan sangat rapi. Harga terjangkau dan hasilnya bagus banget. Recommended!', 'order' => 2],
            ['name' => 'Ahmad Fauzi', 'location' => 'Bekasi', 'rating' => 5, 'content' => 'Repaint sneaker putih saya hasilnya luar biasa! Warnanya merata dan bersih. Pengerjaan cepat, dalam 3 hari sudah selesai.', 'order' => 3],
            ['name' => 'Diana Putri', 'location' => 'Depok', 'rating' => 4, 'content' => 'Pelayanannya profesional dan komunikatif. Selalu update progress pekerjaan via WhatsApp. Hasil kerja memuaskan!', 'order' => 4],
        ];
        foreach ($reviews as $review) {
            Review::create(array_merge($review, ['is_active' => true]));
        }
    }
}
