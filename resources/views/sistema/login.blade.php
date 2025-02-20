@extends('layouts.app')

@section('title')
Noctua-Login
@endsection

@section('content')
<div class="pai">
    <div class="banner">
        <h1 class="titulo">Noctua</h1>
        <img src="/storage/arquivos/coruja.jpg" alt="imagem de uma coruja">
        <p class="info">Encontre agora um orientador para o teu projeto!</p>
    </div>

    <div class="formulario">
        
        <form action="{{ route('login.store') }}" method="POST">
       
            @csrf
            <p style="font-size:20px">Acesso à plataforma</p>

            <!-- Campo de email -->
            <label for="identificacao">Identificação de usuário</label>
            @error('identificacao')
              <span>{{$message}}</span>
            @enderror
            <input type="text" name="identificacao" id="" placeholder="CPF OU SIAPE" class="form-control" required>

            <!-- Campo de senha -->
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Informe sua senha" class="form-control" required>

            <input type="submit" class="btn btn-success d-block mx-auto mt-4" value="Entrar">
            <a href="{{ route('coordenador.login') }}" class="btn btn-success d-block">Sou coordenador</a>

            <!-- Link de suporte -->
            <p class="link">Problemas no Login contate: serti.cb@ifms.edu.br</p>
        </form>
    </div>
</div>
@endsection