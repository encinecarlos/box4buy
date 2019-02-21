@extends('base.base') @section('content')
<section id="enderecos_main">
    <div class="box box-info">
        <div class="box-header">
            <h1>Editar um Endereço</h1>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEndereco" class="col-sm-2 control-label">Endereço
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEndereco" placeholder="Endereço">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNumero" class="col-sm-2 control-label">Número
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputNumero" placeholder="Número">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputComplemento" class="col-sm-2 control-label">Complemento</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputComplemento" placeholder="Complemento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCEP" class="col-sm-2 control-label">CEP
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cep" placeholder="CEP">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputCidade" class="col-sm-2 control-label">Cidade
                                <sup>*</sup>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCidade" placeholder="Cidade">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEstado" class="col-sm-2 control-label">Estado
                                <sup>*</sup>
                            </label>
                            <div class="col-sm-10">
                                <select class="select_cadastro" required name="uf_naturalidade">
                                    <option value="">UF da Naturalidade*</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPaís" class="col-sm-2 control-label">País
                                <sup>*</sup>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPais" placeholder="País">
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{url('/enderecos')}}" class="btn btn-default">CANCELAR</a>
                            <button type="submit" class="btn btn-info pull-right">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop