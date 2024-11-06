@extends('layouts.app')
@section('title')
index-aluno
@endsection

@section('content')
<div class="menuAluno">

 <input type="text" placeholder="Encontre seu orientador, insira o nome aqui" class="inputAluno" >

 <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
    </svg>
   
 <nav>
    <a href="#">Minhas reuniões</a>
    <a href="#">Meu projeto</a>
 </nav>
 
 <div class="fotoAluno">
 
    <a href="#">
        <img src="/storage/imagens/perfi.jpeg" alt="Foto" max-width="50px" height="10px">
    </a>
 </div>

</div>

 

<div>
    <h1 class="tituloIndexAluno">Orientadores</h1>

    <div class="cardProf">
        @foreach ($docente as $professor)
        
                <div class="card-body">
                <img src="{{ asset('storage/' . $professor->foto_perfil) }}" alt="Foto de perfil">
                <h5 class="card-title">{{ $professor->nome }}</h5>
                    <label for="formacao">Formação</label>
                    <p class="card-text">{{ $professor->formacao }}</p>
                    <p class="card-disponibilidade">{{ $professor->disponibilidade}}</p>
                    <p class="card-vagas"><strong>Vagas para Orientação</strong></p>
                  
                    <form action="#" method="get">
                    <button type="submit" class="btn btn-success">Saiba Mais</button>
                    </form>
                </div>
         
        @endforeach
   </div>

</div>

</div>


@endsection