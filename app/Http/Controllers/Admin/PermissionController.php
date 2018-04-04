<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /* $per = Permission::get();

        return view('admin.permission.list',compact('per'));*/
        $permission = Permission::orderBy('permissionId','asc')
            ->where(function($query) use($request){
                //检测关键字
                $name = $request->input('name');

                //如果用户名不为空
                if(!empty($name)) {
                    $query->where('per_name','like','%'.$name.'%');
                }

            })
            ->paginate($request->input('num', 5));
        return view('admin.permission.list',['permission'=>$permission, 'request'=> $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');

        $res = Permission::create($input);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        return view('admin.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $permissionId)
    {
        $name = $request->input('name');
        $url = $request->input('per_url');

        $permission = Permission::find($permissionId);

        $res = $permission->update(['per_name'=>$name,'per_url'=>$url]);

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
    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);

        $res = $permission->delete();

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
        $res = Permission::destroy($ids);

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
