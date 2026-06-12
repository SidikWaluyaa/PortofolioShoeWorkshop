<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminDonationCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test regular user cannot access admin catalog donation endpoints.
     */
    public function test_regular_user_cannot_access_admin_catalog_endpoints(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        // Try accessing catalog items
        $this->get(route('admin.donation-items.index'))->assertStatus(403);
        $this->get(route('admin.donation-items.create'))->assertStatus(403);

        // Try accessing request list
        $this->get(route('admin.donation-requests.index'))->assertStatus(403);
    }

    /**
     * Test admin can access admin catalog endpoints.
     */
    public function test_admin_can_access_admin_catalog_endpoints(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $this->get(route('admin.donation-items.index'))->assertStatus(200);
        $this->get(route('admin.donation-items.create'))->assertStatus(200);
        $this->get(route('admin.donation-requests.index'))->assertStatus(200);
    }

    /**
     * Test admin can filter donation items by brand.
     */
    public function test_admin_can_filter_donation_items_by_brand(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        DonationItem::create([
            'nama' => 'Adidas Ultraboost',
            'brand' => 'Adidas',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/adidas.jpg',
        ]);

        DonationItem::create([
            'nama' => 'Nike Pegasus',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $response = $this->get(route('admin.donation-items.index', ['brand' => 'Adidas']));
        $response->assertStatus(200);
        $response->assertSee('Adidas Ultraboost');
        $response->assertDontSee('Nike Pegasus');
    }

    /**
     * Test admin can filter donation items by category.
     */
    public function test_admin_can_filter_donation_items_by_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        DonationItem::create([
            'nama' => 'Tas Eiger',
            'brand' => 'Eiger',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/tas.jpg',
        ]);

        DonationItem::create([
            'nama' => 'Nike Pegasus',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $response = $this->get(route('admin.donation-items.index', ['kategori' => 'tas']));
        $response->assertStatus(200);
        $response->assertSee('Tas Eiger');
        $response->assertDontSee('Nike Pegasus');
    }

    /**
     * Test admin can filter donation items by status.
     */
    public function test_admin_can_filter_donation_items_by_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        DonationItem::create([
            'nama' => 'Nike Pegasus Tersedia',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike1.jpg',
        ]);

        DonationItem::create([
            'nama' => 'Nike Pegasus Disalurkan',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'disalurkan',
            'foto_utama_path' => 'katalog/nike2.jpg',
        ]);

        $response = $this->get(route('admin.donation-items.index', ['status' => 'disalurkan']));
        $response->assertStatus(200);
        $response->assertSee('Nike Pegasus Disalurkan');
        $response->assertDontSee('Nike Pegasus Tersedia');
    }

    /**
     * Test admin can search donation items by keyword.
     */
    public function test_admin_can_search_donation_items_by_keyword(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        DonationItem::create([
            'nama' => 'Sandal Gunung Eiger',
            'brand' => 'Eiger',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/sandal.jpg',
        ]);

        DonationItem::create([
            'nama' => 'Nike Pegasus',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $response = $this->get(route('admin.donation-items.index', ['search' => 'Gunung']));
        $response->assertStatus(200);
        $response->assertSee('Sandal Gunung Eiger');
        $response->assertDontSee('Nike Pegasus');
    }

    /**
     * Test admin can create a new donation item in catalog.
     */
    public function test_admin_can_create_donation_item(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $fotoUtama = UploadedFile::fake()->image('nike_primary.jpg');
        $fotoDetail1 = UploadedFile::fake()->image('nike_side.jpg');
        $fotoDetail2 = UploadedFile::fake()->image('nike_back.jpg');

        $payload = [
            'nama' => 'Nike Pegasus 38',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'kondisi' => 'sudah_diperbaiki',
            'ukuran' => 'US 9.5',
            'status' => 'tersedia',
            'deskripsi' => 'Sepatu lari setelah reglue and deep cleaning.',
            'foto_utama' => $fotoUtama,
            'foto_detail' => [$fotoDetail1, $fotoDetail2],
        ];

        $response = $this->post(route('admin.donation-items.store'), $payload);

        $response->assertRedirect(route('admin.donation-items.index'));
        $response->assertSessionHas('success');

        // Assert record exists in DB
        $this->assertDatabaseHas('donation_items', [
            'nama' => 'Nike Pegasus 38',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'kondisi' => 'sudah_diperbaiki',
            'ukuran' => 'US 9.5',
            'status' => 'tersedia',
        ]);

        $item = DonationItem::where('nama', 'Nike Pegasus 38')->first();
        $this->assertNotNull($item);
        
        // Assert compressed/stored image files exist
        $this->assertTrue(Storage::disk('public')->exists($item->foto_utama_path));
        $this->assertCount(2, $item->foto_detail);
        foreach ($item->foto_detail as $detailPath) {
            $this->assertTrue(Storage::disk('public')->exists($detailPath));
        }
    }

    /**
     * Test admin can update an existing donation item.
     */
    public function test_admin_can_update_donation_item(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Setup existing item
        $item = DonationItem::create([
            'nama' => 'Old Hat',
            'brand' => 'New Era',
            'kategori' => 'topi',
            'kondisi' => 'sudah_diperbaiki',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/old_main.jpg',
            'foto_detail' => ['katalog/old_detail.jpg'],
        ]);

        // Mock old files in fake storage
        Storage::disk('public')->put('katalog/old_main.jpg', 'dummy');
        Storage::disk('public')->put('katalog/old_detail.jpg', 'dummy');

        $newUtama = UploadedFile::fake()->image('new_cap.jpg');
        $newDetail = UploadedFile::fake()->image('new_cap_angle.jpg');

        $payload = [
            'nama' => 'New Era NY Cap',
            'brand' => 'New Era',
            'kategori' => 'topi',
            'kondisi' => 'sudah_diperbaiki',
            'ukuran' => 'M/L',
            'status' => 'disalurkan',
            'deskripsi' => 'Topi NY setelah repaint.',
            'foto_utama' => $newUtama,
            'foto_detail' => [$newDetail],
        ];

        $response = $this->patch(route('admin.donation-items.update', $item), $payload);

        $response->assertRedirect(route('admin.donation-items.index'));
        $response->assertSessionHas('success');

        $item = $item->fresh();
        $this->assertEquals('New Era NY Cap', $item->nama);
        $this->assertEquals('disalurkan', $item->status);
        $this->assertEquals('M/L', $item->ukuran);

        // Check file replacements in disk
        // Main photo is replaced (old deleted, new created)
        $this->assertFalse(Storage::disk('public')->exists('katalog/old_main.jpg'));
        $this->assertTrue(Storage::disk('public')->exists($item->foto_utama_path));

        // Detail photos are APPENDED — old detail still exists, new one added
        $this->assertTrue(Storage::disk('public')->exists('katalog/old_detail.jpg'));
        $this->assertCount(2, $item->foto_detail); // old + new
        $this->assertEquals('katalog/old_detail.jpg', $item->foto_detail[0]);
        $this->assertTrue(Storage::disk('public')->exists($item->foto_detail[1]));
    }

    /**
     * Test admin can delete a donation item.
     */
    public function test_admin_can_delete_donation_item(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'To Be Deleted Bag',
            'brand' => 'Gucci',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/delete_main.jpg',
            'foto_detail' => ['katalog/delete_detail.jpg'],
        ]);

        Storage::disk('public')->put('katalog/delete_main.jpg', 'dummy');
        Storage::disk('public')->put('katalog/delete_detail.jpg', 'dummy');

        $response = $this->delete(route('admin.donation-items.destroy', $item));

        $response->assertRedirect(route('admin.donation-items.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('donation_items', ['id' => $item->id]);
        $this->assertFalse(Storage::disk('public')->exists('katalog/delete_main.jpg'));
        $this->assertFalse(Storage::disk('public')->exists('katalog/delete_detail.jpg'));
    }

    /**
     * Test admin can moderate a donation request to approved.
     */
    public function test_admin_can_approve_donation_request(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'Nike Air Zoom',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'status' => 'pending',
        ]);

        $response = $this->patch(route('admin.donation-requests.update', $request), [
            'status' => 'disetujui'
        ]);

        $response->assertRedirect(route('admin.donation-requests.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('disetujui', $request->fresh()->status);
        // DB transaction triggers item status update to 'disalurkan'
        $this->assertEquals('disalurkan', $item->fresh()->status);
    }

    /**
     * Test admin can moderate a donation request to rejected.
     */
    public function test_admin_can_reject_donation_request(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'Nike Air Zoom',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'status' => 'pending',
        ]);

        $response = $this->patch(route('admin.donation-requests.update', $request), [
            'status' => 'ditolak'
        ]);

        $response->assertRedirect(route('admin.donation-requests.index'));
        
        $this->assertEquals('ditolak', $request->fresh()->status);
        // Item status should remain 'tersedia'
        $this->assertEquals('tersedia', $item->fresh()->status);
    }

    /**
     * Test admin can moderate an approved request back to pending.
     */
    public function test_admin_can_reset_approved_donation_request_to_pending(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'Nike Air Zoom',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'disalurkan', // Set to disalurkan as it starts as approved
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'status' => 'disetujui',
        ]);

        $response = $this->patch(route('admin.donation-requests.update', $request), [
            'status' => 'pending'
        ]);

        $response->assertRedirect(route('admin.donation-requests.index'));

        $this->assertEquals('pending', $request->fresh()->status);
        // DB transaction restores item status back to 'tersedia'
        $this->assertEquals('tersedia', $item->fresh()->status);
    }

    /**
     * Test admin approving donation request cascades status to original donation.
     */
    public function test_admin_approving_donation_request_cascades_status_to_original_donation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $donatur = User::factory()->create(['role' => 'user']);
        $this->actingAs($admin);

        // Setup original donation
        $donation = \App\Models\Donation::create([
            'user_id' => $donatur->id,
            'nama_sepatu' => 'Nike Air Max',
            'ukuran' => 42,
            'kondisi' => 80,
            'foto_path' => ['donations/sepatu.jpg'],
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'diterima', // approved and in catalog
        ]);

        $item = DonationItem::create([
            'donation_id' => $donation->id,
            'nama' => 'Nike Air Max',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'status' => 'pending',
        ]);

        $response = $this->patch(route('admin.donation-requests.update', $request), [
            'status' => 'disetujui'
        ]);

        $response->assertRedirect(route('admin.donation-requests.index'));
        $this->assertEquals('disetujui', $request->fresh()->status);
        $this->assertEquals('disalurkan', $item->fresh()->status);
        
        // Assert the original donation's status cascaded to 'disalurkan'
        $this->assertEquals('disalurkan', $donation->fresh()->status);
    }

    /**
     * Test admin resetting approved donation request cascades status back to received.
     */
    public function test_admin_resetting_approved_donation_request_cascades_status_to_original_donation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $donatur = User::factory()->create(['role' => 'user']);
        $this->actingAs($admin);

        // Setup original donation which was already marked 'disalurkan'
        $donation = \App\Models\Donation::create([
            'user_id' => $donatur->id,
            'nama_sepatu' => 'Nike Air Max',
            'ukuran' => 42,
            'kondisi' => 80,
            'foto_path' => ['donations/sepatu.jpg'],
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'disalurkan',
        ]);

        $item = DonationItem::create([
            'donation_id' => $donation->id,
            'nama' => 'Nike Air Max',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'disalurkan',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'status' => 'disetujui',
        ]);

        $response = $this->patch(route('admin.donation-requests.update', $request), [
            'status' => 'pending'
        ]);

        $response->assertRedirect(route('admin.donation-requests.index'));
        $this->assertEquals('pending', $request->fresh()->status);
        $this->assertEquals('tersedia', $item->fresh()->status);
        
        // Assert the original donation's status reverted to 'diterima'
        $this->assertEquals('diterima', $donation->fresh()->status);
    }
}
