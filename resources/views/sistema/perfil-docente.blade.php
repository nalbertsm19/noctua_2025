@extends('layouts.app')

@section('title', 'Perfil do Docente')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card d-flex flex-row" style="width: 100%; padding: 70px;">
        <!-- Foto de Perfil -->
        <div class="d-flex justify-content-center align-items-center" style="margin-right: 20px;">
            <img src="{{ asset('storage/' . ($docente->foto_perfil ?? 'default-avatar.jpg')) }}" alt="Foto do docente" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <!-- Informações do Docente -->
        <div class="card-body" style="flex: 2;">
            <h3 class="card-title">{{ $docente->nome }}</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('perfil-docente.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <!-- Tornar o campo de nome somente leitura -->
                    <input type="text" id="nome" name="nome" class="form-control form-control-lg" value="{{ $docente->nome }}" readonly>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <!-- Tornar o campo de e-mail maior -->
                    <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ $docente->email }}" required>
                </div>

                <div class="form-group">
                    <label for="formacao">Formação</label>
                    <!-- Tornar o campo de formação maior -->
                    <input type="text" id="formacao" name="formacao" class="form-control form-control-lg" value="{{ $docente->formacao }}" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <!-- Tornar o campo de descrição maior -->
                    <textarea id="descricao" name="descricao" class="form-control form-control-lg" rows="4" required>{{ $docente->descricao }}</textarea>
                </div>

                <div class="form-group">
                    <label for="foto_perfil">Foto de Perfil</label>
                    <input type="file" id="foto_perfil" name="foto_perfil" class="form-control form-control-lg">
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Salvar Alterações</button>
            </form>
        </div>
    </div>
</div>
@endsection
