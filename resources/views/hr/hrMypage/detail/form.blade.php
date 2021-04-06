@extends('layouts.common_hr')
@section('content')
<div class="container">
	<h3>フォーム</h3>
	@if ($errors->any())
	<div style="color:red;">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<!--研究室登録フォーム-->
	<form method="post" action="{{ route('hr.mypage.detail.post') }}">
		@csrf

		<table>
			<tr>
				<th height="75px">自己紹介</th>
				<th class="right-block" width="600px">
					<textarea type="text" name="introduction" class="form-control" rows="10">
						{{ $profileCollection[0]['introduction'] }}
					</textarea>
				</th>
			</tr>
			<tr>
				<th height="75px">どんな面接ができる？</th>
				<th class="right-block" width="600px">
					<textarea type="text" name="pr" class="form-control" rows="10">
						{{ $profileCollection[0]['pr'] }}
					</textarea>
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
