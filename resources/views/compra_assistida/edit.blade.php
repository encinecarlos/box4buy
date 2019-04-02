@if(Auth::user()->type_user == '2')
    @extends('base.usuario-base')
@else
    @extends('base.base')
@endif

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4><i class="fa fa-edit"></i> Editar Compra Assistida</h4>
            <div class="box-tools">
                <a href="{{ url()->route('compra.main') }}"><i class="fa fa-chevron-left"></i> Voltar</a>
            </div>

            <div class="box-body">
                <div class="row">
                    <p><b>Cliente:</b> {{ Auth::user()->nome_completo }}</p>
                    <p><b>Data/Hora:</b> {{ date('d/m/Y H:i:s') }}</p>
                </div>
                @if(Auth::user()->type_user == '2')
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Valor</th>
                                    <th>Qtde</th>
                                    <th>Cor</th>
                                    <th>Tamanho</th>
                                    <th>Observações</th>
                                    <th>Impostos</th>
                                    <th>Subtotal</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            @foreach($solicitacao->produtos as $produto)
                                <tr>
                                    <td><a href="{{ $produto->link_produto }}" target="_blank">{{ $produto->link_produto }}</a></td>
                                    <td>{{ $produto->preco }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->cor }}</td>
                                    <td>{{ $produto->tamanho }}</td>
                                    <td>{{ $produto->obervacoes }}</td>
                                    <td></td>
                                    <td>{{ $produto->preco * $produto->quantidade }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
