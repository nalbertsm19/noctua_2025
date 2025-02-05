@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Reunião</h2>
    
    <!-- Exibe mensagens de erro ou sucesso -->
    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('storage/arquivos/corujinha.png') }}" alt="Corujinha assistente" class="corujinha" style="width: 120px; height: auto; margin-right: 10px; transform: rotate(-10deg); box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);">
                    <span style="font-size: 1.2em; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">{{ $error }}</span>
                    <a href="{{route('saiba.reuniao')}}" style="margin-left: 10px;">Saiba mais</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reuniao.update', $reuniao->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Indica que o método HTTP será PUT para atualizar -->

        <div class="form-group">
            <label for="id_projeto">Projeto</label>
            <select name="id_projeto" id="id_projeto" class="form-control" required>
                <option value="" disabled selected>Escolha um projeto</option>
                @foreach ($projetos as $projeto)
                    <option value="{{ $projeto->id }}" {{ $reuniao->id_projeto == $projeto->id ? 'selected' : '' }}>
                        {{ $projeto->tema }} <!-- Supondo que "nome" seja o campo do projeto -->
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dataHora">Data e Hora</label>
            <input 
                type="datetime-local" 
                name="dataHora" 
                id="dataHora" 
                class="form-control" 
                value="{{ $reuniao->dataHora ? \Carbon\Carbon::parse($reuniao->dataHora)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="form-group">
            <label for="resumo">Resumo</label>
            <textarea name="resumo" id="resumo" class="form-control" rows="3" required>{{ $reuniao->resumo }}</textarea>
        </div>

        <div class="form-group">
            <label for="statusReuniao">Status da Reunião</label>
            <select name="statusReuniao" id="statusReuniao" class="form-control" required>
                <option value="1" {{ $reuniao->status_reuniao == '1' ? 'selected' : '' }}>Agendada</option>
                <option value="2" {{ $reuniao->status_reuniao == '2' ? 'selected' : '' }}>Cancelada</option>
                <option value="3" {{ $reuniao->status_reuniao == '3' ? 'selected' : '' }}>Aluno Ausente</option>
                <option value="4" {{ $reuniao->status_reuniao == '4' ? 'selected' : '' }}>Finalizada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Reunião</button>
    </form>
</div>
@endsection
