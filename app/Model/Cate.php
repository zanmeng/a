<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //


    public $table='cats';
    public $primaryKey='catId';
    public  $timestamps=false;
    public  $guarded=[];

    //    关联Good模型的动态属性 1对多
    public function good()
    {
        return $this->hasMany('App\Model\Goods','tid','catId');
    }


}
