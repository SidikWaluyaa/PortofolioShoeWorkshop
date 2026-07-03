<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarrantyClaimController extends Controller
{
    private function getApiUrl()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $backendUrl = $settings['tracking_base_url'] ?? 'https://info.shoeworkshop.id';
        return rtrim($backendUrl, '/') . '/api/v1/public/warranty-claims';
    }

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        // Point the client-side JavaScript to our own local proxy routes
        $apiUrl = url('/klaim-garansi/api');

        return view('warranty_claim', compact('settings', 'apiUrl'));
    }

    /**
     * Proxy request for checking warranty availability to bypass CORS
     */
    public function check(Request $request)
    {
        $apiUrl = $this->getApiUrl();

        try {
            $response = Http::post($apiUrl . '/check', [
                'spk_number' => $request->input('spk_number'),
                'customer_phone' => $request->input('customer_phone')
            ]);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungkan ke server verifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Proxy request for submitting warranty claims to bypass CORS
     */
    public function submit(Request $request)
    {
        $apiUrl = $this->getApiUrl();

        try {
            // Forward the multipart form-data request to the backend API
            $httpRequest = Http::asMultipart();

            // Forward text fields
            if ($request->has('spk_number')) {
                $httpRequest->attach('spk_number', $request->input('spk_number'));
            }
            if ($request->has('customer_phone')) {
                $httpRequest->attach('customer_phone', $request->input('customer_phone'));
            }
            if ($request->has('problem_description')) {
                $httpRequest->attach('problem_description', $request->input('problem_description'));
            }
            if ($request->has('penggunaan')) {
                $httpRequest->attach('penggunaan', $request->input('penggunaan'));
            }

            // Forward problem photos array
            if ($request->hasFile('problem_photos')) {
                foreach ($request->file('problem_photos') as $file) {
                    $httpRequest->attach(
                        'problem_photos[]',
                        file_get_contents($file->getPathname()),
                        $file->getClientOriginalName(),
                        ['Content-Type' => $file->getClientMimeType()]
                    );
                }
            }

            // Forward Google Review photo
            if ($request->hasFile('google_review_photo')) {
                $file = $request->file('google_review_photo');
                $httpRequest->attach(
                    'google_review_photo',
                    file_get_contents($file->getPathname()),
                    $file->getClientOriginalName(),
                    ['Content-Type' => $file->getClientMimeType()]
                );
            }

            $response = $httpRequest->post($apiUrl . '/submit');

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirimkan laporan klaim: ' . $e->getMessage()
            ], 500);
        }
    }
}
