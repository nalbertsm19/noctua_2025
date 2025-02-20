@extends('layouts.app')

@section('content')
    <h1 class="text-center" style="color: #28a745;">Bem-vindo, Coordenador!</h1>

    <div class="container mt-4">
        <nav class="menuCoordenador">
        <a href="{{ route('coordenador.relatorio') }}" class="btn btn-success">Gerar Relatório</a>

            <p class="btn btn-success">Filtrar Dados</p> 
        </nav>

        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Tema do Projeto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Status do Projeto</th>
                        <th scope="col">Discente</th>
                        <th scope="col">Docente</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projetos as $projeto)
                        <tr>
                            <td>{{ $projeto->tema }}</td>
                            <td>{{ $projeto->descricao }}</td> 
                            <td>
                                <span class="badge 
                                    @if($projeto->statusProjeto == 'Concluído') 
                                        bg-success 
                                    @elseif($projeto->statusProjeto == 'Pendente') 
                                        bg-warning 
                                    @else
                                        bg-secondary
                                    @endif
                                ">
                                    {{ $projeto->statusProjeto }}
                                </span>
                            </td>
                            <td>
                                @if($projeto->discente)
                                    {{ $projeto->discente->nome }}
                                @else
                                    Nenhum discente associado
                                @endif
                            </td>
                            <td>
                                @foreach($projeto->docentes as $docente)
                                    <p>{{ $docente->nome }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum projeto encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
