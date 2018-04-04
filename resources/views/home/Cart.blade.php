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
    <script src="/home/js/jquery.js"></script>
</head>
<body>
<div class="banner_x center">
    {{--<a href="./index.html" target="_blank"><div class="logo fl"></div></a>--}}
    <div class="wdgwc fl ml40"><img src="/home/Cart/images/logo_top.png" alt="" style="margin-top:28px"></div>
    <div class="wdgwc fl ml40">我的购物车</div>
    <div class="wxts fl ml20">温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</div>
    <div class="dlzc fr">
        <ul>
            <li><a href="./login.html" target="_blank">登录</a></li>
            <li>|</li>
            <li><a href="./register.html" target="_blank">注册</a></li>
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
                    <p>版本：{{$v['vname']}}</p>
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
                    <p class="del"><a href="javascript:;" class="delBtn" style="font-size:28px;text-decoration:none;color:#9c9c9c">×</a></p>
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

<script src="/home/Cart/js/jquery.min.js"></script>
<script src="/home/Cart/js/carts.js"></script>

</body>
</html>