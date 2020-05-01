<div class="modal custom-modal" id="verificadados">
    <div class="box box-info">
        <div class="box-header">
            <h4 class="text-center">ENVIAR ORÇAMENTO</h4>
            <div class="box-tools">
                <a href="#" class="close" rel="modal:close"><i class="fa fa-close"></i></a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <h4><b>PRODUTOS</b></h4>
            </div>
            <div class="row">
                <table id="tb_produtos" class="table table-bordered table-hover">
                    <thead>
                        <tr>											
                            <th>Cód. Produto</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>												
                            <th>Peso</th>
                            <th>Valor Declarado</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @if(Session::has('produtos'))
                            @foreach(session('produtos') as $es => $value)
                                <tr>													
                                    <td class="col-sm-1">{{ $value['id'] }}</td>
                                    <td>{{ $value['descricao'] }}</td>
                                    <td class="col-sm-1">{{ $value['qtde'] }}</td>														
                                    <td class="col-sm-1" id="peso_valor">{{ $value['peso'] != '' ? $value['peso'] : '0' }}</td>
                                    <td id="ver_valor_declarado" class="valor-{{ $es }}"></td>                                    
                                </tr>										
                            @endforeach
                        @else
                            <p class="alert alert-warning text-center">NENHUM PRODUTO ADICIONADO AO CARRINHO</p>
                        @endif
                    
                    </tbody>
                </table>    
            </div>

            <div class="row">
                <h4><b>FRETE, SEGURO E VALOR DECLARADO</b></h4>
            </div>
            <div class="row">
                <table class="table">
                    <tr>
                        <th>Tipo de Frete</th>
                        <td id="ver_pacote"></td>
                    </tr>
                    <tr>
                        <th>Seguro</th>
                        <td id="ver_seguro"></td>
                    </tr>
                    <tr>
                        <th>Valor Total Declarado</th>
                        <td id="ver_total_declarado"></td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <h4><b>DADOS DE ENTREGA</b></h4>
            </div>
            <div class="row">
                <input type="hidden" name="address_id" id="address_id">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th class="col-sm-2">Nome:</th>
                        <td>{{ Auth::user()->nome_completo }}</td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">E-mail:</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">Endereço:</th>
                        <td id="newendereco"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">N°:</th>
                        <td id="newnumero"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">Bairro:</th>
                        <td id="newbairro"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">complemento:</th>
                        <td id="newcomplemento"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">CEP:</th>
                        <td id="newcep"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">Cidade:</th>
                        <td id="newcidade"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">Estado</th>
                        <td id="newestado"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">País:</th>
                        <td id="newpais"></td>
                    </tr>
                    <tr>
                        <th class="col-sm-2">Telefone:</th>
                        <td id="newtelefone">{{ Auth::user()->contatos->telefone == '' ? 'Não Informado' : Auth::user()->contatos->telefone }} / {{ Auth::user()->contatos->celular }}</td>
                    </tr>
                </table>    
            </div>
            <div class="row">
                <a href="#dados-envio"
                   class="btn btn-warning btn-rounded"
                   id="dados-entrega"
                   rel="modal:open">
                    <i class="fal fa-pencil"></i>Editar Dados de Entrega
                </a>
            </div>

            @include('usuario.partials.editperfil-orcamento')

            <div class="row">
                <h4><b>INFORMAÇÕES EXTRAS</b></h4>
            </div>
            <div class="row">
                <table class="table">
                    <tr>
                        <th class="col-sm-4">Enviar Nota Fiscal do produto?</th>
                        <td>
                            <div class="col-sm-6" id="vernf"></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-sm-4">Fechar toda a caixa com fita para ter uma proteção extra?</th>
                        <td>
                            <div class="col-sm-6" id="verfitaextra"></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-sm-4">Enviar Propaganda do produto?</th>
                        <td>
                            <div class="col-sm-6" id="verpropaganda"></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-sm-4">Envia caixas originais?</th>
                        <td>
                            <div class="col-sm-6" id="vercaixas"></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-sm-4">Descartar sacolas do produto?</th>
                        <td>
                            <div class="col-sm-6" id="versacolas"></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-sm-4">Retirar etiquetas de preço do produto?</th>
                        <td>
                            <div class="col-sm-6" id="veretiquetas"></div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <button type="button"
                        id="geraorcamento"
                        class="btn btn-info btn-lg btn-block btn-rounded boxColorTema">
                   <i class="fa fa-send"></i> Enviar Orçamento
                </button>
            </div>
        </div>
    </div>
</div>
