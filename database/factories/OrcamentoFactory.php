<?php

use Faker\Generator as Faker;
use App\Orcamento;

$factory->define(Orcamento::class, function (Faker $faker) {
    return [
        'codigo_suite' => 19,
        'codigo_pacote' => 1,
        'seguro' => 1,
        'cod_reastreio' => $faker->str_random(20),
        'cod_endereco' => 1,
        'peso_total' => $faker->randomFloat(66, 8, 2),
        'vlr_entrega' => $faker->randomFloat(100, 8, 2),
        'vlr_seguro' => $faker->randomFloat(100, 8, 2),
        'vlr_taxa' => $faker->randomFloat(100, 8, 2),
        'vlr_declarado' => $faker->randomFloat(100, 8, 2),
        'recebe_nota' => 2,
        'preco_etiqueta' => 2,
        'recebe_propaganda' => 2,
        'caixas_originais' => 2,
        'sacolas_originais' => 2,        
    ];
});
