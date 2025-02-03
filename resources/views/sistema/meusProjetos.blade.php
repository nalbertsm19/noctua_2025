@extends('layouts.app')

@section('title', 'Meus Projetos')

@section('content')
    <!-- Menu de navegação -->
    

    <!-- Bloco para o menu de ações e cadastro -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-4">
            <h2>Meus Projetos</h2>
            <!-- Botão de cadastrar aparece apenas para docentes -->
            @if(Auth::user()->docente)
                <a href="{{ route('cadastro-projeto') }}" class="btn btn-success">Cadastrar Novo Projeto</a>
            @endif
        </div>

        <!-- Exibindo a lista de projetos -->
        @if($projetos->isEmpty())
            <p>Não há projetos disponíveis.</p>
        @else
            <div class="list-group">
                @foreach($projetos as $projeto)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <!-- Conteúdo clicável -->
                        <a href="{{ route('projetos.show', $projeto->id) }}" class="projeto-link flex-grow-1 text-decoration-none text-dark">
                            <div>
                                <h5>{{ $projeto->tema }}</h5>
                                <p class="mb-0">{{ Str::limit($projeto->descricao, 100) }}</p>
                            </div>
                        </a>
                        
                        <!-- Botões de ação -->
                        <div class="d-flex align-items-center">
                            @if(Auth::user()->docente)
                                <!-- Apenas docentes podem editar e excluir -->
                                <a href="{{ route('projetos.edit', $projeto->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                                <form action="{{ route('projetos.destroy', $projeto->id) }}" method="POST" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            @elseif(Auth::user()->discente)
                                <!-- Apenas discentes veem o botão de associação -->
                                <a href="{{ route('projetos.associar', $projeto->id) }}" class="btn btn-sm btn-secondary">Me associar a esse projeto</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection