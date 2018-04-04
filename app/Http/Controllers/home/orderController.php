<?php

namespace App\Http\Controllers\home;

use App\Model\homeUser;
use App\Model\orderGoods;
use App\Model\orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class orderController extends Controller
{
    public function getInfo()
    {

        // 判断当前用户是否登录了

    }

    // 生成订单
    public function index()
    {
        $login_id = session()->get('user')->login_id;
        $userName= session()->get('user')->userName;
//        dd($login_id);

        //拿购物车信息
       $carts= DB::table('carts')
            ->leftJoin('goods','carts.gid','=','goods.gid')
            ->leftJoin('good_color','carts.colorId','=','good_color.colorId')
            ->leftJoin('good_version','carts.vid','=','good_version.vid')
           ->where('carts.login_id','=',$login_id)
            ->get();
//        dd($carts);
        //拿地址信息
        $address = DB::table('address')->where('login_id',$login_id)->where('status','1')->get();
//        $address = DB::select('select * from address where login_id = :id and status = :status' ,['id' => $login_id,'status' => 1]);
//        dd($address);
        if(!empty($address)){
           echo  23;
        }
        die;
        foreach ($address as $v ) {

        }
        // 求总数量和总金额
        $orderCnt = 0;  // 总数量
        $orderMoney = 0;  // 总金额

        foreach ($carts as $v){
//           $goodsPic =$v->gpic;
//           $gname = $v->gname;
//           $version = $v->version;
//           $goodsColor = $v->color;
//           $goodNum = $v->num;
//           $goodsPrice =$v->price;
           $orderMoney +=($v->price)*($v->num);
           $orderCnt += $v->num;

        }
//        dd($orderMoney);
//        dd($goodNum);

        $orderNum = date('YmdHis').mt_rand(10000,99999);
        $time = date('Y-m-d H:i:s');
//       dd($time) ;
//        if(!empty(session('message')) && !empty(session('url')) && !empty(session('jumpTime'))){
            //添加到订单表
           $res= orders::create(['orderNum'=>$orderNum,
                               'userName'=>$userName,
                                'createTime'=>$time,
                                'login_id'=>$login_id,
                                'orderMoney'=>$orderMoney,           //总价
                                'orderCnt'=>$orderCnt,              //总数
                                //地址相关字段   刷新   图片 问题
               //               'orderName'=>$gname,

               ]);
           //添加到订单表详情表
//        dd($carts);
        foreach ($carts as $v ){
           $res2 = orderGoods::create(['orderNum'=>$orderNum,
                                        'goodsName'=>$v->gname,
                                        'goodsVersion'=>$v->version,
                                        'goodsColor'=>$v->color,
                                        'goodsNum'=>$v->num,
                                        'goodsPrice'=>$v->price,
                                        'goodsPic'=>$v->gpic,

               ]);
        }
//            dd($res2);
//        DB::beginTransaction();
//        try{
//           if ( writeOrders())
////
////
////
//            DB::commit();
////
//        } catch(Exception $e){
//            DB::rollBack();
//        }







        //显示模板及数据
        return view('home.order.index',compact('carts','orderNum'));






    }

//        $user = Session()->get('user')->userName;
//        dd($user);


    public function writeOrders()
    {
        $res= orders::create(['orderNum'=>date('YmdHis').mt_rand(1000,9999),
//            'tid'=>$input['tid'],
//            'price'=>$input['price'],
//            'stock'=>$input['stock'],
//            'salecnt'=>$input['salecnt'],
//            'vcnt'=>$input['vcnt'],
//            'gpic'=>$input['goodspic'],
//            'gdesc'=>$input['gdesc'],
        ]);

        //判断添加成功
        if($res){
            $arr=[
                'status'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $arr=[
                'status'=>1,
                'msg'=>'添加失败'
            ];
        }
        return $arr;
    }



}
