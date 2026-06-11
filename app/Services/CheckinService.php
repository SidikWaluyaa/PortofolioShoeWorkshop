<?php

namespace App\Services;

use App\Helpers\ImageCompressionHelper;
use App\Models\DailyLogin;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class CheckinService
{
    /**
     * Perform a daily check-in for the authenticated user.
     *
     * Rolling 7-day consecutive streak model:
     * - User can start on any day
     * - If they miss a day, streak resets to hari_ke=1
     * - minggu_ke increments each time a full 7-day streak is completed
     */
    public function checkin(UploadedFile $foto): DailyLogin
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Check if already checked in today
        $existingCheckin = DailyLogin::where('user_id', $user->id)
            ->whereDate('tanggal_checkin', $today)
            ->first();

        if ($existingCheckin) {
            throw new \Exception('Anda sudah melakukan check-in hari ini.');
        }

        // Get the last check-in for this user (that hasn't been part of a completed+claimed cycle)
        $lastCheckin = DailyLogin::where('user_id', $user->id)
            ->orderByDesc('tanggal_checkin')
            ->first();

        $mingguKe = 1;
        $hariKe = 1;

        if ($lastCheckin) {
            $lastDate = Carbon::parse($lastCheckin->tanggal_checkin);
            $daysDiff = $lastDate->diffInDays($today);

            if ((int)$daysDiff === 1) {
                // Consecutive day — continue the streak
                if ($lastCheckin->hari_ke >= 7) {
                    // Previous streak was complete, start a new cycle
                    $mingguKe = $lastCheckin->minggu_ke + 1;
                    $hariKe = 1;
                } else {
                    // Continue current streak
                    $mingguKe = $lastCheckin->minggu_ke;
                    $hariKe = $lastCheckin->hari_ke + 1;
                }
            } else {
                // Streak broken (missed a day or more) — reset
                // If previous cycle was completed and claimed, start new minggu_ke
                if ($lastCheckin->hari_ke >= 7 && $lastCheckin->reward_claimed) {
                    $mingguKe = $lastCheckin->minggu_ke + 1;
                } else {
                    // Restart same minggu_ke since it wasn't completed
                    $mingguKe = $lastCheckin->minggu_ke;
                }
                $hariKe = 1;
            }
        }

        // Compress and store photo
        $fotoPath = ImageCompressionHelper::compressAndStore($foto, 'checkins');

        return DailyLogin::create([
            'user_id' => $user->id,
            'tanggal_checkin' => $today->toDateString(),
            'foto_sepatu_path' => $fotoPath,
            'minggu_ke' => $mingguKe,
            'hari_ke' => $hariKe,
            'status' => $hariKe === 7 ? 'pending' : 'approved',
            'reward_claimed' => false,
        ]);
    }

    /**
     * Get the current streak status for a user.
     *
     * @return array{minggu_ke: int, hari_ke: int, streak_complete: bool, checkins: \Illuminate\Database\Eloquent\Collection}
     */
    public function getStreakStatus(int $userId): array
    {
        $lastCheckin = DailyLogin::where('user_id', $userId)
            ->orderByDesc('tanggal_checkin')
            ->first();

        if (!$lastCheckin) {
            return [
                'minggu_ke' => 1,
                'hari_ke' => 0,
                'streak_complete' => false,
                'can_claim' => false,
                'checkins' => collect(),
                'already_checked_in_today' => false,
            ];
        }

        $currentMingguKe = $lastCheckin->minggu_ke;

        // Check if streak is still active (last check-in was yesterday or today)
        $lastDate = Carbon::parse($lastCheckin->tanggal_checkin);
        $daysSinceLast = $lastDate->diffInDays(Carbon::today());

        if ($daysSinceLast > 1) {
            // Streak is broken — but show where they were
            $currentMingguKe = $lastCheckin->minggu_ke;
        }

        // Get all check-ins for the current minggu_ke
        $checkins = DailyLogin::where('user_id', $userId)
            ->where('minggu_ke', $currentMingguKe)
            ->orderBy('hari_ke')
            ->get();

        // Streak is complete if there are 7 approved check-ins
        $approvedCount = $checkins->where('status', 'approved')->count();
        $streakComplete = $approvedCount >= 7;

        // Can claim if streak complete and not yet claimed
        $canClaim = $streakComplete && !$checkins->contains('reward_claimed', true);

        $alreadyCheckedInToday = DailyLogin::where('user_id', $userId)
            ->whereDate('tanggal_checkin', Carbon::today())
            ->exists();

        return [
            'minggu_ke' => $currentMingguKe,
            'hari_ke' => $daysSinceLast <= 1 ? $lastCheckin->hari_ke : 0,
            'streak_complete' => $streakComplete,
            'can_claim' => $canClaim,
            'checkins' => $checkins,
            'already_checked_in_today' => $alreadyCheckedInToday,
        ];
    }

    /**
     * Admin: approve a check-in entry.
     */
    public function approve(DailyLogin $checkin): DailyLogin
    {
        $checkin->update(['status' => 'approved']);
        return $checkin;
    }

    public function reject(DailyLogin $checkin): DailyLogin
    {
        $checkin->update(['status' => 'rejected']);

        // Also reject all other check-ins in the same cycle
        DailyLogin::where('user_id', $checkin->user_id)
            ->where('minggu_ke', $checkin->minggu_ke)
            ->update(['status' => 'rejected']);

        return $checkin;
    }

    /**
     * Get all pending check-ins for admin verification.
     */
    public function getPendingCheckins(int $perPage = 20)
    {
        return DailyLogin::with('user')
            ->where('hari_ke', 7)
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    /**
     * Get all check-ins for admin with optional status and day filter.
     */
    public function getAllCheckins(int $perPage = 20, ?string $statusFilter = null, ?string $hariFilter = null)
    {
        $query = DailyLogin::with('user')
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        if ($hariFilter && $hariFilter !== 'all') {
            $query->where('hari_ke', (int)$hariFilter);
        }

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        return $query->paginate($perPage);
    }
}
