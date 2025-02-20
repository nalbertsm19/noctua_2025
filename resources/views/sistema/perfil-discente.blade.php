@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-center">
        <!-- Card personalizado -->
        <div class="perfil-card shadow-lg rounded">
            <!-- Cabeçalho do card com título -->
            <div class="perfil-card-header">
                <h2 class="perfil-card-header-title">Meu Perfil</h2>
            </div>
            
            <!-- Foto e informações do discente -->
            <div class="perfil-card-body text-center">
                <img src="{{ asset('storage/' . ($discente->imagem ?? 'default-avatar.jpg')) }}" alt="Foto do discente" class="img-fluid rounded-circle perfil-card-img">
                <h5 class="perfil-card-title">{{ $discente->nome }}</h5>
                <p class="perfil-card-text">E-mail: <span>{{ $discente->email }}</span></p>
                <p class="perfil-card-text">E-mail: <span>{{ $discente->turma }}</span></p>
                <p class="perfil-card-text">CPF: <span>{{ $discente->cpf }}</span></p>
                <p class="perfil-card-text">Meu Projeto: <span>{{ $discente->projeto ? $discente->projeto->tema : 'Sem projeto' }}</span></p>
    
            </div>
        </div>
    </div>
    <style>
        .perfil-card {
            width: 25rem;
            border-radius: 20px;
            overflow: hidden;
            background: linear-gradient(to bottom right, #4CAF50, #388E3C); /* Gradiente verde */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .perfil-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        /* Cabeçalho com título */
        .perfil-card-header {
            background-color: #388E3C; /* Verde mais escuro para o cabeçalho */
            padding: 20px;
            text-align: center;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .perfil-card-header-title {
            color: white;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Imagem do discente */
        .perfil-card-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff; /* Borda branca */
            margin-top: -50px; /* Ajuste para que fique sobre o cabeçalho */
        }

        /* Corpo do card */
        .perfil-card-body {
            padding: 25px;
            background-color: #ffffff;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .perfil-card-title {
            font-size: 1.25rem;
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .perfil-card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }

        .perfil-card-text span {
            font-weight: 500;
            color: #388E3C; /* Verde escuro para as informações */
        }
    </style>


</div>


@endsection