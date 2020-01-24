<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Box4Buy - Login</title>
</head>
<body>

<section id="form" class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 left-form">
            <div class="btn-container">
                <a href="{{ route('site') }}" class="btn btn-transparent">Voltar para o site</a>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6 right-form">
            @if(session('login-err'))
                <div class="bg-danger text-white text-center">
                    {{ session('login-err') }}
                </div>
            @endif
            @if(session('reset-msg'))
                <div class="bg-green text-white text-center">
                    {{ session('reset-msg') }}
                </div>
            @endif

            <div class="form-container">
                <div class="img-custom">
                    <img src="{{ asset('img/login/logo.png') }}" alt="">
                </div>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="email" class="form-control form-control-lg custom-control" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-lg custom-control" placeholder="Senha">
                    </div>
                    <div class="form-group">
                        <a href="#resetsenha" class="btn btn-link btn-reset" rel="modal:open">Recuperar senha</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-rounded btn-login btn-block btn-lg">ACESSAR</button>
                    </div>
                    <div class="form-group">
                        <div class="text-divider">
                            Ainda não tem conta?
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-rounded btn-login btn-block btn-lg" href="#form-cadastro" rel="modal:open">CADASTRE-SE</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('usuario.partials.reset')
@include('usuario.partials.create-user')


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('bower_components/jquery-modal/jquery.modal.css') }}">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
<script src="{{ asset('bower_components/jquery-modal/jquery.modal.js') }}"></script>
<script src="{{ asset('bower_components/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
{{--MaskMoney--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
