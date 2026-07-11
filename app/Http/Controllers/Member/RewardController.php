<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\CheckinService;
use App\Services\RewardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function __construct(
        protected RewardService $rewardService,
        protected CheckinService $checkinService,
    ) {}

    public function index()
    {
        $userId = Auth::id();
        $streakStatus = $this->checkinService->getStreakStatus($userId);
        
        $dailyRewards = $this->rewardService->getAvailableRewards(null, 'daily_checkin');
        $donasiRewards = $this->rewardService->getAvailableRewards(null, 'donasi');
        
        $unclaimedDonationCount = $this->rewardService->getUnclaimedDonationCount($userId);
        $claimedRewards = $this->rewardService->getUserClaims($userId);

        return view('member.rewards.index', compact('dailyRewards', 'donasiRewards', 'streakStatus', 'claimedRewards', 'unclaimedDonationCount'));
    }

    public function claim(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
            'minggu_ke' => 'required|integer|min:1',
        ]);

        try {
            $userReward = $this->rewardService->claimReward(
                $request->input('reward_id'),
                $request->input('minggu_ke'),
            );

            return redirect()->route('member.rewards.index')
                ->with('success', 'Selamat! Reward berhasil diklaim. Kode unik Anda: ' . $userReward->unique_code);
        } catch (\Exception $e) {
            return redirect()->route('member.rewards.index')
                ->with('error', $e->getMessage());
        }
    }

    public function claimDonation(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
        ]);

        try {
            $userReward = $this->rewardService->claimDonationReward($request->input('reward_id'));

            return redirect()->route('member.rewards.index')
                ->with('success', 'Klaim Reward Donasi berhasil! Kode kupon Anda: ' . $userReward->unique_code . '. Cek email Anda untuk detailnya.');
        } catch (\Exception $e) {
            return redirect()->route('member.rewards.index')
                ->with('error', $e->getMessage());
        }
    }
}
