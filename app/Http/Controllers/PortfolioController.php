<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\PortfolioService;

class PortfolioController extends Controller
{
    public function __construct(protected PortfolioService $portfolioService) {}

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $projects = $this->portfolioService->getActive();

        return view('portfolio', compact('settings', 'projects'));
    }
}