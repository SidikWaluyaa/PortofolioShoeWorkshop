<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Setting;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic settings needed for the catalog
        Setting::create(['key' => 'whatsapp_number', 'value' => '628123456789']);
    }

    public function test_catalog_page_can_be_rendered(): void
    {
        $response = $this->get(route('katalog.index'));

        $response->assertStatus(200);
        $response->assertSee('Katalog Donasi Barang');
    }

    public function test_catalog_detail_page_can_be_rendered(): void
    {
        $item = DonationItem::create([
            'nama' => 'Sepatu Compass Retro',
            'brand' => 'Compass',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'kondisi' => 'seperti_baru',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);

        $response = $this->get(route('katalog.show', $item->id));

        $response->assertStatus(200);
        $response->assertSee('Sepatu Compass Retro');
        $response->assertSee('Detail Donasi');
    }

    public function test_catalog_request_form_page_can_be_rendered(): void
    {
        $item = DonationItem::create([
            'nama' => 'Sepatu Test Ajukan',
            'brand' => 'TestBrand',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'kondisi' => 'baru',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);

        $response = $this->get(route('katalog.request.form', $item->id));

        $response->assertStatus(200);
        $response->assertSee('Ajukan Permohonan');
        $response->assertSee('Sepatu Test Ajukan');
    }

    public function test_catalog_filtering_by_category(): void
    {
        // Create sample items
        $item1 = DonationItem::create([
            'nama' => 'Sepatu Nike Air',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
        ]);

        $item2 = DonationItem::create([
            'nama' => 'Tas Jansport Brown',
            'brand' => 'Jansport',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/leather_bag.png',
        ]);

        // Filter by 'tas'
        $response = $this->get(route('katalog.filter', ['category' => 'tas']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertSee('Tas Jansport Brown');
        $response->assertDontSee('Sepatu Nike Air');
    }

    public function test_catalog_searching_by_name(): void
    {
        $item1 = DonationItem::create([
            'nama' => 'Adidas Ultraboost',
            'brand' => 'Adidas',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
        ]);

        $item2 = DonationItem::create([
            'nama' => 'Nike Air Max',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
        ]);

        // Search for 'Adidas'
        $response = $this->get(route('katalog.filter', ['search' => 'Adidas']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertSee('Adidas Ultraboost');
        $response->assertDontSee('Nike Air Max');
    }

    public function test_catalog_request_item_successfully(): void
    {
        $item = DonationItem::create([
            'nama' => 'Nike Air Max 90 White',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
        ]);

        $payload = [
            'nama_pemohon' => 'Budi Santoso',
            'kontak_pemohon' => '081234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung, Jawa Barat',
        ];

        $response = $this->post(route('katalog.request', $item->id), $payload);

        // Controller now redirects to the success page instead of returning JSON
        $response->assertRedirect();

        // Verify database entry
        $this->assertDatabaseHas('donation_requests', [
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Budi Santoso',
            'kontak_pemohon' => '6281234567890', // Normalised
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung, Jawa Barat',
            'status' => 'pending',
        ]);
    }

    public function test_catalog_request_validation_errors(): void
    {
        $item = DonationItem::create([
            'nama' => 'Nike Air Max 90 White',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
        ]);

        $payload = [
            'nama_pemohon' => '',
            'kontak_pemohon' => 'invalid-phone',
            'alamat_pengiriman' => 'short',
        ];

        // Use regular post so we get redirect-back with validation errors
        $response = $this->post(route('katalog.request', $item->id), $payload);

        $response->assertSessionHasErrors(['nama_pemohon', 'kontak_pemohon', 'alamat_pengiriman']);
    }

    public function test_catalog_request_unavailable_item_fails(): void
    {
        $item = DonationItem::create([
            'nama' => 'Adidas Ultraboost 21',
            'brand' => 'Adidas',
            'kategori' => 'sepatu',
            'status' => 'disalurkan',
            'foto_utama_path' => 'images/katalog/nike_air_max.png',
        ]);

        $payload = [
            'nama_pemohon' => 'Budi Santoso',
            'kontak_pemohon' => '081234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung, Jawa Barat',
        ];

        $response = $this->post(route('katalog.request', $item->id), $payload);

        // Controller now returns 422 for unavailable items
        $response->assertStatus(422);
    }
}
