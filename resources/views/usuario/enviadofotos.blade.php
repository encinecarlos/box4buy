@extends('base.usuario-base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>Fotos do produto</h4>
            <div class="box-tools">
                <a href="{{ route('enviados') }}" rel="modal:close" class="btn btn-rounded btn-link">
                    <i class="fa fa-chevron-left"></i> Voltar aos produtos Enviados
                </a>
            </div>
        </div>
        <div class="box-body">
            @foreach ($fotos as $imagem)
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
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection


