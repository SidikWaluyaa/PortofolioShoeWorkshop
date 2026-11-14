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

        // A donation filled in as a guest on /adapt-adopt/donasi belongs to the account once the donor signs in or registers
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            if ($event->user instanceof \App\Models\User) {
                \App\Models\DonationDraft::claimFromSession($event->user);
            }
        });

        // Dates shown to users ("3 bulan yang lalu", "Sabtu, 31 Oktober") are always Indonesian,
        // whatever APP_LOCALE the server has
        \Carbon\Carbon::setLocale('id');

        if (env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share setting variables globally to all views. The composer runs once per rendered view (the home page
        // renders ~30 partials), so the table check and the query happen only once per request.
        view()->composer('*', function ($view) {
            static $globalSettings = null;
            if ($globalSettings === null) {
                try {
                    $globalSettings = Schema::hasTable('settings')
                        ? \App\Models\Setting::pluck('value', 'key')->toArray()
                        : [];
                } catch (\Exception $e) {
                    $globalSettings = [];
                }
            }
            $view->with('globalSettings', $globalSettings);
        });

        // Customizing Auth Emails
        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()]);
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Reset password akunmu - Shoe Workshop')
                ->view('emails.auth.reset_password', ['url' => $url, 'notifiable' => $notifiable]);
        });

        \Illuminate\Auth\Notifications\VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Verifikasi alamat emailmu - Shoe Workshop')
                ->view('emails.auth.verify_email', ['url' => $url, 'notifiable' => $notifiable]);
        });
    }
}
