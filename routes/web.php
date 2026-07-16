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
Route::get('/api/debug-rewards', function() {
    $rewards = \App\Models\Reward::all();
    $data = [];
    foreach($rewards as $r) {
        $dariIsNull = is_null($r->berlaku_dari) ? 'YES' : 'NO';
        $sampaiIsNull = is_null($r->berlaku_sampai) ? 'YES' : 'NO';
        $data[] = "ID: {$r->id} | Nama: {$r->nama_reward} | StokIsNull: " . (is_null($r->stok) ? 'YES' : 'NO') . " | DariIsNull: {$dariIsNull} ({$r->berlaku_dari}) | SampaiIsNull: {$sampaiIsNull} ({$r->berlaku_sampai})";
    }
    
    $donasiRewardsCount = \App\Models\Reward::where('status_aktif', true)
        ->where(function ($q) { $q->whereNull('stok')->orWhere('stok', '>', 0); })
        ->where('kategori_reward', 'donasi')
        ->count();
        
    $today = now()->toDateString();
    $donasiRewardsCountWithDates = \App\Models\Reward::where('status_aktif', true)
        ->where(function ($q) { $q->whereNull('stok')->orWhere('stok', '>', 0); })
        ->where('kategori_reward', 'donasi')
        ->where(function ($q) use ($today) {
            $q->where(function ($sub) use ($today) {
                $sub->whereNull('berlaku_dari')->orWhere('berlaku_dari', '<=', $today);
            })->where(function ($sub) use ($today) {
                $sub->whereNull('berlaku_sampai')->orWhere('berlaku_sampai', '>=', $today);
            });
        })
        ->count();

    return [
        'rewards' => $data,
        'count1' => $donasiRewardsCount,
        'count2' => $donasiRewardsCountWithDates,
        'today' => $today
    ];
});
Route::get('/layanan', [\App\Http\Controllers\LayananController::class, 'index'])->name('layanan.index');
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/donasi-katalog/{item}/ajukan', [\App\Http\Controllers\DonationCatalogController::class, 'requestForm'])->name('katalog.request.form');
    Route::get('/donasi-katalog/{item}/sukses/{requestId}', [\App\Http\Controllers\DonationCatalogController::class, 'requestSuccess'])->name('katalog.success');
    Route::post('/donasi-katalog/{item}/request', [\App\Http\Controllers\DonationCatalogController::class, 'requestItem'])->name('katalog.request');
    
    // Notifications
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::post('/notifications/{id}/mark-read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
});
Route::get('/campaigns/{campaign}/click', [\App\Http\Controllers\CampaignClickController::class, 'trackClick'])->name('campaigns.click');

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user instanceof \App\Models\User && $user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('member.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ──────────────────────────────────────────────────────────
// Member Routes (authenticated users with role = 'member')
// ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Member\DashboardController::class, 'index'])->name('dashboard');

    // Donations
    Route::get('/donations', [\App\Http\Controllers\Member\DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [\App\Http\Controllers\Member\DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [\App\Http\Controllers\Member\DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}/edit', [\App\Http\Controllers\Member\DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{donation}', [\App\Http\Controllers\Member\DonationController::class, 'update'])->name('donations.update');
    Route::patch('/donations/{donation}/resi', [\App\Http\Controllers\Member\DonationController::class, 'updateResi'])->name('donations.update-resi');

    // Daily Check-In
    Route::get('/checkin', [\App\Http\Controllers\Member\CheckinController::class, 'index'])->name('checkin.index');
    Route::post('/checkin', [\App\Http\Controllers\Member\CheckinController::class, 'store'])->name('checkin.store');

    // Rewards
    Route::get('/rewards', [\App\Http\Controllers\Member\RewardController::class, 'index'])->name('rewards.index');
    Route::post('/rewards/claim', [\App\Http\Controllers\Member\RewardController::class, 'claim'])->name('rewards.claim');
    Route::post('/rewards/claim-donation', [\App\Http\Controllers\Member\RewardController::class, 'claimDonation'])->name('rewards.claim-donation');

    // Reparation History
    Route::get('/reparation-history', [\App\Http\Controllers\Member\ReparationHistoryController::class, 'index'])->name('reparation-history.index');

    // Adoption Requests
    Route::get('/adoption-requests', [\App\Http\Controllers\Member\AdoptionRequestController::class, 'index'])->name('adoption-requests.index');
    Route::get('/adoption-requests/{adoptionRequest}', [\App\Http\Controllers\Member\AdoptionRequestController::class, 'show'])->name('adoption-requests.show');
    Route::post('/adoption-requests/{adoptionRequest}/payment', [\App\Http\Controllers\Member\AdoptionRequestController::class, 'uploadPayment'])->name('adoption-requests.upload-payment');
    Route::post('/adoption-requests/{adoptionRequest}/complete', [\App\Http\Controllers\Member\AdoptionRequestController::class, 'complete'])->name('adoption-requests.complete');
});

// ──────────────────────────────────────────────────────────
// Admin Routes (authenticated users with role = 'admin')
// ──────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero', \App\Http\Controllers\Admin\HeroController::class);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class); // OLD SERVICES
    
    // NEW LAYANAN ROUTES
    Route::resource('layanan-categories', \App\Http\Controllers\Admin\LayananCategoryController::class)->except(['show']);
    Route::resource('layanan-categories.services', \App\Http\Controllers\Admin\LayananServiceController::class)->except(['show']);

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
    Route::post('donations/{donation}/approve', [\App\Http\Controllers\Admin\DonationController::class, 'approveSubmission'])->name('donations.approve-submission');
    Route::post('donations/{donation}/confirm-receipt', [\App\Http\Controllers\Admin\DonationController::class, 'confirmReceipt'])->name('donations.confirm-receipt');
    Route::post('donations/{donation}/reject', [\App\Http\Controllers\Admin\DonationController::class, 'reject'])->name('donations.reject');
    
    // Dapur Restorasi
    Route::get('restorations', [\App\Http\Controllers\Admin\RestorationController::class, 'index'])->name('restorations.index');
    Route::patch('restorations/{donation}/mark-ready', [\App\Http\Controllers\Admin\RestorationController::class, 'markReady'])->name('restorations.mark-ready');
    Route::patch('restorations/{donation}/mark-cataloged', [\App\Http\Controllers\Admin\RestorationController::class, 'markCataloged'])->name('restorations.mark-cataloged');
    
    // AI Description Generator
    Route::post('ai/generate-description', [\App\Http\Controllers\Admin\AiDescriptionController::class, 'generate'])->name('ai.generate-description');
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

    // Orders & Shipping (After Verification)
    Route::get('orders', [\App\Http\Controllers\Admin\OrderShippingController::class, 'index'])->name('orders.index');
    Route::post('orders/{order}/rollback', [\App\Http\Controllers\Admin\OrderShippingController::class, 'rollback'])->name('orders.rollback');
    
    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'store', 'show', 'destroy']);
    Route::patch('users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';