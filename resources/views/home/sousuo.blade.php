@extends('layouts.home')

@section('content')

	<!-- start banner_y -->
	<!-- end banner -->

	<!-- start danpin -->

		<div class="danpin center">
			<div class="biaoti center" style="background: #ddd;font-size: 30px;">
				<span style="margin-left: 20px;">
					{{ $input }}
				</span>
			</div>
			<div class="main center mb20">
					@foreach($goods as $v)
						<div class="mingxing fl mb20" style="border:2px solid #fff;width:230px;cursor:pointer;" onmouseout="this.style.border='2px solid #fff'" onmousemove="this.style.border='2px solid red'">
							<div class="sub_mingxing"><a href=""><img src="{{$v->gpic}}" alt=""></a></div>
							<div class="pinpai"><a href="">{{$v->gname}}</a></div>
							<div class="youhui">{{$v->gdesc}}</div>
							<div class="jiage">{{$v->gprice}}</div>
						</div>
				@endforeach
			<div class="clear"></div>
			</div>
		</div>

@endsection