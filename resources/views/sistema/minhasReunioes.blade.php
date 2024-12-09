@extends('layouts.app')

@section('title')
Minhas Reuniões
@endsection

@section('content')
<h1>Minhas Reuniões</h1>

<h1>Minhas Reuniões</h1>

@foreach($reunioes as $reuniao)
    <p>{{ $reuniao }}</p>
@endforeach

@endsection
