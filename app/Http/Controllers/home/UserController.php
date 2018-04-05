<?php

namespace App\Http\Controllers\home;

use App\Model\homeUser;
use App\Model\User;
use App\Model\userinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Session;

class UserController extends Controller
{
    //
    //个人详情
    public function userinfo()
    {
        $uid = Session::get('user')->login_id;
//        dd($uid);
        //获取数据
        $user = homeUser::with('userinfo')->where('login_id',$uid)->first();
        //显示详情
        return view('home.userinfo',compact('user'));
    }

    //修改个人资料
    public function useredit()
    {
        $uid = Session::get('user')->login_id;
//        dd($uid);
        //获取数据
        $user = homeUser::with('userinfo')->where('login_id',$uid)->first();

        //显示详情
        return view('home.useredit',compact('user'));

    }

    //修改图片
    public function upload(Request $request)
    {
        $file = $request->file('userphoto');
//        return 123;
//        return $file;
        //如果是有效的上传文件
        if($file->isValid()) {
//            获取原文件的文件类型
            $ext = $file->getClientOriginalExtension();    //文件拓展名
//            生成新文件名
            $newfile = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
//            1. 将文件上传到本地服务器
            //将文件从临时目录移动到制定目录
//           $path = $file->move(public_path().'/uploads',$newfile);
            $path = $file->move(public_path().'/upload',$newfile);
//
            //将上传文件的路径返回给客户端
            return $newfile;
        }
    }

    //密码修改
    public function pass()
    {
        $uid = Session::get('user')->login_id;
        //获取数据
        $user =homeUser::where('login_id',$uid)->first();
        //显示详情
        return view('home.pass',compact('user'));
    }

    public function repass(Request $request,$id)
    {
        $input = $request->except('_token');

        //验证密码
        $rule = [
            'userPwd'=>'required|between:6,12',
            'reuserPwd'=>'required|between:6,12',
        ];
        $msg = [
            'userPwd.required'=>'新密码不能为空',
            'userPwd.between'=>'新密码必须在6-12位之间',
            'reuserPwd.required'=>'确认密码不能为空',
            'reuserPwd.between'=>'确认密码必须在6-12位之间',
        ];

//        $validator = Validator::make(需要验证的数据,验证规则,提示信息)
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('/home/pass')
                ->withErrors($validator)
                ->withInput();
        }

        //验证密码是否一致
        if($input['userPwd'] != $input['reuserPwd']){
            return redirect('home/pass')->with('errors','密码不一致');
        }
        $user = homeUser::find($id);
        $str = Crypt::encrypt( $input['userPwd']);
        $res = $user->update(['userPwd'=>$str]);
        if($res){
            return redirect('home/userinfo');
        }


    }

    //修改个人资料
    public function userupdate(Request $request,$id)
    {
        //接受全部数据
        $input = $request->all();


//        dd($input);
        $rule = [
            'phone' => ['required','regex:/^1[34578][0-9]{9}$/'],
            'email'=>'regex:/^[a-zA-Z0-9_\\.-]+@([a-zA-Z0-9-]+\\.)+[a-zA-Z0-9]{2,4}$/',
        ];
        //留言
        $msg = [
            'phone.required'=>'手机号不能为空!!!',
            'phone.regex'=>'手机号格式不正确!!!',
            'email.regex'=>'邮箱格式不正确!!!',
        ];
        //验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('/home/useredit')
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->input('email');
        $phone = $request->input('phone');
        $sex = $request->input('sex');
        $userphoto = $request->input('goodspic');

//        dd($userphoto);
        //根据ID查询用户
        $user = homeUser::with('userinfo')->find($id);

        $res = $user->update(['email'=>$email]);
        $ress = $user->userinfo->update(['phone'=>$phone,'sex'=>$sex,'userphoto'=>$userphoto]);


        if($res && $ress){
            return redirect('home/userinfo');
        }
}



}
