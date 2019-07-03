<?php

namespace App\Providers;

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
        $this->app->bind('App\Http\Model\User\UserInterface', 'App\Http\Model\User\UserRepository');
        $this->app->bind('App\Http\Model\Supplier\SupplierInterface', 'App\Http\Model\Supplier\SupplierApiRepository');
        //$this->app->bind('App\Http\Model\Supplier\SupplierInterface', 'App\Http\Model\Supplier\SupplierGraphRepository');
        $this->app->bind('App\Http\Model\VerifySupplier\VerifySupplierInterface', 'App\Http\Model\VerifySupplier\VerifySupplierApiRepository');
        $this->app->bind('App\Http\Model\Company\CompanyInterface', 'App\Http\Model\Company\CompanyRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
