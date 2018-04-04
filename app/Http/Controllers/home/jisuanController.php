<?php

namespace App\Http\Controllers\home;

use App\Model\Carts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class jisuanController extends Controller
{
    //商品加
    public function jia(Request $request)
    {
        $id = $request->id;
        $res = Carts::where('id', $id)->increment('num', 1);
        return $res;
    }

    //商品减
    public function jian(Request $request)
    {
        $id = $request->id;
        $a = Carts::where('id', $id)->where('num', '>', 0)->first();
//        dd($a);
        if ($a) {
            Carts::where('id', $id)->decrement('num', 1);
            return 1;
        } else {
            return 0;
        }

    }

    public function jiaodian(Request $request)
    {
        $id = $request->id;
        $val = $request->val;

        $a = Carts::where('id', $id)->update(['num'=>$val]);
        if ($a) {
            return 1;
        } else {
            return 0;
        }
    }
}
