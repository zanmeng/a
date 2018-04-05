@extends('layouts.home')

@section('content')

<style>
	.banner_x{height:200px;}
	.mt20{
		/*padding-top:250px;*/
		/*position: relative;top:-10px;*/
	}
</style>
	<!-- start banner_y -->
	<!-- end banner -->

	<!-- start danpin -->

		<div class="danpin center">
			<div class="biaoti center" style="background: #ddd;font-size: 30px;">
				<span style="margin-left: 50px;">
					{{$ress[0]->catname}}
				</span>
			</div>
			<div class="main center mb20" style="">
				@foreach ($ress as $v)
					@foreach($v->good as $vv)
						<div class="mingxing fl mb20" style="border:2px solid #fff;width:230px;cursor:pointer;" onmouseout="this.style.border='2px solid #fff'" onmousemove="this.style.border='2px solid red'">
							<div class="sub_mingxing"><a href=""><img src="{{$vv->gpic}}" alt=""></a></div>
							<div class="pinpai"><a href="">{{$vv->gname}}</a></div>
							<div class="youhui">{{$vv->gdesc}}</div>
							<div class="jiage">{{$vv->gprice}}</div>
						</div>
					@endforeach
				@endforeach
			<div class="clear"></div>
			</div>
		</div>
@endsection