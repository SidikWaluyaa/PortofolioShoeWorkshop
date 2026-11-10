<?php

namespace App\Support;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserReward;
use App\Services\RewardService;

/**
 * Member-portal features that management switches on when they are ready.
 */
class MemberFeatures
{
    /** Daily Check-In is "coming soon" until the `checkin_enabled` setting is turned on. */
    public static function checkinEnabled(): bool
    {
        return Setting::where('key', 'checkin_enabled')->value('value') === '1';
    }

    /**
     * The Rewards menu only makes sense when there is something to earn or something already earned.
     * Check-in rewards can't be earned while Daily Check-In is off, so only donation rewards count then.
     */
    public static function rewardsVisible(?User $user): bool
    {
        return self::checkinEnabled()
            || app(RewardService::class)->getAvailableRewards(null, 'donasi')->isNotEmpty()
            || ($user && UserReward::where('user_id', $user->id)->exists());
    }
}
