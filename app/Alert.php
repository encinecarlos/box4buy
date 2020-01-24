<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = 'bxby_alerts';
    protected $primaryKey = 'sequencia';
    protected $dates = ['expires_at'];
    protected $fillable = ['title', 'description', 'expires_at'];
}
