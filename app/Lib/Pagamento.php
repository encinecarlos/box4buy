<?php

namespace App\Lib;

use App\Lib\Contracts\PaymentInterface;
use Barryvdh\DomPDF\Facade as PDF;
use App\Facades\CotacaoDolar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as req;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;


/**
 * @property ApiContext apiContext
 */
class Pagamento implements PaymentInterface
{


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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pay($orcamento_id)
    {
//        $orcamento = DB::table('bxby_orcamento')->where('sequencia', $orcamento_id)->get();
        DB::table('bxby_orcamento')->where('sequencia', $orcamento_id)->update(['status' => '6']);
        return self::geraRecibo($orcamento_id);
    }

    /**
     * Processa o retorno da transação
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getStatus()
    {

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
