@extends('base.base') @section('content')
<section id="enderecos_main">
    <div class="box box-info">
        <div class="box-header">
            <h1>Endereços</h1>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="input-group input-group-sm input-pesquisa">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Pesquisar endereços">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Nome cliente</th>
                                    <th>CEP</th>
                                    <th>Endereço</th>
                                    <th>País</th>

                                </tr>

                                <tr>
                                    <td>
                                        <i class="fa fa-map-o" aria-hidden="true"></i>
                                    </td>
                                    <td>01</td>
                                    <td>{{'_Teste'}}</td>
                                    <td>{{ '_00000-000' }}</td>
                                    <td>{{ '_Rua teste' }}</td>
                                    <td>{{ '_Brasil' }}</td>
                                    <td>
                                        <a href="{{url('/enderecos/show')}}" class="link_opcoes_tabela">
                                            Ver mais
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{url('/enderecos/edit')}}" class="link_opcoes_tabela">
                                            Editar
                                        </a>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div class="box-footer">
                            <a href="{{url('enderecos/add')}}" class="btn btn-info pull-right">Adicionar um endereço</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop