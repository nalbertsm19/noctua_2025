<?php

namespace App\Http\Controllers;

use App\Models\Reuniao;
use App\Http\Controllers\Docente;
use App\Http\Controllers\Projeto;
use Illuminate\Http\Request;

class ReuniaoController extends Controller
{
    // Método para mostrar o formulário de criação de reunião
    public function create()
    {
        // Recupera todos os docentes e projetos
        $docentes = Docente::all();
        $projetos = Projeto::all();

        // Retorna a view com os docentes e projetos para o formulário
        return view('sistema.cadReuniao', compact('docentes', 'projetos'));
    }

    // Método para armazenar a reunião
    public function store(Request $request)
    { 
        // Validação dos dados do formulário (opcional)
        $request->validate([
            'id_projeto' => 'required|exists:projetos,id',
            'id_docente' => 'required|exists:docentes,id',
            'dataHora' => 'required|date',
            'resumo' => 'required|string|max:100',
            'status_reuniao' => 'required|integer',
        ]);

        // Criação da reunião com os dados do formulário
        Reuniao::create($request->all());

        // Redireciona para a página das reuniões
        return redirect()->route('minhas-reunioes');
    }

    // Método para listar as reuniões
    public function index()
   {
    $reunioes = ['Teste de reunião']; // Dados fictícios para teste

    return view('sistema.minhasReunioes', compact('reunioes'));

    }
    

    
    
}

 

