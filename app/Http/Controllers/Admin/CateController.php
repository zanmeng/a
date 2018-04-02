<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Cate;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //分类列表
    public  function index(){
        $cate=Cate::all();

//        dd($cate);
        return view('Admin.good.cateList',compact('cate'));

    }

    //添加子分类
    public function add(){

        return view('Admin.good.cateAdd');
    }
    public function store(Request $request){
//        dd($request->all());
        $request->except('_token');
        $res=Cate::create(
            ['catName'=>$request['catName'],
            ]);
        if($res){
            echo '添加成功';
            return redirect(url('admin/cate/index'));
        }
    }

    //删除分类
    public function delete($id){
        $res=Cate::where('catId',$id)->delete();
        if($res){
            return redirect('/admin/cate/index');
        }else{
            return back()->with('error','删除失败');
        }
    }

    //修改分类
    public function edit($id){
//        根据id查找数据
        $cate=Cate::findOrFail($id);
        return view('admin.good.cateEdit',compact('cate'));
    }

    public function update(Request $request,$id){
        $input=Cate::findOrFail($id);
        $res=$input->update(['catname'=>$request['catName'],]);
        if($res){
            echo '修改成功';
            return redirect(url('admin/cate/index'));
        }else{
            echo '修改失败';
            return back();
        }
    }

}
