<div class="menuAluno">
    <div style="display: flex; align-items: center;">
        <input 
            type="text" 
            placeholder="Encontre seu orientador, insira o nome aqui" 
            class="inputAluno" 
            id="busca-orientador">

        <!-- Botão da lupa -->
        <button id="buscar-btn" class="botaoLupa">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>
   
    <nav>
        <a href="{{route('reuniao.index')}}">Minhas reuniões</a>
        <a href="{{ route('projetos.indexdiscente') }}">Meu projeto</a>
    </nav>
 
    <div class="foto-perfil">
        @if (Auth::check())
            <a href="{{ route('discente.show', ['id' => Auth::user()->id]) }}">
                <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto do discente" class="rounded-circle" style="width: 60px; height: 44px; object-fit: cover;">
            </a>
        @endif
    </div>
</div>