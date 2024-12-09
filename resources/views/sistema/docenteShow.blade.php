@extends('layouts.app')
@section('title')
Docente- detalhes
@endsection

@section('content')
<div class="card-showProf">
                <img src="{{ asset('storage/' . $docentes->foto_perfil) }}" alt="Foto de perfil">
                <h5 class="card-title">{{ $docentes->nome }}</h5>
                    <label for="formacao">Formação</label>
                    <p class="card-text">{{ $docentes->formacao }}</p>
                    <p class="card-disponibilidade">{{ $docentes->disponibilidade}}</p>
                    <p class="card-vagas"><strong>Vagas para Orientação</strong></p>
                    <label for="descricao"><strong>Descricao</strong></label>
                    <p class="card-text">{{$docentes->descricao}}</p>
                    <label for="curriculo_lates"><strong>Curriculo lates</strong></label>
                    <p class="card-text">{{$docentes->curriculo_lates}}</p>
                    <label for="curriculo_lates"><strong>SUAP</strong></label>
                    <p class="card-text">{{$docentes->suap}}</p>
                    <label for="email"><strong>EMAIL</strong></label>
                    <p class="card-text">{{$docentes->email}}</p>
</div>
@endsection