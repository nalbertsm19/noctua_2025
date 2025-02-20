<?php

use App\Http\Controllers\AreaDeInteresseController;
use App\Http\Controllers\DiscenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ReuniaoController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\AuthController; // Adicionado o controlador de autenticação
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| As rotas para o sistema, organizadas por categoria, para facilitar a manutenção.
*/

// Rota para exibir a view do calendário
Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');

// Rota para retornar os eventos (reuniões) no formato JSON
Route::get('/calendario/reunioes', [CalendarioController::class, 'getReunioes'])->name('calendario.reunioes');
Route::get('/reunioes/{id}', [ReuniaoController::class, 'show'])->name('reunioes-show');

// Rota para a página de login
Route::get('/', function () {
    return view('sistema.login');
})->name('inicio');

// Rota de Login genérica
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Rota de Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas de login diferenciadas para Docente e Discente
Route::post('/login/docente', [AuthController::class, 'loginDocente'])->name('login.docente');
Route::post('/login/discente', [AuthController::class, 'loginDiscente'])->name('login.discente');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ** Rotas Protegidas pelo Middleware 'coordenador' **

// Rotas públicas (login e autenticação)
Route::get('/coordenador/login', [CoordenadorController::class, 'login'])->name('coordenador.login');
Route::post('/coordenador/autenticar', [CoordenadorController::class, 'autenticar'])->name('coordenador.autenticar');

// Rotas protegidas (somente para coordenadores autenticados)
Route::middleware('coordenador')->group(function () {
    Route::get('/coordenador', function() {
        return view('sistema.coordenacao-index');
    })->name('coordenador.inicio');

    Route::get('/coordenador/dashboard', [CoordenadorController::class, 'dashboard'])->name('coordenador.dashboard');
    Route::post('/coordenador/logout', [CoordenadorController::class, 'logout'])->name('coordenador.logout');

    // Relatórios e Filtros para o Coordenador
    Route::get('/coordenador/relatorio', [CoordenadorController::class, 'gerarRelatorio'])->name('coordenador.relatorio');
    Route::get('/coordenador/filtrar', [CoordenadorController::class, 'filtrarDados'])->name('coordenador.filtrar');
});
// ** Rotas de Docentes **
Route::get('/prof', function() {
    return view('sistema.index-professor');
})->name('indexProfessor');

Route::get('/perfil-docente', [DocenteController::class, 'show'])->name('perfil-docente');
Route::post('/perfil-docente', [DocenteController::class, 'update'])->name('perfil-docente.update');

Route::get('/buscar-orientadores', [DocenteController::class, 'buscar'])->name('docente-buscar');

Route::get('/cadDocente', function() {
    return view('sistema.cadastroDocente');
});
Route::post('cadDocente', [DocenteController::class, 'store'])->name('docente-store');
Route::get('/prof/{id}/editDocente', [DocenteController::class, 'edit'])->name('docente.edit');
Route::put('/prof/{id}/atualizar', [DocenteController::class, 'update'])->name('docente.update');
Route::get('docente/{id}', [DocenteController::class, 'show'])->name('docente.show');

Route::get('docente/{id}/discente', [DocenteController::class, 'showDocenteforDiscente'])->name('docente.showfordiscente');

// ** Rotas de Projetos **
Route::get('/meusProjetos', [ProjetoController::class, 'index'])->name('projetos.index');
Route::get('/projetos/discente', [ProjetoController::class, 'indexDiscente'])->name('projetos.indexdiscente');

Route::get('/cadProjeto', function() {
    return view('sistema.cadastroProjeto');
})->name('cadastro-projeto');

Route::post('/projetos/associar/{id}', [ProjetoController::class, 'associar'])->name('projetos.associar');
Route::delete('/projetos/remover/{discente}', [ProjetoController::class, 'remover'])->name('projetos.remover');
Route::post('/projetos', [ProjetoController::class, 'store'])->name('projetos-store');

Route::put('/projetos/{projeto}', [ProjetoController::class, 'update'])->name('projeto.update');
Route::get('/projetos/{projeto}/edit', [ProjetoController::class, 'edit'])->name('projetos.edit');
Route::delete('/projetos/{id}', [ProjetoController::class, 'destroy'])->name('projetos.destroy');
Route::get('/projetos/{id}', [ProjetoController::class, 'show'])->name('projetos.show');

// ** Rotas de Reuniões **
Route::get('/minhas-reunioes', [ReuniaoController::class, 'index'])->name('reuniao.index');
Route::get('/minhas-reunioes-discente', [ReuniaoController::class, 'indexDiscente'])->name('minhas-reunioes-discente');

Route::get('/reunioes', [ReuniaoController::class, 'create'])->name('reunioes.create');
Route::post('/reunioes', [ReuniaoController::class, 'store'])->name('reuniao.store');

Route::get('/reunioes/{reuniao}/edit', [ReuniaoController::class, 'edit'])->name('reuniao.edit');
Route::put('/reunioes/{reuniao}', [ReuniaoController::class, 'update'])->name('reuniao.update');
Route::delete('/reunioes/{reuniao}', [ReuniaoController::class, 'destroy'])->name('reuniao.destroy');

// ** Rotas de Discentes **
Route::get('/aluno', [DocenteController::class, 'index'])->name('index-aluno');
Route::get('/cadDiscente', function() {
    return view('sistema.cadastroDiscente');
});

Route::get('/docente/{id}/discentes', [DiscenteController::class, 'listarDiscentes'])->name('docente.discentes');

Route::get('/aluno/{id}/editDiscente', [DiscenteController::class, 'edit'])->name('discente.edit');
Route::put('/aluno/{id}/atualizar', [DiscenteController::class, 'update'])->name('discente.update');
Route::post('/cadDiscente', [DiscenteController::class, 'store'])->name('discente-store');
Route::get('/Discente', function() {
    return view('sistema.aluno-index');
})->name('inicioDiscente');
Route::get('discente/{id}', [DiscenteController::class, 'show'])->name('discente.show');

// ** Rotas de Áreas de Interesse **
Route::get('/cadArea', function() {
    return view('sistema.cadastroArea');
})->name('area-create');
Route::post('/cadArea', [AreaDeInteresseController::class, 'store'])->name('area-store');

// ** Outras Rotas**
Route::get('/docentes/{id}/', [DocenteController::class, 'show'])->name('docente-show');
Route::get('/reuniao', function() {
    return view('sistema.minhasReunioes');
})->name('minhas-reunioes');

Route::get('/reunioes/saiba-mais', function(){
    return view('sistema.saibaMaisReuniao');
})->name('saiba.reuniao');
