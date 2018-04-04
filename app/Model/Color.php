<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    public $table='good_color';
    public $primaryKey='colorId';
    public $timestamps=false;
    public $guarded=[];

    public function Goods()
    {
        return $this->belongsToMany('App\Model\Goods','goodforcolor','colorId','gid');
    }
}
