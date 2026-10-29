<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Member donation form (condition cards, angle photo slots, brand) and the "Donasi Saya" page.
 */
class MemberDonationPageTest extends TestCase
{
    use RefreshDatabase;

    private User $member;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->member = User::factory()->create(['role' => 'member']);
    }

    private function donation(array $attributes = []): Donation
    {
        return Donation::create($attributes + [
            'user_id' => $this->member->id,
            'nama_sepatu' => 'Air Jordan 1 Mid',
            'brand' => 'Nike',
            'ukuran' => '42',
            'kondisi' => 85,
            'foto_path' => ['donations/sepatu/a.jpg'],
            'status' => 'pending',
        ]);
    }

    public function test_a_donation_is_saved_with_brand_and_a_condition_card(): void
    {
        $this->actingAs($this->member)->post(route('member.donations.store'), [
            'nama_sepatu' => 'Air Jordan 1 Mid',
            'brand' => 'Nike',
            'ukuran' => '42',
            'kondisi' => 85,
            'foto' => [UploadedFile::fake()->image('depan.jpg'), UploadedFile::fake()->image('samping.jpg')],
        ])->assertRedirect(route('member.donations.index'));

        $donation = Donation::firstOrFail();
        $this->assertSame('Nike', $donation->brand);
        $this->assertSame(85, (int) $donation->kondisi);
        $this->assertCount(2, $donation->foto_path);
        $this->assertSame('Donasi Terkirim', $this->member->fresh()->notifications->first()->data['title']);
        $this->assertSame(1, $this->member->fresh()->unreadNotifications->count());

        // Relative times in the notification list are Indonesian whatever APP_LOCALE is
        $this->assertSame('3 bulan yang lalu', now()->subMonths(3)->diffForHumans());
    }

    public function test_shoes_at_or_below_70_percent_are_refused(): void
    {
        foreach ([70, 55] as $kondisi) {
            $this->actingAs($this->member)->post(route('member.donations.store'), [
                'nama_sepatu' => 'Sepatu Lama',
                'ukuran' => '40',
                'kondisi' => $kondisi,
                'foto' => [UploadedFile::fake()->image('depan.jpg')],
            ])->assertSessionHasErrors('kondisi');
        }

        $this->assertSame(0, Donation::count());
    }

    public function test_the_form_explains_the_70_percent_rule_and_photo_slots(): void
    {
        $this->actingAs($this->member)->get(route('member.donations.create'))
            ->assertOk()
            ->assertSee('di atas 70%', false)
            ->assertSee('Seperti baru')
            ->assertSee('Rusak berat')
            ->assertSee('Samping kiri')
            ->assertSee('Samping kanan');
    }

    public function test_a_pending_donation_does_not_claim_a_shipping_method_yet(): void
    {
        $this->donation();

        $this->actingAs($this->member)->get(route('member.donations.index'))
            ->assertOk()
            ->assertSee('Sedang ditinjau tim kami')
            ->assertSee('Nike')
            ->assertDontSee('Sepatumu dalam perjalanan')
            ->assertDontSee('Dikirim lewat');
    }

    public function test_an_approved_donation_asks_how_the_shoe_will_be_sent(): void
    {
        $this->donation(['status' => 'disetujui']);

        $this->actingAs($this->member)->get(route('member.donations.index'))
            ->assertOk()
            ->assertSee('Disetujui! Kirim sepatumu ke workshop')
            ->assertSee('Isi Cara Pengiriman');
    }

    public function test_reward_link_only_shows_while_a_donation_reward_is_active(): void
    {
        $this->donation(['status' => 'masuk_katalog']);

        $this->actingAs($this->member)->get(route('member.donations.index'))
            ->assertOk()
            ->assertDontSee('bisa ditukar dengan reward');

        Reward::create([
            'kategori_reward' => 'donasi',
            'nama_reward' => 'Voucher Reparasi',
            'deskripsi' => 'Potongan reparasi',
            'stok' => 5,
            'status_aktif' => true,
            'created_by' => $this->member->id,
        ]);

        // A donation already in the catalog still earns its claim
        $this->actingAs($this->member)->get(route('member.donations.index'))
            ->assertOk()
            ->assertSee('bisa ditukar dengan reward');
    }
}
