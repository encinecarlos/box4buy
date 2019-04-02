<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class CotacaoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('getDolar', function ($app) {
        //     return new Lib\CotacaoDolar();
        // });
        App::bind('CotacaoDolar', function () {
            return new App\Lib\CotacaoDolar;
        });
    }
}
