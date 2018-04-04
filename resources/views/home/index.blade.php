<style>
    .mt20{
        /*padding-top:150px;*/
        /*position: relative;top:-10px;*/
    }
</style>
@extends('layouts.home')

@section('content')

<div class="banner_y center" >
    {{--轮播图--}}
    <div class="layui-carousel" id="test1" style="float: right;position:relative; ">
        <div carousel-item>
            @foreach($good as $v)
            @if($v->gstatus==3)
                <div>
                    <a href="">
                        <img src="{{$v->gpic}}" style="width:1000px;height:500px;" alt="">
                    </a>
                </div>
            @endif    
            @endforeach
        </div>
    </div>

    <div class="nav">
        <ul style="position: absolute">
            @foreach ($res as $v)
            <li >
                <a href="">{{$v->catname}}</a>
                <div class="pop">
                    <div class=" fl">
                        @foreach($v->good as $vv)
                        <div style="float:left;">
                            <div class="fl">
                                <a href="">
                                    <div class="img fl"  ><img src="{{$vv->gpic}} " style="width:60px;height:60px;margin-left: 10px;" alt=""></div>
                                   {{--商品详情链接--}}
                                    <a href="">
                                    <span  class="fl" style="font-size: 10px;color: red;line-height: 80px; margin-left: 30px; width:150px;">选购*{{$vv->gname}}</span>
                                    </a>
                                    <div class="clear"></div>
                                </a>
                             </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</div>

<script>
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '80%' //设置容器宽度
            ,height:'100%'
            // ,float:'right'
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
        });
    });
</script>



<div class="sub_banner center" style="position: relative;z-index: 999;" >
        <div class="sidebar fl">
            <div class="fl"><a href=""><img src="./image/hjh_01.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_02.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_03.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_04.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_05.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_06.gif"></a></div>
            <div class="clear"></div>
        </div>
        @foreach($good as $v)
            @if($v->gstatus==2)
                <div style="position: relative; " class="datu fl"><a href=""><img src="{{$v->gpic}}" alt=""></a></div>

            @endif
        @endforeach
        <div class="clear"></div>


    </div>
@foreach($res as $v)
    @if($v['catstatus']==1)
<div class="peijian w" style="height:auto; width: 100%; position: relative;z-index: 99999;top: -120px;background: #f5f5f5;">
        {{--//判断要遍历的类--}}
            <div class="biaoti center" style="position: relative; margin-top: 200px;" >
                <span style="margin-left: 50px;font-size: 30px;">{{ $v->catname }}</span>
            <div style="float:right;"><a href="/home/liebiao/{{$v->catId}}">查看更多</a></div>
            </div>
                <div class="main center" style="position: relative;">
                    <div class="content" style="margin-left: 420px;height: auto;">
                        {{--类下的商品--}}
                        @foreach($v->good as $vv)
                            {{--具体要显示的商品--}}
                        @if($vv->gstatus==1)
                            <div class="remen fl" style="position: relative">
                                <div class="xinpin" style="padding-top: 10px;"><span  style="width:100px;height: 25px;">{{ $vv ->gname }}</span></div>
                                <div class="tu" ><a href=""><img src="{{$vv->gpic}}" style="width:200px;height:200px;padding-top: 20px;margin-left: 20px"></a></div>
                                <div class="miaoshu"><a href="">{{$vv->gname}}</a></div>
                                <div class="jiage">价格￥{{$vv->price}}</div>
                                {{--<div class="pingjia"></div>--}}
                                <div class="piao">
                                    <a href="">
                                        <span>{{$vv->gdesc}}</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                        {{--广告牌--}}
                             @if($vv->gstatus==4)
                                 <div><img src="{{$vv->gpic}}" style="width:100%;height:200px;padding-top: 100px;" alt=""></div>
                             @endif

                         @endforeach

                            <div class="clear"></div>
                    </div>
                </div>
        @endif



    @endforeach

</div>
@endsection
