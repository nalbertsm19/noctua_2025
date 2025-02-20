<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DocenteMiddleware
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
        // Verifica se o usuário está autenticado e se ele é docente
        if (!Auth::check() || Auth::user()->role !== 'docente') {
            // Adiciona uma mensagem de erro na sessão
            Session::flash('error', 'Você não tem permissão para acessar essa página.');

            // Redireciona o usuário para a página inicial
            return redirect()->route('inicio');
        }

        // Se o usuário for docente, permite a continuidade da requisição
        return $next($request);
    }
}
