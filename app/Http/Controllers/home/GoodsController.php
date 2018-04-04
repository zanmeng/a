<?php

namespace App\Http\Controllers\home;

use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    //商品详情页面处理
    public function detail()
    {

    //拿到商品列表传来gid数据
        $gid = 5;
//        $login_id = session()->get('user')->login_id;
    //goods表与version表联查(多对多),取得数据
        $good = Goods::with('Version') -> where('gid',$gid) -> first();
//        dd($good);
    //goods表与good_color表联查(多对多),取得数据
        $color = Goods::with('Color') -> where('gid',$gid) -> first();
//        dd($color);
    //引入列表详情页面并且将数据随同页面发往
    return view('home.detail',['good'=>$good],['color'=>$color]);

    }

}
