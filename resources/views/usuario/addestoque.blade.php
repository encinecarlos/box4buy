@extends('base.usuario-base')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cogs"></i> CONFIGURAÇÕES DO SISTEMA</h3>
        </div>
        <div class="box-content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#status" data-toggle="tab" aria-expanded="true">Adicionar produtos</a></li>
                    <li><a href="#valorescotacoes" data-toggle="tab" aria-expanded="false">Fotos</a></li>
                    <li><a href="#geral1" data-toggle="tab" aria-expanded="false">Carrinho</a></li>
                    <li><a href="#geral2" data-toggle="tab" aria-expanded="false">Orçamentos</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="status">
						<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">INFORMAR PRODUTOS ENVIADOS A BOX4BUY</h3>
							</div>
						</div>
						<div class="box-body">
							<form class="form-horizontal form-ajax" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="suite" value="{{ Auth::user()->codigo_suite }}">

								<div class="form-group">
									<label for="inputNomeLoja" class="col-sm-2 control-label">Nome Loja:</label>
										<div class="col-sm-10">
										<input type="text" name="nomeloja" class="form-control" id="inputNomeLoja" placeholder="Insira o nome da loja">
									</div>
								</div>
								<div class="form-group">
									<label for="inputDataCompra" class="col-sm-2 control-label">Data Compra:</label>
									<div class="col-sm-4">
										<input type="date" name="datacompra" class="form-control" id="inputDataCompra" placeholder="Insira a data compra">
									</div>
									<label for="inputCodRastreio" class="col-sm-2 control-label">Código Rastreio:</label>
									<div class="col-sm-4">
										<input type="text" name="codigorastreio" class="form-control" id="inputCodRastreio" placeholder="Insira o código rastreio">
									</div>
								</div>
								<div class="form-group">
									<label for="inputSite" class="col-sm-2 control-label">Site da Loja:</label>
									<div class="col-sm-4">
										<input type="text" name="siteloja" class="form-control" id="inputSite" placeholder="Insira o site da loja">
									</div>
									<label for="inputCodRastreio" class="col-sm-2 control-label">Descrição:</label>
									<div class="col-sm-4">
										<input type="text" name="descricao" class="form-control" id="inputCodRastreio" placeholder="Decrição do produto">
									</div>
								</div>
								<div class="form-group">
									<input type="submit" id="teste" class="btn btn-default" value="CANCELAR">
									<button type="submit" id="send-produto" class="btn btn-info">ENVIAR</button>
									{{-- <input type="submit" id="send-produto" class="btn btn-info boxColorTema" value="ENVIAR"> --}}
								</div>
							</form>
						</div>						
                    </div>
                    <div class="tab-pane" id="valorescotacoes">
                        <h2>VALORES</h2>
                        <form class="form-horizontal form-ajax" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="suite" value="{{ Auth::user()->codigo_suite }}">
							
							<div class="form-gorup">
								<label for="" class="col-sm-2 control-label">Nome da loja:</label>
								<div class="col-sm-10">
									<input type="text" name="nomeloja" class="form-control">
								</div>	
							</div>

							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Data da compra:</label>
								<div class="col-sm-4">
									<input type="date" name="datacompra" class="form-control">
								</div>
								<label class="col-sm-1 control-label">Código de Rastreio</label>
								<div class="col-sm-5">
									<input type="text" name="codigorastreio" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Site da Loja</label>
								<div class="col-sm-4">
									<input type="url" name="siteloja" class="form-control">
								</div>
								<label for="" class="col-sm-1 control-label">Descrição:</label>
								<div class="col-sm-5">
									<input type="text" name="descricao" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<a href="#" id="teste" class="btn btn-danger">TESTE</a>
								{{-- <input type="submit" value="ENVIAR" id="teste" class="btn btn-info"> --}}
							</div>
                        </form>
                    </div>
                    <div class="tab-pane" id="geral1">
                        <h2>geral 1</h2>
                    </div>
                    <div class="tab-pane" id="geral2">
                        <h2>geral 2</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
@stop