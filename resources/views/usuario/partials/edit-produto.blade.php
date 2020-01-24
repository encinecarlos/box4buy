<div class="modal custom-modal" id="edit-produto-{{ $produto->seq_produto }}">
    <div class="row">
        <div class="box box-info">
            <div class="box-header">
                <h4 class="text-center">INFORMAR PRODUTO ENVIADO A BOX4BUY</h4>
                <div class="box-tools">						
                    <a href="#" class="close" rel="modal:close"><i class="fa fa-close"></i></a>
                </div>					
            </div>

            <form class="form-horizontal" id="form-estoque-edit-{{ $produto->seq_produto }}" enctype="multipart/form-data" method="POST">
                <div class="box-body">
                    @method('PUT')
                    <input type="hidden" name="suite_edit" value="{{ Auth::user()->codigo_suite }}">
                    <input type="hidden" name="_action" value="user">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2">produto:</label>
                            <div class="col-sm-4">
                                <input type="text" name="descricao" value="{{ $produto->descricao_produto }}" placeholder="Descrição do produto" class="form-control">
                            </div>

                            <label class="control-label col-sm-2">Quantidade:</label>
                            <div class="col-sm-4">
                                <input type="text" name="quantidade" value="{{ $produto->qtde }}" class="form-control">	
                            </div>
                        </div>    
                    </div>                    

                    
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nome da Loja:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ $produto->nome_loja }}" name="nomeloja">	
                            </div>

                            <label class="control-label col-sm-2">Site da Loja:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ $produto->site_loja }}" name="siteloja">	
                            </div>
                        </div>    
                    </div>

                    
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Track Number:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ $produto->codigo_rastreio }}" name="codigorastreio" placeholder="Código de Rastreio">
                            </div>

                            <label class="control-label col-sm-2">Data da compra:</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" value="{{ $produto->data_compra->format('Y-m-d') }}" name="datacompra">
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" 
                                class="btn btn-info boxColorTema edit-produto-user"
                                data-idproduto="{{ $produto->seq_produto }}"><i class="fa fa-check"></i> Enviar</button>
                </div>					
            </form>				
        </div>						
    </div>
</div>