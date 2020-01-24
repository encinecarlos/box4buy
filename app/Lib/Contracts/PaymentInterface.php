<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/6/19
 * Time: 9:19 AM
 */

namespace App\Lib\Contracts;


interface PaymentInterface
{
    public function invoice($orcamento_id);
    public function pay($orcamento);
    public function getStatus();
    public function geraRecibo($orcamento_id);
    public function toPDF($orcamento_id);
}
