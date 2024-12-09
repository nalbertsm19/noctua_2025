<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valida os dados de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenta autenticar o usuário com as credenciais
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verifica o papel do usuário
            if ($user->role === 'coordenador') {
                return redirect()->route('coordenador.index');
            }

            // Logout se não for coordenador
            Auth::logout();
            return redirect()->route('login')->with('error', 'Acesso não autorizado.');
        }

        // Erro se as credenciais estiverem incorretas
        return redirect()->route('login')->with('error', 'Credenciais incorretas.');
    }
}
