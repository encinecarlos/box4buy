<?php

namespace App\Http\Controllers;

use App\Lib\Pagamento;

class PaymentController extends Controller
{
    private $pagamento;

    public function __construct(Pagamento $pagamento)
    {
        $this->pagamento = $pagamento;
    }

    public function invoice($orcamento_id)
    {
        return $this->pagamento->invoice($orcamento_id);
    }

    public function pay($orcamento)
    {
        return $this->pagamento->pay($orcamento);
    }

    public function getStatus()
    {
        return $this->pagamento->getStatus();
    }

    public function geraRecibo($orcamento_id)
    {
        return $this->pagamento->geraRecibo($orcamento_id);
    }

    public function toPDF($orcamento_id)
    {
        return $this->pagamento->toPDF($orcamento_id);
    }
}
