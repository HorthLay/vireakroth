<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Override the Socialite Google provider with custom settings
        $this->app->extend('Laravel\Socialite\Contracts\Factory', function ($service, $app) {
            $socialite = $service;

            $socialite->extend('google', function () use ($socialite) {
                $config = config('services.google');
                return $socialite->buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $config)
                    ->setHttpClient(new Client(['verify' => false])); // Disable SSL verification here
            });

            return $socialite;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
