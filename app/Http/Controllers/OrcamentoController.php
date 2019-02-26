<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use illuminate\Support\Facades\Auth;
use Auth;
use Mail;
use App\Orcamento;
use App\OrcamentoProduto;
use Illuminate\Database\QueryException;
use App\lib\CustomException;
use App\Mail\OrderNotification;
use Carbon\Carbon;
use App\Enderecos;
use PhpParser\Node\Stmt\TryCatch;
use App\Estoque;

class OrcamentoController extends Controller
{
    public function cartIndex()
    {
        $user_endereco = Enderecos::where('codigo_suite', Auth::user()->codigo_suite)->get();
        return view('usuario.carrinho', ['endereco' => $user_endereco]);
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
                                vlr_declarado,
                                `status`)
                           VALUES (?,?,?,?,?,?,?,?,?,?,?,?)", [
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
                    $request->total_declarado,
                    4
                ]);

                $cod_orcamento = DB::getPdo()->lastInsertId();

                $produtos = $request->session()->get('produtos');
                $messages = [
                    'valordeclarado.required' => 'Informe o valor declarado do(s) produto(s).'
                ];

                for ($i = 0; $i < count($produtos); $i++) {
                    $this->validate($request, [
                        'valor_declarado' => 'required'
                    ], $messages);
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
                        9
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

        return view('orcamento.main', ['aguardando' => $aguardando, 'aprovado' => $aprovado, 'pago' => $pago, 'produtos' => $produtos]);
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

    public function store(Request $request)
    {
        //
    }

    public function add()
    {
        return view('orcamento.add');
    }

    public function show($id = null)
    {
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
            'seguro' => $request->seguro2,
            'recebe_nota' => $request->envianf,
            'preco_etiqueta' => $request->etiquetaoriginal,
            'recebe_propaganda' => $request->enviapropaganda,
            'caixas_originais' => $request->caixaoriginal,
            'sacolas_originais' => $request->sacolaoriginal,
            'vlr_entrega' => $request->valorentrega != '' ? str_replace(',', '.', $request->valorentrega) : '0.00',
            'vlr_seguro' => $request->valorseguro != '' ? str_replace(',', '.', $request->valorseguro) : '0.00',
            'vlr_taxa' => $request->valorbxby != '' ? str_replace(',', '.', $request->valorbxby) : '0.00',
            'vlr_final' => $request->valortotal != '' ? str_replace(',', '.', $request->valortotal) : '0.00',
            'enviado' => $request->enviado,
            'data_envio' => $request->dataenvio,
            'status' => $request->statusorcamento
        ];

        if ($request->statusorcamento == '6') {
            DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $id)->update(['status' => '7']);
        }

        if ($request->enviado == '1') {
            $messages = [
                'codigorastreio.required' => 'Informe o código de rastreio do pacote.',
                'dataenvio.required' => 'Informe a data de envio do pacote.'
            ];
            $this->validate($request, [
                'codigorastreio' => 'required',
                'dataenvio' => 'required'
            ], $messages);
            DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $id)->update(['status' => '8']);
        }
        DB::table('bxby_orcamento')->where('sequencia', $id)->update($data);
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

            $orcamento = Orcamento::find($id);
            $orcamento->delete();
            return response()->json(['msg' => 'Registro excluido com sucesso!']);
        } catch (Exception $e) {
            Debugbar::info($e->getMessage());
        }


    }
}
