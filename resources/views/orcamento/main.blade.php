@extends('base.base') 
@section('content')

<div class="box box-info">
	<div class="box-header with-border">
		<br>
		<a>
			<i class="fa fa-bar-chart"></i>
			<span> ORÇAMENTO</span>
		</a>
		<div class="box-tools pull-right"></div>
	</div>
	<div class="box-content">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs" id="orcamento-tab">
				<li class="active">
					<a href="#aguardando" data-toggle="tab" aria-expanded="true"><i class="fa fa-warning"></i> AGUARDANDO APROVAÇÃO</a>
				</li>
				<li>
					<a href="#pagamento1" data-toggle="tab" aria-expanded="false"><i class="fa fa-money"></i> AGUARDANDO PAGAMENTO</a>
				</li>
				<li>
					<a href="#pagamento2" data-toggle="tab" aria-expanded="false"><i class="fa fa-check-circle"></i> ORÇAMENTOS PAGOS</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="aguardando">
					<div class="box box-info">
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover tb-orcamento" id="aguarda-aprovacao">
								<thead>
									<tr>
										<th>Suite</th>
										<th>Código</th>
										<th>Pacote</th>
										<th>Produtos</th>
										<th>Peso(lbs)</th>
										<th>Valor</th>
										<th>Status</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach($aguardando as $a)
									<tr>
										<td>{{ session('suite_prefix') }}{{ $a->codigo_suite }}</td>
										<td>{{ $a->sequencia }}</td>
										<td>
											@switch($a->codigo_pacote) @case(1) First class @break @case(2) Priority Mail @break @case(3) Priority Express @break @endswitch
										</td>
										<td>
											<a href="{{ route('orcamento-detalhe', $a->sequencia) }}" id="{{ $a->sequencia }}" class="btn btn-info boxColorTema">
												<i class="fa fa-eye"></i> Produtos</a>
										</td>
										<td>{{ $a->peso_total }}</td>
										<td>{{ $a->vlr_final == '' ? '0.00' : $a->vlr_final }} USD</td>
										<td>
											<span class="label label-warning">Pendente</span>
										</td>
										<td>
											<a href="{{ route('orcamento-edit', $a->sequencia) }}" class="btn btn-info boxColorTema">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>
											<button type="button" class="btn btn-danger or-delete" data-tab="aguardando" data-orcamento="{{ $a->sequencia }}"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="tab-pane" id="pagamento1">
					<div class="box box-info">
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover tb-orcamento" id="aguarda-pagamento">
								<thead>
									<tr>
										<th>Suite</th>
										<th>Código</th>
										<th>Pacote</th>
										<th>Produtos</th>
										<th>Peso(lbs)</th>
										<th>Valor</th>
										<th>Status</th>
										<th>Pago</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach($aprovado as $ap)
									<tr>
										<td>{{ session('suite_prefix') }}{{ $ap->codigo_suite }}</td>
										<td>{{ $ap->sequencia }}</td>
										<td>
											@switch($ap->codigo_pacote) @case(1) First class @break @case(2) Priority Mail @break @case(3) Priority Express @break @endswitch
										</td>
										<td>
											<a href="{{ route('orcamento-detalhe', $ap->sequencia) }}" id="{{ $ap->sequencia }}" class="btn btn-info boxColorTema">
												<i class="fa fa-eye"></i> Produtos</a>
										</td>
										<td>{{ $ap->peso_total }}</td>
										<td>{{ $ap->vlr_final == '' ? '0.00' : $ap->vlr_final }} USD</td>
										<td>
											<span class="label label-success">Aprovado</span>
										</td>
										<td>
											<span class="label label-danger">Não</span>
										</td>
										<td>
											<a href="{{ route('orcamento-edit', $ap->sequencia) }}" class="btn btn-warning">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>
											<button type="button" class="btn btn-danger or-delete" data-tab="pagamento1" data-orcamento="{{ $ap->sequencia }}"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="tab-pane" id="pagamento2">
					<div class="box">
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover tb-orcamento" id="pago">
								<thead>
									<tr>
										<th></th>
										<th>Suite</th>
										<th>Código</th>
										<th>Pacote</th>
										<th>Produtos</th>
										<th>Peso(lbs)</th>
										<th>Valor</th>
										<th>Status</th>
										<th>Pago</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach($pago as $pg)
									<tr>
										<td><input type="checkbox" name="groupid[]"></td>
										<td>{{ session('suite_prefix') }}{{ $pg->codigo_suite }}</td>
										<td>{{ $pg->sequencia }}</td>
										<td>
											@switch($pg->codigo_pacote) @case(1) First class @break @case(2) Priority Mail @break @case(3) Priority Express @break @endswitch
										</td>
										<td>
											<a href="{{ route('orcamento-detalhe', $pg->sequencia) }}" id="{{ $pg->sequencia }}" class="btn btn-info boxColorTema">
												<i class="fa fa-eye"></i> Produtos</a>
										</td>
										<td>{{ $pg->peso_total }}</td>
										<td>{{ $pg->vlr_final == '' ? '0.00' : $pg->vlr_final }} USD</td>
										<td>
											<span class="label label-success">Aprovado</span>
										</td>
										<td>
											<span class="label label-success">Sim</span>
										</td>
										<td>
											<a href="{{ route('orcamento-edit', $pg->sequencia) }}" class="btn btn-warning">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>
											<button type="button" class="btn btn-danger or-delete" data-tab="pagamento2" data-orcamento="{{ $pg->sequencia }}"><i class="fa fa-trash"></i></button>
											<a href="{{ route('gerapdf', $pg->sequencia) }}" target="_blank" class="btn btn-default"><i class="fa fa-file-text"></i> Gerar Recibo</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>



@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@stop 
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
<script>
	// $('#aguarda-aprovacao').dataTable({
	// 	language: {
	// 		url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
	// 	},
	// 	order: [[1, 'desc']] 
	// });
	// $('#aguarda-pagamento').dataTable({
	// 	language: {
	// 		url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
	// 	},
	// 	order: [[1, 'desc']] 
	// });
	// $('#pago').dataTable({
	// 	language: {
	// 		url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
	// 	},
	// 	order: [[1, 'desc']] 
	// });
	$('.tb-orcamento').dataTable({
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
		},
		order: [[1, 'desc']] 
	});

</script>

@stop