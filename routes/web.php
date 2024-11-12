<?php

use App\Http\Controllers\AreaDeInteresseController;
use App\Http\Controllers\DiscenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ReuniaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
{
    return view('sistema.login');
})->name('inicio');

Route::get('/prof', function()
{
    return view('sistema.index-professor');
})->name('indexProfessor');

Route::get('/cadDocente', function(){
     return view('sistema.cadastroDocente');
});

Route::post('cadDocente', [DocenteController::class, 'store'])->name('docente-store');
Route::get('/prof/{id}/editDocente', [DocenteController::class,  'edit'])->name('docente.edit');
Route::put('/prof/{id}/atualizar', [DocenteController::class, 'update'])->name('docente.update');

Route::get('/cadProjeto', [ProjetoController::class, 'index'])->name('projeto-index');

Route::post('/cadReuniao', [ReuniaoController::class, 'store'])->name('reuniao-store');

Route::get('/aluno',[DocenteController::class, 'index'])->name('index-aluno');

Route::get('/cadDiscente', function(){
      return view('sistema.cadastroDiscente');
});
Route::get('/aluno/{id}/editDiscente', [DiscenteController::class,  'edit'])->name('discente.edit');
Route::put('/aluno/{id}/atualizar', [DiscenteController::class, 'update'])->name('discente.update');
Route::post('/cadDiscente',[DiscenteController::class, 'store'])->name('discente-store');
Route::get('/Discente', function(){
 return view('sistema.aluno-index');
})->name('inicioDiscente');

Route::get('/cadArea', function()
{ return view('sistema.cadastroArea');
})->name('area-create');

Route::get('/cadReuniao',[ReuniaoController::class, 'create' ])->name('reuniao.create');

Route::post('/cadArea', [AreaDeInteresseController::class, 'store'])->name('area-store');
