<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $baseUrl = Setting::where('key', 'tracking_base_url')->value('value');
        $query   = $request->get('q');
        $result  = null;
        $error   = null;

        if ($query && $baseUrl) {
            try {
                // Endpoint publik - tidak perlu autentikasi
                $response = Http::get($baseUrl . '/api/v1/public/track', [
                    'spk_number' => $query
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['success'] ?? false) {
                        $result = $data['data'];
                    } else {
                        $error = $data['message'] ?? 'SPK tidak ditemukan.';
                    }
                } else {
                    $error = 'Gagal mengambil data dari API.';
                }
            } catch (\Exception $e) {
                $error = 'Gagal menghubungi API. Pesan: ' . $e->getMessage();
            }
        } elseif ($query && !$baseUrl) {
            $error = 'Base URL tracking belum dikonfigurasi.';
        }

        return view('admin.tracking.index', compact('baseUrl', 'query', 'result', 'error'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'tracking_base_url' => 'required|url'
        ]);

        Setting::updateOrCreate(
            ['key' => 'tracking_base_url'],
            ['value' => $request->tracking_base_url]
        );

        return redirect()->route('admin.tracking.index')->with('api_saved', true);
    }
}