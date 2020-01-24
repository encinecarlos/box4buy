<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 6/12/19
 * Time: 11:05 AM
 */

namespace App\Services;


use App\Configuration;
use App\ConfirmaDados;
use App\Enderecos;
use App\Lib\CustomException;
use App\Mail\SendConfirmation;
use App\Pessoa;
use App\PessoaContato;
use App\Services\Contracts\ServiceInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UsuarioService implements ServiceInterface
{
    private $alerts;

    public function __construct(AlertService $alertService)
    {
        $this->alerts = $alertService;
    }

    public function getAll()
    {
        $configs = Configuration::find(1);
        $enable_pay = DB::table('bxby_pconfirma_dados')
            ->select('libera_pagamento')
            ->where('codigo_suite', Auth::user()->codigo_suite)
            ->get();

        $news = $this->alerts->orderRecords('sequencia', 'desc');

        return view('usuario.home', ['configs' => $configs, 'enable_pay' => $enable_pay, 'novidades' => $news]);
    }

    public function getById($id)
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

    public function showById($id)
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

    public function create(array $attributes)
    {
        $data = [
            'nome_completo' => $attributes['_nome'],
            'sobrenome' => $attributes['_sobrenome'],
            'email' => $attributes['email'],
            'password' => password_hash($attributes['password'], PASSWORD_BCRYPT),
            'type_user' => key_exists('type_user', $attributes) ? $attributes['type_user'] : '2',
        ];
        $user = User::create($data);
        debugbar()->debug($user->codigo_suite);
        debugbar()->debug($attributes);
        $data_confirm = [
            'codigo_suite' => $user->codigo_suite,
            'libera_pagamento' => 1,
            'data_cadastro' => new Carbon()
        ];
        ConfirmaDados::create($data_confirm);
        Mail::to($attributes['email'])->send(new SendConfirmation($user->codigo_suite, $data['email']));
    }

    public function update(array $attributes, $id)
    {
        try {
            if ($attributes['nova_senha'] != '' && $attributes['nova_senha'] == $attributes['confirma_nova_senha']) {
                $pass = password_hash($attributes['nova_senha'], PASSWORD_BCRYPT);
//                $update_pass = "update bxby_pessoas set password = '$pass' where codigo_suite = '$id'";
                Pessoa::where('codigo_suite', $id)->update(['password' => $pass]);
            } else {
                $pass = '';
            }

            $dataformat = date('Y-m-d', strtotime($attributes['data_nascimento']));

            $data = [
                'nome_completo'   => $attributes['_nome'],
                'sobrenome'       => $attributes['_sobrenome'],
                'data_nascimento' => $dataformat,
                'sexo'            => $attributes['sexo'],
                'email'           => $attributes['email'],
                'cpf_cnpj'        => $attributes['cpf_cnpj'],
                'rg_ie'           => $attributes['rg_ie'],
                'estado_civil'    => $attributes['estado_civil']
            ];

            $data_contato = [
                'telefone'    => $attributes['telefone'],
                'celular'     => $attributes['celular'],
                'telefone_01' => $attributes['telefone_01'],
                'celular_01'  => $attributes['celular_01']
            ];

            Pessoa::where('codigo_suite', $id)->update($data);

            PessoaContato::updateOrCreate(['codigo_suite' => $id], $data_contato);


            return response()->json(['msg' => 'Registro atualizado com sucesso!', 'status' => '1']);
        } catch (QueryException $ex) {
            return CustomException::trataErro($ex);
        }
    }

    public function delete($id)
    {
        PessoaContato::where('codigo_suite', $id)->delete();
        Enderecos::where('codigo_auite', $id)->delete();
        Pessoa::find($id)->delete();
    }

    public function uploadIdentification(array $attributes)
    {
        if (key_exists('file', $attributes)) {
            $filename = 'identification' . '.' . $attributes['file']->clientExtension();

            $user_folder = 'docs_perfil_' . $attributes['id'];
            if(!is_dir($user_folder)) {
                Storage::disk('s3')->makeDirectory($user_folder);
            }

            if (Storage::allFiles($user_folder) == []) {
                $path = $attributes['file']->storePubliclyAs($user_folder, $filename);
                ConfirmaDados::where('codigo_suite', $attributes['id'])
                    ->update(['caminho_rg' => Storage::url($path), 'file_id' => $filename]);
            } else {
                /*$files = Storage::files($user_folder);
                if (count($files[0]) > 0) {
                    Storage::delete($files[0]);
                    $path = $attributes['file']->storePubliclyAs($user_folder, $filename);
                    ConfirmaDados::where('codigo_suite', $attributes['id'])
                        ->update(['caminho_rg' => Storage::url($path)]);
                }*/
                Storage::delete($user_folder.DIRECTORY_SEPARATOR.$filename);
                $path = $attributes['file']->storePubliclyAs($user_folder, $filename);
                ConfirmaDados::where('codigo_suite', $attributes['id'])
                    ->update(['caminho_rg' => Storage::url($path), 'file_id' => $filename]);
            }
        }
    }
    
    public function proofAddress(array $attributes)
    {
        if (key_exists('file', $attributes)) {
            $filename = 'address' . '.' . $attributes['file']->clientExtension();

            $user_folder = 'docs_perfil_' . $attributes['id'];

            if(!is_dir($user_folder))
            {
                Storage::disk('s3')->makeDirectory($user_folder);
            }

            if (Storage::allFiles($user_folder) == []) {
                $path = $attributes['file']->storePubliclyAs($user_folder, $filename);
                ConfirmaDados::where('codigo_suite', $attributes['id'])
                    ->update(['caminho_comprovante' => Storage::url($path), 'file_address' => $filename]);
            } else {
//                $files = Storage::files($user_folder);

                Storage::delete($user_folder.DIRECTORY_SEPARATOR.$filename);
                $path = $attributes['file']->storePubliclyAs($user_folder, $filename);
                ConfirmaDados::where('codigo_suite', $attributes['id'])
                    ->update(['caminho_comprovante' => Storage::url($path), 'file_address' => $filename]);

                /*if (count($files[0]) > 0) {
                    Storage::delete($files[0]);
                    $path = $attributes->file('file')->storePubliclyAs($user_folder, $filename);
                    ConfirmaDados::where('codigo_suite', $attributes['id'])
                        ->update(['caminho_comprovante' => Storage::url($path)]);
                }*/
            }
        }
    }
}
