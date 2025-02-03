<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Tenta autenticar o usuário na tabela `users`
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verifica o tipo de usuário (role)
            if ($user->role === 'docente') {
                return redirect()->route('dashboard-docente')->with('success', 'Bem-vindo, Docente!');
            } elseif ($user->role === 'discente') {
                return redirect()->route('dashboard-discente')->with('success', 'Bem-vindo, Discente!');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tipo de usuário inválido.');
            }
        }

        // Retorna erro se a autenticação falhar
        return redirect()->back()->with('error', 'Credenciais inválidas.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Você saiu com sucesso.');
    }
}
