{{-- <div class="modal fade" id="modal-produto-{{ $e->seq_produto }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar produto</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-produto" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="suite"  value="{{ Auth::user()->codigo_suite }}">
                    <input type="hidden" name="produto" value="{{ $e->seq_produto }}">
                    <div class="form-group">
                        <div class="row">                            
                            <label class="control-label col-sm-2">Status:</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="2">Em Estoque</option>
                                    <option value="3">Em Orçamento</option>
                                    <option value="4">Despachado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info send-produto">Salvar</button>        
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div> --}}

<div class="modal" id="modal-produto-{{ $e->seq_produto }}">    
    <div>
        <form action="">
            <h1>{{ $e->seq_produto }}</h1>
            <h2>{{ $e->codigo_suite }}</h2>        
        </form>
    </div>    
</div>