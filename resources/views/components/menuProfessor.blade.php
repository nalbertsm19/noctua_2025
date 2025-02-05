<nav class="menuProfessor d-flex justify-content-between align-items-center">
    
    <div class="menu-links">
        <a href="{{ route('indexProfessor') }}" class="{{ Route::currentRouteName() == 'indexProfessor' ? 'active' : '' }}">
            <i class="fas fa-home"></i> Inicio
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
