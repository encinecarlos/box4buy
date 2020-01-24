<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/2/19
 * Time: 8:46 AM
 */

namespace App\Lib;

use Ixudra\Curl\Facades\Curl as Api;

use App\CompraAssistidaInfo;

/**
 * @property  endpointCountry
 */
class Utils
{
    private static $subtotal;
    private $totalGeral;
    private static $endpointCountry;


    public function __construct()
    {
        $this->totalGeral = 0;
        self::$endpoinCountry = "https://restcountries.eu/rest/v2/all?fields=name;alpha2Code";
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

    public static function getCountries()
    {
        $response = Api::to("https://restcountries.eu/rest/v2/all?fields=name;alpha2Code;translations")
            ->returnResponseObject()
            ->get();
//        $countries = json_decode($response, true);
        $countries = json_decode($response->content, true);
        return $countries;
    }
}
