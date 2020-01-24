@component('mail::message')

@component('mail::panel')
Olá {{ $assistidaInfo->usuario->nome_completo }}

Este é o recibo da sua compra realizada através do site Box4buy.com. Abaixo segue os detalhes da compra

@component('mail::table')
| ID                              | Status                                                               | Valor Pago                           |
|:-------------------------------:|:--------------------------------------------------------------------:|:------------------------------------:|
| {{ $assistidaInfo->sequencia }} | <span class="badge bg-green"><i class="fa fa-check"></i> PAGO</span> | {{ $assistidaInfo->total_compra }}   |
@endcomponent


Atensiosamente

Equipe Box4Buy
@endcomponent

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent
