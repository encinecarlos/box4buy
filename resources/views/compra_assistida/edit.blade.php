@extends(((Auth::user()->type_user == '2') ? 'base.usuario-base' : 'base.base'))

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4><i class="fa fa-edit"></i> Editar Compra Assistida</h4>
            <div class="box-tools">
                <a href="{{ url()->route('compra.main') }}"><i class="fa fa-chevron-left"></i> Voltar</a>
            </div>

            <div class="box-body">
                <div class="row">
                    <p><b>Cliente:</b> {{ Auth::user()->nome_completo }}</p>
                    <p><b>Data/Hora:</b> {{ date('d/m/Y H:i:s') }}</p>
                </div>
                @if(Auth::user()->type_user == '2')
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Valor</th>
                                    <th>Qtde</th>
                                    <th>Cor</th>
                                    <th>Tamanho</th>
                                    <th>Observações</th>
                                    <th>Impostos</th>
                                    <th>Subtotal</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($solicitacao->produtos as $produto)
                                <tr class="text-center">
                                    <td class="text-left"><a href="{{ $produto->link_produto }}" target="_blank">{{ $produto->link_produto }}</a></td>
                                    <td>$ {{ number_format($produto->preco, '2') }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->cor }}</td>
                                    <td>{{ $produto->tamanho }}</td>
                                    <td>{{ $produto->observacao }}</td>
                                    <td></td>
                                    <td>$ {{ Utils::subTotal($produto->quantidade, $produto->preco) }}</td>
                                    <td>
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
                            {{--<tfoot class="text-right">
                                <tr>
                                    <td colspan="7"><h4><b>Total:</b></h4></td>
                                    <td class="text-center"><h4>$ {{ Utils::total($solicitacao) }}</h4></td>
                                </tr>
                            </tfoot>--}}
                        </table>
                    </div>
                </div>
                <div class="row">
                    <label>Observações Adicionais:</label>
                    <p>{{ $solicitacao->obervacoes }}</p>
                </div>
                @endif
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <a href="#produtoadd"
                       rel="modal:open"
                       class="btn btn-info btn-rounded boxColorTema">
                        <i class="fa fa-plus-circle"></i> Adicionar outro produto
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header">
            <h4><i class="fa fa-money"></i> Valores do serviço</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                $ {{ Utils::total($solicitacao) }}
                            </h3>
                            <p>FRETE LOJA -> Box4Buy</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                $ {{ Utils::total($solicitacao) }}
                            </h3>
                            <p>TAXAS CAMBIAIS</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                $ {{ Utils::total($solicitacao) }}
                            </h3>
                            <p>TAXA DE SERVIÇO</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box boxColorTema text-center">
                        <div class="inner">
                            <h3>
                                $ {{ Utils::total($solicitacao) }}
                            </h3>
                            <p>TOTAL DA COMPRA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        function deletaProduto(id)
        {
            axios.delete('/compra-assistida/delete/'+ id).then(response => {
                reloadPage();
            });
        }

        function reloadPage()
        {
            location.href = location.href;
        }
    </script>
@stop
