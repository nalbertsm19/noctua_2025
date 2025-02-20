@extends('layouts.app')

@section('title', 'Meus Projetos')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="text-success">Meus Projetos</h2>
            @if(Auth::user()->docente)
                <a href="{{ route('cadastro-projeto') }}" class="btn btn-success">Cadastrar Novo Projeto</a>
            @endif
        </div>

        @if($projetos->isEmpty())
            <p class="text-muted">Não há projetos disponíveis.</p>
        @else
            <div class="accordion" id="projetosAccordion">
                @foreach($projetos as $projeto)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $projeto->id }}">
                            <button class="accordion-button collapsed bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $projeto->id }}" aria-expanded="false" aria-controls="collapse{{ $projeto->id }}">
                                {{ $projeto->tema }}
                            </button>
                        </h2>
                        <div id="collapse{{ $projeto->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $projeto->id }}" data-bs-parent="#projetosAccordion">
                            <div class="accordion-body">
                                <p class="mb-3">{{ Str::limit($projeto->descricao, 200) }}</p>
                                <p>
                                    <i class="fas fa-clock me-2"></i>
                                    Projeto criado {{ $projeto->created_at->locale('pt_BR')->diffForHumans() }}
                                </p>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('projetos.show', $projeto->id) }}" class="btn btn-sm btn-info me-2">Ver Mais</a>
                                    @if(Auth::user()->docente)
                                    <a href="{{ route('projetos.edit', $projeto->id) }}" class="btn btn-sm btn-primary me-2">Editar</a>
                                    @elseif(Auth::user()->discente && is_null(Auth::user()->discente->id_projeto))
                                    <form action="{{ route('projetos.associar', $projeto->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ Auth::user()->discente->id }}">
                                        <button type="submit" class="btn btn-sm btn-secondary">Me associar a esse projeto</button>
                                    </form>
                                    @elseif(Auth::user()->discente && Auth::user()->discente->id_projeto == $projeto->id)
                                    <form action="{{ route('projetos.remover', $projeto->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Remover do Projeto</button>
                                    </form>
                                    @endif
                                </div>

                                <h5 class="mt-3">Participantes:</h5>
                                @if($projeto->discentes->isEmpty())
                                    <p class="text-muted">Nenhum discente associado.</p>
                                @else
                                    <div class="d-flex flex-wrap">
                                        @foreach($projeto->discentes as $discente)
                                            <div class="d-flex align-items-center me-4 mb-3">
                                                <img src="{{ asset('storage/' . $discente->imagem) }}" style="height:40px; width:40px; object-fit:cover;" class="rounded-circle me-3" alt="Foto de {{ $discente->nome }}">
                                                <div class="me-3">
                                                    <h6 class="mb-1 text-truncate" title="{{ $discente->nome }}">{{ $discente->nome }}</h6>
                                                    <p class="text-muted mb-0 text-truncate" title="{{ $discente->email }}">{{ $discente->email }}</p>
                                                </div>

                                                @if(Auth::user()->docente)
                                                <button class="btn btn-sm btn-outline-danger" data-id="{{ $discente->id }}" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                    Remover
                                                </button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmação de Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja remover este discente do projeto? Esta ação não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" class="mb-0" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmModal = document.getElementById('confirmModal');
            const deleteForm = document.getElementById('deleteForm');

            confirmModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const discenteId = button.getAttribute('data-id');
                deleteForm.action = `/projetos/remover/${discenteId}`; // Ação para remover o discente
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
