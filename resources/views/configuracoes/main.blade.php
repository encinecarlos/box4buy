@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cogs"></i> CONFIGURAÇÕES DO SISTEMA</h3>
        </div>
        <div class="box-content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="#endereco" data-toggle="tab" aria-expanded="true">Endereço</a></li>                    
                </ul>
                <div class="tab-content">                    
                    <div class="tab-pane active" id="endereco">
                        <div class="box box-info">
                            <div class="box-header">
                                <h4>Endereço nos EUA</h4>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal" action="">
                                    <div class="form-group">
                                        <label class="control-label col-sm-1">Nome:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="cfg_name" class="form-control" value="{{ $configs->cfg_name }}">
                                        </div>

                                        <label class="control-label col-sm-1">Endereço:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="cfg_address" class="form-control" value="{{ $configs->cfg_address }}">
                                        </div>

                                        <label class="control-label col-sm-1">Cidade:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="cfg_city" class="form-control" value="{{ $configs->cfg_city }}">
                                        </div>                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-1">Estado:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="cfg_state" class="form-control" value="{{ $configs->cfg_state }}">
                                        </div>

                                        <label class="control-label col-sm-1">Zip Code:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="cfg_zipcode" class="form-control" value="{{ $configs->cfg_zipcode }}">
                                        </div>
                                        
                                        <label class="control-label col-sm-1">Telefone:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="cfg_phone" class="form-control" value="{{ $configs->cfg_phone }}">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-info boxColorTema"><i class="fa fa-check"></i> Salvar</button>
                                        </div>
                                    </div>                             
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@stop