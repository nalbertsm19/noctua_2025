@extends('layouts.app')

@section('title', 'Cadastro Discente')

@section('content')

<div class="formCadDocente">
    <form action="{{ route('discente-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1>Finalize seu cadastro</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Informe seu nome" class="form-control" value="{{ old('nome') }}">
        @error('nome')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="imagem">Foto de perfil</label>
        <input type="file" name="imagem" id="imagem" class="form-control">
        @error('imagem')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Informe seu CPF" value="{{ old('cpf') }}">
        @error('cpf')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="turma">Turma</label>
        <input type="text" name="turma" id="turma" class="form-control" placeholder="Informe sua turma" value="{{ old('turma') }}">
        @error('turma')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="password">Senha</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Informe sua senha">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-light">Finalizar Cadastro</button>
    </form>
</div>

@endsection
