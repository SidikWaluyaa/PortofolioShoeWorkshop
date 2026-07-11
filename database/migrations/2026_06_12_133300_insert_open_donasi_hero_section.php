<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('hero_sections')->insert([
            'title' => 'Salurkan Sepatu Layak Pakai Anda',
            'subtitle' => 'Bantu sesama dengan mendonasikan sepatu bekas layak pakai Anda. Kami akan merestorasi sepatu tersebut agar kembali bersih, kokoh, dan siap disalurkan kepada mereka yang membutuhkan.',
            'primary_cta_text' => 'Mulai Donasi Sepatu',
            'primary_cta_link' => '/member/donations/create',
            'secondary_cta_text' => 'Lihat Katalog Donasi',
            'secondary_cta_link' => '/donasi-katalog',
            'image' => 'hero/open_donasi_hero.png',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('hero_sections')->where('title', 'Salurkan Sepatu Layak Pakai Anda')->delete();
    }
};
