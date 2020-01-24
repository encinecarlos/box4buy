@extends('base.base') 

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <br />
		<a><i class="fa fa-bar-chartr"></i> <span>ORÇAMENTO</span></a>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal form-ajax" method="post">
        <div class="box-body">		
			<div class="form-group notMarging">								                                
			<div class="form-group notMarging">
                <label for="inputCodigo" class="col-sm-2 control-label">Código de barra</label>
                <div class="col-sm-4">
                    <input type="text" name="_codBarra" class="form-control" id="inputCodigo" value=" " placeholder="Código de Barra" required>
                </div>
				<label for="inputData" class="col-sm-1 control-label">Data e Hora</label>
                <div class="col-sm-4">
					<input type="text" class="form-control" id="datepicker" name="data_e_hora"placeholder="Data e Hora" required>            
                </div>
            </div>
            <div class="form-group notMarging">
                <label for="inputSolicitacao" class="col-sm-2 control-label">Dias de solicitação do orçamento</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputSolicitacao" name="_dias" placeholder="Dias" required> 
                </div>
				<label for="inputFrete" class="col-sm-1 control-label">Tipo de Frete</label>
                <div class="col-sm-4">
					<select type="text" class="form-control" id="inputFrete" name="tipo_frete" required>
					    <option value="1">First Class</option>
					    <option value="2">Priority Mail</option>
					    <option value="3">Priority Express</option>
					</select>
                </div>
            </div>
			<div class="form-group notMarging">
                <label for="inputQuant" class="col-sm-2 control-label">Quantidade de produtos</label>
                <div class="col-sm-4">
                    <input type="text" name="_qtdProduto" class="form-control" id="inputQuant" value=" " placeholder="Quantidade de produtos" required>
                </div>
				<label for="inputPeso" class="col-sm-1 control-label">Peso</label>
                <div class="col-sm-4">
					<input type="text" class="form-control" id="inputPeso" name="_peso"placeholder="Peso" required>            
                </div>
            </div>
           
		    <div class="form-group notMarging">
                <label for="inputPreco" class="col-sm-2 control-label">Preço</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputPreco" name="_preco" placeholder="Preço" required> 
                </div>
				<label for="inputStatus" class="col-sm-1 control-label">Status</label>
                <div class="col-sm-4">
					<select type="text" class="form-control" id="inputStatus" name="_status" required>
					    <option value="1">Pendente</option>
					    <option value="2">Pendente de Pagamento</option>
					    <option value="3">Pago</option>
					</select>
                </div>
            </div>

			<div class="box-body"> 
			<div class="col-sm-2 pull-right">
            <button type="submit" id="send" class="btn btn-info pull-right boxColorTema">ADICIONAR</button>
			</div>
			<div class="col-sm-1 pull-right">
			<a href="{{url('/orcamento')}}" class="btn btn-info pull-right boxColorTema">CANCELAR</a>
			</div>
		</div>
	</form>
</div>


@stop 

@section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<script src="{{ asset('js/usuario-estoque.js') }}"></script>
@stop

@section('js')
<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
@stop
