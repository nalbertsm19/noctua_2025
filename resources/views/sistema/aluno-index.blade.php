@extends('layouts.app')
@section('title', 'index-aluno')

@section('content')


<!-- Mensagem de boas-vindas -->
<div id="mensagem-boas-vindas" class="mensagemBoasVindas">
    <p>Bem-vindo, {{ Auth::user()->name }}!</p>
    <p>Encontre agora mesmo um orientador para seu TCC</p>
    <button id="fechar-mensagem" class="btnFechar">x</button>
</div>

<div>
    <h1 class="tituloIndexAluno">Orientadores</h1>
   



    <div class="cardProf" id="orientadores-container">
        @foreach ($docente as $professor)
            <div class="card-body">
                <img src="{{ asset('storage/' . $professor->foto_perfil) }}" alt="Foto de perfil" class="fotoPerfilProfessor">
                <h5 class="card-title">{{ $professor->nome }}</h5>
                <label for="formacao">Formação</label>
                <p class="card-text">{{ $professor->formacao }}</p>
                <p class="card-disponibilidade">{{ $professor->disponibilidade }}</p>
                <p class="card-vagas"><strong>Vagas para Orientação</strong></p>
                <a href="{{ route('docente.showfordiscente', ['id' => $professor->id]) }}" class="btn btn-success">Ver detalhes</a>
            </div>
        @endforeach
    </div>
</div>

<!-- Script para busca e fechamento da mensagem -->
<script>
    // Função para buscar orientadores
    function buscarOrientadores() {
        const query = document.getElementById('busca-orientador').value.trim();

        fetch(`/buscar-orientadores?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na requisição: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                const container = document.getElementById('orientadores-container');
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="naoEncontrou">Nenhum orientador encontrado.</p>';
                    return;
                }

                data.forEach(professor => {
                    container.innerHTML += `
                        <div class="card-body">
                            <img src="/storage/${professor.foto_perfil}" alt="Foto de perfil" class="fotoPerfilProfessor">
                            <h5 class="card-title">${professor.nome}</h5>
                            <label for="formacao">Formação</label>
                            <p class="card-text">${professor.formacao}</p>
                            <p class="card-disponibilidade">${professor.disponibilidade}</p>
                            <p class="card-vagas"><strong>Vagas para Orientação</strong></p>
                            <a href="/docente/${professor.id}" class="btn btn-success">Ver detalhes</a>
                        </div>
                    `;
                });
            })
            .catch(error => {
                console.error('Erro:', error);
                const container = document.getElementById('orientadores-container');
                container.innerHTML = '<p>Erro ao buscar orientadores. Tente novamente mais tarde.</p>';
            });
    }

    // Evento para buscar orientadores
    document.getElementById('buscar-btn').addEventListener('click', buscarOrientadores);

    document.getElementById('busca-orientador').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            buscarOrientadores();
        }
    });

    // Fechar mensagem de boas-vindas
    document.getElementById('fechar-mensagem').addEventListener('click', function() {
        document.getElementById('mensagem-boas-vindas').style.display = 'none';
    });
</script>
@endsection
