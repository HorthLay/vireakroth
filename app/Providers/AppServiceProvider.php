<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->view('auth.verify-email', [
                    'user' => $notifiable,
                    'url' => $url
                ]);
        });
        Paginator::useBootstrap();
        app()->setLocale(session('locale', config('app.locale')));
        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }
    }
}
