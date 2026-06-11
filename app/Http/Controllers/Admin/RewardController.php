<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Services\RewardService;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function __construct(
        protected RewardService $rewardService,
    ) {}

    public function index()
    {
        $rewards = $this->rewardService->getAllRewardsForAdmin();
        return view('admin.rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_reward' => 'required|string|max:150',
            'jenis' => 'required|in:voucher,diskon,konsultasi,lainnya',
            'deskripsi' => 'required|string|max:2000',
            'kode_kupon' => 'nullable|string|max:50',
            'nilai' => 'nullable|string|max:50',
            'status_aktif' => 'boolean',
            'minggu_ke' => 'required|integer|min:1',
            'berlaku_dari' => 'nullable|date',
            'berlaku_sampai' => 'nullable|date|after_or_equal:berlaku_dari',
            'stok' => 'nullable|integer|min:0',
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif', true);

        $this->rewardService->createReward($validated);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward berhasil ditambahkan.');
    }

    public function edit(Reward $reward)
    {
        return view('admin.rewards.edit', compact('reward'));
    }

    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'nama_reward' => 'required|string|max:150',
            'jenis' => 'required|in:voucher,diskon,konsultasi,lainnya',
            'deskripsi' => 'required|string|max:2000',
            'kode_kupon' => 'nullable|string|max:50',
            'nilai' => 'nullable|string|max:50',
            'status_aktif' => 'boolean',
            'minggu_ke' => 'required|integer|min:1',
            'berlaku_dari' => 'nullable|date',
            'berlaku_sampai' => 'nullable|date|after_or_equal:berlaku_dari',
            'stok' => 'nullable|integer|min:0',
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif', true);

        $this->rewardService->updateReward($reward, $validated);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward berhasil diperbarui.');
    }

    public function destroy(Reward $reward)
    {
        $this->rewardService->deleteReward($reward);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward berhasil dihapus.');
    }
}
