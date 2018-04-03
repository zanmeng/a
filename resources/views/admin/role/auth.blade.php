<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/admin/js/jquery-3.2.1.min.js"></script>    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
</head>

<body>
<div class="x-body">


    <form enctype="multipart/form-data" id="art_form" class="layui-form" action="{{ url('admin/role/doauth') }}" method="post">
        {{ csrf_field() }}

        <div class="layui-form-item">

            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>角色名称
            </label>
            <div class="layui-input-inline">
                <input type="hidden" value="{{ $role->roleId }}" name="roleId">
                <input type="text" value="{{ $role->role_name }}" disabled="" name="role_name" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>


        <div class="layui-form-item" pane="">
            <label class="layui-form-label">所有的权限</label>
            <div class="layui-input-block">
                @foreach($permission as $v)
                    {{--//  如果当前角色拥有正在遍历的权限--}}
                    @if(in_array($v->permissionId,$own_perids))
                        <input type="checkbox" checked value="{{ $v->permissionId }}" name="permissionId[]" lay-skin="primary" title="{{ $v->per_name }}" >
                    @else
                        <input type="checkbox"  value="{{ $v->permissionId }}" name="permissionId[]" lay-skin="primary" title="{{ $v->per_name }}" >
                    @endif

                @endforeach
            </div>
        </div>


        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                授权
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;



        //监听提交
        form.on('submit(add)', function(data){
            // return false;
        });


    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>