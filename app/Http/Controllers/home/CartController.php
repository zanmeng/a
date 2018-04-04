<?php

namespace App\Http\Controllers\home;

use App\Model\Cartforgood;
use App\Model\Carts;
use App\Model\Cate;
use App\Model\Color;
use App\Model\Goodforversion;
use App\Model\Goods;
use App\Model\homeUser;
use App\Model\User;
use App\Model\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use test\Mockery\MockingVariadicArgumentsTest;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //用户Id
        $login_id = $request->login_id;
        //通过userId查询cartId 及其中的内容
        $utc = Carts::with('homeUser')->where('cartId',$login_id)->get();
//        dd($utc);
        //遍历购物车
        $gid = [];
        $vid = [];
        $colorId = [];
        $num = [];
        $id= [];
        foreach($utc as $k=>$v){
            $gid[].=$v->gid;
            $vid[].=$v->vid;
            $colorId[].=$v->colorId;
            $num[].=$v->num;
            $id[].=$v->id;
        }

        //通过gid去商品详情表查出商品名称 商品单价 商品图片
        $gname = [];
        $price = [];
        $gpic = [];
        foreach($gid as $gk=>$gv){
            $gInformation = DB::table('goods')->where('gid',$gv)->first();
            $gname[] .= $gInformation->gname;
            $price[] .= $gInformation->price;
            $gpic[] .= $gInformation->gpic;
        };

        //通过vid去版本表查出版本名称
        $vname = [];
        foreach($vid as $vk=>$vv){
            $vInformation = DB::table('good_version')->where('vid',$vv)->first();
            $vname[] .= $vInformation->version;
        };

        //通过colorId去颜色表查出颜色
        $cname = [];
        foreach($colorId as $ck=>$cv){
            $cInformation = DB::table('good_color')->where('colorId',$cv)->first();
            $cname[] .= $cInformation->color;
        }


        //将多个一维数组合并为新的数组$gmax
        $gmax = [];
        foreach($gpic as $k=>$v){

            $gmax[$k]['gpic'] = $gpic[$k];
            $gmax[$k]['gname'] = $gname[$k];
            $gmax[$k]['vname'] = $vname[$k];
            $gmax[$k]['cname'] = $cname[$k];
            $gmax[$k]['price'] = $price[$k];
            $gmax[$k]['gid'] = $gid[$k];
            $gmax[$k]['num'] = $num[$k];
            $gmax[$k]['id'] = $id[$k];
        }
//        dd($gmax);
        return view('home.Cart',['gmax'=>$gmax]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $good = $request->all();
//        dd($good);
        //假设用户1登陆
        $login_id = 1;
//        $login_id = session()->get('user')->login_id;
        //判断相同型号形同版本的商品购物车是否存在
        $ex = DB::table('carts')->where('gid',$good['gid'])
                                ->where('vid',$good['vid'])
                                ->where('colorId',$good['colorId'])
                                ->first();
        //如果存在就让num自增1
        if($ex){
            DB::table('carts')->where('gid',$good['gid'])
                              ->where('vid',$good['vid'])
                              ->where('colorId',$good['colorId'])
                              ->increment('num',1);
            $arr=['status'=>1, 'msg'=>'成功'];
            return $arr;
        }else{
            //提交至购物车 往carts和Cartforgood表中自动添加信息
            $res = Carts::create(['gid'=>$good['gid'], 'login_id'=>$login_id, 'cartId'=>$login_id,'vid'=>$good['vid'],'colorId'=>$good['colorId']]);
//        dd($res);
            if($res){
                Cartforgood::create(['cartId'=>$login_id, 'gid'=>$good['gid'],]);
                $arr=['status'=>1, 'msg'=>'成功'];
            }else{
                $arr=['status'=>0,'msg'=>'失败'];
            }
            return $arr;
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Carts::where('id',$id) -> delete();
        if($res){
           return 1;
        }else{
            return 0;
        }
    }
}
