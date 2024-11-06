@extends('layouts.app')
@section('title')
Cadastro de Áreas de Interesse
@endsection

@section('content')
  <div class="cadastrarForm">
  <form action="#" method="post">
    <h1>Cadastre suas Areas de Interesse</h1>
  <form action="{{route('area-store')}}" method="post">
  @csrf
    <label for="nome" style="font-size:18px">Descrição:</label>
    <input type="text" id="nome" name="nome" required class="descArea" placeholder="Informe o nome da sua area interesse">
    <button type="submit" class="btn btn-success" class="btnsalvar">Salvar</button>
    
  </form>

  </form>
  </div>
@endsection