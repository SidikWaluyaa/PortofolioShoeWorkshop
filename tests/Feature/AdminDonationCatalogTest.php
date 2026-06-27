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
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
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
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
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
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
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
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
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
     * Test admin approving donation request auto rejects other pending requests for the same item.
     */
    public function test_admin_approving_donation_request_auto_rejects_other_pending_requests_and_sends_emails(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'Nike Air Zoom',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        // Approved request
        $request1 = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
            'status' => 'pending',
        ]);

        // Request 2 (should be auto-rejected)
        $request2 = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'John Smith',
            'email' => 'john@gmail.com',
            'kontak_pemohon' => '6281299991111',
            'alamat_pengiriman' => 'Jl. Tebet No. 12, Jakarta Selatan',
            'alasan' => 'Butuh sepatu sekolah.',
            'status' => 'pending',
        ]);

        $response = $this->patch(route('admin.donation-requests.update', $request1), [
            'status' => 'disetujui'
        ]);

        $response->assertRedirect(route('admin.donation-requests.index'));
        $this->assertEquals('disetujui', $request1->fresh()->status);
        $this->assertEquals('ditolak', $request2->fresh()->status);

        // Assert both approval and auto-rejection emails were sent
        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationRequestApprovedMail::class, function ($mail) use ($request1) {
            return $mail->donationRequest->id === $request1->id;
        });

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationRequestRejectedMail::class, function ($mail) use ($request2) {
            return $mail->donationRequest->id === $request2->id;
        });
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
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
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

    /**
     * Test regular user cannot download catalog PDF or export Excel.
     */
    public function test_regular_user_cannot_export_catalog(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $this->get(route('admin.donation-items.export-pdf'))->assertStatus(403);
        $this->get(route('admin.donation-items.export-excel'))->assertStatus(403);
    }

    /**
     * Test admin can download catalog PDF.
     */
    public function test_admin_can_download_pdf_export(): void
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

        $response = $this->get(route('admin.donation-items.export-pdf'));
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    /**
     * Test admin can export catalog Excel/CSV.
     */
    public function test_admin_can_export_excel_csv(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'Nike Pegasus',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $response = $this->get(route('admin.donation-items.export-excel'));
        $response->assertStatus(200);
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'text/csv') || 
            str_contains($response->headers->get('content-type'), 'application/octet-stream')
        );

        ob_start();
        $response->sendContent();
        $content = ob_get_clean();

        $this->assertStringContainsString('Nike Pegasus', $content);
        $this->assertStringContainsString('Nike', $content);
        $this->assertStringContainsString($item->fresh()->kode_barang, $content);
    }

    /**
     * Test exports respect filters.
     */
    public function test_exports_respect_filters(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        DonationItem::create([
            'nama' => 'Nike Pegasus',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        DonationItem::create([
            'nama' => 'Adidas Ultraboost',
            'brand' => 'Adidas',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/adidas.jpg',
        ]);

        // Filter by Nike
        $response = $this->get(route('admin.donation-items.export-excel', ['brand' => 'Nike']));
        $response->assertStatus(200);

        ob_start();
        $response->sendContent();
        $content = ob_get_clean();

        $this->assertStringContainsString('Nike Pegasus', $content);
        $this->assertStringNotContainsString('Adidas Ultraboost', $content);
    }

    /**
     * Test unique kode_barang is auto-generated on item creation.
     */
    public function test_donation_item_auto_generates_kode_barang(): void
    {
        $itemSepatu = DonationItem::create([
            'nama' => 'Adidas Super',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/adidas.jpg',
        ]);

        $itemTas = DonationItem::create([
            'nama' => 'Eiger Bag',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/tas.jpg',
        ]);

        $itemTopi = DonationItem::create([
            'nama' => 'Nike Cap',
            'kategori' => 'topi',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/topi.jpg',
        ]);

        $this->assertEquals(str_pad($itemSepatu->id, 3, '0', STR_PAD_LEFT) . '-DS', $itemSepatu->fresh()->kode_barang);
        $this->assertEquals(str_pad($itemTas->id, 3, '0', STR_PAD_LEFT) . '-DT', $itemTas->fresh()->kode_barang);
        $this->assertEquals(str_pad($itemTopi->id, 3, '0', STR_PAD_LEFT) . '-DP', $itemTopi->fresh()->kode_barang);
    }

    /**
     * Test admin can sort donation items ascending and descending.
     */
    public function test_admin_can_sort_donation_items(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item1 = DonationItem::create([
            'nama' => 'Item Pertama',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/first.jpg',
        ]);

        $item2 = DonationItem::create([
            'nama' => 'Item Kedua',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/second.jpg',
        ]);

        // Default / Descending: Item Kedua (newer) first
        $responseDesc = $this->get(route('admin.donation-items.index'));
        $responseDesc->assertStatus(200);
        $htmlDesc = $responseDesc->getContent();
        $this->assertTrue(strpos($htmlDesc, 'Item Kedua') < strpos($htmlDesc, 'Item Pertama'));

        // Ascending: Item Pertama (older) first
        $responseAsc = $this->get(route('admin.donation-items.index', ['sort' => 'asc']));
        $responseAsc->assertStatus(200);
        $htmlAsc = $responseAsc->getContent();
        $this->assertTrue(strpos($htmlAsc, 'Item Pertama') < strpos($htmlAsc, 'Item Kedua'));
    }

    /**
     * Test email is sent via manual approval email button.
     */
    public function test_email_is_queued_on_request_approval(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

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
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
            'status' => 'disetujui',
        ]);

        $response = $this->post(route('admin.donation-requests.send-approval-email', $request));
        $response->assertRedirect(route('admin.donation-requests.index'));
        $response->assertSessionHas('success');

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationRequestApprovedMail::class, function ($mail) use ($request) {
            return $mail->donationRequest->id === $request->id;
        });
    }

    /**
     * Test email is sent via manual rejection email button.
     */
    public function test_email_is_queued_on_request_rejection(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $item = DonationItem::create([
            'nama' => 'Nike Air Zoom Rejection',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/nike.jpg',
        ]);

        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
            'status' => 'ditolak',
        ]);

        $response = $this->post(route('admin.donation-requests.send-rejection-email', $request));
        $response->assertRedirect(route('admin.donation-requests.index'));
        $response->assertSessionHas('success');

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\DonationRequestRejectedMail::class, function ($mail) use ($request) {
            return $mail->donationRequest->id === $request->id;
        });
    }

    /**
     * Test admin can filter and sort donation requests list.
     */
    public function test_admin_can_filter_and_sort_donation_requests(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user1 = User::factory()->create(['name' => 'Registered User']);
        $this->actingAs($admin);

        // 1. Create a donation item and request for sepatu by Registered User
        $itemSepatu = DonationItem::create([
            'nama' => 'Sneakers Sepatu Super',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/first.jpg',
        ]);
        $requestSepatu = DonationRequest::create([
            'donation_item_id' => $itemSepatu->id,
            'user_id' => $user1->id,
            'nama_pemohon' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'kontak_pemohon' => '6281234567890',
            'alamat_pengiriman' => 'Bandung',
            'alasan' => 'Butuh sepatu donasi.',
            'status' => 'pending',
        ]);
        \Illuminate\Support\Facades\DB::table('donation_requests')
            ->where('id', $requestSepatu->id)
            ->update(['created_at' => now()->subDays(5)]);

        // 2. Create a donation item and request for tas by Guest (user_id is null)
        $itemTas = DonationItem::create([
            'nama' => 'Tas Backpack Brown',
            'brand' => 'BackpackCo',
            'kategori' => 'tas',
            'status' => 'tersedia',
            'foto_utama_path' => 'katalog/second.jpg',
        ]);
        $requestTas = DonationRequest::create([
            'donation_item_id' => $itemTas->id,
            'user_id' => null,
            'nama_pemohon' => 'Ani Wijaya',
            'email' => 'ani@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jakarta',
            'alasan' => 'Butuh tas sekolah.',
            'status' => 'disetujui',
            'created_at' => now(),
        ]);

        // Assert 1: Search matches applicant name
        $response = $this->get(route('admin.donation-requests.index', ['search' => 'Ani']));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        $this->assertTrue($items->contains('id', $itemTas->id));
        $this->assertFalse($items->contains('id', $itemSepatu->id));

        // Assert 2: Search matches item code
        $response = $this->get(route('admin.donation-requests.index', ['search' => $itemSepatu->kode_barang]));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        $this->assertTrue($items->contains('id', $itemSepatu->id));
        $this->assertFalse($items->contains('id', $itemTas->id));

        // Assert 3: Filter by status
        $response = $this->get(route('admin.donation-requests.index', ['status' => 'disetujui']));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        $this->assertTrue($items->contains('id', $itemTas->id));
        $this->assertFalse($items->contains('id', $itemSepatu->id));

        // Assert 4: Filter by category (kategori)
        $response = $this->get(route('admin.donation-requests.index', ['kategori' => 'sepatu']));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        $this->assertTrue($items->contains('id', $itemSepatu->id));
        $this->assertFalse($items->contains('id', $itemTas->id));

        // Assert 5: Filter by applicant type (tipe_pengaju)
        $response = $this->get(route('admin.donation-requests.index', ['tipe_pengaju' => 'registered']));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        $this->assertTrue($items->contains('id', $itemSepatu->id));
        $this->assertFalse($items->contains('id', $itemTas->id));

        // Assert 6: Filter by date range (Flatpickr range)
        $startDate = now()->subDays(6)->format('Y-m-d');
        $endDate = now()->subDays(4)->format('Y-m-d');
        $response = $this->get(route('admin.donation-requests.index', ['date_range' => "{$startDate} to {$endDate}"]));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        $this->assertTrue($items->contains('id', $itemSepatu->id));
        $this->assertFalse($items->contains('id', $itemTas->id));

        // Assert 7: Sort by name descending
        $response = $this->get(route('admin.donation-requests.index', ['sort' => 'name_desc']));
        $response->assertStatus(200);
        $items = $response->original->getData()['items'];
        // sneakers (S) should appear after tas (T) in alphabetical name order desc -> Tas (T) first
        $this->assertEquals($itemTas->id, $items->first()->id);
    }

    /**
     * Test admin can delete donation request and revert associated item status if approved.
     */
    public function test_admin_can_delete_donation_request(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // 1. Create a donation item and request
        $item = DonationItem::create([
            'nama' => 'Test Shoe for Deletion',
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'disalurkan', // set as disalurkan to simulate approved state
            'foto_utama_path' => 'katalog/test.jpg',
        ]);
        
        $request = DonationRequest::create([
            'donation_item_id' => $item->id,
            'nama_pemohon' => 'Jane Doe',
            'email' => 'jane@gmail.com',
            'kontak_pemohon' => '6281299998888',
            'alamat_pengiriman' => 'Jl. Kebagusan No. 5, Jakarta Selatan',
            'alasan' => 'Butuh sepatu donasi.',
            'status' => 'disetujui',
        ]);

        // Delete request
        $response = $this->delete(route('admin.donation-requests.destroy', $request));
        $response->assertRedirect(route('admin.donation-requests.index'));
        $response->assertSessionHas('success', 'Permohonan berhasil dihapus.');

        // Assert record is deleted from DB
        $this->assertDatabaseMissing('donation_requests', [
            'id' => $request->id
        ]);

        // Assert item status is reverted back to 'tersedia'
        $this->assertDatabaseHas('donation_items', [
            'id' => $item->id,
            'status' => 'tersedia'
        ]);
    }
}
