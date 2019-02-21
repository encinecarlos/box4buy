@extends('base.base') @section('content')
<section class="content" id="content-orcamento">
    <div class="box-header with-border">
        <br>
        <a>
            <i class="fa fa-bar-chart"></i>
            <span>ORÇAMENTO</span>
        </a>
        <div class="box-tools pull-right"></div>
    </div>
    <div id="adm-aprovacao" class="tabela-1">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header table-campus">
                        <div class="box-tools col-lg-12">
                            <div class="pull-left">
                                <a href="{{route('orcamento-add')}}" class="btn btn-info pull-right btn-danger" id="btn_salvar_orcamento">Excluir</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('orcamento-add')}}" class="btn btn-info pull-right boxColorTema">Salvar</a>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Cód.Nº</th>
                                <th>Data</th>
                                <th>Qtd. dias</th>
                                <th>Tipo de Frete</th>
                                <th>Qtd.</th>
                                <th>Peso(lbs)</th>
                                <th>US$</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-show" name="codigo_numero" value="1212183" required>
                                </td>
                                <td>
                                    <input type="text" class="form-show" name="data" value="11-7-2014" required>
                                </td>
                                <td>
                                    <input type="text" class="form-show" name="qtd_dias" value="5" required>
                                </td>
                                <td>
                                    <select type="text" class="form-show" name="tipo_frete" required>
                                        <option value="first_Class">First Class</option>
                                        <option value="priority_Mail">Priority Mail</option>
                                        <option value="priority_Express">Priority Express</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-show" value="8" name="quantidade" required>
                                </td>
                                <td>
                                    <input type="text" class="form-show" value="120" name="peso" required>
                                </td>
                                <td>
                                    <input type="text" class="form-show" value="$200" name="us" required>
                                </td>
                                <td>
                                    <select type="text" class="form-show" name="tipo_status" required>
                                        <option value="pendente">Pendente</option>
                                        <option value="pendente_em_pagamento">Pendente em pagamento</option>
                                        <option value="pago">Pago</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop @section('css')

<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop