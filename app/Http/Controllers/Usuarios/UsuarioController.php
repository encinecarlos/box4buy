<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pessoa;
use App\Enderecos;
use App\PessoaContato;
use App\ConfirmaDados;
use App\Mail\SenConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Usuario;
use Illuminate\Database\QueryException;
use App\Mail\SendResetPassword;
use App\lib\CustomException;
use App\lib\UspsTest;
use App\Configuration;
use Route;
use Carbon\Carbon;
use App\Facades\CotacaoDolar;
use App\Http\Requests\UsuarioRequest;
use Debugbar;

class UsuarioController extends Controller
{
    private $pass;

    public function renderHome()
    {
        $configs = Configuration::find(1);
        $enable_pay = DB::table('bxby_pconfirma_dados')
            ->select('libera_pagamento')
            ->where('codigo_suite', Auth::user()->codigo_suite)
            ->get();

        return view('usuario.home', ['configs' => $configs, 'enable_pay' => $enable_pay]);
    }

    public function gerarSuite()
    {
        $first_suite = "CB#100";
        $last_suite = Pessoa::orderBy('codigo_suite', 'desc')->first();
        //return $last_suite;
        if ($last_suite > $first_suite) {
            $intid = array_map('intval', explode('#', $last_suite->codigo_suite));
            $suiteID = "CB#" . ++$intid[0];
        } else {
            $intid = array_map('intval', explode('#', $first_suite));
            $suiteID = "CB#" . ++$intid[0];
        }
        return $suiteID;
    }

    public function cadastrar(UsuarioRequest $request)
    {
        try {
            //$suite = $this->gerarSuite();
            //$pass = password_hash($request->password, PASSWORD_BCRYPT);
            $pass = Hash::make($request->password);
            $token = uniqid('', true);

            $splitdata = explode('/', $request->data_nascimento);
            $dia = $splitdata[0];
            $mes = $splitdata[1];
            $ano = $splitdata[2];

            $data_nascimento = Carbon::create($ano, $mes, $dia);
            Debugbar::info($data_nascimento->toDateString());
            Debugbar::info($request->data_nascimento);

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
                    2,
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


            Mail::to($request->input('email'))->send(new SenConfirmation($suiteId, $request->email));

            return response()->json(['msg' => 'Cadastro efetuado com sucesso!', 'status' => '1']);
        } catch (QueryException $e) {
            return CustomException::trataErro($e);
        }
    }


    public function enablePayment($suite)
    {
        $enable_customer = DB::table('bxby_pconfirma_dados')->where('codigo_suite', $suite)->get();
        DB::table('bxby_pconfirma_dados')->where('codigo_suite', $suite)->update(['libera_pagamento' => '2']);
        return response()->json(['msg' => 'Função pagamento liberada para o cliente!', 'status' => '1']);
    }

    public function disablePayment($suite)
    {
        $enable_customer = DB::table('bxby_pconfirma_dados')->where('codigo_suite', $suite)->get();
        DB::table('bxby_pconfirma_dados')->where('codigo_suite', $suite)->update(['libera_pagamento' => '1']);
        return response()->json(['msg' => 'Função pagamento bloqueada para o cliente!', 'status' => '1']);
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                //Auth::logoutOtherDevices($request->password);
                if (Auth::user()->type_user == '1') {
                    return redirect()->intended('/admin/dashboard');
                } else {
                    session(['suite_prefix' => 'CB#']);
                    return redirect()->intended(route('home'));
                }
            } else {
                return redirect(route('login'))->with('login-err', 'Usuario ou senha inválidos. Tente novamente.');
            }
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function logout()
    {
        try {
            session()->flush();
            Auth::logout();
            return redirect('/');
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function perfil($id)
    {
        try {
            $perfil = Pessoa::find($id);
            $perfil_endereco = Enderecos::where('codigo_suite', $id)->get();
            $perfil_contato = PessoaContato::where(['codigo_suite' => $id])->get();
            $estado_civil = DB::table('bxby_estado_civil')->get();
            $data = DB::table('bxby_pconfirma_dados')->where(['codigo_suite' => Auth::user()->codigo_suite])->get();

            return view('usuario.meuperfil', ['perfil' => $perfil,
                'perfil_endereco' => $perfil_endereco,
                'contato' => $perfil_contato,
                'estado_civil' => $estado_civil,
                'data' => $data]);
        } catch (QueryException $e) {
            return CustomException::trataErro($e);
        }
    }

    public function perfilEdit($id)
    {
        try {
            $perfil = Pessoa::find($id);
            $perfil_endereco = Enderecos::where('codigo_suite', $id)->get();
            $perfil_contato = PessoaContato::where(['codigo_suite' => $id])->get();
            $estado_civil = DB::table('bxby_estado_civil')->get();
            $data = DB::table('bxby_pconfirma_dados')->where(['codigo_suite' => Auth::user()->codigo_suite])->get();
            $enable_pay = DB::table('bxby_pconfirma_dados')
                ->select('libera_pagamento')
                ->where('codigo_suite', Auth::user()->codigo_suite)
                ->get();

            return view('usuario.perfiledit', [
                'perfil' => $perfil,
                'perfil_endereco' => $perfil_endereco,
                'contato' => $perfil_contato,
                'estado_civil' => $estado_civil,
                'data' => $data,
                'enable_pay' => $enable_pay
            ]);
        } catch (QueryException $e) {
            return CustomException::trataErro($e);
        }
    }

    public function atualizar(Request $request, $id)
    {
        try {
            if ($request->nova_senha != '' && $request->nova_senha == $request->confirma_nova_senha) {
                $pass = Hash::make($request->input('nova_senha'));
                $update_pass = "update bxby_pessoas set password = '$pass' where codigo_suite = '$id'";
                DB::update($update_pass);
            } else {
                $pass = '';
            }

            $dataformat = date('Y-m-d', strtotime($request->data_nascimento));
            DB::update("UPDATE bxby_pessoas 
                        SET nome_completo = '$request->_nome',                            
                            data_nascimento = '$dataformat',
                            sexo = '$request->sexo',
                            email = '$request->email',                            
                            cpf_cnpj = '$request->cpf_cnpj',
                            rg_ie = '$request->rg_ie',
                            estado_civil = '$request->estado_civil'
                            where codigo_suite = $id");

            DB::update("UPDATE bxby_pcontato 
                                        SET telefone = '$request->telefone',
                                            celular = '$request->celular',
                                            telefone_01 = '$request->telefone_01',
                                            celular_01 = '$request->celular_01'
                                        WHERE CODIGO_SUITE = $id");

            return response()->json(['msg' => 'Registro atualizado com sucesso!', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function uploadImgPerfil(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $filename = str_random(30) . '.' . $request->file('file')->getClientOriginalExtension();

                $user_folder = 'foto_perfil_' . $request->id;

                if (Storage::allFiles($user_folder) == []) {
                    $path = $request->file('file')->storePubliclyAs($user_folder, $filename);
//                    DB::table('bxby_pessoas')->where('codigo_suite', $request->id)->update(['caminho_foto_perfil' => $path]);
                    DB::table('bxby_pessoas')
                        ->where('codigo_suite', $request->id)
                        ->update(['caminho_foto_perfil' => Storage::url($path)]);
                } else {
                    $files = Storage::files($user_folder);
                    if (count($files) != 0) {
                        Storage::delete($files[0]);
                        $path = $request->file('file')->storePubliclyAs($user_folder, $filename);

                        DB::table('bxby_pessoas')
                            ->where('codigo_suite', $request->id)
                            ->update(['caminho_foto_perfil' => Storage::url($path)]);
                    }
                }
            }

//            return response()->json(['msg' => 'Foto inserida com sucesso!', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function uploadDocRG(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $filename = uniqid('DOC_RG_', true) . '.' . $request->file('file')->clientExtension();

                $user_folder = 'docs_perfil_' . $request->id;
                if(!is_dir($user_folder)) {
                    Storage::disk('s3')->makeDirectory($user_folder);
                }

                if (Storage::allFiles($user_folder) == []) {
                    $path = $request->file('file')->storePubliclyAs($user_folder, $filename);
                    DB::table('bxby_pconfirma_dados')
                        ->where('codigo_suite', $request->id)
                        ->update(['caminho_rg' => Storage::url($path)]);
                } else {
                    $files = Storage::files($user_folder);
                    if (count($files[0]) != 0) {
                        Storage::delete($files[0]);
                        $path = $request->file('file')->storePubliclyAs($user_folder, $filename);
                        DB::table('bxby_pconfirma_dados')
                            ->where('codigo_suite', $request->id)
                            ->update(['caminho_rg' => Storage::url($path)]);
                    }
                }
            }

            return response()->json(['msg' => 'Documento cadastrado com sucesso', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function uploadDocComprovante(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $filename = uniqid('DOC_COMPROVANTE_', true) . '.' . $request->file('file')->clientExtension();

                $user_folder = 'docs_perfil_' . $request->id;

                if(!is_dir($user_folder))
                {
                    Storage::disk('s3')->makeDirectory($user_folder);
                }

                if (Storage::allFiles($user_folder) == []) {
                    $path = $request->file('file')->storePubliclyAs($user_folder, $filename);
                    DB::table('bxby_pconfirma_dados')
                        ->where('codigo_suite', $request->id)
                        ->update(['caminho_comprovante' => Storage::url($path)]);
                } else {
                    $files = Storage::files($user_folder);
                    if (count($files[0]) != 0) {
                        Storage::delete($files[0]);
                        $path = $request->file('file')->move($destination, $filename);
                        DB::table('bxby_pconfirma_dados')
                            ->where('codigo_suite', $request->id)
                            ->update(['caminho_comprovante' => Storage::url($path)]);
                    }
                }
            }

            return response()->json(['msg' => 'Documento cadastrado com sucesso', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function removeDocRG($id)
    {
        $rgpath = DB::table('bxby_pconfirma_dados')->select(['caminho_rg'])->where('codigo_suite', $id)->get();

        Storage::delete($rgpath[0]->caminho_rg);
        DB::table('bxby_pconfirma_dados')
            ->where('codigo_suite', $id)
            ->update(['caminho_rg' => '']);
        return response()->json(['msg' => 'Documento removido com sucesso.']);
    }

    public function removeDocComprovante($id)
    {
        $rgpath = DB::table('bxby_pconfirma_dados')->select(['caminho_comprovante'])->where('codigo_suite', $id)->get();
        $filetoremove = public_path() . $rgpath[0]->caminho_rg;
        unlink($filetoremove);
        DB::table('bxby_pconfirma_dados')->where('codigo_suite', $id)->update(['caminho_comprovante' => '']);
        return response()->json(['msg' => 'Documento removido com sucesso.']);
    }

    public function resetToken()
    {
        try {
            $token_reset = uniqid('', true);
            return $token_reset;
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function sendEmailReset(Request $request)
    {
        try {
            $token_reset = $this->resetToken();
            $user_id = DB::table('bxby_pessoas')->select(['codigo_suite'])->where('email', $request->input('email-esqueci'))->get();

            ConfirmaDados::updateOrCreate(
                ['codigo_suite' => $user_id[0]->codigo_suite],
                ['token_troca' => $token_reset, 'data_cadastro' => new Carbon()]
            );

            Mail::to($request->input('email-esqueci'))->send(new SendResetPassword($token_reset, $user_id[0]->codigo_suite));
            return redirect()->route('login')->with('reset-msg', 'E-mail de Redefinição de senha enviado com sucesso!');
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function viewResetForm($token, $id)
    {
        try {
            $token_troca = DB::table('bxby_pconfirma_dados')
                ->select(['token_troca'])
                ->where('codigo_suite', $id)
                ->get();

            if ($token == $token_troca[0]->token_troca) {
                return view('emails.formReset', ['token' => $token, 'userid' => $id]);
            }
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            DB::table('bxby_pconfirma_dados')
                ->where('codigo_suite', $request->input('id'))
                ->update(['troca_senha' => '1']);

            $token_troca_db = DB::table('bxby_pconfirma_dados')
                ->select(['token_troca', 'troca_senha'])
                ->where('codigo_suite', $request->id)
                ->get();
            //return $token_troca_db[0]->token_troca;
            if ($request->input('token_senha') == $token_troca_db[0]->token_troca && $token_troca_db[0]->troca_senha == '1') {
                if ($request->password == $request->confirm_password) {
                    DB::table('bxby_pessoas')
                        ->where('codigo_suite', $request->id)
                        ->update(['password' => password_hash($request->password, PASSWORD_BCRYPT)]);

                    DB::table('bxby_pconfirma_dados')
                        ->where('codigo_suite', $request->input('id'))
                        ->update(['token_troca' => '', 'troca_senha' => '2']);

                    return redirect()->route('login')->with('reset-msg', 'Senha alterada com sucesso com sucesso!');
                }
            }
        } catch (QueryException $e) {
            return CustomException::trataErro($e);
        }
    }

    public function price()
    {
        try {
            return view('usuario.calculadora');
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function getFrete(Request $request)
    {
        return UspsTest::calculate($request);
    }

    public function clearFrete()
    {
        session()->forget('frete');
        return response()->json(['msg' => 'Sessão limpa']);
    }

    public function destroy($id)
    {
        PessoaContato::where('codigo_suite', $id)->delete();
        Enderecos::where('codigo_auite', $id)->delete();
        Pessoa::find($id)->delete();
    }

    public function dolarTest()
    {
        try {
            return CotacaoDolar::getDolar();
        } catch (Exception $e) {
            return CustomException::trataErroGeral($e);
        }

    }
}
