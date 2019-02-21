<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $primaryKey = "seq_produto";
    protected $table = 'bxby_produtos_estoque';
    protected $dates = ['data_compra', 'data_chegada'];
    // const CREATED_AT = 'data_cadastro';
    // const UPDATED_AT = 'data_atualizacao';
    public $timestamps = false;

    public function fotos()
    {
        return $this->hasMany(EstoqueImagem::class, 'codigo_produto', 'seq_produto');
    }
}
