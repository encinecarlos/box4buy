<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Enderecos;
use App\EstadoCivil;
use App\PessoaContato;
use App\Estoque;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\PessoaNotificationMessage;
use App\Http\Requests\UserAdminRequest;
use Mail;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::orderBy('codigo_suite', 'desc')->get();        
        return view('pessoas.main', ['pessoas' => $pessoas]);
    }

    public function store(UserAdminRequest $request)
    {
        // $pass = Hash::make($request->password);
        $data_nascimento = $request->data_nascimento;
        if($request->password == $request->confirma_password)
        {
            $pass = Hash::make($request->password);
        }
        
        
        DB::insert(
                "INSERT INTO bxby_pessoas (nome_completo, 
			                                      tipo_cadastro,
                                                  type_user,
                                                  data_nascimento,                                                   
                                                  email, 
                                                  password,                                                   
                                                  tipo_pessoa, 
                                                  onde_conheceu)
                                            VALUES (?,?,?,?,?,?,?,?)",
                                            [
                                                $request->_nome,
                                                1,
                                                $request->type_user,
                                                $data_nascimento,
                                                $request->email,
                                                $pass,
                                                1,
                                                $request->ondeconheceu
                                            ]
            );

        $suiteId = DB::getPdo()->lastInsertId();

        DB::insert("INSERT INTO bxby_pconfirma_dados (codigo_suite, data_cadastro) VALUES (?, ?)", [$suiteId, new Carbon()]);

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
                        $suiteId,
                        $request->cep,
                        $request->endereco,
                        $request->numero,
                        $request->complemento,
                        $request->bairro,
                        $request->cidade,
                        $request->uf,
                        'BR'
                    ]
            );

        DB::insert(
                "INSERT INTO bxby_pcontato (codigo_suite,
                           celular)
                   VALUES (?,?)",
                [
                    $suiteId,
                    $request->celular
                ]
            );

            mail::send(new PessoaNotificationMessage($request->input(), $suiteId));
            
        return response()->json(['msg' => 'Cadastro efetuado com sucesso!', 'status' => '1']);
    }

    public function add()
    {
        $estado_civil = DB::table('bxby_estado_civil')->get();
        //$soma = DB::select("select SUM(quantidade) as total FROM bxby_orcamento_produto");
        
        return view('pessoas.add', ['estado_civil' => $estado_civil]);
    }

    public function show($id = null)
    {
        $pessoa = Pessoa::find($id);
        $perfil_endereco = Enderecos::where('codigo_suite', $id)->get();
        $perfil_contato = PessoaContato::where(['codigo_suite' => $id])->get();
        $estado_civil = DB::table('bxby_estado_civil')->get();
        $pessoa_estoque = Estoque::where('codigo_suite', $id)->get();
        $pessoa_documentos = DB::table('bxby_pconfirma_dados')
            ->select(['caminho_rg', 'caminho_comprovante', 'libera_pagamento'])
            ->whereNotNull('caminho_rg')
            ->whereNotNull('caminho_comprovante')
            ->where('codigo_suite', $id)
            ->get();

        return view('pessoas.show', ['pessoa' => $pessoa,
                                     'estoque' => $pessoa_estoque,
                                     'pessoa_endereco' => $perfil_endereco,
                                     'contato' => $perfil_contato,
                                     'estado_civil' => $estado_civil,
                                     'documentos' => $pessoa_documentos]);
    }

    public function edit($id = null)
    {
        $pessoa = Pessoa::find($id);
        return view('pessoas.edit', ['pessoa' => $pessoa]);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::where('sequencia', $id);
        $pessoa->update();
    }

    public function destroy($id)
    {
        PessoaContato::where('codigo_suite', $id)->delete();
        Enderecos::where('codigo_suite', $id)->delete();
        Pessoa::find($id)->delete();
        return response()->json(['msg' => 'Usuário excluido com sucesso!']);        
    }
}
