<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrcamentoProduto extends Model
{
    protected $table = 'bxby_orcamento_produto';
    protected $primaryKey = 'sequencia';
    protected $dates = ['dias_estoque'];
    // public $timestamps = false;

    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class, 'codigo_orcamento');
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'codigo_produto', 'seq_produto');
    }

    public function fotos()
    {
        return $this->hasMany(EstoqueImagem::class, 'codigo_produto', 'seq_imagem');
    }
}
