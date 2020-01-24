<section id="modals">
    <div class="modal fade" id="modalEndereco" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4>ENDEREÇO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-12">
                                <label for="rg">COMPROVANTE DE IDENTIDADE</label>
                                <div class="dropzone" id="rg">
                                    <input type="hidden" name="suite" id="suite" value="{{ Auth::user()->codigo_suite }}">
                                    <div class="custom-dropzone">
                                        <p class="dz-message"><i class="fa fa-file-text"></i> Envie seu RG</p>      
                                    </div>
                                                                  
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                                <label for="rg">COMPROVANTE DE ENDEREÇO</label>
                                <div class="dropzone" id="comprovante">                                    
                                    <div class="custom-dropzone">
                                        <p class="dz-message"><i class="fa fa-file-text"></i> Envie seu comprovante de endereço</p>
                                    </div>                                                                        
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!--

<section id="modals">
    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-hidden="true">
<form enctype="multipart/form-data" method="POST">
    <div class="form-group" id="selectEndereco">
        <label for="inputEstadoCivil" class="col-sm-4 control-label">Escolha o endereço</label>
            <div class="col-sm-7">
            <select name="escolhaEndereco" class="form-control">
                <!-- AQUI VAI OS ENDEREÇOS-->
            </select>
            </div>
        </div>
        <br>
            <input type="hidden" name="cod_pessoa" value="{{ $perfil->sequencia }}">
            <label for="inputEndereco" class="col-sm-2 control-label">Endereço</label>
            <div class="col-sm-7">
                <input name="endereco" type="text" class="form-control" id="inputEndereco" placeholder="Endereço">
            </div>
            <label for="inputEndereco" class="col-sm-1 control-label">Nº</label>
            <div class="col-sm-2">
                <input name="new-numero" type="text" class="form-control" id="inputNumero" placeholder="Nº">
            </div>
        </div>
        <div class="form-group">
            <label for="inputBairro" class="col-sm-2 control-label">Bairro</label>
            <div class="col-sm-5">
                <input name="new-bairro" type="text" class="form-control" id="inputBairro" placeholder="Bairro">
            </div>
            <label for="inputBairro" class="col-sm-1 control-label">Cidade</label>
            <div class="col-sm-4">
                <input name="new-cidade" type="text" class="form-control" id="inputCidade" placeholder="Cidade">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEstado" class="col-sm-2 control-label">Estado</label>
            <div class="col-sm-5">
                <input name="new-uf" type="text" class="form-control" id="inputEstado" placeholder="Estado">
            </div>
            <label for="inputEstado" class="col-sm-1 control-label">Comp.</label>
            <div class="col-sm-4">
                <input name="new-complemento" type="text" class="form-control" id="inputComplemento" placeholder="Complemento">
            </div>
        </div>
        <div class="form-group paddingFinal">
            <label for="inputPaís" class="col-sm-2 control-label">Pais</label>
            <div class="col-sm-5">
                <input name="new-pais" type="text" class="form-control" id="inputPais" placeholder="Pais">
            </div>
            <label for="inputPaís" class="col-sm-1 control-label">CEP</label>
            <div class="col-sm-4">
                <input name="new-cep" type="text" class="form-control" id="inputCep" placeholder="CEP">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 pull-right">
                <button type="submit" id="send-endereco" class="btn text-white boxColorTema pull-right paddingLft">SALVAR</button>
            </div>
            <div class="col-sm-2 pull-right">
                <button type="button" class="btn text-white boxColorTema pull-right paddingRht" data-dismiss="modal">CANCELAR</button>
              </div>
        {{-- </div> --}}
		        </div>
</section>
-->
</form>