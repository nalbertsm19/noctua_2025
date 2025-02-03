<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Projeto;
use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
     public function index()
    {
       
        return view('sistema.coordenacao-index');
    }

    // Método para gerar relatório (exemplo)
    public function gerarRelatorio()
    {
       
        
        return response()->download('relatorio.pdf');
    }
}
