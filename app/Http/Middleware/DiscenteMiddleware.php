<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscenteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifique se o usuário está autenticado e se ele é discente
        if (!Auth::check() || Auth::user()->role !== 'discente') {
            // Redireciona o usuário se ele não for discente
            return redirect()->route('inicio');
        }

        return $next($request);
    }
}
