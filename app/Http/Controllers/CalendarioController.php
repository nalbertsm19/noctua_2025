<?php

namespace App\Http\Controllers;

use App\Models\Reuniao;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    // Exibe a view do calendário
    public function index()
    {
        return view('sistema.calendario-index');
    }

    // Retorna as reuniões no formato JSON para o FullCalendar
    public function getReunioes(Request $request)
{
    // Busca as reuniões no banco de dados
    $reunioes = Reuniao::with(['docente', 'projeto'])->get();

    // Formata os dados para o FullCalendar
    $events = [];
    foreach ($reunioes as $reuniao) {
        // Verifica se o campo dataHora está corretamente preenchido
        $startDateTime = Carbon::parse($reuniao->dataHora)->format('Y-m-d\TH:i:s');
        
        $events[] = [
           'title' => 'Reunião de ' . $reuniao->projeto->tema,
            'start' => $startDateTime, // Data e hora no formato ISO 8601
            'url' => route('reunioes-show', $reuniao->id), // Link para detalhes da reunião
            'description' => 'Resumo: ' . $reuniao->resumo, // Detalhes adicionais
        ];
    }

    return response()->json($events);
}

    
    
   
}
