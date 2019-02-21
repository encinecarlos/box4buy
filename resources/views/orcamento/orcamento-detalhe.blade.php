@extends('base.base')

@section('content')
<div class="box box-info">
    <div class="box-header">
        <h4>Produtos pertencentes ao orçamento</h4>
        <div class="box-tools">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-responsive table-bordered">
            <thead>
                <th>Código</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Valor declarado</th>
            </thead>
            <tbody>
                @foreach($produtos as $p)
                <tr>
                    <td>{{ $p->sequencia }}</td>
                    <td>{{ $p->descricao }}</td>
                    <td>{{ $p->quantidade }}</td>
                    <td>{{ $p->valor_declarado }}</td>
                </tr>                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@stop

@section('js')
<script src="{{ asset('js/usuario-estoque.js') }}"></script>
@stop