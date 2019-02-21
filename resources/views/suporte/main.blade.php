@extends('base.usuario-base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>Suporte</h4>
            <div class="box-tools">
                <a href="{{ route('ticketadd') }}" class="btn btn-info boxColortema"><i class="fa fa-plus"></i> Novo Chamado</a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered" id="suporte">
                <thead>
                    <th>Categoria</th>
                    <th>Assunto</th>
                    <th>Status</th>
                    <th>Prioridade</th>                    
                    <th>Ações</th>
                </thead>
                <tbody>
                    @foreach($mensagens as $mensagem)
                    <tr>
                        <td class="col-sm-1">
                            @foreach ($categorias as $categoria)
                            {{ $categoria->name }}
                            @endforeach
                        </td>
                        <td><a href="{{ route('ticketshow', $mensagem->ticket_id) }}">BXB_{{ $mensagem->ticket_id }} - {{ $mensagem->title }}</a></td>
                        <td>
                            @switch($mensagem->status)
                            @case('aberto')
                                <span class="label label-success">Aberto</span>
                                @break
                            @case('respondido')
                                <span class="label label-info">Respondido</span>
                                @break
                            @case('fechado')
                                <span class="label label-danger">Fechado</span>
                                @break                                
                            @endswitch
                        </td>
                        @switch($mensagem->priority)
                            @case('alta')
                                <td><span class="label label-danger">Alta</span></td>        
                                @break
                            @case('media')
                                <td><span class="label label-warning">Média</span></td>
                                @break
                            @case('baixa')
                                <td><span class="label label-success">Baixa</span></td>
                                @break
                        @endswitch
                                                
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
    <script>
        $('#suporte').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            }
        });
    </script>    
@endsection