@extends('layouts.app')

@section('title')
index-professor
@endsection

@section('content')



<!-- Bloco de boas-vindas com efeito de luz -->
<div id="boas-vindas" class="boas-vindas position-relative p-3 border rounded">
    <!-- Ícone de fechamento -->
    <span id="fechar-boas-vindas" class="fechar-boas-vindas position-absolute" 
          style="top: 10px; right: 10px; cursor: pointer; font-size: 20px; font-weight: bold; color: red;">&times;</span>

    <div class="d-flex align-items-center">
        <!-- Imagem da corujinha com animação -->
        <img src="/storage/arquivos/corujinha.png" alt="Corujinha fofinha" class="corujinha" style="width: 120px; height: auto; margin-right: 10px;">
        <p class="saudacao mb-0">Olá, {{ Auth::user()->name }}!</p>
    </div>
    <p class="mensagem-boas-vindas">Seja bem-vindo à plataforma! Aqui você pode gerenciar suas reuniões, orientandos e muito mais.</p>
</div>

<!-- Cards com layout moderno -->
<div class="cardsIndexProf d-flex flex-wrap justify-content-around">
    <a href="/meus-orientandos" class="card-link">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/arquivos/orie.jpg" alt="Card image cap">
            <div class="card-body">
                <h1>Meus orientandos</h1>
                <p class="card-text">Confira aqui as informações relacionadas aos seus orientandos</p>
            </div>
        </div>
    </a>
    <a href="{{ route('minhas-reunioes') }}" class="card-link">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/arquivos/reuniao.jpg" alt="Card image cap">
            <div class="card-body">
                <h1>Minhas reuniões</h1>
                <p class="card-text">Aqui você pode atualizar, editar uma nova reunião</p>
            </div>
        </div>
    </a>
    <a href="{{ route('perfil-docente') }}" class="card-link">
        <div class="card" style="width: 18rem;">
            <!-- Foto do docente -->
            <img class="card-img-top" src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto do docente" style="width: 220px; height: 220px; object-fit: cover; border-radius: 50%; margin: 0 auto; display: block;">
            <div class="card-body">
                <h1>Meu Perfil</h1>
                <p class="card-text">Ajude seus orientadores a saber mais de você! Veja e edite suas informações aqui</p>
            </div>
        </div>
    </a>
</div>

<!-- Script para ocultar a mensagem -->
<script>
    document.getElementById('fechar-boas-vindas').addEventListener('click', function() {
        document.getElementById('boas-vindas').style.display = 'none';
    });

    // Efeito de luzes para a mensagem de boas-vindas
    const boasVindas = document.querySelector('.mensagem-boas-vindas');
    boasVindas.classList.add('luzes');
</script>

<!-- Estilos personalizados -->
<style>
    /* Efeito de luzes para a mensagem de boas-vindas */
    .luzes {
        animation: glow 1.5s ease-in-out infinite alternate;
    }

    @keyframes glow {
        0% {
            color: #fff;
            text-shadow: 0 0 5px #fff, 0 0 10pxrgb(63, 193, 148), 0 0 15pxrgb(124, 177, 113), 0 0 20px #ff0000;
        }
        50% {
            color: #fff;
            text-shadow: 0 0 5px #ff00ff, 0 0 10px #ff00ff, 0 0 15px #ff0000, 0 0 20px #ff0000;
        }
        100% {
            color: #fff;
            text-shadow: 0 0 5px #00ffff, 0 0 10px #00ffff, 0 0 15px #ff0000, 0 0 20px #ff0000;
        }
    }
    /* Movimento suave da imagem da corujinha */
    .corujinha {
        animation: moverCorujinha 3s ease-in-out infinite alternate;
    }

    @keyframes moverCorujinha {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(15px);
        }
        100% {
            transform: translateX(0);
        }
    }

    /* Ajustando o layout dos cards */
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
</style>

@endsection
