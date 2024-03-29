@extends('base.usuario-base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4><i class="fa fa-shopping-cart"></i> COMPRA ASSISTIDA</h4>
            <div class="box-tools">
                <a href="{{ route('compra.add') }}" class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-plus"></i> SOLICITAR COMPRA ASSISTIDA</a>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="orcamento_compras">
                    <thead>
                        <tr>
                            <th>Código</th>
                            @if(Auth::user()->type_user == '1')
                            <th>Suite</th>
                            @endif
                            <th>Status</th>
                            <th>Data de Solicitação</th>
                            <th>Ultima atualização</th>
                            <th>Ações</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                        <tr>
                            <td class="col-sm-1">{{ $compra->sequencia }}</td>
                            @if(Auth::user()->type_user == '1')
                            <td>CB{{ $compra->codigo_suite }}</td>
                            @endif
                            <td class="col-sm-1 text-center">
                                @switch($compra->status_solicitacao)
                                    @case('10')
                                    <span class="badge bg-gray text-uppercase">Processando</span>
                                    @break
                                    @case('11')
                                    <span class="badge bg-yellow text-uppercase">Respondido</span>
                                    @break
                                    @case('12')
                                    <span class="badge bg-green text-uppercase"><i class="fa fa-check"></i> Concluido</span>
                                    @break
                                    @case('13')
                                    <span class="badge bg-red text-uppercase"><i class="fa fa-close"></i> Cancelado</span>
                                    @break
                                @endswitch

                            </td>
                            <td class="col-sm-2 text-center">{{ $compra->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="col-sm-2 text- center">{{ $compra->updated_at->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <a href="{{ route('compra.edit', $compra->sequencia) }}" class="btn btn-info btn-rounded boxColorTema">
                                    <i class="fa fa-eye"></i> Detalhes
                                </a>
                                <a href="#" onclick="deletaSolicitacao({{ $compra->sequencia }})" class="btn btn-danger btn-rounded">
                                    <i class="fa fa-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
    <script>
        $('#orcamento_compras').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
        });

        function deletaSolicitacao(id)
        {
            Swal.fire({
                title: 'AVISO',
                text: 'Deseja remover esta solicitação?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                confirmButtonColor: '#d33',
                cancelButtonText: 'Não',
            }).then(result => {
                if(result.value) {
                    axios.delete('/compra-assistida/solicitacao/delete/'+id).then(response => {
                        Swal({
                            title: 'Sucesso!',
                            text: response.data,
                            type: 'success',
                            confirmButtonText: 'OK',
                            // onClose: reloadPage
                        }).then(confirm => {
                            if(confirm) {
                                location.reload();
                            }
                        });
                    });
                }
            });
        }

        function reloadPage() {
            location.href = location.href;
        }
    </script>
@endsection
