@extends('layouts.common')
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
	<form method="post" action="{{ route('mypage.detail.post') }}">
		@csrf

		<table>
			<tr>
				<th height="75px">自己PR</th>
				<th class="right-block" width="600px">
					<textarea type="text" name="pr" class="form-control" rows="10">
						{{ $profile->pr }}
					</textarea>
				</th>
			</tr>
			<tr>
				<th height="75px">ガクチカ</th>
				<th class="right-block" width="600px">
					<textarea type="text" name="gakuchika" class="form-control" rows="10">
						{{ $profile->gakuchika }}
					</textarea>
				</th>
			</tr>
			<tr>
				<th height="75px">挫折経験</th>
				<th class="right-block" width="600px">
					<textarea type="text" name="frustration" class="form-control" rows="10">
						{{ $profile->frustration }}
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
