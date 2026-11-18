<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * A finished SPK that gets extra non-OTO services returns to PRODUCTION with status TAMBAH_JASA.
 */
class TrackingTambahJasaTest extends TestCase
{
    use RefreshDatabase;

    private const DESCRIPTION = 'Order sedang dalam proses pengerjaan layanan tambahan (Tambah Jasa): Repaint.';

    private function track(array $extra = [], string $code = 'TAMBAH_JASA')
    {
        Setting::create(['key' => 'tracking_base_url', 'value' => 'https://workshop.test']);
        Http::fake(['workshop.test/*' => Http::response(['success' => true, 'data' => array_merge([
            'spk_number' => 'S-2611-01-0001-SW',
            'current_status' => [
                'code' => $code,
                'label' => 'Production (Sedang Mengerjakan Tambah Jasa)',
                'description' => self::DESCRIPTION,
            ],
            'timeline' => [
                'PRODUCTION' => ['label' => 'Service', 'is_completed' => false, 'is_current' => true],
                'SELESAI' => ['label' => 'Selesai', 'is_completed' => false, 'is_current' => false],
            ],
        ], $extra)])]);

        return $this->get(route('tracking.index', ['q' => 'S-2611-01-0001-SW']))->assertOk();
    }

    public function test_status_code_alone_shows_the_banner_once(): void
    {
        $html = $this->track()
            ->assertSee('Sedang Mengerjakan Tambah Jasa')
            ->assertSee('bg-sky-500', false)
            ->getContent();

        $this->assertSame(1, substr_count($html, self::DESCRIPTION));
    }

    public function test_tambah_jasa_fields_are_used_when_the_api_sends_them(): void
    {
        $this->track([
            'is_tambah_jasa' => true,
            'tambah_jasa_title' => 'Judul dari API',
            'tambah_jasa_message' => 'Pesan dari API',
            'tambah_jasa_services' => ['Repaint', 'Ganti Sol'],
        ])->assertSee('Judul dari API')->assertSee('Pesan dari API')->assertSee('Repaint')->assertSee('Ganti Sol');
    }

    public function test_other_statuses_do_not_show_the_banner(): void
    {
        $this->track([], 'PRODUCTION')->assertDontSee('Sedang Mengerjakan Tambah Jasa</p>', false)->assertDontSee('bg-sky-500', false);
    }
}
