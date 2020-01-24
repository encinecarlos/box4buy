<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/jquery-modal/jquery.modal.css') }}">
    <!-- toastrjs CSS -->
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>BOX4BUY - Login</title>
</head>

<body class="site">
<div class="line-top"></div>
@if(session('login-err'))
    <div class="alert alert-danger text-center">
        {{ session('login-err') }}
    </div>
@endif
@if(session('reset-msg'))
    <div class="alert alert-success text-center">
        {{ session('reset-msg') }}
    </div>
@endif
<section id="form-login" class="container site-content">
    <div class="form-container" id="form">
        <div class="row">
            <div class="col-2 mx-auto">
                <img src="http://betateste.carlosencine.com/img/logo-s.png" class="img-fluid" alt="BOX4BUY">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 mx-auto">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <b>Bem Vindo</b>
                        </div>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                    </div>
                                    <input type="text" placeholder="E-mail" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password" placeholder="Senha" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-sign-in"></i> ENTRAR
                                </button>
                            </div>

                            <div class="row mb-3 text-center">
                                <div class="col-sm-6"><a href="#resetsenha" class="btn btn-link" rel="modal:open">Esqueci minha senha</a></div>
                                <div class="col-sm-6"><a href="/" class="btn btn-link">Voltar para o site</a></div>

                            </div>

                            <div class="row">
                                <p class="mx-auto m-0"><b>OU</b></p>
                            </div>

                            <div class="row mt-3">
                                <a href="#form-cadastro" rel="modal:open" class="btn btn-primary btn-block">
                                    <i class="fa fa-user-plus"></i> CADASTRAR-SE</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="modal custom-modal" id="resetsenha">
    <div class="bxb-header">
        <h4 class="text-center">REDEFINIÇÃO DE SENHA</h4>
        <a href="#" rel="modal:close" class="close"><i class="fa fa-close"></i></a>
    </div>
    <form id="reset-form" action="{{ route('send-reset') }}">
        <label for="email-esqueci">E-mail</label>
        <input id="esqueci_email" name="email-esqueci" class="form-control" type="email" required>
        <div class="form-group">
            <input type="submit" value="PROSSEGUIR" class="btn btn-primary">
        </div>
    </form>
</div>

<div class="modal custom-modal" id="form-cadastro">
    <div class="bxb-header">
        <h4 class="text-center">CRIE SUA CONTA</h4>
        <a href="#" rel="modal:close" class="close"><i class="fa fa-close"></i></a>
    </div>
    @include('site.partials.cadastro')

</div>

<section id="footer">
    <footer class="custom-footer">
        <div class="text-center">
            <span class="align-middle">Desenvolvido por DevHouse Solutions</span>
        </div>
    </footer>
</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<!-- toastrjs -->
<script src="{{ asset('bower_components/toastr/toastr.js') }}"></script>
<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
<script src="{{ asset('bower_components/jquery-modal/jquery.modal.js') }}"></script>
{{-- InputMask --}}
<script src="{{ asset('bower_components/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
{{--MaskMoney--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<!-- Arquivo js customozado da aplicação -->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
