<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Repair orders from the workshop system, matched by the member's phone number and cached for 5 minutes.
 */
class ReparationHistoryService
{
    /** Customer-facing tracker steps; an order's `step` is the index of its current step. */
    public const STEPS = ['Diterima', 'Dicek', 'Pembayaran', 'Dikerjakan', 'QC', 'Siap diambil'];

    /**
     * Workshop status codes (see the workshop's WorkOrderStatus enum) grouped into customer-facing stages.
     * SELESAI is split by taken_date into "siap_diambil" and "diambil".
     */
    private const STAGES = [
        'SPK_PENDING' => 'belum_diterima',
        'DITERIMA' => 'dicek',
        'ASSESSMENT' => 'dicek',
        'CX_FOLLOWUP' => 'konfirmasi',
        'HOLD_FOR_CX' => 'konfirmasi',
        'WAITING_PAYMENT' => 'pembayaran',
        'WAITING_VERIFICATION' => 'verifikasi',
        'READY_TO_DISPATCH' => 'dikerjakan',
        'OTW_WORKSHOP' => 'dikerjakan',
        'PREPARATION' => 'dikerjakan',
        'SORTIR' => 'dikerjakan',
        'PRODUCTION' => 'dikerjakan',
        'REVISI' => 'dikerjakan',
        'QC' => 'qc',
        'STAGING_OUTBOUND' => 'qc',
        'DIANTAR' => 'diantar',
        'BATAL' => 'batal',
        'DONASI' => 'donasi',
        'HISTORY' => 'arsip',
    ];

    private const STAGE_STEP = [
        'belum_diterima' => 0,
        'dicek' => 1,
        'konfirmasi' => 1,
        'pembayaran' => 2,
        'verifikasi' => 2,
        'dikerjakan' => 3,
        'qc' => 4,
        'siap_diambil' => 5,
        'diantar' => 6,
        'diambil' => 6,
    ];

    /** Stages where the repair is still going on (not ready, finished, cancelled or archived). */
    public const ACTIVE_STAGES = ['belum_diterima', 'dicek', 'konfirmasi', 'pembayaran', 'verifikasi', 'dikerjakan', 'qc'];

    /**
     * Returns ['status' => success|missing_phone|missing_config|error, 'orders' => ?array, 'error' => ?string].
     */
    public function forUser(User $user): array
    {
        if (!$user->phone) {
            return ['status' => 'missing_phone', 'orders' => null, 'error' => null];
        }

        $settings = Setting::whereIn('key', ['workshop_api_base_url', 'workshop_api_key'])->pluck('value', 'key');
        $baseUrl = $settings['workshop_api_base_url'] ?? null;
        if (!$baseUrl) {
            return ['status' => 'missing_config', 'orders' => null, 'error' => 'Workshop System API belum dikonfigurasi oleh admin.'];
        }

        try {
            $orders = Cache::remember('reparation_history_' . $user->phone, 300, function () use ($baseUrl, $settings, $user) {
                $response = Http::withHeaders([
                    'X-API-KEY' => $settings['workshop_api_key'] ?? null,
                    'Accept' => 'application/json',
                ])->timeout(8)->get($baseUrl . '/customer-portal/orders', ['phone' => $user->phone]);

                $data = $response->successful() ? $response->json() : null;
                if ($data && (($data['status'] ?? null) === 'success' || ($data['success'] ?? false))) {
                    return $data['data']['work_orders'] ?? [];
                }

                throw new \Exception('Failed to retrieve data from API');
            });
        } catch (\Exception $e) {
            return ['status' => 'error', 'orders' => null, 'error' => 'Gagal mengambil data dari sistem workshop. Silakan hubungi admin kami melalui WhatsApp.'];
        }

        return ['status' => 'success', 'orders' => array_map([$this, 'present'], $orders), 'error' => null];
    }

    /**
     * Only what the customer should see. The API also sends internal notes and internal photos, and its
     * payment figures come from the SPK rather than the invoice (payments recorded on an invoice are
     * missing), so only "lunas" is shown as a payment state.
     */
    private function present(array $order): array
    {
        $code = strtoupper($order['status']['code'] ?? '');
        $takenDate = $this->date($order['taken_date'] ?? null);
        $stage = $code === 'SELESAI' ? ($takenDate ? 'diambil' : 'siap_diambil') : (self::STAGES[$code] ?? 'dikerjakan');
        $photos = collect($order['photos'] ?? [])->filter(fn ($p) => ($p['is_public'] ?? false) && !empty($p['photo_url']));
        $isWarranty = str_ends_with(strtoupper($order['spk_number'] ?? ''), '-GR');

        return [
            'spk' => $order['spk_number'] ?? '-',
            'brand' => $order['shoe_brand'] ?? null,
            'type' => $order['shoe_type'] ?? null,
            'color' => $order['shoe_color'] ?? null,
            'size' => $order['shoe_size'] ?? null,
            'status_label' => $order['status']['label'] ?? 'Diproses',
            'stage' => $stage,
            'step' => self::STAGE_STEP[$stage] ?? null,
            'is_warranty' => $isWarranty,
            'entry_date' => $this->date($order['entry_date'] ?? null),
            'estimation_date' => $this->date($order['estimation_date'] ?? null),
            'finished_date' => $this->date($order['finished_date'] ?? null),
            'taken_date' => $takenDate,
            'services' => collect($order['services'] ?? [])->map(fn ($s) => [
                'name' => $s['service_name'] ?? 'Layanan',
                'cost' => (float) ($s['cost'] ?? 0),
            ])->values()->all(),
            'total' => (float) ($order['payment']['total_amount'] ?? 0),
            'is_paid' => in_array(strtoupper((string) ($order['payment']['status'] ?? '')), ['L', 'LUNAS'], true),
            'cover' => ($photos->firstWhere('is_spk_cover', true) ?? $photos->first())['photo_url'] ?? null,
            'photos' => $photos->map(fn ($p) => ['url' => $p['photo_url'], 'caption' => $p['caption'] ?? null])->values()->all(),
        ];
    }

    private function date(?string $value): ?\Illuminate\Support\Carbon
    {
        try {
            return $value ? \Illuminate\Support\Carbon::parse($value) : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Dashboard summary: orders still being worked on and orders ready to be picked up.
     */
    public function summary(array $orders): array
    {
        $orders = collect($orders);

        return [
            'total' => $orders->count(),
            'in_progress' => $orders->whereIn('stage', self::ACTIVE_STAGES)->count(),
            'ready' => $orders->where('stage', 'siap_diambil')->values()->all(),
        ];
    }
}
