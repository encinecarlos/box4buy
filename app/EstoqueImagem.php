<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstoqueImagem extends Model
{
    protected $table = "bxby_produtos_imagem";
    protected $primaryKey = 'seq_imagem';
    protected $dates = ['data_cadastro'];
    public $timestamps = false;

    public function produto()
    {
        return $this->belongsTo(Estoque::class, 'codigo_produto', 'seq_produto');
    }
}
