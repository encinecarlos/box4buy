<div class="modal custom-modal" id="produtoadd">
    <div class="box box-info">
        <div class="box-header">
            <h4><b>Adicionar produto</b></h4>
        </div>
        <div class="box-body">
            <form enctype="multipart/form-data" id="additem" method="POST">
                <input type="hidden" name="suite" value="{{ Auth::user()->codigo_suite }}">
                <input type="hidden" name="compra_id" value="{{ $solicitacao->sequencia }}">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Link:</label>
                        <input type="url" name="linkproduto" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label>Nome do produto:</label>
                        <input type="text" name="nomeproduto" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Tamanho:</label>
                        <input type="text" name="tamanhoproduto" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label>Cor:</label>
                        <input type="text" name="corproduto" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label>Subitutir tamanho:</label>
                        <input type="text" name="substituitamanho" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <label>Substituir cor:</label>
                        <input type="text" name="substituicor" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <label>Quantidade:</label>
                        <input type="number" name="quantidade" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <label>Valor:</label>
                        <input type="text" name="valorproduto" class="form-control">
                    </div>

                    <div class="col-sm-8">
                        <label>Observações:</label>
                        <input type="text" name="obervacoes" class="form-control">
                        {{--<textarea class="form-control" name="observcaoes" cols="30" rows="10"></textarea>--}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4>Informações Adicionais</h4>
                    </div>

                </div>


                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>
                                    Se um item não estiver disponível:
                                    <select name="fora_estoque" class="form-control">
                                        <option value="1">Compra os demais itens</option>
                                        <option value="2">Cancela o pedido</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label>Observações Adicionais</label>
                        <textarea name="observacoesadicionais" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                </div>

                <div class="form-group">

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-rounded boxColorTema additem"><i class="fa fa-plus"></i> ADICIONAR PRODUTO</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
