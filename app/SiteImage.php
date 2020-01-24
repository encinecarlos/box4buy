<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $table = 'bxby_site_images';
    public $timestamps = false;

    protected $fillable = ['config_id', 'home_image'];
}
