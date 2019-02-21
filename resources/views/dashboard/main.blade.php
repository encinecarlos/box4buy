@extends('base.base') 
@section('content')
<div class="row">
    <div class="col-sm-3">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $usuarios }}</h3>
                <p>Clientes cadastrados</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $orcamentos_pendentes }}</h3>
                <p>Orçamentos Pendentes</p>
            </div>
            <div class="icon">
                <i class="fa fa-bar-chart"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $orcamentos_pagos }}</h3>
                <p>Orçamentos pagos</p>
            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $chamados_abertos }}</h3>
                <p>Chamados de suporte abertos</p>
            </div>
            <div class="icon">
                <i class="fa fa-ticket"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="box box-info">
            <div class="box-header">
                <h4>Ultimos produtos enviados para a box4buy</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Suite</th>
                            <th>Descrição</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($box_enviados as $enviados)
                            <tr>
                                <td>{{ $enviados->codigo_suite }}</td>
                                <td>{{ $enviados->descricao_produto }}</td>
                                <td>
                                    <a href="{{ route('edit-produto', [$enviados->codigo_suite, $enviados->seq_produto]) }}" class="btn btn-info boxColorTema"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-info">
            <div class="box-header">
                <h4>Ultimos Orçamentos Solicitados</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    @if(count($box_orcamentos_pendentes) == 0)
                    <p class="alert alert-warning">NENHUM ORÇAMENTO SOLICITADO NO MOMENTO</p> @else
                    <table class="table table-hover">
                        <thead>
                            <th>Suite</th>
                            <th>Código</th>
                            <th>Tipo de entrega</th>
                            <th>Peso (Libras)</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($box_orcamentos_pendentes as $pendentes)
                            <tr>
                                <td>{{ $pendentes->codigo_suite }}</td>
                                <td>{{ $pendentes->sequencia }}</td>
                                <td>
                                    @switch($pendentes->codigo_pacote) @case(1) First Class @break @case(2) Priority Mail @break @case(3) Priority Express @break
                                    @endswitch
                                </td>
                                <td>{{ $pendentes->peso_total }}</td>
                                <td>
                                    <a href="{{ route('orcamento-edit', $pendentes->sequencia) }}" class="btn btn-info boxColorTema">
                                    	<i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-info">
            <div class="box-header">
                <h4>Ultimos chamados de suporte abertos</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Assunto</th>
                            <th>Prioridade</th>
                        </thead>
                        <tbody>
                            @foreach ($suporte_aberto as $aberto)
                            <tr>
                                <td>{{ $aberto->ticket_id }}</td>
                                <td><a href="{{ route('ticketadminshow', $aberto->ticket_id) }}">{{ $aberto->title }}</a>
                                </td>
                                <td>
                                    @switch($aberto->priority) @case('baixa')
                                    <span class="label label-success">Baixa</span> @break @case('media')
                                    <span class="label label-warning">Média</span> @break @case('alta')
                                    <span class="label label-danger">Alta</span> @endswitch
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection