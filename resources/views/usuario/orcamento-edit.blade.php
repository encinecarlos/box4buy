@extends('base.usuario-base') 

@section('content')
<div class="box box-info">
    <div class="box-header">
        <h4><i class="fa fa-pencil"></i> Editar Orçamento</h4>
        <div class="box-tools">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
        </div>
    </div>
    <div class="box-body">
        <form class="form-horizontal" id="orcamento-update" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="seq" id="seq" value="{{ $orcamento[0]->sequencia }}">
            {{ csrf_field() }}
            @method('PUT')
            <input type="hidden" name="statusorcamento" value="{{ $orcamento[0]->status }}">
            <div class="form-group">
                <label class="control-label col-sm-2">Suite:</label>
                <div class="col-sm-2">
                    <input type="text" value="{{ session('suite_prefix') }}{{ $orcamento[0]->codigo_suite }}" class="form-control" disabled>
                </div>
                <label class="control-label col-sm-2">Forma de Envio:</label>
                <div class="col-sm-2">
                    <select name="pacote" class="form-control">
                        <option {{ $orcamento[0]->codigo_pacote == 1 ? 'selected' : '' }} value="1">First Class</option>
                        <option {{ $orcamento[0]->codigo_pacote == 2 ? 'selected' : '' }} value="2">Priority Mail</option>
                        <option {{ $orcamento[0]->codigo_pacote == 3 ? 'selected' : '' }} value="3">Priority Express</option>
                    </select>
                </div>
                <label class="control-label col-sm-1">Seguro:</label>
                <div class="col-sm-2">
                    <select name="seguro2" class="form-control">
                        <option {{ $orcamento[0]->seguro == 1 ? 'selected' : '' }} value="1">Sim</option>
                        <option {{ $orcamento[0]->seguro == 2 ? 'selected' : '' }} value="2">Não</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Enviar NF:</label>
                <div class="col-sm-2">
                    <select name="envianf" class="form-control">
                        <option value="1" {{ $orcamento[0]->recebe_nota == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="2" {{ $orcamento[0]->recebe_nota == '2' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>

                <label class="col-sm-2 control-label">Descarta Sacolas:</label>
                <div class="col-sm-2">
                    <select name="sacolaoriginal" class="form-control">
                        <option value="1" {{ $orcamento[0]->sacolas_originais == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="2" {{ $orcamento[0]->sacolas_originais == '2' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>
                

                <label class="control-label col-sm-1">Etiqueta de preço:</label>
                <div class="col-sm-2">
                    <select name="etiquetaoriginal" class="form-control">
                        <option value="1" {{ $orcamento[0]->preco_etiqueta == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="2" {{ $orcamento[0]->preco_etiqueta == '2' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>                
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Caixa Original:</label>
                <div class="col-sm-2">
                    <select name="caixaoriginal" class="form-control">
                        <option value="1" {{ $orcamento[0]->caixas_originais == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="2" {{ $orcamento[0]->caixas_originais == '2' ? 'selected' : '' }}>Não</option>
                    </select>                    
                </div>

                <label class="control-label col-sm-2">Enviar Propagandas:</label>
                <div class="col-sm-2">
                    <select name="enviapropaganda" class="form-control">
                        <option value="1" {{ $orcamento[0]->recebe_propaganda == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="2" {{ $orcamento[0]->recebe_propaganda == '2' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>
            </div>
            
            <div class="form-gorup">
                <button type="button" class="btn btn-info boxColorTema" id="update-orcamento">Atualizar</button>
            </div>
        </form>
    </div>
    <div class="box box-info">
        <div class="box-header">
            <h4>Produtos</h4>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered">
                <thead>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Dias em estoque</th>
                </thead>
                <tbody>
                    @foreach($produtos as $p)
                    <tr>
                        <td>{{ $p->codigo_produto }}</td>
                        <td>{{ $p->descricao }}</td>
                        <td>{{ $p->quantidade }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop 

@section('css')

<link rel="stylesheet" href="{{ asset('css/style.css') }}"> 

@stop

@section('js')
<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script src="{{ asset('js/orcamento.js') }}"></script>
@stop