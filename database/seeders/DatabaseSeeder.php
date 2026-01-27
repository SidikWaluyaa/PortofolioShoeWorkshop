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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin Shoe Workshop',
            'email' => 'admin@shoeworkshop.com',
            'password' => Hash::make('password'),
        ]);

        // Blog Posts
        $this->call(PostSeeder::class);

        // Hero Section
        HeroSection::create([
            'title' => 'Reparasi Sepatu Profesional',
            'subtitle' => 'Sepatu favoritmu rusak? Kirim fotonya, kami bantu cek dan rekomendasikan solusinya.',
            'primary_cta_text' => 'Konsultasi via WhatsApp',
            'primary_cta_link' => 'https://wa.me/628123456789',
            'secondary_cta_text' => 'Lihat Hasil Before–After',
            'secondary_cta_link' => '#portfolio',
            'is_active' => true,
        ]);

        // Trust Items
        $trustItems = [
            ['icon' => '🛡️', 'label' => 'Garansi Hasil'],
            ['icon' => '⚡', 'label' => 'Proses Cepat'],
            ['icon' => '💎', 'label' => 'Bahan Premium'],
            ['icon' => '🤝', 'label' => 'Terpercaya'],
        ];
        foreach ($trustItems as $index => $item) {
            TrustItem::create([
                'icon' => $item['icon'],
                'label' => $item['label'],
                'order' => $index,
                'is_active' => true,
            ]);
        }

        // Services
        $services = [
            ['name' => 'Lem & Jahit', 'description' => 'Sol lepas, jahitan terbuka? Kami perbaiki dengan lem standar industri.', 'icon' => '🧵'],
            ['name' => 'Repaint', 'description' => 'Warna sepatu pudar? Kami cat ulang dengan warna aslinya.', 'icon' => '🎨'],
            ['name' => 'Deep Clean', 'description' => 'Pembersihan menyeluruh hingga ke sela-sela terdalam sepatu Anda.', 'icon' => '✨'],
            ['name' => 'Perbaikan Upper', 'description' => 'Robek atau bolong pada bagian kain/kulit sepatu.', 'icon' => '👞'],
        ];
        foreach ($services as $index => $service) {
            Service::create([
                'name' => $service['name'],
                'description' => $service['description'],
                'icon' => $service['icon'],
                'order' => $index,
                'is_active' => true,
            ]);
        }

        // Workflows
        $workflows = [
            ['title' => 'Kirim Foto', 'icon' => '📸', 'step_order' => 1],
            ['title' => 'Analisa', 'icon' => '🧠', 'step_order' => 2],
            ['title' => 'Proses', 'icon' => '🛠️', 'step_order' => 3],
            ['title' => 'QC', 'icon' => '✅', 'step_order' => 4],
            ['title' => 'Selesai', 'icon' => '📦', 'step_order' => 5],
        ];
        foreach ($workflows as $workflow) {
            Workflow::create([
                'title' => $workflow['title'],
                'icon' => $workflow['icon'],
                'step_order' => $workflow['step_order'],
                'is_active' => true,
            ]);
        }

        // About Section
        AboutSection::create([
            'title' => 'Berdiri Sejak 2017',
            'description' => "Shoe Workshop fokus pada reparasi sepatu yang rapi, fungsional, dan bertanggung jawab.\n\nKami percaya sepatu favorit layak dipakai lebih lama. Dengan tim ahli dan peralatan modern, kami memastikan setiap detail diperhatikan.",
            'is_active' => true,
        ]);

        // Projects (Portfolio)
        $projects = [
            ['title' => 'Repaint', 'service_id' => 2],
            ['title' => 'Ganti Sol', 'service_id' => 4],
            ['title' => 'Deep Clean', 'service_id' => 3],
        ];
        foreach ($projects as $project) {
            Project::create([
                'title' => $project['title'],
                'description' => 'Hasil pengerjaan profesional untuk ' . $project['title'],
                'before_image' => '',
                'after_image' => '',
                'service_id' => $project['service_id'],
                'is_active' => true,
                'is_featured' => true,
            ]);
        }

        // CTA Section
        CtaSection::create([
            'title' => 'Siap dicek dulu sepatunya?',
            'subtitle' => 'Kirim foto sekarang, kami bantu analisa.',
            'button_text' => 'Konsultasi via WhatsApp',
            'button_link' => 'https://wa.me/628123456789',
            'is_active' => true,
        ]);

        // Settings
        $settings = [
            'site_title' => 'Shoe Workshop - Profesional Shoe Care',
            'site_description' => 'Jasa reparasi dan perawatan sepatu profesional. Kembalikan kondisi sepatu favoritmu.',
            'whatsapp_number' => '628123456789',
            'address' => 'Jl. Kebahagiaan No. 88, Jakarta',
            'email' => 'hello@shoeworkshop.id',
            'instagram_link' => 'https://instagram.com/shoeworkshop',
            'tiktok_link' => 'https://tiktok.com/@shoeworkshop',
            'facebook_link' => 'https://facebook.com/shoeworkshop',
        ];
        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }
    }
}
