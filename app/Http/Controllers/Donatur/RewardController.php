<?php

namespace App\Http\Controllers\Donatur;

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
        $streakStatus = $this->checkinService->getStreakStatus(Auth::id());
        $rewards = $this->rewardService->getAvailableRewards();
        $claimedRewards = $this->rewardService->getUserClaims(Auth::id());

        return view('donatur.rewards.index', compact('rewards', 'streakStatus', 'claimedRewards'));
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

            return redirect()->route('donatur.rewards.index')
                ->with('success', 'Selamat! Reward berhasil diklaim. Kode unik Anda: ' . $userReward->unique_code);
        } catch (\Exception $e) {
            return redirect()->route('donatur.rewards.index')
                ->with('error', $e->getMessage());
        }
    }
}
