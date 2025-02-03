<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistema de Busca de Orientadores</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    {{-- Exibir header e menu apenas se a rota atual não for a de login --}}
    @if (Route::currentRouteName() !== 'inicio')
        {{-- Header sempre incluído exceto no login --}}
        @include('components.header')

        {{-- Exibição do menu com base no tipo de usuário logado --}}
        @if (Auth::check())
            @if (Auth::user()->role === 'discente')
                @include('components.menuAluno')
            @elseif (Auth::user()->role === 'docente')
                @include('components.menuProfessor')
            @endif
        @endif
    @endif

    {{-- Conteúdo dinâmico da página --}}
    @yield('content')

    {{-- Footer sempre incluído --}}
    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
