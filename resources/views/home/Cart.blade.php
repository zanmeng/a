<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>购物车</title>
    <link rel="stylesheet" href="/home/Cart/css/reset.css">
    <link rel="stylesheet" href="/home/Cart/css/carts.css">
    <link rel="stylesheet" type="text/css" href="/home/css/style.css">
    <link rel="stylesheet" href="/home/Cart/css/newbase.min.css" />
    <link rel="stylesheet" type="text/css" href="/home/Cart/css/newcart.min.css" />
    <script src="/home/Cart/js/jquery.min.js"></script>

</head>
<body>
<div class="banner_x center">
    {{--<a href="./index.html" target="_blank"><div class="logo fl"></div></a>--}}
    {{--a标签里的onfocus="this.blur(); 是用来点击a标签时触发onfocus事件,强制取消a标签聚焦出现虚线--}}
    <div class="wdgwc fl ml40"><a href="{{URL('home/index')}}" onfocus="this.blur();"><img src="/home/Cart/images/logo_top.png"  style="margin-top:28px;margin-left:-40px"></a></div>
    <div class="wdgwc fl ml40">我的购物车</div>
    <div class="wxts fl ml20">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</div>
    <div class="dlzc fr">
        <ul>
            <li><a href="{{URL('home/login')}}">登录</a></li>
{{--            <li><a href="{{URL('home/login')}}" target="_blank">登录</a></li>--}}
            <li>|</li>
            <li><a href="{{URL('home/reg')}}" >注册</a></li>
        </ul>

    </div>
    <div class="clear"></div>
</div>
<div class="xiantiao"></div>
{{--endheader--}}
<section class="cartMain">
    <div class="cartMain_hd">
        <ul class="order_lists cartTop">
            <li class="list_chk">
                <!--所有商品全选-->
                {{--<input type="checkbox" id="all" class="whole_check">--}}
                {{--<label class="mark" for="all"></label>--}}
                {{--全选--}}
            </li>
            <li class="list_con">商品名称</li>
            <li class="list_info">商品参数</li>
            <li class="list_price">单价</li>
            <li class="list_amount">数量</li>
            <li class="list_sum">小计</li>
            <li class="list_op">操作</li>
        </ul>
    </div>

    <div class="cartBox">
        <div class="order_content">
            @foreach( $gmax as $k=>$v)
            <ul class="order_lists" id="good" >
                <li class="list_chk">
                    {{--<input type="checkbox"  class="son_check">--}}
                    {{--<label class="mark" for="checkbox_2"></label>--}}
                </li>
                <li class="list_con">
                    <div class="list_img"><a href="javascript:;"><img src="/home/image/liebiao_xiaomi6.jpg" alt=""></a></div>
                    <div class="list_text"><a href="javascript:;">{{$v['gname']}}</a></div>
                </li>
                <li class="list_info">
                    <p style="margin-top:28px">版本：{{$v['vname']}}</p>
                    <p>颜色：{{$v['cname']}}</p>
                </li>
                <li class="list_price">
                    <p class="price">{{$v['price']}}</p>
                </li>
                <li class="list_amount">
                    <div class="amount_box">
                        <a href="javascript:;" class="reduce reSty" goodid={{$v['id']}}>-</a>
                        <input type="text"  value="{{$v['num']}}" class="sum" goodid={{$v['id']}}>
                        <a href="javascript:;" class="plus" goodid={{$v['id']}}>+</a>
                    </div>
                </li>
                <li class="list_sum">
                    <p class="sum_price">
                        {{--小计--}}
                        {{$v['price']*$v['num']}}
                    </p>
                </li>
                <li class="list_op">
                    <p class="del"><a href="javascript:;" class="delBtn" style="font-size:28px;text-decoration:none;color:#9c9c9c;margin-top:53px">×</a></p>
                </li>
            </ul>
            @endforeach
        </div>
    </div>



    <!--底部-->
    <div class="bar-wrapper">
        <div class="bar-right">
            <div class="piece">商品总计<strong class="piece_num"></strong>件</div>
            <div class="totalMoney">共计:
                <strong class="total_text"></strong></div>
            <div class="calBtn"><a href="javascript:;">结算</a></div>
        </div>
    </div>
</section>
<section class="model_bg"></section>
<section class="my_model">
    <p class="title">删除宝贝<span class="closeModel">X</span></p>
    <p>您确认要删除该宝贝吗？</p>
    <div class="opBtn">
        <a href="javascript:;" class="dialog-sure">确定</a>
        <a href="javascript:;" class="dialog-close">关闭</a>
    </div>
</section>

{{--footer--}}
<div class="site-footer" style="background-color:#fff">
    <div class="container">
        <div class="footer-service">
            <ul class="list-service clearfix">
                <li><a rel="nofollow" href="//www.mi.com/static/fast/" target="_blank"><i class="iconfont">&#xe634;</i>预约维修服务</a></li>
                <li><a rel="nofollow" href="//www.mi.com/service/exchange#back" target="_blank"><i class="iconfont">&#xe635;</i>7天无理由退货</a></li>
                <li><a rel="nofollow" href="//www.mi.com/service/exchange#back" target="_blank"><i class="iconfont">&#xe636;</i>15天免费换货</a></li>
                <li><a rel="nofollow" href="//www.mi.com/service/buy/postage/" target="_blank"><i class="iconfont">&#xe638;</i>满150元包邮</a></li>
                <li><a rel="nofollow" href="//www.mi.com/static/maintainlocation/" target="_blank"><i class="iconfont">&#xe637;</i>520余家售后网点</a></li>
            </ul>
        </div>
        <div class="footer-links clearfix">

            <dl class="col-links col-links-first">
                <dt>帮助中心</dt>

                <dd><a rel="nofollow" href="//www.mi.com/service/account/register/"   target="_blank">账户管理</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/service/buy/buytime/"   target="_blank">购物指南</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/service/order/sendprogress/"   target="_blank">订单操作</a></dd>

            </dl>

            <dl class="col-links ">
                <dt>服务支持</dt>

                <dd><a rel="nofollow" href="//www.mi.com/service/exchange"   target="_blank">售后政策</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/service/"   target="_blank">自助服务</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/c/service/download/"   target="_blank">相关下载</a></dd>

            </dl>

            <dl class="col-links ">
                <dt>线下门店</dt>

                <dd><a rel="nofollow" href="//www.mi.com/c/xiaomizhijia/"   target="_blank">小米之家</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/static/maintainlocation/"   target="_blank">服务网点</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/static/familyLocation/"   target="_blank">零售网点</a></dd>

            </dl>

            <dl class="col-links ">
                <dt>关于小米</dt>

                <dd><a rel="nofollow" href="//www.mi.com/about/"   target="_blank">了解小米</a></dd>

                <dd><a rel="nofollow" href="http://hr.xiaomi.com/"   target="_blank">加入小米</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/about/contact/"   target="_blank">联系我们</a></dd>

            </dl>

            <dl class="col-links ">
                <dt>关注我们</dt>

                <dd><a rel="nofollow" href="https://weibo.com/xiaomishangcheng"   target="_blank">新浪微博</a></dd>

                <dd><a rel="nofollow" href="http://xiaoqu.qq.com/mobile/share/index.html?url=http%3A%2F%2Fxiaoqu.qq.com%2Fmobile%2Fbarindex.html%3Fwebview%3D1%26type%3D%26source%3Dindex%26_lv%3D25741%26sid%3D%26_wv%3D5123%26_bid%3D128%26%23bid%3D10525%26from%3Dwechat"   target="_blank">小米部落</a></dd>

                <dd><a rel="nofollow" href="#J_modalWeixin" data-toggle="modal" >官方微信</a></dd>

            </dl>

            <dl class="col-links ">
                <dt>特色服务</dt>

                <dd><a rel="nofollow" href="//order.mi.com/queue/f2code"   target="_blank">F 码通道</a></dd>

                <dd><a rel="nofollow" href="//www.mi.com/giftcode/"   target="_blank">礼物码</a></dd>

                <dd><a rel="nofollow" href="//order.mi.com/misc/checkitem"   target="_blank">防伪查询</a></dd>

            </dl>

            <div class="col-contact">
                <p class="phone">400-100-5678</p>
                <p>
                    周一至周日 8:00-18:00<br>（仅收市话费）
                </p>
                <a rel="nofollow" class="btn btn-line-primary btn-small" href="//www.mi.com/service/contact/" target="_blank"><i class="iconfont">&#xe600;</i> 在线客服</a>            </div>
        </div>
    </div>
</div>

{{--发送ajax--}}
<script>
    total();
    //点击 + 号
    $('.plus').click(function(){

        //获取goodid属性值
        var id =$(this).attr("goodid");

        //获取数量
        var val = $(this).prev('input');
        var price = $(this).parents('.order_lists').find('.price');
        var priceOBJ = $(this).parents('.order_lists').find('.sum_price');

        //发送ajax
        $.get('{{URL('home/jisuan/jia')}}',{ id:id },function(data){
            if(data){
                count =  parseInt( val.val() ) +1 ;
                var total_price = parseInt( price.html() ) * count;
                // console.log(total_price);
                val.val(count);
                priceOBJ.html(total_price);
            };
            total();
        });
    });

    //点击 - 号
    $('.reduce').click(function(){
        //获取goodid属性
        var id = $(this).attr('goodid');

        //获取数量
        var val = $(this).next('input');
        var price = $(this).parents('.order_lists').find('.price');
        var priceOBJ = $(this).parents('.order_lists').find('.sum_price');

        //发送ajax
        $.get('{{URL('home/jisuan/jian')}}',{ id:id },function(data){
            if(data==1) {
                count = parseInt(val.val()) - 1;
                var total_price = parseInt(price.html()) * count;
                // console.log(total_price);
                val.val(count);
                priceOBJ.html(total_price);
            }else{
                    $(this).addClass('reSty');
                }
            total();
        });
    });

    //焦点事件
    $('input[type=text]').blur(function(){
        //获取goodid属性
        var id = $(this).attr('goodid');

        //获取数量
        var val = $(this)
        var val_v = val.val();
        if( parseInt(val_v) < 0 ){
            abs(val_v);
        }
        // console.log(val);
        var price = $(this).parents('.order_lists').find('.price');
        var priceOBJ = $(this).parents('.order_lists').find('.sum_price');

        $.get('{{URL('home/jisuan/jiaodian')}}',{ id:id,val:val_v },function(data){
            if(data==1) {
                count = 0 + parseInt(val_v);
                var total_price = parseInt(price.html()) * count;
                // console.log(total_price);
                val.val(count);
                priceOBJ.html(total_price);
            }else{
                $(this).addClass('reSty');
            }
            total();
        });
    });

    //总计金额
    function total()
    {
        var a = $('.order_lists').find('.sum_price');
        var b = $('.order_lists').find('.sum');
        var total_money = 0;
        var total_num = 0;
        b.each(function(){
            total_num+=parseInt( $(this).val() );
        });
        console.log(total_num);
        a.each(function(){
            total_money+=parseInt( $(this).html() );
        });
        $('.total_text').html(total_money);
        $('.piece_num').html(total_num);
    }


</script>

<script src="/home/Cart/js/carts.js"></script>

</body>
</html>