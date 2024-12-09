@extends('layouts.app')
@section('title')
Coordenacao
@endsection

@section('content')
<h1 style="font-size:30px; color:green; text-align:center">Bem vindo, coordenador!</h1>
<nav class="menuCoordenador">
    <p class="btn btn-primary">Exportar Dados</p>
    <p class="btn btn-primary">Filtrar Dados</p> 
</nav>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome do Estudante</th>
      <th scope="col">Nome do Orientador</th>
      <th scope="col">Tema do Projeto</th>
      <th scope="col">Status do Projeto</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
@endsection

