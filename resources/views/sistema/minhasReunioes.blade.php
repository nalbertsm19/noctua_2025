@extends('layouts.app')

@section('title', 'Minhas Reuniões')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-success" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">
        <i class="fas fa-calendar-check me-2"></i>Minhas Reuniões
    </h1>

    @if (Auth::user()->role == 'docente')
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('reunioes.create') }}" class="btn btn-success shadow">
                <i class="fas fa-plus-circle me-2"></i>Criar Nova Reunião
            </a>
            <a href="{{ route('calendario.index') }}" class="btn btn-primary shadow">
                <i class="fas fa-calendar-alt me-2"></i>Ver Calendário
            </a>
        </div>
        @endif
  

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    {{-- Filtro por data --}}
    <form action="{{ route('reuniao.index') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <label for="data" class="form-label">Filtrar por Data:</label>
                <input type="date" name="data" id="data" class="form-control" value="{{ request('data') }}">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
            <div class="col-md-2 align-self-end">
                <a href="{{ route('reuniao.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Limpar Filtro
                </a>
            </div>
        </div>
    </form>

    {{-- Verificação para garantir que a variável $reunioes não esteja indefinida --}}
    @php
        $reunioes = $reunioes ?? collect();
    @endphp

    @if ($reunioes->isEmpty())
        <p class="text-muted text-center">
            {{ Auth::user()->role == 'docente' ? 'Você ainda não agendou nenhuma reunião.' : 'Sem reuniões, aguarde seu orientador agendar uma nova reunião.' }}
        </p>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered rounded shadow">
                <thead class="bg-success text-white">
                    <tr>
                        <th>#</th>
                        <th>Data e Hora</th>
                        <th>Resumo</th>
                        <th>Status</th>
                        <th>Projeto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reunioes as $reuniao)
                        @php
                            $dataPassou = \Carbon\Carbon::parse($reuniao->dataHora)->isPast();
                            $precisaAtualizar = $dataPassou && $reuniao->status_reuniao == 1;
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($reuniao->dataHora)->format('d/m/Y H:i') }}</td>
                            <td>{{ $reuniao->resumo }}</td>
                            <td>
                                @switch($reuniao->status_reuniao)
                                    @case(1)
                                        <span class="badge bg-warning text-dark">Agendada</span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-danger">Cancelada</span>
                                        @break
                                    @case(3)
                                        <span class="badge bg-info">Aluno Ausente</span>
                                        @break
                                    @case(4)
                                        <span class="badge bg-primary">Finalizada</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">Indefinido</span>
                                @endswitch
                            </td>
                            <td>{{ $reuniao->projeto->tema }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if ($precisaAtualizar)
                                        <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
                                            <strong>Atenção!</strong> A reunião agendada já passou! Por favor, atualize as informações.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <a href="{{ route('reuniao.edit', $reuniao->id) }}" class="btn btn-sm btn-warning shadow">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('reuniao.destroy', $reuniao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta reunião?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endpush
