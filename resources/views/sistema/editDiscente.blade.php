@extends('layouts.app')
@section('title')
Editar Discente
@endsection

@section('content')

<div class="formCadDocente">
  <form action="{{route('discente.update', $discente->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h1>Edite seu cadastro</h1>
 <label for="nome">Nome</label>
 <input type="text" name="nome" id="nome" placeholder="Informe seu nome" class="form-control" value="{{ $discente-> nome}}">
 <label for="imagem">Foto de perfil</label>
 <input type="file" name="imagem" id="imagem" class="form-control" value=" {{ $discente-> imagem}}">
 <label for="email">E-mail</label>
 <input type="text" name="email" id="email" placeholder="Informe seu email" class="form-control" value="{{ $discente -> email}}">
 <label for="cpf">CPF</label>
 <input type="cpf" name="cpf" class="form-control" placeholder="Informe seu CPF" value="{{ $discente -> cpf}}">
 <button type="submit" class="btn btn-light">Editar Cadastro</button>
</form>
</div>


@endsection