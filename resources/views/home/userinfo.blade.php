@extends('layouts.home')

@section('content')
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
        <div class="rtcont fr">
            {{--<div class="grzlbt ml40">我的资料</div>--}}
            <div>
                <div style="float:left;margin-left:150px;margin-top:50px;width:100px;height:100px;">
                    <img style="width: 150px;height: 150px;border:1px solid #d5d5d5;border-radius:50px;" src="@if(!empty($user->userinfo->userphoto)) {{ $user->userinfo->userphoto }} @else {{url('home/image/geren.png')}} @endif" alt="用户图像"><br />
                        <h4 style="margin-top:10px;margin-left:40px;">用户图像</h4>
                    {{--<h2><a href="">用户:@if(!empty($user)) {{ $user->userName }} @endif</a></h2><br>--}}
                    {{--修改图像:<input type="file" id="file_upload" name="userphoto">--}}
                </div><br />
                <div style="float:left;margin-left:250px;margin-top:30px;">
                    <h3>用户:@if(!empty($user->userName)) {{ $user->userName }} @else 无 @endif</h3><br>
                    <h3>电话:@if(!empty($user->userinfo->sex)) {{ $user->userinfo->sex == '1' ? '男' : '女' }} @else 无 @endif</h3><br>
                    <h3>邮箱:@if(!empty($user->email)) {{ $user->email }} @else 无  @endif</h3><br>
                    <h3>电话:@if(!empty($user->userinfo->phone)) {{ $user->userinfo->phone }} @else 无 @endif</h3><br>
                    <h2><a href="/home/useredit">修改资料</a></h2>
                </div>
                <div style="clear:both;"></div>
            </div>
        <hr style="margin-top:30px;">
            <div style="margin-top:30px;margin-left:100px;">
                <div style="float:left;">
                    <img src="/home/image/dingdan.png" alt="">
                    <h2><a href="">我的订单</a></h2>
                </div>
                <div style="float:left;;margin-left:100px;">
                    <img src="/home/image/dingdan.png" alt="">
                    <h2><a href="">我的订单</a></h2>
                </div>
                <div style="float:left;;margin-left:100px;">
                    <img src="/home/image/dingdan.png" alt="">
                    <h2><a href="">我的订单</a></h2>
                </div>
                <div style="float:left;margin-left:100px;">
                    <img src="/home/image/shoucang.png" alt="">
                    <h2><a href="">我的收藏</a></h2>
                </div>
            </div>
            {{--<div class="subgrzl ml40"><span>用户名</span><span>@if(!empty($user)) {{ $user->userName }} @endif</span><span><a href=""></a></span></div>--}}
            {{--<div class="subgrzl ml40"><span>手机号</span><span>@if(!empty($user->userinfo)) {{ $user->userinfo->phone }} @endif</span><span><a href=""></a></span></div>--}}
            {{--<div class="subgrzl ml40"><span>邮箱</span><span>@if(!empty($user->userinfo)) {{ $user->email }} @endif</span><span><a href=""></a></span></div>--}}
            {{--<div class="subgrzl ml40"><span>收货地址</span><span>@if(!empty($user->userinfo)) {{ $user->userinfo->address }} @endif</span><span><a href=""></a></span></div>--}}

        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- self_info -->
@endsection
