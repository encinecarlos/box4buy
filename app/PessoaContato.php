<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaContato extends Model
{
    protected $table = 'bxby_pcontato';
    protected $primaryKey = "codigo_suite";
    public $timestamps = false;

    protected $fillable = [
        'telefone',
        'telefone_01',
        'celular',
        'celular_01',
    ];
}
