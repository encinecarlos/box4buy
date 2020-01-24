<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmaDados extends Model
{
    protected $table = 'bxby_pconfirma_dados';
    protected $primaryKey = "codigo_suite";
    protected $fillable = [
                           'seq_pconfirma',
                           'codigo_suite',
                           'token_email',
                           'libera_pagamento',
                           'caminho_rg',
                           'caminho_comprovante',
                           'troca_senha',
                           'token_troca',
                           'data_cadastro',
                          ];
    //const CREATED_AT = 'data_cadastro';
    //const UPDATED_AT = 'data_atualizacao';
    public $timestamps = false;
}
