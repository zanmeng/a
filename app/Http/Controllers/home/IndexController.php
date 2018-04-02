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
        $res=Cate::with('good')->get();
        return view('home.index',compact('res'));
    }

    //搜索框
    public function sousuo(Request $request)
    {
        $input=$request->input('gname');
//        dd($input);
        if(empty($input)){
           return redirect('/home/index');
        }

        $goods=Goods::where( 'gname', 'like',$input)->get();
        return view('home.sousuo',compact('goods','input'));
    }


    //分类列表详情
    public function liebiao($id)
    {
        $res=Cate::with('good')->where('catId',$id)->get();
        return view('home.fenleiLiebiao',compact('res'));
    }

    //退出登录
    public function logout()
    {
        session()->forget('user');
        return redirect('home/index');
    }
}
