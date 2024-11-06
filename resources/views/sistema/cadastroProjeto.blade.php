@extends('layouts.app')
@section('title')
Cadastro Projeto
@endsection

@section('content')

  <div id="espacoProjeto">
       
     <form action="#" method="get">
        <h1 style="color:white">Crie um novo projeto</h1>
        <label for="matriz_tcc">Matriz TCC</label>
        <input type="file" name="matriz_tcc" id="matriz_tcc" class="form-control">
        <label for="tema">Tema</label>
        <input type="text" name="tema" id="tema" placeholder="Defina o título do teu projeto" class="form-control">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" id="descricao" placeholder="Adicione mais detalhes sobre o teu projeto" class="form-control">
        <label for="termo_compromisso">Termo Compromisso</label>
        <input type="file" name="termo_compromisso" id="termo_compromisso" class="form-control">
        <label for="data_termino">Data Termino</label>
        <input type="date" name="data_termino" id="data_termino" class="form-control">
        <button type="submit" class="btn btn-success">Criar Projeto</button>
     </form>

  </div>

@endsection