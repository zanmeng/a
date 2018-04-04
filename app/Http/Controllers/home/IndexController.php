<?php

namespace App\Http\Controllers\home;



use App\Model\Cate;
use App\Model\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class IndexController extends Controller
{

    //首页显示
    public function index()
    {
        //类下的商品
        $res=Cate::with('good')->get();
        //所有商品
        $good=Goods::get();
//        dd($good);
        return view('home.index',compact('res','good'));
    }

    //搜索框
    public function sousuo(Request $request)
    {
        $input=$request->input('gname');
//        dd($input);
        if(empty($input)){
           return redirect('/home/index');
        }
        $res=Cate::with('good')->get();
        $goods=Goods::where( 'gname', 'like','%'.$input.'%')->get();
        return view('home.sousuo',compact('goods','input','res'));
    }


    //分类列表详
    public function liebiao($id)
    {
        $ress=Cate::with('good')->where('catId',$id)->get();
        $res=Cate::with('good')->get();
        return view('home.fenleiLiebiao',compact('res','ress'));

    }

    //退出登录
    public function logout()
    {
        session()->forget('user');
        return redirect('home/index');
    }
}
