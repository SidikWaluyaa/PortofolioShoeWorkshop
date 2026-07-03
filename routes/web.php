<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\WarrantyClaimController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/klaim-garansi', [WarrantyClaimController::class, 'index'])->name('warranty.index');
Route::post('/klaim-garansi/api/check', [WarrantyClaimController::class, 'check']);
Route::post('/klaim-garansi/api/submit', [WarrantyClaimController::class, 'submit']);
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::get('/donasi-katalog', [\App\Http\Controllers\DonationCatalogController::class, 'index'])->name('katalog.index');
Route::get('/donasi-katalog/filter', [\App\Http\Controllers\DonationCatalogController::class, 'filter'])->name('katalog.filter');
Route::get('/donasi-katalog/{item}', [\App\Http\Controllers\DonationCatalogController::class, 'show'])->name('katalog.show');
Route::get('/donasi-katalog/{item}/ajukan', [\App\Http\Controllers\DonationCatalogController::class, 'requestForm'])->name('katalog.request.form');
Route::get('/donasi-katalog/{item}/sukses/{requestId}', [\App\Http\Controllers\DonationCatalogController::class, 'requestSuccess'])->name('katalog.success');
Route::post('/donasi-katalog/{item}/request', [\App\Http\Controllers\DonationCatalogController::class, 'requestItem'])->name('katalog.request');
Route::get('/campaigns/{campaign}/click', [\App\Http\Controllers\CampaignClickController::class, 'trackClick'])->name('campaigns.click');

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user instanceof \App\Models\User && $user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('donatur.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ──────────────────────────────────────────────────────────
// Donatur Routes (authenticated users with role = 'user')
// ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->prefix('donatur')->name('donatur.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Donatur\DashboardController::class, 'index'])->name('dashboard');
    
    // Catalog
    Route::get('/katalog', [\App\Http\Controllers\Donatur\DonationCatalogController::class, 'index'])->name('katalog.index');
    Route::get('/katalog/filter', [\App\Http\Controllers\Donatur\DonationCatalogController::class, 'filter'])->name('katalog.filter');
    Route::post('/katalog/{item}/request', [\App\Http\Controllers\Donatur\DonationCatalogController::class, 'requestItem'])->name('katalog.request');

    // Donations
    Route::get('/donations', [\App\Http\Controllers\Donatur\DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [\App\Http\Controllers\Donatur\DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [\App\Http\Controllers\Donatur\DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}/edit', [\App\Http\Controllers\Donatur\DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{donation}', [\App\Http\Controllers\Donatur\DonationController::class, 'update'])->name('donations.update');
    Route::patch('/donations/{donation}/resi', [\App\Http\Controllers\Donatur\DonationController::class, 'updateResi'])->name('donations.update-resi');

    // Daily Check-In
    Route::get('/checkin', [\App\Http\Controllers\Donatur\CheckinController::class, 'index'])->name('checkin.index');
    Route::post('/checkin', [\App\Http\Controllers\Donatur\CheckinController::class, 'store'])->name('checkin.store');

    // Rewards
    Route::get('/rewards', [\App\Http\Controllers\Donatur\RewardController::class, 'index'])->name('rewards.index');
    Route::post('/rewards/claim', [\App\Http\Controllers\Donatur\RewardController::class, 'claim'])->name('rewards.claim');

    // Reparation History
    Route::get('/reparation-history', [\App\Http\Controllers\Donatur\ReparationHistoryController::class, 'index'])->name('reparation-history.index');
});

// ──────────────────────────────────────────────────────────
// Admin Routes (authenticated users with role = 'admin')
// ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero', \App\Http\Controllers\Admin\HeroController::class);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('trust', \App\Http\Controllers\Admin\TrustController::class);
    Route::resource('workflow', \App\Http\Controllers\Admin\WorkflowController::class);
    Route::resource('about', \App\Http\Controllers\Admin\AboutController::class);
    Route::resource('cta', \App\Http\Controllers\Admin\CtaController::class)->parameters(['cta' => 'cta']);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class);

    Route::get('tracking', [\App\Http\Controllers\Admin\TrackingController::class, 'index'])->name('tracking.index');
    Route::post('tracking/save', [\App\Http\Controllers\Admin\TrackingController::class, 'save'])->name('tracking.save');

    Route::get('warranty-claims', [\App\Http\Controllers\Admin\WarrantyClaimController::class, 'index'])->name('warranty-claims.index');

    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Donations Moderation
    Route::get('donations', [\App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.index');
    Route::get('donations/{donation}', [\App\Http\Controllers\Admin\DonationController::class, 'show'])->name('donations.show');
    Route::post('donations/{donation}/approve', [\App\Http\Controllers\Admin\DonationController::class, 'approve'])->name('donations.approve');
    Route::post('donations/{donation}/reject', [\App\Http\Controllers\Admin\DonationController::class, 'reject'])->name('donations.reject');
    Route::post('donations/{donation}/distribute', [\App\Http\Controllers\Admin\DonationController::class, 'distribute'])->name('donations.distribute');

    // Check-In Verification
    Route::get('checkins', [\App\Http\Controllers\Admin\CheckinController::class, 'index'])->name('checkins.index');
    Route::post('checkins/{checkin}/approve', [\App\Http\Controllers\Admin\CheckinController::class, 'approve'])->name('checkins.approve');
    Route::post('checkins/{checkin}/reject', [\App\Http\Controllers\Admin\CheckinController::class, 'reject'])->name('checkins.reject');

    // Rewards Management
    Route::resource('rewards', \App\Http\Controllers\Admin\RewardController::class);

    // Catalog Items & Requests Management
    Route::get('donation-items/export-excel', [\App\Http\Controllers\Admin\DonationItemController::class, 'exportExcel'])->name('donation-items.export-excel');
    Route::get('donation-items/export-pdf', [\App\Http\Controllers\Admin\DonationItemController::class, 'exportPdf'])->name('donation-items.export-pdf');
    Route::resource('donation-items', \App\Http\Controllers\Admin\DonationItemController::class);
    Route::resource('donation-requests', \App\Http\Controllers\Admin\DonationRequestController::class)->only(['index', 'update', 'destroy']);
    Route::post('donation-requests/{donationRequest}/send-rejection-email', [\App\Http\Controllers\Admin\DonationRequestController::class, 'sendRejectionEmail'])->name('donation-requests.send-rejection-email');
    Route::post('donation-requests/{donationRequest}/send-approval-email', [\App\Http\Controllers\Admin\DonationRequestController::class, 'sendApprovalEmail'])->name('donation-requests.send-approval-email');
    Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';