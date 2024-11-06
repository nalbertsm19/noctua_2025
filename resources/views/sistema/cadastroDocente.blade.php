@extends('layouts.app')
@section('title')
Cadastro Docentes
@endsection

@section('content')

<div class="formCadDocente">
  <form action="{{route('docente-store')}}" method="post" enctype="multipart/form-data" >
    @csrf
    <h1>Finalize seu cadastro</h1>
 <label for="nome">Nome</label>
 <input type="text" name="nome" id="nome" placeholder="Informe seu nome" class="form-control" value="{{old('nome')}}">
 @if ($errors->has('nome'))
          <span class="text-danger">{{ $errors->first('nome') }}</span>
 @endif

 <label for="foto_perfil">Foto de perfil</label>
 <input type="file" name="foto_perfil" id="imagem" value="{{old('foto_perfil')}}">
 @if ($errors->has('foto_perfil'))
          <span class="text-danger">{{ $errors->first('foto_perfil') }}</span>
 @endif

 <label for="email">E-mail</label>
 <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
 @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
@endif
 <label for="formacao">Formação acadêmica</label>
 <input type="text" name="formacao" class="form-control" placeholder="Informe sua formação acadêmica" value="{{old('formacao')}}">
 @if ($errors->has('formacao'))
          <span class="text-danger">{{ $errors->first('formacao') }}</span>
 @endif

 <label for="disponiblidade">Disponibilidade</label>
 <input type="number" name="disponibilidade" class="form-control" placeholder="Informe sua disponiblidade" value="{{old('disponibilidade')}}">
 @if ($errors->has('disponibilidade'))
          <span class="text-danger">{{ $errors->first('disponibilidade') }}</span>
 @endif
 <label for="suap">Suap</label>
 <input type="number" name="suap" class="form-control" value="{{old('suap')}}">
 @if ($errors->has('suap'))
          <span class="text-danger">{{ $errors->first('suap') }}</span>
@endif
 
 <label for="descricao">Descrição</label>
 <input type="text" name="descricao" placeholder="Adicone detalhes que gostaria de exibir na biografia" class="form-control" value="{{old('descricao')}}">
 @if ($errors->has('descricao'))
          <span class="text-danger">{{ $errors->first('descricao') }}</span>
 @endif
 
 <label for="curriculo_lates">Curriculo Lattes</label>
 <input type="text" name="curriculo_lates" placeholder="Adicione o link do seu Curriculo Lates" class="form-control" value="{{old('curriculo_lates')}}">
 @if ($errors->has('curriculo_lates'))
          <span class="text-danger">{{ $errors->first('curriculo_lates') }}</span>
@endif
 <button type="submit" class="btn btn-light">Finalizar Cadastro</button>
</form>
</div>
@endsection