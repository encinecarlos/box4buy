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
                            <td class="col-sm-1 text-center">
                                @switch($compra->status_solicitacao)
                                    @case('10')
                                    <span class="badge bg-gray">Processando</span>
                                    @break
                                    @case('11')
                                    <span class="badge bg-yellow">Respondido</span>
                                    @break
                                    @case('12')
                                    <span class="badge bg-green"><i class="fa fa-check"></i> Concluido</span>
                                    @break
                                @endswitch

                            </td>
                            <td class="col-sm-2 text-center">{{ $compra->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="col-sm-2 text- center">{{ $compra->updated_at->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <a href="" class="btn btn-info btn-rounded boxColorTema">
                                    <i class="fa fa-eye"></i> Visualizar
                                </a>
                                <a href="" class="btn btn-danger btn-rounded">
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
    </script>
@endsection
