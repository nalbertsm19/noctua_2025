@extends('layouts.app')

@section('title', 'Minhas Reuniões')

@section('content')
<div class="container mt-5">
   
    <h1 class="mb-4" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); color: #28a745;">
    <i class="fas fa-calendar-check me-2 text-success"></i>Minhas Reuniões
</h1>

    <!-- Botão para criar nova reunião -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('reunioes.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>Criar Nova Reunião
        </a>
    </div>

    <!-- Mensagens de sucesso ou erro -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <!-- Verifica se há reuniões -->
    @if ($reunioes->isEmpty())
        <p>Você ainda não agendou nenhuma reunião. <a href="{{ route('reunioes.create') }}">Clique aqui</a> para agendar sua primeira reunião.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-light">
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
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($reuniao->dataHora)->format('d/m/Y H:i') }}</td>
                        <td>{{ $reuniao->resumo }}</td>
                        <td>
                            @switch($reuniao->status_reuniao)
                                @case(1)
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                    @break
                                @case(2)
                                    <span class="badge bg-success">Confirmada</span>
                                    @break
                                @case(3)
                                    <span class="badge bg-info">Concluída</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">Indefinido</span>
                            @endswitch
                        </td>
                        <td>{{ $reuniao->projeto->tema }}</td>
                        <td>
                            <div class="d-flex">
                                <!-- Botão de editar com ícone -->
                                <a href="{{ route('reuniao.edit', $reuniao->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                
                                <!-- Botão de excluir com ícone -->
                                <form action="{{ route('reuniao.destroy', $reuniao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta reunião?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

<!-- Adicione esta parte para carregar o Font Awesome -->
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endpush
