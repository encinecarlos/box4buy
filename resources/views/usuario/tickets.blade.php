@extends('base.usuario-base')

@section('content')
 <!-- ==============  INICIO DO ORÇAMENTO ==============  -->
	<div class="box box-info">
		<div class="box-header with-border">
			<br>
			<a><i class="fa fa-bullhorn"></i> <span>Suporte</span></a>
			<div class="box-tools pull-right"></div>
		</div>

		<div class="box-header with-border">
			<br>
			<h3 class="box-title">ABRIR CHAMADO</h3>
			<div class="box-tools pull-right"></div>
		</div>

		<div class="box-body"> 
			<a href="#modalNovoChamado" class="btn boxColorTema" rel="modal:open" id="add-novochamado">NOVO CHAMADO</a>
         </div>
		<br>
		

		<!-- CARREGA AO UTILIAR O BOTÃO NOVO TICKET -->
		<div id="modalNovoChamado" class="modal custom-modal" style="display: none;">
			<form class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
						<label for="envioFoto" class="col-sm-2 control-label">Enviar Arquivo</label>
						<div class="col-sm-10">
							<input type="file" id="envioFoto" class="btn btn-info boxColorTema">
						</div>
					</div>
					<div class="form-group">
					    <label for="inputNome" class="col-sm-2 control-label">Situação</label>
					    <div class="col-sm-10">
							<input type="text" class="form-control" id="inputNome" placeholder="Reclamação/Sugestão/Outros">
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputDataNascimento" class="col-sm-2 control-label">Observações</label>
					    <div class="col-sm-10">
					        <textarea class="form-control" rows="3" placeholder="Observações..."></textarea>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputCelular" class="col-sm-2 control-label">Celular</label>
					    <div class="col-sm-5">
					        <input type="text" class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask placeholder="Celular 01">
					    </div>
						<div class="col-sm-5">
					        <input type="text" class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask placeholder="Celular 02">
					    </div>
					</div>
				</div>
				<div class="box-body"> 
					<button type="submit" class="btn btn-info pull-right boxColorTema">ENVIAR</button>
				</div>
			</form>
		</div>

		<!-- FIM BOTÃO NOVO TICKET -->





		<div class="box-body">
			<div class="box-header with-border">
				<br>
				<h3 class="box-title">EM ABERTO</h3>
				<div class="box-tools pull-right"></div>
			</div>
			<div class="tableover">
				<table id="example2" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center">Data</th>
						<th class="text-center">Assunto</th>
						<th class="text-center">Última Alteração</th>
						<th class="text-center">Observações</th>
						<th class="text-center">Nova Interação</th>
						<th class="text-center">Finalizar</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">01/01/2018</td>
						<td class="text-center">Envio de Mercadorias</td>
						<td class="text-center">04/01/2018</td>
						<td class="text-center">O envio foi colocado...</td>
						<td class="text-center"><a class="btn boxColorTema"><i class="fa fa-plus-square"></i></a></td>
						<td class="text-center"><a class="btn boxColorTema"><i class="fa fa-check-square"></i></a></td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="box-body">
			<div class="box-header with-border">
				<br>
				<h3 class="box-title">ENCERRADOS</h3>
				<div class="box-tools pull-right"></div>
			</div>
			<div class="tableover">
				<table id="example2" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center">Data</th>
						<th class="text-center">Assunto</th>
						<th class="text-center">Encerrado</th>
						<th class="text-center">Observações</th>
						<th class="text-center">Re-Abrir</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">01/01/2018</td>
						<td class="text-center">Envio de Mercadorias</td>
						<td class="text-center">04/01/2018</td>
						<td class="text-center">O envio foi colocado...</td>
						<td class="text-center"><a class="btn boxColorTema"><i class="fa fa-refresh"></i></a></td>
					</tr>
				</tbody>
				</table>
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