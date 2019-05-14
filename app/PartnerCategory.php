<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    protected $table = 'bxby_partner_category';
    protected $primaryKey = 'sequencia';
    public $timestamps = false;

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

}
