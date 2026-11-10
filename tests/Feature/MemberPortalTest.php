<?php

namespace Tests\Feature;

use App\Models\DailyLogin;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Member home ("Perlu tindakanmu"), the coming-soon Daily Check-In switch, and repair history without a phone.
 */
class MemberPortalTest extends TestCase
{
    use RefreshDatabase;

    private User $member;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->member = User::factory()->create(['role' => 'member', 'name' => 'Rina Saputri', 'phone' => '6281234567890']);
    }

    public function test_check_in_is_coming_soon_until_switched_on(): void
    {
        $this->actingAs($this->member)->get(route('member.checkin.index'))
            ->assertOk()
            ->assertSee('Segera hadir')
            ->assertDontSee('Check-In Sekarang');

        $this->actingAs($this->member)->post(route('member.checkin.store'), [
            'foto_sepatu' => UploadedFile::fake()->image('sepatu.jpg'),
        ])->assertSessionHas('error');
        $this->assertSame(0, DailyLogin::count());

        // Hidden from the member menu as well
        $this->actingAs($this->member)->get(route('member.dashboard'))
            ->assertOk()
            ->assertDontSee('href="' . route('member.checkin.index') . '"', false)
            ->assertDontSee('href="' . route('member.rewards.index') . '"', false);

        Setting::updateOrCreate(['key' => 'checkin_enabled'], ['value' => '1']);

        $this->actingAs($this->member)->get(route('member.checkin.index'))
            ->assertOk()
            ->assertDontSee('Segera hadir')
            ->assertSee('Check-In Sekarang');
    }

    public function test_dashboard_lists_what_needs_the_members_action(): void
    {
        Http::fake();
        $item = DonationItem::create(['nama' => 'Puma X Ferrari', 'kategori' => 'sepatu', 'status' => 'dipesan', 'foto_utama_path' => 'images/katalog/test.png']);
        DonationRequest::create([
            'donation_item_id' => $item->id,
            'user_id' => $this->member->id,
            'nama_pemohon' => 'Rina',
            'email' => $this->member->email,
            'kontak_pemohon' => '6281234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung',
            'alasan' => 'Untuk kerja harian, sepatu lama sudah rusak.',
            'status' => 'menunggu_pembayaran',
            'batas_bayar' => now()->addDay(),
        ]);
        Donation::create([
            'user_id' => $this->member->id,
            'nama_sepatu' => 'Chuck Taylor 70',
            'ukuran' => '40',
            'kondisi' => 85,
            'foto_path' => ['donations/sepatu/a.jpg'],
            'status' => 'disetujui',
        ]);

        $this->actingAs($this->member)->get(route('member.dashboard'))
            ->assertOk()
            ->assertSee('Halo, Rina!')
            ->assertSee('Bayar tagihan adopsi Puma X Ferrari')
            ->assertSee('Kirim sepatu donasi Chuck Taylor 70')
            ->assertSee('Data reparasi belum bisa dimuat');
    }

    private function fakeWorkshopApi(): void
    {
        Setting::create(['key' => 'workshop_api_base_url', 'value' => 'https://workshop.test/api']);
        Http::fake(['workshop.test/*' => Http::response(['status' => 'success', 'data' => ['work_orders' => [
            [
                'spk_number' => 'S-2610-21-0112-FR', 'shoe_brand' => 'Nike', 'shoe_type' => 'Air Jordan', 'shoe_size' => '42',
                'status' => ['code' => 'PRODUCTION', 'label' => 'Production'],
                'notes' => 'CATATAN INTERNAL: pelanggan rewel',
                'payment' => ['status' => 'Belum Bayar', 'total_amount' => 350000, 'paid_amount' => 0, 'remaining_balance' => 350000],
                'services' => [['service_name' => 'Ganti Sol', 'cost' => 350000]],
                'photos' => [
                    ['photo_url' => 'https://workshop.test/internal.jpg', 'is_public' => false, 'is_spk_cover' => true],
                    ['photo_url' => 'https://workshop.test/public.jpg', 'is_public' => true, 'is_spk_cover' => false],
                ],
            ],
            [
                'spk_number' => 'S-2609-05-0333-FR', 'shoe_brand' => 'Columbia', 'shoe_type' => 'Boots',
                'status' => ['code' => 'SELESAI', 'label' => 'Selesai'], 'taken_date' => null,
                'payment' => ['status' => 'L', 'total_amount' => 210000],
                'services' => [['service_name' => 'Lem Jahit', 'cost' => 210000]],
            ],
            [
                'spk_number' => 'S-2607-01-0037-GR', 'shoe_brand' => 'Nike', 'shoe_type' => 'Airmax',
                'status' => ['code' => 'SELESAI', 'label' => 'Selesai'], 'taken_date' => '2026-07-10 10:00:00',
                'payment' => ['status' => 'L', 'total_amount' => 0], 'services' => [],
            ],
        ]]])]);
    }

    public function test_dashboard_lists_repairs_ready_to_pick_up(): void
    {
        $this->fakeWorkshopApi();

        $this->actingAs($this->member)->get(route('member.dashboard'))
            ->assertOk()
            ->assertSee('Sepatu Columbia Boots siap diambil')
            ->assertSee('sedang dikerjakan dari 3 SPK', false)
            // Balances from the API miss invoice payments, so none are shown
            ->assertDontSee('Sisa tagihan');
    }

    public function test_repair_history_shows_stages_and_hides_internal_data(): void
    {
        $this->fakeWorkshopApi();

        $html = $this->actingAs($this->member)->get(route('member.reparation-history.index'))
            ->assertOk()
            ->assertSee('Sedang dikerjakan')
            ->assertSee('Tahap saat ini: Production.')
            ->assertSee('Siap diambil!')
            ->assertSee('Gratis (garansi)')
            ->assertSee('Pengerjaan ulang dari klaim garansi.')
            ->assertSee('https://workshop.test/public.jpg')
            ->getContent();

        $this->assertStringNotContainsString('CATATAN INTERNAL', $html);
        $this->assertStringNotContainsString('internal.jpg', $html);
        $this->assertStringNotContainsString('Sisa tagihan', $html);
    }

    public function test_nothing_to_do_says_so(): void
    {
        Http::fake();

        $this->actingAs($this->member)->get(route('member.dashboard'))
            ->assertOk()
            ->assertSee('Semua beres.');
    }

    public function test_repair_history_without_a_phone_asks_for_one_instead_of_crashing(): void
    {
        $member = User::factory()->create(['role' => 'member', 'phone' => null]);

        $this->actingAs($member)->get(route('member.reparation-history.index'))->assertOk();
        $this->actingAs($member)->get(route('member.dashboard'))
            ->assertOk()
            ->assertSee('Lengkapi nomor HP');
    }
}
