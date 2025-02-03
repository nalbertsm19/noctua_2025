@extends('layouts.app')

@section('title', 'Cadastro Projeto')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="espacoProjeto">
    <form action="{{ route('projetos-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 style="color:white">Crie um novo projeto</h1>
        
        <!-- Campo para upload da matriz TCC -->
        <label for="matriz_tcc">Matriz TCC</label>
        <input type="file" name="matriz_tcc" id="matriz_tcc" class="form-control" required>

        <!-- Campo para o tema do projeto -->
        <label for="tema">Tema</label>
        <input type="text" name="tema" id="tema" placeholder="Defina o título do teu projeto" class="form-control" required>

        <!-- Campo para a descrição do projeto -->
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" placeholder="Adicione mais detalhes sobre o teu projeto" class="form-control" required></textarea>

        <!-- Campo para upload do termo de compromisso -->
        <label for="termo_compromisso">Termo Compromisso</label>
        <input type="file" name="termo_compromisso" id="termo_compromisso" class="form-control" required>

        <!-- Campo para data de término do projeto -->
        <label for="data_termino">Data Término</label>
        <input type="date" name="data_termino" id="data_termino" class="form-control">

        <!-- Campo oculto para o ID do docente logado -->
        <input type="hidden" name="docente_id" value="{{ auth()->user()->id }}">

        <button type="submit" class="btn btn-success mt-3">Criar Projeto</button>
    </form>
</div>

@endsection
