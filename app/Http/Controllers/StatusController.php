<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Lib\CustomException;

class StatusController extends Controller
{
    public function cadastrar(Request $request)
    {
        try {
            DB::statement("begin pck_bxby.sp_status('','{$request->descricao_status}'); end;");
            return response()->json(['msg' => 'Status gravado com sucesso.']);
        } catch (QueryException $ex) {
            CustomException::trataErro($ex);
        }
    }
}
