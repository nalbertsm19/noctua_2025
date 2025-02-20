<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Noctua</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('storage/arquivos/corujinha.png') }}">

    
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

   
      <!-- FullCalendar JS -->
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    

    
</body>
</html>
