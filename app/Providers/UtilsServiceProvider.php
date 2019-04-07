<?php

namespace App\Providers;

use App\Lib\Utils;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class UtilsServiceProvider extends ServiceProvider
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
        App::bind('Utils', function() {
            return new Utils();
        });
    }
}
