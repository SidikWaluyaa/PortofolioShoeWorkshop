<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Cara Merawat Sepatu Leather Agar Tetap Mengkilap',
                'category' => 'Shoe Care',
                'content' => 'Sepatu berbahan kulit atau leather memerlukan perawatan ekstra dibandingkan bahan canvas. Langkah pertama yang harus dilakukan adalah selalu membersihkan debu setelah dipakai menggunakan sikat halus. Jangan langsung menggunakan air, tapi gunakanlah leather cleaner yang sesuai. Oleskan secara merata dan diamkan sejenak sebelum di lap dengan kain microfiber. Untuk menjaga kelembapan kulit, gunakan leather conditioner setiap satu bulan sekali.',
                'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Mengapa Sol Sepatu Sering Lepas?',
                'category' => 'Workshop Stories',
                'content' => 'Banyak pelanggan datang ke workshop kami dengan keluhan sol sepatu yang tiba-tiba copot atau "mangap". Penyebab utamanya biasanya adalah faktor usia lem atau kondisi penyimpanan yang lembap. Di Shoe Workshop, kami mengatasi masalah ini dengan pembersihan sisa lem lama secara total sebelum mengaplikasikan lem standar industri yang tahan panas dan air. Proses ini memastikan sol menempel kuat seperti baru keluar dari pabrik.',
                'thumbnail' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'title' => 'Promo Ramadhan: Deep Clean 3 Sepatu Gratis 1',
                'category' => 'Update & promo',
                'content' => 'Menyambut bulan suci Ramadhan, Shoe Workshop memberikan penawaran spesial untuk Anda yang ingin tampil bersih saat hari raya. Cukup bawa 3 pasang sepatu untuk layanan Deep Clean, maka Anda berhak mendapatkan 1 layanan Deep Clean tambahan secara GRATIS. Promo ini berlaku selama bulan Ramadhan untuk semua jenis sepatu canvas dan leather.',
                'thumbnail' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'category' => $post['category'],
                'content' => $post['content'],
                'thumbnail' => $post['thumbnail'],
                'status' => 'published',
                'published_at' => now(),
            ]);
        }
    }
}
