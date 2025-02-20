@extends('layouts.app')

@section('content')
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            color: red;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <h2>Login do Coordenador</h2>
        
        @if($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('coordenador.autenticar') }}">
            @csrf
            <label for="codigo_acesso">Código de Acesso:</label>
            <input type="password" name="codigo_acesso" id="codigo_acesso" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
@endsection
