<?php

namespace App\Http\Controllers\home;

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
        // 判断当前用户是否登录了
//        $userName = session()->get('user')->userName;
//        dd($user);
        $orderNum = date('YmdHis').mt_rand(1000,9999);
        $time = date('Y-m-d H:i:s');
//       dd($time) ;
//        if(!empty(session('message')) && !empty(session('url')) && !empty(session('jumpTime'))){
           $res= orders::create(['orderNum'=>$orderNum,
                                'userName'=>232,
                                'createTime'=>$time,


               ]);
           $res2 = orderGoods::create(['orderNum'=>$orderNum,



               ]);
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
        return view('home.order.index');






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
