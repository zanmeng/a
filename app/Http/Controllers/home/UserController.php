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
        $email = $request->input('email');
        $phone = $request->input('phone');
        $sex = $request->input('sex');
        $userphoto = $request->input('userphoto');

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
