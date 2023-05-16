<?php

namespace App\Providers;

use App\Billing\BankPaymentGetway;
use App\Billing\CreditPaymentGetway;
use App\Billing\PaymentGetwayContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(PaymentGetwayContract::class,function($app){
            if(request()->has('credit')){
                return new CreditPaymentGetway(currency:'usd');
            }
            return new BankPaymentGetway(currency:'usd');
            
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
