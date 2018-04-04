<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>网站配置添加页面</title>
    <meta name="renderer" content="webkit">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="/admin/css/font.css">
      <link rel="stylesheet" href="/admin/css/xadmin.css">
      <script type="text/javascript" src="/admin/js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
      <script type="text/javascript" src="/admin/js/xadmin.js"></script>
  </head>
  
  <body>
    <div class="x-body">

        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>
                @if(session('error'))
                    session('error')
                    @else
                    请修改网站配置信息
                @endif
            </legend>
        </fieldset>
        <form enctype="multipart/form-data" id="art_form" class="layui-form">
          {{--{{ csrf_field() }}--}}

            <div class="layui-form-item">

                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>配置项标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="conf_title"  value="{{$config->conf_title}}" required="" lay-verify=""
                           autocomplete="off" class="layui-input">
                </div>
                <input type="hidden" name="conf_id" value="{{ $config->conf_id}}">
            </div>
            <div class="layui-form-item">
                {{--{{ csrf_field() }}--}}
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>配置项名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="conf_name" value="{{$config->conf_name}}" required="" lay-verify="" autocomplete="off" class="layui-input">
                </div>
            </div>


            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">配置项内容</label>
                <div class="layui-input-block">
                    <textarea name="conf_content"  placeholder="{{$config->conf_content}}" class="layui-textarea">{{$config->conf_content}}</textarea>
                </div>
            </div>

            <div class="layui-form-item" >

                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>配置项类型
                </label>
                <div class="layui-input-block">
                    <input type="radio" name="field_type[]" @if($config->field_type=='input') checked @endif value="input" title="文本框" >
                    <input type="radio" name="field_type[]" @if($config->field_type=='radio') checked @endif value="radio" title="单选框">
                    <input type="radio" name="field_type[]" @if($config->field_type=='textarea') checked @endif value="textarea" title="文本域" >
                </div>
            </div>

            <div class="layui-form-item" >
                {{--              {{ csrf_field() }}--}}
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>配置项排序
                </label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" id="L_username" name="conf_order" value="{{$config->conf_order}}" required="" lay-verify="" autocomplete="off" class="layui-input">
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="edit" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;



            //监听提交
            form.on('submit(edit)', function(data){

                //获取当前要修改的用户的id
                var conf_id = $("input[type='hidden']").val();

                $.ajax({
                    type: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/config/"+conf_id,
                    data: data.field,
                    dataType: "json",
                    success: function(data){



                         //如果添加成功
                         if(data.status == 1){
                             layer.alert(data.msg,{icon:6,time:2000},function(){
                                 //关闭弹层，刷新父页面
                                 parent.location.reload(true);
                             })
                         }else{
                             layer.alert(data.msg,{icon:6,time:2000},function(){
                                 //关闭弹层，刷新父页面
                                 parent.location.reload(true);
                             })
                         }
                        console.log(data);
                    }
                });

                return false;
            });




        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>