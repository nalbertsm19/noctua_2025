@extends('layouts.app')
@section('title')
Cadastro de Áreas de Interesse
@endsection

@section('content')
  <div class="cadastrarForm">
    <form action="{{ route('area-store') }}" method="post">
      @csrf
      <h1>Cadastre suas Áreas de Interesse</h1>
      <label for="nome" style="font-size:18px">Descrição:</label>

      <select id="nome" name="nome" required class="descArea">
        <option value="">Selecione uma área</option>
        <option value="Automação Industrial">Automação Industrial</option>
        <option value="Banco de Dados">Banco de Dados</option>
        <option value="Beneficiamento de Minérios">Beneficiamento de Minérios</option>
        <option value="Ciência da Computação">Ciência da Computação</option>
        <option value="Computação Gráfica">Computação Gráfica</option>
        <option value="Engenharia de Software">Engenharia de Software</option>
        <option value="Ensaios Mecânicos">Ensaios Mecânicos</option>
        <option value="Fundição e Modelagem">Fundição e Modelagem</option>
        <option value="Gestão da Produção Metalúrgica">Gestão da Produção Metalúrgica</option>
        <option value="Gestão de TI">Gestão de TI</option>
        <option value="Inteligência Artificial">Inteligência Artificial</option>
        <option value="Internet das Coisas (IoT)">Internet das Coisas (IoT)</option>
        <option value="Logística e Controle de Qualidade">Logística e Controle de Qualidade</option>
        <option value="Metalurgia do Pó">Metalurgia do Pó</option>
        <option value="Mineração e Extração Mineral">Mineração e Extração Mineral</option>
        <option value="Modelagem Computacional">Modelagem Computacional</option>
        <option value="Otimização de Processos">Otimização de Processos</option>
        <option value="Processamento de Ligas Metálicas">Processamento de Ligas Metálicas</option>
        <option value="Processamento de Materiais Compósitos">Processamento de Materiais Compósitos</option>
        <option value="Processos de Soldagem">Processos de Soldagem</option>
        <option value="Programação para Sistemas Industriais">Programação para Sistemas Industriais</option>
        <option value="Redes de Computadores">Redes de Computadores</option>
        <option value="Segurança da Informação">Segurança da Informação</option>
        <option value="Simulação de Processos Metalúrgicos">Simulação de Processos Metalúrgicos</option>
        <option value="Outro">Outro</option>
      </select>

      <div id="campoOutro" style="display: none; margin-top: 10px;">
        <label for="outro_nome" style="font-size:18px">Descreva sua área:</label>
        <input type="text" id="outro_nome" class="descArea" placeholder="Digite sua área de interesse">
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
    </form>
  </div>

  <!-- Corujinha assistente fixa -->
  <div id="corujinha-assistente" class="corujinha-assistente">
    <img src="/storage/arquivos/corujinha.png" alt="Corujinha assistente" class="corujinha-fixed">
    <div class="mensagem-assistente">
      <p class="mensagem-destaque">Olá, eu sou a Noctua!</p>
      <p>Cadastre uma área de interesse para que seus futuros orientandos possam encontrar uma área que seja compatível com o que eles buscam.</p>
      <button id="fechar-assistente" class="btn btn-light">Entendido</button>
    </div>
  </div>

  <!-- Estilos personalizados -->
  <style>
    .corujinha-assistente {
      position: fixed;
      bottom: 20px;
      right: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: rgba(0, 0, 0, 0.8);
      padding: 20px 25px;
      border-radius: 10px;
      color: white;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
      z-index: 1000;
      width: 250px;
    }

    .corujinha-fixed {
      width: 60px;
      height: auto;
      margin-bottom: 10px;
    }

    .mensagem-assistente {
      text-align: center;
    }

    .mensagem-destaque {
      font-size: 18px;
      font-weight: bold;
      color: #fff;
      margin-bottom: 10px;
      animation: glow 1.5s ease-in-out infinite alternate;
    }

    @keyframes glow {
      0% { text-shadow: 0 0 5px #fff, 0 0 10px #63c18b, 0 0 15px #63c18b; }
      50% { text-shadow: 0 0 5px #ff00ff, 0 0 10px #ff00ff, 0 0 15px #ff0000; }
      100% { text-shadow: 0 0 5px #00ffff, 0 0 10px #00ffff, 0 0 15px #ff0000; }
    }

    .mensagem-assistente p {
      font-size: 16px;
      margin: 0;
    }

    .btn {
      background-color: #63c18b;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 15px;
      border-radius: 25px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-light {
      background-color: #f0f0f0;
      color: #333;
    }

    .btn:hover {
      background-color: #4e9b6f;
    }

    .btn-light:hover {
      background-color: #e0e0e0;
    }
  </style>

  <!-- Script para controlar a exibição do campo "Outro" -->
  <script>
    document.getElementById('nome').addEventListener('change', function() {
      var campoOutro = document.getElementById('campoOutro');
      var inputOutro = document.getElementById('outro_nome');

      if (this.value === 'Outro') {
        campoOutro.style.display = 'block';
        inputOutro.setAttribute('name', 'nome'); // Usa o valor digitado no envio
      } else {
        campoOutro.style.display = 'none';
        inputOutro.removeAttribute('name'); // Remove o atributo name para evitar conflito
      }
    });

    document.getElementById('fechar-assistente').addEventListener('click', function() {
      document.getElementById('corujinha-assistente').style.display = 'none';
    });
  </script>
@endsection
