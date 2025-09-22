<?php

namespace App\Providers;

use App\Models\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
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
        //
        Paginator::useBootstrap();
        $mailSettings = Mail::first();

        if ($mailSettings) {
            Config::set('mail.mailers.smtp.transport', $mailSettings->MAIL_MAILER ?? 'smtp');
            Config::set('mail.mailers.smtp.host', $mailSettings->MAIL_HOST ?? '127.0.0.1');
            Config::set('mail.mailers.smtp.port', $mailSettings->MAIL_PORT ?? 1025);
            Config::set('mail.mailers.smtp.username', $mailSettings->MAIL_USERNAME ?? null);
            Config::set('mail.mailers.smtp.password', $mailSettings->MAIL_PASSWORD ?? null);
            Config::set('mail.mailers.smtp.encryption', $mailSettings->MAIL_ENCRYPTION ?? null);
            Config::set('mail.from.address', $mailSettings->MAIL_FROM_ADDRESS ?? 'noreply@example.com');
            Config::set('mail.from.name', $mailSettings->MAIL_FROM_NAME ?? 'Laravel');
        }
    }
}
