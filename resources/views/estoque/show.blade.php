@extends('base.base') @section('content')
<section id="show_estoque">
    <div class="box box-info">
        <div class="box-header">
            <h1>#CB120</h1>

            <div class="pull-right tempo-restante-titulo">
                <h2>Dias restantes</h2>
                <p>20 dias</p>
            </div>
        </div>
        <div class="box box-info">
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
                            <td>Celular</td>
                            <td>COD: 1234565-BR</td>
                            <td>COD: 12345652834739</td>
                            <td>-</td>
                            <td>2 LBS</td>
                            <td>3</td>
                            <td>5</td>
                            <td>A chegar</td>
                        </tr>
                        <tr>
                            <td>Celular</td>
                            <td>COD: 1234565-BR</td>
                            <td>COD: 12345652834739</td>
                            <td>-</td>
                            <td>2 LBS</td>
                            <td>3</td>
                            <td>5</td>
                            <td>A chegar</td>
                        </tr>
                        <tr>
                            <td>Celular</td>
                            <td>COD: 1234565-BR</td>
                            <td>COD: 12345652834739</td>
                            <td>-</td>
                            <td>2 LBS</td>
                            <td>3</td>
                            <td>5</td>
                            <td>A chegar</td>
                        </tr>
                </table>
            </div>

            <div class="box-footer">
                <a href="{{url('/estoque')}}" class="btn-action pull-right">Excluir este estoque</a>
                <a href="{{url('estoque/edit')}}" class="btn-action pull-left">Editar este estoque</a>
            </div>
        </div>
    </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop