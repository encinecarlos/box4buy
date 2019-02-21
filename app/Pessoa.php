<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cmgmyr\Messenger\Traits\Messagable;


class Pessoa extends Model
{
    use Messagable;
    
    protected $table = 'bxby_pessoas';
    protected $primaryKey = "codigo_suite";
    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';

    public function estadoCivil()
    {
        return $this->hasOne(EstadoCivil::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);        
    }
}
