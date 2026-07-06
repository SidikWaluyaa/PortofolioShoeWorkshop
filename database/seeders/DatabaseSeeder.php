<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\HeroSection;
use App\Models\TrustItem;
use App\Models\Service;
use App\Models\Project;
use App\Models\Workflow;
use App\Models\AboutSection;
use App\Models\CtaSection;
use App\Models\Setting;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Shoe Workshop',
            'email' => 'admin@shoeworkshop.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->call(PostSeeder::class);
        $this->call(DonationItemSeeder::class);

        HeroSection::create([
            'title' => 'Reparasi & Perawatan Sepatu Profesional',
            'subtitle' => 'Kembalikan sepatu kesayangan Anda seperti baru. Dikerjakan oleh tenaga berpengalaman dengan material berkualitas dan hasil rapi.',
            'primary_cta_text' => 'Konsultasi via WhatsApp',
            'primary_cta_link' => 'https://wa.me/628123456789',
            'secondary_cta_text' => 'Lihat Hasil Before–After',
            'secondary_cta_link' => '#portfolio',
            'is_active' => true,
        ]);

        HeroSection::create([
            'title' => 'Salurkan Sepatu Layak Pakai Anda',
            'subtitle' => 'Bantu sesama dengan mendonasikan sepatu bekas layak pakai Anda. Kami akan merestorasi sepatu tersebut agar kembali bersih, kokoh, dan siap disalurkan kepada mereka yang membutuhkan.',
            'primary_cta_text' => 'Mulai Donasi Sepatu',
            'primary_cta_link' => '/donatur/donations/create',
            'secondary_cta_text' => 'Lihat Katalog Donasi',
            'secondary_cta_link' => '/donasi-katalog',
            'image' => 'hero/open_donasi_hero.png',
            'is_active' => true,
        ]);

        $trustItems = [
            ['icon' => '🛡️', 'label' => 'Garansi Hasil'],
            ['icon' => '⚡', 'label' => 'Proses Cepat'],
            ['icon' => '💎', 'label' => 'Bahan Premium'],
            ['icon' => '🤝', 'label' => 'Terpercaya'],
        ];
        foreach ($trustItems as $index => $item) {
            TrustItem::create(['icon' => $item['icon'], 'label' => $item['label'], 'order' => $index, 'is_active' => true]);
        }

        $services = [
            ['name' => 'Reglue', 'description' => 'Perbaikan sol sepatu yang lepas agar kuat dan nyaman digunakan kembali.', 'icon' => '🔧'],
            ['name' => 'Ganti Sole', 'description' => 'Penggantian sol sepatu secara keseluruhan dengan sol baru yang berkualitas.', 'icon' => '👟'],
            ['name' => 'Upper', 'description' => 'Perbaikan bagian atas (upper) sepatu seperti sobek, retak, atau material yang mengelupas.', 'icon' => '👞'],
            ['name' => 'Treatment', 'description' => 'Pembersihan dan perawatan menyeluruh (deep clean & care) untuk mengembalikan kesegaran sepatu.', 'icon' => '✨'],
        ];
        foreach ($services as $index => $service) {
            Service::create(['name' => $service['name'], 'description' => $service['description'], 'icon' => $service['icon'], 'order' => $index, 'is_active' => true]);
        }

        $workflows = [
            ['title' => 'Konsultasi', 'icon' => '💬', 'step_order' => 1],
            ['title' => 'Pickup / Kirim', 'icon' => '📦', 'step_order' => 2],
            ['title' => 'Proses Pengerjaan', 'icon' => '🛠️', 'step_order' => 3],
            ['title' => 'Selesai & Dikirim', 'icon' => '✅', 'step_order' => 4],
        ];
        foreach ($workflows as $workflow) {
            Workflow::create(['title' => $workflow['title'], 'icon' => $workflow['icon'], 'step_order' => $workflow['step_order'], 'is_active' => true]);
        }

        AboutSection::create([
            'title' => 'Berdiri Sejak 2017',
            'description' => "Shoe Workshop fokus pada reparasi sepatu yang rapi, fungsional, dan bertanggung jawab.\n\nKami percaya sepatu favorit layak dipakai lebih lama. Dengan tim ahli dan peralatan modern, kami memastikan setiap detail diperhatikan.",
            'is_active' => true,
        ]);

        Project::create([
            'title' => 'Restorasi Sneaker White',
            'description' => 'Deep Clean, Repaint, Reglue',
            'before_image' => '',
            'after_image' => '',
            'service_id' => 1,
            'is_active' => true,
            'is_featured' => true,
        ]);

        CtaSection::create([
            'title' => 'Butuh saran perawatan atau estimasi biaya?',
            'subtitle' => 'Konsultasikan sepatu Anda sekarang juga. Tim kami siap membantu Anda.',
            'button_text' => 'Konsultasi via WhatsApp',
            'button_link' => 'https://wa.me/628123456789',
            'is_active' => true,
        ]);

        $settings = [
            'site_title' => 'Shoe Workshop',
            'site_description' => 'Workshop spesialis reparasi dan perawatan sepatu profesional dengan hasil terbaik.',
            'whatsapp_number' => '628123456789',
            'address' => 'Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253',
            'email' => 'info@shoeworkshop.id',
            'instagram_link' => 'https://instagram.com/shoeworkshop',
            'tiktok_link' => 'https://tiktok.com/@shoeworkshop',
            'facebook_link' => 'https://facebook.com/shoeworkshop',
            'workshop_api_base_url' => 'https://info.shoeworkshop.id/api/v1',
            'workshop_api_key' => '',
        ];
        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        // Sample reviews
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