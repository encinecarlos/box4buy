<div id="modalAddEndereco" class="modal custom-modal">
    <div class="row">
        <p>
            <h4 class="text-center"><b>ADICIONAR NOVO ENDEREÇO</b></h4>            
        </p>        
    </div>    
    <form enctype="multipart/form-data" class="form-horizontal" id="form-enderecoadd" method="POST">
        <div class="form-group">
            @if(Auth::user()->type_user == 1)           
            <input id="codpessoa" name="codigo_suite" type="hidden" value="{{ $perfil->codigo_suite }}">
            @elseif(Auth::user()->type_user == 1)
            <input id="codpessoa" name="codigo_suite" type="hidden" value="{{ Auth::user()->codigo_suite }}">
            @endif
            <label class="col-sm-2 control-label" for="inputEndereco">
                Endereço
            </label>
            <div class="col-sm-6">
                <input class="form-control" id="inputEndereco" name="newendereco" placeholder="Endereço" type="text">                
            </div>
            <label class="col-sm-1 control-label" for="inputEndereco">
                Nº
            </label>
            <div class="col-sm-2">
                <input class="form-control" id="inputNumero" name="newnumero" placeholder="Nº" type="text">                
            </div>            
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="inputBairro">
                Bairro
            </label>
            <div class="col-sm-5">
                <input class="form-control" id="inputBairro" name="newbairro" placeholder="Bairro" type="text">
                </input>
            </div>
            <label class="col-sm-1 control-label" for="inputBairro">
                Cidade
            </label>
            <div class="col-sm-4">
                <input class="form-control" id="inputCidade" name="newcidade" placeholder="Cidade" type="text">
                </input>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="inputEstado">
                Estado
            </label>
            <div class="col-sm-5">
                <input class="form-control" id="inputEstado" name="newuf" placeholder="Estado" type="text">
                </input>
            </div>
            <label class="col-sm-1 control-label" for="inputEstado">
                Comp.
            </label>
            <div class="col-sm-4">
                <input class="form-control" id="inputComplemento" name="newcomplemento" placeholder="Complemento" type="text">
                </input>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="inputPaís">
                Pais
            </label>
            <div class="col-sm-5">
                <input class="form-control" id="inputPais" name="newpais" placeholder="Pais" type="text">
                </input>
            </div>
            <label class="col-sm-1 control-label" for="inputPaís">
                CEP
            </label>
            <div class="col-sm-4">
                <input class="form-control" id="inputCep" name="newcep" placeholder="CEP" type="text">
                </input>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-2 pull-right">
                    <a href="#" id="send-add" class="btn btn-info boxColorTema">SALVAR</a>
                </div>
                <div class="col-sm-2 pull-right">
                    <a href="#" class="btn btn-danger" rel="modal:close" ><i class="fa fa-close"></i> FECHAR</a>
                </div>
            </div>
        </div>

    </form>
</div>

{{-- @section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}"> @stop --}}