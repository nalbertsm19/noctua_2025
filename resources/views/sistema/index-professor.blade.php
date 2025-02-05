@extends('layouts.app')

@section('title')
index-professor
@endsection

@section('content')

<!-- Bloco de boas-vindas -->
<div id="boas-vindas" class="boas-vindas position-relative p-3 border rounded">
    <span id="fechar-boas-vindas" class="fechar-boas-vindas position-absolute" 
          style="top: 10px; right: 10px; cursor: pointer; font-size: 20px; font-weight: bold; color: red;">&times;</span>

    <div class="d-flex align-items-center">
        <img src="/storage/arquivos/corujinha.png" alt="Corujinha assistente" class="corujinha" style="width: 120px; height: auto; margin-right: 10px;">
        <p class="saudacao mb-0">Bem-vindo(a), {{ Auth::user()->name }}!</p>
    </div>
</div>



<!-- Cards principais -->
<div class="custom-cards-container">
    <!-- Card 1: Meus Projetos -->
    <a href="{{ route('projetos.index') }}" class="custom-card">
        <div class="custom-card-image">
            <img src="/storage/arquivos/imgProjeto.jpg" alt="Imagem do projeto">
        </div>
        <div class="custom-card-body">
            <h2>Meus Projetos</h2>
            <p>Aqui você pode gerenciar todos os projetos</p>
        </div>
    </a>

    <!-- Card 2: Minhas Reuniões -->
    <a href="{{ route('reuniao.index') }}" class="custom-card">
        <div class="custom-card-image">
            <img src="/storage/arquivos/reuniao.jpg" alt="Imagem do projeto">
        </div>
        <div class="custom-card-body">
            <h2>Minhas Reuniões</h2>
            <p>Aqui você pode atualizar e editar uma nova reunião</p>
        </div>
    </a>

    <!-- Card 3: Meu Perfil -->
    <a href="{{ route('perfil-docente') }}" class="custom-card">
        <div class="custom-card-image">
            <img src="/storage/arquivos/perfi.jpg" alt="Imagem do projeto">
        </div>
        <div class="custom-card-body">
            <h2>Meu Perfil</h2>
            <p>Ajude seus orientadores a saber mais de você! Veja e edite suas informações aqui</p>
        </div>
    </a>
</div>

<!-- Corujinha fixa no canto da tela -->
<div id="corujinha-assistente" class="corujinha-assistente">
    <img src="/storage/arquivos/corujinha.png" alt="Corujinha assistente" class="corujinha-fixed">
    <div class="mensagem-assistente">
        <p>Olá, eu sou a Noctua! Precisa de ajuda?</p>
        <div class="botoes-assistente">
            <a href="{{route('cadastro-projeto')}}" class="btn-assistente">Cadastrar Projeto</a>
            <a href="{{route('reunioes.create')}}" class="btn-assistente">Cadastrar Reunião</a>
            <a href="{{route('area-create')}}" class="btn-assistente">Cadastrar Área de Interesse</a>
        </div>
    </div>
    <!-- Ícone de Fechar -->
    <span id="fechar-corujinha" class="fechar-assistente" style="position: absolute; top: 10px; right: 10px; font-size: 18px; cursor: pointer; color: white;">&times;</span>
</div>

<!-- Script para ocultar a mensagem -->
<script>
    // Fechar o bloco de boas-vindas
    document.getElementById('fechar-boas-vindas').addEventListener('click', function() {
        document.getElementById('boas-vindas').style.display = 'none';
    });

    // Fechar a corujinha assistente
    document.getElementById('fechar-corujinha').addEventListener('click', function() {
        document.getElementById('corujinha-assistente').style.display = 'none';
    });
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
            text-shadow: 0 0 5px #fff, 0 0 10px rgb(63, 193, 148), 0 0 15px rgb(124, 177, 113), 0 0 20px #ff0000;
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

    /* Corujinha fixa no canto da tela */
    .corujinha-assistente {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 10px 15px;
        border-radius: 50px;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    .corujinha-fixed {
        width: 60px;
        height: auto;
        margin-right: 10px;
    }

    .mensagem-assistente {
        max-width: 200px;
        text-align: left;
    }

    .mensagem-assistente p {
        font-size: 16px;
        margin: 0;
    }

    .botoes-assistente {
        margin-top: 10px;
    }

    .btn-assistente {
        display: block;
        margin: 5px 0;
        padding: 8px 15px;
        text-align: center;
        background-color: #63c18b;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .btn-assistente:hover {
        background-color: #4e9b6f;
    }

    /* Estilos para os cards */
    .custom-cards-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin: 20px auto; 
        padding: 0 40px; 
        max-width: 1200px; 
        flex-wrap: wrap;
    }

    .custom-card {
        display: block;
        width: calc(33.333% - 20px);
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .custom-card-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 4px solid #f1f1f1;
    }

    .custom-card-body {
        padding: 15px;
        text-align: center;
        min-height: 160px;
    }

    .custom-card-body h2 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }

    .custom-card-body p {
        font-size: 1rem;
        color: #777;
    }

    @media (max-width: 768px) {
        .custom-card {
            width: calc(50% - 20px);
        }
    }

    @media (max-width: 480px) {
        .custom-card {
            width: 100%;
        }
    }
</style>

@endsection
