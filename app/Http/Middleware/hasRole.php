<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use App\Model\Role;
class hasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(session()->get('user'));
        //dd(session('auth')[0]);
        //1获取到当前正在请求的路由
        $route = \Route::current()->getActionName();
        //dd($route);

        if(!empty(session('auth')[0])){
    // dd($route);
            //2获取当前用户已经拥有的权限
            //定义一个空数组,存放当前用户拥有的所有权限
            $arr = [];
    //        dd(session('user')->userId);
            //2.1 获取当前用户拥有的角色
            $roles = User::find(session('user')->userId)->role;
                //dd($roles);
            //2.2 获取当前角色拥有的权限
            foreach($roles as $v){
                //获取当前角色拥有的权限
                $pers = $v->permission;

                foreach($pers as $n){
                    //遍历当前角色拥有的权限,获取权限记录的per_url
                    $arr[] = $n->per_url;
                }
            }
    //        去除重复的权限
            $arr = array_unique($arr);
//            dd($arr);

            //将用户拥有的权限存放到session变量中
            session()->push('auth',$arr);
            //3.判断当前请求的路由是否已经拥有的权限列表中
            if (in_array($route,$arr)){
                return $next($request);
            }else{
                return redirect('admin/noaccess');
            }
        }else{
            if(in_array($route,session('auth')[0])){
                // 4. 如果有权限，就放行，没有权限，就阻止执行
                return $next($request);
            }else{
                return redirect('admin/noaccess');
            }
        }

    }


}