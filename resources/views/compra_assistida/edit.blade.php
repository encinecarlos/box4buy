@extends(((Auth::user()->type_user == '2') ? 'base.usuario-base' : 'base.base'))

@section('content')
    <div class="box box-header-white">
        <div class="box-header" id="print_compra">
            <h4 class="hidden-print">
                <i class="fa fa-edit"></i> Editar Compra Assistida
                @if($solicitacao->status_solicitacao == '12')
                    <span class="badge bg-green">PAGO</span>
                @elseif($solicitacao->status_solicitacao == '13')
                    <span class="badge bg-red"><i class="fa fa-close"></i> CANCELADO</span>
                @endif
            </h4>

            <h4 class="hidden-sm hidden-md hidden-lg hidden-xs visible-print">
                <i class="fa fa-shopping-cart"></i> Dados do pedido
                @if($solicitacao->status_solicitacao == '12')
                    <span class="badge bg-green">PAGO</span>
                @elseif($solicitacao->status_solicitacao == '13')
                    <span class="badge bg-red"><i class="fa fa-close"></i> CANCELADO</span>
                @endif
            </h4>
            <div class="box-tools hidden-print">
                <a href="{{ url()->route('compra.main') }}" class="btn btn-default btn-rounded">
                    <i class="fa fa-chevron-left"></i> Voltar
                </a>
                <a href="#" class="btn btn-default boxColorTema btn-rounded print_doc"><i class="fa fa-print"></i> Imprimir</a>

            @if(Auth::user()->type_user == '1')
                <button class="btn btn-danger btn-rounded text-uppercase">
                    <i class="fa fa-trash"></i> Cancelar Pedido
                </button>
                @endif
            </div>

            <div class="box-body">
                @if(session()->has('msg'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                    </div>
                @endif

                @if(Auth::user()->type_user == '2')
                        <div class="row">
                            <p><b>Cliente:</b> {{ Auth::user()->nome_completo }}</p>
                            <p><b>Data/Hora da solicitação:</b> {{ $solicitacao->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                @else
                        <div class="row">
                            <p><b>Código de Solicitação: </b> {{ $solicitacao->sequencia }}</p>
                        </div>
                @endif
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="hidden-print"><b>URL</b></th>
                                <th><b>Descrição</b></th>
                                <th><b>Valor</b></th>
                                <th><b>Qtde</b></th>
                                <th><b>Cor</b></th>
                                <th><b>Tamanho</b></th>
                                <th><b>Observações</b></th>
                                <th><b>Fora de Estoque</b></th>
                                <th><b>Subtotal</b></th>
                                <th class="hidden-print"><b>Ações</b></th>
                            </tr>
                            </thead>
                            @foreach($solicitacao->produtos as $produto)
                                <tr class="text-center">
                                    <td class="text-left hidden-print"><a href="{{ $produto->link_produto }}" target="_blank">{{ $produto->link_produto }}</a></td>
                                    <td>{{ $solicitacao->descricao }}</td>
                                    <td>$ {{ number_format($produto->preco, '2') }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->cor }}</td>
                                    <td>{{ $produto->tamanho }}</td>
                                    <td>{{ $produto->observacao }}</td>
                                    <td>
                                        <select name="fora_estoque" onchange="foraEstoque({{ $produto->sequencia }}, this)" class="form-control foraestoque">
                                            <option value="1" {{ $produto->fora_estoque == '1' ? 'selected' : '' }}>Sim</option>
                                            <option value="2" {{ $produto->fora_estoque == '2' ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </td>
                                    <td>$ {{ Utils::subTotal($produto->quantidade, $produto->preco) }}</td>
                                    <td class="hidden-print">
                                        <a href="#edit-{{ $produto->sequencia }}"
                                           rel="modal:open"
                                           class="btn btn-warning btn-rounded">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-rounded deleta-produto"
                                                onclick="deletaProduto({{$produto->sequencia}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    @include('compra_assistida.partials.edit-produto')
                                </tr>
                            @endforeach
                            <tfoot class="text-right">
                                <tr>
                                    <td class="hidden-print" colspan="8"><h4><b>Total:</b></h4></td>
                                    <td class="hidden-sm hidden-md hidden-lg hidden-xs visible-print" colspan="7"><h4><b>Total:</b></h4></td>
                                    <td class="text-center"><h4 id="total_geral">{{ Utils::total($solicitacao) }}</h4></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <label>Observações Adicionais:</label>
                    <p>{{ $solicitacao->obervacoes }}</p>
                </div>

            </div>
            <div class="box-footer">
                <div class="pull-right hidden-print">
                    <a href="#produtoadd"
                       rel="modal:open"
                       class="btn btn-info btn-rounded boxColorTema">
                        <i class="fa fa-plus-circle"></i> Adicionar outro produto
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->type_user == '1')
        <div class="box box-info">
            <div class="box-header">
                <h4><i class="fa fa-shopping-cart"></i> Informar Valores ao Cliente</h4>
            </div>

            <div class="box-body">
                <form id="form-valores">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="">Frete Loja <i class="fa fa-arrow-right"></i> Box4Buy</label>
                            <input type="text"
                                   name="frete"
                                   value="{{ $solicitacao->frete_loja }}"
                                   class="form-control money">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="">Valor dos produtos</label>
                            <input type="text"
                                   name="valorprodutos"
                                   readonly
                                   class="form-control">
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-footer">
                <button class="btn btn-info btn-rounded boxColorTema"
                        onclick="geravalores({{ $solicitacao->sequencia }})">
                    <i class="fa fa-send"></i> Gerar Orçamento
                </button>
            </div>
        </div>
    @endif

    @if($solicitacao->status_solicitacao == '11'
    || $solicitacao->status_solicitacao == '12'
    || $solicitacao->status_solicitacao == '13'
    || Auth::user()->type_user == '1')

      {{--Valores para impressão--}}
     <div class="box box-default hidden-sm hidden-md hidden-lg hidden-xs">
         <div class="box-header">
             <h4><i class="fa fa-money"></i> Valores do serviço</h4>
         </div>

         <div class="row hidden-sm hidden-md hidden-lg hidden-xs visible-print">
             <div class="table-responsive">
                 <table class="table table-bordered">
                     <thead>
                         <th><b>FRETE DA LOJA <i class="fa fa-arrow-right"></i> Box4Buy</b></th>
                         <th><b>TAXAS CAMBIAIS</b></th>
                         <th><b>TAXA DE SERVIÇO</b></th>
                         <th><b>TOTAL DA COMPRA</b></th>
                     </thead>
                     <tbody>
                        <tr>
                            <td>US$ {{ $solicitacao->frete_loja }}</td>
                            <td>US$ {{ $solicitacao->taxas }}</td>
                            <td>US$ {{ $solicitacao->taxa_servico }}</td>
                            <td>US$ {{ $solicitacao->total_compra }}</td>
                        </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

      {{--Valores para exibir em tela--}}
     <div class="box box-info hidden-print">
        <div class="box-header">
            <h4><i class="fa fa-money"></i> Valores do serviço</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                US$ {{ $solicitacao->frete_loja }}
                            </h3>
                            <p>FRETE LOJA <i class="fa fa-arrow-right"></i> Box4Buy</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                US$ {{ $solicitacao->taxas }}
                            </h3>
                            <p>TAXAS CAMBIAIS</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                US$ {{ $solicitacao->taxa_servico }}
                            </h3>
                            <p>TAXA DE SERVIÇO</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                US$ {{ $solicitacao->total_compra }}
                            </h3>
                            <p>TOTAL DA COMPRA</p>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->type_user == '2' && $solicitacao->status_solicitacao == '11')
            <div class="row hidden-print">
                <div class="col-sm-6">
                    <button type="button" onclick="cancelaPedido({{ $solicitacao->sequencia }})"
                            class="btn btn-danger btn-rounded btn-lg text-uppercase">
                        <i class="fa fa-trash"></i> Cancelar Pedido
                    </button>
                </div>
                <div class="col-sm-6">
                    <div class="paypal-container"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
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
                            value: "{{ $solicitacao->total_compra }}",
                            breakdown: {
                                // currency_code: 'USD',
                                item_total: {
                                    currency_code: 'USD',
                                    value:"{{ $solicitacao->total_compra }}"
                                }
                            }
                        },
                        items: [{
                            name: "Box4Buy - compra assistida",
                            unit_amount: {
                                currency_code: 'USD',
                                value: "{{ $solicitacao->total_compra }}"
                            },
                            description: "Entrega para a suite CB{{ Auth::user()->codigo_suite }}",
                            quantity: 1
                        }]
                    }]
                });
            },

            onApprove(data, actions) {
                // Capture the funds from the transaction
                /*return actions.order.capture().then(function(details) {
                    // Show a success message to your buyer
                    alert('Transaction completed by ' + details.payer.name.given_name);
                });*/
                axios.post("/compra-assistida/payment/{{ $solicitacao->sequencia }}").then(response => {
                    Swal({
                        title: 'Sucesso!',
                        text: response.data,
                        type: 'success',
                        confirmButtonText: 'OK',
                        onClose: reloadPage
                    });
                });

            }
        }).render('.paypal-container');

        function reloadPage() {
            location.href = location.href;
        }
    </script>
@endsection

@endif

    @include('compra_assistida.partials.add-produto')
@endsection



@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop
@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
    <script>
        // mascara para os inputs
        $('.money').maskMoney();

        function pagar(id)
        {
            axios.post('/compra-assistida/payment/' + id).then(response => {
                console.log('OK');
            })
        }

        function foraEstoque(id, select)
        {
            console.log(select.value);
            axios.put('/compra-assistida/foraestoque/' + id, {'fora_estoque': select.value}).then(response => {
                console.log('OK');
            });
        }


        $('.print_doc').click(() => {
            $('#print_compra').show();
            window.print();
        });

        var valor_total = $('#total_geral').html();

        $("input[name=valorprodutos]").val(valor_total);

        $('.additem').click(() => {
            var formitem = $('#additem').serialize();
            axios.post('/compra-assistida/save', formitem).then(response => {
                reloadPage();
            });
        });

        $('.edit-produto').click(() => {
            var formupdateitem = $('.update-item').serialize();
            // console.log(formupdateitem)
            axios.put('/compra-assistida/update', formupdateitem).then(response => {
                $.modal.close();
                Swal({
                    title: 'Sucesso!',
                    text: response.data,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadPage
                });
            });
        });

        function cancelaPedido(id)
        {
            Swal.fire({
                title: 'AVISO',
                text: 'Deseja cancelar esta solicitação?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                confirmButtonColor: '#d33',
                cancelButtonText: 'Não',
            }).then(result => {
                if(result.value) {
                    axios.post('/compra-assistida/cancelar/'+id).then(response => {
                        Swal({
                            title: 'Sucesso!',
                            text: response.data,
                            type: 'success',
                            confirmButtonText: 'OK',
                            onClose: reloadPage
                        });
                    });
                }
            });

        }

        function deletaProduto(id)
        {
            axios.delete('/compra-assistida/delete/'+ id).then(response => {
                reloadPage();
            });
        }

        function geravalores(id)
        {
            var form_valores = $('#form-valores').serialize();
            axios.put('/compra-assistida/valores/' + id, form_valores).then(response => {
                Swal({
                    title: 'Sucesso!',
                    text: response.data,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadPage
                });
            });
        }

        function reloadPage()
        {
            location.href = location.href;
        }
    </script>
@stop
