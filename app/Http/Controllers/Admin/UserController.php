<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use App\Model\Role;

class UserController extends Controller
{



    //返回角色授权页面
    public function auth($userId)
    {
        //根据ID获取用户
        $user = User::find($userId);
        //获取所有的角色
        $role = Role::get();

        //获取当前用户已经被授予的角色
        $own_roles = $user->role;
//        dd($own_roles);

        //当前用户拥有的角色的ID列表
        $own_roleids = [];
        foreach ($own_roles as $v){
            $own_roleids[] = $v->roleId;
        }


        return view('admin.user.auth',compact('user','role','own_roleids'));
    }


    //处理角色授权
    public function doAuth(Request $request)
    {
        $input = $request->except('_token');
        $userId = $input['userId'];
//        dd($userId);

        DB::beginTransaction();

        try{
            //要执行的sql语句
            //删除当前角色被赋予的所有权限
            DB::table('user_role')->where('userId',$userId)->delete();

            if(!empty($input['roleId'])){
                //将提交的数据添加到 角色权限关联表
                foreach ($input['roleId'] as $v){
                    DB::table('user_role')->insert([
                        'userId'=>$input['userId'],
                        'roleId'=>$v
                    ]);
                }
            }

            DB::commit();

            return redirect('admin/user');


        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }





    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = User::orderBy('userId','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('keywords1');
                $email = $request->input('keywords2');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('userName','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num', 5));

        return view('admin.user.list',['user'=>$user, 'request'=> $request]);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收表单提交的数据
        $input = $request->all();


        //检查用户是否存在
        $user = User::where('userName',$input['username'])->first();

        if($user){
            return redirect('admin/user/create')->with('error','用户名已存在');
        }

        //将数据添加到数据库
        $pass = Crypt::encrypt($input['pass']);

        $res = User::create([
            'userName'=>$input['username'],
            'userPwd'=>$pass,
            'phone'=>$input['phone'],
            'email'=>$input['email'],
            'sex'=>$input['sex'],


            ]);

        //根据添加是否成功,进行页面跳转
        if($res){
            $arr = [
                'status'=>1,
                'msg'=>'添加成功'
            ];
        }else{
            $arr = [
                'status'=>0,
                'msg'=>'添加失败'
            ];
        }

        return $arr;

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($userId)
    {
        $user = User::findOrFail($userId);

        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $input = $request->all();

        $user = User::find($userId);

        $res = $user->update([
            'userName' => $input['username'],
            'sex'=>$input['sex'],
            'phone'=>$input['phone'],
            'email'=>$input['email'],


        ]);
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>0,
                'msg'=>'修改失败'
            ];
        }

        return $arr;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::find($userId);


        $res = $user->delete();
        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [

                'status'=>0,

                'msg'=>'删除成功'
            ];
        }else{
            $arr = [

                'status'=>1,

                'msg'=>'删除失败'
            ];
        }

        return $arr;
    }

    //禁用  启用用户
    public function changestatus(Request $request)
    {

//        return 11111;
        //用户id
        $userId = $request->input('userId');
        //用户的状态
        $status =  ($request->input('status') == 0)? 1:0;

        //修改状态
        $user = User::find($userId);
        $res = $user->update(['status'=>$status]);

        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>0,
                'msg'=>'修改失败'
            ];
        }

        return $arr;



    }
    //删除所有被选中的用户
    public function delall(Request $request)
    {
        //获取请求参数中，要删除的用户的id
        $ids = $request->input('ids');

//        删除ids里存储的用户的id对应的用户
        $res = User::destroy($ids);

        if($res){
            $data = [
                'status'=>1,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'删除失败'
            ];
        }


        return $data;

    }

}
