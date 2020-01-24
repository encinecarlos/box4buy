<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'bxby_partner';
    protected $primaryKey = 'sequencia';
    public $timestamps = false;

    public function Categoria()
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id', 'sequencia');
    }
}
