@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="custom-card shadow-lg rounded" style="border: none;">
            <div class="custom-card-header text-center bg-success text-white">
                <h2>Detalhes da Reunião</h2>
            </div>
            <div class="custom-card-body bg-light">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <h4 class="custom-text-success">Docente</h4>
                        <p class="custom-lead">{{ $reuniao->docente->nome }}</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="custom-text-success">Projeto</h4>
                        <p class="custom-lead">{{ $reuniao->projeto->tema }}</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="custom-text-success">Data</h4>
                        <p class="custom-lead">{{ \Carbon\Carbon::parse($reuniao->dataHora)->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h4 class="custom-text-success">Resumo</h4>
                    <p>{{ $reuniao->resumo }}</p>
                </div>

                <div class="text-center">
                    <a href="{{ URL::previous() }}" class="btn btn-success px-5">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .custom-card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background-color: #28a745;
            color: white;
        }
        
        .custom-card-body {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: #f8f9fa;
            
        }

        .custom-btn {
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #28a745;
            color: white;
        }

        .custom-lead {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .custom-text-success {
            color: #28a745;
        }
    </style>
@endsection
