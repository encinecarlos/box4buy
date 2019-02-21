@component('mail::message')

@component('mail::panel')
# Novo chamado de Suporte Aberto

Olá 
Há uma nova resposta para o seu chamado código BXB_{{ $ticket_support }}.

Para maiores detalhes verifique no link abaixo:

@component('mail::button', ['url' => route('ticketshow', $ticket_support)])
Ver Ticket
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent