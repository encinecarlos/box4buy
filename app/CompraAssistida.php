<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraAssistida extends Model
{
    protected $table = 'bxby_compra_assistida';
    protected $primaryKey = 'sequencia';

    protected $fillable = [
        'codigo_suite',
        'link_produto',
        'cor',
        'tamanho',
        'preco',
        'quantidade',
        'observacao',
        'substitui_tamanho',
        'substitui_cor',
        'fora_estoque',
        'observacoes_adicionais'
    ];
}
