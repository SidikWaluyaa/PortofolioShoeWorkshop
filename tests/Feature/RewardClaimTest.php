<?php

namespace Tests\Feature;

use App\Models\DailyLogin;
use App\Models\Reward;
use App\Models\User;
use App\Models\UserReward;
use App\Services\RewardService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RewardClaimTest extends TestCase
{
    use RefreshDatabase;

    protected RewardService $rewardService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rewardService = $this->app->make(RewardService::class);
    }

    /**
     * Test successful claim when a user completes a 7-day approved check-in streak.
     */
    public function test_claim_reward_successfully(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        // Create a reward for week 1
        $reward = Reward::create([
            'nama_reward' => 'Voucher Diskon 50%',
            'deskripsi' => 'Diskon 50% untuk servis Deep Clean',
            'minggu_ke' => 1,
            'stok' => 5,
            'status_aktif' => true,
            'created_by' => $user->id,
        ]);

        // Seed 7 approved check-ins for week 1
        for ($i = 1; $i <= 7; $i++) {
            DailyLogin::create([
                'user_id' => $user->id,
                'tanggal_checkin' => Carbon::parse("2026-06-0$i")->toDateString(),
                'foto_sepatu_path' => "checkins/foto$i.jpg",
                'minggu_ke' => 1,
                'hari_ke' => $i,
                'status' => 'approved',
                'reward_claimed' => false,
            ]);
        }

        // Claim reward
        $userReward = $this->rewardService->claimReward($reward->id, 1);

        $this->assertNotNull($userReward);
        $this->assertDatabaseHas('user_rewards', [
            'user_id' => $user->id,
            'reward_id' => $reward->id,
            'minggu_ke' => 1,
            'unique_code' => $userReward->unique_code,
        ]);

        // Assert stock decreased to 4
        $this->assertEquals(4, $reward->fresh()->stok);

        // Assert check-ins are marked as claimed
        $claimedCount = DailyLogin::where('user_id', $user->id)
            ->where('minggu_ke', 1)
            ->where('reward_claimed', true)
            ->count();
        $this->assertEquals(7, $claimedCount);
    }

    /**
     * Test user cannot claim twice for the same week.
     */
    public function test_cannot_claim_twice_same_week(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $reward = Reward::create([
            'nama_reward' => 'Voucher Diskon 50%',
            'deskripsi' => 'Diskon 50% untuk servis Deep Clean',
            'minggu_ke' => 1,
            'stok' => 5,
            'status_aktif' => true,
            'created_by' => $user->id,
        ]);

        for ($i = 1; $i <= 7; $i++) {
            DailyLogin::create([
                'user_id' => $user->id,
                'tanggal_checkin' => Carbon::parse("2026-06-0$i")->toDateString(),
                'foto_sepatu_path' => "checkins/foto$i.jpg",
                'minggu_ke' => 1,
                'hari_ke' => $i,
                'status' => 'approved',
                'reward_claimed' => false,
            ]);
        }

        // First claim
        $this->rewardService->claimReward($reward->id, 1);

        // Second claim should fail
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Anda sudah mengklaim reward ini untuk minggu ini.');
        
        $this->rewardService->claimReward($reward->id, 1);
    }

    /**
     * Test user cannot claim if they don't have 7 approved check-ins.
     */
    public function test_cannot_claim_if_streak_not_fully_approved(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $reward = Reward::create([
            'nama_reward' => 'Voucher Diskon 50%',
            'deskripsi' => 'Diskon 50%',
            'minggu_ke' => 1,
            'stok' => 5,
            'status_aktif' => true,
            'created_by' => $user->id,
        ]);

        // Seed 6 approved, 1 pending check-ins
        for ($i = 1; $i <= 6; $i++) {
            DailyLogin::create([
                'user_id' => $user->id,
                'tanggal_checkin' => Carbon::parse("2026-06-0$i")->toDateString(),
                'foto_sepatu_path' => "checkins/foto$i.jpg",
                'minggu_ke' => 1,
                'hari_ke' => $i,
                'status' => 'approved',
                'reward_claimed' => false,
            ]);
        }
        DailyLogin::create([
            'user_id' => $user->id,
            'tanggal_checkin' => '2026-06-07',
            'foto_sepatu_path' => 'checkins/foto7.jpg',
            'minggu_ke' => 1,
            'hari_ke' => 7,
            'status' => 'pending', // Pending, not approved
            'reward_claimed' => false,
        ]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Anda belum menyelesaikan streak 7 hari check-in yang disetujui untuk minggu ini.');

        $this->rewardService->claimReward($reward->id, 1);
    }

    /**
     * Test user cannot claim if reward is out of stock.
     */
    public function test_cannot_claim_if_out_of_stock(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $reward = Reward::create([
            'nama_reward' => 'Voucher Diskon 50%',
            'deskripsi' => 'Diskon 50%',
            'minggu_ke' => 1,
            'stok' => 0, // Out of stock
            'status_aktif' => true,
            'created_by' => $user->id,
        ]);

        for ($i = 1; $i <= 7; $i++) {
            DailyLogin::create([
                'user_id' => $user->id,
                'tanggal_checkin' => Carbon::parse("2026-06-0$i")->toDateString(),
                'foto_sepatu_path' => "checkins/foto$i.jpg",
                'minggu_ke' => 1,
                'hari_ke' => $i,
                'status' => 'approved',
                'reward_claimed' => false,
            ]);
        }

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Reward ini tidak tersedia untuk diklaim saat ini.');

        $this->rewardService->claimReward($reward->id, 1);
    }
}
