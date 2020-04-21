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
            <a href="{{ route('pessoas') }}" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="{{ route('orcamento') }}" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="{{ route('orcamento') }}" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="{{ route('ticketadmin') }}" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="box box-info">
            <div class="box-header">
                <h4>Novos clientes este mês</h4>
            </div>
            @dd(Carbon\Carbon::now()->format('m'))
            <div class="box-body">
                @if($usuario_mes->isEmpty())
                    <p class="alert alert-warning text-uppercase">Nenhum usuário cadastrado no mês atual.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Suite</th>
                            <th>Nome</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($usuario_mes as $usuario)
                            <tr>
                                <td>{{ $usuario->codigo_suite }}</td>
                                <td>{{ $usuario->nome_completo }} {{ $usuario->sobrenome }}</td>
                                <td class="col-sm-2">
                                    <a href="{{ route('pessoas-show', $usuario->codigo_suite) }}" class="btn btn-default btn-rounded boxColorTema">
                                        <i class="fa fa-eye">Visualizar Cliente</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="box box-info">
            <div class="box-header">
                <h4>Ultimos produtos enviados para a box4buy</h4>
            </div>
            <div class="box-body">
                @if($box_enviados->isEmpty())
                    <p class="alert alert-warning text-uppercase">Nenhum produto enviado até o momento.</p>
                @else
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
                                <td>CB{{ $enviados->codigo_suite }}</td>
                                <td>{{ $enviados->descricao_produto }}</td>
                                <td>
                                    <a href="{{ route('edit-produto', [$enviados->codigo_suite, $enviados->seq_produto]) }}"
                                       class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-sm-4">
        <div class="box box-info">
            <div class="box-header">
                <h4>Solicitação de compra assistida</h4>
            </div>
            <div class="box-body">
                @if($compra_assistida->isEmpty())
                    <p class="alert alert-warning text-uppercase">Nenhuma solicitação enviada.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th>Código</th>
                            <th>Suite</th>
                            <th>Status</th>
                            <th>Data de Solicitação</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($compra_assistida as $assistida)
                                <tr>
                                    <td>{{ $assistida->sequencia }}</td>
                                    <td>{{ $assistida->suite_id }}</td>
                                    <td><span class="badge bg-gray text-uppercase">Processando</span></td>
                                    <td>{{ $assistida->created_at->format('d/m/Y h:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('compra.edit', $assistida->sequencia) }}"
                                           class="btn btn-default btn-rounded boxColorTema">
                                            <i class="fa fa-edit"></i>
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
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
                                    <a href="{{ route('orcamento-edit', $pendentes->sequencia) }}"
                                       class="btn btn-info btn-rounded boxColorTema">
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
                @if($suporte_aberto->isEmpty())
                    <p class="alert alert-warning text-uppercase">nenhum chamado aberto até o momento.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($suporte_aberto as $aberto)
                            <tr>
                                <td>{{ $aberto->ticket_id }}</td>
                                <td>
                                    {{ $aberto->message }}
                                </td>
                                <td>
                                    <a href="{{ route('ticketadminshow', $aberto->ticket_id) }}"
                                       class="btn btn-default btn-rounded boxColorTema"><i class="fa fa-eye"></i> Visualizar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
