<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Public Google Maps reviews of Shoe Workshop (copied as written, emoji dropped; dates are approximate
     * from Google's "x bulan lalu") and the Google rating shown in the testimonial section.
     */
    public function up(): void
    {
        $reviews = [
            [
                'name' => 'Julian Putra',
                'rating' => 5,
                'reviewed_at' => '2026-07-01',
                'is_active' => true,
                'content' => 'Pelayanan baik, Ramah, profesional dan amanah dengan barang konsumen. Sepatu direpair selesai tepat waktu, namun blm saya ambil setahun lebih dan ternyata sepatunya masih utuh dan lengkap. Terimakasih atas pelayanannya dan sukses selalu.',
            ],
            [
                'name' => 'Nur Cholis',
                'rating' => 5,
                'reviewed_at' => '2026-10-01',
                'is_active' => true,
                'content' => 'Terima kasih sudah memperbaiki sepatu saya, semoga kualitas lem dan perbaikannya bagus dan awet, karena sepatu in hanya saya gunakan saat gym legday',
            ],
            [
                'name' => 'Deka Putra',
                'rating' => 5,
                'reviewed_at' => '2026-08-01',
                'is_active' => false,
                'content' => 'Alhamdulillah sepatu akhirnya selesai dan sudah sampai, walau jantung dag dig dug, tapi selesai juga. Untuk Pelayanan baik, Ramah, profesional dan amanah dengan barang konsumen. Sepatu direpair hasilnya bagus namun belum di uji dengan memakainya, tunggu nanti setelah pemakaian nanti di kasih penilaian lg y. Terimakasih atas pelayanannya dan sukses selalu.',
            ],
        ];

        $order = (int) DB::table('reviews')->max('order');

        foreach ($reviews as $review) {
            if (DB::table('reviews')->where('name', $review['name'])->where('source', 'google')->exists()) {
                continue;
            }

            DB::table('reviews')->insert($review + [
                'source' => 'google',
                'order' => ++$order,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $settings = [
            'google_rating' => '4,4',
            'google_review_count' => '2.315',
            'google_maps_url' => 'https://maps.google.com/?cid=3639147444848206928',
        ];

        foreach ($settings as $key => $value) {
            if (!DB::table('settings')->where('key', $key)->exists()) {
                DB::table('settings')->insert(['key' => $key, 'value' => $value, 'created_at' => now(), 'updated_at' => now()]);
            }
        }
    }

    public function down(): void
    {
        DB::table('reviews')->where('source', 'google')->whereIn('name', ['Julian Putra', 'Nur Cholis', 'Deka Putra'])->delete();
        DB::table('settings')->whereIn('key', ['google_rating', 'google_review_count', 'google_maps_url'])->delete();
    }
};
