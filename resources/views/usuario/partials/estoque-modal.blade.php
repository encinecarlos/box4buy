<section id="modals">
    <div class="modal fade" id="estoque-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4>ENVIAR DOCUMENTOS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                                <form class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="suite" value="{{ Auth::user()->codigo_suite }}">
                        <div class="box-header with-border">
                            <br />
                            <h3 class="box-title">INFORMAR PRODUTOS ENVIADOS A BOX4BUY</h3>
                            <div class="box-tools pull-right"></div>
                            <br/>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNomeLoja" class="col-sm-2 control-label">Nome Loja:</label>

                                <div class="col-sm-10">
                                    <input type="text" name="nomeloja" class="form-control" id="inputNomeLoja" placeholder="Insira o nome da loja">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDataCompra" class="col-sm-2 control-label">Data Compra:</label>
                                <div class="col-sm-4">
                                    <input type="date" name="datacompra" class="form-control" id="inputDataCompra" placeholder="Insira a data compra">
                                </div>
                                <label for="inputCodRastreio" class="col-sm-2 control-label">Código Rastreio:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="codigorastreio" class="form-control" id="inputCodRastreio" placeholder="Insira o código rastreio">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSite" class="col-sm-2 control-label">Site da Loja:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="siteloja" class="form-control" id="inputSite" placeholder="Insira o site da loja">
                                </div>
                                <label for="inputCodRastreio" class="col-sm-2 control-label">Descrição:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="descricao" class="form-control" id="inputCodRastreio" placeholder="Decrição do produto">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default">CANCELAR</button>
                                <input type="submit" id="send-produto" class="btn btn-info boxColorTema" value="ENVIAR">
                            </div>				 
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</section>
