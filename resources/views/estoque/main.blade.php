@extends('base.base') 
@section('content')

<div class="box box-info">
    <div class="box-header">
        <h4>ESTOQUE</h4>
        <div class="box-tools">
            <a href="#product-new" class="btn btn-info btn-rounded boxColorTema" rel="modal:open" title="Informar o envio de um produto para a Box4Buy"><i class="fa fa-plus"></i> NOVO PRODUTO</a>
        </div>
    </div>

    <div class="box-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#achegar" data-toggle="tab" aria-expanded="true"><i class="fa fa-send"></i> ENVIADOS A BOX4BUY</a></li>
            <li><a href="#noestoque" data-toggle="tab" aria-expanded="false"><i class="fa fa-archive"></i> PRODUTOS NO ESTOQUE</a></li>
            <li><a href="#emorcamento" data-toggle="tab" aria-expanded="false"><i class="fa fa-file-text"></i> EM ORÇAMENTO</a></li>
            <li><a href="#enviados-cliente" data-toggle="tab" aria-expanded="false"><i class="fa fa-globe"></i> ENVIADOS PARA O CLIENTE</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="achegar">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>PRODUTO ENVIADOS A BOX4BUY</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover table-responsive" id="enviados">
                            <thead>
                                <tr>
                                    <th>Suite</th>
                                    <th>Produto</th>
                                    <th>Track Number</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($achegar as $ac)
                                <tr>
                                    <td class="col-sm-1">{{ $ac->codigo_suite }}</td>
                                    <td>{{ $ac->descricao_produto }}</td>
                                    <td>{{ $ac->codigo_rastreio }}</td>
                                    <td>
                                        <a href="{{ route('edit-produto', [$ac->codigo_suite, $ac->seq_produto]) }}"
                                           class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-rounded delete-produto-{{ $ac->seq_produto }}" type="button" onclick="deleteProduto({{ $ac->seq_produto }})"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="noestoque">
                <div class="box box-info">
                    <div class="box-header table-responsive">
                        <h4>PRODUTOS DISPONÍVEIS NO ESTOQUE</h4>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-responsive" id="disponiveis">
                            <thead>
                                <tr>
                                    <th>Suite</th>
                                    <th>Produto</th>
                                    <th>Dias em estoque</th>
                                    <th>Qtde. em estoque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estoque as $e)
                                <tr>
                                    <td class="col-sm-1">{{ $e->codigo_suite }}</td>
                                    <td>{{ $e->descricao_produto }}</td>
                                    <td>{{ $e->data_chegada->diffInDays() }}</td>
                                    <td>{{ $e->qtde }}</td>
                                    <td>
                                        <a href="{{ route('edit-produto', [$e->codigo_suite, $e->seq_produto]) }}"
                                           class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="emorcamento">
                <div class="box box-info">
                    <div class="box-header table-responsive">
                        <h4>PRODUTOS EM FASE DE ORÇAMENTO</h4>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-responsive" id="orcamento">
                            <thead>
                                <tr>
                                    <th>Suite</th>
                                    <th>Cód. Orçamento</th>
                                    <th>Cód. Produto</th>
                                    <th>Produto</th>
                                    <th>Dias em estoque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orcamentos as $es)
                                <tr>
                                    <td class="col-sm-1">{{ $es->codigo_suite }}</td>
                                    <td class="col-sm-1">{{ $es->codigo_orcamento }}</td>
                                    <td class="col-sm-1">{{ $es->codigo_produto }}</td>
                                    <td>{{ $es->descricao_produto }}</td>
                                    <td class="col-sm-1">{{ Carbon\Carbon::parse($es->dias_estoque)->diffInDays() }}</td>
                                    <td>
                                        <a href="{{ route('edit-produto', [$es->codigo_suite, $es->seq_produto]) }}"
                                           class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="enviados-cliente">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>PRODUTOS ENVIADOS PARA O CLIENTE</h4>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover table-responsive" id="despachados">
                            <thead>
                                <tr>
                                    <th>Suite</th>
                                    <th>Produto</th>
                                    <th>Data de Envio</th>
                                    <th>Track Number</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enviado as $ed)
                                <tr>
                                    <td class="col-sm-1">{{ $ed->codigo_suite }}</td>
                                    <td>{{ $ed->descricao }}</td>
                                    <td>{{ $ed->data_envio != '' ? $ed->data_envio->format('d/m/Y') : 'Não informado' }}</td>
                                    <td>{{ $ed->cod_rastreio != '' ? $ed->cod_rastreio : 'Não informado' }}</td>
                                    <td>
                                        <a href="{{ route('edit-produto', [$ed->codigo_suite, $ed->seq_produto]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
                    <input type="hidden" name="_typeuser" value="{{ Auth::user()->type_user }}">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Cliente:</label>
                        <div class="col-sm-8">
                            <select name="suite" class="form-control">
                                @foreach($usuario as $user)
                                    <option value="{{ $user->codigo_suite }}">CB#{{ $user->codigo_suite }} - {{ $user->nome_completo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">produto:</label>
                        <div class="col-sm-4">
                            <input type="text" name="descricao" placeholder="Descrição do produto" class="form-control">
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
                            <input type="text" class="form-control" name="codigorastreio" placeholder="Código de Rastreio">
                        </div>

                        <label class="control-label col-sm-2">Data da compra:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="datacompra">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-info boxColorTema" id="send-produto-user"><i class="fa fa-check"></i> Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>






@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
@stop 
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
<script>
    $('#enviados').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
            responsive: true
        });
        $('#disponiveis').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
            responsive: true
        });
        $('#orcamento').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[1, 'desc']],
            responsive: true
        });
        $('#despachados').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
            responsive: true
        });

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
                    axios.delete('/admin/estoque/delete/' + id).then(response => {
                        Swal({
                            title: 'Sucesso!',
                            text: 'Produto removido com sucesso.',
                            type: 'success',
                            confirmButtonText: 'OK',
                            onClose: reloadPage
                        });
                    });
                }
            });


            function reloadPage() {
                location.href = self.location;
            }
        }

</script>







@stop
