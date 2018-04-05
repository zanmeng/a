<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //
    public $table='carts';
    public $primaryKey='cartId';
    public  $timestamps=false;
    public  $guarded=[];
    public function Goods()
    {
        return $this->belongsToMany('App\Model\Goods','cartforgood','cartId','gid');
    }

    public function homeUser()
    {
        return $this->belongsToMany('App\Model\homeUser','homeuserforcart','cartId','login_id');
    }

}
