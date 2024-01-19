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
                'publicKey'=>'bxc6x72jq5wxyyq2',
                'privateKey'=>'ca5c675f4bc5668e2488d26ad36c1e23'
            ]
            );
        });
    }
}
