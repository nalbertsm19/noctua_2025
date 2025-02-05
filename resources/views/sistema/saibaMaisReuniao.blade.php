@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <h1 class="mb-4 text-success" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">Regras de Atualização de Reuniões</h1>
 
        <div class="alert alert-success custom-alert">
            <p><strong>Importante:</strong> Aqui estão as regras para atualizar reuniões. Por favor, leia atentamente.</p>
        </div>
    </div>
    
    <div class="row justify-content-center d-flex align-items-stretch">
        <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
            <div class="card custom-card">
                <div class="custom-card-body">
                    <h4 class="section-title">📌 Regras Gerais</h4>
                    <ul class="custom-list">
                        <li>📅 A data e hora podem ser alteradas no máximo <strong>duas vezes</strong>.</li>
                        <li>⏳ Alterações na data/hora só são permitidas até <strong>24 horas antes</strong> da reunião.</li>
                        <li>📝 O resumo pode ser alterado a qualquer momento, exceto se conter status "finalizado".</li>
                        <li>🔒 Se a data da reunião já tiver ocorrido, apenas o <strong>resumo</strong> e o <strong>status</strong> podem ser alterados.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="column justify-content-center d-flex align-items-stretch">
            <div class="card custom-card mt-3 mt-lg-0">
                <div class="custom-card-body">
                    <h4 class="section-title">⚠️ Restrições</h4>
                    <ul class="custom-list">
                        <li>🚫 Se você definiu uma reunião com status "Finalizada", não será possível modificar nenhum campo.</li>
                        <li>❌ Não é possível selecionar o status "Agendada" se a data da reunião já tiver ocorrido.</li>
                        <li>🔄 O status "Finalizada" não pode ser alterado.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .title {
        font-size: 2rem;
        color: #333;
        font-weight: 600;
    }

    .custom-alert {
        background-color: #f0f8ff;
        border-left: 5px solid #007bff;
        padding: 15px;
        font-size: 1rem;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .custom-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .custom-card:hover {
        transform: scale(1.02);
    }

    .custom-card-body {
        padding: 20px;
        background-color: #ffffff;
        color: #333;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .custom-list {
        list-style: none;
        padding-left: 0;
        font-size: 1rem;
        color: #555;
    }

    .custom-list li {
        margin-bottom: 10px;
    }

    .custom-list li strong {
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .custom-card {
            margin-top: 20px;
        }
    }
</style>
@endpush
