@extends('base.usuario-base')

@section('content')
<!-- Essa DIV deverá aparecer no MEU PERFIL CLIENTE -->
<div class="box box-info">
    <div class="box-header with-border">
        <br/>
        <a>
            <i class="fa fa-user">
            </i>
            <span>
                MEU PERFIL
            </span>
        </a>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal form-ajax" id="form-dados" method="post">
        @method('PUT')
        <div class="box-body">            
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputNome">
                        Nome:
                    </label>
                    <div class="col-sm-6">                        
                        <p class="form-control">{{ $perfil->nome_completo }}</p>                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputSexo">
                        Sexo:
                    </label>
                    <div class="col-sm-2">
                        @switch($perfil->sexo)
                            @case(1)
                                <p class="form-control">Masculino</p>
                                @break
                            @case(2)
                                <p class="form-control">Feminino</p>
                                @break
                            @default
                                <p class="form-control">Não Informado</p>                                                           
                        @endswitch                        
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputDataNascimento">
                        Data Nascimento:
                    </label>
                    <div class="col-sm-4">
                        <p class="form-control">{{ date('d/m/Y', strtotime($perfil->data_nascimento)) }}</p>                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputEmail">
                        Email
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $perfil->email }}</p>
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputCPF">
                        CPF:
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $perfil->cpf_cnpj }}</p>
                    </div>
                    <label class="col-sm-1 control-label" for="inputCPF">
                        RG:
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $perfil->rg_ie }}</p>
                    </div>
                </div>                
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputTelefone">
                        Telefone:
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $contato[0]['telefone'] != '' ? $contato[0]['telefone'] : '' }}</p>
                    </div>
                    <label class="col-sm-1 control-label" for="inputTelefone">
                        Telefone 02:
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $contato[0]['telefone_01'] != '' ? $contato[0]['telefone_01'] : '' }}</p>
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputCelular">
                        Celular:
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $contato[0]['celular'] != '' ? $contato[0]['celular'] : '' }}</p>
                    </div>
                    <label class="col-sm-1 control-label" for="inputCelular">
                        Celular 02:
                    </label>
                    <div class="col-sm-4">                        
                        <p class="form-control">{{ $contato[0]['celular_01'] != '' ? $contato[0]['celular_01'] : '' }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputEstadoCivil">
                        Estado Civil:
                    </label>
                    <div class="col-sm-9">
                        <p class="form-control">
                            @switch($perfil->estado_civil)
                                @case(1)
                                    Solteiro(a)
                                    @break
                                @case(2)
                                    Casado(a)
                                    @break
                                @case(3)
                                    Viuvo(a)
                                    @break
                                @case(4)
                                    Divorciado(a)        
                                    @break
                                @default
                                    Não Informado
                                    @break                                        
                            @endswitch
                        </p>
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputAdicionaEdereco">
                        Endereços:
                    </label>
                    <div class="col-sm-9">
                        <table class="table">
                            <thead>
                                <th>Rua</th>
                                <th>n°</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th>Complemento</th>
                                <th>CEP</th>
                                <th>País</th>
                            </thead>
                            <tbody>
                                @foreach($perfil_endereco as $endereco)
                                <tr>
                                    <td>{{ $endereco->endereco }}</td>
                                    <td>{{ $endereco->numero }}</td>
                                    <td>{{ $endereco->bairro }}</td>
                                    <td>{{ $endereco->cidade }}</td>
                                    <td>{{ $endereco->estado }}</td>
                                    <td>{{ $endereco->complemento }}</td>
                                    <td>{{ $endereco->codigo_postal }}</td>
                                    <td>{{ $endereco->pais }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>					
                </div>
                
                <div class="form-group">
                    <div class="col-sm-1 pull-right">
                        <a href="{{ route('perfil-edit', $perfil->codigo_suite) }}" class="btn btn-info pull-right btn-rounded boxColorTema">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </div>                    
                </div>
            </div>
        </div>
    </form>
</div>
<!-- FINAL DIV MEU PERFIL CLIENTE  -->
@stop

@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">    
@stop


