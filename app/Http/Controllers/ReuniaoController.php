<?php

namespace App\Http\Controllers;

use App\Models\Reuniao;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Para acesso ao usuário logado

class ReuniaoController extends Controller
{
    // Mostrar o formulário de criação de reunião
    public function create()
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
    })->get();

    
    // Verifica se existem projetos
    if ($projetos->isEmpty()) {
        return redirect()->route('projetos.index')->with('warning', 'Você precisa estar associado a um projeto para agendar uma reunião.');
    }

    // Exibe a tela de cadastro de reunião, passando os projetos para a view
    return view('sistema.cadReuniao', compact('projetos'));
}


    // Armazenar uma nova reunião
    public function store(Request $request)
    {
        // Validação personalizada para o método store
        $request->validate([
            'id_projeto' => 'required',
            'dataHora' => 'required|date_format:Y-m-d\TH:i', // Corrigido para aceitar o formato de data e hora
            'resumo' => 'required|max:255',
            'statusReuniao' => 'required',
        ], [
            'id_projeto.required' => 'O campo Projeto é obrigatório.',
            'dataHora.required' => 'A data e hora da reunião são obrigatórios.',
            'dataHora.date_format' => 'A data e hora precisam estar no formato correto (YYYY-MM-DDTHH:MM).',
            'resumo.required' => 'O campo Resumo é obrigatório.',
            'resumo.max' => 'O resumo não pode ter mais de 255 caracteres.',
            'statusReuniao.required' => 'Você precisa selecionar o status da reunião.',
        ]);
    
        // Lógica para salvar a reunião
        $reuniao = new Reuniao;
        $reuniao->id_projeto = $request->id_projeto;
        $reuniao->dataHora = $request->dataHora; // A data e hora serão salvas no formato adequado
        $reuniao->resumo = $request->resumo;
        $reuniao->status_reuniao = $request->statusReuniao;
        $reuniao->id_docente = $request->id_docente;
        $reuniao->save();
    
        // Redirecionar ou retornar resposta
        return redirect()->route('reuniao.index')->with('success', 'Reunião criada com sucesso!');
    }
    

    // Listar todas as reuniões do docente logado
    public function index()
    {
        $usuario = Auth::user();
        $docente = $usuario->docente ?? $usuario; 
    
        // Recupera os IDs dos projetos corretamente
        $projetosDocente = DB::table('projeto_docente')
            ->where('id_docente', $docente->id)
            ->pluck('id_projeto')
            ->toArray();
    
        if (empty($projetosDocente)) {
            return view('sistema.minhasReunioes', [
                'reunioes' => collect(),
                'docente' => $docente
            ])->with('warning', 'Nenhuma reunião encontrada.');
        }
    
        $reunioes = Reuniao::with('projeto')
            ->whereIn('id_projeto', $projetosDocente)
            ->get();
    
        return view('sistema.minhasReunioes', compact('reunioes', 'docente'));
    }
    


}
