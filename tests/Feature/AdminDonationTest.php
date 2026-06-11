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

    /**
     * Test admin can approve a donation with photo proof.
     */
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
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($admin);

        $file = UploadedFile::fake()->image('bukti.jpg');

        $response = $this->post(route('admin.donations.approve', $donation), [
            'foto_bukti' => $file,
            'catatan_admin' => 'Barang diterima dan sesuai',
        ]);

        $response->assertRedirect(route('admin.donations.show', $donation));
        $response->assertSessionHas('success');

        $donation = $donation->fresh();
        $this->assertEquals('diterima', $donation->status);
        $this->assertNotNull($donation->foto_bukti_path);
        $this->assertEquals($admin->id, $donation->verified_by);
        $this->assertEquals('Barang diterima dan sesuai', $donation->catatan_admin);
        $this->assertTrue(Storage::disk('public')->exists($donation->foto_bukti_path));
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
            'foto' => $file,
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
}
