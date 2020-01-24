@component('mail::message')

@component('mail::panel')
@if($status == '10')
Uma nova Solicitação de compra assistida foi criada com os seguintes detalhes:
@else
O status da sua solicitação acaba de ser alterado:
@endif

@if($status == '10')
@component('mail::table')
| ID          | Status        | Observações          |
|:-----------:|:-------------:|:--------------------:|
| {{ $id }}   | Processando   | {{ $observacoes }}   |
@endcomponent
@elseif($status == '11')
@component('mail::table')
| ID          | Status        |
|:-----------:|:-------------:|
|  {{ $id }}  |  Respondido   |
@endcomponent
@elseif($status == '12')
@component('mail::table')
| ID          | Status        |
|:-----------:|:-------------:|
| {{ $id }}   | Concluído     |
@endcomponent
@endif

Atensiosamente

Equipe Box4Buy
@endcomponent

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent
