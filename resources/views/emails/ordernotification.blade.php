@component('mail::message')

@component('mail::panel')
# Novo Orçamento enviado

Olá 

Um novo orçamento foi solicitado. Abaixo segue alguns detalhes a respeito.

### Dados do Orçamento:

@component('mail::table')
|      Suite      |  Código do Orçamento |
|:---------------:|:--------------------:|
| CB#{{ $suite }} | {{ $cod_orcamento }} |
@endcomponent

Para maiores detalhes acesse o painel administrativo.
@component('mail::button', ['url' => route('orcamento')])
Acessar painel Administrativo
@endcomponent

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent