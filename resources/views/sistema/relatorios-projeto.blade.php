@extends('layouts.app')  <!-- Ou o caminho do seu layout -->

@section('content')
    <h1 style="text-align: center; color: #28a745;">Relatório de Projetos</h1>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
        <thead>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #28a745; color: white;">Tema do Projeto</th>
                <th style="padding: 8px; text-align: left; background-color: #28a745; color: white;">Descrição</th>
                <th style="padding: 8px; text-align: left; background-color: #28a745; color: white;">Status do Projeto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projetos as $projeto)
                <tr>
                    <td style="padding: 8px; text-align: left;">{{ $projeto->tema }}</td>
                    <td style="padding: 8px; text-align: left;">{{ $projeto->descricao }}</td>
                    <td style="padding: 8px; text-align: left;">{{ $projeto->statusProjeto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
