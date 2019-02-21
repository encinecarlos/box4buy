{{-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Box4Buy -Redefinir Senha </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
	<link rel="stylesheet" href=" " >
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

		.colorText {
			 color: #2095f4;
		}

    </style>
</head>
<body class="colorUfaBG">
    <div class="section"></div>
    <main>
        <center>
		<div class="col-sm-4 col-sm-offset-2">
			<br>
			<br>
            <img class="responsive-img imgResp" src="https://www.box4buy.com/img/logo-s.png" />
		</div>
			<br>
			<br>
			<br>
            <h6 class="colorText">Redifinir sua senha Box4Buy</h6><br />
            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block;
                     padding: 32px 48px 0px 48px;
                     border: 1px solid #EEE;">
                    <div class="col s12">
                        
                        <br />
                        <center>
                            <div class='row'>
                                <a href="{{ route('view-reset', ['token' => $token, 'id' => $id]) }}" type='submit' class='col s12 btn btn-large waves-effect buttonColor'>REDEFINIR SENHA</a>
                            </div>
							<br>
							<br>
							<div class='row'>
                            <div class='col s12'>
								<label for='novaSenha'>Voc� ser� direcionado para redifinir sua senha, se por acaso n�o solicitou, por favor desconsidere esse e-mail</label>
								<br>
								<label><a href="https://devhousesolutions.com.br/">Equipe DevHouse Solutions</a></label>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
        </center>
    </main>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>
</html>







 --}}

 @component('mail::message')

@component('mail::panel')
# Redefinição de senha de acesso

Olá 

Você solicitou a redefinição de senha da sua conta Box4buy. Para redefinir-la clique no link abaixo.

@component('mail::button', ['url' => route('view-reset', ['token' => $token, 'id' => $id])])
REDEFINIR MINHA SENHA
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

* *E-mail não monitorado, favor não responder esta mensagem.*

* **Caso não tenha solicitado ou não seja você o titular da conta favor desconsiderar esta mensagem.*

@endcomponent
