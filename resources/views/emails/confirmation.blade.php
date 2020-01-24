@component('mail::message')

@component('mail::panel')
# Seja Bem Vindo

Olá 

Você esta recebendo este E-mail, pois cadastrou-se no site [box4buy.com](http://box4buy.com).
Abaixo seguem algumas informações importantes sobre sua conta.

### Dados de acesso ao sistema:

@component('mail::table')
|   Código Suite   |       CB#{{ $suite }}       |
|:----------------:|:---------------------------:|
| Acesso ao painel |   http://box4buy.com/login  |
| E-mail de Acesso |         {{ $email }}        |
| Senha            | Senha cadastrada na Box4Buy |
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent