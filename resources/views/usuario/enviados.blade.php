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
			<h4 class="box-title">PACOTES EM TRANSITO</h4>
			<table id="example2" class="table table-bordered table-hover">
			  <thead>
				<tr>
					<th class="text-center">Código Rastreio</th>
					<th class="text-center">Peso Total</th>
					<th class="text-center">Data de Envio</th>										
					<th class="text-center">Confirmar Recebimento</th>
					<th class="text-center">Suporte</th>
				</tr>
			  </thead>
			  <tbody>
				 @foreach($enviados as $env)
				<tr>
					<td class="text-center">{{ $env->cod_rastreio }}</td>
					<td class="text-center">{{ $env->peso_total }}</td>
					<td class="text-center">{{ $env->data_envio->format('d/m/Y') }}</td>										
					<td class="text-center"><a href="#" class="btn btn-info BoxColorTema"><i class="fa da-check"></i></a></td>
					<td class="text-center"><a href="#" class="btn btn-info boxColorTema"><i class="fa fa-ticket"></i></a></td>
				</tr>
				@endforeach
			</tbody>
			</table>
		</div>
		<br>
		<div class="box-body">
			<h4 class="box-title">PACOTES ENTREGUES</h4>
			<div class="tableover">
				<table id="example2" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center">Código Rastreio</th>
						<th class="text-center">Peso Total</th>
						<th class="text-center">Data Envio</th>
						<th class="text-center">Cod. Seguro</th>
						<th class="text-center">Observações</th>
						<th class="text-center">Data Recebimento</th>
						<th class="text-center">Avaliar Serviço</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">12234422-BR</td>
						<td class="text-center">12 LBS</td>
						<td class="text-center">01/01/2018</td>
						<td class="text-center">332232-RR</td>
						<td class="text-center">Não Há</td>
						<td class="text-center">02/02/2018</td>
						<td class="text-center"><a href="#" class="btn boxColorTema" data-toggle="modal" data-target="#avalieEntrega" id="inputValida">
								<i class="fa fa-star"></i>
							</a>
							@include('usuario.partials.avaliacao')
						</td>
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
<link rel="stylesheet" href="{{asset('css/star.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/usuario-estoque.js') }}"></script>
@stop