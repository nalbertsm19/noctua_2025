<?php

namespace App\Http\Controllers;

use App\Models\Reuniao;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Para acesso ao usuário logado
use Carbon\Carbon;


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

// Editar uma reunião existente
public function edit($id)
{
    // Recupera o docente vinculado ao usuário logado
    $docente = Auth::user()->docente;

    // Verifica se o docente foi encontrado
    if (!$docente) {
        return redirect()->route('perfil-docente')->withErrors('Perfil do docente não encontrado.');
    }

    // Recupera a reunião que o docente deseja editar
    $reuniao = Reuniao::findOrFail($id);

    // Verifica se a reunião pertence ao docente logado
    if ($reuniao->id_docente != $docente->id) {
        return redirect()->route('reuniao.index')->withErrors('Você não tem permissão para editar esta reunião.');
    }

    // Recupera os projetos associados ao docente
    $projetos = Projeto::whereHas('docentes', function ($query) use ($docente) {
        $query->where('id_docente', $docente->id);
    })->get();

    // Exibe o formulário de edição com a reunião e os projetos
    return view('sistema.editarReuniao', compact('reuniao', 'projetos'));
}

    // Armazenar uma nova reunião
    public function store(Request $request)
{
    // Validação personalizada para o método store
    $request->validate([
        'id_projeto' => 'required',
        'dataHora' => 'required|date_format:Y-m-d\TH:i',
        'resumo' => 'required|max:255',
    ], [
        'id_projeto.required' => 'O campo Projeto é obrigatório.',
        'dataHora.required' => 'A data e hora da reunião são obrigatórios.',
        'dataHora.date_format' => 'A data e hora precisam estar no formato correto (YYYY-MM-DDTHH:MM).',
        'resumo.required' => 'O campo Resumo é obrigatório.',
        'resumo.max' => 'O resumo não pode ter mais de 255 caracteres.',
    ]);

    // Lógica para salvar a reunião
    $reuniao = new Reuniao;
    $reuniao->id_projeto = $request->id_projeto;
    $reuniao->dataHora = $request->dataHora;
    $reuniao->resumo = $request->resumo;
    $reuniao->status_reuniao = 1; // 1 representa "Agendada"
    $reuniao->id_docente = $request->id_docente;
    $reuniao->save();

    // Redirecionar ou retornar resposta
    return redirect()->route('indexProfessor')->with('success', 'Reunião criada com sucesso!');
}

    

 public function index(Request $request)
{
    $usuario = Auth::user();
    $docente = $usuario->docente ?? $usuario;

    // Se o usuário for um docente
    if ($usuario->role == 'docente') {
        // Recupera os IDs dos projetos do docente
        $projetosDocente = DB::table('projeto_docente')
            ->where('id_docente', $docente->id)
            ->pluck('id_projeto')
            ->toArray();

        // Se o docente não tiver projetos, retorna uma coleção vazia
        if (empty($projetosDocente)) {
            return view('sistema.minhasReunioes', [
                'reunioes' => collect(),
                'docente' => $docente
            ])->with('warning', 'Nenhuma reunião encontrada.');
        }

        // Inicia a query para o docente, buscando as reuniões dos projetos dele
        $query = Reuniao::with('projeto')
            ->whereIn('id_projeto', $projetosDocente);
    } 
    // Se o usuário for discente
    else {
        // Recupera o ID do projeto ao qual o discente está vinculado
        $projetoDiscente = DB::table('discentes') // Considerando que a tabela de discentes tem o id_projeto
            ->where('id', $usuario->id)
            ->pluck('id_projeto')
            ->first();

        // Se o discente não estiver vinculado a nenhum projeto, retorna uma coleção vazia
        if (!$projetoDiscente) {
            return view('sistema.minhasReunioes', [
                'reunioes' => collect(),
                'docente' => $docente
            ])->with('warning', 'Nenhuma reunião encontrada.');
        }

        // Inicia a query para o discente, buscando as reuniões do projeto ao qual ele está vinculado
        $query = Reuniao::with('projeto')
            ->where('id_projeto', $projetoDiscente);
    }

    // Aplica filtro por data, se existir
    if ($request->has('data') && !empty($request->data)) {
        $query->whereDate('dataHora', $request->data);
    }

    // Obtém as reuniões após aplicar os filtros
    $reunioes = $query->get();

    return view('sistema.minhasReunioes', compact('reunioes', 'docente'));
}

public function indexDiscente(Request $request)
{
    $usuario = Auth::user();
    $discente = $usuario->discente ?? $usuario;

    // Verifica se o discente está associado a algum projeto
    if (!$discente->id_projeto) {
        return view('sistema.minhasReunioes', [
            'reunioes' => collect(),
            'discente' => $discente
        ])->with('warning', 'Você não está associado a nenhum projeto.');
    }

    // Query para obter as reuniões do projeto do discente
    $query = Reuniao::with('projeto')
        ->where('id_projeto', $discente->id_projeto);

    // Aplica filtro por data, se houver
    if ($request->has('data') && !empty($request->data)) {
        $query->whereDate('dataHora', $request->data);
    }

    // Obtém as reuniões após aplicar os filtros
    $reunioes = $query->get();

    return view('sistema.minhasReunioes', compact('reunioes', 'discente'));
}

    
    // Atualizar uma reunião existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_projeto' => 'required',
            'dataHora' => 'required|date_format:Y-m-d\TH:i',
            'resumo' => 'required|max:255',
            'statusReuniao' => 'required|integer',
        ]);
    
        $reuniao = Reuniao::findOrFail($id);
        $agora = now();
        $novaDataHora = Carbon::parse($request->dataHora);
        $novaSituacao = $request->statusReuniao;
    
        // Se a reunião já foi finalizada, não permite alterar nada
        if ($reuniao->status_reuniao == 4) {
            return back()->withErrors(['msg' => 'Após a reunião ser finalizada, não é possível alterar a data, status nem o resumo.']);
        }
    
        // Se a reunião já passou, permite alterar o status (exceto para "Agendada")
        if ($agora->greaterThanOrEqualTo($reuniao->dataHora)) {
            if ($novaSituacao == 1) {  // Impede que a reunião "passada" volte para o status "Agendada"
                return back()->withErrors(['msg' => 'Não é possível alterar o status para "Agendada" depois da data da reunião.']);
            }
    
            // Permite alteração do status para outras opções como "Aluno Ausente", "Cancelada", etc.
            $reuniao->status_reuniao = $novaSituacao;
            $reuniao->resumo = $request->resumo;
            $reuniao->save();
    
            return redirect()->route('indexProfessor')->with('success', 'Status e resumo da reunião atualizados com sucesso!');
        }
    
        // Se a reunião ainda não ocorreu, o status "Agendada" pode ser alterado
        if ($reuniao->status_reuniao == 1 && $novaSituacao != 1) {
            return back()->withErrors(['msg' => 'Não é possível alterar o status de "Agendada" para outro status enquanto a reunião ainda não aconteceu.']);
        }
    
        // Controle de alteração de data/hora sem alterar o banco
        $alteracoesFeitas = session()->get("alteracoes_reuniao_$id", 0);
        if ($reuniao->dataHora != $novaDataHora) {
            if ($alteracoesFeitas >= 2) {
                return back()->withErrors(['msg' => 'A data e hora só podem ser alteradas no máximo duas vezes.']);
            }
    
            session()->put("alteracoes_reuniao_$id", $alteracoesFeitas + 1);
        }
    
        // Alterações na data e hora só podem ser feitas até 24 horas antes da reunião
        if ($novaDataHora->lessThanOrEqualTo($agora->addDay())) {
            return back()->withErrors(['msg' => 'Alterações na data e hora só são permitidas até 24 horas antes.']);
        }
    
        // Atualiza os dados da reunião, permitindo alterações válidas
        $reuniao->id_projeto = $request->id_projeto;
        $reuniao->dataHora = $novaDataHora;
        $reuniao->resumo = $request->resumo;
        $reuniao->status_reuniao = $novaSituacao;
        $reuniao->save();
    
        return redirect()->route('indexProfessor')->with('success', 'Reunião atualizada com sucesso!');
    }
    
public function destroy($id)
{
    // Recupera o docente vinculado ao usuário logado
    $docente = Auth::user()->docente;

    // Verifica se o docente foi encontrado
    if (!$docente) {
        return redirect()->route('perfil-docente')->withErrors('Perfil do docente não encontrado.');
    }

    // Recupera a reunião que será excluída
    $reuniao = Reuniao::findOrFail($id);

    // Verifica se a reunião pertence ao docente logado
    if ($reuniao->id_docente != $docente->id) {
        return redirect()->route('reuniao.index')->withErrors('Você não tem permissão para excluir esta reunião.');
    }

    // Exclui a reunião do banco de dados
    $reuniao->delete();

    // Redireciona para a lista de reuniões com uma mensagem de sucesso
    return redirect()->route('reuniao.index')->with('success', 'Reunião excluída com sucesso!');
}
public function show($id)
{
    $reuniao = Reuniao::with(['docente', 'projeto'])->findOrFail($id);
    return view('sistema.reunioes-show', compact('reuniao'));
}



}




