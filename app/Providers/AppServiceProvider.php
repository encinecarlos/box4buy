<?php

namespace App\Providers;

use App\Configuration;
use App\Lib\Utils;
use App\Services\AlertService;
use App\Services\Contracts\ServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('configurations', Configuration::all());
        View::share('countries', Utils::getCountries());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ServiceInterface::class, AlertService::class);
    }
}
