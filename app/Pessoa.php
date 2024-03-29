<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;


class Pessoa extends Model
{
    use Messagable;
    use Notifiable;

    protected $table = 'bxby_pessoas';
    protected $primaryKey = "codigo_suite";
    public $timestamps = false;
    /*const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = 'data_atualizacao';*/

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
