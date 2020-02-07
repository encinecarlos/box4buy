@extends('base.usuario-base')

@section('content')
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
            <div class="col-sx-12 table-responsive">
                <table class="table table-striped">
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
                                <td>{{ $produtos[$i]->codigo_produto }}</td>
                                <td>{{ $produtos[$i]->descricao }}</td>
                                <td>{{ $produtos[$i]->quantidade }}</td>
                                <td>{{ $produtos[$i]->valor_declarado }}</td>
                            </tr>                                                        
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 no-print">
                <p class="lead">Pague com:</p>                
                <img src="{{ asset('img/credit/paypalpayment.jpg') }}" alt="">
            </div>

            <div class="col-xs-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Valor do Frete:</th>
                            <td>{{ $orcamento[0]->vlr_entrega }}</td>
                        </tr>
                        <tr>
                            <th>Taxa Box4Buy</th>
                            <td>{{ $orcamento[0]->vlr_taxa }}</td>
                        </tr>
                        <tr>
                            <th>Valor do Seguro:</th>
                            <td>{{ $orcamento[0]->vlr_seguro }}</td>
                        </tr>
                        <tr>
                            <th>Taxa do Cartão:</th>
                            <td>5%</td>
                        </tr>
                        <tr class="lead">
                            <th>Total:</th>
                            <td>{{ $orcamento[0]->vlr_final }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="col-xs-12">
                {{-- <a href="#" onclick="window.print()" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a> --}}
                <a href="{{ route('estoque') }}" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Voltar</a>
                {{--<form action="{{ route('payment', $orcamento[0]->sequencia) }}" method="POST">
                    @csrf
                    <button class="btn btn-info btn-lg boxColorTema pull-right" type="submit"><i class="fa fa-paypal"></i> Efetuar Pagamento</button>
                </form> --}}
                <div class="paypal-container pull-right"></div>
            </div>  
        </div>

    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">    
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

@section('paypal')
    <script
            src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}">
    </script>
@endsection
@section('order')
    <script>
        paypal.Buttons({
            style: {
                size:'responsive',
                color: 'blue',
                shape: 'pill',
                tagline: false,
                label: 'pay'
            },
            createOrder(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{ $orcamento[0]->vlr_final == '0' ? '0.01' : $orcamento[0]->vlr_final }}",
                            breakdown: {
                                // currency_code: 'USD',
                                item_total: {
                                    currency_code: 'USD',
                                    value:"{{ $orcamento[0]->vlr_final == '0' ? '0.01' : $orcamento[0]->vlr_final }}"
                                }
                            }
                        },
                        items: [{
                            name: "Entrega de produtos BOX4BUY",
                            unit_amount: {
                                currency_code: 'USD',
                                value: "{{ $orcamento[0]->vlr_final == '0' ? '0.01' : $orcamento[0]->vlr_final }}"
                            },
                            description: "Entrega para a suite CB{{ Auth::user()->codigo_suite }}",
                            quantity: 1
                        }]
                    }]
                });
            },

            onApprove(data, actions) {
                axios.post("/invoice/payment/{{ $orcamento[0]->sequencia }}").then(response => {
                    location.href = "/invoice/payment/recibo/{{ $orcamento[0]->sequencia }}"
                });
            }
        }).render('.paypal-container');
    </script>
@endsection
