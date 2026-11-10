<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\CheckinService;
use App\Support\MemberFeatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function __construct(
        protected CheckinService $checkinService,
    ) {}

    public function index()
    {
        $enabled = MemberFeatures::checkinEnabled();
        $streakStatus = $enabled ? $this->checkinService->getStreakStatus(Auth::id()) : null;
        $calendarData = $enabled ? $this->checkinService->getMonthlyCalendarData(Auth::id()) : null;

        return view('member.checkin.index', compact('enabled', 'streakStatus', 'calendarData'));
    }

    public function store(Request $request)
    {
        if (!MemberFeatures::checkinEnabled()) {
            return redirect()->route('member.checkin.index')
                ->with('error', 'Daily Check-In belum dibuka.');
        }

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
