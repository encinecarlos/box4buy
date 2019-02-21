<?php

namespace App\Http\Controllers;

use App\Enderecos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\lib\CustomException;

class EnderecosController extends Controller
{
    public function cadastrar(Request $request)
    {
        try {
            DB::insert(
                "INSERT INTO bxby_pendereco (codigo_suite, 
						    codigo_postal, 
                            endereco,
                            numero,
                            complemento, 
                            bairro, 
                            cidade, 
                            estado, 
                            pais)
                    VALUES (?,?,?,?,?,?,?,?,?)",
                [
                    $request->codigo_suite,
                    $request->newcep,
                    $request->newendereco,
                    $request->newnumero,
                    $request->newcomplemento,
                    $request->newbairro,
                    $request->newcidade,
                    $request->newuf,
                    $request->newpais
                ]
            );

            return response()->json(['msg' => 'Endereço cadastrado com sucesso', 'status' => '1']);
        } catch (QueryException $ex) {
            CustomException::trataErro($ex);
        }
    }

    public function show($seq_endereco, $cod_suite)
    {
        $endereco = DB::table('bxby_pendereco')->where([['seq_endereco', '=',  $seq_endereco], ['codigo_suite', '=', $cod_suite]])->get();
        return $endereco;
    }

    public function update(Request $request, $id)
    {
        try {
            DB::update("UPDATE bxby_pendereco 
                                SET codigo_postal = '$request->newcep',
                                    endereco = '$request->newendereco',
                                    complemento = '$request->newcomplemento',
                                    numero = '$request->newnumero',
                                    bairro = '$request->newbairro',
                                    cidade = '$request->newcidade',
                                    estado = '$request->newuf',
                                    pais = '$request->newpais'
                                WHERE seq_endereco =  $id");
            return response()->json(['msg' => 'Endereco atualizado com sucesso!', 'status' => '1']);
        } catch (QueryException $ex) {
            CustomException::trataErro($ex);
        }
    }
}
