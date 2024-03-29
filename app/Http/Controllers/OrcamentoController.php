<?php

namespace App\Http\Controllers;

use App\Lib\ProductServices;
use App\Notifications\OrderStatusNotification;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Orcamento;
use App\OrcamentoProduto;
use Illuminate\Database\QueryException;
use App\Lib\CustomException;
use App\Mail\OrderNotification;
use App\Enderecos;
use Illuminate\Support\Facades\Notification;

class OrcamentoController extends Controller
{
    public function cartIndex()
    {
        $user_endereco = Enderecos::where('codigo_suite', Auth::user()->codigo_suite)->get();
        $total_produtos = ProductServices::totalizaProdutos();
        return view('usuario.carrinho', ['endereco' => $user_endereco, 'total' => $total_produtos]);
    }

    public function geraOrcamento(Request $request)
    {
        try {
            $cod_suite = Auth::user()->codigo_suite;
            $email = Auth::user()->email;
            if ($request->peso <= 66) {
                DB::insert("INSERT INTO bxby_orcamento (
                                codigo_suite,
                                codigo_pacote,
                                seguro,
                                cod_endereco,
                                peso_total,
                                recebe_nota,
                                preco_etiqueta,
                                recebe_propaganda,
                                caixas_originais,
                                sacolas_originais,
                                protecao_extra,
                                vlr_declarado,
                                `status`)
                           VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", [
                    $cod_suite,
                    $request->codigo_pacote,
                    $request->seguro,
                    $request->codigo_endereco,
                    $request->peso != null ? $request->peso : 0,
                    $request->envianf,
                    $request->etiquetaoriginal,
                    $request->enviapropaganda,
                    $request->caixaoriginal,
                    $request->sacolaoriginal,
                    $request->protecao_extra,
                    $request->protecao_extra,
                    4
                ]);

                $cod_orcamento = DB::getPdo()->lastInsertId();

                $produtos = $request->session()->get('produtos');

                for ($i = 0; $i < count($produtos); $i++) {
                    DB::insert("INSERT INTO bxby_orcamento_produto (codigo_produto,
                                                            descricao,
                                                            codigo_orcamento,
                                                            valor_declarado,
                                                            dias_estoque,
                                                            quantidade,
                                                            `status`)
                                                            VALUES (?,?,?,?,?,?,?)", [
                        $produtos[$i]['id'],
                        $produtos[$i]['descricao'],
                        $cod_orcamento,
                        number_format((float)$request->valor_declarado[$i], 2),
                        $produtos[$i]['dias_estoque'],
                        $produtos[$i]['qtde'] == '' ? '0' : $produtos[$i]['qtde'],
                        7
                    ]);

                }

                Mail::send(new OrderNotification($cod_suite, $email, $cod_orcamento));

                session()->forget('produtos');

                return response()->json(['msg' => 'Orçamento gerado com sucesso!', 'status' => '1']);
            } else {
                return response()->json(['msg' => 'O peso máximo permitido é de 66 Libras', 'status' => '2']);
            }
        } catch (QueryException $ex) {
            CustomException::trataErro($ex);
        }
    }


    public function index()
    {
        $orcamentos = Orcamento::all();
        $produtos = OrcamentoProduto::all();
        $aguardando = $orcamentos->filter(function ($orcamento) {
            return $orcamento->status == '4';
        });

        $aprovado = $orcamentos->filter(function ($orcamento) {
            return $orcamento->status == '5';
        });

        $pago = $orcamentos->filter(function ($orcamento) {
            return $orcamento->status == '6';
        });

//        $enviado = $orcamentos->orcamento_produtos;

        return view('orcamento.main', [
            'aguardando' => $aguardando,
            'aprovado' => $aprovado,
            'pago' => $pago,
            'produtos' => $produtos,
        ]);
    }

    public function orcamentoDetalhe($id_produto)
    {
        $produtos = DB::select("select * from bxby_orcamento_produto where codigo_orcamento = $id_produto");
        return view('orcamento.orcamento-detalhe', ['produtos' => $produtos]);
    }

    public function orcamentoDetalheUsuario($id_produto)
    {
        $produtos = DB::select("select * from bxby_orcamento_produto where codigo_orcamento = $id_produto");
        return view('usuario.orcamento-detalhe', ['produtos' => $produtos]);
    }

    public function add()
    {
        return view('orcamento.add');
    }

    public function show($id)
    {
        //$orcamento = Orcamento::find($id);
        return view('orcamento.show');
    }

    public function edit($id)
    {
        $orcamento = DB::table("bxby_orcamento")->where('sequencia', $id)->get();
        $orcamentoStatus = DB::table("bxby_status")->where('categoria', 'orcamento')->get();
        $dadosUsuario = DB::table('bxby_pessoas')->where('codigo_suite', $orcamento[0]->codigo_suite)->get();
        $dadosUsuarioEndereco = DB::table('bxby_pendereco')->where(['codigo_suite' => $orcamento[0]->codigo_suite, 'seq_endereco' => $orcamento[0]->cod_endereco])->get();
        $dadosUsuarioContato = DB::table('bxby_pcontato')->select('telefone', 'celular')->where('codigo_suite', $orcamento[0]->codigo_suite)->get();
        $produtos = OrcamentoProduto::where('codigo_orcamento', $id)->get();

        return view('orcamento.edit', [
            'orcamento' => $orcamento,
            'produtos' => $produtos,
            'orcamentoStatus' => $orcamentoStatus,
            'dadosUsuario' => $dadosUsuario,
            'dadosUsuarioEndereco' => $dadosUsuarioEndereco,
            'dadosUsuarioContato' => $dadosUsuarioContato]);
    }

    public function editUsuario($id)
    {
        $orcamento = DB::table("bxby_orcamento")->where('sequencia', $id)->get();
        $orcamentoStatus = DB::table("bxby_status")->where('categoria', 'orcamento')->get();
        $produtos = DB::table("bxby_orcamento_produto")->where('codigo_orcamento', $id)->get();
        return view('usuario.orcamento-edit', ['orcamento' => $orcamento, 'produtos' => $produtos, 'orcamentoStatus' => $orcamentoStatus]);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'codigo_pacote' => $request->pacote,
            'cod_rastreio' => $request->codigorastreio,
            'peso_embalado' => $request->pesocaixa,
            'seguro' => $request->seguro2,
            'recebe_nota' => $request->envianf,
            'preco_etiqueta' => $request->etiquetaoriginal,
            'recebe_propaganda' => $request->enviapropaganda,
            'caixas_originais' => $request->caixaoriginal,
            'sacolas_originais' => $request->sacolaoriginal,
            'vlr_entrega' => $request->valorentrega != '' ? str_replace(',', '.', $request->valorentrega) : '0.00',
            'vlr_seguro' => $request->valorseguro != '' ? str_replace(',', '.', $request->valorseguro) : '0.00',
            'vlr_taxa' => $request->valorbxby != '' ? str_replace(',', '.', $request->valorbxby) : '0.00',
            'vlr_subtotal' => $request->valorsubtotal != '' ? str_replace(',', '.', $request->valorsubtotal) : '0.00',
            'vlr_final' => $request->valortotal != '' ? str_replace(',', '.', $request->valortotal) : '0.00',
            'enviado' => $request->enviado,
            'data_envio' => $request->dataenvio,
            'status' => $request->statusorcamento
        ];

        if ($request->statusorcamento == '6') {
            DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $id)->update(['status' => '7']);
        }

        if ($request->enviado == '1') {
            /*$messages = [
                'codigorastreio.required' => 'Informe o código de rastreio do pacote.',
                'dataenvio.required' => 'Informe a data de envio do pacote.'
            ];
            $this->validate($request, [
                'codigorastreio' => 'required',
                'dataenvio' => 'required'
            ], $messages);*/
            $orcamentoProdutoStatus = OrcamentoProduto::where('codigo_orcamento', $id)->get();

            if ($orcamentoProdutoStatus[0]->status == 8) {
                OrcamentoProduto::where('codigo_orcamento', $id)->update([
                    'status' => '7',
                ]);
            } else {
                OrcamentoProduto::where('codigo_orcamento', $id)->update([
                    'status' => '8',
                ]);
            }

        }

        DB::table('bxby_orcamento')->where('sequencia', $id)->update($data);
        $id_user = Orcamento::select('codigo_suite')->where('sequencia', $id)->get();

        $user = Pessoa::where('codigo_suite', $id_user[0]->codigo_suite)->get();
        Notification::send($user, new OrderStatusNotification($id, $request->statusorcamento));

        return response()->json(['msg' => 'Orçamento atualizado com sucesso', 'status' => '1']);
    }

    public function mudaQuantidade(Request $request, $idproduto)
    {
        $quantidade_atual = session('produtos.' . $idproduto . '.qtde');
        $produto_id = session('produtos.' . $idproduto . '.id');
        $produto = array_search($request->produto_id, array_column(session('produtos'), 'id'));
        if($request->quantidade > $quantidade_atual)
        {
            $diff_quantidade = $request->quantidade - $quantidade_atual;
            $sql_produto_update = "UPDATE bxby_produtos_estoque SET qtde = qtde - {$diff_quantidade} WHERE seq_produto = {$produto_id}";
            DB::statement($sql_produto_update);
        } elseif ($request->quantidade < $quantidade_atual) {
            $diff_quantidade = $quantidade_atual - $request->quantidade;
            $sql_produto_update = "UPDATE bxby_produtos_estoque SET qtde = qtde + {$diff_quantidade} WHERE seq_produto = {$produto_id}";
            DB::statement($sql_produto_update);
        }

        session(['produtos.' . $idproduto . '.qtde' => $request->quantidade]);
        $produtos = session('produtos');
        return $produtos;
    }

    public function updateDeliveryData(Request $request, $id)
    {
        $auth_suite = Auth::user()->codigo_suite;
        DB::update("UPDATE bxby_pendereco 
                                SET codigo_postal = '$request->newcep',
                                    endereco = '$request->newendereco',
                                    complemento = '$request->newcomplemento',
                                    numero = '$request->newnumero',
                                    bairro = '$request->newbairro',
                                    cidade = '$request->newcidade',
                                    estado = '$request->newuf',
                                    pais = '$request->newpais'
                                WHERE seq_endereco = $id");
        // DB::update("UPDATE bxby_pcontato SET telefone = '$request->newtelefone',
        //                                      celular = '$request->newcelular' WHERE codigo_suite = '$auth_suite'");
    }

    public function destroy($id)
    {
        $produto = OrcamentoProduto::where('codigo_orcamento', $id)->get();

        try {
            for ($i = 0; $i < count($produto); $i++) {
                if ($produto[$i]->status != '8') {
                    $sql_produto_update = "UPDATE bxby_produtos_estoque SET qtde = qtde + {$produto[$i]->quantidade}, `status` = '2' WHERE seq_produto = {$produto[$i]->codigo_produto}";
                    DB::update($sql_produto_update);
                }
            }

            $orcamento = Orcamento::destroy($id);
            if($orcamento) {
                return response()->json(['msg' => 'Registro excluido com sucesso!']);
            }
        } catch (Exception $e) {
            \debugbar()->info($e->getMessage());
        }
    }

    public function cancelaOrcamento($id)
    {
        $status_orcamento = Orcamento::select('status')->where('sequencia', $id)->get();

        if($status_orcamento[0]->status == 4)
        {
            $this->destroy($id);
        } else {
            debugbar()->error("Orçamento não foi cancelado");
        }
    }

    public function aceite($id)
    {
        Orcamento::where('sequencia', $id)->update(['aceita_orcamento' => '1']);
    }

    public function voltaStatus($id)
    {
        Orcamento::where('sequencia', $id)->update(['status' => '4']);
    }
}
