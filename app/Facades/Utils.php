<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/2/19
 * Time: 9:14 AM
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Utils extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Utils';
    }
}
