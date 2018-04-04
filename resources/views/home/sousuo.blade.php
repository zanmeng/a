@extends('layouts.home')

@section('content')

	<style>
		.banner_x{height:200px;}
	</style>

	<!-- start banner_y -->
	<!-- end banner -->

	<!-- start danpin -->

		<div class="danpin center">
			<div class="biaoti center" style="background: #ddd;font-size: 30px;">
				<span style="margin-left:-700px;">
					{{ $input }}
				</span>
			</div>
			<div class="main center mb20 " style="width: 1250px;">
					@foreach($goods as $v)
						<div class="mingxing fl mb20" style="border:2px solid #fff;width:230px;cursor:pointer;" onmouseout="this.style.border='1px solid #fff'" onmousemove="this.style.border='1px solid red'">
							<div class="sub_mingxing"><a href=""><img src="{{$v->gpic}}"  alt=""></a></div>
							<div class="pinpai"style="color: red;font-size: 20px;"><a href="">{{$v->gname}}</a></div>
							<div class="jiage">{{$v->gprice}}</div>
							<div class="pinpai" style="margin-top: 30px;">{{$v->gdesc}}</div>

						</div>
				@endforeach
			<div class="clear"></div>
			</div>
		</div>

@endsection