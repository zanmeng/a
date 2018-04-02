<style>
    .mt20{
        padding-top:300px;
    }
</style>
@extends('layouts.home')

@section('content')

<div class="banner_y center">
    <div class="nav">
        <ul>
            @foreach ($res as $v)
            <li >
                <a href="">{{$v->catname}}</a>
                <div class="pop">
                    <div class=" fl">
                        @foreach($v->good as $vv)
                        <div style="float:left;">
                            <div class="fl">
                                <a href="">
                                    <div class="img fl"  ><img src="{{$vv->gpic}} " style="width:100px;height:100px;margin-left: 10px;" alt=""></div>
                                   {{--商品详情链接--}}
                                    <a href="">
                                    <span  class="fl" style="font-size: 20px;color: red;line-height: 100px; margin-left: 50px; width:200px;">选购*{{$vv->gname}}</span>
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




<div class="sub_banner center">
        <div class="sidebar fl">
            <div class="fl"><a href=""><img src="./image/hjh_01.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_02.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_03.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_04.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_05.gif"></a></div>
            <div class="fl"><a href=""><img src="./image/hjh_06.gif"></a></div>
            <div class="clear"></div>
        </div>
        <div class="datu fl"><a href=""><img src="./image/hongmi4x.png" alt=""></a></div>
        <div class="datu fl"><a href=""><img src="./image/xiaomi5.jpg" alt=""></a></div>
        <div class="datu fr"><a href=""><img src="./image/pinghengche.jpg" alt=""></a></div>
        <div class="clear"></div>


    </div>

<div class="peijian w" style="width:65%;height:auto;">
    {{--<div class="biaoti center" style="background:pink;">小米明星单品</div>--}}
    @foreach($res as $v)
        {{--//判断要遍历的类--}}
        @if($v['catstatus']==1)
    <div class="biaoti center">{{ $v->catname }}
        <span style="float:right;"><a href="/home/liebiao/{{$v->catId}}">更多</a></span>
    </div>
    <div class="main center">
        <div class="content">
            @foreach($v->good as $vv)

                {{--@if($vv->gstatus==4)--}}
                {{--<div class="remen fl"><a href=""><img src="{{$vv->gpic}}" style="width:200px;height: 300px;"></a></div>--}}
                {{--@endif--}}

           {{--判断要显示的商品--}}
            @if($vv->gstatus==1)
            <div class="remen fl">
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
            @endforeach
            <div class="clear"></div>
        </div>
        <div style="padding-top:150px"><img src="/upload/1b868cf454168c3d790a47a0b43b74b7.jpg" style="width:100%;height:125px;" alt=""></div>
     @endif
    @endforeach
    </div>
</div>
@endsection
