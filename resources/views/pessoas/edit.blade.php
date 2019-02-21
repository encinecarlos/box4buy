@extends('base.base') @section('content')
<section id="pessoas_main">
    <div class="box box-info">
        <div class="box-header">
            <h1>Editar cliente</h1>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" action="#" method="post" id="form-add-cliente">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputNome" class="col-sm-2 control-label">Nome Completo
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputnomeCompleto" name="nome" value="Nome" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDataNascimento" class="col-sm-2 control-label">Data Nascimento
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="date" class="form-control pull-right" id="datepicker" name="data" value="Data" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" name="email" value="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCPF" class="col-sm-2 control-label">CPF
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputCPF" name="cpf" value="cpf" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputRG" class="col-sm-2 control-label">RG
                                    <sup>*</sup>
                                </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rg" name="rg" value="rg" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSexo" class="col-sm-2 control-label">Sexo
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSexo" name="sexo" value="sexo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTelefone" class="col-sm-2 control-label">Telefone 1</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telefone1" value="telefone1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputTelefone" class="col-sm-2 control-label">Telefone 2</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telefone2" value="telefone 2">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputCelular" class="col-sm-2 control-label">Celular
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="celular" value="celular" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEstadoCivil" class="col-sm-2 control-label">Estado Civil
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEstadoCivil" name="civil" value="estado civil" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEndereco" class="col-sm-2 control-label">Endereço
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEndereco" name="endereco" value="endereco" required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="inputNumero" name="numero" placeholder="Número" value="numero" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBairro" class="col-sm-2 control-label">Bairro
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputBairro" name="bairro" value="bairro" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputCidade" name="cidade" placeholder="Cidade" value="cidade" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEstado" class="col-sm-2 control-label">Estado
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputBairro" name="estado" value="estado" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputComplemento" placeholder="Complemento" name="complemento" value="complemento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPaís" class="col-sm-2 control-label">Pais
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputPais" name="pais" value="pais" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputCEP" placeholder="CEP" name="cep" value="cep" required>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{url('/pessoas')}}" class="btn btn-default">CANCELAR</a>
                            <button type="submit" class="btn btn-info pull-right">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop