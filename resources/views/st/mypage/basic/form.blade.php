@extends('layouts.st.common')
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
	<form method="post" action="{{ route('mypage.basic.post') }}">
		@csrf

		<table>
			<tr>
				<th height="75px">ユーザーネーム</th>
				<th class="right-block">
					<input type="text" name="username" class="form-control" placeholder="ユーザーネーム">
				</th>
			</tr>
			<tr>
				<th height="75px">パスワード</th>
				<th class="right-block">
					<input type="text" name="password" class="form-control" placeholder="パスワード">
				</th>
			</tr>
		</table>
		<div class="next-button">
			<input class="btn btn-primary" type="submit" value="送信" />
		</div>
	</form>
</div>
@endsection
