<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarrantyClaimController extends Controller
{
    public function index(Request $request)
    {
        $baseUrl = Setting::where('key', 'tracking_base_url')->value('value');
        
        $querySpk   = $request->get('spk');
        $queryPhone = $request->get('phone');
        
        $result = null;
        $error  = null;
        
        // Build URLs
        $warrantyClaimsApiUrl = $baseUrl ? rtrim($baseUrl, '/') . '/api/v1/public/warranty-claims' : null;
        $cxManagementUrl = $baseUrl ? rtrim($baseUrl, '/') . '/cx/warranty-claims' : null;

        // Run checking tool if query parameters are provided
        if ($querySpk && $queryPhone && $warrantyClaimsApiUrl) {
            try {
                $response = Http::post($warrantyClaimsApiUrl . '/check', [
                    'spk_number' => $querySpk,
                    'customer_phone' => $queryPhone
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if ($data['success'] ?? false) {
                        $result = $data['data'];
                    } else {
                        $error = $this->getFriendlyErrorMessage($response->status(), $data['message'] ?? null);
                    }
                } else {
                    $data = $response->json();
                    $error = $this->getFriendlyErrorMessage($response->status(), $data['message'] ?? null);
                }
            } catch (\Exception $e) {
                $error = 'Gagal menghubungi API. Mohon pastikan protokol URL di Admin -> Tracking diawali dengan https:// jika server backend mengaktifkan SSL/pengalihan HTTPS. Pesan error asli: ' . $e->getMessage();
            }
        } elseif (($querySpk || $queryPhone) && !$baseUrl) {
            $error = 'Base URL belum dikonfigurasi. Silakan lengkapi di menu Tracking terlebih dahulu.';
        }

        return view('admin.warranty.index', compact(
            'baseUrl', 
            'warrantyClaimsApiUrl', 
            'cxManagementUrl', 
            'querySpk', 
            'queryPhone', 
            'result', 
            'error'
        ));
    }

    private function getFriendlyErrorMessage($status, $rawMessage)
    {
        if (!$rawMessage) {
            return 'Gagal menghubungi server verifikasi. Silakan periksa koneksi internet Anda atau coba beberapa saat lagi.';
        }

        $msg = strtolower($rawMessage);

        if (str_contains($msg, 'method is not supported') || str_contains($msg, 'methodnotallowed') || $status === 405) {
            return 'Kendala Koneksi Sistem: Sistem verifikasi mendeteksi pengalihan koneksi (HTTP/HTTPS) dari browser ke server. Silakan pastikan setelan link menggunakan protokol HTTPS di Admin Settings jika server Anda berjalan dengan SSL.';
        }

        if (str_contains($msg, 'tidak ditemukan') || str_contains($msg, 'not found') || str_contains($msg, 'tidak cocok') || $status === 404) {
            return 'Data Garansi Tidak Ditemukan: Kombinasi Nomor SPK dan Nomor WhatsApp tidak cocok atau tidak terdaftar di sistem. Mohon periksa kembali kesesuaian data pada nota fisik Anda.';
        }

        if (str_contains($msg, 'double') || str_contains($msg, 'sudah ada') || str_contains($msg, 'pending') || str_contains($msg, 'approved') || (str_contains($msg, 'aktif') && (str_contains($msg, 'klaim') || str_contains($msg, 'claim')))) {
            return 'Klaim Sedang Diproses: Klaim garansi untuk nomor SPK ini sedang dalam antrean peninjauan atau telah disetujui sebelumnya. Anda tidak dapat mengajukan klaim ganda.';
        }

        if (str_contains($msg, 'expired') || str_contains($msg, 'berakhir') || str_contains($msg, 'habis') || str_contains($msg, 'melewati')) {
            return 'Masa Garansi Berakhir: Masa berlaku garansi untuk pengerjaan sepatu ini telah berakhir. Jika Anda membutuhkan perbaikan lebih lanjut, silakan hubungi WhatsApp kami untuk konsultasi.';
        }

        if (str_contains($msg, 'selesai') || str_contains($msg, 'finish') || str_contains($msg, 'proses')) {
            return 'Pesanan Belum Selesai: Pengajuan klaim garansi hanya dapat dilakukan setelah status pesanan pengerjaan sepatu Anda telah dinyatakan SELESAI.';
        }

        return $rawMessage;
    }
}
