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
        'turma' => 'required|string|max:5',
        'password' => 'required|string|min:6',
    ]);

    DB::beginTransaction();

    try {
        // Remove a formatação do CPF (mantém apenas números)
        $cpfLimpo = preg_replace('/\D/', '', $request->cpf);

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
            'cpf' => $cpfLimpo,
            'imagem' => $caminhoImagem,
            'turma' =>  $request->turma,
            'user_id' => $user->id,
            'password' => Hash::make($request->password), // Adicionando a senha criptografada
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
        // Obtém o usuário logado
        $user = Auth::user();
        
        // Carrega as informações do Discente associado ao User
        $discente = $user->discente;  // Relacionamento de um para um
        
        if (!$discente) {
            // Caso o discente não exista, redireciona ou exibe erro
            return redirect()->route('dashboard')->withErrors('Dados do discente não encontrados.');
        }
    
        // Retorna a view com os dados do discente
        return view('sistema.perfil-discente', compact('discente'));
    }
    
    

    



    public function listarDiscentes()
    {
        // Obtém o docente logado
        $docente = Auth::user();  // Usuário logado é o docente
    
        // Obtém os projetos do docente através da tabela pivô
        $projetosDoDocente = $docente->projetos;  // Relacionamento many-to-many
    
        // Verifica se o docente tem projetos
        if ($projetosDoDocente->isEmpty()) {
            // Caso não tenha projetos, retorne um array vazio de discentes
            $discentes = collect();
        } else {
            // Busca os discentes que possuem um projeto associado aos projetos do docente
            $discentes = Discente::whereIn('id_projeto', $projetosDoDocente->pluck('id'))->get();
        }
    
        // Retorna a view com os discentes e o docente
        return view('sistema.orientando', compact('discentes', 'docente'));
    }
    

}