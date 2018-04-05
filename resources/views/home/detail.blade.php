
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>小米6立即购买-小米商城</title>
		<link rel="stylesheet" type="text/css" href="/home/css/style.css">
        <link rel="stylesheet" type="text/css" href="/home/ShoppingCartFlay/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/home/ShoppingCartFlay/css/demo.css" />
		<script src="/home/js/jquery.js"></script>
		<style>
			.banben,.color{
				border:solid 1px #ddd;
			}
			.ac,.bc{
				border:solid 1px #ff6700;
				color: #01AAED;
			}
			.vc{
				color:#ff6700;
			}
		</style>
	</head>
	<body>
	<!-- start header -->
		<header>
			<div class="top center">
				<div class="left fl">
					<ul>
						<li><a href="http://www.mi.com/" target="_blank">小米商城</a></li>
						<li>|</li>
						<li><a href="">MIUI</a></li>
						<li>|</li>
						<li><a href="">米聊</a></li>
						<li>|</li>
						<li><a href="">游戏</a></li>
						<li>|</li>
						<li><a href="">多看阅读</a></li>
						<li>|</li>
						<li><a href="">云服务</a></li>
						<li>|</li>
						<li><a href="">金融</a></li>
						<li>|</li>
						<li><a href="">小米商城移动版</a></li>
						<li>|</li>
						<li><a href="">问题反馈</a></li>
						<li>|</li>
						<li><a href="">Select Region</a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="right fr">
														{{--$login_id = session()->get('user')->login_id--}}
					<div class="gouwuche fr" id="icon-cart"><a href="{{URL('home/Cart/shoppingCart').'?login_id=1'}}">购物车</a></div>
					<div class="fr">
						<ul>
							<li><a href="./login.html" target="_blank">登录</a></li>
							<li>|</li>
							<li><a href="./register.html" target="_blank" >注册</a></li>
							<li>|</li>
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
		<div class="banner_x center">
			<a href="./index.html" target="_blank"><div class="logo fl"></div></a>
			<a href=""><div class="ad_top fl"></div></a>
			<div class="nav fl">
				<ul>
					<li><a href="">小米手机</a></li>
					<li><a href="">红米</a></li>
					<li><a href="">平板·笔记本</a></li>
					<li><a href="">电视</a></li>
					<li><a href="">盒子·影音</a></li>
					<li><a href="">路由器</a></li>
					<li><a href="">智能硬件</a></li>
					<li><a href="">服务</a></li>
					<li><a href="">社区</a></li>
				</ul>
			</div>
			<div class="search fr">
				<form action="" method="post">
					<div class="text fl">
						<input type="text" class="shuru"  placeholder="&nbsp;&nbsp;&nbsp;&nbsp;小米6&nbsp;小米MIX现货">
					</div>
					<div class="submit fl">
						<input type="submit" class="sousuo" value="搜索"/>
					</div>
					<div class="clear"></div>
				</form>
				<div class="clear"></div>
			</div>
		</div>
<!-- end banner_x -->


	<!-- xiangqing -->
	<form action="{{URL('home/ToCart')}}" method="get">
	<div class="xiangqing">
		<div class="neirong w">
			<div class="xiaomi6 fl">{{$good->gname}}</div>
			<nav class="fr">
				<li><a href="">概述</a></li>
				<li>|</li>
				<li><a href="">变焦双摄</a></li>
				<li>|</li>
				<li><a href="">设计</a></li>
				<li>|</li>
				<li><a href="">参数</a></li>
				<li>|</li>
				<li><a href="">F码通道</a></li>
				<li>|</li>
				<li><a href="">用户评价</a></li>
				<div class="clear"></div>
			</nav>
			<div class="clear"></div>
		</div>
	</div>

	<div class="jieshao mt20 w" >
		<div class="left fl"><img src="/home/image/liebiao_xiaomi6.jpg"></div>
		<div class="right fr">
			<div class="h3 ml20 mt20" id="goodname"></div>
			<div class="jianjie mr40 ml20 mt10">{{$good->gdesc}}</div>
			<div class="jiage ml20 mt10" id="goodprice"></div>
			<div class="ft20 ml20 mt20">选择版本</div>
            <div class="xzbb ml20 mt10" >
                {{--遍历版本--}}
                @foreach($good->Version as $kk=>$vv)
                <div class="banben"  data-vid="{{$vv->vid}}" data-name="{{$vv->version}}"  data-index-v="{{$kk}}"  data-price="{{$vv->price}}">
					<a>
						<span id="versionColor">{{$vv->version}}</span>
						<span id="fontColor">{{$vv->price}}元</span>
					</a>
				</div>
                @endforeach
				<div class="clear"></div>
			</div>
			<div class="ft20 ml20 mt20">选择颜色</div>
            <div class="xzbb ml20 mt10" >
                {{--遍历颜色--}}
                @foreach($good->Color as $kk=>$vv)
					<div class="color" data-cid="{{$vv->colorId}}" data-color="{{$vv->color}}" data-index-c="{{$kk}}" >
                        <a>
                            <span class="yuandian"></span>
                            <span class="yanse">&nbsp&nbsp{{$vv->color}}</span>
                        </a>
                    </div>
                @endforeach
                <div class="clear"></div>
            </div>
			<div class="xqxq mt20 ml20">
				<div class="top1 mt10">
					<div class="left1 fl" id="left1"></div>
					<div class="right1 fr" id="right1"></div>
					<div class="clear"></div>
				</div>
				<div class="bot mt20 ft20 ftbc" id="downprice"></div>
			</div>
        </div>
				<div class="bot mt20 ft20 ftbc id="down1"></div>
			</div>
			<div class="xiadan ml20 mt20">
					<input class="jrgwc" type="submit" name="jrgwc" value="加入购物车" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	</form>
	<!-- footer -->
	<footer class="mt20 center">

			<div class="mt20">小米商城|MIUI|米聊|多看书城|小米路由器|视频电话|小米天猫店|小米淘宝直营店|小米网盟|小米移动|隐私政策|Select Region</div>
			<div>©mi.com 京ICP证110507号 京ICP备10046444号 京公网安备11010802020134号 京网文[2014]0059-0009号</div>
			<div>违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</div>
	</footer>

    <script type="text/javascript" src="/home/ShoppingCartFlay/js/jquery.js"></script>
    <script src="/home/ShoppingCartFlay/js/jquery.fly.min.js"></script>

    <script>
        //判断
        //如果第一次进入详情页 商品名称为空 添加默认值
        if( $('#goodname').val().length==0){

            $('#goodname').html('{{$good->gname}}');
            //先移出商品版本ac类,再添加
            $('.banben').siblings().removeClass('ac');
            $('.banben').eq(0).addClass('ac');
            //如果第一次进入详情页 商品价格为空 添加默认值
            $('#goodprice').html( $('.ac').attr("data-price")+'  '+'元' );
            $('#downprice').html( '总计'+'  '+' : '+$('.ac').attr("data-price")+'  '+'元' );
            //先移出商品框颜色bc类,再添加
            $('.color').siblings().removeClass('bc');
            $('.color').eq(0).addClass('bc');
            //版本 颜色字体初始颜色(橘黄)
            $('.banben').find("span").removeClass('vc');
            $('.color').find("span").eq(1).removeClass('vc');
            $('.banben').find("span").eq(0).addClass('vc');
            $('.color').find("span").eq(1).addClass('vc');
            //添加默认值
            $('#left1').html('{{$good->gname}}'+' '+ $('.ac').attr("data-name") + ' '+$('.bc').attr("data-color"));
            $('#right1').html( $('.ac').attr("data-price") );

        }

        //获取对象,创建点击事件(版本)
        $('.banben').click (function(){
            $(this).siblings().removeClass('ac');
            $(this).addClass('ac');
            //获取商品版本属性值
            goodname = $('.ac').attr("data-name");
            goodprice = $('.ac').attr("data-price");
            dataIndexV = $('.ac').attr("data-index-v");


            //点击 手机版本换色(橘黄)
            $('.banben').find("span").removeClass('vc');
            $('.ac').find("span").eq(0).addClass('vc');

			//点击后,页面显示商品信息
            $('#goodname').html('{{$good->gname}}');
            $('#goodprice').html(goodprice+'  '+'元' );
            $('#right1').html(goodprice);
            $('#down1').html(goodprice);
            $('#downprice').html( '总计'+'  '+' : '+goodprice+'  '+'元' );
            $('#left1').html('{{$good->gname}}' + ' '+goodname + ' '+$('.bc').attr("data-color"));

            $('.jrgwc').removeAttr('data-number-v');
            $('.jrgwc').attr('data-number-v',dataIndexV);

        });

        //获取对象,创建点击事件(颜色)
        $('.color').click (function(){
            $(this).siblings().removeClass('bc');
            $(this).addClass('bc');
            goodcolor = $('.bc').attr("data-color");
            dataIndexC = $('.bc').attr("data-index-c");
            $('#left1').html('{{$good->gname}}'+ ' '+$('.ac').attr("data-name") + ' ' + $('.bc').attr("data-color"));

            //点击 颜色字体变色(橘黄)
            $('.color').find("span").removeClass('vc');
            $('.bc').find("span").eq(1).addClass('vc');

            $('.jrgwc').removeAttr('data-number-c');
            $('.jrgwc').attr('data-number-c',dataIndexC);
        });

        //点击提交至购物车
		var v = $('.banben').attr('data-index-v');
		var c = $('.banben').attr('data-index-c');
		$('.jrgwc').click(function(){
            if( v==0 || c==0){
				data_name = $('.ac').attr("data-name");
                data_price = $('.ac').attr("data-price");
				data_color = $('.bc').attr("data-color");
				data_versionId = $('.ac').attr("data-vid");
                data_colorId = $('.bc').attr("data-cid");
				data_id = {{$good->gid}};
				console.log(data_id,data_versionId,data_colorId,data_name,data_price,data_color);
				$.get('{{URL("home/Cart/shoppingCart/create")}}',{gid:data_id,vid:data_versionId,colorId:data_colorId,name:data_name,price:data_price,color:data_color},function(data){
                    if(data.status==1){
                        alert('加入成功');
                    }else{
                        alert('加入失败');
                    }
				})
			}

	return false;
		})
        // //shoppingCart Fly
        // $(function() {
        //     var offset = $("#icon-cart").offset();
        //     $(".jrgwc").click(function(event) {
        //         var img = $(this).parent('.xiadan').siblings('.jieshao').find('.left').children('img').attr('src');//获取当前点击图片链接
        //         var flyer = $('<img class="flyer-img" src="' + img + '">');//抛物体对象
        //         flyer.fly({
        //             start: {
        //                 left: event.pageX, //抛物体起点横坐标
        //                 top: event.pageY////抛物体起点纵坐标
        //             },
        //             end: {
        //                 left: offset.left + 70, //抛物体终点横坐标
        //                 top: offset.top + 0, //抛物体终点纵坐标
        //             },
        //             onEnd: function() {
        //                 $("#tip").show().animate({width: '200px'}, 300).fadeOut(500);//成功加入购物车动画效果
        //                 this.destory();//销毁抛物体
        //             }
        //         });
        //     });
        // });
	</script>
	</body>
</html>
