<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Permission;


class RoleController extends Controller
{
    //返回角色授权页面
    public function auth($roleId)
    {
        //根据ID获取角色
        $role = Role::find($roleId);
        //获取所有的权限
        $permission = Permission::get();

        //获取当前角色已经被授予的权限
        $own_pers = $role->permission;

        //当前角色拥有的权限的ID列表
        $own_perids = [];
        foreach ($own_pers as $v){
            $own_perids[] = $v->permissionId;
        }


        return view('admin.role.auth',compact('role','permission','own_perids'));
    }


    //处理角色授权
    public function doAuth(Request $request)
    {
        $input = $request->all();
      $roleId = $input['roleId'];

        DB::beginTransaction();

        try{
            //要执行的sql语句
            //删除当前角色被赋予的所有权限
            DB::table('role_permission')->where('roleId',$roleId)->delete();

            if(!empty($input['permissionId'])){
                //将提交的数据添加到 角色权限关联表
                foreach ($input['permissionId'] as $v){
                    DB::table('role_permission')->insert([
                        'roleId'=>$input['roleId'],
                        'permissionId'=>$v
                    ]);
                }
            }

            DB::commit();

            return redirect('admin/role');


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
        /*$role = Role::get();

        return view('admin.role.list',compact('role'));*/
        $role = Role::orderBy('roleId','asc')
            ->where(function($query) use($request){
                //检测关键字
                $name = $request->input('name');

                //如果用户名不为空
                if(!empty($name)) {
                    $query->where('role_name','like','%'.$name.'%');
                }

            })
            ->paginate($request->input('num', 5));
        return view('admin.role.list',['role'=>$role, 'request'=> $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取提交的添加数据
        $input = $request->except('_token');


        //表单验证

        //添加到数据库
        $res = Role::create($input);

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


        //根据添加是否成功,跳转到对应的路由
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
    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roleId)
    {
        $name = $request->input('role_name');


        $role = Role::find($roleId);

        $res = $role->update(['role_name'=>$name]);

        if($res){
//
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
    public function destroy($roleId)
    {
        $role = Role::find($roleId);

        $res = $role->delete();

        if($res){
            $arr = [
                'status'=>1,
                'msg'=>'删除成功'
            ];
        }else{
            $arr = [
            'status'=>0,
            'msg'=>'删除失败'
          ];
        }

        return $arr;
    }

    public function delall(Request $request)
    {
        //获取请求参数中，要删除的用户的id
        $ids = $request->input('ids');
//        return $ids;
//        删除ids里存储的用户的id对应的用户
        $res = Role::destroy($ids);

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
