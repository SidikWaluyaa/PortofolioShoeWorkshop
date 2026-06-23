<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Share setting variables globally to all views
        view()->composer('*', function ($view) {
            if (Schema::hasTable('settings')) {
                static $globalSettings = null;
                if ($globalSettings === null) {
                    try {
                        $globalSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
                    } catch (\Exception $e) {
                        $globalSettings = [];
                    }
                }
                $view->with('globalSettings', $globalSettings);
            }
        });
    }
}
