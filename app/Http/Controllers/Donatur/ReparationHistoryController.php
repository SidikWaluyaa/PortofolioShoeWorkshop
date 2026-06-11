<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ReparationHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $phone = $user->phone;

        // 1. Check if user has phone number in profile
        if (!$phone) {
            return view('donatur.reparation_history.index', [
                'status' => 'missing_phone',
                'orders' => null,
                'error' => null
            ]);
        }

        // 2. Fetch API configuration settings
        $settings = Setting::pluck('value', 'key')->toArray();
        $baseUrl = $settings['workshop_api_base_url'] ?? null;
        $apiKey = $settings['workshop_api_key'] ?? null;

        if (!$baseUrl) {
            return view('donatur.reparation_history.index', [
                'status' => 'missing_config',
                'orders' => null,
                'error' => 'Workshop System API belum dikonfigurasi oleh admin.'
            ]);
        }

        $result = null;
        $error = null;
        $status = 'success';

        // 3. Make HTTP GET request with 5 minute cache
        try {
            $cacheKey = 'reparation_history_' . $phone;
            
            $result = Cache::remember($cacheKey, 300, function () use ($baseUrl, $apiKey, $phone) {
                $response = Http::withHeaders([
                    'X-API-KEY' => $apiKey,
                    'Accept' => 'application/json'
                ])->timeout(8)->get($baseUrl . '/customer-portal/orders', [
                    'phone' => $phone
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['status'] === 'success' || ($data['success'] ?? false)) {
                        return $data['data']['work_orders'] ?? [];
                    }
                }
                
                throw new \Exception('Failed to retrieve data from API');
            });
        } catch (\Exception $e) {
            $status = 'error';
            $error = 'Gagal mengambil data dari sistem workshop. Silakan hubungi admin kami melalui WhatsApp.';
            $result = null;
        }

        return view('donatur.reparation_history.index', [
            'status' => $status,
            'orders' => $result,
            'error' => $error
        ]);
    }
}
