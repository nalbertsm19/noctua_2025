@extends('layouts.app');
@section('title')
Criar Reunião
@endsection

@section('content')
<div id="espacoReuniao">
    <form action="#" method="post">
     @csrf
     <h1 style="color:white">Crie uma nova Reunião</h1>
     <label for="docente_id">Docente:</label>
            <select name="docente_id" id="docente_id">
                @foreach($docente as $orientador)
                    <option value="{{ $orientador->id }}">{{ $orientador->nome }}</option>
                @endforeach
            </select>
            <label for="discente_id">Discente:</label>
            <select name="discente_id" id="discente_id">
                @foreach($discente as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->email }}</option>
                @endforeach
            </select>
    <label for="datatime">Data Hora</label>
    <input type="datetime-local" name="dataHora" id="dataHora" class="form-control">
    <label for="resumo">Resumo</label>
    <input type="text" name="resumo" id="resumo" class="form-control">
    <label for="statusReuniao">Status Reunião</label>
    <input type="radio" id="pendente" name="statusReuniao" value="pendente" class="'form-control">
        <label for="pendente">Pendente</label><br>
        <input type="radio" id="finalizado" name="statusReuniao" value="finalizado" class="form-ccontrol">
        <label for="finalizado">Finalizado</label>
    <button type="submit" class=" btn btn-success">Criar Reunião</button>
    </form>
</div>

@endsection