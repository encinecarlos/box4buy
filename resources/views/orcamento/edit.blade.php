@extends('base.base') 

@section('content')
<div class="box box-info">

    <div class="alert alert-danger alert-errors">
        <ul id="list-error" style="list-style-type: none">
        </ul>
    </div>

    <div class="box-header">
        <h4><i class="fa fa-pencil"></i> Editar Orçamento (Cód. Orçamento: {{ $orcamento[0]->sequencia }})</h4>
        <div class="box-tools">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
        </div>
    </div>
    <div class="box-body">
        <form class="form-horizontal" id="orcamento-update" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="seq" id="seq" value="{{ $orcamento[0]->sequencia }}">
            {{ csrf_field() }}
            @method('PUT')
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

                <label class="control-label col-sm-1">Valor Total Declarado</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" value="{{ number_format($orcamento[0]->vlr_declarado, 2) }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Valor Entrega ($):</label>
                <div class="col-sm-2">
                    <input type="text" id="frete" name="valorentrega" class="form-control money" value="{{ $orcamento[0]->vlr_entrega == '' ? '1.00': $orcamento[0]->vlr_entrega }}">
                </div>
                <label class="control-label col-sm-2">Taxa Box4Buy:</label>
                <div class="col-sm-2">
                    <input type="text" id="taxabox" name="valorbxby" class="form-control money" value="{{ $orcamento[0]->vlr_taxa }}">
                </div>

                <label class="control-label col-sm-1">Valor do Seguro:</label>
                <div class="col-sm-2">
                    <input type="text"
                           id="seguro-valor" 
                           name="valorseguro" 
                           class="form-control money">
                </div>                
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Status do Orçamento:</label>
                <div class="col-sm-2">
                    <select name="statusorcamento" class="form-control statusorcamento">
                        @foreach($orcamentoStatus as $status)
                        <option value="{{ $status->seq_status }}" {{ $orcamento[0]->status == $status->seq_status ? 'selected' : '' }}>{{ $status->descricao_status }}</option>
                        @endforeach
                    </select> 
                </div>               
                
                <label class="control-label col-sm-1">Enviado:</label>
                <div class="col-sm-2">
                    <select name="enviado" class="form-control statusorcamento">
                        <option value="0">Não informado</option>
                        <option value="1" {{ $orcamento[0]->enviado == '1' ? 'selected' : '' }}>Sim</option>
                        <option value="2" {{ $orcamento[0]->enviado == '2' ? 'selected' : '' }}>Não</option>
                    </select>
                </div>   
            </div>

            <div class="form-group">

                <label class="control-label col-sm-2">Peso sem caixa:</label>
                <div class="col-sm-1">
                    <input type="text" id="total" name="pesocaixa" class="form-control money" value="{{ $orcamento[0]->peso_total }}">
                </div>

                <label class="control-label col-sm-2">Peso com caixa:</label>
                <div class="col-sm-1">
                    <input type="text" id="total" name="pesocaixa" class="form-control money" value="{{ $orcamento[0]->peso_embalado }}">
                </div>

            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Valor sem a caixa:</label>
                <div class="col-sm-1">
                    <input type="text" id="subtotal" name="valorsubtotal" class="form-control money" value="{{ $orcamento[0]->vlr_subtotal }}">
                </div>

                <label class="control-label col-sm-2">Valor com a caixa:</label>
                <div class="col-sm-1">
                    <input type="text" id="total" name="valortotal" class="form-control money" value="{{ $orcamento[0]->vlr_final }}">
                </div>

                <div class="col-sm-1">
                    <button type="button" id="calcularvalor" class="btn btn-info boxColorTema">Calcular</button>
                </div>
            </div>

            <div class="form-group infoenvio">
                <label class="control-label col-sm-2">Track Number:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="codigorastreio" value="{{ $orcamento[0]->cod_rastreio }}">
                </div>

                <label class="control-label col-sm-2">Data de Envio:</label>
                <div class="col-sm-2">
                    <input type="date" name="dataenvio" class="form-control">
                </div>
            </div>            
            
            <div class="form-group">
                <div class="col-sm-3">
                    <button type="button" class="btn btn-info boxColorTema" id="update-orcamento">Atualizar</button>
                    <button type="button" class="btn btn-success" id="libera-edicao">Liberar campos para Edição</button>
                </div>                
            </div>
        </form>
    </div>

    <div class="box box-info">
        <div class="box box-header">
            <h4>DADOS PARA ENTREGA</h4>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered">
                <tr>
                    <th class="col-sm-2">Nome:</th>
                    <td>{{ $dadosUsuario[0]->nome_completo }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">E-mail:</th>
                    <td>{{ $dadosUsuario[0]->email }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">Endereço:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->endereco }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">N°:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->numero }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">Bairro:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->bairro }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">complemento:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->complemento }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">CEP:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->codigo_postal }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">Cidade:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->cidade }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">Estado</th>
                    <td>{{ $dadosUsuarioEndereco[0]->estado }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">País:</th>
                    <td>{{ $dadosUsuarioEndereco[0]->pais == 'BR' ? 'Brasil' : 'EUA' }}</td>
                </tr>
                <tr>
                    <th class="col-sm-2">Telefone:</th>
                    <td>{{ $dadosUsuarioContato[0]->telefone }}</td>
                </tr>
            </table>
        </div>
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
                    <th>Valor Declarado</th>
                </thead>
                <tbody>
                    @foreach($produtos as $p)
                    <tr>
                        <td>{{ $p->codigo_produto }}</td>
                        <td>{{ $p->descricao }}</td>
                        <td>{{ $p->quantidade }}</td>
                        <td>{{ $p->dias_estoque->diffInDays() }}</td>
                        <td>{{ $p->valor_declarado }} USD</td>
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
<script>
    $(function() {
        $('.infoenvio').hide();
        $('select').not('.statusorcamento').attr('readonly', 'true');

        $('#libera-edicao').click(function() {
            $('select').removeAttr('readonly');
        });

        var produto_enviado = $("select[name='enviado']");
        
        produto_enviado.change(function() {
            if($(this).val() == '1') {
                $('.infoenvio').show();
            } else {
                $('.infoenvio').hide();
            } 
        });
    });
</script>
@stop
