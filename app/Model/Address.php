<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    public $table='address';
    public $primaryKey='aid';
    public  $timestamps=false;
    public  $guarded=[];
}
