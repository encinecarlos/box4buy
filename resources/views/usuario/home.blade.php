@extends('base.usuario-base') 

@section('content')
<!-- Essa DIV deverá aparecer no HOME CLIENTE -->
<div class="box-info row" >
	<div class="col-lg-6 conteudo-home">
		<h2>SEU ENDEREÇO USA</h2>
		<div class="content-block-home">
			<div class="row" style="margin-left: 10px; margin-right: 10px">
				<table class="table">
					<tr>
						<td><b>Name:</b></td>
						<td>{{ $configs->cfg_name }}</td>
					</tr>
					<tr>
						<td><b>Street Address:</b></td>
						<td>{{ $configs->cfg_address }}</td>
					</tr>
					<tr>
						<td>Suite:</td>
						<td>{{ session('suite_prefix') }}{{ Auth::user()->codigo_suite }}</td>
					</tr>
					<tr>
						<td><b>City:</b></td>
						<td>{{ $configs->cfg_city }}</td>
					</tr>
					<tr>
						<td><b>State:</b></td>
						<td>{{ $configs->cfg_state }}</td>
					</tr>
					<tr>
						<td><b>Zip Code:</b></td>
						<td>{{ $configs->cfg_zipcode }}</td>
					</tr>
					<tr>
						<td><b>Phone:</b></td>
						<td>{{ $configs->cfg_phone }}</td>
					</tr>
				</table>				
			</div>
					
		</div>
	</div>

	<div class="col-lg-6 conteudo-home">
		<h2>INFORMAÇÕES ÚTEIS</h2>
		<div class="content-block-home">
		<br>
			<form class="form-horizontal form-ajax" method="post">								
				<div class="form-group" style="display: {{ $enable_pay[0]->libera_pagamento == '2' ? 'none' : 'block'}}">
				    <label for="inputValidaConta" class="col-sm-5 control-label">Conta Validada?</label>
				    <div class="col-sm-5">
						<a href="#upload-modal" class="btn btn-info boxColorTema" rel="modal:open"><i class="fa fa-check"></i> VALIDAR CONTA</a>
							@include('usuario.partials.docModal')
				    </div>
				</div>
				{{-- <div class="form-group">
				    <label for="inputCredito" class="col-sm-5 control-label">Créditos: </label>
				    <div class="col-sm-5">
				        <input type="text" class="form-control" id="inputCredito" placeholder="US$ 3,00" disabled>
				    </div>
				</div> --}}

				<div class="form-group">
				    <label for="inputCredito" class="col-sm-5 control-label">Calculadora: </label>
				    <div class="col-sm-5">
						<a href="{{ route('calculadora') }}" class="btn btn-default boxColorTema text-uppercase">
							<i class="fa fa-calculator"></i> Calculadora
						</a>
					</div>
				</div>

				<div class="form-group">
				    <label for="inputCredito" class="col-sm-5 control-label">Tutorial: </label>
				    <div class="col-sm-5">
						<a href="{{ route('tutorial') }}">
						    <button type="button" class="btn text-white boxColorTema" data-dismiss="modal" disabled><i class="fa fa-graduation-cap" ></i> TUTORIAL (Em Breve)</button>
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop 

@section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@stop 

@section('js')
{{-- <script src="{{ asset('js/usuario-estoque.js') }}"></script> --}}
<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('js/upload.js') }}"></script>
@stop