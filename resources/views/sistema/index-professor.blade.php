@extends('layouts.app');
@section('title')
index-professor
@endsection

@section('content')


<nav class="menuProfessor">
    <a href="#">Meus orientandos</a>
    <a href="#">Minhas reuniões</a>
    <a href="#">Meu perfi</a>
</nav>

<div class="cardsIndexProf d-flex flex-wrap justify-content-around">
     <a href="/meus-orientandos" class="card-link">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/storage/arquivos/orie.jpg" alt="Card image cap">
        <div class="card-boddy">
            <h1>Meus orientandos</h1>
            <p class="card-text">Confira aqui as informações relacionadas aos seus orientandos</p>
        </div>
    </div>
    </a>
    <a href="/minhas-reunioes" class="card-link">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/storage/arquivos/reuniao.jpg" alt="Card image cap">
        <div class="card-boddy">
            <h1>Minhas reuniões</h1>
            <p class="card-text">Aqui você pode atualizar, editar 
uma nova reunião
</p>
        </div>
    </div>
    </a>
    <a href="/meu-perfil" class="card-link">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="/storage/arquivos/perfi.jpg" alt="Card image cap">
        <div class="card-boddy">
            <h1>Meu Perfil</h1>
            <p class="card-text">Ajude seus orientadores a saber mais
 de você! Deixe seu perfil mais
completo aqui</p>
        </div>
    </div>
    </a>
</div>

@endsection