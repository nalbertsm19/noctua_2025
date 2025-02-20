@extends('layouts.app')

@section('title', 'Perfil do Docente')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <!-- Card de Apresentação -->
    <div class="perfil-docente-card" style="width: 100%; max-width: 800px; padding: 20px; border-radius: 15px; background: #ecf0f1; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <!-- Foto de Perfil -->
        <div class="perfil-docente-imagem d-flex justify-content-center mb-4">
            <img src="{{ asset('storage/' . ($docente->foto_perfil ?? 'default-avatar.jpg')) }}" alt="Foto do docente" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <!-- Informações do Docente -->
        <div class="perfil-docente-info">
            <!-- Nome do Docente -->
            <h3 class="perfil-docente-nome" style="font-family: 'Arial', sans-serif; color: #2c3e50; text-align: center; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">{{ $docente->nome }}</h3>
            
            <!-- E-mail -->
            <p class="perfil-docente-email" style="font-size: 1.1rem; color: #34495e;">
                <strong>E-mail:</strong> {{ $docente->email }}
            </p>

            <!-- Formação -->
            <p class="perfil-docente-formacao" style="font-size: 1.1rem; color: #34495e;">
                <strong>Formação:</strong> {{ $docente->formacao }}
            </p>

            <!-- Descrição -->
            <p class="perfil-docente-descricao" style="font-size: 1.1rem; color: #34495e;">
                <strong>Descrição:</strong> {{ $docente->descricao }}
            </p>

            <!-- Botão de Ação -->
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('docente.show', $docente->id) }}" class="btn btn-secondary">Ver Mais</a>
            </div>
        </div>

        <!-- Seção de Projetos -->
        <div class="perfil-docente-projetos mt-5">
            <h4 class="text-center" style="color: #2c3e50;">Meus Projetos</h4>
            <div class="list-group mt-3">
                @forelse($docente->projetos as $projeto)
                    <div class="list-group-item" style="background: #ffffff; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 15px; margin-bottom: 10px;">
                        <h5 style="color:rgb(62, 137, 67); font-weight: bold;">{{ $projeto->tema }}</h5>
                        <p style="color: #555;">{{ $projeto->descricao }}</p>
                        <a href="{{ route('projetos.show', $projeto->id) }}" class="btn btn-sm btn-primary">Ver detalhes</a>
                    </div>
                @empty
                    <p class="text-center" style="color: #7f8c8d;">Nenhum projeto associado.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
