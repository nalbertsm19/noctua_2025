@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="display-4 text-primary mb-4">Orientandos do Docente(a) {{ Auth::user()->name }}</h1>

    @if ($discentes->isEmpty())
        <div class="alert alert-warning shadow-sm" role="alert">
            <p class="h5">Não há discentes associados a este docente.</p>
        </div>
    @else
        <div class="table-responsive shadow-lg rounded">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th class="text-start">Nome do Discente</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-start">Projeto</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discentes as $discente)
                        <tr class="shadow-sm">
                            <td class="text-start">{{ $discente->nome }}</td>
                            <td class="text-center">{{ $discente->email }}</td>
                            <td class="text-start">{{ $discente->projeto ? $discente->projeto->tema : 'Sem projeto' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('discente.show', $discente->id) }}" class="btn btn-success">Ver</a>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
