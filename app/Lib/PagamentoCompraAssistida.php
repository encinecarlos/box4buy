<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/9/19
 * Time: 10:39 AM
 */

namespace App\Lib;


use App\CompraAssistidaInfo;
use App\Lib\Contracts\PaymentInterface;
use App\Mail\ReciboCompra;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PagamentoCompraAssistida implements PaymentInterface
{

    public function invoice($orcamento_id)
    {
        return null;
    }

    public function pay($orcamento)
    {
        CompraAssistidaInfo::where('sequencia', $orcamento)
            ->update(['status_solicitacao' => '12']);

        $solicitacao = CompraAssistidaInfo::find($orcamento);

        Mail::send(new ReciboCompra($solicitacao));

        return response('Pagamento efetuado com sucesso.');
    }

    public function getStatus()
    {

    }

    public function geraRecibo($orcamento_id)
    {
        return null;
    }

    public function toPDF($orcamento_id)
    {
        // TODO: Implement toPDF() method.
    }


}
