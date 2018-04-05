@extends('layouts.home')

@section('content')
    <style>
        table tr:hover{background-color:#d5d5d5;}
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
            <div class="rtcont fr">
                <div class="grzlbt ml40">收货地址</div>
                <a href="/home/address/create"><button style="width: 80px;height:30px;background-color: cadetblue">添加</button></a><br/><br/>
            @if(!empty($address[0]))
                <table border="1">
                    <thead>
                    <tr style="height:50px;width: 800px;">

                        <th>收货人</th>
                        <th>电话</th>
                        <th>地址</th>
                        <th>状态</th>
                        <th>操作</th></tr>
                    </thead>
                    <tbody>

                    @foreach($address as $v)
                        <tr style="height:40px;">
                            <td style="width:150px;" align="center">{{$v->orderName}}</td>
                            <td style="width:150px;" align="center">{{ $v->phone }}</td>
                            <td style="width:400px;" align="center">{{$v->addpro}}{{$v->addcity}}{{$v->addcounty}}{{ $v->address }}</td>
                            {{--<td style="width:150px;" align="center"><input type="radio" name="status" @if($v->status == 1) checked @endif >默认</td>--}}
                            <td style="width:150px;" align="center">@if($v->status==1) 默认 @else -- @endif</td>
                            <td style="width:100px;" align="center">
                                <a href="/home/address/{{$v->aid}}/edit"><button style="width: 50px;height:30px;background-color: cadetblue">修改</button></a>
                                <form action="/home/address/{{$v->aid}}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field()}}
                                    <button style="width: 50px;height:30px;background-color: cadetblue">删除</button>
                                </form>


                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <div class="clear"></div>
        </div>

    </div>
    <!-- self_info -->

    <script>




        $(':radio').each(function(){
            var che = $(this).attr('checked');
            var val = $(':radio').val();
            console.log(val);
            console.log(che);
            if(che == 'checked'){
                $.ajax({
                    url: '/home/ajax',
                    data: '',
                    dataType: 'json',
                    type: 'GET',
                    success: function(data){

                    },
                    error: function(){},
                    timeout:3000,
                    async: false
            })
            }


        })
</script>
@endsection


