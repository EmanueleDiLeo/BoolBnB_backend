<?php

namespace App\Providers;
use Braintree\Gateway;

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
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway([
                'environment'=>'sandbox',
                'merchantId'=>'qbt7zts4952sjd6f',
                'publicKey'=>'zszgrhvk65fctbmw',
                'privateKey'=>'ba35db728c13b54472099df37b1bda5d'
            ]
            );
        });
    }
}
