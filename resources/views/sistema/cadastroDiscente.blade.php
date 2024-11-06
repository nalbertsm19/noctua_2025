@extends('layouts.app')
@section('title')
Cadastro Discente
@endsection

@section('content')

<div class="formCadDocente">
  <form action="{{route('discente-store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>Finalize seu cadastro</h1>
 <label for="nome">Nome</label>
 <input type="text" name="nome" id="nome" placeholder="Informe seu nome" class="form-control">
 <label for="imagem">Foto de perfil</label>
 <input type="file" name="imagem" id="imagem" class="form-control">
 <label for="email">E-mail</label>
 <input type="text" name="email" id="email" class="form-control">
 <label for="cpf">CPF</label>
 <input type="cpf" name="cpf" class="form-control" placeholder="Informe seu CPF">
 <button type="submit" class="btn btn-light">Finalizar Cadastro</button>
</form>
</div>


@endsection