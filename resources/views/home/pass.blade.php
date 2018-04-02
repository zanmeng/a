@extends('layouts.home')

@section('content')
    <style>
        #tj{
            background-color: #ef5b00;
            width: 100px;
            height: 30px;
            line-height: 30px;
            display: block;
            margin-bottom: 14px;
            text-align: center;
            font-size: 14px;
            color: #fff;
            cursor: pointer;
            margin-left:250px;
            margin-top:50px;
        }
        .ipt{
            height:30px;
        }
    </style>
    <!-- self_info -->
    <div class="grzxbj">
        <div class="selfinfo center">
            <div class="lfnav fl">
                <div class="ddzx">订单中心</div>
                <div class="subddzx">
                    <ul>
                        <li><a href="{{url('home/orderGoods')}}" >我的订单</a></li>
                        <li><a href="">意外保</a></li>
                        <li><a href="">团购订单</a></li>
                        <li><a href="">评价晒单</a></li>
                    </ul>
                </div>
                <div class="ddzx">个人中心</div>
                <div class="subddzx">
                    <ul>
                        <li><a href="{{url('home/userinfo')}}" style="color:#ff6700;font-weight:bold;">我的个人中心</a></li>
                        <li><a href="/home/useredit">修改资料</a></li>
                        <li><a href="/home/pass">修改密码</a></li>
                        <li><a href="/home/address">地址管理</a></li>
                    </ul>
                </div>
            </div>
            <form action="/home/userpass/{{$user->login_id}}" method="post">
                {{csrf_field()}}
                <div class="rtcont fr">
                    <div class="grzlbt ml40">我的资料</div>
                    <div class="subgrzl ml40"><span>新密码:</span><span><input class="ipt" type="password" name="userPwd" value=""></span><span></span></div>
                    <div class="subgrzl ml40"><span>确认密码:</span><span><input class="ipt" type="password" name="reuserPwd" value=""></span><span></span></div>
                    <input id="tj" type="submit" value="修改">
                </div>
                <div class="clear"></div>
            </form>
        </div>

    </div>
    <!-- self_info -->
@endsection


