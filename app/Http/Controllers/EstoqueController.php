<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\EstoqueImagem;
use App\Http\Middleware\SumProducts;
use App\Http\Requests\EstoqueRequest;
use App\Lib\ProductServices;
use App\Mail\StatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Lib\CustomException;
use App\Pessoa;
use App\Enderecos;
use App\EstoqueImagem as Fotos;
use App\Orcamento;
use Carbon\Carbon;
use App\OrcamentoProduto;
use App\Mail\ProductNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\User;

class EstoqueController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function exibeEstoqueUsuario()
    {
        $produtos = Estoque::where(['codigo_suite' => Auth::user()->codigo_suite])->get();

        $fotos = Fotos::join('bxby_produtos_estoque', 'bxby_produtos_imagem.codigo_produto', '=', 'bxby_produtos_estoque.seq_produto')
            ->where('bxby_produtos_estoque.codigo_suite', Auth::user()->codigo_suite)->get();

        $user_endereco = Enderecos::where('codigo_suite', Auth::user()->codigo_suite)->get();
        $orcamentos = Orcamento::where('codigo_suite', Auth::user()->codigo_suite)->get();
        $enable_payment = DB::table('bxby_pconfirma_dados')->select(['libera_pagamento'])
            ->where('codigo_suite', Auth::user()->codigo_suite)
            ->get();

        $estoque = $produtos->filter(function ($produto) {
            return $produto->status == '2';
        });

        $aguardando = $orcamentos->filter(function ($orcamento) {
            return $orcamento->status == '4';
        });

        $aprovado = $orcamentos->filter(function ($orcamento) {
            return $orcamento->status == '5';
        });

        $pago = $orcamentos->filter(function ($orcamento) {
            return $orcamento->status == '6';
        });


        //return dump($fotos);
        return view('usuario.estoque', ['produtos' => $produtos,
            'fotos' => $fotos,
            'estoque' => $estoque,
            'endereco' => $user_endereco,
            'aguardando' => $aguardando,
            'aprovado' => $aprovado,
            'pago' => $pago,
            'libera_pagamento' => $enable_payment]);
    }

    public function cadastrar(EstoqueRequest $request)
    {
        try {
            DB::insert("INSERT INTO bxby_produtos_estoque ( codigo_suite, descricao_produto, data_compra, qtde, codigo_rastreio, site_loja, nome_loja, `status` )
                                VALUES ( ?,?,?,?,?,?,?,? )", [
                $request->suite,
                $request->descricao,
                $request->datacompra,
                $request->quantidade,
                $request->codigorastreio,
                $request->siteloja,
                $request->nomeloja,
                1
            ]);

            $email = DB::table('bxby_pessoas')
                ->select('email')
                ->where('codigo_suite', $request->suite)
                ->get();

            Mail::send(new ProductNotification($request->suite, $email[0]->email, $request->descricao, $request->quantidade));
            return response()->json(['msg' => 'Cadastrado com sucesso', 'status' => '1']);
        } catch (QueryException $ex) {
            //CustomException::trataErro($ex);
            return CustomException::trataErro($ex);
        }
    }

    public function estoqueAdmin()
    {
        $produtos = Estoque::all();
        $produtosOrcamento = OrcamentoProduto::join('bxby_produtos_estoque', 'bxby_produtos_estoque.seq_produto', '=', 'bxby_orcamento_produto.codigo_produto')
            ->where('bxby_orcamento_produto.status', '9');

        $achegar = $produtos->filter(function ($produto) {
            return $produto->status == '1';
        });

        $estoque = $produtos->filter(function ($produto) {
            return $produto->status == '2';
        });

        $orcamentos = OrcamentoProduto::join('bxby_produtos_estoque', 'bxby_produtos_estoque.seq_produto', '=', 'bxby_orcamento_produto.codigo_produto')
            ->where('bxby_orcamento_produto.status', '9')->get();

        $enviado = OrcamentoProduto::join('bxby_produtos_estoque', 'bxby_produtos_estoque.seq_produto', '=', 'bxby_orcamento_produto.codigo_produto')
            ->where('bxby_orcamento_produto.status', '8')->get();

        $usuario = User::select('codigo_suite', 'nome_completo')->get();

        return view('estoque.main', [
            'produtos' => $produtos,
            'achegar' => $achegar,
            'estoque' => $estoque,
            'orcamentos' => $orcamentos,
            'enviado' => $enviado,
            'produtosOrcamento' => $produtosOrcamento,
            'usuario' => $usuario]);
    }

    public function getOrcamento()
    {
        $enviado = OrcamentoProduto::join('bxby_produtos_estoque', 'bxby_produtos_estoque.seq_produto', '=', 'bxby_orcamento_produto.codigo_produto')
            ->where('bxby_orcamento_produto.status', '8')->get();

        return response()->json($enviado);
    }

    public function addAdmin()
    {
        $clientes = Pessoa::all();
        return view('estoque.add', ['clientes' => $clientes]);
    }

    public function showAdmin()
    {
        return view('estoque.show');
    }

    public function editAdmin()
    {
        return view('estoque.edit');
    }

    public function edit($id)
    {
        $produto = Estoque::where(['codigo_suite' => Auth::user()->codigo_suite, 'seq_produto' => $id]);
        return view('estoque.clienteEdita', ['produto' => $produto]);
    }

    public function updateStatus(Request $request, $seq_produto)
    {
        $produto = Estoque::where(['codigo_suite' => $request->suite, 'seq_produto' => $request->seq_produto]);
        $email = Pessoa::select('email', 'nome_completo')->where('codigo_suite', $request->suite)->get();
        if ($request->status == '2') {
            $produto->update(['status' => $request->status, 'data_chegada' => date('Y-m-d')]);
            Estoque::where('status', $request->status)->update(['data_chegada' => Carbon::now()]);
            debugbar()->info($email[0]->email);
            Mail::send(new StatusNotification($produto->get(), $email[0]->email, $email[0]->nome_completo, $request->status));
        } else {
            $produto->update(['status' => $request->status]);
            debugbar()->info($email[0]->email);
            Mail::send(new StatusNotification($produto->get(), $email[0]->email, $email[0]->nome_completo, $request->status));
        }
    }

    public function produtoEdit($suite, $produtoid)
    {
        $produto = Estoque::where(['bxby_produtos_estoque.codigo_suite' => $suite, 'seq_produto' => $produtoid])->get();
        // $produto = DB::table('bxby_produtos_estoque')->join('bxby_produtos_imagem', 'bxby_produtos_estoque.seq_produto', '=', 'bxby_produtos_imagem.codigo_produto')
        //              ->where(['bxby_produtos_estoque.codigo_suite' => $suite, 'seq_produto' => $produto])->get();
        $fotos_produto = Fotos::where('codigo_produto', $produtoid)->get();
        $cliente = Pessoa::where(['codigo_suite' => $suite])->get();
        return view('pessoas.upload', ['produto' => $produto, 'fotos' => $fotos_produto, 'cliente' => $cliente]);
    }

    public function updateProduto(Request $request, $id)
    {
        if ($request->_action == 'user') {
            $suite = $request->suite_edit;
            $data = [
                'descricao_produto' => $request->descricao,
                'codigo_rastreio' => $request->codigorastreio,
                'nome_loja' => $request->nomeloja,
                'site_loja' => $request->siteloja,
                'qtde' => $request->quantidade
            ];

            DB::table('bxby_produtos_estoque')->where(['codigo_suite' => $suite, 'seq_produto' => $id])->update($data);
        } else {
            $suite = $request->suite;

            $data = [
                'descricao_produto' => $request->descricao_produto,
                'codigo_rastreio' => $request->track_number,
                'nome_loja' => $request->nome_loja,
                'site_loja' => $request->site_loja,
                'peso' => $request->peso,
                'qtde' => $request->quantidade
            ];

            DB::table('bxby_produtos_estoque')->where(['codigo_suite' => $suite, 'seq_produto' => $id])->update($data);
        }

        return response()->json(['msg' => 'Produto atualizado com sucesso!', 'status' => '1']);
    }

    public function uploadEstoque(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                //return $request->file('file')->getClientOriginalExtension();
                $filename = str_random(30) . '.' . $request->file('file')->getClientOriginalExtension();

                $user_folder = 'foto_estoque_' . $request->suite;

                if (!is_dir($user_folder)) {
                    Storage::disk('s3')->makeDirectory($user_folder);
                }

                $path = $request->file('file')->storePubliclyAs($user_folder, $filename);
                $dataAtual = date('Y-m-d h:i:s');

                DB::insert("insert into bxby_produtos_imagem
                                (codigo_suite, 
                                codigo_produto, 
                                caminho_imagem,                                
                                data_cadastro)
                                values
                                (?,?,?,?)", [
                    $request->suite,
                    $request->produto,
                    Storage::url($path),
                    $dataAtual
                ]);
            }
            return response()->json(['msg' => 'Foto inserida com sucesso!', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function deleteImagem($id)
    {
        $foto = EstoqueImagem::select('caminho_imagem')->where('seq_imagem', $id)->get();
        Storage::disk('s3')->delete($foto[0]->caminho_imagem);
        EstoqueImagem::destroy($id);

        return response()->json(['msg' => 'Imagem excluida com sucesso!']);
    }

    public function alteraQuantidade(Request $request, $seq_produto)
    {
        $produto = DB::table('bxby_produtos_estoque')->where('seq_produto', $seq_produto)->get();
        if ($produto[0]->qtde > 0) {
            if ($produto[0]->qtde == 0) {
                DB::table('bxby_produtos_estoque')->where('seq_produto', $seq_produto)->update(['status' => '3']);
            }
        }
        $prod_orcamento = DB::table('bxby_produtos_estoque')->where('seq_produto', $seq_produto)->get();

        $data_produtos = [
            "id" => $seq_produto,
            "descricao" => $prod_orcamento[0]->descricao_produto,
            "qtde" => $request->qtenvio,
            'peso' => $prod_orcamento[0]->peso != null ? $prod_orcamento[0]->peso : 0,
            'dias_estoque' => $prod_orcamento[0]->data_chegada == '' ? 'NR' : $prod_orcamento[0]->data_chegada
        ];

        $sql_produto_update = "UPDATE bxby_produtos_estoque SET qtde = qtde - {$request->qtenvio} WHERE seq_produto = {$seq_produto}";
        DB::statement($sql_produto_update);

        $produtos = session('produtos');
        if ($produtos) {
            $idproduto = array_search($seq_produto, array_column($produtos, 'id'));
            if ($produtos[$idproduto]['id'] == $seq_produto) {
                $qtde_atual = session('produtos.' . $idproduto . '.qtde');
                $new_qtde = $qtde_atual + $request->qtenvio;
                session()->put(['produtos.' . $idproduto . '.qtde' => "$new_qtde"]);
            } else {
                $request->session()->push('produtos', $data_produtos);
            }

            debugbar()->debug("ID: $idproduto");
            debugbar()->debug("Sequencia_produto: $seq_produto");
        } else {
            $request->session()->push('produtos', $data_produtos);
        }
        //return redirect(route('estoque'))->with('produtos', $produtos);
        return $produtos;
        //return response()->json(['msg' => "produto adicionado com sucesso!"]);
    }


    public function removeProduto(Request $request, $seq_id)
    {
        if (session('produtos')) {
            $produto_id = session('produtos.' . $seq_id . '.id');
            $quantidade = session('produtos.' . $seq_id . '.qtde');
            $sql_produto_update = "UPDATE bxby_produtos_estoque SET qtde = qtde + {$quantidade} WHERE seq_produto = {$produto_id}";
            DB::statement($sql_produto_update);
            session()->pull('produtos.' . $seq_id);
            if (count(session('produtos')) == 0) {
                session()->forget('produtos');
            }
        }
    }

    public function destroy($id)
    {
        Estoque::find($id)->delete();
    }
}
