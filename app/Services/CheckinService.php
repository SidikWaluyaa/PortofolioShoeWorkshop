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

        // 1. Prevent if already checked in today
        $existingCheckin = DailyLogin::where('user_id', $user->id)
            ->whereDate('tanggal_checkin', $today)
            ->first();

        if ($existingCheckin) {
            throw new \Exception('Anda sudah melakukan check-in hari ini.');
        }

        // 2. Prevent if there is a pending checkin
        $pendingCheckin = DailyLogin::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingCheckin) {
            throw new \Exception('Harap tunggu admin memverifikasi check-in Hari ke-7 Anda sebelum melanjutkan.');
        }

        // 3. Determine minggu_ke and hari_ke
        $lastCheckin = DailyLogin::where('user_id', $user->id)
            ->where('status', '!=', 'failed')
            ->orderByDesc('tanggal_checkin')
            ->first();

        $mingguKe = 1;
        $hariKe = 1;

        if ($lastCheckin) {
            $lastDate = Carbon::parse($lastCheckin->tanggal_checkin);
            $daysDiff = $lastDate->diffInDays($today);

            $isCompletedWeek = ($lastCheckin->hari_ke >= 7 && $lastCheckin->status === 'approved');

            if ($lastCheckin->status === 'rejected') {
                // Streak was broken by admin rejection. Restart same week.
                $mingguKe = $lastCheckin->minggu_ke;
                $hariKe = 1;
                $this->markAsFailed($user->id, $mingguKe);
                
            } elseif ($isCompletedWeek) {
                // Previous week was successfully completed. Start next week.
                $mingguKe = $lastCheckin->minggu_ke + 1;
                $hariKe = 1;
                
            } elseif ((int)$daysDiff === 1) {
                // Still in an active streak (consecutive day)
                $mingguKe = $lastCheckin->minggu_ke;
                $hariKe = $lastCheckin->hari_ke + 1;
                
            } else {
                // Streak broken due to missed days. Restart same week.
                $mingguKe = $lastCheckin->minggu_ke;
                $hariKe = 1;
                $this->markAsFailed($user->id, $mingguKe);
            }
        }

        // Compress and store photo
        $fotoPath = ImageCompressionHelper::compressAndStore($foto, 'checkins');

        $dailyLogin = DailyLogin::create([
            'user_id' => $user->id,
            'tanggal_checkin' => $today->toDateString(),
            'foto_sepatu_path' => $fotoPath,
            'minggu_ke' => $mingguKe,
            'hari_ke' => $hariKe,
            'status' => $hariKe === 7 ? 'pending' : 'approved',
            'reward_claimed' => false,
        ]);
        
        if ($hariKe === 7) {
            $admins = \App\Models\User::where('role', 'admin')->get();
            if ($admins->isNotEmpty()) {
                \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\SystemNotification(
                    'Verifikasi Check-in',
                    $user->name . ' telah menyelesaikan check-in hari ke-7 (Minggu ke-' . $mingguKe . '). Segera verifikasi!',
                    route('admin.checkins.index'),
                    'fact_check',
                    'info'
                ));
            }
        } else {
            $user->notify(new \App\Notifications\SystemNotification(
                'Check-in Berhasil',
                "Anda telah check-in untuk hari ke-{$hariKe} di minggu ini. Semangat!",
                route('member.checkin.index'),
                'today',
                'success'
            ));
        }

        return $dailyLogin;
    }

    /**
     * Get the current streak status for a user.
     *
     * @return array{minggu_ke: int, hari_ke: int, streak_complete: bool, checkins: \Illuminate\Database\Eloquent\Collection}
     */
    public function getStreakStatus(int $userId): array
    {
        $lastCheckin = DailyLogin::where((string) 'user_id', $userId)
            ->orderByDesc((string) 'tanggal_checkin')
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
        // Deduplicate any old bad data by taking the last checkin for each hari_ke
        $checkins = DailyLogin::where('user_id', $userId)
            ->where('minggu_ke', $currentMingguKe)
            ->where('status', '!=', 'failed')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('hari_ke')
            ->map(function ($group) {
                return $group->last();
            })
            ->values();

        // Streak is complete if there are 7 approved check-ins
        $approvedCount = $checkins->where('status', 'approved')->count();
        $streakComplete = $approvedCount >= 7;

        // Can claim if streak complete and not yet claimed
        $canClaim = $streakComplete && !$checkins->contains('reward_claimed', true);

        $alreadyCheckedInToday = DailyLogin::where('user_id', $userId)
            ->whereDate('tanggal_checkin', Carbon::today())
            ->where('status', '!=', 'failed')
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
     * Get array of dates (Y-m-d) where the user checked in this month.
     * Includes all checkins (approved, pending, failed, rejected) because it serves as an attendance record.
     */
    public function getMonthlyCalendarData(int $userId): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return DailyLogin::where('user_id', $userId)
            ->whereBetween('tanggal_checkin', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->pluck('tanggal_checkin')
            ->map(function ($date) {
                return Carbon::parse($date)->toDateString();
            })
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Mark all previous check-ins for a week as failed when streak is broken.
     */
    private function markAsFailed(int $userId, int $mingguKe): void
    {
        DailyLogin::where('user_id', $userId)
            ->where('minggu_ke', $mingguKe)
            ->update(['status' => 'failed']);
    }

    /**
     * Admin: approve a check-in entry.
     */
    public function approve(DailyLogin $checkin): DailyLogin
    {
        $checkin->update(['status' => 'approved']);
        
        if ($checkin->user) {
            $checkin->user->notify(new \App\Notifications\SystemNotification(
                'Check-in Terverifikasi!',
                "Selamat! Check-in hari ke-7 Anda telah diverifikasi. Anda sekarang dapat mengklaim poin Anda.",
                route('member.checkin.index'),
                'verified',
                'success'
            ));
        }

        return $checkin;
    }

    public function reject(DailyLogin $checkin): DailyLogin
    {
        $checkin->update(['status' => 'rejected']);

        // Also reject all other check-ins in the same cycle
        DailyLogin::where('user_id', $checkin->user_id)
            ->where('minggu_ke', $checkin->minggu_ke)
            ->update(['status' => 'rejected']);
            
        if ($checkin->user) {
            $checkin->user->notify(new \App\Notifications\SystemNotification(
                'Check-in Ditolak',
                "Maaf, verifikasi foto sepatu check-in Anda ditolak oleh admin.",
                route('member.checkin.index'),
                'cancel',
                'error'
            ));
        }

        return $checkin;
    }

    /**
     * Get all pending check-ins for admin verification.
     */
    public function getPendingCheckins(int $perPage = 20)
    {
        return DailyLogin::with('user')
            ->where((string) 'hari_ke', 7)
            ->where((string) 'status', 'pending')
            ->orderByDesc((string) 'created_at')
            ->paginate($perPage);
    }

    /**
     * Get all check-ins for admin with optional status and day filter.
     */
    public function getAllCheckins(int $perPage = 20, ?string $statusFilter = null, ?string $hariFilter = null)
    {
        $query = DailyLogin::with('user')
            ->orderByDesc((string) 'created_at')
            ->orderByDesc((string) 'id');

        if ($hariFilter && $hariFilter !== 'all') {
            $query->where((string) 'hari_ke', (int)$hariFilter);
        }

        if ($statusFilter) {
            $query->where((string) 'status', $statusFilter);
        }

        return $query->paginate($perPage);
    }
}
