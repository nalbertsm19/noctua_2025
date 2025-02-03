@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Projeto</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projeto.update', $projeto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tema" class="form-label">Tema</label>
            <input type="text" class="form-control" id="tema" name="tema" value="{{ $projeto->tema }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required>{{ $projeto->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label for="matriz_tcc" class="form-label">Matriz TCC (Arquivo PDF/DOC)</label>
            <input type="file" class="form-control" id="matriz_tcc" name="matriz_tcc">
        </div>

        <div class="mb-3">
            <label for="termo_compromisso" class="form-label">Termo de Compromisso (Arquivo PDF/DOC)</label>
            <input type="file" class="form-control" id="termo_compromisso" name="termo_compromisso">
        </div>

        <div class="mb-3">
            <label for="data_termino" class="form-label">Data de Término</label>
            <input type="date" class="form-control" id="data_termino" name="data_termino" value="{{ $projeto->data_termino }}">
        </div>

        <div class="mb-3">
            <label for="statusProjeto" class="form-label">Status do Projeto</label>
            <select class="form-control" id="statusProjeto" name="statusProjeto">
                <option value="Em andamento" {{ $projeto->statusProjeto == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                <option value="Concluído" {{ $projeto->statusProjeto == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                <option value="Pendente" {{ $projeto->statusProjeto == 'Pendente' ? 'selected' : '' }}>Pendente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@endsection
