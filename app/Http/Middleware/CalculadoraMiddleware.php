<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;

class CalculadoraMiddleware
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
        // dd($request);
        // dd($request->session()->get('frete'));
        // dd(session('frete'));
        
        if ($request->path() != 'calculadora') {
            session()->forget('frete');
        }
        

        return $next($request);
    }
}
