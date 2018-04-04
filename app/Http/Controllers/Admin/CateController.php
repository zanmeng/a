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
              'catstatus'=>$request['catstatus'],
            ]);
        if($res){
            echo '添加成功';
            return redirect(url('admin/cate/index'));
        }
    }

    //删除分类
    public function delete($id){
//        获取传过来要删除类
        $res=Cate::where('catId',$id);
//        判断要删除的类下是否有商品
        $good=Cate::with('good')->where('catId',$id)->get();
        $rr=$good['0']->good;
        if($rr->count() !=0 ){
            return back()->with('error','删除失败，该分类下有商品不能删除');
        }else{
            $res->delete();
            return redirect('/admin/cate/index')->with('msg','删除成功');
        }
    }

    //修改分类s
    public function edit($id){
//        根据id查找数据
        $cate=Cate::findOrFail($id);
        return view('admin.good.cateEdit',compact('cate'));
    }

    public function update(Request $request,$id){
        $input=Cate::findOrFail($id);
        $res=$input->update(['catname'=>$request['catName'],
            'catstatus'=>$request['catstatus'],
                ]);
        if($res){
            return redirect(url('admin/cate/index'))->with('msg','修改成功');
        }else{
            echo '修改失败';
            return back();
        }
    }

    //添加商品
    public function create($cid){
        return view('Admin.good.Cgoodadd',compact('cid'));
    }

}
