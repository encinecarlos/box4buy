@extends('base.usuario-base')

@section('content')
 <!-- ==============  INICIO DO ORÇAMENTO ==============  -->
<div class="box box-info">
	<div class="box-header with-border">
		<br>
		<a><i class="fa fa-money"></i> <span>ORÇAMENTOS</span></a>
        <div class="box-tools pull-right"></div>
	</div>
	<div class="box-header with-border">
		<br>
		<h3 class="box-title">ORÇAMENTOS AGUARDANDO APROVAÇÃO</h3>
		<div class="box-tools pull-right"></div>
	</div>
	<div class="box-body">
		
		<!-- INICIO MODAL PAGAMENTO -->
		<div class="modal fade" id="modal-pagamento">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">COD: 1234565-BR</h4>
					</div>
					<div class="modal-body">
						<p>Escolha a forma de pagamento</p>
						<br>
						<div class="form-group">
							<label for="inputCredito" class="col-sm-4 control-label">Forma de Pagamento</label>
							<div class="col-sm-2 btn">
								<button type="button" class="btn btn-info boxColorTema" data-toggle="modal" data-target="#modal-paypal">PayPal</button>
							</div>
							<div class="col-sm-2 btn">
							    <button type="button" class="btn btn-info boxColorTema" data-toggle="modal" data-target="#modal-western">WesternUnion</button>
							</div>
							<br>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn text-white boxColorTema" data-dismiss="modal">FECHAR</button>
					</div>
				</div>
			</div>
		</div>
		<!-- FIM MODAL PAGAMENTO -->
	</div>
		<br/>
		<br/>
	<div class="box-header with-border">
	<br />
	<h3 class="box-title">ORÇAMENTOS AGUARDANDO CONFIRMAÇÃO DE PAGAMENTO</h3>
		<div class="box-tools pull-right"></div>
	</div>
	<div class="box-body">
		<div class="tableover">
			<table id="example2" class="table table-bordered table-hover">
				<thead>
				<tr>
					<th class="text-center">Total Itens</th>
					<th class="text-center">Descrição Itens</th>
					<th class="text-center">Peso Total</th>
					<th class="text-center">Tipo Envio</th>
					<th class="text-center">Pacote</th>
					<th class="text-center">Seguro</th>
					<th class="text-center">Valor Orçamento</th>
					<th class="text-center">Código Orçamento</th>
					<th class="text-center">Envio Compr. Pagamento</th>
					
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-center">5</td>
					<td class="text-center"><a class="btn btn-info boxColorTema"><i class="fa fa-bars" data-toggle="modal" data-target="#modal-descricao"></i></a></td>
					<td class="text-center">12 LBS</td>
					<td class="text-center">PRIORITY MAIL</td>
					<td class="text-center">LARGER</td>
					<td class="text-center">SIM</td>
					<td class="text-center">$ 230,00 </td>
					<td class="text-center"><strong>B4B 00234</strong> </td>
					<td class="text-center"><input type="file" id="envioCompPagamento" class="btn btn-info boxColorTema"></td>
					
				</tr>
			</tbody>
			</table>
		</div>
		<div class="box-body"> 
			<div class="row">
				<div class="col-sm-2 pull-right">
			        <button type="submit" class="btn btn-info pull-right boxColorTema">ENVIAR ARQUIVOS</button>&nbsp;
				</div>
				<div class="col-sm-1 pull-right">
					<button type="submit" class="btn btn-info pull-right boxColorTema">CANCELAR</button>&nbsp;
				</div>
			</div>
		</div>
	</div>
	<div class="box-header with-border">
	<br />
	<h3 class="box-title">ORÇAMENTOS PAGOS</h3>
		<div class="box-tools pull-right"></div>
	</div>
	<div class="box-body">
		<div class="tableover">
			<table id="example2" class="table table-bordered table-hover">
				<thead>
				<tr>
					<th class="text-center">Total Itens</th>
					<th class="text-center">Descrição Itens</th>
					<th class="text-center">Peso Total</th>
					<th class="text-center">Tipo Envio</th>
					<th class="text-center">Pacote</th>
					<th class="text-center">Seguro</th>
					<th class="text-center">Valor Orçamento</th>
					<th class="text-center">Data Pagamento</th>
					<th class="text-center">Código Orçamento</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-center">5</td>
					<td class="text-center"><a class="btn btn-info boxColorTema"><i class="fa fa-bars" data-toggle="modal" data-target="#modal-descricao"></i></a></td>
					<td class="text-center">12 LBS</td>
					<td class="text-center">PRIORITY MAIL</td>
					<td class="text-center">LARGER</td>
					<td class="text-center">SIM</td>
					<td class="text-center">$ 230,00 </td>
					<td class="text-center">12/12/2018 </td>
					<td class="text-center"><strong>B4B 00234</strong> </td>
				</tr>
			</tbody>
			</table>
		</div>
	</div>
	<div class="modal fade" id="modal-descricao">
		<div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">DESCRIÇÃO DOS PRODUTOS</h4>
				</div>
				<div class="modal-body">
					<div class="tableover">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
							<tr>
								<th>Produto</th>
								<th>Peso</th>
								<th>Produto</th>
								<th>Cód. Produto</th>
								<th>Dias em Estoque</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>01</td>
								<td>2 LBS
								</td>
								<td>Celular</td>
							<td>12234422-BR</td>
								<td>2</td>
							</tr>
							<tr>
								<td>02</td>
								<td>2 LBS
								</td>
								<td>Celular</td>
							<td>12234422-BR</td>
								<td>2</td>
							</tr>
							<tr>
								<td>03</td>
								<td>2 LBS
								</td>
								<td>Celular</td>
							<td>12234422-BR</td>
								<td>2</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn text-white boxColorTema" data-dismiss="modal">FECHAR</button>
				</div>
			<div>
		</div>
	</div>
</div>
<!-- ==============  FIM DO ORÇAMENTO ==============  -->

@stop

@section('css')

<link rel="stylesheet" href="{{asset('css/style.css')}}"> 

@stop

@section('js')
    <script src="{{ asset('js/usuario-estoque.js') }}"></script>
@stop