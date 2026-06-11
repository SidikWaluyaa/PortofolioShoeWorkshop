<?php

namespace App\Services;

use App\Models\DailyLogin;
use App\Models\Reward;
use App\Models\UserReward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RewardService
{
    /**
     * Get available rewards for a specific minggu_ke.
     */
    public function getAvailableRewards(?int $mingguKe = null)
    {
        $query = Reward::where('status_aktif', true)
            ->where(function ($q) {
                $q->whereNull('stok')->orWhere('stok', '>', 0);
            })
            ->where(function ($q) {
                $today = now()->toDateString();
                $q->where(function ($sub) use ($today) {
                    $sub->whereNull('berlaku_dari')->orWhere('berlaku_dari', '<=', $today);
                })->where(function ($sub) use ($today) {
                    $sub->whereNull('berlaku_sampai')->orWhere('berlaku_sampai', '>=', $today);
                });
            });

        if ($mingguKe !== null) {
            $query->where('minggu_ke', $mingguKe);
        }

        return $query->orderBy('minggu_ke')->get();
    }

    /**
     * Claim a reward for the authenticated user.
     *
     * Uses database transaction with pessimistic locking to prevent race conditions.
     *
     * @throws \Exception
     */
    public function claimReward(int $rewardId, int $mingguKe): UserReward
    {
        $user = Auth::user();

        return DB::transaction(function () use ($user, $rewardId, $mingguKe) {
            // Lock the reward row for update to prevent race conditions
            $reward = Reward::where('id', $rewardId)->lockForUpdate()->first();

            if (!$reward) {
                throw new \Exception('Reward tidak ditemukan.');
            }

            if (!$reward->isClaimable()) {
                throw new \Exception('Reward ini tidak tersedia untuk diklaim saat ini.');
            }

            if ($reward->minggu_ke !== $mingguKe) {
                throw new \Exception('Reward ini tidak sesuai dengan minggu streak Anda.');
            }

            // Verify user has completed a 7-day approved streak for this minggu_ke
            $approvedCount = DailyLogin::where('user_id', $user->id)
                ->where('minggu_ke', $mingguKe)
                ->where('status', 'approved')
                ->count();

            if ($approvedCount < 7) {
                throw new \Exception('Anda belum menyelesaikan streak 7 hari check-in yang disetujui untuk minggu ini.');
            }

            // Check if already claimed this reward for this minggu_ke
            $existing = UserReward::where('user_id', $user->id)
                ->where('reward_id', $rewardId)
                ->where('minggu_ke', $mingguKe)
                ->exists();

            if ($existing) {
                throw new \Exception('Anda sudah mengklaim reward ini untuk minggu ini.');
            }

            // Generate unique code
            $uniqueCode = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));

            // Decrease stock if applicable
            if ($reward->stok !== null) {
                $reward->decrement('stok');
            }

            // Create the claim
            $userReward = UserReward::create([
                'user_id' => $user->id,
                'reward_id' => $rewardId,
                'minggu_ke' => $mingguKe,
                'unique_code' => $uniqueCode,
                'claimed_at' => now(),
            ]);

            // Mark the daily check-ins as reward_claimed
            DailyLogin::where('user_id', $user->id)
                ->where('minggu_ke', $mingguKe)
                ->update(['reward_claimed' => true]);

            return $userReward;
        });
    }

    /**
     * Get all claimed rewards for a user.
     */
    public function getUserClaims(int $userId)
    {
        return UserReward::with('reward')
            ->where('user_id', $userId)
            ->orderByDesc('claimed_at')
            ->get();
    }

    /**
     * Admin: Get all rewards with claim counts.
     */
    public function getAllRewardsForAdmin(int $perPage = 15)
    {
        return Reward::withCount('userRewards')
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    /**
     * Admin: Create a new reward.
     */
    public function createReward(array $data): Reward
    {
        $data['created_by'] = Auth::id();
        return Reward::create($data);
    }

    /**
     * Admin: Update an existing reward.
     */
    public function updateReward(Reward $reward, array $data): Reward
    {
        $reward->update($data);
        return $reward;
    }

    /**
     * Admin: Delete a reward.
     */
    public function deleteReward(Reward $reward): bool
    {
        return $reward->delete();
    }
}
