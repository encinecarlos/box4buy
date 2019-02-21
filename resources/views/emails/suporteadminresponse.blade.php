@component('mail::message')

@component('mail::panel')
# Nova resposta ao chamado BXB_{{ $ticket_support }}

Olá Administrador
Há uma nova resposta para o chamado BXB_{{ $ticket_support }}.

Para maiores detalhes verifique no link abaixo:

@component('mail::button', ['url' => route('ticketadminshow', $ticket_support)])
Ver Ticket
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent