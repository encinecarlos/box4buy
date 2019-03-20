@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>
                <b>Editar Produto - Suite: {{ session('suite_prefix') }}{{ $cliente[0]['codigo_suite'] }} ({{ $cliente[0]['nome_completo']
                }})</b>
            </h4>
            <div class="box-tools">
                <a href="{{ url()->previous() }}" class="btn btn-link">
                    <i class="fa fa-arrow-circle-left"></i> Voltar</a>
            </div>
        </div>
        <div class="box-body">
            <div class="box box-info">
                <div class="box-header">
                    <h4>
                        <b>Informações do produto</b>
                    </h4>
                </div>
                <div class="box-body">
                    <form enctype="multipart/form-data" method="POST" id="form-produtoupdate">
                        {{ csrf_field() }}
                        <input type="hidden" name="suite" value="{{ $produto[0]['codigo_suite'] }}">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-sm-1">Descrição:</label>
                                <div class="col-sm-2">
                                    <input name="descricao_produto" type="text"
                                           value="{{ $produto[0]['descricao_produto'] }}" class="form-control">
                                </div>

                                <label class="control-label col-sm-1">Data de compra:</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                           value="{{ date('d/m/Y', strtotime($produto[0]['data_compra'])) }}"
                                           class="form-control" disabled>
                                </div>

                                <label class="control-label col-sm-1">Dias no estoque</label>
                                <div class="col-sm-2">
                                    <input type="text"
                                           value="{{ $produto[0]['data_chegada'] != '' ? $produto[0]['data_chegada']->diffInDays() : 'Produto não chegou' }}"
                                           class="form-control" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-sm-1">Rastreio:</label>
                                <div class="col-sm-2">
                                    <input type="text" name="track_number" value="{{ $produto[0]['codigo_rastreio'] }}"
                                           class="form-control">
                                </div>

                                <label class="control-label col-sm-1">Nome da loja:</label>
                                <div class="col-sm-2">
                                    <input type="text" value="{{ $produto[0]['nome_loja'] }}" name="nome_loja"
                                           class="form-control">
                                </div>

                                <label class="control-label col-sm-1">Site:</label>
                                <div class="col-sm-2">
                                    <input type="text" value="{{ $produto[0]['site_loja'] }}" name="site_loja"
                                           class="form-control">
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="" class="col-sm-1 control-label">Peso:</label>
                                <div class="col-sm-2">
                                    <input type="text" name="peso" class="form-control money"
                                           value="{{ $produto[0]['peso'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-1 control-label">Quantidade:</label>
                                <div class="col-sm-2">
                                    <input type="text" name="quantidade" class="form-control"
                                           value="{{ $produto[0]['qtde'] }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <button type="button" class="btn btn-info boxColorTema updateproduto"
                                        id="{{ $produto[0]['seq_produto'] }}"><i class="fa fa-check"></i> Atualizar
                                    Produto
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-header">
                    <h4>
                        <b>Status</b>
                    </h4>
                </div>
                <div class="box-body">
                    <form class="form-inline" id="form-produto" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="seq_produto" value="{{ $produto[0]['seq_produto'] }}">
                        <input type="hidden" name="suite" value="{{ $cliente[0]['codigo_suite'] }}">
                        <div class="form-group">
                            <div class="col-sm-8">
                                <select name="status" class="form-control">
                                    <option value="">Selecione o status do produto</option>
                                    <option value="2" {{ $produto[0][ 'status'] == '2' ? 'selected': '' }}>No Estoque
                                    </option>
                                    <option value="3" {{ $produto[0][ 'status'] == '3' ? 'selected': '' }}>Em
                                        Orçamento
                                    </option>
                                    <option value="4" {{ $produto[0][ 'status'] == '4' ? 'selected': '' }}>Despachado
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-info produto"
                                        id="{{ $produto[0]['seq_produto'] }}">Atualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h4>
                        <b>Enviar fotos</b>
                    </h4>
                </div>
                <div class="box-body">
                    <div class="dropzone" id="produto-upload">
                        <input type="hidden" name="cod_suite" id="codigo_suite"
                               value="{{ $produto[0]['codigo_suite'] }}">
                        <input type="hidden" name="codigo_produto" id="codigo_produto"
                               value="{{ $produto[0]['seq_produto'] }}">
                    </div>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-header">
                    <h4>FOTOS DO PRODUTO</h4>
                </div>
                <div class="box-body">
                    @for ($i = 0; $i < count($fotos); $i++)
                        <li class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="list-style: none">
                            <div class="card estoque-card" align="center" height="200px">
                                <a href="#foto-detalhe-{{ $fotos[$i]->seq_imagem }}" rel="modal:open">
                                    <img src="{{ $fotos[$i]->caminho_imagem }}" class="card-img-top img-responsive">
                                </a>

                                <div class="modal custom-modal" id="foto-detalhe-{{ $fotos[$i]->seq_imagem }}">
                                    <div class="box box-info">
                                        <div class="box-header">
                                            <h4>Imagem Ampliada</h4>
                                            <div class="box-tools">
                                                <a href="#" rel="modal:close" class="close">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <img src="{{ $fotos[$i]->caminho_imagem }}" class="img-thumbnail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer text-center">
                                            {{--<a href="{{ route('rotateleft', $fotos[$i]->seq_imagem) }}" class="btn btn-default boxColorTema btn-lg"><i class="fa fa-rotate-left"></i></a>
                                            <a href="#" class="btn btn-default boxColorTema btn-lg"><i class="fa fa-rotate-right"></i></a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- <h5 class="card-title">COD: {{ $fotos[$i]->codigo_produto }}</h5> --}}
                                    <p class="card-text">Postado em: {{ $fotos[$i]->data_cadastro->format('d/m/Y') }}</p>
                                    <p><button onclick="deleteImage({{ $fotos[$i]->seq_imagem }})" class="btn btn-danger remove-foto"><i class="fa fa-trash"></i> Excluir</button></p>
                                </div>
                            </div>
                        </li>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div id="tpl">
        <div class="dz-preview dz-file-preview">
            <div class="dz-details">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img id="img-editable" data-dz-thumbnail/>
                    </div>
                </div>
                {{--<div class="row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-default boxColorTema btn-lg" id="left"><i class="fa fa-rotate-left"></i></button>
                        <button class="btn btn-default boxColorTema btn-lg" id="save"><i class="fa fa-cloud-upload"></i> Salvar</button>
                        <button class="btn btn-default boxColorTema btn-lg" id="right"><i class="fa fa-rotate-right"></i></button>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}" />
@stop

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.js"></script>--}}
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/jquery-cropper.js') }}"></script>
    <script src="{{ asset('js/uploadfotoproduto.js') }}"></script>
    <script>
        $('.money').maskMoney();
        function deleteImage(id)
        {
            Swal.fire({
                title: 'Você tem certeza disso?',
                text: 'Deseja apagar esta imagem?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                confirmButtonColor: '#d33',
                cancelButtonText: 'Não',
            }).then(result => {
                if(result.value)
                {
                    axios.get('/admin/produto/foto/delete/' + id).then(response => {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: response.data.msg,
                            type: 'success',
                            onClose: reloadPage
                        });
                    });
                }
            });

        }

        function reloadPage()
        {
            location.href = location.href;
        }
    </script>
@stop