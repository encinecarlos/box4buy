@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cogs"></i> CONFIGURAÇÕES DO SISTEMA</h3>
        </div>
        <div class="box-content">
            <div class="box box-info">
                <div class="box-header">
                    <h4>Alterar parametros do sistema</h4>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="" method="post" id="config-save">
                        @csrf
                        <div class="box box-info">
                            <div class="box-heder">
                                <h4>Endereço nos EUA</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    {{--<label class="control-label col-sm-1">Nome:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_name" class="form-control" value="{{ $configs->cfg_name }}">
                                    </div>--}}

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
                            </div>
                        </div>

                        <div class="box box-info">
                            <div class="box-header">
                                <h4>Taxas Box4Buy</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-1">Taxa até 4LBS:</label>
                                    <div class="col-sm-3">
                                        <input type="text"
                                               name="taxa01"
                                               class="form-control money"
                                               value="{{ $configs->cfg_taxa_01 }}">
                                    </div>


                                    <label class="control-label col-sm-1">Taxa até 10LBS:</label>
                                    <div class="col-sm-3">
                                        <input type="text"
                                               name="taxa02"
                                               class="form-control money"
                                               value="{{ $configs->cfg_taxa_02 }}">
                                    </div>


                                    <label class="control-label col-sm-1">Taxa até 66LBS:</label>
                                    <div class="col-sm-3">
                                        <input type="text"
                                               name="taxa03"
                                               class="form-control money"
                                               value="{{ $configs->cfg_taxa_03 }}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="button"
                                        class="btn btn-info btn-rounded boxColorTema save-config">
                                    <i class="fa fa-check"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $('.money').maskMoney();
    </script>
@endsection
