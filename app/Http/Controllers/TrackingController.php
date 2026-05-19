<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $baseUrl  = $settings['tracking_base_url'] ?? null;
        $query    = $request->get('q');
        $result   = null;
        $error    = null;

        if ($query && $baseUrl) {
            try {
                // Menggunakan endpoint publik tanpa autentikasi (sesuai API spec)
                $response = Http::get($baseUrl . '/api/v1/public/track', [
                    'spk_number' => $query
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['success'] ?? false) {
                        $result = $data['data'];
                    } else {
                        $error = $data['message'] ?? 'Pesanan tidak ditemukan.';
                    }
                } else {
                    $error = 'Pesanan tidak ditemukan.';
                }
            } catch (\Exception $e) {
                $error = 'Gagal menghubungi sistem tracking.';
            }
        } elseif ($query && !$baseUrl) {
            $error = 'Sistem tracking belum dikonfigurasi.';
        }

        return view('tracking', compact('settings', 'query', 'result', 'error'));
    }
}