<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiDescriptionController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'merek' => 'nullable|string',
            'tipe' => 'nullable|string',
            'ukuran' => 'nullable|string',
            'warna' => 'nullable|string',
            'bahan_upper' => 'nullable|string',
            'gender' => 'nullable|string',
            'kondisi_umum' => 'required|string',
            'sol' => 'nullable|string',
            'upper' => 'nullable|string',
            'jahitan' => 'nullable|string',
            'insole' => 'nullable|string',
            'tali' => 'nullable|string',
            'kelengkapan' => 'nullable|array',
            'catatan' => 'nullable|string',
        ]);

        $namaBarang = $request->input('nama_barang', '-');
        $merek = $request->input('merek', '-');
        $ukuran = $request->input('ukuran', '-');
        $warna = $request->input('warna', '-');
        $bahan = $request->input('bahan_upper', '-');
        $gender = $request->input('gender', '-');
        
        $kondisiUmum = $request->input('kondisi_umum');
        $sol = $request->input('sol', '-');
        $upper = $request->input('upper', '-');
        $jahitan = $request->input('jahitan', '-');
        $insole = $request->input('insole', '-');
        $tali = $request->input('tali', '-');
        
        $kelengkapanArr = $request->input('kelengkapan', []);
        $kelengkapan = empty($kelengkapanArr) ? 'Tidak ada kelengkapan' : implode(', ', $kelengkapanArr);
        
        $catatan = $request->input('catatan', '');
        $services = $request->input('services', []);
        $servicesText = '';
        if (!empty($services)) {
            $servicesText = "\n\nRekomendasi Jasa/Reparasi yang perlu dilakukan:\n";
            foreach($services as $srv) {
                $nama = !empty($srv['kustom']) ? $srv['kustom'] : ($srv['layanan'] ?? '');
                if (empty($nama)) continue;
                
                $biaya = !empty($srv['biaya']) ? "Rp " . number_format($srv['biaya'], 0, ',', '.') : 'Biaya belum ditentukan';
                $wajib = ($srv['wajib'] == 'Ya') ? 'Wajib dilakukan' : 'Opsional';
                
                $servicesText .= "- $nama ($biaya) - $wajib\n";
            }
        }

        $prompt = "Buatkan deskripsi barang donasi (sepatu/tas/topi) dengan bahasa Indonesia yang natural, rapi, dan mudah dibaca (sekitar 3-5 kalimat). Gunakan fakta-fakta berikut ini tanpa menambahkan informasi palsu:\n\n"
            . "- Nama Barang: $namaBarang\n"
            . "- Merek: $merek\n"
            . "- Ukuran: $ukuran\n"
            . "- Warna: $warna\n"
            . "- Bahan Upper: $bahan\n"
            . "- Gender/Kategori: $gender\n"
            . "- Kondisi Umum: $kondisiUmum\n\n"
            . "Detail Kondisi Fisik:\n"
            . "- Sol (Outsole): $sol\n"
            . "- Upper: $upper\n"
            . "- Jahitan & Lem: $jahitan\n"
            . "- Insole & Interior: $insole\n"
            . "- Tali & Aksesoris: $tali\n"
            . "- Kelengkapan: $kelengkapan\n"
            . ($catatan ? "- Catatan Tambahan: $catatan\n" : "")
            . $servicesText
            . "\nBerikan HANYA teks deskripsinya saja tanpa basa-basi atau perkenalan AI. Jika ada rekomendasi perbaikan/reparasi, sebutkan secara ringkas dan natural bahwa barang ini memerlukan perbaikan tersebut dengan rincian biayanya.";

        try {
            $apiKey = env('OPENROUTER_API_KEY');
            $model = env('OPENROUTER_MODEL', 'openai/gpt-4o');

            if (!$apiKey) {
                return response()->json(['error' => 'API Key OpenRouter tidak ditemukan di .env'], 500);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'HTTP-Referer' => url('/'), // Optional, for OpenRouter analytics
                'X-Title' => config('app.name'),
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? '';
                
                // Clean up possible markdown artifacts if model includes them
                $content = trim(str_replace(['```', '**'], '', $content));

                return response()->json(['description' => $content]);
            } else {
                \Log::error('OpenRouter AI Error: ' . $response->body());
                return response()->json(['error' => 'API Error: ' . $response->body()], 500);
            }
        } catch (\Exception $e) {
            \Log::error('AI Generation Exception: ' . $e->getMessage());
            return response()->json(['error' => 'System Error: ' . $e->getMessage()], 500);
        }
    }
}
