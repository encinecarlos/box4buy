<?php

namespace App\customClass;

use Illuminate\Database\QueryException;

class ShowExceptions
{
    public static function returnMessage(QueryException $ex)
    {
        $novastring = explode(":", $ex->getMessage());
        $segundastring = explode("(", $novastring[2]);
        $stringfinal = trim($segundastring[0]);
        return response()->json(['msg' => $stringfinal]);
    }
}
