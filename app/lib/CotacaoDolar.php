<?php

namespace App\lib;

// use Ixudra\Curl;
use Ixudra\Curl\Facades\Curl as Api;

class CotacaoDolar
{
    private $endpoint;

    public function getDolar()
    {        
        $key = getenv('API_DOLAR_KEY');
        // $this->endpoint = "https://api.hgbrasil.com/finance/quotations?format=json&key=$key";
        $this->endpoint = "https://economia.awesomeapi.com.br/USD-BRL";
        $response = Api::to($this->endpoint)->returnResponseObject()
        ->get();
        $cotacao = json_decode($response->content, true);
        // return $this->endpoint;
        // return dump($response->content); 
        // return dump($cotacao, $this->endpoint);
        // return $cotacao['results']['currencies']['USD']['buy'];
        return $cotacao[0]['bid'];
    }
}
