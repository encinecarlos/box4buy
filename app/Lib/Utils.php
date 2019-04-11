<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/2/19
 * Time: 8:46 AM
 */

namespace App\Lib;


use App\CompraAssistidaInfo;

class Utils
{
    private static $subtotal;
    private $totalGeral;


    public function __construct()
    {
        $this->totalGeral = 0;
    }

    /**
     * Faz o calculo de subtotal de produtos
     * @param $quantidade
     * @param $valor
     * @return string
     */
    public static function subTotal($quantidade, $valor)
    {
        self::$subtotal = $quantidade * $valor;

        return number_format(self::$subtotal, '2');
    }

    /**
     * @param CompraAssistidaInfo $assistidaInfo
     * @return float|int
     */
    public function total(CompraAssistidaInfo $assistidaInfo)
    {
        foreach ($assistidaInfo->produtos as $produto)
        {
            $total = $produto->preco * $produto->quantidade;
            $this->totalGeral += $total;
        }

        return number_format($this->totalGeral, 2);
    }
}
