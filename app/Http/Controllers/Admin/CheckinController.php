<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyLogin;
use App\Services\CheckinService;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function __construct(
        protected CheckinService $checkinService,
    ) {}

    public function index(Request $request)
    {
        $statusFilter = $request->query('status');
        $hariFilter = $request->query('hari');
        $checkins = $this->checkinService->getAllCheckins(20, $statusFilter, $hariFilter);

        return view('admin.checkins.index', compact('checkins', 'statusFilter', 'hariFilter'));
    }

    public function approve(DailyLogin $checkin)
    {
        $this->checkinService->approve($checkin);

        return redirect()->route('admin.checkins.index')
            ->with('success', 'Check-in berhasil disetujui.');
    }

    public function reject(DailyLogin $checkin)
    {
        $this->checkinService->reject($checkin);

        return redirect()->route('admin.checkins.index')
            ->with('success', 'Check-in telah ditolak.');
    }
}
