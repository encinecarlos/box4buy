<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $table = 'bxby_orcamento';
    protected $primaryKey = "sequencia";
    
    public function Produtos()
    {
        return $this->hasMany(Estoque::class, 'codigo_produto', 'seq_produto');
    }
}
