<?php

namespace App\Http\Controllers;

use App\CompraAssistida;
use App\CompraAssistidaInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $assistidaInfo = $this->compra->where('codigo_suite', Auth::id())->get();
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
     * @param $itemid
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request, $itemid = null)
    {
        if(session()->has('items'))
        {
            $this->compra->status_solicitacao = 10;
            $this->compra->codigo_suite = session('items.'.$itemid.'.suite');
            $this->compra->observacoes = session('items.'.$itemid.'.obervacoes_add');
            $this->compra->save();

            $compraid = DB::getPdo()->lastInsertId();

            foreach (session('items') as $item) {
                DB::insert('INSERT INTO bxby_compra_assistida (compra_id, 
                                   link_produto, 
                                   cor, 
                                   tamanho, 
                                   preco, 
                                   quantidade, 
                                   observacao, 
                                   substitui_tamanho, 
                                   substitui_cor, 
                                   fora_estoque) 
                        VALUES (?,?,?,?,?,?,?,?,?,?)',
                    [
                        $compraid,
                        $item['url'],
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

            session()->forget('items');
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
                'observacoes_adicionais' => $request->observacoesadicionais
            ];

            CompraAssistida::insert($data);
        }


        return response('Solicitação enviada com sucesso');
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
            'observacoes_adicionais' => $request->observacoesadicionais
        ];

        $compra = CompraAssistida::find($request->itemid);
        $compra->update($data);

        return response('Produto alteradoi com sucesso!');
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
