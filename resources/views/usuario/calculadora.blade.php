@extends('base.usuario-base')

@section('content')
	<div class="box box-info">
		<div class="box-header with-border">			
			<a><i class="fa fa-calculator"></i> <span>Calculadora</span></a>
			<div class="box-tools pull-right">
				<a href="{{ route('home') }}" class="btn btn-link"><i class="fa fa-chevron-left"></i> Voltar</a>			
			</div>			
		</div>
		<form class="form-horizontal" id="formpeso" method="POST">
			<div class="box-body">
				<div class="form-group">
					<label for="inputValida" class="col-sm-2 control-label">Peso:</label>
					<div class="col-sm-2 slidercontainer">
                        <input type="range"
                               class="bxby-slider"
                               name="peso"
                               min="1"
                               max="66"
                               value="1"
                               id="slidepeso">
						{{--<input type="number" class="form-control" name="peso" id="pesoinput" placeholder="Informe o peso em Libras">--}}
					</div>
                    <div class="col-sm-1">
                        <p><b><span id="peso-display"></span></b> Libra(s)</p>
                    </div>
					<div class="col-sm-4">
						<button type="button" class="btn btn-info boxColorTema" id="btn-peso">Calcular</button>
					</div>
				</div>					
			</div>
		</form>		
		
		<div class="box-body">
			<div class="row">
				@if(Session::has('frete'))					
							@foreach(session('frete') as $f)
								@foreach($f as $value)
								<div class="col-sm-4">
									<ul class="price">
									@switch($value['id'])
										@case(1)
											<li class="header">Priority Express</li>
											@break
										@case(2)
											<li class="header">Priority Mail</li>
											@break
										@case(15)
											<li class="header">First Class</li>	
										@default										
									@endswitch								
									<li><b>Peso (Libras):</b> {{ $value['peso'] }}</li>
									<li><b>Peso (KG):</b> {{ number_format($value['peso'] / 2.2, 2) }}</li>
									<li><b>Taxa de Frete:</b> {{ $value['valor_frete'] }} USD</li>
									<li><b>Taxa de Cartão:</b> {{ $value['taxa_cartao'] }}</li>
									<li><b>Taxa Box4Buy :</b> {{ $value['taxa_box'] }} USD</li>
									<li><b>Valor Total :</b> {{ $value['valor_total'] }} USD</li>
								</ul>
								</div>								
								
								@endforeach
							@endforeach
					
				@endif
				{{-- <table id="example2" class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>Plano</th>
						<th>Peso LBS</th>
						<th>Peso KG</th>
						<th>Taxas Frete</th>
						<th>Taxas Cartão</th>
						<th>Taxas B4B</th>
						<th>Valor Total</th>
					</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table> --}}
			</div>
		</div>
		
	</div>

@stop

@section('css')

<link rel="stylesheet" href="{{asset('css/style.css')}}"> 

@stop

@section('js')
	<script src="{{ asset('js/usuario-estoque.js') }}"></script>
	<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
	<script src="{{ asset('js/frete.js') }}"></script>
    <script>
        /*var slider = document.getElementById('slidepeso');
        var pesodisplay = document.getElementById('peso-display');

        pesodisplay.innerHTML = slider.value;

        slider.oninput = function() {
            pesodisplay.innerHTML = this.value;
        }*/
    </script>
@stop
