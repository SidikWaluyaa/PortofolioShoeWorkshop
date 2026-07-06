<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class UpdateServicesSeeder extends Seeder
{
    public function run(): void
    {
        $newServices = [
            1 => ['name' => 'Reglue', 'description' => 'Perbaikan sol sepatu yang lepas agar kuat dan nyaman digunakan kembali.', 'icon' => '🔧'],
            2 => ['name' => 'Ganti Sole', 'description' => 'Penggantian sol sepatu secara keseluruhan dengan sol baru yang berkualitas.', 'icon' => '👟'],
            3 => ['name' => 'Upper', 'description' => 'Perbaikan bagian atas (upper) sepatu seperti sobek, retak, atau material yang mengelupas.', 'icon' => '👞'],
            4 => ['name' => 'Treatment', 'description' => 'Pembersihan dan perawatan menyeluruh (deep clean & care) untuk mengembalikan kesegaran sepatu.', 'icon' => '✨'],
        ];

        foreach ($newServices as $id => $data) {
            $service = Service::find($id);
            if ($service) {
                $service->update([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'icon' => $data['icon'],
                ]);
            } else {
                Service::create(array_merge(['id' => $id], $data, ['order' => $id - 1, 'is_active' => true]));
            }
        }
        
        // Delete any extra services if they exist beyond ID 4
        Service::where('id', '>', 4)->delete();
        
        $this->command->info('Layanan (Services) telah berhasil diperbarui!');
    }
}
