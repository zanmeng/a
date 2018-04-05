<?php

namespace App\Http\Controllers\home;

use App\Model\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Session;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Session()->get('user')->login_id;

        $address=Address::where('login_id',$id)->get();

        return view('home.address.list',compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.address.add');
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
        //获取登录用户ID
        $id = Session()->get('user')->login_id;
        $add = Address::where('login_id',$id)->count();
//        dd($add);
       if($add >= 5) {
           return redirect('/home/address/create')->with('msg','您的地址过多!!!!');
       }
        //接收表单提交的数据
        $input = $request->all();
        $status =$input['status'];

        $addstatus = Address::where('login_id',$id)->get();
        $add = [];
        foreach($addstatus as $v){
            $add[] = $v->status;
        }

        if($status==1 && in_array(1,$add)){
            return redirect('/home/address/create')->with('msg','已有默认地址!!');
        }


        $rule = [
            'phone' => ['required','regex:/^1[34578][0-9]{9}$/'],
        ];
        //留言
        $msg = [
            'phone.required'=>'手机号不能为空!!!',
            'phone.regex'=>'手机号格式不正确!!!',
        ];
        //验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('home/address/create')
                ->withErrors($validator)
                ->withInput();
        }


//        dd($input);
        $add1 = $input['s_province'];
        $add2 = $input['s_city'];
        $add3 = $input['s_county'];
        $add4 = $input['address'];
        //将数据添加到数据库
        $res = Address::create([
            'login_id'=>$id,
            'addpro'=>$add1,
            'addcity'=>$add2,
            'addcounty'=>$add3,
            'address'=>$add4,
            'phone'=>$input['phone'],
            'orderName'=>$input['orderName'],
            'status'=>$status,
        ]);
//
        //判断是否添加成功
        if($res){
            return redirect('/home/address');
        }else{
            return redirect('/home/address/create');
        }
        //根据添加是否成功,进行页面跳转

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
    public function edit($aid)
    {
        //
        //根据ID获取数据
        $address = Address::findOrFail($aid);

        //显示到页面
        return view('home.address.edit',compact('address'));
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

        //获取登录用户ID
        $uid = Session()->get('user')->login_id;
        //
        $input = $request->all();

//        dd($input);
        //
        //提交的状态
        $status =$input['status'];

        //登录用户的所有地址状态
        $addstatus = Address::where('login_id',$uid)->get();
        $add = [];
        foreach($addstatus as $v){
            $add[] = $v->status;
        }
        //判断是否有默认地址
        if($status==1 && in_array(1,$add)){
            return redirect("/home/address/$id/edit")->with('msg','已有默认地址!!');
        }


        $rule = [
            'phone' => 'required',
            'phone'=>'regex:/^1[34578][0-9]{9}$/',
        ];
        //留言
        $msg = [
            'phone.required'=>'手机号不能为空!!!',
            'phone.regex'=>'手机号格式不正确!!!',
        ];
        //验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect("/home/address/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $address = Address::find($id);

        $res = $address->update([
            'orderName' => $input['orderName'],
            'phone'=>$input['phone'],
            'address'=>$input['address'],
            'status'=>$status,
        ]);

        if ($res) {
            return redirect('/home/address');
        } else {
            return redirect('/home/address');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($aid)
    {
        //
        $address = Address::find($aid);

        $res = $address->delete();

        if ($res) {
            return redirect('/home/address');
        } else {
            return redirect('/home/address');
        }
    }


    public function ajax()
    {
        return 11;
    }
}
