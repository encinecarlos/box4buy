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
                <div class="form-group notMarging" style="display: {{ $enable_pay[0]->libera_pagamento == '1' ? 'none' : 'block'}}">
                    <div class="col-sm-6 col-sm-offset-2">
                        <a class="btn boxColorTema" href="#upload-modal" rel="modal:open" id="inputValida">
                            <i class="fa fa-check">
                            </i>
                            VALIDAR CONTA
                        </a>
                    </div>
                    @include('usuario.partials.docModal')
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label">
                        Foto de Perfil
                    </label>
                    <div class="col-sm-4">
                        <a href="#modalFotoPerfil" class="btn boxColorTema" rel="modal:open" id="add-fotoperfil">
                            Adicionar foto de perfil
                        </a>
                    </div>                    
                    <div class="modal custom-modal" id="modalFotoPerfil">
                        <div class="box box-info">
                            <div class="box-header">
                                <h4>INSERIR FOTO DE PERFIL</h4>
                                <div class="box-tools">
                                    <a href="#" class="close" rel="modal:close"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="dropzone custom-dropzone" id="fotoperfil"></div>
                            </div>
                        </div>                                                
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputNome">
                        Nome
                    </label>
                    <div class="col-sm-6">
                        <input class="form-control" id="inputNome" name="_nome" placeholder="Nome" type="text" value="{{ $perfil->nome_completo }}">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputSexo">
                        Sexo
                    </label>
                    <div class="col-sm-2">
                        <select class="form-control" id="inputSexo" name="sexo">
                            @if($perfil->sexo == 1)
                            <option selected="" value="1">
                                Masculino
                            </option>
                            <option value="2">
                                Feminino
                            </option>
                            @elseif($perfil->sexo == 2)
                            <option value="1">
                                Masculino
                            </option>
                            <option selected="" value="2">
                                Feminino
                            </option>
                            @else
                            <option value="1">
                                Masculino
                            </option>
                            <option value="2">
                                Feminino
                            </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputDataNascimento">
                        Data Nascimento
                    </label>
                    <div class="col-sm-4">
                        <!--<input class="form-control pull-right" id="datepicker" data-inputmask="mask: 99/99/9999" name="data_nascimento" placeholder="dd/mm/aaaa" type="text" value="{{ date('d/m/Y', strtotime($perfil->data_nascimento)) }}">-->
                        {{-- <input type="text" data-inputmask="'mask':'99/99/9999'" name="data_nascimento" class="form-control pull-right" value="{{ date('Y-m-d', strtotime($perfil->data_nascimento)) }}"> --}}
                        <input class="form-control pull-right" type="date" name="data_nascimento" id="datepicker" value="{{ date('Y-m-d', strtotime($perfil->data_nascimento)) }}">
                    </div>
                    <label class="col-sm-1 control-label" for="inputEmail">
                        Email
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputEmail" name="email" placeholder="Email" type="email" value="{{ $perfil->email }}">
                        
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputCPF">
                        CPF
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputCPF" name="cpf_cnpj" placeholder="CPF" type="text" value="{{ $perfil->cpf_cnpj }}">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputCPF">
                        RG
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputCPF" name="rg_ie" placeholder="RG" type="text" value="{{ $perfil->rg_ie }}">
                        
                    </div>
                </div>                
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputTelefone">
                        Telefone
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 999-9999"' data-mask="" name="telefone" placeholder="Telefone 01" type="text" value="{{ $contato[0]['telefone'] != '' ? $contato[0]['telefone'] : '' }}">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputTelefone">
                        Telefone 02
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 999-9999"' data-mask="" name="telefone_01" placeholder="Telefone 02" type="text" value="{{ $contato[0]['telefone_01'] != '' ? $contato[0]['telefone_01'] : '' }}">
                        
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputCelular">
                        Celular
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask="" name="celular" placeholder="Celular 01" type="text" value="{{ $contato[0]['celular'] != '' ? $contato[0]['celular'] : '' }}">
                        
                    </div>
                    <label class="col-sm-1 control-label" for="inputCelular">
                        Celular 02
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask="" name="celular_01" placeholder="Celular 02" type="text" value="{{ $contato[0]['celular_01'] != '' ? $contato[0]['celular_01'] : '' }}">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputEstadoCivil">
                        Estado Civil
                    </label>
                    <div class="col-sm-9">
                        <select class="form-control" name="estado_civil">
                            @foreach($estado_civil as $estadocivil)
                            <option value="{{ $estadocivil->sequencia }}" {{  $estadocivil->sequencia == $perfil->estado_civil ? "selected" : "" }}>{{ $estadocivil->descricao }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputAdicionaEdereco">
                        Adicionar endereço
                    </label>
                    <div class="col-sm-4">
                        <a href="#modalAddEndereco" class="btn btn-info boxColorTema" data-method="add" rel="modal:open" id="add-alternativo">
                            Adicionar novo endereço
                        </a>
                    </div>
                    <label class="col-sm-2 control-label" for="inputAdicionaEdereco">
                        Editar endereço
                    </label>
                    <div class="col-sm-4">
                        <a href="#modalEndereco" class="btn btn-info boxColorTema" data-method="edit" rel="modal:open" id="edit-alternativo">
                            Editar endereço
                        </a>
                    </div>
					
                </div>
                <div class="form-group notMarging">
                    <label class="col-sm-2 control-label" for="inputValida">
                        Alterar Senha:
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputValida" name="nova_senha" placeholder="Nova Senha" type="text">
                    </div>
                    <label class="col-sm-2 control-label" for="inputValida">
                        Confirmar Nova Senha:
                    </label>
                    <div class="col-sm-4">
                        <input class="form-control" id="inputValida" name="confirma_nova_senha" placeholder="Confirmar Senha" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-1 pull-right">
                        <button class="btn btn-info pull-right boxColorTema" id="send" type="submit">
                            ALTERAR
                        </button>
                    </div>
                    <div class="col-sm-1 pull-right">
                        <a href="{{ route('perfil', $perfil->codigo_suite) }}" class="btn btn-info pull-right boxColorTema">
                            CANCELAR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="tpl">
    <div class="dz-preview dz-file-preview">        
        <div class="dz-details">
            <div class="row">
                <div class="col-sm-12">
                    <img data-dz-thumbnail />
                </div>                
            </div>                                    
        </div>                      
    </div>
</div>


@include('usuario.partials.verendereco')
@include('usuario.partials.addendereco')
<!-- FINAL DIV MEU PERFIL CLIENTE  -->
@stop

@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $.modal.defaults = {
            fadeDuration: 200,
            clickClose: true,
            escapeClose: true
        }

        var template = $('#tpl').html();
        var myDropzone = new Dropzone('#fotoperfil', {
            url: "/api/upload",
            previewTemplate: template,
            dictDefaultMessage: "<i class='fa fa-photo'></i> Insira a foto do perfil"
        });

        myDropzone.on('sending', function (file, xhr, formData) {
            // let id = location.href.split('/').pop();
            formData.append("id", $('#suite').val());
        });

        myDropzone.on('success', function () {
            toastr.success("Foto inserida com sucesso!");
            $.modal.close();
            setTimeout(function () {
                $('#foto_perfil').load(window.location.href + " #foto_perfil");
            }, 1500);
        });
    </script>
    {{-- <script src="{{ asset('js/upload.js') }}"></script> --}}
@stop
