@extends('base.usuario-base')

@section('content')
<h1>OI, Eu sou um TUTORIAL </h1>

@stop

@section('css')

<link rel="stylesheet" href="{{asset('css/style.css')}}"> 

@stop

@section('js')
    <script src="{{ asset('js/usuario-estoque.js') }}"></script>
@stop