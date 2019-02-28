<?php

namespace App\Http\Middleware;

use App\lib\ProductServices;
use Closure;
use Illuminate\Support\Facades\Route;

class SumProducts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->path() == 'carrinho')
        {
            return ProductServices::totalizaProdutos();
        }
        return $next($request);
    }
}
