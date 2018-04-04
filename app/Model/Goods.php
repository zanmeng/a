<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    public $table='goods';
    public $primaryKey='gid';
    public $timestamps=false;
    public $guarded=[];

    //与模型表Version多对多关联
    public function Version()
    {
        return $this->belongsToMany('App\Model\Version','goodforversion','gid','vid');
    }

    //与模型表Color多对多关联
    public function Color()
    {
        return $this->belongsToMany('App\Model\Color','goodforcolor','gid','colorId');
    }

}
