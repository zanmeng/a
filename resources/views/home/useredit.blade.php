@extends('layouts.home')

@section('content')
    <style>
        #tj{
            background-color: #ef5b00;
            width: 100px;
            height: 30px;
            line-height: 30px;
            display: block;
            margin-bottom: 14px;
            text-align: center;
            font-size: 14px;
            color: #fff;
            cursor: pointer;
            margin-left:300px;
            margin-top:50px;
        }
        .ipt{
            height:30px;
        }
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
            <form action="/home/userupdate/{{$user->login_id}}" enctype="multipart/form-data" method="post">


                {{csrf_field()}}
                <div class="rtcont fr">
                    <div class="grzlbt ml40">我的资料</div>
                    <div style="color:red;margin-left:50px;font-size:30px;">
                        @if(!empty(session('msg')))
                            {{session('msg')}}
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @if(is_object($errors))
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @else
                                        <li>{{ $errors }}</li>
                                    @endif
                                </ul>
                            </div>
                        @endif

                    </div>


                            <div class="layui-form-item">
                                <label for="desc" class="layui-form-label" style="margin-left:30px;margin-top:50px;">
                                    图像上传:
                                </label>
                                <div class="layui-input-inline" style="margin-left:30px;margin-top:50px;">
                                    <input type="file" id="file_upload" name="userphoto" value="{{ $user->userinfo->userphoto }}"  lay-verify=""
                                            class="layui-input">
                                </div>
                                <div>
                                    <img src="@if(!empty($user->userinfo->userphoto)) {{ $user->userinfo->userphoto }} @else {{url('home/image/geren.png')}} @endif" id="art_thumb" name="photo" value="" alt="" width="100" height="100" style="margin-top:20px;margin-left:100px;border:solid 1px red;border-radius:50%">
                                    <input type="hidden" name="goodspic" value="{{ $user->userinfo->userphoto }}" id="goods_hidden" >
                                </div>

                            </div>
                        <div class="subgrzl ml40"><span>用户名:</span><span>{{ $user->userName }}</span><span></span></div>
                        <div class="subgrzl ml40"><span>&nbsp;&nbsp;&nbsp;&nbsp;性别:</span><span><input type="radio" name="sex" value="1" {{($user->userinfo->sex == '1') ? 'checked': '' }}>男&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="2" {{($user->userinfo->sex == '2') ? 'checked': '' }}>女</span><span></span></div>
                        <div class="subgrzl ml40"><span>&nbsp;&nbsp;&nbsp;&nbsp;邮箱:</span><span><input class="ipt" name="email" type="text" value="@if(!empty($user)) {{ $user->email }} @endif"></span><span></span></div>
                        <div class="subgrzl ml40"><span>手机号:</span><span><input class="ipt" type="text" name="phone" value="@if(!empty($user)) {{ $user->userinfo->phone }} @endif"></span><span></span></div>
                    {{--<div class="subgrzl ml40"><span>&nbsp;&nbsp;&nbsp;&nbsp;头像:</span><span><input type="file" id="file_upload" name="userphoto"></span><span></span></div>--}}
                    <input id="tj" type="submit" value="修改">
                </div>
                <div class="clear"></div>
            </form>
            </div>

    </div>
    <!-- self_info -->

    <script type="text/javascript">
        $(function () {
            $("#file_upload").change(function () {
                uploadImage();
            })
        })
        function uploadImage() {
//  判断是否有选择上传文件
            var imgPath = $("#file_upload").val();
            if (imgPath == "") {
                alert("请选择上传图像！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }
            // var formData = new FormData($('#art_form')[0]);
            var formData = new FormData();
            formData.append('userphoto',$('#file_upload')[0].files[0]);

            $.ajax({
                type: "POST",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/home/upload",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $('#art_thumb').attr('src', '/upload/'+data);
                    $("input[name='goodspic']").val('/upload/'+data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        }
    </script>
@endsection


