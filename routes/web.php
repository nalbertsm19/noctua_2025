<?php

use App\Http\Controllers\AreaDeInteresseController;
use App\Http\Controllers\DiscenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ReuniaoController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\AuthController; // Adicionado o controlador de autenticação
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rota para a página de login
Route::get('/', function () {
    return view('sistema.login');
})->name('inicio');

// Rota para a autenticação de login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rota para a página inicial do coordenador, protegida pelo middleware 'coordenador'
Route::middleware('coordenador')->group(function () {
    Route::get('/coordenador', function() {
        return view('sistema.coordenacao-index');
    })->name('coordenador-inicio');

    // Outras rotas para o coordenador
    Route::get('/coordenador/relatorio', [CoordenadorController::class, 'gerarRelatorio'])->name('coordenador.relatorio');
    Route::get('/coordenador/filtrar', [CoordenadorController::class, 'filtrarDados'])->name('coordenador.filtrar');
});

// Demais rotas
Route::get('/prof', function() {
    return view('sistema.index-professor');
})->name('indexProfessor');

Route::get('/cadDocente', function() {
    return view('sistema.cadastroDocente');
});
Route::post('cadDocente', [DocenteController::class, 'store'])->name('docente-store');
Route::get('/prof/{id}/editDocente', [DocenteController::class, 'edit'])->name('docente.edit');
Route::put('/prof/{id}/atualizar', [DocenteController::class, 'update'])->name('docente.update');
Route::get('docente/{id}', [DocenteController::class, 'show'])->name('docente.show');

Route::get('/Projeto', [ProjetoController::class, 'index'])->name('projeto-index');

Route::post('/cadReuniao', [ReuniaoController::class, 'store'])->name('reuniao-store');

Route::get('/aluno', [DocenteController::class, 'index'])->name('index-aluno');
Route::get('/cadDiscente', function() {
    return view('sistema.cadastroDiscente');
});
Route::get('/aluno/{id}/editDiscente', [DiscenteController::class, 'edit'])->name('discente.edit');
Route::put('/aluno/{id}/atualizar', [DiscenteController::class, 'update'])->name('discente.update');
Route::post('/cadDiscente', [DiscenteController::class, 'store'])->name('discente-store');
Route::get('/Discente', function() {
    return view('sistema.aluno-index');
})->name('inicioDiscente');
Route::get('discente/{id}', [DiscenteController::class, 'show'])->name('discente.show');

Route::get('/cadArea', function() {
    return view('sistema.cadastroArea');
})->name('area-create');

Route::get('/cadReuniao', [ReuniaoController::class, 'create'])->name('reuniao.create');

Route::post('/cadArea', [AreaDeInteresseController::class, 'store'])->name('area-store');

// Outras rotas de docentes, reuniões e projetos
Route::get('/docentes/{id}/', [DocenteController::class, 'show'])->name('docente-show');

Route::get('/reuniao', function() {
    return view('sistema.minhasReunioes');
})->name('minhas-reunioes');

Route::get('/cadProjeto', function() {
    return view('sistema.cadastroProjeto');
});
