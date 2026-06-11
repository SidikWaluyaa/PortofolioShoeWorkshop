<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\WarrantyClaimController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/klaim-garansi', [WarrantyClaimController::class, 'index'])->name('warranty.index');
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('donatur.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ──────────────────────────────────────────────────────────
// Donatur Routes (authenticated users with role = 'user')
// ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->prefix('donatur')->name('donatur.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Donatur\DashboardController::class, 'index'])->name('dashboard');

    // Donations
    Route::get('/donations', [\App\Http\Controllers\Donatur\DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [\App\Http\Controllers\Donatur\DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [\App\Http\Controllers\Donatur\DonationController::class, 'store'])->name('donations.store');
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
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';