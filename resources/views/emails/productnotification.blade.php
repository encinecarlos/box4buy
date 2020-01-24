@component('mail::message')

@component('mail::panel')
# Novo Produto enviado

Olá 
Um Novo produto foi enviado para a Box4buy.

Dados do produto:

@component('mail::table')
|     Suite    	|        Descrição        	|        Quantidade        	|
|:------------:	|:-----------------------:	|:------------------------:	|
| {{ $suite }} 	| {{ $produtodescricao }} 	| {{ $produtoquantidade }} 	|
@endcomponent

Para maiores detalhes acesse o painel administrativo
{{-- @component('mail::button', ['url' => route('pessoas-show', $suite)])
Ver Detalhes
@endcomponent --}}

Atensiosamente <br>Equipe Box4Buy
@endcomponent {{-- fim panel --}}

*E-mail não monitorado, favor não responder esta mensagem.*

@endcomponent