<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    public $table = 'good_version';
    public $primaryKey =  'vid';
    public $timestamps = false;
    public $guarded = [];

    public function Goods()
    {
        return $this->belongsToMany('App\Model\Goods','goodforversion','vid','gid');
    }
}
