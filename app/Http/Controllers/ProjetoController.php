<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;

class ProjetoController extends Controller
{
    // Exibe a lista de projetos
    public function index()
    {
        $projetos = Projeto::all();
        return view('sistema.meusProjetos', compact('projetos'));
    }


    // Armazena um novo projeto no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'matriz_tcc' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'termo_compromisso' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'tema' => 'required|string|max:255',
            'descricao' => 'required|string',
            'statusProjeto' => 'required|string',
            'data_termino' => 'nullable|date',
        ]);

        // Salvar arquivos na pasta 'arquivos'
        $matrizPath = $request->file('matriz_tcc')->store('arquivos', 'public');
        $termoPath = $request->file('termo_compromisso')->store('arquivos', 'public');

        // Criar o projeto no banco de dados
        Projeto::create([
            'matriz_tcc' => $matrizPath,
            'termo_compromisso' => $termoPath,
            'tema' => $request->tema,
            'descricao' => $request->descricao,
            'statusProjeto' => $request->statusProjeto,
            'data_termino' => $request->data_termino,
        ]);

        return redirect()->route('sistema.meusProjetos')->with('success', 'Projeto criado com sucesso!');
    }

    // Exibe os detalhes de um projeto específico
    public function show($id)
    {
        $projeto = Projeto::findOrFail($id);
        return view('sistema.detalhesProjeto', compact('projeto'));
    }

    // Exibe o formulário para editar um projeto existente
    public function edit($id)
    {
        $projeto = Projeto::findOrFail($id);
        return view('sistema.editarProjeto', compact('projeto'));
    }

    // Atualiza os dados de um projeto no banco
    public function update(Request $request, $id)
    {
        $request->validate([
            'matriz_tcc' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'termo_compromisso' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'tema' => 'required|string|max:255',
            'descricao' => 'required|string',
            'statusProjeto' => 'required|string',
            'data_termino' => 'nullable|date',
        ]);

        $projeto = Projeto::findOrFail($id);

        // Atualizar arquivos se forem enviados
        if ($request->hasFile('matriz_tcc')) {
            $matrizPath = $request->file('matriz_tcc')->store('arquivos', 'public');
            $projeto->matriz_tcc = $matrizPath;
        }

        if ($request->hasFile('termo_compromisso')) {
            $termoPath = $request->file('termo_compromisso')->store('arquivos', 'public');
            $projeto->termo_compromisso = $termoPath;
        }

        // Atualizar outros dados
        $projeto->update($request->only(['tema', 'descricao', 'statusProjeto', 'data_termino']));

        return redirect()->route('projetos.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    // Remove um projeto do banco de dados
    public function destroy($id)
    {
        $projeto = Projeto::findOrFail($id);
        
        // Deletar arquivos associados
        if ($projeto->matriz_tcc) {
            \Storage::disk('public')->delete($projeto->matriz_tcc);
        }

        if ($projeto->termo_compromisso) {
            \Storage::disk('public')->delete($projeto->termo_compromisso);
        }

        $projeto->delete();

        return redirect()->route('projetos.index')->with('success', 'Projeto excluído com sucesso!');
    }
}
