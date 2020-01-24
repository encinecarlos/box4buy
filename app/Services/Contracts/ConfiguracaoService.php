<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 7/2/19
 * Time: 9:35 AM
 */

namespace App\Services\Contracts;

use App\Configuration;
use App\Status;

class ConfiguracaoService
{
    public function render()
    {
        $status = Status::all();
        $configs = Configuration::find(1);
        return view('configuracoes.main', ['status' => $status, 'configs' => $configs]);
    }

    public function save(array $attributes)
    {
        $data_update = [
            'cfg_address' => $attributes['cfg_address'],
            'cfg_city' => $attributes['cfg_city'],
            'cfg_state' => $attributes['cfg_state'],
            'cfg_zipcode' => $attributes['cfg_zipcode'],
            'cfg_phone' => $attributes['cfg_phone'],
            'cfg_taxa_01' => $attributes['taxa01'],
            'cfg_taxa_02' => $attributes['taxa02'],
            'cfg_taxa_03' => $attributes['taxa03'],
            'cfg_main_text' => $attributes['descricao_banner'],
            'cfg_faq' => $attributes['message']
        ];

        Configuration::where('sequencia', '1')->update($data_update);

        return response('Configurações salvas com sucesso!');
    }

    public function passGenerator()
    {
        $random_Pass = str_replace(".", "", substr(uniqid('', true), 0, 8));
        return response()->json(['password' => $random_Pass]);
    }


}
