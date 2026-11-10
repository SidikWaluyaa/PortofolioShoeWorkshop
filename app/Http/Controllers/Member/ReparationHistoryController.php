<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\ReparationHistoryService;
use Illuminate\Support\Facades\Auth;

class ReparationHistoryController extends Controller
{
    public function index(ReparationHistoryService $reparations)
    {
        return view('member.reparation_history.index', $reparations->forUser(Auth::user()));
    }
}
