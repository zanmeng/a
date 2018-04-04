<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(Request $request)
    {

        $comment = Comment::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $nickname = $request->input('name');
                $content = $request->input('content');

                //如果用户名不为空
                if(!empty($nickname)) {
                    $query->where('nickname','like','%'.$nickname.'%');
                }
                if(!empty($content)) {
                    $query->where('content','like','%'.$content.'%');
                }


            })
            ->paginate($request->input('num', 5));


        return View('admin.Comment.list',['comment'=>$comment,'request'=> $request]);
    }

    //禁用  启用评论
    public function changestatus(Request $request)
    {


        //评论id
        $id = $request->input('id');
        //评论的状态
        $status =  ($request->input('status') == 0)? 1:0;

        //修改状态
        $comment = Comment::find($id);
        $res = $comment->update(['status'=>$status]);

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

    public function delete($id)
    {


        $comment = Comment::find($id);

        $res = $comment->delete();

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
}
