<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Setting;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic settings
        Setting::create(['key' => 'whatsapp_number', 'value' => '628123456789']);

        // Create users
        $this->adminUser = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->regularUser = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_admin_can_access_campaigns_index(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.campaigns.index'));

        $response->assertStatus(200);
        $response->assertSee('Manajemen Iklan');
    }

    public function test_regular_user_cannot_access_campaigns_index(): void
    {
        $response = $this->actingAs($this->regularUser)->get(route('admin.campaigns.index'));

        $response->assertStatus(403);
    }

    public function test_admin_can_create_image_upload_campaign(): void
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('banner_promo.jpg', 1200, 400);

        $payload = [
            'title' => 'Kampanye Diskon Cuci Sepatu',
            'position' => 'catalog_top',
            'type' => 'image_upload',
            'image' => $image,
            'cta_text' => 'Pesan Sekarang',
            'target_url' => 'https://wa.me/628123456789',
            'is_active' => '1',
            'start_date' => now()->subDay()->format('Y-m-d\TH:i'),
            'end_date' => now()->addDays(5)->format('Y-m-d\TH:i'),
        ];

        $response = $this->actingAs($this->adminUser)->post(route('admin.campaigns.store'), $payload);

        $response->assertRedirect(route('admin.campaigns.index'));

        // Verify in database
        $this->assertDatabaseHas('campaigns', [
            'title' => 'Kampanye Diskon Cuci Sepatu',
            'type' => 'image_upload',
            'cta_text' => 'Pesan Sekarang',
            'target_url' => 'https://wa.me/628123456789',
            'is_active' => true,
        ]);

        // Verify storage file exists
        $campaign = Campaign::first();
        $this->assertNotNull($campaign->image_path);
        $this->assertTrue(Storage::disk('public')->exists($campaign->image_path));
    }

    public function test_campaign_active_scope_validation(): void
    {
        // Active campaign
        $active = Campaign::create([
            'title' => 'Active Campaign',
            'type' => 'text_only',
            'promo_text' => 'Hello',
            'is_active' => true,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        // Inactive by status
        Campaign::create([
            'title' => 'Inactive Campaign',
            'type' => 'text_only',
            'is_active' => false,
        ]);

        // Outdated schedule
        Campaign::create([
            'title' => 'Outdated Campaign',
            'type' => 'text_only',
            'is_active' => true,
            'start_date' => now()->subDays(5),
            'end_date' => now()->subDay(),
        ]);

        $activeCampaigns = Campaign::active()->get();

        $this->assertCount(1, $activeCampaigns);
        $this->assertEquals('Active Campaign', $activeCampaigns->first()->title);
    }

    public function test_visiting_catalog_increments_campaign_views_count(): void
    {
        $campaign = Campaign::create([
            'title' => 'Catalog Top Banner Promo',
            'position' => 'catalog_top',
            'type' => 'text_only',
            'promo_text' => 'Dapatkan diskon 20%',
            'is_active' => true,
            'views_count' => 0,
        ]);

        $response = $this->get(route('katalog.index'));

        $response->assertStatus(200);
        $response->assertSee('Catalog Top Banner Promo');
        $response->assertSee('Dapatkan diskon 20%');

        // Check view counter incremented
        $this->assertEquals(1, $campaign->fresh()->views_count);
    }

    public function test_clicking_campaign_increments_clicks_count_and_redirects(): void
    {
        $campaign = Campaign::create([
            'title' => 'Catalog Top Banner Promo',
            'position' => 'catalog_top',
            'type' => 'text_only',
            'target_url' => 'https://shoeworkshop.test/promo-reparasi',
            'is_active' => true,
            'clicks_count' => 0,
        ]);

        $response = $this->get(route('campaigns.click', $campaign->id));

        $response->assertRedirect('https://shoeworkshop.test/promo-reparasi');

        // Check click counter incremented
        $this->assertEquals(1, $campaign->fresh()->clicks_count);
    }
}
