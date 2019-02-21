<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaContato extends Model
{
    protected $table = 'bxby_pcontato';
    protected $primaryKey = "codigo_suite";
    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';
}
