<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orcamento;
use App\OrcamentoProduto;
use Paypalpayment;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as req;
use App\Facades\CotacaoDolar;

class PaymentController extends Controller
{
    public function invoice($orcamento_id)
    {
        $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
                       ->where('bxby_orcamento.sequencia', $orcamento_id)->get();
        
        $produtos_orcamento = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();
        return view('usuario.invoices.invoice', ['orcamento' => $orcamento, 'produtos' => $produtos_orcamento]);
    }

    public function pay($orcamento)
    {
        $orcamento = DB::table('bxby_orcamento')->where('sequencia', $orcamento)->get();

        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod('paypal');
        
        $item = Paypalpayment::item();
        $item->setName("Entrega de produtos BOX4BUY (Suite: CB#{$orcamento[0]->codigo_suite})")
             ->setCurrency('USD')
             ->setQuantity(1)
             ->setPrice($orcamento[0]->vlr_final);
             
        $list = Paypalpayment::itemList();
        $list->setItems([$item]);

        $amount = Paypalpayment::amount();
        $amount->setTotal($orcamento[0]->vlr_final)
               ->setCurrency('USD');

        $transaction = Paypalpayment::transaction();
        $transaction->setamount($amount)
                    ->setItemList($list)
                    ->setDescription("PAGAMENTO DO ORÇAMENTO N° {$orcamento[0]->sequencia} (Suite: CB#{$orcamento[0]->codigo_suite})");

        $redirect_urls = Paypalpayment::redirectUrls();
        $redirect_urls->setReturnUrl(route('status'))
                      ->setCancelUrl(route('status'));

        $payment = Paypalpayment::payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setTransactions([$transaction])
                ->setRedirectUrls($redirect_urls);

        try {
            $payment->create(Paypalpayment::apiContext());

            session()->put('payment_id', $payment->getId());
            session()->put('orcamento_id', $orcamento[0]->sequencia);

            return redirect($payment->getApprovalLink());
        } catch (\PPConnectionException $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    public function getStatus()
    {
        $paymentid = session('payment_id');

        session()->forget('payment_id');

        if (empty(req::input('PayerID')) || empty(req::input('token'))) {
            session()->put('error-request', 'Não foi possível concluir a transação no momento. Tente novamente mais tarde!');
            return redirect(route('estoque'));
        }

        $payment = Paypalpayment::getById($paymentid, Paypalpayment::apiContext());
        $exec = Paypalpayment::paymentExecution();
        $exec->setPayerId(req::input('PayerID'));

        $result = $payment->execute($exec, Paypalpayment::apiContext());

        if ($result->getState() == 'approved') {
            DB::table('bxby_orcamento')->where('sequencia', session('orcamento_id'))->update(['status' => '6']);            
            $orcamento_id = session('orcamento_id');
            $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
                ->where('bxby_orcamento.sequencia', $orcamento_id)->get();
            $produtos = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();


            //$recibo = PDF::loadView('usuario.invoices.recibo', ['orcamento' => $orcamento, 'produtos' => $produtos]);
            session()->put('success', 'Pagamento concluido com sucesso');
            
            return $this->geraRecibo($orcamento_id);
        }

        session()->put('error', 'Não foi possível concluir a transação no momento. Tente novamente mais tarde!');
        return redirect(route('estoque'));
    }

    public function geraRecibo($orcamento_id)
    {
        $orcamento = DB::table('bxby_orcamento')->join('bxby_pendereco', 'bxby_orcamento.cod_endereco', '=', 'bxby_pendereco.seq_endereco')
            ->where('bxby_orcamento.sequencia', $orcamento_id)->get();
        $produtos = DB::table('bxby_orcamento_produto')->where('codigo_orcamento', $orcamento_id)->get();
        $cotacaoDolar = number_format(CotacaoDolar::getDolar(), 2);
        return view('usuario.invoices.recibo', ['orcamento' => $orcamento, 'produtos' => $produtos, 'dolar' => $cotacaoDolar]);
    }

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
