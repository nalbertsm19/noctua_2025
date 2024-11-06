@extends('layouts.app')
@section('title')
Noctua-Login

@endsection

@section('content')
<div class="pai">
          <div class="banner">
          <h1 class="titulo">Noctua</h1>
          <img src="/storage/arquivos/coruja.jpg" alt="imagem de uma coruja">
           <p class="info">Encontre agora um orientador para o teu projeto!</p>   
          </div>

          <div class="formulario">
              <form action="#" method="POST">
               <p style="font-size:20px">Acesso a plaforma </p>
               <label for="CPF" >Identificação de usuário</label>
               <input type="number" id="CPF" placeholder="Informe seu usuário" class="form-control">
               <label for="Senha">Senha</label>
               <input type="password" name="senha" id="senha" placeholder="Informe sua senha" class="form-control">
               <input type="submit" class="btn btn-success d-block mx-auto mt-4" value="Entrar">
               <p class="link">Problemas no Login contate: serti.cb@ifms.edu.br</p>
               
              </form>
          </div>
    </div>

     <footer>
        IFMS Campus Corumbá
        © Noctua 2024 - todos os direitos reservados 

     </footer>


@endsection