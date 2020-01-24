@component('mail::message')

@component('mail::panel')
# Seja Bem Vindo

Olá {{ $pessoaData['_nome'] }}

Sua nova conta no site [box4buy.com](http://box4buy.com).
Abaixo seguem algumas informações importantes sobre sua conta.

### Dados de acesso ao sistema:

@component('mail::table')
|   Código Suite   |         {{ $suite }}           |
|:----------------:|:------------------------------:|
| Painel de Acesso |    https://box4buy.com/login   |
| E-mail de Acesso |   {{ $pessoaData['email'] }}   |
| Senha de Acesso  | {{ $pessoaData['password'] }}  |
@endcomponent


<b>*Guarde este código, pois ele é a sua identificação dentro do sistema</b>

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent