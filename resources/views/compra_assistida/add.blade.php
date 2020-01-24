@extends(((Auth::user()->type_user == '2') ? 'base.usuario-base' : 'base.base'))

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4><b>Adicionar produto</b></h4>
        </div>
        <div class="box-body">
            <form enctype="multipart/form-data" id="additem" method="POST">
                <input type="hidden" name="suite" value="{{ Auth::user()->codigo_suite }}">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Link:</label>
                        <input type="url" name="linkproduto" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label>Nome do produto:</label>
                        <input type="text" name="nomeproduto" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Tamanho:</label>
                        <input type="text" name="tamanhoproduto" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label>Cor:</label>
                        <input type="text" name="corproduto" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label>Substituir tamanho:</label>
                        <input type="text" name="substituitamanho" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label>Substituir cor:</label>
                        <input type="text" name="substituicor" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <label>Quantidade:</label>
                        <input type="number" name="quantidade" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <label>Valor:</label>
                        <input type="text" name="valorproduto" class="form-control money">
                    </div>

                    <div class="col-sm-8">
                        <label>Observações:</label>
                        <input type="text" name="obervacoes" class="form-control">
                        {{--<textarea class="form-control" name="observcaoes" cols="30" rows="10"></textarea>--}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4>Informações Adicionais</h4>
                    </div>

                </div>


                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>
                                    Se um item não estiver disponível:
                                    <select name="fora_estoque" class="form-control">
                                        <option value="1">Comprar os demais itens</option>
                                        <option value="2">Cancelar o pedido</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label>Observações Adicionais</label>
                        <textarea name="observacoesadicionais" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                </div>

                <div class="form-group">

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-rounded boxColorTema additem"><i class="fa fa-plus"></i> ADICIONAR PRODUTO</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header">
            <h4>PRODUTOS ADICIONADOS</h4>
        </div>

        <div class="box-body">
            @if(session()->has('items'))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Link</th>
                                <th>Descrição</th>
                                <th>Tamanho</th>
                                <th>Cor</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(session('items') as $key => $item)
                            <tr>
                                <td><a href="{{ $item['url'] }}">{{ $item['url'] }}</a></td>
                                <td>{{ $item['descricao'] }}</td>
                                <td>{{ $item['tamanho'] }}</td>
                                <td>{{ $item['cor'] }}</td>
                                <td>{{ $item['quantidade'] }}</td>
                                <td>{{ $item['valor'] }}</td>
                                <td>
                                    <a href="#edit-{{ $key }}"
                                       rel="modal:open"
                                       class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-edit"></i></a>
                                    <button type="button"
                                            class="btn btn-danger btn-rounded removeitem"
                                            onclick="removeitem({{ $key }})"><i class="fa fa-trash"></i></button>
                                </td>
                                @include('compra_assistida.partials.edit-item')
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-warning"><b>Nenhum registro encontrado</b></p>
            @endif
        </div>

        <div class="box-footer">
            @if(Session::has('items'))
            <button type="button"
                    data-itemid="{{ $key }}"
                    class="btn btn-info btn-rounded boxColorTema enviaPedido"><i class="fa fa-send"></i> ENVIAR PEDIDO</button>
            @endif
            <div class="pull-right">
                <h4><b>Total:</b> {{ session('total_produtos') == '' ? '0.00' : session('total_produtos') }} USD</h4>
            </div>
        </div>
    </div>


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

        $('.additem').click(() => {
            var formitem = $('#additem').serialize();
            axios.post('/compra-assistida/additems', formitem).then(response => {
                reloadPage();
            });
        });

        $('.edit-item').click(() => {
            var formupdateitem = $('.update-item').serialize();
            // console.log(formupdateitem)
            axios.post('/compra-assistida/updateitem', formupdateitem).then(response => {
                reloadPage();
            });
        });

        $('.enviaPedido').click(() => {
            var itemid = $('.enviaPedido').data('itemid');

            axios.post('/compra-assistida/save/' + itemid).then(response => {
                Swal({
                    title: 'Sucesso!',
                    text: response.data,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadPage
                });
            });
        });

        function removeitem(itemid)
        {
            axios.post('/compra-assistida/removeitems', {'itemid': itemid}).then(response => {
                reloadPage();
            });
        }

        function reloadPage()
        {
            location.href = location.href;
        }
    </script>
@stop
