<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('admin/index');
});*/

//后台

Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){

    //后台登录
    Route::get('login','LoginController@login');
    //生成验证码
    Route::get('code','LoginController@code');
    // 第三方组件生成验证码的路由
    Route::get('code/captcha/{userId}','LoginController@captcha');

    //登录处理路由
    Route::post('dologin','LoginController@dologin');

    Route::get('jiami','LoginController@jiami');


});
//没有权限返回的页面
Route::get('admin/noaccess',function(){
    return view('admin.errors.auth');
});


Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>['isLogin','hasRole']],function(){

    //后台首页
    Route::get('index','IndexController@index');

    //后台信息页
    Route::get('info','IndexController@info');

    //退出  登录
    Route::get('logout','IndexController@logout');

    //后台个人信息
    Route::get('user/info','UserController@info');

    //后台用户模块
    Route::get('user/auth/{id}','UserController@auth');
    Route::post('user/doauth','UserController@doAuth');

    //启用  禁用
    Route::post('user/changestatus','UserController@changestatus');

    //批量删除
    Route::get('user/delall','UserController@delall');

    //后台用户
    Route::resource('user','UserController');

    //角色模块
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    Route::resource('role','RoleController');

    //权限模块
    Route::resource('permission','PermissionController');

    //网站配置模块

    Route::get('config/putfile','ConfigController@putFile');

    //批量修改网络配置项
    Route::post('config/changecontent','ConfigController@changecontent');
    Route::resource('config','ConfigController');
});





