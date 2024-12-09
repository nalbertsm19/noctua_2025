<?php

namespace App\Http\Controllers;
use  App\Models\Docente;

use Illuminate\Http\Request;
class DocenteController extends Controller
{
    public function store(Request $request)
    {
       // Validação dos dados do formulário
       $request->validate([
        'foto_perfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo de validação para imagem
        'nome' => 'required|string',
        'email' => 'required|email',
        'formacao' => 'required|string',
        'disponibilidade' => 'required|integer',
        'suap' => 'required|integer',
        'descricao' => 'required|string',
        'curriculo_lates' => 'required|string',
    ]);

    // Verifica se há upload de imagem no request
    if ($request->hasFile('foto_perfil')) {
        // Salva a imagem e obtém o caminho
        $caminhoImagem = $request->file('foto_perfil')->store('imagens', 'public');

        // Cria um novo discente com os dados do request, incluindo o RA e o caminho da imagem
        $docente = new Docente();
        $docente->foto_perfil = $caminhoImagem; 
        $docente->nome = $request->nome;
        $docente->email = $request->email;
        $docente->formacao = $request->formacao;
        $docente->disponibilidade = $request->disponibilidade; 
        $docente->suap = $request->suap; 
        $docente->descricao = $request->descricao; 
        $docente->curriculo_lates = $request->curriculo_lates; 
        $docente->save();

        // Redireciona para a rota 'index-aluno' após a criação do discente
        return redirect()->route('index-aluno')->with('success', 'Docente cadastrado com sucesso.');
    } else {
        // Caso não haja upload de imagem, retorna com erro
        return redirect()->back()->with('error', 'Erro ao cadastrar docente. Por favor, selecione uma imagem válida.');
    }
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
    
    
  public function show($id){

    $docentes= Docente::find(id: $id);
    if(empty($docentes)){
        return redirect()->route('index-aluno')->with('error', 'Docente não encontrado.');
    }
     return view('sistema.docenteShow', compact('docentes'));
  }
}