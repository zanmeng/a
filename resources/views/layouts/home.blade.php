<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>小米商城</title>
    <link rel="stylesheet" type="text/css" href="/home/css/style.css">

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/admin/lib/layui/layui.all.js"></script>
    <script src="/admin/lib/layui/layui.js"></script>
    <link rel="stylesheet" href="/admin/lib/layui/css/layui.css">


</head>
<body>
<!-- start header -->
<header>
    <div class="top center">
        <div class="left fl">
            <ul>
                <li><a href="{{url('home/index')}}">小米商城</a></li>
                <li>|</li>
                <li><a href="">问题反馈</a></li>
                <li>|</li>
                <li><a href="">Select Region</a></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="right fr">
            <div class="gouwuche fr"><a href="">购物车</a></div>
            <div class="fr">
                <ul>
                    @if(empty(Session()->get('user')))
                        <li><a href="{{url('home/login')}}">登录</a></li>
                    @else
                        <li>{{Session()->get('user')->userName}}&nbsp;</li>
                    @endif
                    <li>|</li>
                    @if(!empty(Session()->get('user')))
                        <li><a href="{{url('home/logout')}}">退出</a></li>
                    @else
                        <li><a href="{{url('home/reg')}}">注册</a></li>
                    @endif
                    <li>|</li>
                    @if(empty(Session()->get('user')))
                        <li>&nbsp;&nbsp;</li>
                    @else
                        <li><a href="{{url('home/userinfo')}}">个人中心</a></li>
                            <li>|</li>
                        <li><a href="{{url('home/orderGoods')}}">我的订单</a></li>
                    @endif

                    <li><a href="">消息通知</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</header>
<!--end header -->

<!-- start banner_x -->

<div class="banner_x center" >
    <a href="{{url('home/index')}}"><div class="logo fl"></div></a>
    <a href=""><div class="ad_top fl"></div></a>
    <div class="nav fl" style="float: left;">
        <ul class="layui-nav">
            <li class="layui-nav-item"   ><a href="">最新活动</a></li>first
            @foreach($res as $v)
                @if($v->catstatus==2)
            <li class="layui-nav-item">
                    <a href="javascript:;">{{$v->catname}}</a>

                <dl class="layui-nav-child" style="float:left;z-index:9999;"> <!-- 二级菜单 -->
                    @foreach($v->good as $vv)
                        <div style="position:relative;float:left">
{{--                    <dd><a href=""><img src="{{$vv->gpic}}"  style="width:100px;height:100px;" alt=""> </a>--}}
                    <div style="color:deepskyblue;font-size: 20px;"><a href="">{{$vv->gname }}</a></div>
{{--                    <dd><a href="javascript:;">￥{{$vv->price}}</a></dd>--}}
                        </div>
                    @endforeach
                </dl>

            </li>
                @endif
            @endforeach

            <li class="layui-nav-item"  style="float:left;" ><a href="">社区</a></li>
        </ul>
    </div>



    <div class="search fr">
        <form action="/home/sousuo" method="post">
            {{ csrf_field() }}
            <div class="text fl">
                <input type="text" class="shuru" name="gname"  value=""  placeholder="请输入搜索条件">
            </div>
            <div class="submit fl">
                <input type="submit"  class="sousuo" value="搜索"/>


            </div>
            <div class="clear"></div>
        </form>
        <div class="clear"></div>
    </div>
</div>



<script>
    layui.use('element', function(){
        var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块

        //监听导航点击
        element.on('nav(demo)', function(elem){
            //console.log(elem)
            layer.msg(elem.text());
        });
    });
</script>


<!-- end banner_x -->
@section('content')

@show
<footer class="mt20 center">
    <div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
    <div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div>
    <div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
</footer>
</body>
</html>