<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Box4buy - Recibo Orçamento {{ $orcamento[0]->sequencia }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->  
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <img src="{{ asset('img/logo-s.png') }}" class="img-responsive bxby-logo" alt="Box4Buy">
                    <small class="pull-right">{{ date('d/m/Y') }}</small>                    
                </div>                
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-12 invoice-col">
                <h3 class="text-green">PAGO</h3>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-12 invoice-col">
                Dados de entrega
                <address>
                    <strong>{{ Auth::user()->nome_completo }}</strong><br>
                    {{ $orcamento[0]->endereco }}, {{ $orcamento[0]->numero }} ({{ $orcamento[0]->complemento }})<br>
                    {{ $orcamento[0]->bairro }} - {{ $orcamento[0]->cidade }}<br>
                    {{ $orcamento[0]->estado == '' ? 'Não Informado' : $orcamento[0]->estado }} - {{ $orcamento[0]->codigo_postal }}<br>
                    <b>E-mail: </b>{{ Auth::user()->email }}
                </address>
            </div>            
        </div>

        <div class="row invoice-info">
            <div class="col-sm-3 invoice-col">
                <p><b>Orçamento: {{ $orcamento[0]->sequencia }}</b></p>
                <p><b>Suite: </b>{{ session('suite_prefix') }}{{ $orcamento[0]->codigo_suite }}</p>
                <p>
                    <b>Pacote: </b>
                    @switch($orcamento[0]->codigo_pacote)
                        @case(1)
                            First Class
                            @break
                        @case(2)
                            Priority Mail
                            @break
                        @case(3)
                            Priority Express
                            @break                            
                    @endswitch
                </p>
                <p><b>Seguro: </b>{{ $orcamento[0]->seguro == '1' ? 'Sim' : 'Não' }}</p>
            </div>
            
            <div class="col-sm-3 invoice-col">
                <p><b>Cod. Rastreio: </b>{{ $orcamento[0]->cod_rastreio == '' ? 'Não Informado' : $orcamento[0]->cod_rastreio }}</p>
                <p><b>Enviar Nota Físcal: </b>{{ $orcamento[0]->recebe_nota == '1' ? 'Sim' : 'Não' }}</p>
                <p><b>Enviar Etiqueta de Preço: </b>{{ $orcamento[0]->preco_etiqueta == '1' ? 'Sim' : 'Não' }}</p>
                <p><b>Enviar Caixas Originais: </b>{{ $orcamento[0]->caixas_originais == '1' ? 'Sim' : 'Não' }}</p>
            </div>

            <div class="col-sm-3 invoice-col">
                <p><b>Enviar propagandas: </b>{{ $orcamento[0]->recebe_propaganda == '1' ? 'Sim' : 'Não' }}</p>
                <p><b>Enviar Sacolas Originais: </b>{{ $orcamento[0]->sacolas_originais == '1' ? 'Sim' : 'Não' }}</p>
            </div>
        </div> {{-- Fim Informações --}}

        <div class="row">
            <div class="col-sx-12 table-responsive" style="padding-left:15px; padding-right:15px ">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Cod. Produto</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>   
                            <th>Valor Declarado</th>                         
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($produtos); $i++)
                            <tr>
                                <td class="col-sm-1">{{ $produtos[$i]->codigo_produto }}</td>
                                <td>{{ $produtos[$i]->descricao }}</td>
                                <td class="col-sm-1">{{ $produtos[$i]->quantidade }}</td>
                                <td class="col-sm-1">{{ $produtos[$i]->valor_declarado }} USD / R$ {{ number_format(($produtos[$i]->valor_declarado * $dolar), 2) }}</td>
                            </tr>                                                        
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <p class="lead text-muted well well-sm- no-shadow">RECIBO PARA SIMPLES CONFERÊNCIA</p>
            </div>

            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Valor do Frete:</th>
                            <td>{{ $orcamento[0]->vlr_entrega }} USD / R$ {{ number_format(($orcamento[0]->vlr_entrega * $dolar), 2) }}</td>
                        </tr>
                        <tr>
                            <th>Taxa Box4Buy</th>
                            <td>{{ $orcamento[0]->vlr_taxa }} USD / R$ {{ number_format(($orcamento[0]->vlr_taxa * $dolar), 2) }}</td>
                        </tr>
                        <tr>
                            <th>Valor do Seguro:</th>
                            <td>{{ $orcamento[0]->vlr_seguro }} USD / R$ {{ number_format(($orcamento[0]->vlr_seguro * $dolar), 2) }}</td>
                        </tr>
                        <tr>
                            <th>Taxa do Cartão:</th>
                            <td>5%</td>
                        </tr>
                        <tr class="lead">
                            <th>Total:</th>
                            <td>{{ $orcamento[0]->vlr_final }} USD / R$ {{ number_format(($orcamento[0]->vlr_final * $dolar), 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="col-xs-12">
                <a href="{{ route('gerapdf', $orcamento[0]->sequencia) }}" target="_blank" class="btn btn-success pull-right"><i class="fa fa-print"></i> Imprimir Recibo</a>
                <a href="{{ route('estoque') }}" class="btn btn-info boxColorTema"><i class="fa fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
    </section>  
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
