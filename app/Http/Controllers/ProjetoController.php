<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;
use App\Models\Discente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjetoController extends Controller
{
    // Exibe a lista de projetos
    public function index()
    {
        // Recupera o docente vinculado ao usuário logado
        $docente = Auth::user()->docente;
    
        // Verifica se o docente foi encontrado
        if (!$docente) {
            return redirect()->route('perfil-docente')->withErrors('Perfil do docente não encontrado.');
        }
    
        // Recupera os projetos associados ao docente
        $projetos = Projeto::whereHas('docentes', function ($query) use ($docente) {
            $query->where('id_docente', $docente->id);
        })->with('discentes')->get(); // Adiciona os discentes ao resultado
    
        return view('sistema.indexProjeto', compact('projetos'));
    }
    


public function indexDiscente()
{
    // Recupera o discente vinculado ao usuário logado
    $discente = Auth::user()->discente;

    // Verifica se o discente foi encontrado
    if (!$discente) {
        return redirect()->route('perfil-discente')->withErrors('Perfil do discente não encontrado.');
    }

    // Verifica se o discente tem um projeto associado
    if ($discente->id_projeto) {
        // Recupera o projeto associado ao discente
        $projetos = Projeto::where('id', $discente->id_projeto)->get();
    } else {
        // Caso contrário, recupera todos os projetos do banco de dados
        $projetos = Projeto::all();
    }

    // Retorna a view com os projetos
    return view('sistema.indexProjeto', compact('projetos'));
}



public function associar(Request $request, $idProjeto)
{
    // Recebe o ID do discente do formulário
    $discenteId = $request->input('id'); // Certifique-se que o campo no formulário se chama 'id'

    // Encontra o discente pelo ID
    $discente = Discente::find($discenteId);

    if ($discente) {
        // Associa o discente ao projeto
        $discente->id_projeto = $idProjeto;
        $discente->save();
    }

    return redirect()->route('projetos.show', $idProjeto);
}


    // Método store único
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'matriz_tcc' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'termo_compromisso' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'tema' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_termino' => 'nullable|date',
        ]);

        try {
            // Upload dos arquivos
            $matrizPath = $request->file('matriz_tcc')->store('arquivos', 'public');
            $termoPath = $request->file('termo_compromisso')->store('arquivos', 'public');

            // Obtendo o ID do docente logado
            $user = auth()->user(); // Obtem o usuário autenticado
            if (!$user || !$user->docente) { // Verifica se o usuário está logado e é um docente
                return redirect()->back()->withErrors('Usuário logado não é um docente ou não está autenticado.');
            }
            $docenteId = $user->docente->id; // Acessa o ID do docente associado ao usuário logado

            // Criar o projeto
            $projeto = Projeto::create([
                'matriz_tcc' => $matrizPath,
                'termo_compromisso' => $termoPath,
                'tema' => $request->tema,
                'descricao' => $request->descricao,
                'statusProjeto' => 'Em andamento',
                'data_termino' => $request->data_termino,
            ]);

            // Associar o projeto ao docente na tabela pivô ProjetoDocente
            $projeto->docentes()->attach($docenteId);

            // Redirecionar com mensagem de sucesso
            return redirect()->route('indexProfessor')->with('success', 'Projeto criado e associado ao docente logado com sucesso!');
        } catch (\Exception $e) {
            // Exibe o erro real para depuração
            return redirect()->back()->withErrors('Erro ao salvar o projeto. Detalhes do erro: ' . $e->getMessage());
        }
    }

    // Exibe os detalhes de um projeto específico
    public function show($id)
    {
        $projeto = Projeto::findOrFail($id);
        return view('sistema.projetoShow', compact('projeto'));
    }

    // Exibe o formulário para editar um projeto existente
    public function edit($id)
    {
        $projeto = Projeto::findOrFail($id);
        return view('sistema.editProjeto', compact('projeto'));
    }

    // Atualiza os dados de um projeto no banco
    public function update(Request $request, $id) // Corrigido para buscar manualmente pelo ID
    {
        // Validação dos dados recebidos
        $request->validate([
            'matriz_tcc' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'termo_compromisso' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'tema' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_termino' => 'nullable|date',
        ]);

        // Busca o projeto pelo ID
        $projeto = Projeto::findOrFail($id);

        try {
            // Atualização de arquivos, se enviados
            if ($request->hasFile('matriz_tcc')) {
                $matrizPath = $request->file('matriz_tcc')->store('arquivos', 'public');
                $projeto->matriz_tcc = $matrizPath;
            }

            if ($request->hasFile('termo_compromisso')) {
                $termoPath = $request->file('termo_compromisso')->store('arquivos', 'public');
                $projeto->termo_compromisso = $termoPath;
            }

            // Atualização dos outros campos
            $projeto->tema = $request->tema;
            $projeto->descricao = $request->descricao;
            $projeto->statusProjeto = $request->statusProjeto ?? $projeto->statusProjeto;
            $projeto->data_termino = $request->data_termino;

            // Salva as alterações
            $projeto->save();

            return redirect()->route('indexProfessor')->with('success', 'Projeto atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar o projeto. Detalhes do erro: ' . $e->getMessage());
        }
    }

    // Método destroy para excluir um projeto
public function destroy($id)
{
    try {
        // Busca o projeto pelo ID
        $projeto = Projeto::findOrFail($id);

        // Remove as associações na tabela pivô ProjetoDocente
        $projeto->docentes()->detach();

        // Exclui os arquivos armazenados (se existirem)
        if (Storage::exists('public/' . $projeto->matriz_tcc)) {
            Storage::delete('public/' . $projeto->matriz_tcc);
        }

        if (Storage::exists('public/' . $projeto->termo_compromisso)) {
            Storage::delete('public/' . $projeto->termo_compromisso);
        }

        // Exclui o projeto
        $projeto->delete();

        // Redireciona com sucesso
        return redirect()->route('indexProfessor')->with('success', 'Projeto excluído com sucesso!');
    } catch (\Exception $e) {
        // Em caso de erro
        return redirect()->back()->withErrors('Erro ao excluir o projeto. Detalhes do erro: ' . $e->getMessage());
    }
}



public function remover($discenteId)
{
    // Encontra o discente pelo ID
    $discente = Discente::find($discenteId);

    if (!$discente) {
        return redirect()->route('projetos.index')->with('error', 'Discente não encontrado.');
    }

    // Remove a associação do discente com o projeto
    $discente->id_projeto = null;
    $discente->save();

    return redirect()->route('projetos.index')->with('success', 'Discente removido com sucesso.');
}

}