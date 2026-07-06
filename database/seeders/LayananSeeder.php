<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananCategory;
use App\Models\LayananService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        // Prevent duplicate seeding if re-run
        Schema::disableForeignKeyConstraints();
        LayananService::truncate();
        LayananCategory::truncate();
        Schema::enableForeignKeyConstraints();

        $path = storage_path('app/json/layanan.json');
        
        if (!File::exists($path)) {
            $this->command->warn("JSON file not found at {$path}");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);

        if (!isset($data['categories'])) {
            return;
        }

        foreach ($data['categories'] as $catData) {
            $category = LayananCategory::create([
                'slug' => $catData['id'],
                'order' => $catData['order'],
                'name' => $catData['name'],
                'subtitle' => $catData['subtitle'],
                'description' => $catData['description'],
                'value_material' => $catData['valueMaterial'],
                'value_kehidupan' => $catData['valueKehidupan'],
                'cta' => $catData['cta'],
            ]);

            $order = 0;
            foreach ($catData['services'] as $serviceData) {
                $isPreview = in_array($serviceData['id'], $catData['previewServiceIds']);
                
                LayananService::create([
                    'layanan_category_id' => $category->id,
                    'slug' => $serviceData['id'],
                    'name' => $serviceData['name'],
                    'subtitle_teknis' => $serviceData['subtitleTeknis'] ?? null,
                    'kapan' => $serviceData['kapan'] ?? null,
                    'proses' => $serviceData['proses'] ?? null,
                    'kenapa_penting' => $serviceData['kenapaPenting'] ?? null,
                    'image_before' => $serviceData['images']['before'] ?? null,
                    'image_after' => $serviceData['images']['after'] ?? null,
                    'is_preview' => $isPreview,
                    'order' => $order++,
                ]);
            }
        }
    }
}
