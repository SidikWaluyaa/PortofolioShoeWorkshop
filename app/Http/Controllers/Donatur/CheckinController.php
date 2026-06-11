<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Services\CheckinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function __construct(
        protected CheckinService $checkinService,
    ) {}

    public function index()
    {
        $streakStatus = $this->checkinService->getStreakStatus(Auth::id());
        return view('donatur.checkin.index', compact('streakStatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_sepatu' => 'required|image',
        ]);

        try {
            $this->checkinService->checkin($request->file('foto_sepatu'));
            return redirect()->route('donatur.checkin.index')
                ->with('success', 'Check-in berhasil! Foto Anda sedang menunggu verifikasi admin.');
        } catch (\Exception $e) {
            return redirect()->route('donatur.checkin.index')
                ->with('error', $e->getMessage());
        }
    }
}
