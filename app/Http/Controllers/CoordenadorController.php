<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Projeto;
use App\Models\Discente;
use App\Models\Docente;
use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
    // Exibe a tela de login do coordenador
    public function login()
    {
        return view('sistema.coordenador-login');
    }

    public function autenticar(Request $request)
    {
        $codigoCorreto = env('COORDENADOR_PASSWORD'); // Código salvo no .env

        if ($request->input('codigo_acesso') === $codigoCorreto) {
            session(['coordenador_autenticado' => true]); // Armazena na sessão

            // Buscar todos os projetos
            $projetos = Projeto::all();

            // Retornar para a view com os projetos
            return view('sistema.coordenacao-index', compact('projetos'));
        }

        return back()->withErrors(['codigo_acesso' => 'Código inválido']);
    }

    public function gerarRelatorio()
    {
        // Obtém todos os projetos cadastrados
        $projetos = Projeto::with(['discentes', 'docentes'])->get();

        // Carrega a view que será transformada em PDF
        $pdf = PDF::loadView('sistema.relatorio-projetos', compact('projetos'));

        // Retorna o PDF para download
        return $pdf->download('relatorio_projetos.pdf');
    }

   

    // Desloga o coordenador
    public function logout()
    {
        session()->forget('coordenador_autenticado');
        return redirect()->route('coordenador.login');
    }
}
