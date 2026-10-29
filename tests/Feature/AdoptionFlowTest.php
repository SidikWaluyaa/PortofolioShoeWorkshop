<?php

namespace Tests\Feature;

use App\Mail\AdoptionApprovedInvoiceMail;
use App\Mail\AdoptionAvailableAgainMail;
use App\Mail\AdoptionCompletedMail;
use App\Mail\AdoptionOnHoldMail;
use App\Mail\AdoptionProcessingMail;
use App\Mail\AdoptionTakenMail;
use App\Mail\DonationApprovedMail;
use App\Mail\DonationReceivedMail;
use App\Mail\DonationRejectedMail;
use App\Mail\DonationRequestRejectedMail;
use App\Mail\DonationShippedMail;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\Setting;
use App\Models\User;
use App\Services\DonationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * "Siapa cepat dia dapat" adoption flow and its notification emails.
 */
class AdoptionFlowTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private DonationItem $item;

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        Storage::fake('public');
        Setting::create(['key' => 'whatsapp_number', 'value' => '628123456789']);
        Setting::updateOrCreate(['key' => 'adoption_mode'], ['value' => 'cepat']);

        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->item = $this->makeItem('Nike Air Max Adopsi');
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

    private function makeRequest(User $user, ?DonationItem $item = null, string $status = 'menunggu_pembayaran'): DonationRequest
    {
        return DonationRequest::create([
            'donation_item_id' => ($item ?? $this->item)->id,
            'user_id' => $user->id,
            'nama_pemohon' => $user->name,
            'email' => $user->email,
            'kontak_pemohon' => '6281234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung',
            'alasan' => 'Butuh sepatu untuk kerja harian',
            'status' => $status,
        ]);
    }

    private function pay(User $user, DonationRequest $request)
    {
        return $this->actingAs($user)->post(route('member.adoption-requests.upload-payment', $request), [
            'bukti_pembayaran' => UploadedFile::fake()->image('bukti.jpg'),
        ]);
    }

    private function adminSetStatus(DonationRequest $request, string $status, array $extra = [])
    {
        return $this->actingAs($this->admin)->patchJson(
            route('admin.donation-requests.update', $request),
            array_merge(['status' => $status], $extra)
        );
    }

    public function test_first_payer_reserves_the_shoe_and_others_are_put_on_hold(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);

        $this->pay($a, $reqA)->assertSessionHas('success');

        $this->assertSame('menunggu_verifikasi', $reqA->fresh()->status);
        $this->assertSame('dipesan', $this->item->fresh()->status);
        $this->assertSame('menunggu_pembayaran', $reqB->fresh()->status);
        $this->assertTrue($reqB->fresh()->isOnHold());
        Mail::assertSent(AdoptionOnHoldMail::class, fn ($m) => $m->hasTo($b->email));
        Mail::assertNotSent(AdoptionOnHoldMail::class, fn ($m) => $m->hasTo($a->email));

        // Hidden from the public catalog while the payment is being verified
        $this->get(route('katalog.index'))->assertDontSee('Nike Air Max Adopsi');
        $this->get(route('katalog.filter'), ['X-Requested-With' => 'XMLHttpRequest'])->assertDontSee('Nike Air Max Adopsi');
    }

    public function test_second_payer_is_blocked_while_the_shoe_is_reserved(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->pay($b, $reqB)->assertSessionHas('error');

        $this->assertSame('menunggu_pembayaran', $reqB->fresh()->status);
        $this->assertNull($reqB->fresh()->bukti_pembayaran);
        $this->assertCount(1, Storage::disk('public')->allFiles('payments'));
    }

    public function test_admin_approving_payment_hands_over_the_shoe_and_rejects_the_others(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->adminSetStatus($reqA, 'diproses')
            ->assertOk()
            ->assertJson(['success' => true, 'item_status' => 'disalurkan'])
            ->assertJsonPath("request_statuses.{$reqB->id}", 'ditolak');

        $this->assertSame('disalurkan', $this->item->fresh()->status);
        $this->assertSame('ditolak', $reqB->fresh()->status);
        Mail::assertSent(AdoptionProcessingMail::class, fn ($m) => $m->hasTo($a->email));
        Mail::assertSent(AdoptionTakenMail::class, fn ($m) => $m->hasTo($b->email));
    }

    public function test_admin_rejecting_payment_releases_the_shoe_and_others_can_pay(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->adminSetStatus($reqA, 'ditolak')->assertOk()->assertJson(['item_status' => 'tersedia']);

        $this->assertSame('tersedia', $this->item->fresh()->status);
        $this->assertSame('menunggu_pembayaran', $reqB->fresh()->status);
        Mail::assertSent(DonationRequestRejectedMail::class, fn ($m) => $m->hasTo($a->email));
        Mail::assertSent(AdoptionAvailableAgainMail::class, fn ($m) => $m->hasTo($b->email)
            && str_contains($m->render(), 'Bayar &amp; Unggah Bukti Sekarang'));
        $this->get(route('katalog.index'))->assertSee('Nike Air Max Adopsi');

        $this->pay($b, $reqB)->assertSessionHas('success');
        $this->assertSame('menunggu_verifikasi', $reqB->fresh()->status);
        $this->assertSame('dipesan', $this->item->fresh()->status);
    }

    public function test_admin_cannot_hand_the_shoe_to_another_requester_while_it_is_reserved(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->adminSetStatus($reqB, 'diproses')->assertStatus(422)->assertJson(['success' => false]);

        $this->assertSame('menunggu_pembayaran', $reqB->fresh()->status);
        $this->assertSame('dipesan', $this->item->fresh()->status);
    }

    public function test_cancelling_a_waiting_request_does_not_release_a_reserved_shoe(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->adminSetStatus($reqB, 'dibatalkan')->assertOk();

        $this->assertSame('dibatalkan', $reqB->fresh()->status);
        $this->assertSame('dipesan', $this->item->fresh()->status);
    }

    public function test_deleting_the_reserving_request_releases_the_shoe(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->actingAs($this->admin)
            ->deleteJson(route('admin.donation-requests.destroy', $reqA))
            ->assertOk()
            ->assertJson(['item_status' => 'tersedia']);

        $this->assertDatabaseMissing('donation_requests', ['id' => $reqA->id]);
        $this->assertSame('tersedia', $this->item->fresh()->status);
        Mail::assertSent(AdoptionAvailableAgainMail::class, fn ($m) => $m->hasTo($b->email));
    }

    public function test_emails_are_only_sent_when_the_status_actually_changes(): void
    {
        $a = User::factory()->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);

        // Re-saving the same status must not resend the invoice
        $this->adminSetStatus($reqA, 'menunggu_pembayaran')->assertOk();
        Mail::assertNotSent(AdoptionApprovedInvoiceMail::class);

        $this->pay($a, $reqA);
        $this->adminSetStatus($reqA, 'diproses');
        $this->adminSetStatus($reqA, 'dikirim', ['resi_pengiriman' => 'JNT001']);
        // Correcting the tracking number keeps the status: resi updated, no second shipped email
        $this->adminSetStatus($reqA, 'dikirim', ['resi_pengiriman' => 'JNT002'])->assertOk();

        $this->assertSame('JNT002', $reqA->fresh()->resi_pengiriman);
        Mail::assertSent(DonationShippedMail::class, 1);
        Mail::assertSent(AdoptionProcessingMail::class, 1);
    }

    public function test_member_completing_the_adoption_gets_a_thank_you_email(): void
    {
        $a = User::factory()->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $this->pay($a, $reqA);
        $this->adminSetStatus($reqA, 'diproses');
        $this->adminSetStatus($reqA, 'dikirim', ['resi_pengiriman' => 'JNT001']);

        $this->actingAs($a)->post(route('member.adoption-requests.complete', $reqA), [
            'bukti_penerimaan' => UploadedFile::fake()->image('terima.jpg'),
        ])->assertSessionHas('success');

        $this->assertSame('selesai', $reqA->fresh()->status);
        $this->assertSame('disalurkan', $this->item->fresh()->status);
        Mail::assertSent(AdoptionCompletedMail::class, fn ($m) => $m->hasTo($a->email));
    }

    public function test_a_member_on_hold_can_still_request_another_shoe(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $this->makeRequest($b);
        $this->pay($a, $reqA);

        $other = $this->makeItem('Adidas Samba Lain');
        $this->actingAs($b)->post(route('katalog.request', $other), [
            'nama_pemohon' => $b->name,
            'email' => $b->email,
            'kontak_pemohon' => '081234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung',
            'alasan' => 'Butuh sepatu untuk kerja harian',
        ])->assertRedirect(route('member.adoption-requests.index'));

        $this->assertSame(2, DonationRequest::where('user_id', $b->id)->count());
    }

    public function test_a_member_with_a_payable_request_cannot_request_another_shoe(): void
    {
        $a = User::factory()->create(['role' => 'member']);
        $this->makeRequest($a);

        $other = $this->makeItem('Adidas Samba Lain');
        $this->actingAs($a)->post(route('katalog.request', $other), [
            'nama_pemohon' => $a->name,
            'email' => $a->email,
            'kontak_pemohon' => '081234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung',
            'alasan' => 'Butuh sepatu untuk kerja harian',
        ])->assertSessionHas('error');

        $this->assertSame(1, DonationRequest::where('user_id', $a->id)->count());
    }

    public function test_a_member_pays_for_one_shoe_at_a_time(): void
    {
        [$ani, $budi] = User::factory()->count(2)->create(['role' => 'member']);
        $shoeB = $this->makeItem('Adidas Samba Lain');

        // Budi is on hold for shoe A (Ani paid first), so he requests and pays for shoe B
        $aniA = $this->makeRequest($ani);
        $budiA = $this->makeRequest($budi);
        $this->pay($ani, $aniA);
        $budiB = $this->makeRequest($budi, $shoeB);
        $this->pay($budi, $budiB)->assertSessionHas('success');

        // Ani's payment is rejected: shoe A is available again, but Budi must finish order B first
        $this->adminSetStatus($aniA, 'ditolak');
        Mail::assertSent(AdoptionAvailableAgainMail::class, fn ($m) => $m->hasTo($budi->email)
            && str_contains($m->render(), 'Mohon jangan transfer untuk sepatu ini dulu')
            && !str_contains($m->render(), 'Bayar &amp; Unggah Bukti Sekarang'));
        // Several notifications share a timestamp, so look for it instead of relying on order
        $this->assertTrue($budi->fresh()->notifications->contains(
            fn ($n) => str_contains($n->data['message'], 'tersedia lagi. Selesaikan pesanan Anda yang lain dulu')
        ));
        $this->actingAs($budi)->get(route('member.adoption-requests.show', $budiA))
            ->assertOk()
            ->assertSee('Selesaikan pesanan Anda yang lain dulu')
            ->assertDontSee('8100978521');
        $this->pay($budi, $budiA)->assertSessionHas('error');
        $this->assertSame('menunggu_pembayaran', $budiA->fresh()->status);
        $this->assertSame('tersedia', $this->item->fresh()->status);

        // Still blocked while order B is processed; allowed once it has been shipped
        $this->adminSetStatus($budiB, 'diproses');
        $this->pay($budi, $budiA)->assertSessionHas('error');
        $this->adminSetStatus($budiB, 'dikirim', ['resi_pengiriman' => 'JNT001']);
        $this->pay($budi, $budiA)->assertSessionHas('success');
        $this->assertSame('menunggu_verifikasi', $budiA->fresh()->status);
    }

    public function test_super_admin_rollback_returns_the_shoe_to_the_catalog(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);
        $a = User::factory()->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $this->pay($a, $reqA);
        $this->adminSetStatus($reqA, 'diproses');

        $this->actingAs($superAdmin)->post(route('admin.orders.rollback', $reqA))->assertSessionHas('success');

        $this->assertSame('dibatalkan', $reqA->fresh()->status);
        $this->assertSame('tersedia', $this->item->fresh()->status);
    }

    public function test_donation_rejected_and_received_send_emails_to_the_donor(): void
    {
        $donor = User::factory()->create(['role' => 'member']);
        $service = app(DonationService::class);
        $make = fn () => Donation::create([
            'user_id' => $donor->id,
            'nama_sepatu' => 'Converse Chuck 70',
            'ukuran' => 42,
            'kondisi' => 80,
            'harga' => 500000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'pending',
        ]);

        $this->actingAs($this->admin);
        $service->reject($make(), 'Sol sudah terlalu rusak.');
        Mail::assertSent(DonationRejectedMail::class, fn ($m) => $m->hasTo($donor->email));

        $service->confirmReceipt($make(), UploadedFile::fake()->image('bukti.jpg'));
        Mail::assertSent(DonationReceivedMail::class, fn ($m) => $m->hasTo($donor->email));
    }

    public function test_pages_show_the_reserved_and_on_hold_states(): void
    {
        [$a, $b] = User::factory()->count(2)->create(['role' => 'member']);
        $reqA = $this->makeRequest($a);
        $reqB = $this->makeRequest($b);
        $this->pay($a, $reqA);

        $this->actingAs($b)->get(route('member.adoption-requests.show', $reqB))
            ->assertOk()
            ->assertSee('Sepatu ini sedang dipesan pemohon lain')
            ->assertDontSee('8100978521'); // no bank account / upload form while on hold
        $this->actingAs($b)->get(route('member.adoption-requests.index'))
            ->assertOk()
            ->assertSee('Sedang dipesan pemohon lain');
        $this->actingAs($a)->get(route('member.adoption-requests.show', $reqA))->assertOk();

        $this->actingAs($this->admin)->get(route('admin.donation-requests.index'))
            ->assertOk()
            ->assertSee('Dipesan');
        $this->actingAs($this->admin)->get(route('admin.donation-items.index'))->assertOk()->assertSee('Dipesan');
        $this->actingAs($this->admin)->get(route('admin.donation-items.edit', $this->item))
            ->assertOk()
            ->assertSee('Dipesan (menunggu verifikasi pembayaran)');
        $this->actingAs($this->admin)->get(route('admin.donation-items.export-pdf'))->assertOk();
    }

    public function test_public_navbar_links_to_the_member_adoption_page(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $link = 'href="' . route('member.adoption-requests.index') . '"';

        $html = $this->actingAs($member)->get(route('home'))->assertOk()->getContent();

        // Desktop account dropdown + mobile menu
        $this->assertSame(2, substr_count($html, $link));
    }

    public function test_all_new_and_changed_emails_render(): void
    {
        $a = User::factory()->create(['role' => 'member', 'name' => 'Rina Adopter']);
        $request = $this->makeRequest($a);
        $donation = Donation::create([
            'user_id' => $a->id,
            'nama_sepatu' => 'Converse Chuck 70',
            'ukuran' => 42,
            'kondisi' => 80,
            'harga' => 500000,
            'foto_path' => 'donations/sepatu.jpg',
            'metode_pengiriman' => 'ekspedisi',
            'status' => 'ditolak',
            'catatan_admin' => 'Sol sudah terlalu rusak.',
        ]);

        foreach ([
            new AdoptionOnHoldMail($request),
            new AdoptionTakenMail($request),
            new AdoptionAvailableAgainMail($request),
            new AdoptionProcessingMail($request),
            new AdoptionCompletedMail($request),
            new DonationRequestRejectedMail($request),
        ] as $mail) {
            $html = $mail->render();
            $this->assertStringContainsString('Rina Adopter', $html, class_basename($mail));
            $this->assertStringContainsString('Nike Air Max Adopsi', $html, class_basename($mail));
        }

        $this->assertStringContainsString('Sol sudah terlalu rusak.', (new DonationRejectedMail($donation))->render());
        $this->assertStringContainsString('Converse Chuck 70', (new DonationReceivedMail($donation))->render());

        $approved = (new DonationApprovedMail($donation))->render();
        $this->assertStringContainsString('Halo, Rina Adopter!', $approved);
        $this->assertStringContainsString('Converse Chuck 70', $approved);
    }
}
