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

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
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
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';