<?php

namespace App\Http\Controllers\Usuarios;

use App\Estoque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orcamento;

class EnviadosController extends Controller
{
    public function index()
    {
        $enviados = Estoque::where([['codigo_suite', auth()->id()], ['status', '4']]);

        return view('usuario.enviados', ['enviados' => $enviados]);
    }
}
