<?php

namespace App\Http\Controllers;
use  App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function store(Request $request)
{
    // Validação dos dados do formulário
    $request->validate([
        'foto_perfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo de validação para imagem
        'nome' => 'required|string',
        'email' => 'required|email|unique:users,email', // Verificação de unicidade do e-mail na tabela users
        'formacao' => 'required|string',
        'disponibilidade' => 'required|integer',
        'suap' => 'required|integer',
        'descricao' => 'required|string',
        'curriculo_lates' => 'required|string',
        'password' => 'required|string|min:6', // Adicionando a validação para a senha
    ]);
    
    // Verifica se há upload de imagem no request
    if ($request->hasFile('foto_perfil')) {
        // Salva a imagem e obtém o caminho
        $caminhoImagem = $request->file('foto_perfil')->store('imagens', 'public');

        // Cria um novo usuário com os dados do request
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hashifica a senha
        $user->role = 'docente'; // Define o tipo do usuário
        $user->foto_perfil = $caminhoImagem; // Salva o caminho da imagem no User
        $user->save();

        // Cria um novo docente com os dados do request
        $docente = new Docente();
        $docente->foto_perfil = $caminhoImagem;
        $docente->nome = $request->nome;
        $docente->email = $request->email;
        $docente->formacao = $request->formacao;
        $docente->disponibilidade = $request->disponibilidade;
        $docente->suap = $request->suap;
        $docente->descricao = $request->descricao;
        $docente->curriculo_lates = $request->curriculo_lates;
        $docente->password = bcrypt($request->password); // Hashifica a senha antes de salvar
        $docente->user_id = $user->id; // Associa o ID do usuário ao docente
        $docente->save();

        // Redireciona para a rota 'index-aluno' após a criação do docente
        return redirect()->route('index-aluno')->with('success', 'Docente cadastrado com sucesso.');
    } else {
        // Caso não haja upload de imagem, retorna com erro
        return redirect()->back()->with('error', 'Erro ao cadastrar docente. Por favor, selecione uma imagem válida.');
    }
}

public function buscar(Request $request)
{
    $query = $request->input('query');
    $docentes = Docente::where('nome', 'LIKE', '%' . $query . '%')->get();

    return response()->json($docentes);
}

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    // Tenta autenticar na tabela de docentes
    $docente = Docente::where('email', $credentials['email'])->first();
    
    if ($docente && Hash::check($credentials['password'], $docente->password)) {
        // Login bem-sucedido
        Auth::login($docente);
        return redirect()->route('index-professor')->with('success', 'Bem-vindo, Docente!');
    }

    // Login falhou
    return redirect()->back()->with('error', 'Credenciais inválidas.');
}

    public function index()
   {
    $docente = Docente::all();
    return view('sistema.aluno-index', compact('docente'));
    }

    public function edit($id){
        $docente = Docente::findOrFail($id);
        return view('sistema.editDocente', compact('docente'));
    }
    public function update(Request $request, $id) {
        // Validação dos dados do formulário
        $request->validate([
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Permitir que a imagem seja opcional
            'nome' => 'required|string',
            'email' => 'required|email',
            'formacao' => 'required|string',
            'disponibilidade' => 'required|integer',
            'suap' => 'required|integer',
            'descricao' => 'required|string',
            'curriculo_lates' => 'required|string',
        ]);
    
        $docente = Docente::findOrFail($id);
    
        // Verifica se há upload de imagem no request
        if ($request->hasFile('foto_perfil')) {
            // Salva a nova imagem e obtém o caminho
            $caminhoImagem = $request->file('foto_perfil')->store('imagens', 'public');
            // Atualiza o caminho da nova imagem no registro do docente
            $docente->foto_perfil = $caminhoImagem;
        }
    
        // Atualiza os outros campos do docente
        $docente->nome = $request->nome;
        $docente->email = $request->email;
        $docente->formacao = $request->formacao;
        $docente->disponibilidade = $request->disponibilidade;
        $docente->suap = $request->suap;
        $docente->descricao = $request->descricao;
        $docente->curriculo_lates = $request->curriculo_lates;
        $docente->save();
    
        return redirect()->route('index-aluno', ['docente' => $docente->id])->with('success', 'Docente atualizado com sucesso.');
    }
    
    
    public function show()
    {
        $user = Auth::user();
        $docente = $user->docente; // Acessa o relacionamento
    
        if (!$docente) {
            return redirect()->route('perfil-docente')->withErrors('Dados do docente não encontrados.');
        }
    
        return view('sistema.perfil-docente', compact('docente'));
    }

    public function showDocenteforDiscente($id)
    {
        // Buscar o docente pelo ID passado na URL
        $docente = Docente::find($id); // Aqui estamos utilizando o $id que vem da URL
        
        // Verificar se o docente foi encontrado
        if (!$docente) {
            return redirect()->route('perfil-docente')->withErrors('Dados do docente não encontrados.');
        }
        
        // Retornar a view com a variável $docente
        return view('sistema.perfilDocenteforDiscente', compact('docente'));
    }
    

}