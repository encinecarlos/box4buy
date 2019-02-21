{{-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Box4Buy -Nova Senha </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/login.css') }}" >
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        body {
            background: white;
        }

        .input-field input[type=date]:focus + label,
        .input-field input[type=text]:focus + label,
        .input-field input[type=email]:focus + label,
        .input-field input[type=password]:focus + label {
            color: #e91e63;
        }

        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }

        .buttonColor {
            background-color: #2095f4;
        }


    </style>
</head>
<body class="colorUfaBG">
    <div class="section"></div>
    <main>
        <center>
		<div class="col-sm-4 col-sm-offset-2">
            <img class="responsive-img imgResp" src="{{ asset('img/logo-s.png') }}" />
		</div>
			<br>
            <h6 class="colorUfa">DIGITE SUA NOVA SENHA</h6><br />
            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block;
                     padding: 32px 48px 0px 48px;
                     border: 1px solid #EEE;">
                    <form class="col s12" action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}

						<input type="hidden" name="token_senha" value="{{ $token }}">
						<input type="hidden" name="id" value="{{ $userid }}">

                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type='password' name='novaSenha' id='novaSenha' />
                                <label for='novaSenha'>Nova Senha:</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12 colorUfa'>
                                <input type='password' name='novaSenhaRepet' id='novaSenhaRepet' />
                                <label for='novaSenhaRepet'>Confirma Senha:</label>
                            </div>
                        </div>
                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' class='col s12 btn btn-large waves-effect buttonColor'>SALVAR</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </center>
    </main>
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container center-align">
                Desenvolvido por <a class="white-text text-lighten-3" href="https://devhousesolutions.com.br/" target="_blank">DevHouse Solutions</a>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">    
    <!-- toastrjs CSS -->
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Box4Buy - Redefinir Senha</title>
</head>

<body class="site">
    <div class="line-top"></div>
    {{-- @if(session('login-err'))
        <div class="alert alert-danger text-center">
            {{ session('login-err') }}            
        </div> 
    @endif --}}
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
                                <b>Redefinição de Senha</b>
                            </div>

                            <form action="{{ route('post-reset') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token_senha" value="{{ $token }}">
						        <input type="hidden" name="id" value="{{ $userid }}">
                                
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" placeholder="NOVA SENHA" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                        <input type="password" name="confirm_password" placeholder="CONFIRMAR NOVA SENHA" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-sign-in"></i> REDEFINIR SENHA</button>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>        

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
    <!-- Arquivo js customozado da aplicação -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
