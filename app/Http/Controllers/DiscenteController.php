<?php 
namespace App\Http\Controllers;

use App\Models\Discente;
use App\Models\Docente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  // Adicione esta linha no início do seu arquivo
use App\Models\ProjetoDocente;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\CpfValid;
use Illuminate\Support\Facades\Hash;


class DiscenteController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => ['required', 'unique:discentes,cpf', new CpfValid],
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            // Verifica se há uma imagem e armazena no diretório 'storage/app/public/imagens'
            $caminhoImagem = null;
            if ($request->hasFile('imagem')) {
                $caminhoImagem = $request->file('imagem')->store('imagens', 'public');
            }

            // Criação do usuário associado
            $user = User::create([
                'name' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'discente',
                'foto_perfil' => $caminhoImagem,
            ]);

            // Criação do discente
            Discente::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'imagem' => $caminhoImagem,
                'user_id' => $user->id,
            ]);

            DB::commit();

            return redirect()->route('index-aluno')->with('success', 'Discente cadastrado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Erro ao cadastrar discente: ' . $e->getMessage()]);
        }
    }

    
    public function destroy($id)
{
    $discente = Discente::findOrFail($id);
    $discente->delete(); // Exclui o discente
    return redirect()->route('sistema.orientando')->with('success', 'Discente excluído com sucesso!');
}

    
    
    public function edit($id)
    {
        $discente = Discente::findOrFail($id);
        return view('sistema.editDiscente', compact('discente'));
    }

    public function update(Request $request, $id)
    {
        $discente = Discente::findOrFail($id);
        $discente->update($request->all());
        return redirect()->route('index-aluno', ['discente' => $discente->id]);
    }

    public function show()
    {
        $user = Auth::user();  // Obtém o usuário autenticado
        $discentes = $user->discente;  // Acessa o relacionamento (ajuste conforme o relacionamento entre Discente e Usuário)
    
        if (!$discentes) {
            // Caso o usuário não tenha o relacionamento Discente, redireciona para o dashboard
            return redirect()->route('dashboard')->withErrors('Dados do discente não encontrados.');
        }
    
        return view('sistema.perfil-discente', compact('discentes'));  // Retorna a view do perfil do discente
    }
    

}