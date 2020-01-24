@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>Atualizar produto</h4>            
        </div>
        <div class="box-body">
            <form class="form-horizonta" method="POST">                
                <div class="form-group">
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-info" value="Enviar">
                    </div>                                       
                </div>
            </form>
        </div>
    </div>
@stop