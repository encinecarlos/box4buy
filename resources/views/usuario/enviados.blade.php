@extends('base.usuario-base')

@section('content')
    <!-- ==============  INICIO DO ORÇAMENTO ==============  -->
    <div class="box box-info">
        <div class="box-header with-border">
            <br>
            <a><i class="fa fa-paper-plane"></i> <span>ENVIADOS</span></a>
            <br />
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
            <h4 class="box-title text-uppercase">Produtos enviados</h4>
            <table id="enviados" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">Orçamento</th>
                    <th class="text-center">Código Rastreio</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Fotos</th>
                    <th class="text-center">Peso Total</th>
                    <th class="text-center">Data de Envio</th>
                    {{--<th class="text-center">Confirmar Recebimento</th>
                    <th class="text-center">Suporte</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($enviados as $env)
                    <tr>
                        <td class="text-center">{{ $env->codigo_orcamento }}</td>
                        <td class="text-center">{{ !is_null($env->orcamento->cod_rastreio) ? $env->orcamento->cod_rastreio : 'Rastreio não informado' }}</td>
                        <td class="text-center">{{ $env->descricao }}</td>
                        <td class="text-center">{{ $env->orcamento->vlr_final }}</td>
                        <td class="text-center">
                            <a href="{{ route('enviados.fotos', $env->codigo_produto) }}"
                               class="btn btn-primary btn-rounded boxColorTema"
                               title="Visualizar Fotos">
                                <i class="fa fa-image"></i>
                            </a>
                        </td>
                        <td class="text-center">{{ $env->orcamento->peso_total }}</td>
                        <td class="text-center">
                            {{ !is_null($env->orcamento->data_envio) ? $env->orcamento->data_envio->format('d/m/Y') : 'Não informado' }}
                        </td>
                        {{--<td class="text-center"><a href="#" class="btn btn-info BoxColorTema"><i class="fa da-check"></i></a></td>
                        <td class="text-center"><a href="#" class="btn btn-info boxColorTema"><i class="fa fa-ticket"></i></a></td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br>
    </div>
    <!-- ==============  FIM DO ORÇAMENTO ==============  -->
@stop

@section('css')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/star.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/usuario-estoque.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    {{--<script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>--}}

    <script>
        $('#enviados').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
        });
    </script>
@stop
