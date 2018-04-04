<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

//    1. 模型关联的数据表
    public $table = 'user';

//    2. 主键
    public $primaryKey = 'userId';

//    3. 是否维护created_at updated_at字段
    public $timestamps = false;

//    4. 是否允许批量操作字段
    public $guarded = [];

    // 定义跟角色模型关联的属性
    public function role()
    {
        return $this->belongsToMany('App\Model\Role','user_role','userId','roleId');
    }
}

