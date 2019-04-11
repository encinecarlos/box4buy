<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int status_solicitacao
 * @property \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed codigo_suite
 * @property \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed observacoes
 * @property mixed produtos
 * @property mixed usuario
 */
class CompraAssistidaInfo extends Model
{
    protected $table = 'bxby_compra_assistida_info';
    protected $primaryKey = 'sequencia';
    protected $fillable = [
        'status_solicitacao',
        'frete_loja',
        'taxas',
        'taxa_servico',
        'total_produtos',
        'total_compra',
        'obervacoes'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'suite_id', 'codigo_suite');
    }

    public function produtos()
    {
        return $this->hasMany(CompraAssistida::class, 'compra_id', 'sequencia');
    }
}
