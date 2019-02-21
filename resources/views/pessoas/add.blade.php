@extends('base.base')

@section('content')
<!-- Essa DIV deverá aparecer no MEU PERFIL CLIENTE -->
<div class="box box-info">
    
    <div class="alert alert-danger alert-errors">
        <ul id="list-error" style="list-style-type: none">
        </ul>
    </div>

    <div class="box-header with-border">
        <br/>
        <a>
            <i class="fa fa-user">
            </i>
            <span>
                NOVO USUARIO
            </span>
        </a>
        <div class="box-tools pull-right">
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal form-ajax noenter" id="form-dados" method="post">                
        <div class="box-body">
            <div class="form-group notMarging">                
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputNome">
                        Nome
                    </label>
                    <div class="col-sm-2">
                        <input class="form-control" id="inputNome" name="_nome" placeholder="Nome" type="text">                        
                    </div>

                    <label class="control-label col-sm-1">Tipo de Usuário:</label>
                    <div class="col-sm-3">
                        <select name="type_user" class="form-control">
                            <option value="1">Administrador</option>
                            <option value="2">Cliente</option>
                        </select>
                    </div>

                    <label class="col-sm-1 control-label" for="inputSexo">
                        Sexo
                    </label>
                    <div class="col-sm-2">
                        <select class="form-control" id="inputSexo" name="sexo">
                            <option value="1">
                                Masculino
                            </option>
                            <option value="2">
                                Feminino
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputDataNascimento">
                        Data Nascimento
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control pull-right" id="datepicker" name="data_nascimento"  type="date">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputEmail">
                        Email
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputEmail" name="email" placeholder="Email" type="email">
                        
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputCPF">
                        CPF
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputCPF" name="cpf_cnpj" placeholder="CPF" type="text">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputRG">
                        RG
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputRG" name="rg_ie" placeholder="RG" type="text">                        
                    </div>
                </div>                
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputTelefone">
                        Telefone
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 999-9999"' data-mask="" name="telefone" placeholder="Telefone 01" type="text">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputTelefone">
                        Telefone 02
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 999-9999"' data-mask="" name="telefone_01" placeholder="Telefone 02" type="text">
                        
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputCelular">
                        Celular
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask="" name="celular" placeholder="Celular 01" type="text">                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputCelular">
                        Celular 02
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask="" name="celular_01" placeholder="Celular 02" type="text">                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputEstadoCivil">
                        Estado Civil
                    </label>
                    <div class="col-sm-9">
                        <select class="form-control" name="estado_civil">
                            @foreach($estado_civil as $estadocivil)
                            <option value="{{ $estadocivil->sequencia }}">{{ $estadocivil->descricao }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Endereço:</label>
                    <div class="col-sm-6">
                        <input type="text" name="endereco" class="form-control">
                    </div>
                    <label class="control-label col-sm-1">N°:</label>
                    <div class="col-sm-2">
                        <input type="text" name="numero" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Bairro:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="bairro">
                    </div>

                    <label class="control-label col-sm-2">Cidade:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="cidade">
                    </div>

                    <label class="control-label col-sm-1">UF:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="estado">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">CEP:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="cep">
                    </div>

                    <label class="control-label col-sm-3">País:</label>
                    <div class="col-sm-2">
                        <select name="pais" class="form-control">
                            <option value="BR">Brasil</option>
                        </select>
                    </div>                    
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2">Complemento:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="complemento">
                    </div>
                </div>

                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputValida">
                        Senha:
                    </label>
                    <div class="col-sm-2">
                        <input class="form-control" id="inputSenha" name="password" placeholder="Nova Senha" type="password">                        
                    </div>
                    <label class="col-sm-2 control-label" for="inputConfirma">
                        Confirmar Senha:
                    </label>
                    <div class="col-sm-2">
                        <input class="form-control" id="inputConfirma" name="confirma_password" placeholder="Confirmar Senha" type="password">                        
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="password-generate" class="btn btn-default boxColorTema">Gerar Senha</button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-sm-1 pull-right">
                        <button class="btn btn-info pull-right boxColorTema" id="send-addadmin" type="submit">
                            SALVAR
                        </button>
                    </div>
                    <div class="col-sm-1 pull-right">
                        <button class="btn btn-info pull-right boxColorTema" id="limpa-form" type="button">
                            CANCELAR
                        </button>
                    </div>
                </div>                
            </div>
        </div>
    </form>
</div>

{{-- @include('usuario.partials.verendereco') --}}
{{-- @include('usuario.partials.addendereco') --}}
<!-- FINAL DIV MEU PERFIL CLIENTE  -->
@stop

@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">   
@stop

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}">
    </script>   
    <script>
        $('#password-generate').click(function() {
            axios.get('{!! route("generate-pass") !!}').then(response => {
                console.log(response.data);
                var temp_password = response.data.password;
                $('#inputSenha').val(temp_password);
                $('#inputConfirma').val(temp_password);
            });
        });
    </script> 
@stop
