<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Exibe a página de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Realiza o login de diferentes tipos de usuários.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Obtém o usuário baseado no email
        $user = User::where('email', $request->email)->first();

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return back()->withErrors(['email' => 'Usuário não encontrado.']);
        }

        // Verifica a senha do usuário
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Senha incorreta.']);
        }

        // Verifica o nível de acesso (role)
        if ($user->role === 'docente') {
            Auth::login($user);
            return redirect()->route('indexProfessor'); // Rota específica para docentes
        } elseif ($user->role === 'discente') {
            Auth::login($user);
            return redirect()->route('index-aluno'); // Rota específica para discentes
        } else {
            return back()->withErrors(['email' => 'Nível de acesso não reconhecido.']);
        }
    }

    /**
     * Realiza o logout.
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login'); // Redireciona para a página de login
    }
}
