<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ReparationHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::clear();
    }

    /**
     * Test guest is redirected to login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('donatur.reparation-history.index'));
        $response->assertRedirect('/login');
    }

    /**
     * Test user with missing phone number shows profile completion alert.
     */
    public function test_user_missing_phone_shows_profile_alert(): void
    {
        $user = User::factory()->create(['role' => 'user', 'phone' => null]);
        $this->actingAs($user);

        $response = $this->get(route('donatur.reparation-history.index'));
        $response->assertStatus(200);
        $response->assertSee('Nomor Telepon Belum Dilengkapi');
    }

    /**
     * Test user with phone but unconfigured API shows warning alert.
     */
    public function test_unconfigured_api_shows_warning_alert(): void
    {
        $user = User::factory()->create(['role' => 'user', 'phone' => '628123456789']);
        $this->actingAs($user);

        // Make sure workshop_api_base_url setting is deleted/missing
        Setting::where('key', 'workshop_api_base_url')->delete();

        $response = $this->get(route('donatur.reparation-history.index'));
        $response->assertStatus(200);
        $response->assertSee('Integrasi Belum Aktif');
    }

    /**
     * Test successful retrieval of reparation history.
     */
    public function test_successful_retrieval_of_reparation_history(): void
    {
        $user = User::factory()->create(['role' => 'user', 'phone' => '628123456789']);
        $this->actingAs($user);

        Setting::updateOrCreate(['key' => 'workshop_api_base_url'], ['value' => 'https://info.shoeworkshop.id/api/v1']);
        Setting::updateOrCreate(['key' => 'workshop_api_key'], ['value' => 'secret_key']);

        // Mock API Response
        Http::fake([
            'https://info.shoeworkshop.id/api/v1/customer-portal/orders*' => Http::response([
                'status' => 'success',
                'data' => [
                    'customer' => [
                        'name' => 'Test User',
                        'phone' => '628123456789'
                    ],
                    'work_orders' => [
                        [
                            'spk_number' => 'S-2606-02-0001-SW',
                            'shoe_brand' => 'Reebok Custom Brand',
                            'shoe_type' => 'F',
                            'shoe_color' => 'Hitam',
                            'shoe_size' => '40',
                            'status' => [
                                'code' => 'SELESAI',
                                'label' => 'Selesai'
                            ],
                            'entry_date' => '2026-06-02 14:08:00',
                            'payment' => [
                                'status' => 'Lunas',
                                'total_amount' => 250000,
                                'paid_amount' => 250000,
                                'remaining_balance' => 0
                            ],
                            'services' => [
                                [
                                    'service_name' => 'Ganti Outsole Reguler',
                                    'cost' => 250000
                                ]
                            ]
                        ]
                    ]
                ]
            ], 200)
        ]);

        $response = $this->get(route('donatur.reparation-history.index'));
        $response->assertStatus(200);
        $response->assertSee('S-2606-02-0001-SW');
        $response->assertSee('Reebok Custom Brand');
        $response->assertSee('Lunas');
    }

    /**
     * Test reparation history is cached for 5 minutes (300 seconds).
     */
    public function test_reparation_history_is_cached(): void
    {
        $user = User::factory()->create(['role' => 'user', 'phone' => '628123456789']);
        $this->actingAs($user);

        Setting::updateOrCreate(['key' => 'workshop_api_base_url'], ['value' => 'https://info.shoeworkshop.id/api/v1']);
        Setting::updateOrCreate(['key' => 'workshop_api_key'], ['value' => 'secret_key']);

        Http::fake([
            'https://info.shoeworkshop.id/api/v1/customer-portal/orders*' => Http::sequence()
                ->push([
                    'status' => 'success',
                    'data' => [
                        'work_orders' => [
                            [
                                'spk_number' => 'S-2606-02-0001-SW',
                                'shoe_brand' => 'Reebok First Call',
                                'shoe_type' => 'F',
                                'shoe_color' => 'Hitam',
                                'shoe_size' => '40',
                                'status' => [
                                    'code' => 'SELESAI',
                                    'label' => 'Selesai'
                                ],
                                'entry_date' => '2026-06-02 14:08:00',
                                'payment' => [
                                    'status' => 'Lunas',
                                    'total_amount' => 250000,
                                    'paid_amount' => 250000,
                                    'remaining_balance' => 0
                                ],
                                'services' => [
                                    [
                                        'service_name' => 'Ganti Outsole Reguler',
                                        'cost' => 250000
                                    ]
                                ]
                            ]
                        ]
                    ]
                ], 200)
                ->push([
                    'status' => 'success',
                    'data' => [
                        'work_orders' => [
                            [
                                'spk_number' => 'S-2606-02-0002-SW',
                                'shoe_brand' => 'Reebok Second Call',
                                'shoe_type' => 'F',
                                'shoe_color' => 'Hitam',
                                'shoe_size' => '40',
                                'status' => [
                                    'code' => 'SELESAI',
                                    'label' => 'Selesai'
                                ],
                                'entry_date' => '2026-06-02 14:08:00',
                                'payment' => [
                                    'status' => 'Lunas',
                                    'total_amount' => 250000,
                                    'paid_amount' => 250000,
                                    'remaining_balance' => 0
                                ],
                                'services' => [
                                    [
                                        'service_name' => 'Ganti Outsole Reguler',
                                        'cost' => 250000
                                    ]
                                ]
                            ]
                        ]
                    ]
                ], 200)
        ]);

        // First request: hits API
        $response1 = $this->get(route('donatur.reparation-history.index'));
        $response1->assertSee('Reebok First Call');

        // Second request: served from cache, should still see Reebok First Call, not Reebok Second Call
        $response2 = $this->get(route('donatur.reparation-history.index'));
        $response2->assertSee('Reebok First Call');
        $response2->assertDontSee('Reebok Second Call');

        // Verify HTTP sequence was called exactly once
        Http::assertSentCount(1);
    }

    /**
     * Test API connection failure shows a friendly error message.
     */
    public function test_api_connection_failure_shows_error_message(): void
    {
        $user = User::factory()->create(['role' => 'user', 'phone' => '628123456789']);
        $this->actingAs($user);

        Setting::updateOrCreate(['key' => 'workshop_api_base_url'], ['value' => 'https://info.shoeworkshop.id/api/v1']);
        Setting::updateOrCreate(['key' => 'workshop_api_key'], ['value' => 'secret_key']);

        // Simulate API error / exception
        Http::fake([
            'https://info.shoeworkshop.id/api/v1/customer-portal/orders*' => Http::response(null, 500)
        ]);

        $response = $this->get(route('donatur.reparation-history.index'));
        $response->assertStatus(200);
        $response->assertSee('Gagal mengambil data dari sistem workshop');
    }
}
