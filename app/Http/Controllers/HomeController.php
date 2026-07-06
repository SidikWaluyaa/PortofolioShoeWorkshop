<?php

namespace App\Http\Controllers;

use App\Services\AboutService;
use App\Services\BlogService;
use App\Services\CtaService;
use App\Services\HeroService;
use App\Services\PortfolioService;
use App\Services\ReviewService;
use App\Services\ServiceCatalogService;
use App\Services\SettingService;
use App\Services\TrustService;
use App\Services\WorkflowService;

class HomeController extends Controller
{
    public function __construct(
        protected HeroService $heroService,
        protected TrustService $trustService,
        protected ServiceCatalogService $serviceCatalogService,
        protected PortfolioService $portfolioService,
        protected WorkflowService $workflowService,
        protected AboutService $aboutService,
        protected CtaService $ctaService,
        protected SettingService $settingService,
        protected BlogService $blogService,
        protected ReviewService $reviewService,
    ) {}

    public function index()
    {
        $data = [
            'heroes'           => $this->heroService->getActiveHeroes(),
            'trustItems'       => $this->trustService->getActive(),
            'services'         => \App\Models\LayananCategory::with('services')->orderBy('order')->take(4)->get(),
            'portfolio'        => $this->portfolioService->getActive(),
            'featuredPortfolio'=> $this->portfolioService->featured(),
            'workflow'         => $this->workflowService->getActive(),
            'about'            => $this->aboutService->getActive(),
            'cta'              => $this->ctaService->getActive(),
            'settings'         => $this->settingService->all(),
            'latestPosts'      => $this->blogService->getActive(3),
            'reviews'          => $this->reviewService->getActive(),
            'donationShowcase' => \App\Models\DonationItem::with('reparationServices.service', 'donation.user')
                                    ->where('status', 'tersedia')
                                    ->latest()
                                    ->take(8)
                                    ->get(),
        ];

        return view('home', $data);
    }
}