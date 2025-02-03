<nav class="menuProfessor d-flex justify-content-between align-items-center">
    
    <div class="menu-links">
        <a href="{{ route('docente.discentes', ['id' => Auth::user()->id]) }}">Meus orientandos</a>
        <a href="{{route('reuniao.index')}}">Minhas reuniões</a>
        <a href="{{ route('perfil-docente') }}">Meu perfil</a>
        <a href="{{ route('projetos.index') }}">Meus projetos</a>
    </div>
    <!-- Foto do docente -->
    <div class="foto-perfil">
        <a href="{{ route('perfil-docente') }}">
            <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto do docente" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </a>
    </div>
</nav>
