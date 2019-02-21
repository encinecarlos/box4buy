@component('mail::message')

@component('mail::panel')
# Novo chamado de Suporte Aberto

Olá, {{ $userdata[0]->nome_completo }}
Obrigado por entrar em contato com nossa equipe de suporte. Um ticket de suporte já foi aberto para a sua solicitação. Você será notificado por e-mail quando enviarmos uma resposta.

@component('mail::button', ['url' => route('tickets')])
Ver Tickets
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent