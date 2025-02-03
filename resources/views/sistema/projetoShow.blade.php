@extends('layouts.app')

@section('title', 'Detalhes do Projeto')

@section('content')
<div class="container-custom" style="display: flex; justify-content: center; align-items: center; height: 100vh; color: white;">
    <div class="card-card-custom">
        <div class="card-header" style="color:white;">
            <h3>{{ $projeto->tema }}</h3>
        </div>
        <div class="card-content-custom">
            <h5 class="card-title card-title-custom" style="color:white;">Descrição</h5>
            <p class="card-text card-text-custom" style="color:white;">{{ $projeto->descricao }}</p>

            <h5 class="card-title card-title-custom mt-4">Detalhes</h5>
            <ul class="list-group list-group-custom">
                <li class="list-group-item list-group-item-custom"><strong>Status:</strong> {{ ucfirst($projeto->statusProjeto) }}</li>
                <li class="list-group-item list-group-item-custom"><strong>Data de Término:</strong> 
                    {{ $projeto->data_termino ? \Carbon\Carbon::parse($projeto->data_termino)->format('d/m/Y') : 'Não definida' }}
                </li>
            </ul>

            @if($projeto->matriz_tcc)
                <div class="mt-4">
                    <h5 class="card-title card-title-custom">Matriz TCC</h5>
                    <a href="{{ asset('storage/' . $projeto->matriz_tcc) }}" class="btn btn-custom mb-2 icon-box" target="_blank" download>
                        <i class="fa fa-download" style="color:white;"></i> Baixar Matriz TCC
                    </a>
                    <button class="btn btn-custom mb-2 icon-box" id="showMatriz">
                        <i class="fa fa-eye" style="color:white;"></i> Exibir Matriz TCC
                    </button>
                </div>
            @else
                <p class="mt-4">Matriz TCC: Não disponível</p>
            @endif

            @if($projeto->termo_compromisso)
                <div class="mt-4">
                    <h5 class="card-title card-title-custom">Termo de Compromisso</h5>
                    <a href="{{ asset('storage/' . $projeto->termo_compromisso) }}" class="btn btn-custom mb-2 icon-box" target="_blank" download>
                        <i class="fa fa-download" style="color:white;"></i> Baixar Termo de Compromisso
                    </a>
                    <button class="btn btn-custom mb-2 icon-box" id="showTermo">
                        <i class="fa fa-eye" style="color:white;"></i> Exibir Termo de Compromisso
                    </button>
                </div>
            @else
                <p class="mt-4">Termo de Compromisso: Não disponível</p>
            @endif
        </div>

        <div class="card-footer d-flex justify-content-between" style="background-color:#32CD32; color:white;">
            <a href="{{ route('projetos.index') }}" class="btn btn-light">Voltar</a>
            <div>
                <a href="{{ route('projetos.edit', $projeto->id) }}" class="btn btn-primary me-2">Editar</a>
                <form action="{{ route('projetos.destroy', $projeto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Novo container ao lado para exibição dos documentos -->
    <div id="documentContainer" style="margin-left: 20px; width: 60%; display: none; background-color: white; padding: 20px;">
        <h5 id="documentTitle" style="color: black;"></h5>
        <div id="documentContent">
            <!-- O conteúdo do documento será inserido aqui dinamicamente -->
        </div>
    </div>
</div>

<script>
    // Exibir ou esconder Matriz TCC
    document.getElementById('showMatriz').addEventListener('click', function() {
        var container = document.getElementById('documentContainer');
        var title = document.getElementById('documentTitle');
        var content = document.getElementById('documentContent');

        if (container.style.display === 'none') {
            title.innerHTML = "Matriz TCC";
            content.innerHTML = '<iframe src="{{ asset('storage/' . $projeto->matriz_tcc) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>';
            container.style.display = 'block'; // Exibir o container ao lado
        } else {
            container.style.display = 'none'; // Esconder o container
        }
    });

    // Exibir ou esconder Termo de Compromisso
    document.getElementById('showTermo').addEventListener('click', function() {
        var container = document.getElementById('documentContainer');
        var title = document.getElementById('documentTitle');
        var content = document.getElementById('documentContent');

        if (container.style.display === 'none') {
            title.innerHTML = "Termo de Compromisso";
            content.innerHTML = '<iframe src="{{ asset('storage/' . $projeto->termo_compromisso) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>';
            container.style.display = 'block'; // Exibir o container ao lado
        } else {
            container.style.display = 'none'; // Esconder o container
        }
    });
</script>

@endsection
