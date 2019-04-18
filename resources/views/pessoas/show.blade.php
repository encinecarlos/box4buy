@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-user">
                </i>
                CB{{ $pessoa->codigo_suite }} - {{ $pessoa->nome_completo }}
            </h3>
        </div>
        <div class="box-content">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a aria-expanded="true" data-toggle="tab" href="#perfil">
                            Dados do cliente
                        </a>
                    </li>
                    <li>
                        <a aria-expanded="false" data-toggle="tab" href="#estoque">
                            Estoque
                        </a>
                    </li>
                    <li>
                        <a href="#documentos" aria-expanded="false" data-toggle="tab">Documentos</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="perfil">
                        <form class="form-horizontal form-ajax" id="form-dados" method="post">
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group notMarging">
                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputNome">
                                            Nome
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="inputNome" name="_nome"
                                                   placeholder="Primeiro nome"
                                                   type="text" value="{{ $pessoa->nome_completo }}">
                                        </div>

                                        <label class="col-sm-1 control-label">Sobrenome</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="inputNome" name="_sobrenome"
                                                   placeholder="Ultimo nome"
                                                   type="text" value="{{ $pessoa->sobrenome }}">
                                        </div>

                                    </div>
                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputDataNascimento">
                                            Data Nascimento
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control pull-right" id="datepicker"
                                                   name="data_nascimento" placeholder="dd/mm/aaaa" type="date"
                                                   value="{{ $pessoa->data_nascimento }}">
                                        </div>

                                        <label class="col-sm-1 control-label" for="inputSexo">
                                            Sexo
                                        </label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="inputSexo" name="sexo">
                                                <option value="1" {{ $pessoa->sexo == 1 ? 'selected' : '' }}>Masculino</option>
                                                <option value="2" {{ $pessoa->sexo == 2 ? 'selected' : '' }}>Feminino</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputEmail">
                                            Email
                                        </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputEmail" name="email" placeholder="Email"
                                                   type="email" value="{{ $pessoa->email }}">

                                        </div>
                                    </div>

                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputCPF">
                                            CPF
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="inputCPF" name="cpf_cnpj" placeholder="CPF"
                                                   type="text" value="{{ $pessoa->cpf_cnpj }}">

                                        </div>
                                        <label class="col-sm-1 control-label" for="inputCPF">
                                            RG
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="inputCPF" name="rg_ie" placeholder="RG"
                                                   type="text" value="{{ $pessoa->rg_ie }}">

                                        </div>
                                    </div>
                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputTelefone">
                                            Telefone
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" data-inputmask='"mask": "(99) 999-9999"'
                                                   data-mask="" name="telefone" placeholder="Telefone 01" type="text"
                                                   value="{{ $contato[0]['telefone'] != '' ? $contato[0]['telefone'] : '' }}">
                                        </div>
                                        <label class="col-sm-1 control-label" for="inputTelefone">
                                            Telefone 02
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" data-inputmask='"mask": "(99) 999-9999"'
                                                   data-mask="" name="telefone_01" placeholder="Telefone 02" type="text"
                                                   value="{{ $contato[0]['telefone_01'] }}">

                                        </div>
                                    </div>
                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputCelular">
                                            Celular
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"'
                                                   data-mask="" name="celular" placeholder="Celular 01" type="text"
                                                   value="{{ $contato[0]['celular'] != '' ? $contato[0]['celular'] : '' }}">

                                        </div>
                                        <label class="col-sm-1 control-label" for="inputCelular">
                                            Celular 02
                                        </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"'
                                                   data-mask="" name="celular_01" placeholder="Celular 02" type="text"
                                                   value="{{ $contato[0]['celular_01'] != '' ? $contato[0]['celular_01'] : '' }}">

                                        </div>
                                    </div>
                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputEstadoCivil">
                                            Estado Civil
                                        </label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="estado_civil">
                                                @foreach($estado_civil as $estadocivil)
                                                    <option value="{{ $estadocivil->sequencia }}" {{ $estadocivil->sequencia == $pessoa->estado_civil ? "selected" : "" }}>
                                                        {{ $estadocivil->descricao }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>

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
                                                @foreach($pessoa_endereco as $endereco)
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

                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputAdicionaEdereco">
                                            Adicionar endereço
                                        </label>
                                        <div class="col-sm-4">
                                            <a href="#modalAddEndereco" rel="modal:open"
                                               data-method="add"
                                               class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-plus"></i> Adicionar Endereço</a>
                                        </div>
                                        <label class="col-sm-2 control-label" for="inputAdicionaEdereco">
                                            Editar endereço
                                        </label>
                                        <div class="col-sm-4">
                                            <a href="#modalEndereco" rel="modal:open" data-method="edit"
                                               class="btn btn-info btn-rounded boxColorTema"><i class="fa fa-edit"></i> Editar Endereço</a>
                                        </div>
                                    </div>
                                    <div class="form-group notMarging">
                                        <label class="col-sm-2 control-label" for="inputValida">
                                            Alterar Senha:
                                        </label>
                                        <div class="col-sm-2">
                                            <input class="form-control" id="inputValida" name="nova_senha"
                                                   placeholder="Nova Senha" type="text">
                                        </div>
                                        <label class="col-sm-2 control-label" for="inputValida">
                                            Confirmar Nova Senha:
                                        </label>
                                        <div class="col-sm-2">
                                            <input class="form-control" id="inputValida" name="confirma_nova_senha"
                                                   placeholder="Confirmar Senha" type="text">
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-sm-1 pull-right">
                                            <button class="btn btn-info pull-right btn-rounded boxColorTema"
                                                    id="send"
                                                    type="submit">
                                                <i class="fa fa-pencil"></i>
                                                ALTERAR
                                            </button>
                                        </div>
                                        <div class="col-sm-1 pull-right">
                                            <button class="btn btn-danger btn-rounded pull-right">
                                                <i class="fa fa-close"></i>
                                                CANCELAR
                                            </button>
                                        </div>
                                    </div>
                                    <!-- MODAL -->
                                </div>
                            </div>
                        </form>{{-- Fim formulario de cadastr/visualização --}}
                        @include('pessoas.partials.verendereco')
                        @include('pessoas.partials.addendereco')
                    </div>

                    <div class="tab-pane" id="estoque">
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Dias no estoque</th>
                            <th>Ações</th>
                            </thead>
                            <tbody>
                            @foreach($estoque as $e)
                                <tr>
                                    <td>{{ $e->seq_produto }}</td>
                                    <td>{{ $e->descricao_produto }}</td>
                                    <td>{{ $e->data_chegada != '' ? $e->data_chegada->diffInDays() : '' }}</td>

                                    <td>
                                        <a href="{{ route('edit-produto', [$e->codigo_suite, $e->seq_produto]) }}"
                                           class="btn btn-info boxColorTema btn-rounded"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="documentos">
                        <div class="row">
                            @if($documentos[0]->caminho_rg == null && $documentos[0]->caminho_comprovante == null)
                                <div class="col-sm-12">
                                    <p class="alert alert-warning text-uppercase text-center">nenhum documento
                                        enviado!</p>
                                </div>
                            @else
                                @foreach ($documentos as $documento)
                                    <div class="col-sm-6">
                                        <img class="img-responsive img-thumbnail" src="{{ $documento->caminho_rg }}"
                                             alt="Documento de identificação">
                                        <button class="btn btn-danger removedoc" data-documento="rg"
                                                onclick="removedocumento({{ $pessoa->codigo_suite }})"><i
                                                    class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img class="img-responsive img-thumbnail"
                                             src="{{ $documento->caminho_comprovante }}"
                                             alt="Comprovante de residencia">
                                        <button class="btn btn-danger btn-rounded removedoc" data-documento="comprovante"
                                                onclick="removedocumento({{ $pessoa->codigo_suite }})"><i
                                                    class="fa fa-trash"></i></button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success btn-rounded enablepayment"
                                        id="{{ $pessoa->codigo_suite }}"><i class="fa fa-check"></i> Liberar
                                </button>
                                <button type="button" class="btn btn-danger btn-rounded disablepayment"
                                        id="{{ $pessoa->codigo_suite }}" 8><i class="fa fa-check"></i> Bloquear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
