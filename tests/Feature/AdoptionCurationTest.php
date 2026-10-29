<?php

namespace Tests\Feature;

use App\Mail\AdoptionApprovedInvoiceMail;
use App\Mail\AdoptionSubmittedMail;
use App\Mail\AdoptionTakenMail;
use App\Mail\DonationRequestRejectedMail;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Adoption by admin curation (the default `adoption_mode`): requests wait for the admin's choice,
 * the chosen requester pays within 2x24 hours, and the others stay as reserves.
 */
class AdoptionCurationTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private DonationItem $item;

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        Storage::fake('public');
        Setting::updateOrCreate(['key' => 'adoption_mode'], ['value' => 'kurasi']);

        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->item = $this->makeItem('Nike Air Max Kurasi');
    }

    private function makeItem(string $nama): DonationItem
    {
        return DonationItem::create([
            'nama' => $nama,
            'brand' => 'Nike',
            'kategori' => 'sepatu',
            'status' => 'tersedia',
            'foto_utama_path' => 'images/katalog/test.png',
        ]);
    }

    private function submit(User $user, ?DonationItem $item = null, string $alasan = 'Untuk anak saya yang baru masuk SMP, sepatunya sudah jebol.')
    {
        return $this->actingAs($user)->post(route('katalog.request', $item ?? $this->item), [
            'nama_pemohon' => $user->name,
            'email' => $user->email,
            'kontak_pemohon' => '081234567890',
            'alamat_jalan' => 'Jl. Merdeka No. 10',
            'provinsi' => 'Jawa Barat',
            'kota' => 'Kota Bandung',
            'kecamatan' => 'Sumur Bandung',
            'kelurahan' => 'Braga',
            'kode_pos' => '40111',
            'alasan' => $alasan,
        ]);
    }

    private function choose(DonationRequest $request, string $status = 'menunggu_pembayaran')
    {
        return $this->actingAs($this->admin)->patchJson(route('admin.donation-requests.update', $request), ['status' => $status]);
    }

    private function pay(User $user, DonationRequest $request)
    {
        return $this->actingAs($user)->post(route('member.adoption-requests.upload-payment', $request), [
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ]);
    }

    public function test_a_request_waits_for_curation_without_an_invoice(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $this->submit($member)->assertRedirect(route('member.adoption-requests.index'));

        $request = DonationRequest::firstOrFail();
        $this->assertSame('pending', $request->status);
        $this->assertSame('tersedia', $this->item->fresh()->status);
        Mail::assertSent(AdoptionSubmittedMail::class, fn ($m) => $m->hasTo($member->email));
        Mail::assertNotSent(AdoptionApprovedInvoiceMail::class);
        $this->assertSame('Pengajuan Adopsi Terkirim', $member->fresh()->notifications->first()->data['title']);

        // Nothing to pay yet: no bank account or upload form
        $this->actingAs($member)->get(route('member.adoption-requests.show', $request))
            ->assertOk()
            ->assertSee('Pengajuanmu sedang dikurasi')
            ->assertDontSee('8100978521');
        $this->actingAs($member)->get(route('member.adoption-requests.index'))
            ->assertOk()
            ->assertSee('Sedang dikurasi tim kami')
            ->assertDontSee('Bayar &amp; Unggah Bukti', false);

        // And a pending request cannot be paid
        $this->pay($member, $request)->assertSessionHas('error');
        $this->assertSame('pending', $request->fresh()->status);
    }

    public function test_the_address_is_stored_per_field_and_as_one_line(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $this->actingAs($member)->post(route('katalog.request', $this->item), [
            'nama_pemohon' => $member->name,
            'email' => $member->email,
            'kontak_pemohon' => '081234567890',
            'alamat_jalan' => 'Jl. Kembar I No. 41',
            'alamat_rt_rw' => '002/005',
            'alamat_patokan' => 'depan masjid',
            'provinsi' => 'Jawa Barat',
            'kota' => 'Kota Bandung',
            'kecamatan' => 'Regol',
            'kelurahan' => 'Cigereleng',
            'kode_pos' => '40253',
            'alasan' => 'Untuk anak saya yang baru masuk SMP, sepatunya sudah jebol.',
        ])->assertRedirect(route('member.adoption-requests.index'));

        $request = DonationRequest::firstOrFail();
        $this->assertSame('Regol', $request->kecamatan);
        $this->assertSame('40253', $request->kode_pos);
        $this->assertSame(
            'Jl. Kembar I No. 41, RT/RW 002/005, Kel. Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253 (Patokan: depan masjid)',
            $request->alamat_pengiriman
        );

        // The next request form is prefilled with this address
        $other = $this->makeItem('Sepatu Kedua');
        $this->actingAs($member)->get(route('katalog.request.form', $other))
            ->assertOk()
            ->assertSee('Diisi dari alamat pengajuan terakhirmu')
            ->assertSee('Jl. Kembar I No. 41');
    }

    public function test_a_district_outside_the_chosen_city_is_refused(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $this->actingAs($member)->post(route('katalog.request', $this->item), [
            'nama_pemohon' => $member->name,
            'email' => $member->email,
            'kontak_pemohon' => '081234567890',
            'alamat_jalan' => 'Jl. Kembar I No. 41',
            'provinsi' => 'Jawa Barat',
            'kota' => 'Kota Bandung',
            'kecamatan' => 'Menteng',
            'kelurahan' => 'Cigereleng',
            'kode_pos' => '4025',
            'alasan' => 'Untuk anak saya yang baru masuk SMP, sepatunya sudah jebol.',
        ])->assertSessionHasErrors(['kecamatan', 'kode_pos']);

        $this->assertSame(0, DonationRequest::count());
    }

    public function test_the_reason_must_be_at_least_20_characters(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $this->submit($member, null, 'Butuh sepatu')->assertSessionHasErrors('alasan');

        $this->assertSame(0, DonationRequest::count());
    }

    public function test_choosing_a_requester_reserves_the_shoe_and_keeps_the_others_as_reserves(): void
    {
        [$ani, $budi] = User::factory()->count(2)->create(['role' => 'member']);
        $this->submit($ani);
        $this->submit($budi);
        [$aniReq, $budiReq] = DonationRequest::orderBy('id')->get();

        $this->choose($budiReq)->assertOk()->assertJson(['success' => true, 'item_status' => 'dipesan']);

        $budiReq->refresh();
        $this->assertSame('menunggu_pembayaran', $budiReq->status);
        $this->assertTrue($budiReq->batas_bayar->between(now()->addHours(47), now()->addHours(49)));
        $this->assertSame('pending', $aniReq->fresh()->status);
        $this->assertSame('dipesan', $this->item->fresh()->status);
        Mail::assertSent(AdoptionApprovedInvoiceMail::class, fn ($m) => $m->hasTo($budi->email)
            && str_contains($m->render(), 'TERPILIH'));
        Mail::assertNotSent(AdoptionApprovedInvoiceMail::class, fn ($m) => $m->hasTo($ani->email));

        // The shoe leaves the catalog and nobody else can request it
        $this->get(route('katalog.index'))->assertDontSee('Nike Air Max Kurasi');
        $carla = User::factory()->create(['role' => 'member']);
        $this->submit($carla)->assertStatus(422);
        $this->assertSame(0, DonationRequest::where('user_id', $carla->id)->count());

        // Ani is told she's a reserve; Budi sees his deadline and can pay
        $this->actingAs($ani)->get(route('member.adoption-requests.show', $aniReq))
            ->assertOk()
            ->assertSee('Kamu masuk daftar cadangan')
            ->assertDontSee('8100978521');
        $this->actingAs($budi)->get(route('member.adoption-requests.show', $budiReq))
            ->assertOk()
            ->assertSee('Selamat, kamu terpilih!')
            ->assertSee('8100978521');

        // Only one requester can be chosen at a time
        $this->choose($aniReq)->assertStatus(422);
        $this->assertSame('pending', $aniReq->fresh()->status);
    }

    public function test_the_chosen_requester_pays_and_the_reserves_are_closed_on_approval(): void
    {
        [$ani, $budi] = User::factory()->count(2)->create(['role' => 'member']);
        $this->submit($ani);
        $this->submit($budi);
        [$aniReq, $budiReq] = DonationRequest::orderBy('id')->get();
        $this->choose($aniReq);

        $this->pay($ani, $aniReq)->assertSessionHas('success');
        $this->assertSame('menunggu_verifikasi', $aniReq->fresh()->status);
        $this->assertTrue($ani->fresh()->notifications->contains(fn ($n) => $n->data['title'] === 'Bukti Bayar Terkirim'));
        $this->assertSame('dipesan', $this->item->fresh()->status);

        $this->choose($aniReq, 'diproses')->assertOk();

        $this->assertSame('disalurkan', $this->item->fresh()->status);
        $this->assertSame('ditolak', $budiReq->fresh()->status);
        Mail::assertSent(AdoptionTakenMail::class, fn ($m) => $m->hasTo($budi->email)
            && str_contains($m->render(), 'Setelah kurasi'));
    }

    public function test_cancelling_a_chosen_requester_who_did_not_pay_lets_the_admin_pick_a_reserve(): void
    {
        [$ani, $budi] = User::factory()->count(2)->create(['role' => 'member']);
        $this->submit($ani);
        $this->submit($budi);
        [$aniReq, $budiReq] = DonationRequest::orderBy('id')->get();
        $this->choose($aniReq);

        $this->travel(49)->hours();
        $this->assertTrue($aniReq->fresh()->isPaymentOverdue());

        $this->choose($aniReq, 'dibatalkan')->assertOk()->assertJson(['item_status' => 'tersedia']);
        $this->assertSame('pending', $budiReq->fresh()->status);

        $this->choose($budiReq)->assertOk()->assertJson(['item_status' => 'dipesan']);
        $this->assertSame('menunggu_pembayaran', $budiReq->fresh()->status);
    }

    public function test_rejecting_a_pending_request_says_it_was_not_chosen(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $this->submit($member);

        $this->choose(DonationRequest::firstOrFail(), 'ditolak')->assertOk();

        Mail::assertSent(DonationRequestRejectedMail::class, fn ($m) => $m->hasTo($member->email)
            && str_contains($m->render(), 'belum terpilih'));
        $this->assertSame('tersedia', $this->item->fresh()->status);
    }

    public function test_a_member_may_have_three_requests_in_curation_and_one_per_shoe(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $shoes = collect(range(1, 4))->map(fn ($i) => $this->makeItem("Sepatu Kurasi {$i}"));

        foreach ($shoes->take(3) as $shoe) {
            $this->submit($member, $shoe)->assertRedirect(route('member.adoption-requests.index'));
        }
        $this->submit($member, $shoes[3])->assertSessionHas('error');
        $this->assertSame(3, DonationRequest::where('user_id', $member->id)->count());

        // The same shoe twice is refused even below the limit
        $other = User::factory()->create(['role' => 'member']);
        $this->submit($other, $shoes[0]);
        $this->submit($other, $shoes[0])->assertSessionHas('error');
        $this->assertSame(1, DonationRequest::where('user_id', $other->id)->count());
    }

    public function test_admin_page_escapes_requester_text_and_shows_curation_aids(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $this->submit($member, null, '<img src=x onerror=alert(1)> sepatu untuk kerja harian');

        $html = $this->actingAs($this->admin)->get(route('admin.donation-requests.index'))
            ->assertOk()
            ->assertSee('Menunggu Kurasi')
            ->getContent();

        $this->assertStringContainsString('function esc(', $html);
        $this->assertStringContainsString('${esc(req.alasan', $html);
        $this->assertStringContainsString('"member_donasi":0', $html);
    }

    public function test_unpaid_invoices_from_before_curation_go_back_to_curation(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $base = [
            'donation_item_id' => $this->item->id,
            'user_id' => $member->id,
            'nama_pemohon' => $member->name,
            'email' => $member->email,
            'kontak_pemohon' => '6281234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung',
            'alasan' => 'Untuk kerja harian, sepatu lama sudah rusak.',
        ];
        $legacy = DonationRequest::create($base + ['status' => 'menunggu_pembayaran']);
        $paid = DonationRequest::create($base + ['status' => 'menunggu_pembayaran', 'bukti_pembayaran' => 'payments/x.jpg']);
        $chosen = DonationRequest::create($base + ['status' => 'menunggu_pembayaran', 'batas_bayar' => now()->addDay()]);

        (require database_path('migrations/2026_10_30_090000_move_unpaid_legacy_invoices_to_curation.php'))->up();

        $this->assertSame('pending', $legacy->fresh()->status);
        $this->assertSame('menunggu_pembayaran', $paid->fresh()->status);
        $this->assertSame('menunggu_pembayaran', $chosen->fresh()->status);
    }

    public function test_switching_to_cepat_restores_the_instant_invoice(): void
    {
        Setting::where('key', 'adoption_mode')->update(['value' => 'cepat']);
        $member = User::factory()->create(['role' => 'member']);

        $this->submit($member);

        $this->assertSame('menunggu_pembayaran', DonationRequest::firstOrFail()->status);
        $this->assertNull(DonationRequest::firstOrFail()->batas_bayar);
        Mail::assertSent(AdoptionApprovedInvoiceMail::class);
    }
}
