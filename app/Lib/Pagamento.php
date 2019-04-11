<?php

namespace App\Lib;

use App\Lib\Contracts\PaymentInterface;
use Barryvdh\DomPDF\Facade as PDF;
use App\Facades\CotacaoDolar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as req;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payment;

/**
 * @property ApiContext apiContext
 */
class Pagamento implements PaymentInterface
{

    /**
     * Passa as credenciais para o sdk
     */
    private function setContext()
    {
        $apiContext = new ApiContext(new OAuthTokenCredential(
            env('PAYPAL_CLIENT_ID'),
            env('PAYPAL_CLIENT_SECRET')
        ));

        return $apiContext;
    }

    /**
     * Gera o invoice do pagamento
     * @param $orcamento_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoice($orcamento_id)
    {
        $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
            ->where('bxby_orcamento.sequencia', $orcamento_id)->get();

        $produtos_orcamento = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();
        return view('usuario.invoices.invoice', ['orcamento' => $orcamento, 'produtos' => $produtos_orcamento]);
    }

    /**
     * Cria a transação de pagamento junto ao PayPal
     * @param $orcamento
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function pay($orcamento)
    {
        $orcamento = DB::table('bxby_orcamento')->where('sequencia', $orcamento)->get();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName("Entrega de produtos BOX4BUY (Suite: CB#{$orcamento[0]->codigo_suite})")
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($orcamento[0]->vlr_final);

        $list = new ItemList();
        $list->setItems([$item]);

        $amount = new Amount();
        $amount->setTotal($orcamento[0]->vlr_final)
            ->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setamount($amount)
            ->setItemList($list)
            ->setDescription("PAGAMENTO DO ORÇAMENTO N° {$orcamento[0]->sequencia} (Suite: CB#{$orcamento[0]->codigo_suite})");

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('status'))
            ->setCancelUrl(route('status'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirect_urls);

        try {
            $payment->create(self::setContext());

            session()->put('payment_id', $payment->getId());
            session()->put('orcamento_id', $orcamento[0]->sequencia);

            return redirect($payment->getApprovalLink());
        } catch (\PPConnectionException $ex) {
            Log::error($ex->getMessage());
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    /**
     * Processa o retorno da transação
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getStatus()
    {
        $paymentid = session('payment_id');

        session()->forget('payment_id');

        if (empty(req::input('PayerID')) || empty(req::input('token'))) {
            session()->put('error-request', 'Não foi possível concluir a transação no momento. Tente novamente mais tarde!');
            return redirect(route('estoque'));
        }

        $payment = Payment::get($paymentid, Self::setContext());
        $exec = new PaymentExecution();
        $exec->setPayerId(req::input('PayerID'));

        $result = $payment->execute($exec, self::setContext());

        if ($result->getState() == 'approved') {
            DB::table('bxby_orcamento')->where('sequencia', session('orcamento_id'))->update(['status' => '6']);
            $orcamento_id = session('orcamento_id');
            $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
                ->where('bxby_orcamento.sequencia', $orcamento_id)->get();
            $produtos = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();


            //$recibo = PDF::loadView('usuario.invoices.recibo', ['orcamento' => $orcamento, 'produtos' => $produtos]);
            session()->put('success', 'Pagamento concluido com sucesso');
            Log::info('Pagamento efetuado');

            return self::geraRecibo($orcamento_id);
        }

        session()->put('error', 'Não foi possível concluir a transação no momento. Tente novamente mais tarde!');
        return redirect(route('estoque'));
    }

    /**
     * Gera o recibo referente a transação
     * @param $orcamento_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function geraRecibo($orcamento_id)
    {
        $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
            ->where('bxby_orcamento.sequencia', $orcamento_id)->get();
        $produtos = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();
        $cotacaoDolar = number_format(CotacaoDolar::getDolar(), 2);
        return view('usuario.invoices.recibo', ['orcamento' => $orcamento, 'produtos' => $produtos, 'dolar' => $cotacaoDolar]);
    }

    /**
     * Gera o pdf do recibo
     * @param $orcamento_id
     * @return mixed
     */
    public function toPDF($orcamento_id)
    {
        $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
            ->where('bxby_orcamento.sequencia', $orcamento_id)->get();
        $produtos = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();
        $dolar = number_format(CotacaoDolar::getDolar(), 2);
        $pdf = PDF::loadView('usuario.invoices.recibopdf', compact('orcamento', 'produtos', 'dolar'));
        return $pdf->stream();
    }
}
