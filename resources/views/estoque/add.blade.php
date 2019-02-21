@extends('base.base') 

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <br />
		<a><i class="fa fa-user"></i> <span>ADICIONAR PRODUTO</span></a>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post">
        
        <div class="box-body">		
			<div class="form-group notMarging">								                                
               
			<div class="form-group notMarging">
                <label for="inputSuite" class="col-sm-2 control-label">Número do Suíte</label>
                <div class="col-sm-2">
                    <select name="suite" class="form-control">
                        <option value="">Selecione um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->codigo_suite }}">{{ session('suite_prefix') }}{{ $cliente->codigo_suite }} - {{ $cliente->nome_completo }}</option>
                        @endforeach
                    </select>
                </div>
				{{-- <label for="inputNome" class="col-sm-2 control-label">Nome do Cliente</label>
                <div class="col-sm-5">
                    <input type="text" name="_nome" class="form-control" id="inputNome" value=" " placeholder="Nome">
                </div> --}}
            </div>

			<div class="form-group notMarging">
                <label for="inputCodigoEnc" class="col-sm-2 control-label">Código Encomenda</label>
                <div class="col-sm-4">
                    <input type="text" name="_codigo" class="form-control" id="inputCodigoEnc" value=" " placeholder="Código Encomenda">
                </div>
				<label for="inputCodigoBarra" class="col-sm-1 control-label">Código Barra</label>
                <div class="col-sm-4">
                    <input type="text" name="_codigoBarra" class="form-control" id="inputCodigoBarra" value=" " placeholder="Código Barra">
                </div>
            </div>

            <div class="form-group notMarging">
                <label for="inputPeso" class="col-sm-2 control-label">Peso</label>
                <div class="col-sm-4">
                    <input type="text" name="_peso" class="form-control" id="inputPeso" value=" " placeholder="Peso LBS">
                </div>
				<label for="inputQuant" class="col-sm-1 control-label">Qt. Enc.</label>
                <div class="col-sm-4">
                    <input type="email" name="_quant" class="form-control" id="inputQuant" value=" " placeholder="Quantidade Encomenda">
                </div>
            </div>

			<div class="form-group notMarging">
                <label for="inputQtEnvio" class="col-sm-2 control-label">Qt. Envio.</label>
                <div class="col-sm-4">
                    <input type="text" name="_qtEnvio" class="form-control" id="inputQtEnvio" value=" " placeholder="Quantidade Envio">
                </div>
				<label for="inputStatus" class="col-sm-1 control-label">Status</label>
                <div class="col-sm-4">
                    <select name="status" class="form-control">
                        <option value="1">A chegar</option>
                        <option value="2">Produto no Local</option>
                        <option value="3">Produto em Orçamento</option>
						<option value="4">Produto Enviado</option>
                    </select>
                </div>
            </div>
			<br>

			<div class="box-body"> 
			<div class="col-sm-1 pull-right"></div>
			<div class="col-sm-2 pull-right">
            <input type="submit" id="send-produto" class="btn btn-info pull-right boxColorTema" value="ADICIONAR" />
			</div>
			<div class="col-sm-1 pull-right">
			<button type="submit" class="btn btn-info pull-right boxColorTema">CANCELAR</button>
			</div>
		</div>					
	</form>
</div><!-- /.box-body -->                        


@stop 

@section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@stop