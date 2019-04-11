<?php

namespace App\Http\Controllers;

use App\CompraAssistida;
use App\CompraAssistidaInfo;
use App\Http\Requests\CompraRequest;
use App\Mail\CompraAssistidaChangeStatus;
use App\Mail\CompraAssistidaMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CompraAssistidaController extends Controller
{
    private $compra;
    private $total_produtos;

    public function __construct(CompraAssistidaInfo $assistidaInfo)
    {
        $this->compra = $assistidaInfo;
    }

    /**
     * Renderiza a lista de solicitações de compra assistida
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->type_user == '1')
        {
            $assistidaInfo = $this->compra->all();
        } else {
            $assistidaInfo = $this->compra->where('suite_id', Auth::id())->get();
        }

        return view('compra_assistida.main', ['compras' => $assistidaInfo]);
    }

    /**
     * Renderiza o formulário de compra assistida
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('compra_assistida.add');
    }

    /**
     * Adiciona um novo produto ao array
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addItems(Request $request)
    {
        $total_produtos = 0;

        $data_items = [
            'suite' => $request->suite,
            'url' => $request->linkproduto,
            'descricao' => $request->nomeproduto,
            'tamanho' => $request->tamanhoproduto,
            'cor' => $request->corproduto,
            'substitui_tamanho' => $request->substituitamamho,
            'substitui_cor' => $request->substituicor,
            'quantidade' => $request->quantidade,
            'valor' => $request->valorproduto,
            'observacoes' => $request->observacoes,
            'observacoes_add' => $request->observacoesadicionais,
            'fora_estoque' => $request->fora_estoque
        ];

        session()->push('items', $data_items);
        foreach (session('items') as $item)
        {
            $this->total_produtos += $item['valor'];
        }

        if(session()->has('total_produtos'))
        {
            session()->forget('total_produtos');
            session(['total_produtos' => number_format($this->total_produtos, 2)]);
        } else {
            session(['total_produtos' => number_format($this->total_produtos, 2)]);
        }
        return response($this->total_produtos);
    }

    /**
     * Atualiza o array de produtos
     * @param Request $request
     */
    public function updateItems(Request $request)
    {
        session()->forget('items.'.$request->itemid);

        $data_items = [
            'suite' => $request->suite,
            'url' => $request->linkproduto,
            'descricao' => $request->nomeproduto,
            'tamanho' => $request->tamanhoproduto,
            'cor' => $request->corproduto,
            'substitui_tamanho' => $request->substituitamamho,
            'substitui_cor' => $request->substituicor,
            'quantidade' => $request->quantidade,
            'valor' => $request->valorproduto,
            'observacoes' => $request->observacoes,
            'observacoes_add' => $request->observacoesadicionais,
            'fora_estoque' => $request->fora_estoque
        ];

        session()->push('items', $data_items);
    }

    /**
     * Remove um item do array de produtos
     * @param Request $request
     * @return mixed
     */
    public function removeItems(Request $request)
    {
        $this->total_produtos = session('total_produtos') - session('items.'.$request->itemid.'.valor');
        session()->forget('total_produtos');
        session(['total_produtos' => number_format($this->total_produtos, 2)]);
        session()->forget('items.'.$request->itemid);

        if(count(session('items')) == 0)
        {
            session()->forget('total_produtos');
            session()->forget('items');
        }

        return $request->itemid;
    }

    /**
     * Salva as solicitações de compra assistida
     * Status do pedido
     * 10 - Processando
     * 11 - Respondido
     * 12 - Concluido
     * @param Request $request
     * @param $itemid
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request, $itemid = null)
    {
        if(session()->has('items'))
        {
            $this->compra->status_solicitacao = 10;
//            $this->compra->total_produtos = array_sum(session('items.'. $itemid .'valor'));
            $this->compra->total_produtos = session('total_produtos');
            $this->compra->codigo_suite = session('items.'.$itemid.'.suite');
            $this->compra->observacoes = session('items.'.$itemid.'.observacoes_add');
            $this->compra->save();

            $compraid = DB::getPdo()->lastInsertId();

            foreach (session('items') as $item) {
                DB::insert('INSERT INTO bxby_compra_assistida (compra_id, 
                                   link_produto,
                                   descricao,
                                   cor, 
                                   tamanho, 
                                   preco, 
                                   quantidade, 
                                   observacao, 
                                   substitui_tamanho, 
                                   substitui_cor, 
                                   fora_estoque) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?)',
                    [
                        $compraid,
                        $item['url'],
                        $item['descricao'],
                        $item['cor'],
                        $item['tamanho'],
                        $item['valor'],
                        $item['quantidade'],
                        $item['observacoes'],
                        $item['substitui_tamanho'],
                        $item['substitui_cor'],
                        $item['fora_estoque'],
                    ]);
            }


        } else {
            $data = [
                'compra_id' => $request->compra_id,
                'link_produto' => $request->linkproduto,
                'cor' => $request->corproduto,
                'tamanho' => $request->tamanhoproduto,
                'preco' => $request->valorproduto,
                'quantidade' => $request->quantidade,
                'observacao' => $request->observacoes,
                'substitui_tamanho' => $request->substituitamanho,
                'substitui_cor' => $request->substituicor,
                'fora_estoque' => $request->fora_estoque,
            ];

            CompraAssistida::insert($data);
        }

        if(Auth::user()->type_user == '1')
        {
            Mail::send(new CompraAssistidaMail($compraid, $request->suite, '10', session('items.'.$itemid.'.observacoes_add'), Auth::user()->email));
        } else {
            Mail::send(new CompraAssistidaMail($compraid, Auth::id(), '10', session('items.'.$itemid.'.observacoes_add'), Auth::user()->email));
        }

        session()->forget('items');
        \session()->forget('total_produtos');

        return response('Solicitação enviada com sucesso');
    }

    public function updateSolicitacao(CompraRequest $request, $id)
    {
        $taxas = $request->valorprodutos * 0.05;
        if($request->valorprodutos >= 100)
        {
            $taxa_servico = $request->valorprodutos * 0.1;
        } else {
            $taxa_servico = $request->valorprodutos * 0.15;
        }

        $total_compras = $request->valorprodutos + $taxas + $taxa_servico + $request->frete;

        $data = [
            'frete_loja' => $request->frete,
            'taxas' => $taxas,
            'taxa_servico' => $taxa_servico,
            'total_produtos' => $request->valorprodutos,
            'total_compra' => $total_compras,
            'status_solicitacao' => 11
        ];

        $solicitacao = CompraAssistidaInfo::find($id);
        /*$cliente_email = User::select('email')
                            ->where('codigo_suite', $solicitacao->suite_id)
                            ->get();*/

//        debugbar()->debug($cliente_email[0]->email);
        $solicitacao->update($data);

        Mail::send(new CompraAssistidaChangeStatus($id, '11', $solicitacao->usuario->email, $solicitacao->suite_id));


        /*if(Auth::user()->type_user == '1')
        {
        } else {
            Mail::send(new CompraAssistidaMail($id, Auth::id(), '10', session('items.'.$itemid.'.observacoes_add'), Auth::user()->email));
        }*/

        return response('Valores inseridos com sucesso!');
    }

    public function edit($id)
    {
        $solicitacao = CompraAssistidaInfo::find($id);

        return view('compra_assistida.edit', ['solicitacao' => $solicitacao]);
    }

    /**
     * Atualiza um produto que ja esteja salvo em uma compra
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'link_produto' => $request->linkproduto,
            'cor' => $request->corproduto,
            'tamanho' => $request->tamanhoproduto,
            'preco' => $request->valorproduto,
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacoes,
            'substitui_tamanho' => $request->substituitamanho,
            'substitui_cor' => $request->substituicor,
            'fora_estoque' => $request->fora_estoque,
        ];

        $compra = CompraAssistida::find($request->itemid);
        $compra->update($data);

        return response('Produto alteradoi com sucesso!');
    }

    public function foraEstoque(Request $request, $id)
    {
//        return $request;
        CompraAssistida::find($id)->update(['fora_estoque' => $request->fora_estoque]);
    }

    public function cancelaPedido($id)
    {
        CompraAssistidaInfo::find($id)->update(['status_solicitacao' => '13']);
        return response('Pedido cancelado com sucesso!');
    }

    public function destroyProduct($id)
    {
        CompraAssistida::destroy($id);
    }

    public function destroy($id)
    {
        CompraAssistidaInfo::destroy($id);
        return response('Registro excluido com sucesso!');
    }
}
