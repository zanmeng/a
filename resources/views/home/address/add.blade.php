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
                <div class="grzlbt ml40">收货地址</div>
                <div style="color:red;margin-left:50px;font-size:30px;">
                    @if(!empty(session('msg')))
                        {{session('msg')}}
                        @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <form action="/home/address" method="post" style="margin-left:80px;font-size:25px;">
                    {{csrf_field()}}
                    收货人:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="orderName"><br /><br />
                    电话:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="phone" name="phone"><br /><br />
                    默认:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="1">&nbsp;&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0">&nbsp;&nbsp;&nbsp;否<br /><br />
                    <div class="info">
                        <div>
                           地址:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="s_province" name="s_province"></select>  
                            <select id="s_city" name="s_city" ></select>  
                            <select id="s_county" name="s_county"></select>
                            <script class="resources library" src="/home/css/area.js" type="text/javascript"></script>
                            <script type="text/javascript">_init_area();</script>
                        </div>
                        <div id="show"></div>
                    </div>
                    <br />
                    详细地址:<input type="text" name="address" style="width:500px;"><br /><br />

                    <input type="submit" value="添加" style="margin-left:200px;">

                </form>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <script type="text/javascript">
        var Gid  = document.getElementById ;
        var showArea = function(){
            Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +
                Gid('s_city').value + " - 县/区" +
                Gid('s_county').value + "</h3>"
        }
        Gid('s_county').setAttribute('onchange','showArea()');
    </script>
    <!-- self_info -->
@endsection


