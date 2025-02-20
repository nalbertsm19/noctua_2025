@extends('layouts.app')

@section('title')
Calendário de Reuniões 
@endsection

@section('content')
<h1 class="calendar-title">Calendário de Reuniões</h1>
    <div id="calendar"></div>

    <!-- FullCalendar CSS e JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <style>
         /* Estilo para o título */
    .calendar-title {
        text-align: center; /* Centraliza o título */
        color: #28a745; /* Cor verde */
        font-size: 2.5rem; /* Tamanho da fonte */
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sombra nas letras */
        animation: pulse 2s infinite; /* Animação para o efeito de destaque */
    }

    /* Animação para dar efeito de destaque */
    @keyframes pulse {
        0% {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 25px #28a745, 0 0 5px #28a745;
        }
        100% {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 35px #28a745, 0 0 10px #28a745;
        }
        50% {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3), 0 0 25px #28a745, 0 0 5px #28a745;
        }
    }
    #calendar {
        background-color: rgb(189, 212, 162); /* Verde muito claro */
        border-radius: 15px; /* Borda arredondada */
        padding: 20px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
        margin: 20px auto; /* Afastamento das laterais e do topo */
        max-width: 90%; /* Responsivo - 90% da largura da tela */
        overflow: hidden; /* Impede que o conteúdo ultrapasse os limites */
        display: block;
    

    .fc-event {
        background-color: #4CAF50; /* Verde forte */
        color: white;
        border-radius: 5px;
        font-weight: bold;
    }

    .fc-event-title {
        font-size: 14px;
    }

    .fc-header-toolbar {
        background-color: #00796b;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        padding: 10px;
        border-radius: 10px;
    }

    .fc-header-toolbar .fc-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        margin: 5px;
        transition: background-color 0.3s ease;
    }

    .fc-header-toolbar .fc-button:hover {
        background-color: #388E3C; /* Cor verde mais escura ao passar o mouse */
    }

    .fc-header-toolbar .fc-button:disabled {
        background-color: #B0BEC5; /* Cor desabilitada */
    }

    .fc-daygrid-day-number {
        font-size: 30px; /* Ajuste de tamanho da fonte */
        color: #00796b; /* Cor verde para os números de dia */
    }

    .fc-daygrid-day-top {
        padding: 5px 10px; /* Ajustando o espaçamento */
    }

    /* Modal personalizado */
    .event-modal {
        position: absolute;
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        display: none;
        z-index: 1000;
        width: 250px;
        transition: opacity 0.3s ease-in-out;
        border: 2px solid #4CAF50;
        transform: rotate(-2deg);
    }

    .event-modal::before {
        content: "";
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 15px;
        background: white;
        border-left: 2px solid #4CAF50;
        border-right: 2px solid #4CAF50;
        border-top: 2px solid #4CAF50;
        border-radius: 10px 10px 0 0;
    }

    .corujinha {
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
    }

    .event-modal h5 {
        margin-top: 30px;
        text-align: center;
        font-weight: bold;
    }

    .event-modal p {
        font-size: 14px;
    }

    .event-modal a {
        display: block;
        text-align: center;
        background: #4CAF50;
        color: white;
        padding: 5px;
        border-radius: 5px;
        text-decoration: none;
    }

    .event-modal a:hover {
        background: #388E3C;
    }

    /* Responsividade para a barra de ferramentas */
    @media (max-width: 768px) {
        .fc-header-toolbar {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
        }

        .fc-header-toolbar .fc-button {
            font-size: 12px;
            margin: 3px;
            width: 100%;
        }

        .fc-header-toolbar .fc-button-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
    }

    /* Ajuste para telas muito pequenas */
    @media (max-width: 480px) {
        .fc-header-toolbar {
            padding: 5px;
        }

        .fc-header-toolbar .fc-button {
            font-size: 10px;
            margin: 2px;
            padding: 5px;
        }

        .fc-header-toolbar .fc-button-group {
            flex-direction: column;
        }
    }
</style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventModal = document.createElement('div');
            eventModal.className = 'event-modal';
            eventModal.innerHTML = `
                <img src="/storage/arquivos/corujinha.png" class="corujinha" alt="Corujinha assistente">
                <h5 id="eventTitle"></h5>
                <p><strong>Descrição:</strong> <span id="eventDescription"></span></p>
                <p><strong>Data e Hora:</strong> <span id="eventTime"></span></p>
            `;
            document.body.appendChild(eventModal);

            let hideTimeout;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/calendario/reunioes',
                eventMouseEnter: function(info) {
                    clearTimeout(hideTimeout);

                    var rect = info.el.getBoundingClientRect();
                    eventModal.style.top = (rect.top + window.scrollY + 20) + "px";
                    eventModal.style.left = (rect.left + window.scrollX + 20) + "px";

                    document.getElementById('eventTitle').innerText = info.event.title;
                    document.getElementById('eventDescription').innerText = info.event.extendedProps.description || 'Sem descrição';
                    document.getElementById('eventTime').innerText = new Date(info.event.start).toLocaleString();

                    eventModal.style.display = "block";
                },
                eventMouseLeave: function(info) {
                    hideTimeout = setTimeout(() => {
                        if (!eventModal.matches(':hover')) {
                            eventModal.style.display = "none";
                        }
                    }, 2000);
                },
                eventClick: function(info) {
                    // Redireciona para a página de detalhes do evento
                    window.location.href = "{{ url('/reunioes') }}/" + info.event.id;
                }
            });

            eventModal.addEventListener('mouseenter', function() {
                clearTimeout(hideTimeout);
            });

            eventModal.addEventListener('mouseleave', function() {
                eventModal.style.display = "none";
            });

            calendar.render();
        });
    </script>
@endsection
