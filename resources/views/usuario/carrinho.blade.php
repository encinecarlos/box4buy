﻿@extends('base.usuario-base')

@section('content')
    <!-- ==============  INICIO DO CARRINHO ==============  -->
    <div class="box box-info">
        <div class="box-header">
            <h4>Carrinho</h4>
            <div class="box-tools">
                <a href="{{ url()->route('estoque') }}"><i class="fa fa-chevron-left"></i> Voltar</a>
            </div>
        </div>
        <div class="box-body">
            <div class="alert alert-danger alert-errors hide">
                <ul id="list-error" style="list-style-type: none">
                </ul>
            </div>

            <form class="form-horizontal" id="frm-orcamento" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="total_declarado" id="total-declarado">
                <div class="box-body">
                    <div class="box-body">
                        <table id="tb_produtos" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Cód. Produto</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Peso</th>
                                <th>Fotos</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Session::has('produtos'))
                                @foreach(session('produtos') as $es => $value)
                                    <tr>
                                        <td class="col-sm-1">{{ $value['id'] }}</td>
                                        <td>{{ $value['descricao'] }}</td>
                                        <td class="col-sm-2">
                                            <div class="input-group">
                                                <input type="text"
                                                       value="{{ $value['qtde'] }}"
                                                       id="edita-{{ $es }}"
                                                       data-produto="{{ $value['id'] }}"
                                                       class="form-control qtde-produto">
                                                <div class="input-group-btn">
                                                    <button class="btn changeqtd" id="{{ $es }}" type="button"
                                                            title="Alterar quantidade"><i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1"
                                            id="peso_valor">{{ $value['peso'] != '' ? $value['peso'] : '0' }}</td>
                                        <td class="col-sm-1 text-center" id="valor_declarado">
                                            <a href="#fotoproduto-{{ $value['id'] }}" class="btn boxColorTema btn-rounded" rel="modal:open">
                                                <i class="fa fa-image"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#"
                                               id="{{ $es }}"
                                               class="btn btn-danger btn-rounded removeproduto"
                                               data-product="{{ $value['id'] }}"
                                               data-qtd="{{ $value['qtde'] }}">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal img-modal" id="fotoproduto-{{ $value['id'] }}">
                                        <div class="box box-info">
                                            <div class="box-header">
                                                <h4>Fotos do produto</h4>
                                                <div class="box-tools">
                                                    <a href="#" rel="modal:close" class="close"><i
                                                                class="fa fa-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="row">
                                                    @foreach ($value['imagens'] as $imagem)
                                                        <div class="col-lg-6"
                                                             style="list-style: none">
                                                            <img src="{{ $imagem['foto'] }}"
                                                                 class="img-responsive img-thumbnail"
                                                                 alt="">
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="pull-right">
                                    <tr>
                                        <td colspan="2"><b>Total:</b></td>
                                        <td><input class="form-control" name="qtd" id="itens-total" value="{{ $total['total_produtos'] }}" readonly></td>
                                        <td><input class="form-control" name="peso" id="peso-total" value="{{ $total['total_peso'] }}" readonly></td>
                                    </tr>
                                </div>

                            @else
                                <div class="alert alert-secondary text-center">
                                    <h3>SEU CARRINHO ESTÁ VAZIO</h3>
                                    <span>Adicione produtos para dar inicio a sua solicitação de orçamento</span>
                                </div>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="form-gorup">
                            <label for="inputMeuCodigo" class="col-sm-1 control-label">Tipo de Frete</label>
                            <div class="col-sm-10">
                                <select name="codigo_pacote" class="form-control" id="pacote" style="width: 100%;">
                                    <option value="1">FIRST CLASS - até 4 LBS</option>
                                    <option value="2">PRIORITY MAIL - até 66 LBS</option>
                                    <option value="3">PRIORITY EXPRESS - até 66 LBS</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--<div class="row" id="linha_seguro">
                        <div class="form-gorup">
                            <label for="inputValida" class="col-sm-1 control-label">Seguro:</label>
                            <div class="col-sm-6">
                                <select name="seguro" class="form-control select2" style="width: 100%;">
                                    <option value="1">Sim</option>
                                    <option value="2" selected>Não</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <span class="text text-danger">O valor do seguro é de 5% do valor declarado</span>
                            </div>
                        </div>
                    </div>--}}

                    <div class="form-group">
                        <label for="inputValida" class="col-sm-1 control-label">Endereço de Entrega</label>
                        <div class="col-sm-10">
                            <select name="codigo_endereco" class="form-control select2" style="width: 100%;">
                                <!-- AQUI ENTRAM OS ENDEREÇOS CADASTRADOS PELO CLIENTE  -->
                                @foreach($endereco as $e)
                                    <option value="{{ $e->seq_endereco }}">{{ $e->endereco }}, {{ $e->numero }}
                                        - {{ $e->bairro }} - {{ $e->cidade }} / {{ $e->codigo_postal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <h4>INFORMAÇÕES EXTRAS</h4>
                    </div>

                    <div class="row">
                        <table class="table">
                            <tr>
                                <th class="col-sm-3">Seguro?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="seguro" class="form-control select2" style="width: 100%;">
                                            <option value="1">Sim (Acréscimo de 3% no valor do serviço)</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">Fechar toda a caixa com fita para ter uma proteção extra?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="protecao_extra" class="form-control select2" style="width: 100%;">
                                            <option value="1">Sim (Acréscimo de U$1.00 no valor do serviço)</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">Enviar Nota Fiscal do produto?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="envianf" class="form-control">
                                            <option value="1">Sim</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Enviar Propaganda do produto?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="enviapropaganda" class="form-control">
                                            <option value="1">Sim</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">Envia caixas originais?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="caixaoriginal" class="form-control">
                                            <option value="1">Sim</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">Descartar sacolas do produto?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="sacolaoriginal" class="form-control">
                                            <option value="1">Sim</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">Retirar etiquetas de preço do produto?</th>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="etiquetaoriginal" class="form-control">
                                            <option value="1">Sim</option>
                                            <option value="2" selected>Não</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

                <div class="box-body">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <table id="example2" class="table table-bordered pull-right">
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    {{-- <button type="button" id="geraorcamento" class="btn btn-info btn-lg boxColorTema pull-right">
                                        <i class="fa fa-money"></i> Solicitar Orçamento</button> --}}
                                    <a href="#verificadados"
                                       class="btn btn-info btn-lg btn-rounded boxColorTema pull-right"
                                       id="solicita_orcamento"
                                       data-suite="{{ Auth::user()->codigo_suite }}"
                                       rel="modal:open">
                                        <i class="fa fa-money"></i> Solicitar Orçamento</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('usuario.partials.dadoscarrinho')
    <!-- ==============  FIM DO CARRINHO ==============  -->

@stop

@section('css')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

@stop

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="{{ asset('js/orcamento.js') }}"></script>
    <script>
        $('.removeitem').click(function (e) {
            e.preventDefault();
            var seq_produto = e.target.id;
            axios.get('/estoque/adiciona/quantidade/' + seq_produto).then(response => {
                location.href = '{{ route('estoque') }}';
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
    </script>
@stop
