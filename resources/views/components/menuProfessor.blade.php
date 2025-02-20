<style>
    /* Mantém o menu normal no desktop */
    @media (min-width: 992px) {
        .menuProfessor {
            display: flex !important;
        }
        .menu-button, .menuMobile, .menu-back {
            display: none !important;
        }
    }

    /* No mobile, esconde o menu normal e ativa a setinha + botão circular */
    @media (max-width: 991px) {
        .menuProfessor {
            display: none !important;
        }

        /* Garantindo que o header tenha um espaçamento adequado */
        header {
            position: relative;
            padding: 15px 0;
        }

        /* Posicionando os elementos no mesmo local do menu desktop */
        .menu-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 15px;
        }

        /* Seta de voltar */
        .menu-back {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color:rgb(65, 140, 77);
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        /* Botão circular do menu */
        .menu-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color:rgb(65, 140, 77);
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .menu-button i {
            color: white;
            font-size: 20px;
        }

        /* Menu lateral */
        .menuMobile {
            position: fixed;
            top: 70px;
            left: -100%;
            width: 250px;
            height: calc(100% - 70px);
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            transition: left 0.3s ease-in-out;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 9999; /* Garante que o menu tenha prioridade sobre outros elementos */
        }

        .menuMobile.show {
            left: 0;
        }

        /* Botão de fechar menu */
        .menu-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            font-size: 20px;
            color: #333;
            cursor: pointer;
        }

        .menuMobile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .menuMobile a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            padding: 10px;
            display: block;
            width: 100%;
            text-align: center;
        }

        .menuMobile a:hover {
            background-color: #f1f1f1;
        }
    }
</style>

<header>
    <!-- Container para alinhar os elementos corretamente no mobile -->
    <div class="menu-container d-lg-none">
        <!-- Seta de voltar - Visível em todas as rotas, exceto na indexProfessor -->
        @if(Route::currentRouteName() != 'indexProfessor')
        <a href="javascript:history.back()" class="menu-back">
            <i class="fas fa-arrow-left"></i>
        </a>
        @endif

        <!-- Botão circular do menu para Mobile -->
        <button class="menu-button" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Menu normal para Desktop -->
<nav class="menuProfessor d-flex justify-content-between align-items-center d-none d-lg-flex">
    <div class="menu-links">
        <a href="{{ route('indexProfessor') }}" class="{{ Route::currentRouteName() == 'indexProfessor' ? 'active' : '' }}">
            <i class="fas fa-home"></i> Início
        </a>
        <a href="{{ route('reuniao.index') }}" class="{{ Route::currentRouteName() == 'reuniao.index' ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i> Minhas reuniões
        </a>
        <a href="{{ route('perfil-docente') }}" class="{{ Route::currentRouteName() == 'perfil-docente' ? 'active' : '' }}">
            <i class="fas fa-user"></i> Meu perfil
        </a>
        <a href="{{ route('projetos.index') }}" class="{{ Route::currentRouteName() == 'projetos.index' ? 'active' : '' }}">
            <i class="fas fa-project-diagram"></i> Meus projetos
        </a>
    </div>

    <!-- Foto do docente -->
    <div class="foto-perfil">
        <a href="{{ route('perfil-docente') }}">
            <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto do docente" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </a>
    </div>
</nav>

<!-- Menu lateral para Mobile -->
<div class="menuMobile d-lg-none" id="menuMobile">
    <!-- Botão de fechar -->
    <button class="menu-close" id="closeMenu">
        <i class="fas fa-times"></i>
    </button>

    <!-- Foto do docente -->
    <a href="{{ route('perfil-docente') }}">
        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto do docente">
    </a>

    <!-- Links do menu -->
    <a href="{{ route('indexProfessor') }}" class="{{ Route::currentRouteName() == 'indexProfessor' ? 'active' : '' }}">
        <i class="fas fa-home"></i> Início
    </a>
    <a href="{{ route('reuniao.index') }}" class="{{ Route::currentRouteName() == 'reuniao.index' ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> Minhas reuniões
    </a>
    <a href="{{ route('perfil-docente') }}" class="{{ Route::currentRouteName() == 'perfil-docente' ? 'active' : '' }}">
        <i class="fas fa-user"></i> Meu perfil
    </a>
    <a href="{{ route('projetos.index') }}" class="{{ Route::currentRouteName() == 'projetos.index' ? 'active' : '' }}">
        <i class="fas fa-project-diagram"></i> Meus projetos
    </a>
</div>

<script>
    // JavaScript para abrir e fechar o menu no mobile
    document.getElementById('menuToggle').addEventListener('click', function () {
        document.getElementById('menuMobile').classList.toggle('show');
    });

    // JavaScript para fechar o menu quando o botão de fechar for clicado
    document.getElementById('closeMenu').addEventListener('click', function () {
        document.getElementById('menuMobile').classList.remove('show');
    });

    // Fechar o menu se o usuário clicar fora do menu
    window.addEventListener('click', function(e) {
        if (!document.getElementById('menuMobile').contains(e.target) && !document.getElementById('menuToggle').contains(e.target)) {
            document.getElementById('menuMobile').classList.remove('show');
        }
    });
</script>
