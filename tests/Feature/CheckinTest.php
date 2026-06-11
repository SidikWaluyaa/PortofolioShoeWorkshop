<?php

namespace Tests\Feature;

use App\Models\DailyLogin;
use App\Models\User;
use App\Services\CheckinService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CheckinTest extends TestCase
{
    use RefreshDatabase;

    protected CheckinService $checkinService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkinService = $this->app->make(CheckinService::class);
        Storage::fake('public');
    }

    /**
     * Test user cannot check-in twice on the same day.
     */
    public function test_user_cannot_checkin_twice_on_same_day(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $file1 = UploadedFile::fake()->image('sepatu1.jpg');
        $this->checkinService->checkin($file1);

        $this->assertDatabaseCount('daily_logins', 1);

        // Second checkin via service should throw Exception
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Anda sudah melakukan check-in hari ini.');
        
        $file2 = UploadedFile::fake()->image('sepatu2.jpg');
        $this->checkinService->checkin($file2);
    }

    /**
     * Test check-in controller blocks double check-in by redirecting with error.
     */
    public function test_checkin_controller_blocks_double_checkin(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('sepatu.jpg');

        // First post request
        $response = $this->post(route('donatur.checkin.store'), [
            'foto_sepatu' => $file,
        ]);
        $response->assertRedirect(route('donatur.checkin.index'));
        $response->assertSessionHas('success');

        // Second post request on same day
        $response2 = $this->post(route('donatur.checkin.store'), [
            'foto_sepatu' => $file,
        ]);
        $response2->assertRedirect(route('donatur.checkin.index'));
        $response2->assertSessionHas('error', 'Anda sudah melakukan check-in hari ini.');
    }

    /**
     * Test consecutive daily check-ins increment the streak (hari_ke).
     */
    public function test_consecutive_checkins_increment_streak(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        // Day 1
        Carbon::setTestNow(Carbon::parse('2026-06-01 10:00:00'));
        $checkin1 = $this->checkinService->checkin(UploadedFile::fake()->image('sepatu1.jpg'));
        $this->assertEquals(1, $checkin1->hari_ke);
        $this->assertEquals(1, $checkin1->minggu_ke);

        // Day 2 (Consecutive)
        Carbon::setTestNow(Carbon::parse('2026-06-02 11:00:00'));
        $checkin2 = $this->checkinService->checkin(UploadedFile::fake()->image('sepatu2.jpg'));
        $this->assertEquals(2, $checkin2->hari_ke);
        $this->assertEquals(1, $checkin2->minggu_ke);

        Carbon::setTestNow(); // Reset time
    }

    /**
     * Test non-consecutive check-ins (missed a day) resets the streak (hari_ke = 1).
     */
    public function test_non_consecutive_checkin_resets_streak(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        // Day 1: Check-in on June 1st
        Carbon::setTestNow(Carbon::parse('2026-06-01 10:00:00'));
        $checkin1 = $this->checkinService->checkin(UploadedFile::fake()->image('sepatu1.jpg'));
        $this->assertEquals(1, $checkin1->hari_ke);

        // Skip June 2nd, Check-in on June 3rd (Difference is 2 days from June 1st)
        Carbon::setTestNow(Carbon::parse('2026-06-03 10:00:00'));
        $checkin2 = $this->checkinService->checkin(UploadedFile::fake()->image('sepatu2.jpg'));
        
        // Streak should reset to hari_ke = 1
        $this->assertEquals(1, $checkin2->hari_ke);
        $this->assertEquals(1, $checkin2->minggu_ke);

        Carbon::setTestNow(); // Reset time
    }

    /**
     * Test check-in status: auto-approved for Days 1-6, pending for Day 7.
     */
    public function test_auto_approval_days_1_to_6_and_pending_day_7(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        // Days 1 to 6
        for ($i = 1; $i <= 6; $i++) {
            Carbon::setTestNow(Carbon::parse("2026-06-0$i 10:00:00"));
            $checkin = $this->checkinService->checkin(UploadedFile::fake()->image("sepatu$i.jpg"));
            $this->assertEquals('approved', $checkin->status);
        }

        // Day 7
        Carbon::setTestNow(Carbon::parse("2026-06-07 10:00:00"));
        $checkin7 = $this->checkinService->checkin(UploadedFile::fake()->image("sepatu7.jpg"));
        $this->assertEquals('pending', $checkin7->status);

        Carbon::setTestNow();
    }

    /**
     * Test admin rejection of Day 7 check-in marks the entire streak's check-ins as rejected.
     */
    public function test_rejection_marks_entire_streak_rejected(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        // Days 1 to 7 check-ins
        $checkins = [];
        for ($i = 1; $i <= 7; $i++) {
            Carbon::setTestNow(Carbon::parse("2026-06-0$i 10:00:00"));
            $checkins[$i] = $this->checkinService->checkin(UploadedFile::fake()->image("sepatu$i.jpg"));
        }

        $checkin7 = $checkins[7];
        $this->assertEquals('pending', $checkin7->status);

        // Admin rejects the Day 7 check-in
        $this->checkinService->reject($checkin7);

        // Assert all check-ins for this minggu_ke are now rejected
        $rejectedCount = DailyLogin::where('user_id', $user->id)
            ->where('minggu_ke', 1)
            ->where('status', 'rejected')
            ->count();

        $this->assertEquals(7, $rejectedCount);

        Carbon::setTestNow();
    }
}
