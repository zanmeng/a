@extends('layouts.home')

@section('content')
	<!-- end banner_x -->
	<!-- self_info -->
    <style>
        #a li{float: left;font-size: 15px;width: 210px;height:20px; margin-left: 40px;color: #aaa;padding: 10px;}
        /*#a1{width: 150px;height:20px; margin-left: 0px;border:1px blue dashed;}*/
    </style>

	<div class="grzxbj">
		<div class="selfinfo center">
			{{--<div class="lfnav fl">--}}
				{{--<div class="ddzx">订单中心</div>--}}
				{{--<div class="subddzx">--}}
					{{--<ul>--}}
						{{--<li><a href="" style="color:#ff6700;font-weight:bold;">我的订单</a></li>--}}
						{{--<li><a href="">意外保</a></li>--}}
						{{--<li><a href="">团购订单</a></li>--}}
						{{--<li><a href="">评价晒单</a></li>--}}
					{{--</ul>--}}
				{{--</div>--}}
				{{--<div class="ddzx">个人中心</div>--}}
				{{--<div class="subddzx">--}}
					{{--<ul>--}}
						{{--<li><a href="./self_info.html">我的个人中心</a></li>--}}
						{{--<li><a href="">消息通知</a></li>--}}
						{{--<li><a href="">优惠券</a></li>--}}
						{{--<li><a href="">收货地址</a></li>--}}
					{{--</ul>--}}
				{{--</div>--}}
			{{--</div>--}}
			<div class="rtcont fr">
				<div class="ddzxbt">确认订单 </div>
                {{--<div style="display:block;height:40px;margin-top: 10px " >--}}
                    {{--<ul id="a">--}}
                        {{--<li id="a1">订单号：2018040301191722191</li>--}}
                        {{--<li id="a2">收货人：士大夫似的</li>--}}
                        {{--<li id="a3">收货人电话：18064261826</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div style="color: #aaa;height: 26px; margin-left: 41px">送货地址：豆腐格的风格风格地的人感到反感的风格的风格方豆腐干地方</div>--}}
                @foreach($carts as $v)
                    {{--style="height: 110px;width:80px"style="float: left;height: 110px;width:80px"--}}
				<div class="ddxq" >
					<div class="ddspt fl" ><img src="{{$v->gpic}}" alt="" style="height: 110px;width:80px;padding-top: 0px"></div>
					<div class="ddbh fl"   >{{$v->gname}}</div>
					<div class="ztxx fr">
						<ul >
							<li>{{$v->version}}</li>
							<li>{{$v->color}}</li>
							<li>{{$v->num}}</li>
							<li>{{($v->price)*($v->num)}}</li>
							{{--<li><a href="">订单详情></a></li>--}}
							<div class="clear"></div>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
                @endforeach


                <div class="jiesuandan mt20 center">
                    {{--<div class="tishi fl ml20">--}}
                        {{--<ul>--}}
                            {{--<li><a href="./liebiao.html">继续购物</a></li>--}}
                            {{--<li>|</li>--}}
                            {{--<li>共<span>2</span>件商品，已选择<span>1</span>件</li>--}}
                            {{--<div class="clear"></div>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <div  style=" border:1px #01AAED solid; float: right;width: 400px; height: 200px">
                        <div style="display:block;height:40px" >
                            <ul id="a">
                                <li id="a1">订单号：{{$orderNum}}</li>
                                <li id="a2">收货人：士大夫似的</li>
                                <li id="a3">收货人电话：18064261826</li>
                            </ul>
                            <div style="color: #aaa;margin-left: 50px;float: left;font-size: 15px;">送货地址：豆腐格的风格风格地的人感到反感的风格的风格方豆腐干地方</div>
                        </div>
                        {{--<div style="color: #aaa;margin-left: 41px">送货地址：豆腐格的风格风格地的人感到反感的风格的风格方豆腐干地方</div>--}}

                    </div>
                    <div class="jiesuan fr">

                        <div class="jiesuanjiage fl">合计（不含运费）：<span>2499.00元</span></div>
{{--                        {{$user = session()->get('user')}}--}}
                        {{--@if (!(session()->get('user')))--}}
                            {{--<div class="jsanniu fr"><a href="/home/login"><input class="jsan" type="text" name="jiesuan"  value=" &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请登陆"/></div></a>--}}
                        {{--@else--}}
                            <div class="jsanniu fr"><input class="jsan" type="submit" name="jiesuan"  value="提交订单"/></div>
                        {{--@endif--}}

                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- self_info -->
@endsection
