<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{


    //  1. 模型关联的数据表
    public $table = 'orders';

//    2. 主键
    public $primaryKey = 'orderId';

//    3. 是否维护created_at updated_at
    public $timestamps = false;

//    4. 是否允许批量操作字段
    public $guarded = [];

    //关联user_login模型的动态属性
    public function homeUser()
    {
//        return $this->hasOne(要关联的模型，外键，当前模型的主键);
        return $this->hasOne('App\Model\homeUser','login_id','orderId');
    }



}
