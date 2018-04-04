<?php

namespace App\Http\Controllers\Admin;



use App\Model\homeUser;
use App\Model\ordergoods;
use App\Model\orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class ordersController extends Controller
{
    //显示页面

    public function list(Request $request)
    {
//        $orders = orders::all();
//        echo  $request->input('orderStatus');

        // 4. 多条件并分页
        $user = orders::orderBy('orderId', 'asc')
            ->where(function ($query) use ($request) {
                //检测关键字
                $createTime = $request->input('createTime');
                $orderNum = $request->input('orderNum');
                $orderStatus = $request->input('orderStatus');
                //如果下单时间不为空
                if (!empty($createTime)) {
                    $query->where('createTime', 'like', '%' . $createTime . '%');
                }
                //如果订单号不为空
                if (!empty($orderNum)) {
                    $query->where('orderNum', 'like', '%' . $orderNum . '%');
                }
                //如果订单号不为空
                if (!empty($orderStatus)) {
                    $query->where('orderStatus', $orderStatus);
                }
            })
            ->paginate($request->input('num', 5));


        //  根据id=1的用户详情，获取关联的用户表的信息
//        $user_login = homeUser::find(1);
//        $user = $user_login->user;
//         dd($user);

//        获取ID=2的用户的信息及其他的用户详情UserInfo
//        $user = orders::find(33);
//        dd($user);
//        通过模型中定义的动态属性，就可以获取到关联模型UserInfo
//        $userName = $user->homeUser->userinfo->address;
//        dd($userName);


//        获取所有的用户及其用户详情
//        $user = orders::with('homeUser')->get();
//        dd($user);


//        return view('admin.order.list',compact('orders'));
        return view('admin.order.list', ['orders' => $user, 'request' => $request]);
    }

    public function destroy($id)
    {
        $user = orders::find($id);

        $res = $user->delete();
        if ($res) {
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        } else {
            $arr = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $arr;
    }

    //删除所有被选中的用户
    public function delall(Request $request)
    {
        //获取请求参数中，要删除的用户的id

        $ids = $request->input('ids');
//        return $ids;

        $res = orders::destroy($ids);

        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }

    //发货
    public function changestatus(Request $request)
    {

//        return 11111;
        //用户id
        $uid = $request->input('id');

        //用户的状态
//        $status =  ($request->input('status') == 1)? :2;
        if ($request->status == 1) {
            $status = 2;
        } else {
            $status = 1;
        }

        //修改状态
        $user = orders::find($uid);
        $res = $user->update(['orderStatus' => $status]);

        if ($res) {
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status' => 0,
                'msg' => '修改成功'
            ];
        } else {
            $arr = [
                'status' => 1,
                'msg' => '修改失败'
            ];
        }

        return $arr;

    }

    public function show(Request $request, $orderNum)
    {
//        echo  $orderNum;
//        return $request->all();
//        echo $a;
        $orders = ordergoods::where('orderNum', $orderNum)->get();
//        dd($orders) ;
//        $orders = DB::table('ordergoods')
//            ->join('orders', 'ordergoods.orderNum', '=', 'orders.orderNum')
//            ->join('goods', 'ordergoods.gid', '=', 'goods.gid')
//            ->select('ordergoods.*', 'goods.gname', 'goods.price','goods.gpic')
//            ->get();

//        $orders = DB::table('ordergoods')
//            ->leftJoin('orders','ordergoods.orderNum', '=', 'orders.orderNum')
//            ->leftJoin('good_version','ordergoods.gid', '=', 'good_version.gid')
//            ->leftJoin('goods', 'ordergoods.gid', '=', 'goods.gid')
//
//            ->select('ordergoods.*', 'goods.gname', 'good_version.price','good_version.version','good_version.color','goods.gpic')
//            ->get();
//
//
//        dd($orders);
        return view('admin.order.show', compact('orders'));
    }
}


