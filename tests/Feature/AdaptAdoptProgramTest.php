<?php

namespace Tests\Feature;

use App\Mail\AdoptionReserveMail;
use App\Mail\DonationSubmittedMail;
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
 * Adapt & Adopt by ShoeWorkshop: program page, catalog URLs, and the messages promised in the program paper.
 */
class AdaptAdoptProgramTest extends TestCase
{
    use RefreshDatabase;

    private function item(string $nama = 'Converse Chuck Taylor', string $status = 'tersedia'): DonationItem
    {
        return DonationItem::create([
            'nama' => $nama,
            'brand' => 'Converse',
            'kategori' => 'sepatu',
            'status' => $status,
            'foto_utama_path' => 'images/katalog/test.png',
        ]);
    }

    public function test_program_page_explains_the_program_without_banned_claims(): void
    {
        $this->item('Converse Chuck Taylor');

        $html = $this->get(route('adapt-adopt.index'))
            ->assertOk()
            ->assertSee('Adapt the Mindset.')
            ->assertSee('Converse Chuck Taylor')
            ->assertSee('Tidak ada komplain dan garansi untuk sepatu adopsi')
            ->getContent();

        foreach (['sepatu gratis', 'selamatkan bumi', '100% sustainable'] as $banned) {
            $this->assertStringNotContainsStringIgnoringCase($banned, $html);
        }
    }

    public function test_catalog_lives_under_the_program_and_old_links_redirect(): void
    {
        $item = $this->item();

        $this->assertSame(url('/adapt-adopt/katalog'), route('katalog.index'));
        $this->get('/adapt-adopt/katalog')->assertOk();
        $this->get('/donasi?size=42')->assertRedirect('/adapt-adopt/katalog?size=42');
        $this->get('/donasi/' . $item->id)->assertRedirect('/adapt-adopt/katalog/' . $item->id);
        $this->get('/donasi-katalog')->assertRedirect('/adapt-adopt/katalog');
    }

    public function test_navigation_names_the_program(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Adapt &amp; Adopt', false)
            ->assertSee('href="' . route('adapt-adopt.index') . '"', false);
    }

    public function test_terms_state_there_is_no_warranty_for_adopted_shoes(): void
    {
        $this->get(route('terms-of-service'))
            ->assertOk()
            ->assertSee('Program Adapt &amp; Adopt by ShoeWorkshop', false)
            ->assertSee('Tidak ada komplain maupun garansi untuk sepatu adopsi');
    }

    public function test_an_online_donation_gets_a_confirmation_email(): void
    {
        Mail::fake();
        Storage::fake('public');
        $member = User::factory()->create(['role' => 'member']);

        $this->actingAs($member)->post(route('member.donations.store'), [
            'nama_sepatu' => 'Air Jordan 1 Mid',
            'ukuran' => '42',
            'kondisi' => 85,
            'foto' => [UploadedFile::fake()->image('depan.jpg')],
        ])->assertRedirect(route('member.donations.index'));

        Mail::assertSent(DonationSubmittedMail::class, fn ($m) => $m->hasTo($member->email)
            && str_contains($m->render(), 'jangan kirim sepatunya dulu'));
    }

    public function test_other_requesters_are_told_they_are_reserves_when_someone_is_chosen(): void
    {
        Mail::fake();
        Setting::updateOrCreate(['key' => 'adoption_mode'], ['value' => 'kurasi']);
        $admin = User::factory()->create(['role' => 'admin']);
        [$ani, $budi] = User::factory()->count(2)->create(['role' => 'member']);
        $item = $this->item();
        [$aniReq, $budiReq] = collect([$ani, $budi])->map(fn ($u) => DonationRequest::create([
            'donation_item_id' => $item->id,
            'user_id' => $u->id,
            'nama_pemohon' => $u->name,
            'email' => $u->email,
            'kontak_pemohon' => '6281234567890',
            'alamat_pengiriman' => 'Jl. Merdeka No. 10, Bandung',
            'alasan' => 'Untuk kerja harian, sepatu lama sudah rusak.',
            'status' => 'pending',
        ]))->all();

        $this->actingAs($admin)->patchJson(route('admin.donation-requests.update', $aniReq), ['status' => 'menunggu_pembayaran'])->assertOk();

        Mail::assertSent(AdoptionReserveMail::class, fn ($m) => $m->hasTo($budi->email));
        Mail::assertNotSent(AdoptionReserveMail::class, fn ($m) => $m->hasTo($ani->email));
        $this->assertTrue($budi->fresh()->notifications->contains(fn ($n) => $n->data['title'] === 'Kamu Masuk Daftar Cadangan'));
        $this->assertSame('pending', $budiReq->fresh()->status);
    }

    public function test_old_donor_links_lead_to_the_program_instead_of_a_404(): void
    {
        $this->get('/donatur/donations/create')->assertRedirect('/adapt-adopt/donasi');
        $this->get('/donatur/dashboard')->assertRedirect('/member/dashboard');
    }

    public function test_transparent_hero_images_are_stored_as_webp_and_stay_transparent(): void
    {
        if (!function_exists('imagewebp')) {
            $this->markTestSkipped('GD without WebP support');
        }
        Storage::fake('public');
        $png = imagecreatetruecolor(1600, 800);
        imagesavealpha($png, true);
        imagefill($png, 0, 0, imagecolorallocatealpha($png, 0, 0, 0, 127));
        $file = tempnam(sys_get_temp_dir(), 'hero') . '.png';
        imagepng($png, $file);

        $path = \App\Helpers\ImageCompressionHelper::storeTransparentWebp(new UploadedFile($file, 'hero.png', 'image/png', null, true), 'hero');

        $this->assertStringEndsWith('.webp', $path);
        $stored = imagecreatefromwebp(Storage::disk('public')->path($path));
        $this->assertSame(1400, imagesx($stored));
        $this->assertSame(127, (imagecolorat($stored, 10, 10) >> 24) & 0x7F, 'corner should stay fully transparent');
    }
}
