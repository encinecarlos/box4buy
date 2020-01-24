<?php

namespace App\Http\Middleware;

use Closure;

class UsuarioCalculadora
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
        // session('teste', 'valor para teste');
        // dd(session('suite_prefix'));
        if ($request->path() != 'usuario/calculadora') {
            session()->forget('frete');
        }
        
        return $next($request);
    }
}
