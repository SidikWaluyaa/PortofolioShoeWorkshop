<?php

namespace App\Http\Controllers\Member;

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
        $calendarData = $this->checkinService->getMonthlyCalendarData(Auth::id());
        
        return view('member.checkin.index', compact('streakStatus', 'calendarData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_sepatu' => 'required|image',
        ]);

        try {
            $this->checkinService->checkin($request->file('foto_sepatu'));
            return redirect()->route('member.checkin.index')
                ->with('success', 'Check-in berhasil! Foto Anda sedang menunggu verifikasi admin.');
        } catch (\Exception $e) {
            return redirect()->route('member.checkin.index')
                ->with('error', $e->getMessage());
        }
    }
}
