<?php

namespace Tests\Feature;

use App\Mail\DonationSubmittedMail;
use App\Models\Donation;
use App\Models\DonationDraft;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

/**
 * Public donation form of Adapt & Adopt: a guest fills it in, signs in or registers,
 * and comes back to send it without losing the data or photos.
 */
class GuestDonationDraftTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        Mail::fake();
    }

    private function fillAsGuest()
    {
        return $this->post(route('adapt-adopt.donasi.store'), [
            'nama_sepatu' => 'Air Jordan 1 Mid',
            'brand' => 'Nike',
            'ukuran' => '42',
            'kondisi' => 85,
            'deskripsi' => 'Lecet kecil di ujung kiri.',
            'foto' => [UploadedFile::fake()->image('depan.jpg'), UploadedFile::fake()->image('kiri.jpg')],
        ]);
    }

    public function test_a_guest_can_open_the_form_and_their_entry_is_kept_as_a_draft(): void
    {
        $this->get(route('adapt-adopt.donasi.create'))->assertOk()->assertSee('Donasikan sepatumu');

        $this->fillAsGuest()->assertRedirect(route('adapt-adopt.donasi.pending'));

        $draft = DonationDraft::sole();
        $this->assertNull($draft->user_id);
        $this->assertCount(2, $draft->foto_path);
        Storage::disk('public')->assertExists($draft->foto_path);
        $this->assertSame(0, Donation::count());

        $this->get(route('adapt-adopt.donasi.pending'))->assertOk()->assertSee('Satu langkah lagi')->assertSee('Air Jordan 1 Mid');
    }

    public function test_an_existing_member_signs_in_and_lands_on_the_review_page_then_sends_it(): void
    {
        $member = User::factory()->create(['role' => 'member', 'password' => bcrypt('rahasia123')]);
        $this->fillAsGuest();
        $this->get(route('login'))->assertSee('Donasi Air Jordan 1 Mid sudah kami simpan.');

        $this->post(route('login'), ['email' => $member->email, 'password' => 'rahasia123'])
            ->assertRedirect(route('adapt-adopt.donasi.review'));

        $draft = DonationDraft::sole();
        $this->assertSame($member->id, $draft->user_id);
        $this->get(route('adapt-adopt.donasi.review'))->assertOk()->assertSee('Periksa lagi lalu kirim')->assertSee('Lecet kecil di ujung kiri.');

        $this->post(route('adapt-adopt.donasi.submit', $draft))->assertRedirect(route('member.donations.index'));

        $donation = Donation::sole();
        $this->assertSame($member->id, $donation->user_id);
        $this->assertSame('Air Jordan 1 Mid', $donation->nama_sepatu);
        $this->assertSame('pending', $donation->status);
        $this->assertSame($draft->foto_path, $donation->foto_path);
        Storage::disk('public')->assertExists($donation->foto_path);
        $this->assertSame(0, DonationDraft::count());
        Mail::assertSent(DonationSubmittedMail::class, fn ($m) => $m->hasTo($member->email));
    }

    public function test_a_new_donor_registers_verifies_in_another_browser_and_still_finds_the_draft(): void
    {
        $this->fillAsGuest();

        $this->post(route('register'), [
            'name' => 'Rina Donatur',
            'email' => 'rina@gmail.com',
            'phone' => '081234567890',
            'password' => 'sepatu2026',
            'password_confirmation' => 'sepatu2026',
        ]);
        $rina = User::where('email', 'rina@gmail.com')->sole();
        $this->assertSame($rina->id, DonationDraft::sole()->user_id);
        $this->get(route('verification.notice'))->assertSee('Setelah kamu klik link verifikasi');

        // The verification link is opened in a different browser: a fresh session that knows nothing about the draft
        $this->flushSession();
        $link = URL::temporarySignedRoute('verification.verify', now()->addHour(), ['id' => $rina->id, 'hash' => sha1($rina->email)]);
        $this->actingAs($rina)->get($link)->assertRedirect(route('adapt-adopt.donasi.review'));

        $this->assertTrue($rina->fresh()->hasVerifiedEmail());
        $this->get(route('adapt-adopt.donasi.review'))->assertOk()->assertSee('Air Jordan 1 Mid');
        $this->get(route('member.dashboard'))->assertSee('Kirim donasi Air Jordan 1 Mid');
    }

    public function test_someone_else_cannot_send_or_discard_a_draft_that_is_not_theirs(): void
    {
        $owner = User::factory()->create(['role' => 'member']);
        $draft = DonationDraft::create(['user_id' => $owner->id, 'data' => ['nama_sepatu' => 'X', 'ukuran' => '40', 'kondisi' => 85], 'foto_path' => ['donations/sepatu/a.jpg']]);
        $other = User::factory()->create(['role' => 'member']);

        $this->actingAs($other)->post(route('adapt-adopt.donasi.submit', $draft))->assertNotFound();
        $this->actingAs($other)->delete(route('adapt-adopt.donasi.discard', $draft))->assertNotFound();
        $this->assertSame(0, Donation::count());
        $this->assertTrue($draft->exists());
    }

    public function test_discarding_removes_the_photos_and_stale_drafts_are_cleaned_up(): void
    {
        $this->fillAsGuest();
        $draft = DonationDraft::sole();
        $this->delete(route('adapt-adopt.donasi.discard', $draft))->assertRedirect(route('adapt-adopt.donasi.create'));
        Storage::disk('public')->assertMissing($draft->foto_path);
        $this->assertSame(0, DonationDraft::count());

        $old = DonationDraft::create(['data' => ['nama_sepatu' => 'Lama'], 'foto_path' => []]);
        DonationDraft::whereKey($old->id)->update(['updated_at' => now()->subDays(8)]);
        $this->fillAsGuest();
        $this->assertFalse(DonationDraft::whereKey($old->id)->exists());
    }

    public function test_a_verified_member_is_sent_to_the_regular_member_form(): void
    {
        $member = User::factory()->create(['role' => 'member']);
        $this->actingAs($member)->get(route('adapt-adopt.donasi.create'))->assertRedirect(route('member.donations.create'));
    }
}
