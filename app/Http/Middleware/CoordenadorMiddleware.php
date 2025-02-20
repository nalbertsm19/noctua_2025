<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CoordenadorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('coordenador_autenticado') === true) {
            return $next($request);
        }
        return redirect()->route('coordenador.login');
    }
}
