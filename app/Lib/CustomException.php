<?php

namespace App\Lib;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CustomException
{
    public static function trataErro(QueryException $qex)
    {
        $message = $qex->getCode() . " - não foi possível executar esta ação no momento. Tente novamente mais tarde.";
        Log::channel('custom')->error($qex->getMessage());
        return response()->json(['msg' => $message, 'status' => '2']);
    }

    public static function trataErroGeral(\Exception $pex)
    {
        $message = $pex->getCode() . " - Não foi possivel executar esta ação no momento. Tente novamente mais tarde.";
        Log::channel('custom')->error($pex->getMessage());
        return response()->json(['msg' => $message, 'status' => '2']);
    }
}
