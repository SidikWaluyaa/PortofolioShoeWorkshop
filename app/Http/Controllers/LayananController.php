<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SettingService;

use App\Models\LayananCategory;

class LayananController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    ) {}

    public function index()
    {
        $categories = LayananCategory::with(['services' => function ($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();
        
        $data = [
            'intro' => [
                'headline' => 'Sepatu Bukan Sekadar Alas Kaki. Ia Bagian dari Cerita.',
                'body' => 'Setiap sepatu punya cerita — sepatu wisuda yang dipakai jalan ke depan podium, sneakers pertama hasil nabung berbulan-bulan, atau boots kerja yang setia menemani lima tahun terakhir. Reparasi sepatu bukan cuma soal memperbaiki fisik, tapi menjaga nilai dan kenangan yang menempel di dalamnya.'
            ]
        ];
        
        $settings = $this->settingService->all();

        return view('layanan', compact('data', 'categories', 'settings'));
    }
}
