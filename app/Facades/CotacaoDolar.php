<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CotacaoDolar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CotacaoDolar';
    }
}
