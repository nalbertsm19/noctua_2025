@extends('layouts.app')

@section('title')
Criar Reunião
@endsection

@section('content')
<div id="espacoReuniao">
<a href="{{route('saiba.reuniao')}}" class="btn btn-danger">Conheça as restrições para reuniões</a>
<form action="{{ route('reuniao.store') }}" method="post">
    @csrf
    <h1 style="color:white">Crie uma nova Reunião</h1>
   
    <!-- Campo Projeto -->
    <label for="id_projeto">Projeto:</label>
    <select name="id_projeto" id="id_projeto" class="form-control" required>
        @foreach($projetos as $projeto)
            <option value="{{ $projeto->id }}">{{ $projeto->tema }}</option>
        @endforeach
    </select>
    @error('id_projeto')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!-- Data e Hora da Reunião -->
    <label for="dataHora">Data Hora:</label>
    <input type="datetime-local" name="dataHora" id="dataHora" class="form-control" required>
    @error('dataHora')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!-- Objetivo da Reunião -->
    <label for="resumo">Objetivo:</label>
    <input type="text" name="resumo" id="resumo" class="form-control" required>
    @error('resumo')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!-- Campo Oculto para o ID do Docente -->
    <input type="hidden" name="id_docente" value="{{ Auth::user()->docente->id }}">

    <!-- Botão de Submissão -->
    <button type="submit" class="btn btn-success">Criar Reunião</button>
</form>

</div>
@endsection
