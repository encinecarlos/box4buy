<?php

namespace App\Http\Controllers\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\Configuration;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $status = Status::all();
        $configs = Configuration::find(1);
        return view('configuracoes.main', ['status' => $status, 'configs' => $configs]);
    }

    public function update(Request $request)
    {
        $data_update = [
                'cfg_name' => $request->cfg_name,
                'cfg_address' => $request->cfg_address,
                'cfg_city' => $request->cfg_city,
                'cfg_state' => $request->cfg_state,
                'cfg_zipcode' => $request->cfg_zipcode,
                'cfg_phone' => $request->cfg_phone,
        ];

        Configuration::where('sequencia', '1')->update($data_update);
        return redirect(route('configuracoes'))->with(['msg' => 'Configurações alteradas com sucesso!']);
    }

    public function generatePassword()
    {
        $random_Pass = str_replace(".", "", substr(uniqid('', true), 0, 8));
        return response()->json(['password' => $random_Pass]);
    }
}
