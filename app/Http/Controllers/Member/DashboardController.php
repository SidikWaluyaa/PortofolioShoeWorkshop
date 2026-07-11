<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\CheckinService;
use App\Services\DonationService;
use App\Services\RewardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected DonationService $donationService,
        protected CheckinService $checkinService,
        protected RewardService $rewardService,
    ) {}

    public function index()
    {
        $user = Auth::user();

        $donations = $this->donationService->getByUser($user->id, 5);
        $streakStatus = $this->checkinService->getStreakStatus($user->id);
        $claimedRewards = $this->rewardService->getUserClaims($user->id);

        $totalDonations = $user->donations()->count();
        $acceptedDonations = $user->donations()->where('status', 'diterima')->count();
        $distributedDonations = $user->donations()->where('status', 'disalurkan')->count();

        return view('member.dashboard', compact(
            'donations',
            'streakStatus',
            'claimedRewards',
            'totalDonations',
            'acceptedDonations',
            'distributedDonations',
        ));
    }
}
