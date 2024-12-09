<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Projeto;
use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
     public function index()
    {
        // Aqui você pode pegar dados relevantes para o coordenador, como projetos, alunos, etc.
        return view('sistema.coordenacao-index');
    }

    // Método para gerar relatório (exemplo)
    public function gerarRelatorio()
    {
        // Lógica para gerar o relatório PDF
        // Implementar geração de PDF aqui
        
        return response()->download('relatorio.pdf'); // Exemplo de download
    }
}
