<?php

namespace App\Http\Controllers;

use App\Lib\PagamentoCompraAssistida;
use Illuminate\Http\Request;

class PagamentoCompraController extends Controller
{
    private $pagamento;

    public function __construct(PagamentoCompraAssistida $pagamento)
    {
        $this->pagamento = $pagamento;
    }

    public function pay($orcamento)
    {
        return $this->pagamento->pay($orcamento);
    }

    public function getStatus()
    {
        return $this->pagamento->getStatus();
    }
}
