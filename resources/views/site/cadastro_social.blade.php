<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
    <title>Box4Buy - Cadastre-se</title>
</head>
<body class="bg-cadastro">
    <section>
        <div class="container">
            <div class="row mt-3 text-center">
                <div class="col-sm-12">
                    <img src="{{ asset('img/logo-s.png') }}" width="200px" height="44px" alt="">
                </div>
            </div>
            <div class="row mt-lg-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-title text-center mt-3">
                            <h4>CADASTRE-SE</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal form-ajax noenter" id="form-cadastro" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <div class="alert alert-danger alert-errors" >
                                    <ul id="list-error" style="list-style-type: none">
                                    </ul>
                                </div>
                                <!-- <input type="hidden" name="nome"> -->
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input type="text" name="_nome" class="form-control" autofocus>
                                </div>

                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Data de Nascimento:</label>
                                            {{-- <input type="text" data-inputmask="'mask':'99/99/9999'" name="data_nascimento" class="form-control"> --}}
                                            <input type="tex" name="data_nascimento" class="form-control date">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Telefone:</label>
                                            <input type="text" name="celular" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Endereço:</label>
                                    <input type="text" name="endereco" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Número:</label>
                                            <input type="number" name="numero" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Bairro:</label>
                                            <input type="text" name="bairro" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Complemento:</label>
                                    <input type="text" name="complemento" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>CEP:</label>
                                            <input type="text" name="cep" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cidade:</label>
                                            <input type="text" name="cidade" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Estado:</label>
                                            <select class="form-control" name="uf">
                                                <option value="">Escolher</option>
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
                                </div>

                                <div class="form-group">
                                    <label>País:</label>
                                    <select name="pais" class="form-control">
                                        <option value="BR">Brasil</option>
                                        <option value="US">Estados Unidos</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Onde nos conheceu?</label>
                                    <input type="text" name="ondeconheceu" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <div class="div-senha">
                                                <input type="password" class="form-control" id="senha" name="password"/>
                                                <i class="fa fa-eye" id="ver" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Confirmar senha</label>
                                            <input type="password" id="confirm-senha" name="confirm-password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" id="send-cadastro" class="btn btn-success btn-box4buy">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="{{ asset('bower_components/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src="{{ asset('bower_components/toastr/toastr.js') }}"></script>
    <script src="{{ asset('js/cadastro.js') }}"></script>
</body>
</html>