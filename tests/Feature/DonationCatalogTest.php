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

    public function test_catalog_filtering_by_status(): void
    {
        $item1 = DonationItem::create([
            'nama' => 'Sepatu Compass Baru',
            'brand' => 'Compass',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);

        $item2 = DonationItem::create([
            'nama' => 'Sepatu Compass Lama',
            'brand' => 'Compass',
            'kategori' => 'sepatu',
            'status' => 'disalurkan',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);

        // Filter by 'tersedia'
        $responseTersedia = $this->get(route('katalog.filter', ['status' => 'tersedia']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $responseTersedia->assertStatus(200);
        $responseTersedia->assertSee('Sepatu Compass Baru');
        $responseTersedia->assertDontSee('Sepatu Compass Lama');

        // Filter by 'disalurkan'
        $responseDisalurkan = $this->get(route('katalog.filter', ['status' => 'disalurkan']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $responseDisalurkan->assertStatus(200);
        $responseDisalurkan->assertSee('Sepatu Compass Lama');
        $responseDisalurkan->assertDontSee('Sepatu Compass Baru');
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

    public function test_catalog_item_with_jasa_berat_and_score_can_be_rendered(): void
    {
        // Create a mock service
        $service = \App\Models\Service::create([
            'name' => 'Premium Reglue',
            'description' => 'Sol premium reglue',
            'icon' => '🔧',
            'is_active' => true,
            'order' => 1
        ]);

        $item = DonationItem::create([
            'nama' => 'Tas Kulit Eksklusif',
            'brand' => 'Gucci',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'kondisi' => 'sudah_diperbaiki',
            'foto_utama_path' => 'images/katalog/leather_bag.png',
            'berat' => 1200, // 1.2 kg
            'score_kelayakan' => 95,
        ]);

        $item->reparationServices()->create([
            'service_id' => $service->id,
            'jasa_harga' => 125000,
            'jasa_estimasi_waktu' => 4,
        ]);

        $item->reparationServices()->create([
            'service_id' => null,
            'jasa_nama_manual' => 'Special Stitching',
            'jasa_harga' => 30000,
            'jasa_estimasi_waktu' => 2,
        ]);

        // Get index page
        $response = $this->get(route('katalog.index'));
        $response->assertStatus(200);
        $response->assertSee('Tas Kulit Eksklusif');
        $response->assertSee('Premium Reglue');
        $response->assertSee('Special Stitching');
        $response->assertSee('1,2 kg');
        $response->assertSee('95% Layak');

        // Get show detail page
        $responseDetail = $this->get(route('katalog.show', $item->id));
        $responseDetail->assertStatus(200);
        $responseDetail->assertSee('Tas Kulit Eksklusif');
        $responseDetail->assertSee('Premium Reglue');
        $responseDetail->assertSee('Special Stitching');
        $responseDetail->assertSee('Rp 155.000'); // Sum of 125000 + 30000
        $responseDetail->assertSee('4 Hari');      // Max of 4 and 2
        $responseDetail->assertSee('95%');
    }

    public function test_catalog_multi_category_filtering(): void
    {
        DonationItem::create([
            'nama' => 'Sepatu Compass',
            'brand' => 'Compass',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);
        DonationItem::create([
            'nama' => 'Tas Kulit',
            'brand' => 'Gucci',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/leather_bag.png',
        ]);
        DonationItem::create([
            'nama' => 'Topi Vintage',
            'brand' => 'Adidas',
            'kategori' => 'topi',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);

        // Filter by 'sepatu,tas'
        $response = $this->get(route('katalog.filter', ['category' => 'sepatu,tas']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertSee('Sepatu Compass');
        $response->assertSee('Tas Kulit');
        $response->assertDontSee('Topi Vintage');
    }

    public function test_catalog_price_range_filtering(): void
    {
        $itemCheap = DonationItem::create([
            'nama' => 'Sepatu Murah',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);
        $itemCheap->reparationServices()->create([
            'jasa_harga' => 20000,
        ]);

        $itemExpensive = DonationItem::create([
            'nama' => 'Sepatu Mahal',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);
        $itemExpensive->reparationServices()->create([
            'jasa_harga' => 150000,
        ]);

        // Filter min_price = 50000
        $responseMin = $this->get(route('katalog.filter', ['min_price' => 50000]), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $responseMin->assertSee('Sepatu Mahal');
        $responseMin->assertDontSee('Sepatu Murah');

        // Filter max_price = 50000
        $responseMax = $this->get(route('katalog.filter', ['max_price' => 50000]), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $responseMax->assertSee('Sepatu Murah');
        $responseMax->assertDontSee('Sepatu Mahal');
    }

    public function test_catalog_sorting_options(): void
    {
        $item1 = DonationItem::create([
            'nama' => 'Sepatu Pertama',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'score_kelayakan' => 60,
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);
        $item1->reparationServices()->create([
            'jasa_harga' => 100000,
        ]);

        $item2 = DonationItem::create([
            'nama' => 'Sepatu Kedua',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'score_kelayakan' => 90,
            'foto_utama_path' => 'images/katalog/vintage_cap.png',
        ]);
        $item2->reparationServices()->create([
            'jasa_harga' => 50000,
        ]);

        // Sort by 'harga_termurah'
        $responseCheap = $this->get(route('katalog.filter', ['sort' => 'harga_termurah']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        // HTML order check: 'Sepatu Kedua' should appear before 'Sepatu Pertama'
        $htmlCheap = $responseCheap->getContent();
        $posSecondCheap = strpos($htmlCheap, 'Sepatu Kedua');
        $posFirstCheap = strpos($htmlCheap, 'Sepatu Pertama');
        $this->assertTrue($posSecondCheap < $posFirstCheap);

        // Sort by 'harga_termahal'
        $responseExpensive = $this->get(route('katalog.filter', ['sort' => 'harga_termahal']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $htmlExpensive = $responseExpensive->getContent();
        $posSecondExpensive = strpos($htmlExpensive, 'Sepatu Kedua');
        $posFirstExpensive = strpos($htmlExpensive, 'Sepatu Pertama');
        $this->assertTrue($posFirstExpensive < $posSecondExpensive);

        // Sort by 'rate_kelayakan'
        $responseKelayakan = $this->get(route('katalog.filter', ['sort' => 'rate_kelayakan']), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $htmlKelayakan = $responseKelayakan->getContent();
        $posSecondKelayakan = strpos($htmlKelayakan, 'Sepatu Kedua'); // 90%
        $posFirstKelayakan = strpos($htmlKelayakan, 'Sepatu Pertama'); // 60%
        $this->assertTrue($posSecondKelayakan < $posFirstKelayakan);
    }
}
