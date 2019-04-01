<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int status_solicitacao
 * @property \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed codigo_suite
 */
class CompraAssistidaInfo extends Model
{
    protected $table = 'bxby_compra_assistida_info';
    protected $primaryKey = 'sequencia';
    protected $fillable = ['status_solicitacao'];
}
