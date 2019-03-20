@component('mail::message')

@component('mail::panel')
# STATUS DO SEU PRODUTO

Olá {{ $customer_name }}

O status do seu produto foi alterado. Confira abaixo informações mais detalhadas a respeito.


@switch($product_status)
@case('2')
## STATUS: NO ESTOQUE
@break
@case('3')
## STATUS: EM ORÇAMENTO
@break
@case('4')
## STATUS: ENVIADO PARA O CLIENTE
@break
@endswitch


### INFORMAÇÕES SOBRE O PRODUTO

@component('mail::table')
|   Código do produto   |   {{ $product[0]->seq_produto }}         |
|:---------------------:|:----------------------------------------:|
| Descrição do produto  |   {{ $product[0]->descricao_produto }}   |
@endcomponent

Atensiosamente.

Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent