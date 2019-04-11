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
    private function setContext()
    {
        $apiContext = new ApiContext(new OAuthTokenCredential(
            env('PAYPAL_CLIENT_ID'),
            env('PAYPAL_CLIENT_SECRET')
        ));

        return $apiContext;
    }

    public function invoice($orcamento_id)
    {
        return null;
    }

    public function pay($orcamento)
    {
        $solicitacao = CompraAssistidaInfo::find($orcamento);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName("Compra Assistida código: {$orcamento}")
            ->setCurrency('USD')
            ->setSku($solicitacao->sequencia)
            ->setQuantity(1)
            ->setPrice($solicitacao->total_compra);

        $list = new ItemList();
        $list->setItems([$item]);

//        $total_taxas = $solicitacao->taxas + $solicitacao->taxa_servico;
//        $details = new Details();
//        $details->setFee($total_taxas)
//            ->setShipping($solicitacao->frete)
//            ->setSubtotal($solicitacao->total_produtos);

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal($solicitacao->total_compra);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($list)
            ->setCustom('SUITE: '.$solicitacao->suite_id)
            ->setDescription("SERVIÇO - COMPRA ASSISTIDA")
            ->setInvoiceNumber(uniqid());

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('compra.status'))
            ->setCancelUrl(route('compra.status'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirect_urls);

        try {
            $payment->create($this->setContext());

            session()->put('payment_id', $payment->getId());
            session()->put('orcamento_id', $solicitacao->sequencia);

            return redirect($payment->getApprovalLink());
        } catch(PayPalConnectionException $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => $ex->getCode(), 'Data' => $ex->getData(), 'valor_transação' => $solicitacao->total_compra], 404);
        }
    }

    public function getStatus()
    {
        $paymentid = session('payment_id');

        session()->forget('payment_id');

        if(empty(Request::input('PayerID')) || Empty(Request::input('token')))
        {
            session()->put('error_request', 'Não foi possivel processar a sua solicitação no momento. Tente novamente mais tarde');
            return redirect(route('compra.main'));
        }

        $payment = Payment::get($paymentid, $this->setContext());
        $exec = new PaymentExecution();
        $exec->setPayerId(Request::input('PayerID'));

        $result = $payment->execute($exec, $this->setContext());

        if($result->getState() == 'approved')
        {
            CompraAssistidaInfo::where('sequencia', session('orcamento_id'))
                ->update(['status_solicitacao' => '12']);

            $orcamento_id = session('orcamento_id');

            $solicitacao = CompraAssistidaInfo::find($orcamento_id);

            Mail::send(new ReciboCompra($solicitacao));

//            return $this->geraRecibo($orcamento_id);
            return redirect(route('compra.edit', $orcamento_id))
                ->with('msg', 'PAGAMENTO EFETUADO COM SUCESSO!');
        }
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
