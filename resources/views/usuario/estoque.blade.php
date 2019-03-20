@extends('base.usuario-base')
@section('content')

    <div class="box box-info">
        <div class="box-header">
            <h4>ESTOQUE</h4>
            <div class="box-tools">
                @if (Session::has('produtos'))
                    <a href="{{ route('user-carrinho') }}" id="user-cart" class="btn btn-default boxColorTema"><i
                                class="fa fa-shopping-cart"></i> Carrinho
                        <small class="label badge">{{ count(session('produtos')) == 0 ? '0' : count(session('produtos')) }}</small>
                    </a>            @endif
            </div>
        </div>
        <div class="box-body" id="estoque-content">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#produtos-estoque" data-toggle="tab" aria-expanded="true" id="item-produtos"><i
                                class="fa fa-list"></i> SEUS PRODUTOS</a>
                </li>
                <li>
                    <a href="#orcamento" data-toggle="tab" aria-expanded="false" id="item-orcamento"><i
                                class="fa fa-file"></i> ORÇAMENTO</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="produtos-estoque">
                    <div class="box box-info" id="products">
                        <div class="box-header">
                            <h4>Produtos em Estoque</h4>
                            <div class="box-tools">
                                {{-- <a href="#" id="sweetTeste" class="btn btn-default">TESTE</a> --}}
                                <a href="#product-new"
                                   class="btn btn-info boxColortema"
                                   rel="modal:open"
                                   title="Informar o envio de um produto para a Box4Buy">
                                    <i class="fa fa-plus"></i> NOVO PRODUTO
                                </a>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-hover table-responsive" id="estoque-produtos">
                                <thead>
                                <tr>
                                    <th>Rastreio Loja</th>
                                    <th>Produto</th>
                                    <th>fotos</th>
                                    <th>Peso</th>
                                    <th>Dias em Estoque</th>
                                    <th>Qtd. em Estoque</th>
                                    <th>Qtd. de Envio</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td><a href="#track-{{ $produto->seq_produto }}"
                                               data-codigo="{{ $produto->codigo_rastreio }}"
                                               data-produto="{{ $produto->seq_produto }}"
                                               class="rastreamento"
                                               rel="modal:open">{{ $produto->codigo_rastreio }}</a></td>
                                        <div class="modal custom-modal"
                                             id="track-{{ $produto->seq_produto }}">
                                            <div class="box-overlay">
                                                <i class="fa fa-spinner fa-spin fa-3x"></i>
                                            </div>
                                            <div class="box box-info">
                                                <div class="box-header">
                                                    <h4>TRACK NUMBER: {{ $produto->codigo_rastreio }}</h4>
                                                    <div class="box-tools">
                                                        <a href="#"
                                                           class="close"
                                                           rel="modal:close">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-sm-4 pull-right">
                                                                <h3 style="display: none" class="text text-success"
                                                                    id="status-{{$produto->seq_produto}}-delivered"><i
                                                                            class="fa fa-check-circle"
                                                                            id="icon-{{$produto->seq_produto}}-delivered"></i>
                                                                    Entregue
                                                                </h3>
                                                                <h3 style="display: none" class="text text-warning"
                                                                    id="status-{{$produto->seq_produto}}-transit"><i
                                                                            class="fa fa-car"
                                                                            id="icon-{{$produto->seq_produto}}-transit"></i>
                                                                    Em transito
                                                                </h3>
                                                                <h3 style="display: none" class="text text-info"
                                                                    id="status-{{$produto->seq_produto}}-info"><i
                                                                            class="fa fa-info-circle"
                                                                            id="icon-{{$produto->seq_produto}}-info"></i>
                                                                    Não informado
                                                                </h3>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="">Data:</label>
                                                                <span id="data_status-{{$produto->seq_produto}}"></span>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="">Localização:</label>
                                                                <span id="localizacao-{{$produto->seq_produto}}"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <td>{{ $produto->descricao_produto }}</td>
                                        <td><a href="#fotoproduto-{{ $produto->seq_produto }}" rel="modal:open"
                                               class="btn btn-primary boxColorTema" title="Visualizar Fotos"><i
                                                        class="fa fa-image"></i></a></td>
                                        <td>{{ $produto->peso }}</td>
                                        <td>{{ $produto->data_chegada != '' ? $produto->data_chegada->diffInDays() : 'Produto não chegou' }}</td>
                                        <td class="col-sm-2">{{ $produto->data_chegada != '' ? $produto->qtde : 'Produto não chegou' }}</td>
                                        <td class="col-sm-2"><input type="number" name="qtenvio" class="form-control"
                                                                    id="qtde-{{ $produto->seq_produto }}" value="1"
                                                                    max="{{ $produto->qtde }}"></td>
                                        <td>
                                            @if($produto->data_chegada == '' || $produto->qtde == 0)
                                                <button type="button" class="btn btn-danger qt"
                                                        title="Adicionar ao carrinho" disabled>
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-success qt"
                                                        title="Adicionar ao carrinho" id="{{ $produto->seq_produto }}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            @endif
                                            <a href="#edit-produto-{{ $produto->seq_produto }}"
                                               class="btn btn-default boxColorTema" rel="modal:open"><i
                                                        class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger delete-produto-{{ $produto->seq_produto }}"
                                                    type="button" onclick="deleteProduto({{ $produto->seq_produto }})">
                                                <i class="fa fa-trash"></i></button>
                                        </td>
                                        @include('usuario.partials.edit-produto')
                                    </tr>
                                    <div class="modal img-modal" id="fotoproduto-{{ $produto->seq_produto }}">
                                        <div class="box box-info">
                                            <div class="box-header">
                                                <h4>Fotos do produto - {{ $produto->descricao_produto }}
                                                    id {{ $produto->seq_produto }}</h4>
                                                <div class="box-tools">
                                                    <a href="#" rel="modal:close" class="close"><i
                                                                class="fa fa-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                @foreach ($produto->fotos as $imagem)
                                                    <li class="col-lg-4 col-md-6 col-sm-6 col-xs-12 img-list"
                                                        style="list-style: none">
                                                        <div class="card estoque-card">
                                                            <a href="#detalhe-{{ $imagem->seq_imagem }}"
                                                               rel="modal:open">
                                                                <img src="{{ $imagem->caminho_imagem }}"
                                                                     class="card-img-top img-responsive" alt="">
                                                            </a>
                                                            <div class="modal custom-modal"
                                                                 id="detalhe-{{ $imagem->seq_imagem }}">
                                                                <div class="box">
                                                                    <div class="box-header">
                                                                        <div class="box-tools">
                                                                            <a href="#" class="close" rel="modal:close"><i
                                                                                        class="fa fa-close"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="box-header">
                                                                        <div class="col-sm-12">
                                                                            <img src="{{ $imagem->caminho_imagem }}"
                                                                                 class="img-responsive" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body"
                                                             style="margin-top: -31px; margin-left: 6px">
                                                            <p class="card-text">Postado
                                                                em: {{ $imagem->data_cadastro->format('d/m/Y') }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="orcamento">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4>AGUARDANDO APROVAÇÃO</h4>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-hover table-responsive" id="aguardando">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Suite</th>
                                    <th>Pacote</th>
                                    <th>Produtos</th>
                                    <th>Peso(lbs)</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aguardando as $a)
                                    <tr>
                                        <td>{{ $a->sequencia }}</td>
                                        <td>{{ session('suite_prefix') }}{{ $a->codigo_suite }}</td>
                                        <td>
                                            @switch($a->codigo_pacote) @case(1) First class @break @case(2) Priority
                                            Mail @break @case(3) Priority Express @break @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('orcamento-detalhe-usuario', $a->sequencia) }}"
                                               id="{{ $a->sequencia }}" class="btn btn-info boxColorTema">
                                                <i class="fa fa-eye"></i> Produtos</a>
                                        </td>
                                        <td>{{ $a->peso_total }}</td>
                                        <td>{{ number_format($a->vlr_final,2,',', '.') }}</td>
                                        <td>
                                            <span class="label label-warning">Pendente</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('orcamento-edit-usuario', $a->sequencia) }}"
                                               class="btn btn-warning">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn btn-danger orcamento-cancelar"
                                                    data-orcamento="{{ $a->sequencia }}"><i class="fa fa-remove"></i>
                                                Cancelar Orçamento
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h4>ORÇAMENTOS APROVADOS</h4>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-hover table-responsive" id="aprovado">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Suite</th>
                                    <th>Pacote</th>
                                    <th>Produtos</th>
                                    <th>Peso(lbs)</th>
                                    <th>Valor</th>
                                    <th>Pago</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aprovado as $ap)
                                    <tr>
                                        <td>{{ $ap->sequencia }}</td>
                                        <td>{{ session('suite_prefix') }}{{ $ap->codigo_suite }}</td>
                                        <td>
                                            @switch($ap->codigo_pacote) @case(1) First class @break @case(2) Priority
                                            Mail @break @case(3) Priority Express @break @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('orcamento-detalhe-usuario', $ap->sequencia) }}"
                                               id="{{ $ap->sequencia }}" class="btn btn-info boxColorTema">
                                                <i class="fa fa-eye"></i> Produtos</a>
                                        </td>
                                        <td>{{ $ap->peso_total }}</td>
                                        <td>{{ number_format($ap->vlr_final,2,',', '.') }}</td>
                                        <td>
                                            <span class="label label-danger">Não</span>
                                        </td>
                                        <td>
                                            <span class="label label-success">Aprovado</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info boxColorTema"><i class="fa fa-eye"></i> Ver Detalhes</a>
                                            @switch($libera_pagamento[0]->libera_pagamento)
                                                @case('1')
                                            <p>Va até a <a href="{{ route('home') }}" class="btn btn-link">pagina
                                                    inicial</a> e clique em validar conta para enviar
                                                seus documentos e habilitar o pagamento de suas mercadorias</p>
                                                @break
                                                @case('2')
                                            <a href="{{ route('pagamento-invoice', $ap->sequencia) }}"
                                               class="btn btn-info boxColorTema"><i class="fa fa-paypal"></i>
                                                Pagar</a>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <h4>ORÇAMENTOS PAGOS</h4>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-hover table-responsive" id="pago">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Suite</th>
                                    <th>Pacote</th>
                                    <th>Produtos</th>
                                    <th>Peso(lbs)</th>
                                    <th>Valor</th>
                                    <th>Pago</th>
                                    <th>Status</th>
                                    <th>Recibo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pago as $pg)
                                    <tr>
                                        <td>{{ $pg->sequencia }}</td>
                                        <td>{{ session('suite_prefix') }}{{ $pg->codigo_suite }}</td>
                                        <td>
                                            @switch($pg->codigo_pacote) @case(1) First class @break @case(2) Priority
                                            Mail @break @case(3) Priority Express @break @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('orcamento-detalhe-usuario', $pg->sequencia) }}"
                                               id="{{ $pg->sequencia }}" class="btn btn-info boxColorTema">
                                                <i class="fa fa-eye"></i> Produtos</a>
                                        </td>
                                        <td>{{ $pg->peso_total }}</td>
                                        <td>{{ number_format($pg->vlr_final,2,',', '.') }}</td>
                                        <td>
                                            <span class="label label-success">Sim</span>
                                        </td>
                                        <td>
                                            <span class="label label-success">Aprovado</span>
                                        </td>
                                        <td><a href="{{ route('gerapdf', $pg->sequencia) }}" target="_blank"
                                               class="btn btn-default"><i class="fa fa-file-text"></i> Gerar Recibo</a>
                                        </td>
                                        {{--
                                        <td>
                                            <a href="{{ route('orcamento-edit', $a->sequencia) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal" id="product-new">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header">
                        <h4 class="text-center">INFORMAR PRODUTO ENVIADO A BOX4BUY</h4>
                        <div class="box-tools">
                            <a href="#" class="close" rel="modal:close"><i class="fa fa-close"></i></a>
                        </div>
                    </div>

                    <form class="form-horizontal" id="form-estoque" enctype="multipart/form-data" method="POST">
                        <div class="box-body">
                            <input type="hidden" name="suite" value="{{ Auth::user()->codigo_suite }}">
                            <input type="hidden" name="_typeuser" value="{{ Auth::user()->type_user }}">
                            <div class="form-group">
                                <label class="control-label col-sm-2">produto:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="descricao" placeholder="Descrição do produto"
                                           class="form-control">
                                </div>

                                <label class="control-label col-sm-2">Quantidade:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="quantidade" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2">Nome da Loja:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="nomeloja">
                                </div>

                                <label class="control-label col-sm-2">Site da Loja:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="siteloja">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2">Track Number:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="codigorastreio"
                                           placeholder="Código de Rastreio">
                                </div>

                                <label class="control-label col-sm-2">Data da compra:</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="datacompra">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-info boxColorTema" id="send-produto-user"><i
                                        class="fa fa-check"></i> Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


@stop
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
        $('#estoque-produtos').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
        });
        $('#aguardando').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
        });
        $('#aprovado').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
        });
        $('#pago').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
        });

        $('.removeitem').click(function (e) {
            e.preventDefault();
            var seq_produto = e.target.id;
            axios.get('/estoque/adiciona/quantidade/' + seq_produto).then(response => {
                location.href = location.href;
                console.log(response.data);
            });
        });

        function getTotal() {
            var arr = document.getElementsByName('valor_declarado[]');
            var totalItens = document.getElementsByClassName('qtde-produto');
            var total = 0;
            var sumitens = 0;

            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    // console.log(totalItens)
                    sumitens += parseFloat(totalItens[i].innerText);
                    total += parseFloat(arr[i].value) * sumitens;
                }
            }
            console.log(total);

            var tf = document.getElementById('ver_valor_declarado').innerText;
            console.log(tf);
            // document.getElementById('total-declarado').value = total;
        }

        function deleteProduto(id) {
            Swal.fire({
                title: 'Você tem certeza disso?',
                text: 'Deseja deletar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                confirmButtonColor: '#d33',
                cancelButtonText: 'Não',
            }).then(result => {
                if (result.value) {
                    axios.delete('/estoque/delete/' + id).then(response => {
                        // toastr.success(response.data.msg);
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Produto removido com sucesso.',
                            type: 'success',
                            // onClose: reloadPage
                            onClose: reloadPage
                        });
                    });
                }
            });

            function reloadPage() {
                // location.href = self.location;
                $('#product').boxRefresh('load');
            }
        }

        $('.rastreamento').click(function () {
            var codigo = $(this).data('codigo');
            var produto = $(this).data('produto');
            console.log(codigo);
            var url = '/pacote/' + codigo;
            axios.get(url).then(response => {
                $('.box-overlay').hide();
                var produtoid = $(this).data('produto');
                var deliveryStatus = response.data.situacao;

                var delivered = $('#status-' + produtoid + '-delivered');

                var transit = $('#status-' + produtoid + '-transit');

                var info = $('#status-' + produtoid + '-info');

                $('#data_status-' + produtoid).append(response.data.data_evento);
                $('#localizacao-' + produtoid).append(response.data.localizacao);
                switch (deliveryStatus) {
                    case 'in_transit':
                        transit.css('display', 'block');
                        break;
                    case 'delivered':
                        delivered.css('display', 'block');
                        break;
                    case 'unknown':
                        transit.css('display', 'block');
                        break;
                    case 'error':
                        info.css('display', 'block');
                        break;
                }
                console.log(response.data.data_evento, produtoid);
            });
            $('#track-' + produto).on($.modal.AFTER_CLOSE, () => {
                $('#data_status-' + produto).empty();
                $('#localizacao-' + produto).empty();
                $('.box-overlay').show();
            });
        });
    </script>
    <script src="{{ asset('js/orcamento.js') }}"></script>


@stop