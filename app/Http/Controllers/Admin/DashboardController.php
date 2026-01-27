<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Project;
use App\Models\Service;
use App\Models\TrustItem;
use App\Models\Workflow;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'trust_items' => TrustItem::count(),
            'workflows' => Workflow::count(),
            'posts' => \App\Models\Post::count(),
            'hero_active' => HeroSection::where('is_active', true)->exists(),
        ];

        return view('dashboard', compact('stats'));
    }
}
