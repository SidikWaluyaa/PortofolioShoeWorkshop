<?php

namespace App\Http\Controllers;

use App\Services\AboutService;
use App\Services\BlogService;
use App\Services\CtaService;
use App\Services\HeroService;
use App\Services\PortfolioService;
use App\Services\ServiceCatalogService;
use App\Services\SettingService;
use App\Services\TrustService;
use App\Services\WorkflowService;
use Illuminate\Http\Request;

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
        protected BlogService $blogService
    ) {}

    public function index()
    {
        $data = [
            'hero' => $this->heroService->getActive(),
            'trustItems' => $this->trustService->getActive(),
            'services' => $this->serviceCatalogService->getActive(),
            'portfolio' => $this->portfolioService->getActive(),
            'featuredPortfolio' => $this->portfolioService->featured(),
            'workflow' => $this->workflowService->getActive(),
            'about' => $this->aboutService->getActive(),
            'cta' => $this->ctaService->getActive(),
            'settings' => $this->settingService->all(),
            'latestPosts' => $this->blogService->getActive(3),
        ];

        return view('home', $data);
    }
}
