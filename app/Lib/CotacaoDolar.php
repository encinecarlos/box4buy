<?php

namespace App\Lib;

// use Ixudra\Curl;
use Ixudra\Curl\Facades\Curl as Api;

class CotacaoDolar
{
    private $endpoint;

    public function getDolar()
    {
        $this->endpoint = "https://economia.awesomeapi.com.br/USD-BRL";
        $response = Api::to($this->endpoint)->returnResponseObject()
        ->get();
        $cotacao = json_decode($response->content, true);

        return $cotacao[0]['bid'];
    }
}
