<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\UserRequest;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pessoa;
use App\ConfirmaDados;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Usuario;
use Illuminate\Database\QueryException;
use App\Mail\SendResetPassword;
use App\Lib\CustomException;
use App\Lib\UspsTest;
use Carbon\Carbon;
use App\Facades\CotacaoDolar;
use App\Http\Requests\UserAdminRequest;

class UsuarioController extends Controller
{
    private $userService;

    public function __construct(UsuarioService $service)
    {
        $this->userService = $service;
    }

    public function renderHome()
    {
        return $this->userService->getAll();
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

    /**
     * cadastra um usuario no sistema
     * @param UserAdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cadastrar(UserRequest $request)
    {
        try {
            $this->userService->create($request->all());

            return response()->json(['msg' => 'Cadastro efetuado com sucesso!', 'status' => '1']);
        } catch (QueryException $e) {
            return CustomException::trataErro($e);
        }
    }


    public function enablePayment($suite)
    {
        DB::table('bxby_pconfirma_dados')->where('codigo_suite', $suite)->update(['libera_pagamento' => '2']);
        return response()->json(['msg' => 'Função pagamento liberada para o cliente!', 'status' => '1']);
    }

    public function disablePayment($suite)
    {
        DB::table('bxby_pconfirma_dados')->where('codigo_suite', $suite)->update(['libera_pagamento' => '1']);
        return response()->json(['msg' => 'Função pagamento bloqueada para o cliente!', 'status' => '1']);
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                //Auth::logoutOtherDevices($request->password);
                if (Auth::user()->type_user == '1' || Auth::user()->type_user == '3') {
                    /*Pessoa::where('type_user', '1')
                        ->orWhere('type_user', '3')
                        ->update(['ip_access' => $request->ip()]);*/

                    return redirect()->intended('/admin/dashboard');

                } else {
                    session(['suite_prefix' => 'CB']);
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
            if (session('suite_prefix')) {
                session()->forget('suite_prefix');
            }

            Auth::logout();
            return redirect('/');
        } catch (\Exception $ex) {
            return CustomException::trataErroGeral($ex);
        }
    }

    public function perfil($id)
    {
        return $this->userService->showById($id);
    }

    public function perfilEdit($id)
    {
        return $this->userService->getById($id);
    }

    public function atualizar(Request $request, $id)
    {
        try {
            /*if ($request->nova_senha != '' && $request->nova_senha == $request->confirma_nova_senha) {
                $pass = Hash::make($request->input('nova_senha'));
                $update_pass = "update bxby_pessoas set password = '$pass' where codigo_suite = '$id'";
                DB::update($update_pass);
            } else {
                $pass = '';
            }

            $dataformat = date('Y-m-d', strtotime($request->data_nascimento));
            DB::update("UPDATE bxby_pessoas
                        SET nome_completo = '$request->_nome',
                            sobrenome = '$request->_sobrenome',
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
                                        WHERE CODIGO_SUITE = $id");*/

            $this->userService->update($request->all(), $id);
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
            $this->userService->uploadIdentification($request->all());

            return response()->json(['msg' => 'Documento cadastrado com sucesso', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function uploadDocComprovante(Request $request)
    {
        try {
            $this->userService->proofAddress($request->all());
            return response()->json(['msg' => 'Documento cadastrado com sucesso', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function removeDocRG($id)
    {
        $file_directory = 'docs_perfil_'.$id;
        $rgpath = ConfirmaDados::select(['file_id'])->where('codigo_suite', $id)->get();
        debugbar()->info($rgpath);

        Storage::delete($file_directory.DIRECTORY_SEPARATOR.$rgpath[0]->file_id);
        ConfirmaDados::where('codigo_suite', $id)
            ->update(['caminho_rg' => null, 'file_id' => null]);
        return response()->json(['msg' => 'Documento removido com sucesso.']);
    }

    public function removeDocComprovante($id)
    {
        $file_directory = 'docs_perfil_'.$id;
        $docpath = ConfirmaDados::select(['file_address'])->where('codigo_suite', $id)->get();
        debugbar()->info($docpath);

        Storage::delete($file_directory.DIRECTORY_SEPARATOR.$docpath[0]->file_address);
        ConfirmaDados::where('codigo_suite', $id)
            ->update(['caminho_comprovante' => null, 'file_address' => null]);
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
        $this->userService->delete($id);
    }

    public function dolarTest()
    {
        try {
            return CotacaoDolar::getDolar();
        } catch (Exception $e) {
            return CustomException::trataErroGeral($e);
        }

    }

    public function rastreiaPacote($tracknumber)
    {
        return UspsTest::rastrearPacote($tracknumber);
    }
}
