<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordenadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e é um coordenador
        if (Auth::check() && Auth::user()->role === 'coordenador') {
            return $next($request);
        }

        // Caso contrário, redireciona para a página inicial
        return redirect('/')->with('error', 'Acesso não autorizado.');
    }
}
