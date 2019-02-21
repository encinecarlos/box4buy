<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'bxby_pessoas';
    protected $primaryKey = "codigo_suite";
    public $timestamps = false;


    protected $fillable = [
        'nome_completo', 'email', 'password',
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function enderecos()
    {
        return $this->hasMany(Enderecos::class, 'codigo_suite', 'codigo_suite');
    }

    public function contatos()
    {
        return $this->hasOne(PessoaContato::class, 'codigo_suite', 'codigo_suite');
    }
}
