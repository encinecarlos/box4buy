<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/02/19
 * Time: 11:58
 */

namespace App\lib;


class ProductServices
{
    public static function totalizaProdutos()
    {
        $totalProdutos = 0;
        $totalPeso = 0;
        $produtos = session('produtos');

        if($produtos)
        {
            foreach($produtos as $produto => $value)
            {
                $totalProdutos += $value['qtde'];
                $totalPeso += $value['peso'];
            }

            return ['total_produtos' => $totalProdutos, 'total_peso' => $totalPeso];
        }
    }
}