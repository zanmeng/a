<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>

<div class="x-body" >
<xblock>
<button class="layui-btn"><i class="layui-icon"></i>商品分类</button>
<div>
    @if (!empty(session('error')))
        {{  session('error') }}
    @elseif(!empty(session('msg') ))
        {{   session('msg') }}
    @endif
</div>
</xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                分类名称
            </th>
            <th>
                分类状态
            </th>
            <th>
                操作
            </th>

        </tr>
        </thead>

        @foreach($cate as $v)
            <tbody id="x-img">
            <tr>
                <td>
                    {{$v->catId}}
                </td>
                <td>
                    {{$v->catname}}
                </td>
                <td>
                    {{$v->catstatus}}
                </td>
                <td>
                    <a class="layui-btn layui-btn-normal" href="/admin/cate/edit/{{$v->catId}}">修改</a>
                    <a class="layui-btn layui-btn-danger" href="/admin/cate/delete/{{$v->catId}}">删除</a>
                    <a class="layui-btn" href="/admin/cate/create/{{$v->catId}}">添加子商品</a>
                </td>
            </tr>

            </tbody>
        @endforeach
    </table>
    <div class="page">
        <div>
        </div>
    </div>
</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
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