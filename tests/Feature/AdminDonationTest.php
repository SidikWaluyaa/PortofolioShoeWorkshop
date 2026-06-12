<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminDonationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test regular user is blocked from admin donation endpoints.
     */
    public function test_regular_user_is_blocked_from_admin_donations(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->get(route('admin.donations.index'));
        $response->assertStatus(403); // Forbidden
    }

    /**
     * Test admin can access admin donation endpoints.
     */
    public function test_admin_can_access_admin_donations(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('admin.donations.index'));
        $response->assertStatus(200);
    }

    /**
     * Test admin approval requires a photo proof.
     */
    public function test_admin_approval_requires_photo_proof(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Air Max',
            'ukuran' => 42,
            'kondisi' => 80,
            'harga' => 500000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        // Approve request without foto_bukti
        $response = $this->post(route('admin.donations.approve', $donation), [
            'catatan_admin' => 'Barang diterima dengan baik',
        ]);

        $response->assertSessionHasErrors(['foto_bukti']);
        $this->assertEquals('pending', $donation->fresh()->status);
    }

    public function test_admin_can_approve_donation_with_photo_proof(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Air Max',
            'ukuran' => 42,
            'kondisi' => 80,
            'harga' => 500000,
            'foto_path' => ['donations/sepatu.jpg'],
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        $file = UploadedFile::fake()->image('bukti.jpg');

        $response = $this->post(route('admin.donations.approve', $donation), [
            'foto_bukti' => $file,
            'catatan_admin' => 'Barang diterima dan sesuai',
            'nama' => 'Nike Air Max 2026',
            'brand' => 'Nike',
            'ukuran' => '42.5',
            'kategori' => 'sepatu',
            'kondisi' => 'seperti_baru',
            'deskripsi' => 'Inspeksi: sepatu dalam kondisi prima.',
        ]);

        $response->assertRedirect(route('admin.donations.show', $donation));
        $response->assertSessionHas('success');

        $donation = $donation->fresh();
        $this->assertEquals('diterima', $donation->status);
        $this->assertNotNull($donation->foto_bukti_path);
        $this->assertEquals($admin->id, $donation->verified_by);
        $this->assertEquals('Barang diterima dan sesuai', $donation->catatan_admin);
        $this->assertTrue(Storage::disk('public')->exists($donation->foto_bukti_path));

        // Assert DonationItem was generated correctly
        $this->assertDatabaseHas('donation_items', [
            'donation_id' => $donation->id,
            'nama' => 'Nike Air Max 2026',
            'brand' => 'Nike',
            'ukuran' => '42.5',
            'kategori' => 'sepatu',
            'kondisi' => 'seperti_baru',
            'deskripsi' => 'Inspeksi: sepatu dalam kondisi prima.',
            'status' => 'tersedia',
            'foto_utama_path' => 'donations/sepatu.jpg',
        ]);

        $item = \App\Models\DonationItem::where('donation_id', $donation->id)->first();
        $this->assertNotNull($item);
        $this->assertEquals(['donations/sepatu.jpg'], $item->foto_detail);
    }

    /**
     * Test admin can reject a donation, which requires a rejection reason.
     */
    public function test_admin_rejection_requires_reason(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Air Max',
            'ukuran' => 42,
            'kondisi' => 80,
            'harga' => 500000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        // Reject request without reason
        $response = $this->post(route('admin.donations.reject', $donation), []);

        $response->assertSessionHasErrors(['catatan_admin']);
        $this->assertEquals('pending', $donation->fresh()->status);

        // Reject with reason
        $response2 = $this->post(route('admin.donations.reject', $donation), [
            'catatan_admin' => 'Sepatu terlalu rusak',
        ]);

        $response2->assertRedirect(route('admin.donations.show', $donation));
        $this->assertEquals('ditolak', $donation->fresh()->status);
        $this->assertEquals('Sepatu terlalu rusak', $donation->fresh()->catatan_admin);
        $this->assertEquals($admin->id, $donation->fresh()->verified_by);
    }

    /**
     * Test admin can distribute an approved donation.
     */
    public function test_admin_can_distribute_donation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Air Max',
            'ukuran' => 42,
            'kondisi' => 80,
            'harga' => 500000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'diterima',
            'foto_bukti_path' => 'donations/bukti.jpg',
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.donations.distribute', $donation), [
            'catatan_admin' => 'Disalurkan ke panti asuhan',
        ]);

        $response->assertRedirect(route('admin.donations.show', $donation));
        $this->assertEquals('disalurkan', $donation->fresh()->status);
        $this->assertEquals('Disalurkan ke panti asuhan', $donation->fresh()->catatan_admin);
    }

    /**
     * Test donatur can create donation without expedition details initially.
     */
    public function test_donatur_can_create_donation_without_expedition_details(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('sepatu_donasi.jpg');

        $response = $this->post(route('donatur.donations.store'), [
            'nama_sepatu' => 'Adidas Ultraboost',
            'ukuran' => '43',
            'kondisi' => 85,
            'harga' => 600000,
            'deskripsi' => 'Masih sangat layak pakai',
            'foto' => [$file],
            'metode_pengiriman' => 'ekspedisi',
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $this->assertDatabaseHas('donations', [
            'user_id' => $user->id,
            'nama_sepatu' => 'Adidas Ultraboost',
            'metode_pengiriman' => 'ekspedisi',
            'nama_ekspedisi' => null,
            'no_resi' => null,
            'status' => 'pending',
        ]);

        $donation = Donation::where('user_id', $user->id)->first();
        $this->assertNotNull($donation->spk);
        $this->assertStringStartsWith('SPK-DN-', $donation->spk);
    }

    /**
     * Test donation auto generates unique spk number on creation.
     */
    public function test_donation_auto_generates_unique_spk_on_creation(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        
        $donation1 = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Pegasus',
            'ukuran' => '42',
            'kondisi' => 80,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $donation2 = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Adidas Boost',
            'ukuran' => '43',
            'kondisi' => 85,
            'foto_path' => 'donations/sepatu2.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->assertNotNull($donation1->spk);
        $this->assertNotNull($donation2->spk);
        $this->assertNotEquals($donation1->spk, $donation2->spk);
        $this->assertStringStartsWith('SPK-DN-', $donation1->spk);
    }

    /**
     * Test donatur can upload multiple photos for a donation.
     */
    public function test_donatur_can_upload_multiple_photos_for_donation(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $file1 = UploadedFile::fake()->image('sepatu1.jpg');
        $file2 = UploadedFile::fake()->image('sepatu2.jpg');
        $file3 = UploadedFile::fake()->image('sepatu3.jpg');

        $response = $this->post(route('donatur.donations.store'), [
            'nama_sepatu' => 'Nike Pegasus Multi',
            'ukuran' => '42',
            'kondisi' => 80,
            'harga' => 500000,
            'deskripsi' => 'Sepasang sepatu dengan beberapa foto',
            'foto' => [$file1, $file2, $file3],
            'metode_pengiriman' => 'antar_langsung',
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        
        $donation = Donation::where('nama_sepatu', 'Nike Pegasus Multi')->first();
        $this->assertNotNull($donation);
        $this->assertCount(3, $donation->foto_path);
        
        // Assert each file is compressed and stored correctly
        foreach ($donation->foto_path as $path) {
            $this->assertTrue(Storage::disk('public')->exists($path));
        }
    }

    /**
     * Test donatur can update shipping receipt for their own pending donation.
     */
    public function test_donatur_can_update_shipping_receipt(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Adidas Ultraboost',
            'ukuran' => '43',
            'kondisi' => 85,
            'harga' => 600000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $response = $this->patch(route('donatur.donations.update-resi', $donation), [
            'nama_ekspedisi' => 'JNE',
            'no_resi' => 'JNE123456789',
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $donation = $donation->fresh();
        $this->assertEquals('JNE', $donation->nama_ekspedisi);
        $this->assertEquals('JNE123456789', $donation->no_resi);
    }

    /**
     * Test donatur cannot update shipping receipt for other user's donation.
     */
    public function test_donatur_cannot_update_other_users_receipt(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);
        
        $donation = Donation::create([
            'user_id' => $otherUser->id,
            'nama_sepatu' => 'Adidas Ultraboost',
            'ukuran' => '43',
            'kondisi' => 85,
            'harga' => 600000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $response = $this->patch(route('donatur.donations.update-resi', $donation), [
            'nama_ekspedisi' => 'JNE',
            'no_resi' => 'JNE123456789',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test donatur cannot update receipt if status is not pending.
     */
    public function test_donatur_cannot_update_receipt_if_not_pending(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Adidas Ultraboost',
            'ukuran' => '43',
            'kondisi' => 85,
            'harga' => 600000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'diterima', // already approved
        ]);

        $this->actingAs($user);

        $response = $this->patch(route('donatur.donations.update-resi', $donation), [
            'nama_ekspedisi' => 'JNE',
            'no_resi' => 'JNE123456789',
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $response->assertSessionHas('error');
    }

    /**
     * Test donatur can access edit page for their own pending donation.
     */
    public function test_donatur_can_access_edit_page_for_pending_donation(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Air Max Original',
            'ukuran' => '41',
            'kondisi' => 75,
            'harga' => 450000,
            'foto_path' => ['donations/sepatu1.jpg'],
            'metode_pengiriman' => 'antar_langsung',
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('donatur.donations.edit', $donation));

        $response->assertStatus(200);
        $response->assertViewHas('donation');
        $response->assertSee('Nike Air Max Original');
    }

    /**
     * Test donatur cannot access edit page for other user's donation.
     */
    public function test_donatur_cannot_access_edit_page_for_other_users_donation(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $otherUser = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $otherUser->id,
            'nama_sepatu' => 'Nike Pegasus',
            'ukuran' => '42',
            'kondisi' => 80,
            'foto_path' => ['donations/sepatu.jpg'],
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('donatur.donations.edit', $donation));

        $response->assertStatus(403);
    }

    /**
     * Test donatur cannot access edit page for non-pending donation.
     */
    public function test_donatur_cannot_access_edit_page_for_non_pending_donation(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Pegasus Approved',
            'ukuran' => '42',
            'kondisi' => 80,
            'foto_path' => ['donations/sepatu.jpg'],
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'diterima',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('donatur.donations.edit', $donation));

        $response->assertRedirect(route('donatur.donations.index'));
        $response->assertSessionHas('error');
    }

    /**
     * Test donatur can update pending donation without uploading new photos.
     */
    public function test_donatur_can_update_pending_donation_without_new_photos(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Original',
            'ukuran' => '42',
            'kondisi' => 70,
            'harga' => 300000,
            'foto_path' => ['donations/old1.jpg', 'donations/old2.jpg'],
            'metode_pengiriman' => 'antar_langsung',
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $response = $this->put(route('donatur.donations.update', $donation), [
            'nama_sepatu' => 'Nike Original Updated',
            'ukuran' => '43',
            'kondisi' => 90,
            'harga' => 350000,
            'deskripsi' => 'Deskripsi baru diupdate',
            'metode_pengiriman' => 'ekspedisi',
            'nama_ekspedisi' => 'JNE',
            'no_resi' => 'REG12345',
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $response->assertSessionHas('success');

        $donation = $donation->fresh();
        $this->assertEquals('Nike Original Updated', $donation->nama_sepatu);
        $this->assertEquals('43', $donation->ukuran);
        $this->assertEquals(90, $donation->kondisi);
        $this->assertEquals(350000, $donation->harga);
        $this->assertEquals('Deskripsi baru diupdate', $donation->deskripsi);
        $this->assertEquals('ekspedisi', $donation->metode_pengiriman);
        $this->assertEquals('JNE', $donation->nama_ekspedisi);
        $this->assertEquals('REG12345', $donation->no_resi);
        
        // Photos should remain unchanged
        $this->assertEquals(['donations/old1.jpg', 'donations/old2.jpg'], $donation->foto_path);
    }

    /**
     * Test donatur can update pending donation and replace photos.
     */
    public function test_donatur_can_update_pending_donation_and_replace_photos(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Original',
            'ukuran' => '42',
            'kondisi' => 70,
            'harga' => 300000,
            'foto_path' => ['donations/old1.jpg'],
            'metode_pengiriman' => 'antar_langsung',
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $newFile1 = UploadedFile::fake()->image('new1.jpg');
        $newFile2 = UploadedFile::fake()->image('new2.jpg');

        $response = $this->put(route('donatur.donations.update', $donation), [
            'nama_sepatu' => 'Nike Original Updated',
            'ukuran' => '42',
            'kondisi' => 70,
            'harga' => 300000,
            'metode_pengiriman' => 'antar_langsung',
            'foto' => [$newFile1, $newFile2],
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $response->assertSessionHas('success');

        $donation = $donation->fresh();
        $this->assertCount(2, $donation->foto_path);
        
        foreach ($donation->foto_path as $path) {
            $this->assertTrue(Storage::disk('public')->exists($path));
            $this->assertNotEquals('donations/old1.jpg', $path);
        }
    }

    /**
     * Test donatur can update pending donation and partially delete existing photos while adding new ones.
     */
    public function test_donatur_can_update_pending_donation_and_keep_some_existing_photos_and_add_new_photos(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Original',
            'ukuran' => '42',
            'kondisi' => 70,
            'harga' => 300000,
            'foto_path' => ['donations/old1.jpg', 'donations/old2.jpg'],
            'metode_pengiriman' => 'antar_langsung',
            'status' => 'pending',
        ]);

        $this->actingAs($user);

        $newFile = UploadedFile::fake()->image('new.jpg');

        $response = $this->put(route('donatur.donations.update', $donation), [
            'nama_sepatu' => 'Nike Original Updated',
            'ukuran' => '42',
            'kondisi' => 70,
            'harga' => 300000,
            'metode_pengiriman' => 'antar_langsung',
            'existing_photos_present' => '1',
            'existing_photos' => ['donations/old2.jpg'], // keep old2, delete old1
            'foto' => [$newFile], // add new photo
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $response->assertSessionHas('success');

        $donation = $donation->fresh();
        $this->assertCount(2, $donation->foto_path);
        
        $this->assertContains('donations/old2.jpg', $donation->foto_path);
        $this->assertNotContains('donations/old1.jpg', $donation->foto_path);
    }

    /**
     * Test donatur cannot update non-pending donation.
     */
    public function test_donatur_cannot_update_non_pending_donation(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $donation = Donation::create([
            'user_id' => $user->id,
            'nama_sepatu' => 'Nike Original',
            'ukuran' => '42',
            'kondisi' => 70,
            'harga' => 300000,
            'foto_path' => ['donations/old1.jpg'],
            'metode_pengiriman' => 'antar_langsung',
            'status' => 'diterima', // already approved
        ]);

        $this->actingAs($user);

        $response = $this->put(route('donatur.donations.update', $donation), [
            'nama_sepatu' => 'Nike Original Hacked',
            'ukuran' => '44',
            'kondisi' => 100,
            'harga' => 999999,
            'metode_pengiriman' => 'antar_langsung',
        ]);

        $response->assertRedirect(route('donatur.donations.index'));
        $response->assertSessionHas('error');

        $donation = $donation->fresh();
        $this->assertEquals('Nike Original', $donation->nama_sepatu);
        $this->assertEquals('42', $donation->ukuran);
        $this->assertEquals(70, $donation->kondisi);
    }
}
