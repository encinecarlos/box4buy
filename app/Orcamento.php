<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orcamento extends Model
{
    use SoftDeletes;

    protected $table = 'bxby_orcamento';
    protected $primaryKey = "sequencia";
    protected $dates = ['data_envio'];
    protected $with = ['orcamento_produtos'];
    
    public function produtos()
    {
        return $this->hasMany(Estoque::class, 'codigo_produto', 'seq_produto');
    }

    public function orcamento_produtos()
    {
        return $this->hasMany(OrcamentoProduto::class, 'codigo_orcamento', 'sequencia');
    }
}
