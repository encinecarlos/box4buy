@extends('base.base') @section('content')
<section id="plano_main">
    <div class="box box-info">
        <div class="box-header">
            <h1>Editar #CB120</h1>
        </div>
        <div class="box box-info">
            <form id="edit-form" action="#" method="post">
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Código Encomenda</th>
                                <th>Código de barras</th>
                                <th>foto</th>
                                <th>Peso</th>
                                <th>Quant. Estoque</th>
                                <th>Quant. Envio</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="produto" value="Celular">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="encomenda" value="COD: 1234565-BR">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="barra" value="COD: 123456532930">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="foto" value="-">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="peso" value="2LBS">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="estoque" value="3">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="envio" value="5">
                                </td>

                                <td>
                                    <select name="produto_status" name="status" class="input-status">
                                        <option value="0">Produto no local</option>
                                        <option value="0">A chegar</option>
                                        <option value="0">Produto em orçamento</option>
                                        <option value="0">Produto despachado</option>
                                    </select>
                                </td>
                            </tr>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{url('/estoque')}}" id="btn-save" class="btn-action pull-right">Salvar alteração</a>
                    <a href="{{url('/estoque')}}" class="btn-action pull-left">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop