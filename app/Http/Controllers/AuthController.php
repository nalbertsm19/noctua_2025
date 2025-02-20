<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB; // Adicionando o DB para transações

class AuthController extends Controller
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
        // Validação do formulário de login
        $request->validate([
            'identificacao' => 'required', // CPF ou SUAP
            'password' => 'required',
        ]);

        try {
            // Chama a função 'ad' para autenticar via API
            $usuarios1 = User::ad($request->identificacao, $request->password);
            
            $usuarios = json_decode($usuarios1);
            dd($usuarios);
            // Verifica se o CPF foi retornado
            if (isset($usuarios->CPF) && $usuarios->CPF !== null) {
                // Verifica se o usuário já existe no banco
                $user = User::where('cpf', $usuarios->CPF)
                            ->orWhere('suap', $usuarios->SUAP ?? '')
                            ->first();

                // Lógica para definir o papel (role) com base na contagem de caracteres
                $role = null;
                $identificador = $request->identificador;

                if (strlen($identificador) == 11) {
                    $role = 'discente';
                } elseif (strlen($identificador) >= 10) {
                    $role = 'docente';
                }

                // Se o usuário não existir, cria um novo com cadastro parcial
                if (!$user) {
                    $user = User::create([
                        'name' => $usuarios->nome,
                        'cpf' => $usuarios->CPF,
                        'suap' => $usuarios->SUAP ?? '',
                        'role' => $role ?? 'discente',
                        'email' => null, // Não informado pela API
                        'password' => bcrypt($request->password),
                        'cadastro_completo' => false, // Marca como cadastro incompleto
                        'updated_at' => now(),
                    ]);
                } else {
                    // Se o usuário já existe, atualiza a última atualização
                    $user->update([
                        'updated_at' => now(),
                    ]);
                }

                // Autentica o usuário no Laravel
                Auth::login($user);

                // Se o cadastro não estiver completo, redireciona para o formulário de completar cadastro
                if (!$user->cadastro_completo) {
                    // Redireciona para o formulário de completar cadastro com base no role
                    if ($user->role === 'docente') {
                        return redirect()->route('completarCadastroDocente');
                    } elseif ($user->role === 'discente') {
                        return redirect()->route('completarCadastroDiscente');
                    }
                }

                // Redireciona para o painel conforme o papel (role)
                if ($user->role === 'docente') {
                    return redirect()->route('indexProfessor');
                } elseif ($user->role === 'discente') {
                    return redirect()->route('index-aluno');
                }

            } else {
                // Se não retornar CPF ou SUAP, exibe erro de credenciais inválidas
                return back()->withErrors(['identificador' => 'Credenciais inválidas.']);
            }
        } catch (\Exception $e) {
            // Caso aconteça algum erro com a API (erro de autenticação ou outro)
            return back()->withErrors(['identificador' => 'Erro ao tentar autenticar. Por favor, tente novamente.']);
        }
    }

    /**
     * Realiza o logout.
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    /**
     * Exibe o formulário de cadastro completo para docentes.
     */
    public function showCompleteFormDocente()
    {
        return view('auth.completar-cadastro-docente');
    }

    /**
     * Exibe o formulário de cadastro completo para discentes.
     */
    public function showCompleteFormDiscente()
    {
        return view('auth.completar-cadastro-discente');
    }

    /**
     * Atualiza o cadastro do docente para indicar que o cadastro foi completado.
     */
    public function completarCadastroDocente(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'foto_perfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto obrigatória
            'nome' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::id(), // Exclui a verificação de unicidade para o próprio usuário
            'formacao' => 'required|string',
            'disponibilidade' => 'required|integer',
            'suap' => 'required|integer',
            'descricao' => 'required|string',
            'curriculo_lates' => 'required|string',
        ]);
        
        // Recupera o usuário autenticado
        $user = Auth::user();
    
        // Salva a imagem e obtém o caminho
        $caminhoImagem = $request->file('foto_perfil')->store('imagens', 'public');
    
        // Atualiza os dados do usuário
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->foto_perfil = $caminhoImagem; // Atualiza o caminho da foto de perfil
        $user->save();
    
        // Recupera o docente associado ao usuário
        $docente = $user->docente; // Supondo que você tem uma relação 'hasOne' com o modelo Docente
    
        // Atualiza os dados do docente
        $docente->nome = $request->nome;
        $docente->formacao = $request->formacao;
        $docente->disponibilidade = $request->disponibilidade;
        $docente->suap = $request->suap;
        $docente->descricao = $request->descricao;
        $docente->curriculo_lates = $request->curriculo_lates;
        $docente->foto_perfil = $caminhoImagem; // Atualiza a foto de perfil
        $docente->save();
    
        // Marca o cadastro como completo no usuário
        $user->cadastro_completo = true;
        $user->save();
    
        // Redireciona para o painel do docente
        return redirect()->route('indexProfessor')->with('success', 'Cadastro do docente completo com sucesso!');
    }

    /**
     * Atualiza o cadastro do discente para indicar que o cadastro foi completado.
     */
    public function completarCadastroDiscente(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(), // Exclui o e-mail do próprio usuário
            'cpf' => ['required', 'unique:discentes,cpf,' . Auth::user()->discente->id, new CpfValid], // Exclui CPF do próprio discente
            'imagem' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Foto obrigatória
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            // Verifica se há uma imagem e armazena no diretório 'storage/app/public/imagens'
            $caminhoImagem = null;
            if ($request->hasFile('imagem')) {
                // Armazena a imagem no diretório público
                $caminhoImagem = $request->file('imagem')->store('imagens', 'public');
            }

            // Atualiza o usuário autenticado
            $user = Auth::user();
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hashifica a senha
            $user->foto_perfil = $caminhoImagem;
            $user->cadastro_completo = true; // Marca o cadastro como completo
            $user->save();

            // Atualiza o discente associado
            $discente = $user->discente; // Supondo que tenha a relação 'hasOne' com Discente
            $discente->nome = $request->nome;
            $discente->email = $request->email;
            $discente->cpf = $request->cpf;
            $discente->imagem = $caminhoImagem; // Atualiza a imagem
            $discente->save();

            // Comita a transação
            DB::commit();

            // Redireciona para o painel do discente
            return redirect()->route('index-aluno')->with('success', 'Cadastro do discente completo com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer algum erro, faz rollback
            DB::rollBack();

            // Exibe mensagem de erro
            return redirect()->back()->withErrors(['error' => 'Erro ao completar cadastro do discente: ' . $e->getMessage()]);
        }
    }
}
