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

        if (env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

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

        // Customizing Auth Emails
        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()]);
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Reset Password Anda - Shoe Workshop')
                ->view('emails.auth.reset_password', ['url' => $url, 'notifiable' => $notifiable]);
        });

        \Illuminate\Auth\Notifications\VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Verifikasi Alamat Email Anda - Shoe Workshop')
                ->view('emails.auth.verify_email', ['url' => $url, 'notifiable' => $notifiable]);
        });
    }
}
