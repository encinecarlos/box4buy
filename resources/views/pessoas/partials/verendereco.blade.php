<div id="modalEndereco" class="modal custom-modal">
    <div class="row">
        <p>
            <h4 class="text-center"><b>EDITAR ENDEREÇO</b></h4>            
        </p>        
    </div>
    <form enctype="multipart/form-data" class="form-horizontal" id="form-endereco" method="POST">
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-3 control-label" for="inputEstadoCivil">
                    Escolha o endereço
                </label>
                <div class="col-sm-8">
                    <select class="form-control" name="escolhaEndereco" id="selectEndereco">
                        <option value="">
                            Selecione
                        </option>
                        @foreach($pessoa_endereco as $endereco)
                        <option value="{{ $endereco->seq_endereco }}">
                            {{ $endereco->endereco }}, {{ $endereco->numero }}
                        </option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="form-group">            
            <input id="codpessoa" name="codigo_suite" type="hidden">
            <label class="col-sm-2 control-label" for="inputEndereco">
                Endereço
            </label>
            <div class="col-sm-6">
                <input class="form-control" id="inputEndereco" name="newendereco" placeholder="Endereço" type="text">
                </input>
            </div>
            <label class="col-sm-1 control-label" for="inputEndereco">
                Nº
            </label>
            <div class="col-sm-2">
                <input class="form-control" id="inputNumero" name="newnumero" placeholder="Nº" type="text">
                </input>
            </div>
            </input>
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
                    <button class="btn text-white boxColorTema pull-right paddingLft" data-dismiss="modal" id="send-endereco" type="button">
                        SALVAR
                    </button>
                </div>
                <div class="col-sm-2 pull-right">
                    <a href="#" class="btn btn-danger  pull-right paddingRht" rel="modal:close">
                        <i class="fa fa-close"></i>
                        Fechar
                    </a>
                </div>
            </div>
        </div>

    </form>
</div>

{{-- @section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}"> @stop --}}