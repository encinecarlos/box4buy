<?php

namespace App\Http\Controllers\Usuarios;

use App\Estoque;
use App\EstoqueImagem;
use App\OrcamentoProduto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orcamento;

class EnviadosController extends Controller
{
    public function index()
    {
        $enviados = OrcamentoProduto::with(['orcamento' => function ($query) {
            $query->where([
                ['codigo_suite', auth()->id()],
                ['status', '6']
            ])->withTrashed();
        }, 'fotos'])
          ->where('status', '8')
          ->get();

        return view('usuario.enviados', ['enviados' => $enviados]);
    }

    public function showFotos($productid)
    {
        $fotos = EstoqueImagem::where('codigo_produto', $productid)->get();
        return view('usuario.enviadofotos', ['fotos' => $fotos]);
    }
}
