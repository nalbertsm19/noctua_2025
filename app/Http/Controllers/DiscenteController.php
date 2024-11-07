<?php

namespace App\Http\Controllers;

use App\Models\Discente;
use Illuminate\Http\Request;

class DiscenteController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo de validação para imagem
        ]);

        // Verifica se há upload de imagem no request
        if ($request->hasFile('imagem')) {
            // Salva a imagem e obtém o caminho
            $caminhoImagem = $request->file('imagem')->store('imagens', 'public');

            // Cria um novo discente com os dados do request, incluindo o RA e o caminho da imagem
            $discente = new Discente();
            $discente->nome = $request->nome;
            $discente->email = $request->email;
            $discente->cpf = $request->cpf;
            $discente->imagem = $caminhoImagem; 
            $discente->save();

            // Redireciona para a rota 'index-aluno' após a criação do discente
            return redirect()->route('index-aluno')->with('success', 'Discente cadastrado com sucesso.');
        } else {
            // Caso não haja upload de imagem, retorna com erro
            return redirect()->back()->with('error', 'Erro ao cadastrar discente. Por favor, selecione uma imagem válida.');
        }
    }
    public function index()
   {
    $discente = Discente::all();
        return view('sistema.aluno-index', compact('discente'));
    }

    public function edit($id){
        $discente = Discente::findOrFail($id);
        return view('sistema.editDiscente', compact('discente'));
    }
    public function update(Request $request, $id) {
        $discente = Discente::findOrFail($id);
        $discente->update($request->all());
        return redirect()->route('index-aluno', ['discente' => $discente->id]);
    }
}
