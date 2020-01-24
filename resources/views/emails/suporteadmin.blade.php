@component('mail::message')

@component('mail::panel')
Você acaba de receber um novo chamado de suporte aberto por um de seus clientes. Para maiores informações visite o painel administrativo clicando no link abaixo.

@component('mail::button', ['url' => route('ticketadminshow', $ticketdata[0]->ticket_id)])
Ver Ticket
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent 