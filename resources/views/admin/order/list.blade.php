  <!DOCTYPE html>
  <html>

    <head>
      <meta charset="UTF-8">
      <title>欢迎页面-X-admin2.0</title>
      <meta name="renderer" content="webkit">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      {{--<link rel="stylesheet" href="./css/font.css">--}}
      {{--<link rel="stylesheet" href="./css/xadmin.css">--}}
      {{--<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
      {{--<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>--}}
      {{--<script type="text/javascript" src="./js/xadmin.js"></script>--}}
      {{--<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->--}}
      {{--<!--[if lt IE 9]>--}}
        {{--<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>--}}
        {{--<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>--}}
      <![endif]-->
      @include('admin.public.style')
      @include('admin.public.script')
    </head>

    <body>
      <div class="x-nav">
        <span class="layui-breadcrumb">
          <a href="">首页</a>
          <a href="">演示</a>
          <a>
            <cite>导航元素</cite></a>
        </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
          <i class="layui-icon" style="line-height:30px">ဂ</i></a>
      </div>
      <div class="x-body">
        <div class="layui-row">

          <form class="layui-form layui-col-md12 x-so" action="/admin/order/index" method="get">
            <div class="layui-input-inline">
              <select name="num">
                <option value="5"
                        @if($request['num'] == 5)  selected  @endif
                >5
                </option>
                <option value="10"
                        @if($request['num'] == 10)  selected  @endif
                >10
                </option>
              </select>
            </div>
            <input class="layui-input" placeholder="下单时间" name="createTime" value="{{$request->createTime}}" id="start">
            {{--<div class="layui-input-inline">--}}
              {{--<select name="contrller">--}}
                {{--<option>支付状态</option>--}}
                {{--<option>已支付</option>--}}
                {{--<option>未支付</option>--}}
              {{--</select>--}}
            {{--</div>--}}
            {{--<div class="layui-input-inline">--}}
              {{--<select name="contrller">--}}
                {{--<option>支付方式</option>--}}
                {{--<option>支付宝</option>--}}
                {{--<option>微信</option>--}}
                {{--<option>货到付款</option>--}}
              {{--</select>--}}
            {{--</div>--}}
            <div class="layui-input-inline" >
              <select name="orderStatus" >
                {{--<option value=" ">--}}
                @if ("{{$request->orderStatus}}" == 1)
                   <option> 待发货</option>
                @elseif ("{{$request->orderStatus}}" == 2)
                  <option>已发货</option>
                @elseif("{{$request->orderStatus}}" == 3)
                  <option>已完成</option>
                @endif">

                {{--</option>--}}
                {{--<option value="0">待确认</option>--}}
                <option value="1">待发货</option>
                <option value="2">已发货</option>
                <option value="3">已完成</option>
                <option value="4">已取消</option>
                <option value="5">已作废</option>
              </select>
            </div>
            <input type="text" name="orderNum"  value="{{$request->orderNum}}" placeholder="请输入订单号" autocomplete="off" class="layui-input">
            {{--<input type="text" name="keywords1" value="{{$request->keywords1}}" placeholder="请输入用户名" autocomplete="off" class="layui-input">--}}
            {{--<input type="text" name="keywords2" value="{{$request->keywords2}}" placeholder="请输入邮箱" autocomplete="off" class="layui-input">--}}
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
          </form>
        </div>

        <xblock>
          <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
          {{--<button class="layui-btn" onclick="x_admin_show('添加用户','./order-add.html')"><i class="layui-icon"></i>添加</button>--}}

          <span class="x-right" style="line-height:40px">共有数据：88 条</span>
        </xblock>
        <table class="layui-table">
          <thead>
            <tr>
              <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
              </th>

              <th>订单id</th>
              <th>订单编号</th>
              <th>订单人</th>
              <th>总金额</th>
              <th>订单数量</th>
              <th>收货人</th>
              <th>收货人地址</th>
              <th>收获人电话</th>
              <th>订单状态</th>
              <th>买家留言</th>
              <th>下单时间</th>
              <th >操作</th>
              </tr>
          </thead>
          <tbody>

          @foreach($orders as $v)
            <tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->orderId}}'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td>{{$v->orderId}}</td>
              <td>{{$v->orderNum}}</td>
              <td>{{$v->userName}}</td>
              <td>{{$v->orderMoney}}</td>
              <td>{{$v->orderCnt}}</td>
              <td>{{$v->orderName}}</td>
              <td>{{$v->userAddress}}</td>
              <td>{{$v->userPhone}}</td>
              <td>
                @if ($v->orderStatus == 1)
                  待发货
                 @elseif ($v->orderStatus == 2)
                已发货
                  @elseif($v->orderStatus == 3)
                  已完成
                @endif
              </td>
              <td>{{$v->orderRemarks}}</td>
              <td>{{$v->createTime}}</td>
              <td class="td-manage">
                <a title="查看"  onclick="x_admin_show('查看','/admin/order/show/{{$v->orderNum}}')" href="javascript:;">
                  <i class="layui-icon">&#xe63c;</i>
                </a>
                <a
                   @if ($v->orderStatus == 1)
                   onclick="member_stop(this,'{{ $v->orderId }}')" href="javascript:;" status="{{ $v->orderStatus }}"  title="发货">
                  <i class="layui-icon">&#xe642;</i>
                  @endif
                <a title="删除" onclick="member_del(this,'{{$v->orderId}}')" href="javascript:;">
                  <i class="layui-icon">&#xe640;</i>
                </a>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="page">
          <div>


            {!! $orders->appends($request->all())->render()!!}
            {{--<a class="prev" href="">&lt;&lt;</a>--}}
            {{--<a class="num" href="">1</a>--}}
            {{--<span class="current">2</span>--}}
            {{--<a class="num" href="">3</a>--}}
            {{--<a class="num" href="">489</a>--}}
            {{--<a class="next" href="">&gt;&gt;</a>--}}
          </div>
        </div>

      </div>
      <script>
        layui.use('laydate', function(){
          var laydate = layui.laydate;

          //执行一个laydate实例
          laydate.render({
            elem: '#start' //指定元素
          });

          //执行一个laydate实例
          laydate.render({
            elem: '#end' //指定元素
          });
        });

         /*发货*/
        /*用户-停用*/
        function member_stop(obj,id){
            //获取要改变状态的用户的id

            //获取当前改变用户的状态
            var status = $(obj).attr('status');

            // console.log( status);

            layer.confirm('确认发货吗？',function(index){

                if($(obj).attr('status') =='1') {


                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/order/changestatus",
                        data: {'id': id, 'status': status},
                        dataType: "json",
                        success: function (data) {
                            //发异步把用户状态进行更改
                            location.reload();
                        }
                    });


                }
                // }else{
                //     $(obj).attr('title','启用')
                //     $(obj).find('i').html('&#xe601;');
                //
                //     $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                //     layer.msg('已启用!',{icon: 5,time:1000});
                // }


            });
        }

        /*用户-删除*/
        function member_del(obj,id){
            //获取用户ID

            layer.confirm('确认要删除吗？',function(index){
                // $.post('请求的路径','携带的参数'，执行成功后的返回结果)
                $.post("{{ url('admin/order/destroy') }}/"+id,{'_token':"{{csrf_token()}}"},function(data){
                    //如果删除成功
                    if(data.status == 0){
                        //发异步删除数据
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else{
                        layer.msg('删除失败!',{icon:1,time:1000});
                    }
                });


            });
        }




        function delAll () {

            // var data = tableCheck.getData();
            //声明一个空数组，存放所有被选中的复选框的data-id属性值
            var ids = [];
            //获取所有的被选中的复选框
            $('.layui-form-checked').not('.header').each(function(i,v){
                ids.push($(v).attr('data-id'));
            });
            // console.log(ids);


            $.get('/admin/order/delall',{"ids":ids},function(data){
                //后台如果删除成功，在前台上也把相关记录删除掉
                if(data.status == 0){
                    layer.msg('删除成功', {icon: 1});
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                }else{
                    layer.msg('删除失败', {icon: 2});
                }
            })

            // layer.confirm('确认要删除吗？'+data,function(index){
            //     //捉到所有被选中的，发异步进行删除
            //     layer.msg('删除成功', {icon: 1});
            //     $(".layui-form-checked").not('.header').parents('tr').remove();
            // });

        }

      </script>
      <script>var _hmt = _hmt || []; (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0];
          s.parentNode.insertBefore(hm, s);
        })();
      </script>
    </body>

  </html>