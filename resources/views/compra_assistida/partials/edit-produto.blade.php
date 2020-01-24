<div class="modal custom-modal" id="edit-{{ $produto->sequencia }}">
    <div class="box box-info">
        <div class="box-header">
            <h4><b>Editar Produto</b></h4>
            <div class="box-tools">
                <a href="#" rel="modal:close" class="close"><i class="fa fa-close"></i></a>
            </div>
        </div>
        <div class="box-body">
            <form enctype="multipart/form-data" class="update-item" method="POST">
                <input type="hidden" name="itemid" value="{{ $produto->sequencia }}">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>Link:</label>
                        <input type="url" name="linkproduto" class="form-control" value="{{ $produto->link_produto }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Tamanho:</label>
                        <input type="text" name="tamanhoproduto" class="form-control" value="{{ $produto->tamanho }}">
                    </div>

                    <div class="col-sm-3">
                        <label>Cor:</label>
                        <input type="text" name="corproduto" class="form-control" value="{{ $produto->cor }}">
                    </div>

                    <div class="col-sm-3">
                        <label>Subitutir tamanho:</label>
                        <input type="text" name="substituitamanho" class="form-control" value="{{ $produto->substitui_tamanho }}">
                    </div>

                    <div class="col-sm-3">
                        <label>Substituir cor:</label>
                        <input type="text" name="substituicor" class="form-control" value="{{ $produto->substitui_cor }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <label>Quantidade:</label>
                        <input type="number" name="quantidade" class="form-control" value="{{ $produto->quantidade }}">
                    </div>
                    <div class="col-sm-2">
                        <label>Valor:</label>
                        <input type="text" name="valorproduto" class="form-control" value="{{ $produto->preco }}">
                    </div>

                    <div class="col-sm-8">
                        <label>Observações:</label>
                        <input type="text" name="observacoes" class="form-control" value="{{ $produto->observacao }}">
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
                                        <option value="1" {{ $produto->fora_estoque == '1' ? 'selected' : '' }}>Compra os demais itens</option>
                                        <option value="2" {{ $produto->fora_estoque == '2' ? 'selected' : '' }}>Cancela o pedido</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label>Observações Adicionais</label>
                        <textarea name="observacoesadicionais" class="form-control" cols="30" rows="5">{{ $produto->obervacoes_adicionais }}</textarea>
                    </div>

                </div>

                <div class="form-group">

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-info btn-rounded boxColorTema edit-produto"><i class="fa fa-send"></i> ATUALIZAR PRODUTO</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
