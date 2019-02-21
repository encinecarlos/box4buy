<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orcamento;

class EnviadosController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::all();
        
        $enviados = $orcamentos->filter(function ($orcamento) {
            $orcamento->enviado == '1';
        });

        $entregues = $orcamentos->filter(function ($orcamento) {
            $orcamento->entregue == '1';
        });

        return view('usuario.enviados', ['enviados' => $enviados, 'entregues' => $entregues]);
    }
}
