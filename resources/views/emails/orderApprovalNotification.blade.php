@component('mail::message')

@component('mail::panel')
# Orçamento aprovado

Olá {{ $userinfo[0]->nome_completo }}

Seu orçamento foi aprovado e aguarda o pagamento para posterior envio. Abaixo segue alguns detalhes a respeito.

## Dados do Orçamento:

### Código do Orçamento: {{ $orderinfo[0]->sequencia }}

@component('mail::table')
|      Código do produto      |            Descrição           |
|:---------------------------:|:------------------------------:|
@foreach($productinfo as $produto)
| {{ $produto->codigo_produto }} |    {{ $produto->descricao }}   |
@endforeach
|   Valor total do Orçamento  | {{ $orderinfo[0]->vlr_final }} USD |
@endcomponent

Para maiores detalhes acesse sua conta e va até Meus Produtos -> aba Orçamento.

@component('mail::button', ['url' => route('login')])
ACESSAR MINHA CONTA    
@endcomponent

Caso preferir poderá pagar o valor do orçamento clicando no botão abaixo.
@component('mail::button', ['url' => route('pagamento-invoice', $orderinfo[0]->sequencia)])
EFETUAR PAGAMENTO
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent